<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset Request</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0;">


<div style="max-width: 700px; margin: 0 auto; padding: 40px; background: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 6px; color: #0D1B2A">
    <p>Hello {{ $user->name ?? $user->email }},</p>

    <p>You are receiving this email because we received a password reset request for your account.</p>

    <div style="margin-top: 20px; display: flex; justify-content: center;">
        <a
            href="{{ $resetUrl }}"
            style="background-color: #FF4D30; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; text-decoration: none; margin-top: 20px; text-align: center;"
        >
            Reset Password
        </a>
    </div>


    <div style="text-align: center; padding: 20px; margin-top: 20px; border-top: 1px solid #e5e5e5;">
        <p style="margin: 0; color: #666; font-size: 14px;">
            This password reset link will expire in {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60) }} minutes.
        </p>
    </div>

    <p style="font-weight: bold; margin-top: 10px">
        **Important:** If you're having trouble clicking the "Reset Password" button, copy and paste the following URL into your web browser:
    </p>

    <br>


    <p style="font-weight: bold; margin-top: 10px">{{ $resetUrl }}</p>

    <p style="margin-top: 40px; font-size: 13px; color: #888;">
        If you did not request a password reset, no further action is required.
    </p>

    <p style="margin-top: 20px; text-align: center">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</div>

</body>
</html>

