<x-layouts::app :title="__('Dashboard')">
    <div class="dashboard-layout">

        <div class="stats-container bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/10 shadow-sm">
            <div class="stats-grid">
                <div class="stat-item border-b md:border-b-0 md:border-r border-zinc-100 dark:border-white/5">
                    <div class="stat-meta">
                        <span class="label text-orange-500">Total Cash Portfolio</span>
                        <h3 class="value text-zinc-900 dark:text-white">${{ number_format(auth()->user()->wallet->balance, 2) }}</h3>
                        <p class="sub-text text-zinc-500">Available for withdrawal</p>
                    </div>
                    <div class="icon-box bg-orange-500/10 text-orange-500">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>

                <div class="stat-item relative">
                    <div class="stat-meta relative z-10">
                        <span class="label text-zinc-500">Asset Bal</span>
                        <h3 class="value text-zinc-900 dark:text-white">{{ number_format(auth()->user()->wallet->tesla_balance, 0) }} <span
                                class="text-sm opacity-50 font-normal">Assets </span></h3>
                    </div>
                    <div class="car-anchor">
                        <img src="{{ asset('assets/images/beastimages/tesla.jpg') }}" alt="Tesla"
                            class="car-img opacity-40 dark:opacity-20">
                    </div>
                </div>
            </div>
        </div>

        <div class="action-section">
            <a href="{{ route('spin') }}"
                class="spin-banner bg-orange-500 hover:bg-orange-600 text-white shadow-lg shadow-orange-500/20">
                <div class="banner-content">
                    <i class="fas fa-dharmachakra wheel-spin"></i>
                    <div class="text-group">
                        <h2 class="text-3xl md:text-5xl font-black italic tracking-tighter">SPIN NOW</h2>
                        <p class="text-[10px] font-bold tracking-[0.4em] uppercase opacity-80">Win Instant Rewards</p>
                    </div>
                    <i class="fas fa-bolt text-yellow-300 animate-pulse hidden md:block"></i>
                </div>
            </a>
        </div>
        
        <livewire:users.spin-history />

    </div>
</x-layouts::app>

<style>
    /* LAYOUT & SPACING (No text/bg colors here to respect Flux) */
    .dashboard-layout {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        /* padding: 1rem; */
        max-width: 80rem;
        margin: 0 auto;
    }

    /* Stats Section */
    .stats-container {
        border-radius: 1.5rem;
        overflow: hidden;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
    }

    @media (min-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .stat-item {
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .value {
        font-size: 1.25rem;
        font-weight: 900;
        line-height: 1;
        margin: 0.5rem 0;
    }

    .icon-box {
        width: 3.5rem;
        height: 3.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 1rem;
        font-size: 1.5rem;
    }

    .car-anchor {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 12rem;
        pointer-events: none;
    }

    .car-img {
        width: 100%;
        object-fit: contain;
        transform: translate(15%, 15%);
        transition: transform 0.5s ease;
    }

    .stat-item:hover .car-img {
        transform: translate(0, 0) scale(1.05);
    }

    /* Spin Banner */
    .spin-banner {
        display: block;
        padding: 1.5rem 1rem;
        border-radius: 1.5rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .banner-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    .wheel-spin {
        font-size: 3rem;
        animation: spin-anim 12s linear infinite;
    }

    /* Table & History */
    .history-card {
        border-radius: 1.5rem;
        overflow: hidden;
    }

    .card-header {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .withdraw-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.75rem;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.05em;
    }

    .win-badge {
        padding: 0.25rem 0.6rem;
        border-radius: 0.375rem;
        font-size: 0.65rem;
        font-weight: 900;
    }

    @keyframes spin-anim {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>