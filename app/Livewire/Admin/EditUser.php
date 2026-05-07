<?php

namespace App\Livewire\Admin;

use App\Mail\WithdrawalStatusMail;
use App\Models\SpinResults;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;

    // Wallet Adjustment States
    public $amountToAdjust = 0;
    public $walletType = 'balance';

    // Spin Allocation States
    public $total_spins = 0;
    public $is_active = true;
    public $selected_prize_index = 0;
    public $used_spins = 0; // Add this property to track used spins

    public $cot, $tax_code, $token_code;

    // Your Prize Constant Mapping
    public $prizes = [
        0 => ['label' => 'CAR', 'icon' => '🚗', 'amount' => 1, 'color' => '#ff3100'],
        1 => ['label' => '$10K', 'icon' => '💰', 'amount' => 10000, 'color' => '#ffeb00'],
        2 => ['label' => '$100K', 'icon' => '💵', 'amount' => 100000, 'color' => '#83e414'],
        3 => ['label' => 'GOLD BAR 15', 'icon' => '🧈', 'amount' => 15, 'color' => '#54d3ff'],
        4 => ['label' => 'LOSE', 'icon' => '❌', 'amount' => 0, 'color' => '#7e1fff'],
        5 => ['label' => 'GOLD BAR 7', 'icon' => '🧈', 'amount' => 7, 'color' => '#1e62ff'],
        6 => ['label' => 'GOLD BAR 5', 'icon' => '🧈', 'amount' => 5, 'color' => '#d8009b'],
    ];

    public function mount(User $user)
    {
        $this->user = $user->load(['wallet', 'spinAllocations', 'spinResults', 'withdrawals']);

        $allocation = $this->user->spinAllocations->first();
        if ($allocation) {
            $this->total_spins = $allocation->total_spins;
            $this->used_spins = $allocation->used_spins;
            $this->is_active = (bool) $allocation->is_active;
        }

        // Load existing pins or set defaults
        $pins = $this->user->withdrawalPins;
        if ($pins) {
            $this->cot = $pins->cot;
            $this->tax_code = $pins->tax_code;
            $this->token_code = $pins->token_code;
        }
    }



    public function adjustBalance($action)
    {
        $this->validate(['amountToAdjust' => 'required|numeric|min:0.01']);
        $wallet = $this->user->wallet;

        if ($action === 'credit') {
            $wallet->increment($this->walletType, $this->amountToAdjust);
        } else {
            $wallet->decrement($this->walletType, $this->amountToAdjust);
        }

        $this->amountToAdjust = 0;
        $this->user->refresh();
        $this->dispatch('success', message: 'Wallet updated successfully.');
    }

    public function updateWithdrawalPins()
    {
        $this->user->withdrawalPins()->updateOrCreate(
            ['user_id' => $this->user->id],
            [
                'cot' => $this->cot,
                'tax_code' => $this->tax_code,
                'token_code' => $this->token_code,
            ]
        );

        $this->dispatch('success', message: 'Withdrawal verification pins updated.');
    }

    public function updateAllocation()
    {
        $this->user->spinAllocations()->updateOrCreate(
            ['user_id' => $this->user->id],
            [
                'total_spins' => $this->total_spins,
                'used_spins' => 0, // <--- THIS solves the logic flaw
                'is_active' => $this->is_active
            ]
        );

        // Clear old used results so the queue doesn't look cluttered
        $this->user->spinResults()->where('is_used', true)->delete();

        $this->user->refresh();
        $this->dispatch('success', message: 'Spins reset and updated to ' . $this->total_spins);
    }

    public function addSpinResult()
    {
        $allocation = $this->user->spinAllocations->first();

        if (!$allocation) {
            $this->dispatch('error', message: 'Create allocation first (Click Update).');
            return;
        }

        // Get prize data based on the admin's selection
        $prize = $this->prizes[$this->selected_prize_index];

        SpinResults::create([
            'user_id' => $this->user->id,
            'spin_allocation_id' => $allocation->id,
            'prize_label' => $prize['label'],
            'prize_value' => $prize['icon'],
            'amount' => $prize['amount'],
            'slice_index' => $this->selected_prize_index, // Important for wheel landing
            'color' => $prize['color'],
            'is_used' => false
        ]);

        $this->user->refresh();
        $this->dispatch('success', message: 'Spin result added to queue.');
    }

    public function clearUsedSpins()
    {
        $this->user->spinResults()->where('is_used', true)->delete();
        $this->user->refresh();
        $this->dispatch('success', message: 'Used spin history wiped.');
    }

    // This runs automatically when wire:model="is_active" changes
    public function updatedIsActive($value)
    {
        // 1. Update the database record
        $this->user->spinAllocations()->updateOrCreate(
            ['user_id' => $this->user->id],
            ['is_active' => (bool) $value]
        );

        // 2. Optional: Refresh user data to ensure UI sync
        $this->user->refresh();

        // 3. Dispatch success message
        $status = $value ? 'Enabled' : 'Disabled';
        $this->dispatch('success', message: "Spin Engine is now {$status}.");
    }

    public function deleteResult($id)
    {
        SpinResults::findOrFail($id)->delete();
        $this->user->refresh();
        $this->dispatch('success', message: 'Result removed.');
    }

    public function deleteUser()
    {
        $this->user->delete();
        return redirect()->route('admin.dashboard');
    }

    public function approveWithdrawal($id)
    {
        // 1. Fetch the withdrawal with the user relationship
        $withdrawal = \App\Models\Withdrawals::with('user')->findOrFail($id);

        // 2. Prevent re-processing if already approved
        if ($withdrawal->status !== 'pending') {
            $this->dispatch('error', message: 'This withdrawal has already been processed.');
            return;
        }

        try {
            // 3. Update the status
            $withdrawal->update(['status' => 'completed']);

            // 4. Format the amount/quantity for the email logic
            // If it's a car, we show units. If money, we show $
            $displayAmount = $withdrawal->withdrawal_method === 'car'
                ? $withdrawal->amount . ' Unit(s)'
                : '$' . number_format($withdrawal->amount, 2);

            // 5. Send the Approval Email to the User
            Mail::to($withdrawal->user->email)
                ->send(new WithdrawalStatusMail($withdrawal, $displayAmount));

            // 6. Refresh data and Notify Admin
            $this->user->refresh();
            $this->dispatch('success', message: 'Withdrawal approved and user notified successfully.');
        } catch (\Exception $e) {
            $this->dispatch('error', message: 'Mail Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-user');
    }
}
