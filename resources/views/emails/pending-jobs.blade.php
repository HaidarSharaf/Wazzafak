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
        }
        .header {
            background: linear-gradient(135deg, #1750b6 0%, #84cc16 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            color: #999;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Pending Jobs Notification</h1>
    <p style="margin: 10px 0 0 0;">{{ $pendingCount }} {{ Str::plural('job', $pendingCount) }} awaiting your review.</p>
</div>

<div class="content">
    <p>Hello Admin,</p>
    <p>There {{ $pendingCount === 1 ? 'is' : 'are' }} currently <strong>{{ $pendingCount }}</strong> job {{ Str::plural('listing', $pendingCount) }} pending approval.</p>


    <div style="text-align: center;">
        <a href="{{ route('admin.manage') }}" class="button">
            Review Pending Jobs
        </a>
    </div>
</div>

<div class="footer">
    <p>This is an automated email from &lt;Wazzafak /&gt;</p>
    <p>© {{ date('Y') }} &lt;Wazzafak /&gt;. All rights reserved.</p>
</div>
</body>
</html>
