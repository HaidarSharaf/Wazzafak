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
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            border: 2px solid #e0e0e0;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #1750b6;
            margin: 10px 0;
        }
        .stat-label {
            font-size: 14px;
            color: #666;
        }
        .section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1750b6;
            margin-bottom: 15px;
            border-bottom: 2px solid #84cc16;
            padding-bottom: 5px;
        }
        .list-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background: white;
            margin-bottom: 8px;
            border-radius: 5px;
        }
        .badge {
            background: #84cc16;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
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
    <h1>Daily Analytics Report</h1>
    <p style="margin: 10px 0 0 0;">{{ $analytics['date'] }}</p>
</div>

<div class="section">
    <div class="section-title">Job Postings Overview</div>
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-label">Jobs Posted</div>
            <div class="stat-number">{{ $analytics['jobs']['posted'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Jobs Accepted</div>
            <div class="stat-number" style="color: #22c55e;">{{ $analytics['jobs']['accepted'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Jobs Rejected</div>
            <div class="stat-number" style="color: #ef4444;">{{ $analytics['jobs']['rejected'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Acceptance Rate</div>
            <div class="stat-number" style="font-size: 24px;">{{ $analytics['jobs']['acceptance_rate'] }}%</div>
        </div>
    </div>
</div>

<div class="section">
    <div class="section-title">Application Statistics</div>
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-label">Total Applications</div>
            <div class="stat-number">{{ $analytics['applications']['total'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Accepted by Recruiters</div>
            <div class="stat-number" style="color: #22c55e;">{{ $analytics['applications']['accepted'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Rejected</div>
            <div class="stat-number" style="color: #ef4444;">{{ $analytics['applications']['rejected'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Recruiter Acceptance Rate</div>
            <div class="stat-number" style="font-size: 24px;">{{ $analytics['applications']['acceptance_rate'] }}%</div>
        </div>
    </div>
</div>

@if($analytics['technologies']->isNotEmpty())
    <div class="section">
        <div class="section-title">Top Technologies in Demand</div>
        @foreach($analytics['technologies']->take(5) as $tech)
            <div class="list-item">
                <span>{{ $tech['name'] }}</span>
                <span class="badge">{{ $tech['count'] }} {{ Str::plural('job', $tech['count']) }}</span>
            </div>
        @endforeach
    </div>
@endif

@if($analytics['stacks']->isNotEmpty())
    <div class="section">
        <div class="section-title">Most Requested Stacks</div>
        @foreach($analytics['stacks'] as $stack)
            <div class="list-item">
                <span>{{ $stack['name'] }}</span>
                <span class="badge">{{ $stack['count'] }} {{ Str::plural('job', $stack['count']) }}</span>
            </div>
        @endforeach
    </div>
@endif

<div style="background: #e0f2fe; padding: 15px; border-radius: 10px; border-left: 4px solid #1750b6; margin-top: 20px;">
    <p style="margin: 0; font-size: 14px;">
        📎 <strong>Detailed PDF report is attached to this email.</strong>
    </p>
</div>

<div class="footer">
    <p>This is an automated daily report from &lt;Wazzafak /&gt;</p>
    <p>© {{ date('Y') }} &lt;Wazzafak /&gt;. All rights reserved.</p>
</div>
</body>
</html>
