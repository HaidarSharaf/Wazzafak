<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Analytics Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
            padding: 40px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #1750b6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24pt;
            color: #1750b6;
            margin-bottom: 5px;
        }

        .header .date {
            font-size: 12pt;
            color: #666;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16pt;
            font-weight: bold;
            color: #1750b6;
            border-bottom: 2px solid #84cc16;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .stats-row {
            display: table-row;
        }

        .stat-cell {
            display: table-cell;
            width: 25%;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #e0e0e0;
            text-align: center;
        }

        .stat-number {
            font-size: 24pt;
            font-weight: bold;
            color: #1750b6;
            display: block;
            margin: 10px 0;
        }

        .stat-label {
            font-size: 9pt;
            color: #666;
        }

        .list-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .list-table th {
            background: #1750b6;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 10pt;
        }

        .list-table td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 10pt;
        }

        .list-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .badge {
            background: #84cc16;
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9pt;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 40px;
            right: 40px;
            text-align: center;
            font-size: 8pt;
            color: #999;
            border-top: 1px solid #e0e0e0;
            padding-top: 10px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Daily Analytics Report</h1>
    <div class="date">{{ $analytics['date'] }}</div>
</div>

<div class="section">
    <div class="section-title">Job Postings Overview</div>
    <div class="stats-grid">
        <div class="stats-row">
            <div class="stat-cell">
                <span class="stat-label">Jobs Posted</span>
                <span class="stat-number">{{ $analytics['jobs']['posted'] }}</span>
            </div>
            <div class="stat-cell">
                <span class="stat-label">Jobs Accepted</span>
                <span class="stat-number" style="color: #22c55e;">{{ $analytics['jobs']['accepted'] }}</span>
            </div>
            <div class="stat-cell">
                <span class="stat-label">Jobs Rejected</span>
                <span class="stat-number" style="color: #ef4444;">{{ $analytics['jobs']['rejected'] }}</span>
            </div>
            <div class="stat-cell">
                <span class="stat-label">Acceptance Rate</span>
                <span class="stat-number" style="font-size: 18pt;">{{ $analytics['jobs']['acceptance_rate'] }}%</span>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="section-title">Application Statistics</div>
    <div class="stats-grid">
        <div class="stats-row">
            <div class="stat-cell">
                <span class="stat-label">Total Applications</span>
                <span class="stat-number">{{ $analytics['applications']['total'] }}</span>
            </div>
            <div class="stat-cell">
                <span class="stat-label">Accepted</span>
                <span class="stat-number" style="color: #22c55e;">{{ $analytics['applications']['accepted'] }}</span>
            </div>
            <div class="stat-cell">
                <span class="stat-label">Rejected</span>
                <span class="stat-number" style="color: #ef4444;">{{ $analytics['applications']['rejected'] }}</span>
            </div>
            <div class="stat-cell">
                <span class="stat-label">Recruiter Accept Rate</span>
                <span class="stat-number" style="font-size: 18pt;">{{ $analytics['applications']['acceptance_rate'] }}%</span>
            </div>
        </div>
    </div>
</div>

@if($analytics['technologies']->isNotEmpty())
    <div class="section">
        <div class="section-title">Top Technologies in Demand</div>
        <table class="list-table">
            <thead>
            <tr>
                <th>Rank</th>
                <th>Technology</th>
                <th style="text-align: center;">Job Count</th>
            </tr>
            </thead>
            <tbody>
            @foreach($analytics['technologies'] as $index => $tech)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tech['name'] }}</td>
                    <td style="text-align: center;">
                        <span class="badge">{{ $tech['count'] }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

@if($analytics['stacks']->isNotEmpty())
    <div class="section">
        <div class="section-title">Most Requested Stacks</div>
        <table class="list-table">
            <thead>
            <tr>
                <th>Rank</th>
                <th>Stack</th>
                <th style="text-align: center;">Job Count</th>
            </tr>
            </thead>
            <tbody>
            @foreach($analytics['stacks'] as $index => $stack)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stack['name'] }}</td>
                    <td style="text-align: center;">
                        <span class="badge">{{ $stack['count'] }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

<div class="footer">
    <p>Generated on {{ now()->format('F d, Y \a\t h:i A') }} | © {{ date('Y') }} Wazzafak - All Rights Reserved</p>
</div>
</body>
</html>
