<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Request</title>
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
                            style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); padding: 30px; text-align: center;">
                            <h1
                                style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">
                                {{ $method }} REQUEST
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #f8fafc; font-size: 18px; font-weight: 600; margin-bottom: 10px;">
                                @if ($isAdmin)
                                    Admin Notification
                                @else
                                    Hello {{ $withdrawal->user->name }},
                                @endif
                            </p>

                            <p style="color: #94a3b8; font-size: 15px; line-height: 1.6; margin-bottom: 30px;">
                                @if ($isAdmin)
                                    A new withdrawal request has been submitted and is awaiting your review in the
                                    management panel.
                                @else
                                    Your request has been successfully queued. Our finance team is currently verifying
                                    the details provided below.
                                @endif
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                style="background-color: #0f172a; border-radius: 12px; border: 1px solid #334155; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td
                                                    style="color: #64748b; font-size: 12px; text-transform: uppercase; font-weight: 700; padding-bottom: 5px;">
                                                    Asset Method</td>
                                                <td
                                                    style="color: #64748b; font-size: 12px; text-transform: uppercase; font-weight: 700; padding-bottom: 5px; text-align: right;">
                                                    Amount/Qty</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #ffffff; font-size: 16px; font-weight: 700;">
                                                    {{ $method }}</td>
                                                <td
                                                    style="color: #6366f1; font-size: 18px; font-weight: 800; text-align: right;">
                                                    {{ $displayAmount }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"
                                                    style="padding-top: 15px; border-top: 1px solid #1e293b; margin-top: 15px;">
                                                    <span
                                                        style="display: inline-block; background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; text-transform: uppercase;">
                                                        Status: Pending Review
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="background-color: rgba(255,255,255,0.02); border-radius: 8px; padding: 20px; border-left: 3px solid #6366f1;">
                                @if ($method === 'BANK')
                                    <p style="color: #94a3b8; font-size: 13px; margin: 0 0 5px 0;">Payout Destination:
                                    </p>
                                    <p style="color: #ffffff; font-size: 15px; font-weight: 600; margin: 0;">
                                        {{ $withdrawal->bank_details['bank_name'] }}</p>
                                    <p
                                        style="color: #6366f1; font-size: 14px; font-family: monospace; margin: 5px 0 0 0;">
                                        {{ $withdrawal->bank_details['account_number'] }}</p>
                                @else
                                    <p style="color: #94a3b8; font-size: 13px; margin: 0 0 5px 0;">Delivery Destination:
                                    </p>
                                    <p
                                        style="color: #ffffff; font-size: 14px; font-weight: 600; margin: 0; line-height: 1.4;">
                                        {{ $withdrawal->delivery_details['address'] }}</p>
                                @endif
                            </div>

                            @if (!$isAdmin)
                                <p style="color: #64748b; font-size: 13px; text-align: center; margin-top: 30px;">
                                    Processing time is typically <strong>24-48 hours</strong>.
                                </p>
                            @endif

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                style="margin-top: 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ config('app.url') }}"
                                            style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); color: #ffffff; text-decoration: none; padding: 15px 35px; border-radius: 8px; font-weight: 700; font-size: 14px; text-transform: uppercase; display: inline-block; letter-spacing: 1px;">
                                            Open Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 40px 40px; text-align: center;">
                            <p
                                style="color: #475569; font-size: 12px; border-top: 1px solid #334155; padding-top: 20px;">
                                This is an automated message from <strong>{{ config('app.name') }}</strong>.<br>
                                Please do not reply directly to this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
