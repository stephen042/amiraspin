<x-layouts::app :title="__('Withdrawal History')">
    <style>
        /* Container & Background */
        .history-wrapper {
            /* background-color: #0f172a; */
            /* bg-slate-900 */
            min-height: 100vh;
            /* padding: 2rem 1rem; */
            color: #f8fafc;
            font-family: sans-serif;
        }

        .container-wide {
            max-width: 1152px;
            margin: 0 auto;
        }

        /* Header Section */
        .history-header {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .history-header {
                flex-direction: row;
                align-items: center;
            }
        }

        .history-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .history-header p {
            color: #94a3b8;
            font-size: 0.875rem;
            margin: 0.25rem 0 0;
        }

        /* Controls (Select & Button) */
        .header-controls {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .status-select {
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #cbd5e1;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            outline: none;
        }

        .btn-new {
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            padding: 0.6rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 700;
            transition: background 0.2s;
        }

        .btn-new:hover {
            background-color: #1d4ed8;
        }

        /* Table Styling */
        .table-card {
            background-color: #1e293b;
            /* bg-slate-800 */
            border-radius: 1rem;
            border: 1px solid #334155;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead tr {
            background-color: rgba(15, 23, 42, 0.5);
            border-bottom: 1px solid #334155;
        }

        th {
            padding: 1.25rem 1.5rem;
            color: #94a3b8;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(51, 65, 85, 0.5);
            vertical-align: middle;
        }

        tr:hover {
            background-color: rgba(51, 65, 85, 0.2);
        }

        /* Data Elements */
        .ref-id {
            color: #ffffff;
            font-weight: 500;
        }

        .date-sub {
            font-size: 0.75rem;
            color: #64748b;
        }

        .method-badge {
            padding: 0.25rem 0.5rem;
            background: #0f172a;
            color: #60a5fa;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid rgba(96, 165, 250, 0.2);
            border-radius: 4px;
        }

        .amount-text {
            font-size: 1.125rem;
            font-weight: 700;
        }

        .currency-emerald {
            color: #34d399;
        }

        .unit-purple {
            color: #c084fc;
        }

        .details-box {
            font-size: 0.75rem;
            line-height: 1.5;
            color: #94a3b8;
        }

        .details-main {
            color: #e2e8f0;
            font-weight: 600;
        }

        /* Status Badges */
        .status-pill {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            border: 1px solid transparent;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
            border-color: rgba(245, 158, 11, 0.3);
        }

        .status-processing {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-color: rgba(59, 130, 246, 0.3);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .status-rejected {
            background: rgba(244, 63, 94, 0.1);
            color: #f43f5e;
            border-color: rgba(244, 63, 94, 0.3);
        }

        /* Pagination */
        .pagination-footer {
            padding: 1rem 1.5rem;
            background: rgba(15, 23, 42, 0.3);
            border-top: 1px solid #334155;
        }
    </style>
    <div class="max-w-6xl">
        <livewire:users.withdrawal-history />
    </div>
</x-layouts::app>
