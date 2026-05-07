<?php
namespace App\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class WithdrawalForm extends Component
{
    public $method = 'bank';
    public $amount;
    public $bank_name;
    public $account_number;
    public $address;
    public $quantity = 1;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'method' => 'required|in:bank,cash,car',
            'amount' => $this->method === 'bank' || $this->method === 'cash' ? 'required|numeric|min:1' : '',
            'bank_name' => $this->method === 'bank' ? 'required|string' : '',
            'account_number' => $this->method === 'bank' ? 'required|string' : '',
            'address' => ($this->method === 'cash' || $this->method === 'car') ? 'required|string|min:10' : '',
            'quantity' => $this->method === 'car' ? 'required|integer|min:1' : '',
        ]);
    }

    public function mount()
    {
        // return $this->dispatch('error', message: 'Wallet not found. Please contact support.');
        // Initialize default values if needed
        $this->method = 'bank';
    }

    public function submitRequest()
    {
        // 1. Define Basic Validation Rules
        $rules = [
            'method' => 'required|in:bank,cash,car',
        ];

        if ($this->method === 'bank') {
            $rules['amount'] = 'required|numeric|min:1';
            $rules['bank_name'] = 'required|string';
            $rules['account_number'] = 'required|string';
        } elseif ($this->method === 'cash') {
            $rules['amount'] = 'required|numeric|min:1';
            $rules['address'] = 'required|string|min:10';
        } elseif ($this->method === 'car') {
            $rules['quantity'] = 'required|integer|min:1';
            $rules['address'] = 'required|string|min:10';
        }

        $validatedData = $this->validate($rules);

        // 2. Wallet & Balance Verification
        $wallet = Auth::user()->wallet;

        if (!$wallet) {
            $this->dispatch('error', message: 'Wallet not found. Please contact support.');
            return;
        }

        if ($this->method === 'bank' || $this->method === 'cash') {
            if ($wallet->balance < $this->amount) {
                $this->dispatch('error', message: 'Not enough cash in your balance!');
                return;
            }
        }

        if ($this->method === 'car') {
            if ($wallet->tesla_balance < $this->quantity) {
                $this->dispatch('error', message: 'Insufficient Tesla units in your account!');
                return;
            }
        }

        // 3. Success: Store in session and proceed to PIN
        Session::put('pending_withdrawal', $validatedData);

        return redirect()->route('pin');
    }

    public function render()
    {
        return view('livewire.users.withdrawal-form');
    }
}
