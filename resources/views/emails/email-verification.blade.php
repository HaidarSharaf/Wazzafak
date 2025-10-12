<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #1750b6 0%, #84cc16 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.95;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .otp-container {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 3px dashed #1750b6;
            border-radius: 12px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
        }
        .otp-label {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .otp-code {
            font-size: 48px;
            font-weight: bold;
            color: #1750b6;
            letter-spacing: 8px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
        }
        .otp-expiry {
            font-size: 13px;
            color: #666;
            margin-top: 15px;
        }
        .warning-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            display: flex;
            align-items: start;
            gap: 10px;
        }
        .warning-icon {
            color: #ffc107;
            font-size: 24px;
            flex-shrink: 0;
        }
        .warning-text {
            font-size: 14px;
            color: #856404;
            margin: 0;
        }
        .security-tips {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .security-tips h3 {
            margin: 0 0 15px 0;
            color: #1750b6;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .security-tips ul {
            margin: 0;
            padding-left: 20px;
        }
        .security-tips li {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }
        .footer {
            background: #f9f9f9;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e5e5e5;
        }
        .footer p {
            margin: 5px 0;
            font-size: 13px;
            color: #999;
        }
        .footer .company-name {
            color: #1750b6;
            font-weight: bold;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e5e5, transparent);
            margin: 25px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Email Verification</h1>
        <p>Secure your account with one-time password</p>
    </div>

    <div class="content">
        <div class="greeting">
            Hello <strong>{{ $user->name ?? 'User' }}</strong>,
        </div>

        <p style="font-size: 15px; color: #555; margin-bottom: 20px;">
            Thank you for registering with <strong style="color: #1750b6;">&lt;Wazzafak /&gt;</strong>!
            To complete your registration and verify your email address, please use the one-time password (OTP) below:
        </p>

        <div class="otp-container">
            <div class="otp-label">Your Verification Code</div>
            <div class="otp-code">{{ $otp }}</div>
            <div class="otp-expiry">
                 Expires at <strong>{{ $expiresAt }}</strong> (10 minutes)
            </div>
        </div>

        <div class="warning-box">
            <div class="warning-icon">⚠️</div>
            <div class="warning-text">
                <strong>Important:</strong> This code will expire in 10 minutes.
                If it expires, you can request a new verification code.
            </div>
        </div>

        <div class="divider"></div>

        <div class="security-tips">
            <h3>Security Tips</h3>
            <ul>
                <li><strong>Never share</strong> this code with anyone, including our support team</li>
                <li><strong>We will never ask</strong> for your OTP via phone, email, or social media</li>
                <li><strong>If you didn't request</strong> this code, someone may be trying to access your account. Please change your password immediately</li>
                <li><strong>Use the code only</strong> on the official &lt;Wazzafak /&gt; website or app</li>
            </ul>
        </div>

        <div class="divider"></div>

        <p style="font-size: 14px; color: #888; margin-top: 20px;">
            If you didn't create an account with &lt;Wazzafak /&gt;, you can safely ignore this email.
            Your email address will not be used without your confirmation.
        </p>
    </div>

    <div class="footer">
        <p>
            <span class="company-name">{{ config('app.name') }}</span> - Connecting Developers & Recruiters
        </p>
        <p style="margin-top: 10px;">
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </p>
        <p style="margin-top: 10px; font-size: 12px;">
            This is an automated message, please do not reply to this email.
        </p>
    </div>
</div>
</body>
</html>
