<x-layouts::app :title="__('WITHDRAW')">
    <style>
        /* Base Container */
        .withdraw-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* background-color: #0f172a; */
            /* Slate 900 */
            padding: 20px;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* The Card */
        .withdraw-card {
            width: 100%;
            max-width: 500px;
            background: #1e293b;
            /* Slate 800 */
            border-radius: 16px;
            border: 1px solid #334155;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            color: #ffffff;
        }

        .card-header {
            padding: 24px;
            background: rgba(30, 41, 59, 0.5);
            border-bottom: 1px solid #334155;
        }

        .card-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .card-header p {
            margin: 8px 0 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .card-body {
            padding: 24px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #cbd5e1;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: #0f172a;
            border: 1px solid #475569;
            border-radius: 8px;
            color: #ffffff;
            font-size: 16px;
            box-sizing: border-box;
            /* Critical for full width */
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #3b82f6;
        }

        /* Conditional Section Styling */
        .conditional-section {
            background: rgba(15, 23, 42, 0.4);
            padding: 16px;
            border-radius: 12px;
            border: 1px dashed #475569;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: #3b82f6;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.1s, background 0.2s;
        }

        .btn-submit:hover {
            background: #2563eb;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .card-footer {
            padding: 16px;
            text-align: center;
            background: rgba(15, 23, 42, 0.2);
            color: #64748b;
            font-size: 12px;
            font-style: italic;
        }

        /* Utilities */
        [x-cloak] {
            display: none !important;
        }

        /* ================= MOBILE RESPONSIVENESS ================= */
        @media (max-width: 640px) {

            .withdraw-page {
                padding: 12px;
                align-items: flex-start;
                /* prevents vertical squash */
                margin-top: 10px;
            }

            .withdraw-card {
                max-width: 100%;
                border-radius: 12px;
            }

            .card-header {
                padding: 16px;
            }

            .card-header h2 {
                font-size: 20px;
            }

            .card-header p {
                font-size: 13px;
            }

            .card-body {
                padding: 16px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                font-size: 13px;
            }

            .form-control {
                padding: 10px 14px;
                font-size: 14px;
                border-radius: 6px;
            }

            .conditional-section {
                padding: 12px;
                border-radius: 10px;
            }

            .section-title {
                font-size: 10px;
            }

            .btn-submit {
                padding: 14px;
                font-size: 15px;
                border-radius: 6px;
                position: sticky;
                bottom: 0;
            }

            .card-footer {
                padding: 12px;
                font-size: 11px;
            }
        }
    </style>

    <div class="withdraw-page">
        <div class="withdraw-card" x-data="{ method: 'bank' }">

            <div class="card-header">
                <h2>Withdrawal Request</h2>
                <p>Choose your preferred method to claim your prize.</p>
            </div>

            <livewire:users.withdrawal-form />

            <div class="card-footer">
                Processing may take 3-5 business days depending on the method.
            </div>
        </div>
    </div>
</x-layouts::app>
