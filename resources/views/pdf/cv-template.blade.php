<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $name }} - CV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #333;
        }

        .container {
            padding: 40px 50px;
        }

        .header {
            border-bottom: 3px solid #1750b6;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .name {
            font-size: 28pt;
            font-weight: bold;
            color: #1750b6;
            margin-bottom: 8px;
        }

        .contact-info {
            font-size: 10pt;
            color: #666;
            line-height: 1.6;
        }

        .contact-info div {
            margin-bottom: 3px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #1750b6;
            border-bottom: 2px solid #84cc16;
            padding-bottom: 5px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .summary {
            text-align: justify;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .item {
            margin-bottom: 15px;
        }

        .item-title {
            font-size: 12pt;
            font-weight: bold;
            color: #333;
            margin-bottom: 3px;
        }

        .item-subtitle {
            font-size: 10pt;
            color: #666;
            margin-bottom: 5px;
            font-style: italic;
        }

        .item-description {
            font-size: 10pt;
            text-align: justify;
            line-height: 1.5;
            margin-bottom: 5px;
        }

        .item-highlights {
            margin-top: 5px;
        }

        .item-highlights li {
            font-size: 10pt;
            margin-bottom: 3px;
            margin-left: 20px;
        }

        .skills-grid {
            display: table;
            width: 100%;
        }

        .skills-row {
            display: table-row;
        }

        .skills-label {
            display: table-cell;
            font-weight: bold;
            padding: 5px 10px 5px 0;
            width: 25%;
            vertical-align: top;
        }

        .skills-content {
            display: table-cell;
            padding: 5px 0;
            vertical-align: top;
        }

        .tag {
            display: inline-block;
            background: #f0f0f0;
            padding: 3px 8px;
            margin: 2px;
            border-radius: 3px;
            font-size: 9pt;
        }

        .certification-item {
            margin-bottom: 12px;
        }

        .cert-name {
            font-weight: bold;
            color: #1750b6;
        }

        .cert-issuer {
            color: #666;
            font-size: 10pt;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <div class="name">{{ $name }}</div>
        <div class="contact-info">
            @if($location)
                <div>{{ $location }}</div>
            @endif
            @if($email)
                <div>{{ $email }}</div>
            @endif
            @if($phone)
                <div>{{ $phone }}</div>
            @endif
            @if($linkedin)
                <div>{{ $linkedin }}</div>
            @endif
            @if($github)
                <div>{{ $github }}</div>
            @endif
        </div>
    </div>

    <!-- Professional Summary -->
    @if($aiContent && isset($aiContent['professional_summary']))
        <div class="section">
            <div class="section-title">Professional Summary</div>
            <div class="summary">
                {{ $aiContent['professional_summary'] }}
            </div>
        </div>
    @endif

    @if($aiContent && !empty($aiContent['project_suggestions']))
        <div class="section">
            <div class="section-title">Projects</div>
            @foreach($aiContent['project_suggestions'] as $project)
                <div class="item">
                    <div class="item-title">{{ $project['title'] }}</div>
                    <div class="item-subtitle">{{ $project['technologies'] }}</div>
                    <div class="item-description">{{ $project['description'] }}</div>
                    @if(!empty($project['highlights']))
                        <ul class="item-highlights">
                            @foreach($project['highlights'] as $highlight)
                                <li>{{ $highlight }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($experiences))
        <div class="section">
            <div class="section-title">Work Experience</div>
            @foreach($experiences as $exp)
                <div class="item">
                    <div class="item-title">{{ $exp['title'] }} - {{ $exp['company'] }}</div>
                    <div class="item-subtitle">{{ $exp['duration'] }}</div>
                    <div class="item-description">{{ $exp['description'] }}</div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($certifications))
        <div class="section">
            <div class="section-title">Certifications</div>
            @foreach($certifications as $cert)
                <div class="certification-item">
                    <div class="cert-name">{{ $cert['issuer'] }}</div>
                    <div class="cert-issuer">{{ $cert['name'] }}</div>
                    <div class="item-description">{{ $cert['description'] }}</div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="section">
        <div class="section-title">Technologies and Skills</div>
        <div class="skills-grid">
            @if(!empty($stacks))
                <div class="skills-row">
                    <div class="skills-label">Stacks:</div>
                    <div class="skills-content">
                        @foreach($stacks as $stack)
                            <span class="tag">{{ $stack }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!empty($technologies))
                <div class="skills-row">
                    <div class="skills-label">Technologies:</div>
                    <div class="skills-content">
                        @foreach($technologies as $tech)
                            <span class="tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(!empty($educations))
        <div class="section">
            <div class="section-title">Education</div>
            @foreach($educations as $edu)
                <div class="item">
                    <div class="item-title">{{ $edu['degree'] }}</div>
                    <div class="item-subtitle">{{ $edu['institution'] }}, {{ $edu['year'] }}</div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($languages))
        <div class="section">
            <div class="section-title">Languages</div>
            @foreach($languages as $lang)
                @if(!empty($lang['name']))
                    <div style="margin-bottom: 5px;">
                        <strong>{{ $lang['name'] }}</strong>@if(!empty($lang['level'])) ({{ $lang['level'] }})@endif
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
</body>
</html>
