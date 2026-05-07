<div class="history-card bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/10 shadow-sm">
    <div class="card-header border-b border-zinc-100 dark:border-white/5 flex justify-between items-center p-4">
        <div class="title-group">
            <h4 class="text-zinc-900 dark:text-white font-bold uppercase tracking-tight">Recent Activity</h4>
            <p class="text-xs text-zinc-500 italic">Live results</p>
        </div>
        <a href="{{ route('withdraw') }}"
            class="withdraw-btn border border-orange-500/50 text-orange-500 hover:bg-orange-500 hover:text-white transition-all px-4 py-1 rounded text-sm font-bold">
            WITHDRAW
        </a>
    </div>

    <div class="table-wrapper overflow-x-auto" style="padding: 5px;">
        <table class="w-full" style="border-spacing: 0 12px; border-collapse: separate;">
            <thead>
                <tr
                    style="color: #a1a1aa; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em;">
                    <th style="padding: 10px 24px; text-align: left;">Timestamp</th>
                    <th style="padding: 10px 24px; text-align: left;">Event</th>
                    <th style="padding: 10px 24px; text-align: center;">Asset Preview</th>
                    <th style="padding: 10px 24px; text-align: right;">Net Profit</th>
                </tr>
            </thead>

            <tbody style="color: inherit;">
                @forelse($histories as $history)
                    @php
                        // Logic to determine row style based on result type
                        $isJackpot = $history->result_label === 'TESLA CAR';
                        $isLoss = $history->amount <= 0;
                    @endphp
                    <tr class="group transition-all duration-300 {{ $isJackpot ? 'hover:translate-y-[-2px]' : 'hover:bg-white/[0.02]' }}"
                        style="{{ $isJackpot ? 'background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); border-radius: 16px;' : 'background: transparent;' }}">

                        {{-- Timestamp --}}
                        <td
                            style="padding: 20px 24px; border-radius: 16px 0 0 16px; {{ $isJackpot ? 'border: 1px solid rgba(255,255,255,0.05); border-right: none;' : '' }} {{ $isLoss ? 'opacity: 0.5;' : '' }}">
                            <div style="font-size: 13px; font-weight: 600;">{{ $history->created_at->format('M d, Y') }}
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
                                    } else {
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
                            @else
                                <div
                                    style="font-size: 16px; font-weight: 800; color: {{ $isLoss ? '#ea3737' : '#22c55e' }}; {{ $isLoss ? 'opacity: 0.8;' : '' }}">
                                    {{ $isLoss ? '-' : '+' }}${{ number_format(abs($history->amount), 2) }}
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-zinc-500 italic">No activity recorded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
