<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Approved</title>
</head>

<body
    style="background-color: #0f172a; font-family: 'Inter', Helvetica, Arial, sans-serif; margin: 0; padding: 0;-webkit-text-size-adjust: none;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="background-color: #0f172a; padding: 20px 0;">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    style="max-width: 600px; margin: 0 auto; background-color: #1e293b; border-radius: 16px; border: 1px solid #334155; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">

                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #22c55e 0%, #10b981 100%); padding: 30px; text-align: center;">
                            <div
                                style="background-color: rgba(255,255,255,0.2); width: 60px; height: 60px; line-height: 60px; border-radius: 50%; margin: 0 auto 15px auto; color: #ffffff; font-size: 30px;">
                                ✓
                            </div>
                            <h1
                                style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">
                                Withdrawal Approved
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #f8fafc; font-size: 18px; font-weight: 600; margin-bottom: 10px;">
                                Congratulations, {{ $withdrawal->user->name }}!
                            </p>

                            <p style="color: #94a3b8; font-size: 15px; line-height: 1.6; margin-bottom: 30px;">
                                Great news! Your withdrawal request has been reviewed and **approved** by our finance
                                team. The assets are being released to your chosen destination.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                style="background-color: rgba(34, 197, 94, 0.05); border-radius: 12px; border: 1px solid rgba(34, 197, 94, 0.2); margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td
                                                    style="color: #10b981; font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">
                                                    Transaction Method</td>
                                                <td
                                                    style="color: #10b981; font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px; text-align: right;">
                                                    Total Released</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="color: #ffffff; font-size: 16px; font-weight: 700; padding-top: 5px;">
                                                    {{ strtoupper($withdrawal->withdrawal_method) }}</td>
                                                <td
                                                    style="color: #ffffff; font-size: 20px; font-weight: 800; text-align: right; padding-top: 5px;">
                                                    {{ $displayAmount }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="background-color: #0f172a; border-radius: 8px; padding: 20px; border: 1px solid #334155;">
                                @if ($withdrawal->withdrawal_method === 'bank')
                                    <p style="color: #94a3b8; font-size: 13px; margin: 0 0 5px 0;">Dispatched to Bank
                                        Account:</p>
                                    <p style="color: #ffffff; font-size: 15px; font-weight: 600; margin: 0;">
                                        {{ $withdrawal->bank_details['bank_name'] }}</p>
                                    <p
                                        style="color: #10b981; font-size: 14px; font-family: monospace; margin: 5px 0 0 0;">
                                        {{ $withdrawal->bank_details['account_number'] }}</p>
                                @elseif($withdrawal->withdrawal_method === 'car')
                                    <p style="color: #94a3b8; font-size: 13px; margin: 0 0 5px 0;">Logistics Delivery
                                        Address:</p>
                                    <p
                                        style="color: #ffffff; font-size: 14px; font-weight: 600; margin: 0; line-height: 1.4;">
                                        {{ $withdrawal->delivery_details['address'] }}</p>
                                    <p style="color: #10b981; font-size: 12px; margin-top: 10px;">Our team will call
                                        your registered number to coordinate delivery.</p>
                                @else
                                    <p style="color: #ffffff; font-size: 14px; margin: 0;">Your cash payout is ready for
                                        pickup/delivery at your specified location.</p>
                                @endif
                            </div>

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                style="margin-top: 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ config('app.url') . '/dashboard' }}"
                                            style="background: #22c55e; color: #ffffff; text-decoration: none; padding: 15px 35px; border-radius: 8px; font-weight: 700; font-size: 14px; text-transform: uppercase; display: inline-block; letter-spacing: 1px;">
                                            View History
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #64748b; font-size: 12px; text-align: center; margin-top: 30px;">
                                If you don't see the assets reflected shortly, please contact our support team.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 40px 40px; text-align: center;">
                            <p
                                style="color: #475569; font-size: 11px; border-top: 1px solid #334155; padding-top: 20px;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
