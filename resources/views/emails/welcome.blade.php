<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }
    </style>
</head>

<body
    style="background-color: #0f172a; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 0; width: 100%;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="inner-body" width="570" cellpadding="0" cellspacing="0" role="presentation"
                    style="background-color: #1e293b; border-radius: 8px; margin: 30px auto; padding: 40px; border: 1px solid #334155;">
                    <tr>
                        <td style="padding-bottom: 20px; text-align: center;">
                            <h1
                                style="color: #ffffff; font-size: 24px; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
                                Welcome to the Inner Circle!
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="color: #94a3b8; font-size: 16px; line-height: 1.6; text-align: left;">
                            <p>Hello <strong>{{ $user->name }}</strong>,</p>
                            <p>We are thrilled to have you on board. At <strong>{{ config('app.name') }}</strong>, we
                                believe in creating opportunities and rewarding our community. Your account is now fully
                                active and ready for action.</p>

                            <div
                                style="background-color: #0f172a; border-left: 4px solid #6366f1; margin: 25px 0; padding: 20px; color: #e2e8f0; font-style: italic;">
                                <strong>Quick Tip:</strong> Check your dashboard daily to see if you have new Spin
                                Allocations waiting for you!
                            </div>

                            <h3 style="color: #f8fafc; margin-top: 30px;">What's Next?</h3>
                            <ul style="padding-left: 20px;">
                                <li style="margin-bottom: 10px;"><strong>Complete your profile</strong> to ensure smooth
                                    withdrawals.</li>
                                <li style="margin-bottom: 10px;"><strong>Explore the Spin Engine</strong> and see what
                                    prizes are waiting.</li>
                                <li style="margin-bottom: 10px;"><strong>Join our community</strong> for updates and
                                    exclusive offers.</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding-top: 30px;">
                            <a href="{{ config('app.url') . '/dashboard' }}"
                                style="background-color: #6366f1; border-radius: 6px; color: #ffffff; display: inline-block; font-size: 16px; font-weight: bold; padding: 14px 30px; text-decoration: none; text-transform: uppercase;">
                                Go to My Dashboard
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="color: #64748b; font-size: 14px; padding-top: 40px; text-align: center; border-top: 1px solid #334155; margin-top: 30px;">
                            <p>If you have any questions, simply reply to this email. Our support team is always here to
                                help.</p>
                            <p style="margin-top: 10px; font-weight: bold; color: #94a3b8;">
                                Stay Lucky,<br>
                                The {{ config('app.name') }} Team
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
