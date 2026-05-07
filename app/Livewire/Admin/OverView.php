<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use App\Models\SpinAllocations;
use App\Models\User;
use App\Models\Wallets;
use App\Models\Withdrawals;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OverView extends Component
{
    use WithPagination;

    public $wincode;

    public function mount()
    {
        $this->resetPage();
        $this->wincode = Setting::where('id', 1)->first()->wincode ?? 'N/A';
    }

    public function updateWinCode()
    {
        // Ensure only admins can trigger this if you don't have a middleware gate already
        if (!Auth::user()->isAdmin()) {
            $this->dispatch('error', message: 'Unauthorized action.');
            return;
        }

        // Since settings tables usually have only one row (ID 1)
        Setting::updateOrInsert(
            ['id' => 1], // Match the first record
            [
                'wincode' => $this->wincode,
                'updated_at' => now()
            ]
        );

        $this->dispatch('success', message: 'Global Win-Code updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.over-view', [
            'totalUsers' => User::where('role', 'user')->count(),
            'totalBalance' => Wallets::sum('balance'),
            'totalTeslaBalance' => Wallets::sum('tesla_balance'), // Assuming "Fleet" value is here
            'totalWithdrawalsCash' => Withdrawals::where('withdrawal_method', 'cash')->where('withdrawal_method', 'bank')->where('status', 'completed')->sum('amount'),
            'totalWithdrawalsCar' => Withdrawals::where('withdrawal_method', 'car')->where('status', 'completed')->sum('amount'),
            'users' => User::where('role', 'user')->with('wallet')->latest()->paginate(10),
        ]);
    }
}
