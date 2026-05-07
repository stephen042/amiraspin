<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\SpinHistories as SpinHistoriesModel;
use Illuminate\Support\Facades\Auth;

class SpinHistory extends Component
{

    public $histories = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->histories = SpinHistoriesModel::with('spinResult')
                ->where('user_id', Auth::id())
                ->latest()
                ->take(10)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.users.spin-history');
    }
}
