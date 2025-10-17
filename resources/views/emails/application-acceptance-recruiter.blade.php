<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #1750b6 0%, #0e3a7a 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .interview-details {
            background: #eff6ff;
            border: 2px solid #3b82f6;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }
        .interview-details h3 {
            margin: 0 0 20px 0;
            color: #1e40af;
            font-size: 18px;
            text-align: center;
        }
        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #bfdbfe;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #1e40af;
            min-width: 140px;
        }
        .detail-value {
            color: #1d4ed8;
        }
        .zoom-box {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            color: white;
        }
        .zoom-box h3 {
            margin: 0 0 20px 0;
            font-size: 18px;
            text-align: center;
        }
        .zoom-link {
            background: white;
            color: #1d4ed8;
            padding: 15px;
            border-radius: 6px;
            text-align: center;
            margin: 15px 0;
            word-break: break-all;
            font-weight: bold;
        }
        .zoom-link a {
            color: #1d4ed8;
            text-decoration: none;
        }
        .zoom-info {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }
        .zoom-info p {
            margin: 8px 0;
            font-size: 14px;
        }
        .host-badge {
            display: inline-block;
            background: #fbbf24;
            color: #78350f;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }
        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 5px 0;
            color: #6b7280;
            font-size: 13px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo span {
            font-size: 24px;
            font-weight: 800;
            color: #1750b6;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Interview Confirmed</h1>
        <p>Your interview has been scheduled successfully</p>
    </div>

    <div class="content">
        <p>Hello <strong>{{ $recruiter_name }}</strong>,</p>

        <p>This is a confirmation that you have successfully scheduled an interview with <strong>{{ $candidate_name }}</strong> for the <strong>{{ $job_title }}</strong> position.</p>

        <div class="interview-details">
            <h3>Interview Schedule</h3>
            <div class="detail-row">
                <span class="detail-label">Candidate:</span>
                <span class="detail-value">{{ $candidate_name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Position:</span>
                <span class="detail-value">{{ $job_title }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date:</span>
                <span class="detail-value">{{ $interview_date }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Time:</span>
                <span class="detail-value">{{ $interview_time }} (Asia/Beirut)</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Location:</span>
                <span class="detail-value">{{ $interview_location }}</span>
            </div>
        </div>

        @if($is_online && $zoom_start_url)
            <div class="zoom-box">
                <h3>Zoom Meeting - Host Controls <span class="host-badge">HOST</span></h3>

                <div class="zoom-link">
                    <a href="{{ $zoom_start_url }}" target="_blank">Click Here to Start Meeting (Host Link)</a>
                </div>

                <div class="zoom-info">
                    @if($zoom_meeting_id)
                        <p><strong>Meeting ID:</strong> {{ $zoom_meeting_id }}</p>
                    @endif
                    @if($zoom_password)
                        <p><strong>Password:</strong> {{ $zoom_password }}</p>
                    @endif
                    <p style="margin-top: 15px; opacity: 0.9;"><em>This is your host link. The candidate will receive a separate join link.</em></p>
                </div>
            </div>
        @endif

        <p style="margin-top: 30px;">The applicant has been notified and will receive all necessary details to join the interview.</p>

        <p style="margin-top: 20px;">Best regards,<br><strong>The &lt;Wazzafak /&gt; Team</strong></p>
    </div>

    <div class="footer">
        <div class="logo">
            <span>&lt;WAZZAFAK /&gt;</span>
        </div>
        <p>© {{ date('Y') }} &lt;Wazzafak /&gt;. All rights reserved.</p>
        <p>Connecting talented professionals with great opportunities</p>
    </div>
</div>
</body>
</html>
