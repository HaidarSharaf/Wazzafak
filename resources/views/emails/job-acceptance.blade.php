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
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
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
        .job-details h3 {
            margin: 0 0 15px 0;
            color: #1f2937;
            font-size: 18px;
        }
        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 5px;
        }
        .info-box p {
            margin: 0;
            color: #1e40af;
            font-size: 14px;
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
        <h1>Job Post Accepted</h1>
        <p>Your recent job post was accepted</p>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $company_name }}</strong>,</p>

        <p>Thank you for submitting a job posting to &lt;Wazzafak /&gt;. After careful review, we inform you that your job post, <strong>{{ $job_title }}</strong>, has been accepted.</p>

        <div class="info-box">
            <p>💡 <strong>What's next?</strong> Now applicants can see your job post. You can manage applications and disclose the post whenever needed!</p>
        </div>

        <p style="margin-top: 30px;">If you have any questions or need assistance, please don't hesitate to contact our support team.</p>

        <p style="margin-top: 20px;">Best regards,<br><strong>The &lt;Wazzafak /&gt; Team</strong></p>
    </div>

    <div class="footer">
        <div class="logo">
            <span>WAZZAFAK</span>
        </div>
        <p>© {{ date('Y') }} &lt;Wazzafak /&gt;. All rights reserved.</p>
        <p>Connecting talented professionals with great opportunities</p>
    </div>
</div>
</body>
</html>
