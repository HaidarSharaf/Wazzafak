<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0;">


<div style="max-width: 700px; margin: 0 auto; padding: 40px; background: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 6px;">
    <p>Hello {{ $user->name ?? 'User' }},</p>

    <p>Your One-Time Password (OTP) is:</p>

    <h1 style="color: #1750b6; font-size: 36px; letter-spacing: 4px; text-align: center">{{ $otp }}</h1>

    <p style="margin-top: 20px;">
        Enter this code in the app to verify your email address.
    </p>

    <p style="font-weight: bold; margin-top: 10px">
        **Important:** This code will expire at {{ $expiresAt }} (10 minutes from now).
    </p>

    <p style="margin-top: 40px; font-size: 13px; color: #888;">
        If you didn't request this verification, you can safely ignore this message.<br>
        For security, do not share this code with anyone.
    </p>

    <p style="margin-top: 20px; text-align: center">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</div>

</body>
</html>
