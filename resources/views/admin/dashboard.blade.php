<x-layouts::admin :title="__('Overview')">
    <style>
        /* Modern Premium Variables & Global Style */
        .dashboard-wrapper {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            color: var(--color-zinc-900);
            background-color: var(--color-zinc-50);
            min-height: 100vh;
        }

        .dark .dashboard-wrapper {
            color: var(--color-zinc-100);
            background-color: transparent;
            /* zinc-950 */
        }

        /* Section Master Cards */
        .section-container {
            background: #ffffff;
            border: 1px solid var(--color-zinc-200);
            border-radius: 16px;
            padding: 1.5rem;
            /* Layered shadow for premium feel */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 10px 20px -5px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .dark .section-container {
            background: var(--color-zinc-900);
            border-color: var(--color-zinc-800);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        /* Inner "Beast" Stat Cards */
        .stat-card-inner {
            background: var(--color-zinc-50);
            border: 1px solid var(--color-zinc-200);
            border-radius: 12px;
            padding: 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark .stat-card-inner {
            background: #18181b;
            /* zinc-900 */
            border-color: var(--color-zinc-800);
        }

        .stat-card-inner:hover {
            transform: translateY(-4px);
            background: #ffffff;
            border-color: var(--color-zinc-300);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .dark .stat-card-inner:hover {
            background: var(--color-zinc-800);
            border-color: var(--color-zinc-700);
        }

        /* Typography */
        .stat-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--color-zinc-500);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-top: 0.5rem;
        }

        /* Table Styling */
        .premium-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .premium-table th {
            text-align: left;
            padding: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--color-zinc-400);
            border-bottom: 1px solid var(--color-zinc-100);
        }

        .dark .premium-table th {
            border-bottom-color: var(--color-zinc-800);
        }

        .premium-table td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid var(--color-zinc-50);
        }

        .dark .premium-table td {
            border-bottom-color: var(--color-zinc-800/50);
        }

        .badge-pill {
            background: #dcfce7;
            color: #15803d;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .dark .badge-pill {
            background: rgba(34, 197, 94, 0.1);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
    </style>

    <livewire:admin.over-view />

</x-layouts::admin>
