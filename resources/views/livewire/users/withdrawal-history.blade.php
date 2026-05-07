<div>
    <div class="history-wrapper">
        <div class="container-wide">

            <div class="history-header">
                <div>
                    <h1>Withdrawal History</h1>
                    <p>Track your prize claims and bank transfers.</p>
                </div>

                <div class="header-controls">
                    <select wire:model.live="status" class="status-select">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>

                    <a href="/withdraw" wire:navigate class="btn-new">
                        + New Request
                    </a>
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Amount / Units</th>
                                <th>Destination Details</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $withdrawal)
                                <tr>
                                    <td>
                                        <div class="date-sub">{{ $withdrawal->created_at->format('M d, Y • h:i A') }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="method-badge">{{ $withdrawal->withdrawal_method }}</span>
                                    </td>
                                    <td>
                                        @if ($withdrawal->withdrawal_method === 'car')
                                            <span
                                                class="amount-text unit-purple">{{ $withdrawal->delivery_details['quantity'] ?? 1 }}</span>
                                            <span class="date-sub" style="text-transform: uppercase;">Units</span>
                                        @else
                                            <span
                                                class="amount-text currency-emerald">${{ number_format($withdrawal->amount, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($withdrawal->withdrawal_method === 'bank')
                                            <div class="details-box">
                                                <div class="details-main">
                                                    {{ $withdrawal->bank_details['bank_name'] ?? 'N/A' }}</div>
                                                <div style="font-family: monospace;">
                                                    {{ $withdrawal->bank_details['account_number'] ?? 'N/A' }}</div>
                                            </div>
                                        @else
                                            <div class="details-box" style="font-style: italic; max-width: 180px;">
                                                {{ $withdrawal->delivery_details['address'] ?? 'No address provided' }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="status-pill status-{{ $withdrawal->status }}">
                                            {{ $withdrawal->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding: 4rem; text-align: center;">
                                        <div style="font-size: 2.5rem; color: #475569; margin-bottom: 0.75rem;">📁</div>
                                        <p style="color: #64748b; font-size: 0.875rem;">No withdrawals found in this
                                            category.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($withdrawals->hasPages())
                    <div class="pagination-footer">
                        {{ $withdrawals->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
