<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0;">

<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ asset('/images/Logo.png') }}" alt="Logo" style="max-width: 50px; vertical-align: middle;">
    <span style="font-size: 30px; font-weight: 800; color: #19468f; padding-left: 8px;">WAZZAFAK</span>
</div>

<div style="max-width: 700px; margin: 0 auto; padding: 40px; background: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 6px;">
    <p>Dear {{ $company_name }},</p>

    <p>
        Considering your recent job post, "{{$experience}}: {{$stack}}", we are sorry to inform you that the post was rejected.
    </p>


    <p style="margin-top: 20px; font-weight: bold;">
        {{ $message }}
    </p>

    <p style="margin-top: 20px; text-align: center">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</div>

</body>
</html>
