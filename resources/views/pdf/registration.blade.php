<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #33A9E0;
            padding-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #33A9E0;
            margin-bottom: 10px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 18px;
            color: #666;
        }
        .race-number {
            text-align: center;
            margin: 30px 0;
        }
        .race-number-box {
            display: inline-block;
            padding: 15px 40px;
            border: 3px solid #33A9E0;
            font-size: 48px;
            font-weight: bold;
            color: #33A9E0;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #3D3F94;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .info-row {
            display: table-row;
        }
        .info-cell {
            display: table-cell;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .info-label {
            font-weight: bold;
            width: 40%;
        }
        .info-value {
            width: 60%;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .barcode {
            text-align: center;
            margin: 30px 0;
        }
        .important-note {
            background-color: #f8f9fa;
            border-left: 4px solid #33A9E0;
            padding: 15px;
            margin: 20px 0;
        }
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ $event_name }}</div>
            <div class="title">Registration Confirmation</div>
            <div class="subtitle">{{ $event_date }} | {{ $event_location }}</div>
        </div>
        
        <div class="race-number">
            <p>Your Race Number</p>
            <div class="race-number-box">{{ $registration->race_number }}</div>
        </div>
        
        <div class="section">
            <div class="section-title">Runner Information</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">Name:</div>
                    <div class="info-cell info-value">{{ $registration->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Email:</div>
                    <div class="info-cell info-value">{{ $registration->email }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Phone:</div>
                    <div class="info-cell info-value">{{ $registration->phone }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Age Group:</div>
                    <div class="info-cell info-value">{{ $registration->age }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Gender:</div>
                    <div class="info-cell info-value">{{ $registration->gender }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">T-Shirt Size:</div>
                    <div class="info-cell info-value">{{ $registration->t_shirt_size }}</div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">Race Information</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">Race Category:</div>
                    <div class="info-cell info-value">{{ $registration->race_category }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Package:</div>
                    <div class="info-cell info-value">{{ $registration->package_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Reference Number:</div>
                    <div class="info-cell info-value">{{ $registration->reference }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Registration Date:</div>
                    <div class="info-cell info-value">{{ $registration->created_at->format('F j, Y') }}</div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">Emergency Contact</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell info-label">Name:</div>
                    <div class="info-cell info-value">{{ $registration->emergency_contact_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-cell info-label">Phone:</div>
                    <div class="info-cell info-value">{{ $registration->emergency_contact_phone }}</div>
                </div>
            </div>
        </div>
        
        <div class="important-note">
            <strong>Important Information:</strong>
            <ul>
                <li>Please arrive at least 1 hour before your race start time.</li>
                <li>Bring this confirmation (printed or digital) and a valid ID to collect your race pack.</li>
                <li>Race packs will be available for collection on {{ $event_date }} from 5:00 AM at the event venue.</li>
                <li>Your race number must be visible at all times during the race.</li>
            </ul>
        </div>
        
        <div class="barcode">
            *{{ $registration->reference }}*
        </div>
        
        <div class="footer">
            <p>Thank you for registering for {{ $event_name }}!</p>
            <p>For any questions, please contact us at {{ config('marathon.contact.email') }} or {{ config('marathon.contact.phone') }}</p>
            <p>&copy; {{ date('Y') }} {{ $event_name }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
