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
        .message-box {
            background: #f0f9ff;
            border-left: 4px solid #1750b6;
            padding: 20px;
            border-radius: 5px;
            margin: 25px 0;
        }
        .message-box p {
            margin: 0;
            font-size: 15px;
            color: #555;
        }
        .button-container {
            text-align: center;
            margin: 35px 0;
        }
        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #1750b6 0%, #0d3a7a 100%);
            color: white;
            text-decoration: none;
            padding: 16px 40px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(23, 80, 182, 0.3);
            transition: all 0.3s ease;
        }
        .reset-button:hover {
            background: linear-gradient(135deg, #0d3a7a 0%, #1750b6 100%);
            box-shadow: 0 6px 8px rgba(23, 80, 182, 0.4);
            transform: translateY(-2px);
        }
        .info-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin: 25px 0;
            display: flex;
            align-items: start;
            gap: 10px;
        }
        .info-icon {
            color: #ffc107;
            font-size: 24px;
            flex-shrink: 0;
        }
        .info-text {
            font-size: 14px;
            color: #856404;
            margin: 0;
        }
        .expiry-notice {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .expiry-notice p {
            margin: 0;
            font-size: 14px;
            color: #991b1b;
        }
        .expiry-notice strong {
            font-size: 16px;
            color: #7f1d1d;
        }
        .link-section {
            background: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .link-section h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .reset-link {
            word-break: break-all;
            font-size: 12px;
            color: #1750b6;
            background: white;
            padding: 12px;
            border-radius: 5px;
            border: 1px dashed #1750b6;
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
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e5e5, transparent);
            margin: 25px 0;
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Password Reset Request</h1>
        <p>Secure your account with a new password</p>
    </div>

    <div class="content">
        <div class="greeting">
            Hello <strong>{{ $user->name ?? $user->email }}</strong>,
        </div>

        <div class="message-box">
            <p>
                We received a request to reset your password for your <strong style="color: #1750b6;">&lt;Wazzafak /&gt;</strong> account.
                If you made this request, click the button below to set a new password.
            </p>
        </div>

        <div class="button-container">
            <a href="{{ $resetUrl }}" class="reset-button">
                Reset My Password
            </a>
        </div>

        <div class="expiry-notice">
            <p>
                This password reset link will expire in <strong>{{ $expireMinutes }} minutes</strong>
            </p>
        </div>

        <div class="link-section">
            <h3>Having trouble clicking the button?</h3>
            <p style="font-size: 13px; color: #666; margin-bottom: 10px;">
                Copy and paste the following link into your web browser:
            </p>
            <div class="reset-link">
                {{ $resetUrl }}
            </div>
        </div>

        <div class="divider"></div>

        <div class="security-tips">
            <h3>Security Reminders</h3>
            <ul>
                <li><strong>Choose a strong password:</strong> Use at least 10 characters with a mix of letters, numbers, and symbols</li>
                <li><strong>Don't reuse passwords:</strong> Use a unique password for your &lt;Wazzafak /&gt; account</li>
                <li><strong>Keep it confidential:</strong> Never share your password with anyone</li>
                <li><strong>Enable two-factor authentication:</strong> Add an extra layer of security to your account</li>
            </ul>
        </div>

        <div class="info-box">
            <div class="info-icon">⚠️</div>
            <div class="info-text">
                <strong>Didn't request this?</strong><br>
                If you didn't request a password reset, please ignore this email. Your password will remain unchanged.
                However, if you suspect unauthorized access to your account, please contact our support team immediately.
            </div>
        </div>

        <div class="divider"></div>

        <p style="font-size: 13px; color: #888; text-align: center; margin-top: 20px;">
            For your security, we never ask for your password via email.
            Only use this link if you initiated the password reset request.
        </p>
    </div>

    <div class="footer">
        <p>
            <span class="company-name">&lt;Wazzafak /&gt;</span> - Connecting Developers & Recruiters
        </p>
        <p style="margin-top: 10px;">
            © {{ date('Y') }} &lt;Wazzafak /&gt;. All rights reserved.
        </p>
        <p style="margin-top: 10px; font-size: 12px;">
            This is an automated message, please do not reply to this email.
        </p>
    </div>
</div>
</body>
</html>
