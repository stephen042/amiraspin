<x-layouts::app :title="__('Withdrawal PIN Verification')">
    <style>
        .verify-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* background-color: #0f172a; */
            padding: 20px;
            font-family: 'Inter', sans-serif;
            /* color: #ffffff; */
        }

        .verify-card {
            width: 100%;
            max-width: 450px;
            /* background: #212f45; */
            border-radius: 20px;
            /* border: 1px solid #334155; */
            padding: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Progress Bar Styling */
        .progress-container {
            width: 100%;
            height: 6px;
            background: #0f172a;
            border-radius: 10px;
            margin: 20px 0 30px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            width: 0%;
            transition: width 0.1s linear;
        }

        /* Form Inputs */
        .input-group {
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-field {
            width: 100%;
            padding: 14px;
            /* background: #0f172a; */
            border: 1px solid #334155;
            border-radius: 10px;
            /* color: white; */
            font-size: 18px;
            letter-spacing: 4px;
            text-align: center;
            outline: none;
        }

        .input-field:focus {
            border-color: #3b82f6;
        }

        .btn-verify {
            width: 100%;
            padding: 16px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-verify:disabled {
            background: #334155;
            cursor: not-allowed;
        }

        [x-cloak] {
            display: none !important;
        }

        /* ================= MOBILE RESPONSIVENESS ================= */
        @media (max-width: 640px) {

            .verify-page {
                padding: 12px;
                align-items: flex-start;
                /* prevents vertical squeeze */
                /* min-height: 100dvh; */
                max-height: 100dvh;
                /* better mobile height handling */
            }

            .verify-card {
                max-width: 100%;
                padding: 20px;
                border-radius: 14px;
            }

            /* Progress Bar */
            .progress-container {
                height: 5px;
                margin: 16px 0 24px;
            }

            /* Inputs */
            .input-group {
                margin-bottom: 16px;
            }

            .input-label {
                font-size: 11px;
                margin-bottom: 6px;
            }

            .input-field {
                padding: 12px;
                font-size: 16px;
                letter-spacing: 3px;
                border-radius: 8px;
            }

            /* Button */
            .btn-verify {
                padding: 14px;
                font-size: 15px;
                border-radius: 8px;
            }
        }
    </style>

    <livewire:users.pin-verification />
    
</x-layouts::app>
