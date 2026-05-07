<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Withdrawals;
use Illuminate\Support\Facades\Auth;

class WithdrawalHistory extends Component
{
    use WithPagination;

    // Optional: Filter by status
    public $status = '';

    protected $queryString = ['status'];

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Withdrawals::where('user_id', Auth::id())
            ->latest();

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return view('livewire.users.withdrawal-history', [
            'withdrawals' => $query->paginate(10)
        ]);
    }
}
