<div>
    <form wire:submit.prevent="submitRequest" class="card-body">
        {{-- Method Selector --}}
        <div class="form-group">
            <label class="form-label">Withdrawal Method</label>
            <select wire:model.live="method" class="form-control">
                <option value="bank">Bank Withdrawal</option>
                <option value="cash">Cash Delivery</option>
                <option value="car">Delivery (Cars & Gold Bars)</option>
            </select>
            <div class="card-footer" style="background: rgba(255,255,255,0.05); margin-top: 10px;">
                @if ($method === 'car')
                    Available Assets: <strong>{{ auth()->user()->wallet->tesla_balance }}</strong>
                @else
                    Available Balance: <strong>${{ number_format(auth()->user()->wallet->balance, 2) }}</strong>
                @endif
            </div>
        </div>

        {{-- 1. Bank Section --}}
        <div x-show="$wire.method === 'bank'" x-cloak class="conditional-section">
            <div class="section-title" style="color: #60a5fa;">Bank Account Details</div>
            <div class="form-group">
                <input type="number" wire:model="amount" placeholder="Amount to Withdraw ($)" class="form-control">
                @error('amount')
                    <span style="color: #f87171; font-size: 11px;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" wire:model="bank_name" placeholder="Bank Name" class="form-control">
                @error('bank_name')
                    <span style="color: #f87171; font-size: 11px;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <input type="text" wire:model="account_number" placeholder="Account Number" class="form-control">
                @error('account_number')
                    <span style="color: #f87171; font-size: 11px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- 2. Cash Section --}}
        <div x-show="$wire.method === 'cash'" x-cloak class="conditional-section">
            <div class="section-title" style="color: #4ade80;">Physical Cash Delivery</div>
            <div class="form-group">
                <input type="number" wire:model="amount" placeholder="Withdraw Amount ($)" class="form-control">
                @error('amount')
                    <span style="color: #f87171; font-size: 11px;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <textarea wire:model="address" placeholder="Your Full Delivery Address" rows="3" class="form-control"></textarea>
                @error('address')
                    <span style="color: #f87171; font-size: 11px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- 3. Car Section --}}
        <div x-show="$wire.method === 'car'" x-cloak class="conditional-section">
            <div class="section-title" style="color: #c084fc;">Tesla Vehicle Logistics</div>
            <div class="form-group">
                <label class="form-label" style="font-size: 11px;">Quantity</label>
                <input type="number" wire:model="quantity" class="form-control">
                @error('quantity')
                    <span style="color: #f87171; font-size: 11px;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <textarea wire:model="address" placeholder="Shipping Address for Vehicle Delivery" rows="3" class="form-control"></textarea>
                @error('address')
                    <span style="color: #f87171; font-size: 11px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-submit" wire:loading.attr="disabled">
            <span wire:loading.remove>CONFIRM WITHDRAWAL</span>
            <span wire:loading>PROCESSING...</span>
        </button>
    </form>
</div>
