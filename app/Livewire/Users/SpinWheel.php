<?php

namespace App\Livewire\Users;

use App\Models\SpinAllocations;
use App\Models\SpinHistories;
use App\Models\SpinResults;
use App\Models\Wallets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SpinWheel extends Component
{
    public $canSpin = false;
    public $remainingSpins = 0;
    public $balance = 0;
    public $tesla_balance = 0;

    // Track the pending result ID to prevent instant balance updates
    public $pendingResultId;

    public function mount()
    {
        $this->checkSpinAvailability();
        $this->loadBalances();
    }

    public function loadBalances()
    {
        $wallet = Wallets::where('user_id', Auth::id())->first();
        $this->balance = $wallet?->balance ?? 0;
        $this->tesla_balance = $wallet?->tesla_balance ?? 0;
    }

    public function checkSpinAvailability()
    {
        $allocation = SpinAllocations::where('user_id', Auth::id())
            ->where('is_active', true)
            ->first();

        if ($allocation && $allocation->used_spins < $allocation->total_spins) {
            $this->canSpin = true;
            $this->remainingSpins = $allocation->total_spins - $allocation->used_spins;
        } else {
            $this->canSpin = false;
            $this->remainingSpins = 0;
        }
    }

    public function spin()
    {
        if (!$this->canSpin) {
            $this->dispatch('error', message: 'No spins available');
            return;
        }

        // 1. Fetch the next unused result
        $spin = SpinResults::where('user_id', Auth::id())
            ->where('is_used', false)
            ->first();

        if (!$spin) {
            $this->dispatch('error', message: 'No spin result found in queue');
            return;
        }

        // 2. Mark spin as used in DB and increment usage
        // Note: We don't update the wallet yet!
        DB::transaction(function () use ($spin) {
            $spin->update([
                'is_used' => true,
                'used_at' => now()
            ]);

            SpinAllocations::where('user_id', Auth::id())
                ->where('is_active', true)
                ->increment('used_spins');
        });

        // 3. Store ID to process the reward later
        $this->pendingResultId = $spin->id;

        // 4. Validate Index
        $index = (int) ($spin->slice_index ?? 0);

        // 5. Tell the Frontend to start the animation
        $this->dispatch(
            'spinResult',
            label: $spin->prize_label,
            value: $spin->prize_value,
            amount: $spin->amount,
            index: $index
        );

        $this->checkSpinAvailability();
    }

    /**
     * Called via JS when the User closes the Win Modal
     */
    public function claimReward()
    {
        if (!$this->pendingResultId) {
            return;
        }

        DB::transaction(function () {
            $spin = SpinResults::find($this->pendingResultId);

            if (!$spin) return;

            $wallet = Wallets::firstOrCreate(
                ['user_id' => Auth::id()],
                ['balance' => 0, 'tesla_balance' => 0]
            );

            $label = strtoupper($spin->prize_label);

            // 🏆 Reward Logic Update:
            // If it's a CAR or a GOLD BAR, it goes to tesla_balance
            if ($label === 'CAR' || str_contains($label, 'GOLD BAR')) {
                $wallet->increment('tesla_balance', $spin->amount);
            }
            // If it's currency ($10K, $100K), it goes to regular balance
            elseif ($spin->amount > 0) {
                $wallet->increment('balance', $spin->amount);
            }

            // Save history
            SpinHistories::create([
                'user_id' => Auth::id(),
                'spin_result_id' => $spin->id,
                'result_label' => $spin->prize_label,
                'result_value' => $spin->prize_value,
                'amount' => $spin->amount
            ]);
        });

        $this->pendingResultId = null;
        $this->refreshWheel();
    }

    public function lose()
    {
        $this->pendingResultId = null;
        $this->refreshWheel();
    }

    public function refreshWheel()
    {
        $this->loadBalances();
        // Redirecting back to the same route clears the state and resets the wheel
        $this->redirectRoute('spin');
    }

    public function render()
    {
        return view('livewire.users.spin-wheel');
    }
}
