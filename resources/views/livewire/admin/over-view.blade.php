<div class="dashboard-wrapper">

    {{-- Section 1: Stats --}}
    <div class="section-container">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold tracking-tight text-zinc-800 dark:text-white">Financial Overview</h2>
            <span class="text-xs text-zinc-400 font-medium">Real-time updates</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="stat-card-inner">
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ number_format($totalUsers) }}</div>
            </div>

            <div class="stat-card-inner">
                <div class="stat-label">Total Users Balance</div>
                <div class="stat-value">${{ number_format($totalBalance, 0) }}</div>
            </div>

            <div class="stat-card-inner">
                <div class="stat-label">Total Users Assets</div>
                <div class="stat-value text-indigo-600">{{ number_format($totalTeslaBalance, 0) }}</div>
            </div>

            <div class="stat-card-inner flex flex-col justify-between">
                <div>
                    <div class="stat-label">Total Withdrawals</div>
                    <div class="stat-value">${{ number_format($totalWithdrawalsCash, 2) }}</div>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-200 dark:border-zinc-800 flex justify-between items-center">
                    <span class="text-[0.65rem] font-black uppercase text-green-600">Cars & Gold Bars</span>
                    <span
                        class="font-bold text-sm text-green-600 dark:text-green-400">{{ number_format($totalWithdrawalsCar, 0) }}</span>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}

    <section
        style="background: var(--card-bg, #1a1a1a); border: 1px solid var(--card-border, #333); border-radius: 1.25rem; padding:       2rem; margin-top: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.5);margin-bottom: 2rem;">
        <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3
                    style="color: white; font-size: 1.1rem; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
                    System Win-Code</h3>
                <p style="color: var(--text-muted, #888); font-size: 0.7rem; margin-top: 0.25rem;">Global verification
                    key for manual prize overrides.</p>
            </div>
            <div style="background: rgba(99, 102, 241, 0.1); padding: 0.5rem; border-radius: 0.75rem;">
                <svg style="width: 20px; height: 20px; color: var(--accent-indigo, #6366f1);" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <div style="flex: 1; position: relative;">
                <input type="text" wire:model="wincode" placeholder="Enter new win code..."
                    style="width: 100%; background: rgba(255,255,255,0.03); border: 1px solid #444; border-radius: 0.75rem; padding: 0.8rem 1rem; color: white; font-family: monospace; letter-spacing: 2px; outline: none; transition: border 0.3s;"
                    onfocus="this.style.border='1px solid var(--accent-indigo, #6366f1)'"
                    onblur="this.style.border='1px solid #444'">
            </div>

            <button wire:click="updateWinCode" wire:loading.attr="disabled"
                style="background: linear-gradient(135deg, #6366f1, #a855f7); color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 0.75rem; font-weight: 700; font-size: 0.8rem; cursor: pointer; transition: transform 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <span wire:loading.remove wire:target="updateWinCode">UPDATE</span>
                <span wire:loading wire:target="updateWinCode">...</span>
            </button>
        </div>
    </section>

    {{-- Section 2: User Table --}}
    <div class="section-container !p-0 overflow-hidden">
        <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold tracking-tight text-zinc-800 dark:text-white">User Management</h2>
                <p class="text-xs text-zinc-500 mt-1">Manage and audit system participants</p>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th class="pl-6">Full Name</th>
                        <th>Email</th>
                        <th>Spin Status</th>
                        <th>Balance</th>
                        <th class="pr-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @php
                            // Determine spin status based on your logic
                            $spinStatus = 'Inactive'; // Default status
                            if ($user->spinallocations()->where('is_active', true)->exists()) {
                                $spinStatus = 'Active';
                            }
                        @endphp
                        <tr wire:key="user-{{ $user->id }}">
                            <td class="pl-6">
                                <div class="font-bold text-zinc-800 dark:text-white">{{ $user->name }}</div>
                            </td>
                            <td class="text-zinc-500">{{ $user->email }}</td>
                            <td>
                                <span
                                    style="background: {{ $spinStatus === 'Active' ? 'green' : 'red' }}; color: white; padding: 6px 8px; border-radius: 10px;font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 700;">
                                    {{ $spinStatus }}
                                </span>
                            </td>
                            <td class="font-mono font-bold">
                                ${{ number_format($user->wallet->balance ?? 0, 2) }}
                            </td>
                            <td class="pr-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.edit-user', $user) }}" class="btn-manage"
                                        style="padding: 4px 10px; font-size: 10px; border: 1px solid; border-radius: 4px; text-decoration: none;">MANAGE</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-zinc-100 dark:border-zinc-800">
            {{ $users->links() }}
        </div>
    </div>
</div>
