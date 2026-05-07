<x-layouts::admin :title="__('Edit User')">
    <style>
        :root {
            --bg-dark: #0f1115;
            --card-glass: rgba(255, 255, 255, 0.03);
            --card-border: rgba(255, 255, 255, 0.08);
            --accent-indigo: #6366f1;
            --accent-violet: #8b5cf6;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        /* Base Container */
        .admin-wrapper {
            background-color: transparent;
            color: var(--text-main);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            /* padding: 2rem 1rem; */
            min-height: 100vh;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Common Card Styling */
        .module-card {
            background: var(--card-glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--card-border);
            border-radius: 1.5rem;
            margin-bottom: 2rem;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .module-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .module-title {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
        }

        /* Profile Section */
        .profile-hero {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 2rem;
        }

        .avatar-circle {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--accent-indigo), var(--accent-violet));
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 900;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .user-meta h1 {
            font-size: 1.5rem;
            margin: 0;
            font-weight: 800;
        }

        .user-meta p {
            color: var(--text-muted);
            margin: 0.2rem 0;
            font-size: 0.9rem;
        }

        /* Inputs & Buttons */
        .form-group {
            display: flex;
            gap: 1rem;
            padding: 2rem;
            flex-wrap: wrap;
        }

        .premium-input {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--card-border);
            color: white;
            padding: 0.8rem 1.2rem;
            border-radius: 0.75rem;
            flex: 1;
            min-width: 150px;
            outline: none;
            transition: border 0.3s ease;
        }

        .premium-input:focus {
            border-color: var(--accent-indigo);
        }

        .btn-solid {
            background: white;
            color: black;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .btn-solid:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .btn-outline-danger {
            background: transparent;
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--danger);
            padding: 0.6rem 1.2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
        }

        /* Wallet Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
            padding: 0 2rem 2rem 2rem;
        }

        .stat-pill {
            background: rgba(255, 255, 255, 0.02);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid var(--card-border);
        }

        .stat-val {
            font-size: 1.5rem;
            font-weight: 800;
            display: block;
            margin-top: 0.5rem;
        }

        /* Custom Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.1);
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: var(--accent-indigo);
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        /* Queue Items */
        .queue-container {
            padding: 0 2rem 2rem 2rem;
        }

        .queue-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.02);
            padding: 1rem;
            border-radius: 1rem;
            margin-bottom: 0.75rem;
            border: 1px solid var(--card-border);
        }

        .queue-item.used {
            opacity: 0.4;
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
        }

        .premium-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .premium-table th {
            padding: 1.25rem 2rem;
            background: rgba(255, 255, 255, 0.02);
            color: var(--text-muted);
            font-size: 0.7rem;
        }

        .premium-table td {
            padding: 1.25rem 2rem;
            border-top: 1px solid var(--card-border);
            font-size: 0.85rem;
        }

        .status-chip {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-chip.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-chip.completed {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .admin-wrapper {
                padding: 1rem 0.5rem;
            }

            /* Reduce header padding and stack hero content */
            .profile-hero {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
                gap: 1rem;
            }

            .avatar-circle {
                width: 60px;
                height: 60px;
            }

            /* Stack stats vertically on small screens */
            .stats-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem 1.5rem 1rem;
            }

            .stat-pill {
                padding: 1.2rem;
            }

            /* Make form groups stack vertically */
            .form-group {
                flex-direction: column;
                padding: 1.5rem 1rem;
                gap: 0.8rem;
            }

            .premium-input,
            .btn-solid {
                width: 100%;
                min-width: unset;
                flex: none;
            }

            /* Adjust Spin Engine controls for mobile */
            .module-header {
                padding: 1rem 1.5rem;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .queue-container {
                padding: 0 1rem 1.5rem 1rem;
            }

            /* Refine table display for small screens */
            .premium-table th,
            .premium-table td {
                padding: 1rem;
                font-size: 0.75rem;
            }

            /* Optional: Hide less important columns on very small screens */
            @media (max-width: 480px) {

                .premium-table th:nth-child(4),
                .premium-table td:nth-child(4) {
                    display: none;
                }

                .user-meta h1 {
                    font-size: 1.25rem;
                }
            }
        }
    </style>

    {{-- This forces the string ID to become a User model before hitting Livewire --}}
    <livewire:admin.edit-user :user="\App\Models\User::findOrFail($user)" />
</x-layouts::admin>
