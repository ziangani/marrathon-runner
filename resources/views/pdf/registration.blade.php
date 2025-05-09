<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registration Confirmation</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            position: relative;
        }
        
        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #33A9E0;
            padding-bottom: 25px;
            position: relative;
        }
        .header:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #3D3F94;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #33A9E0;
            margin-bottom: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #3D3F94;
        }
        .subtitle {
            font-size: 18px;
            color: #555;
            font-weight: 500;
        }
        
        /* Race Number Styles */
        .race-number {
            text-align: center;
            margin: 40px 0;
            position: relative;
        }
        .race-number p {
            font-size: 18px;
            font-weight: 600;
            color: #3D3F94;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        .race-number-box {
            display: inline-block;
            padding: 20px 50px;
            border: 4px solid #33A9E0;
            font-size: 56px;
            font-weight: bold;
            color: #33A9E0;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .race-number-box:before, .race-number-box:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: #3D3F94;
            border-radius: 50%;
        }
        .race-number-box:before {
            top: -10px;
            left: -10px;
        }
        .race-number-box:after {
            bottom: -10px;
            right: -10px;
        }
        
        /* Section Styles */
        .section {
            margin-bottom: 35px;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .section-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #3D3F94;
            border-bottom: 2px solid #33A9E0;
            padding-bottom: 8px;
            position: relative;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background-color: #3D3F94;
        }
        
        /* Info Grid Styles */
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 5px;
        }
        .info-row {
            display: table-row;
        }
        .info-row:hover {
            background-color: rgba(51, 169, 224, 0.05);
        }
        .info-cell {
            display: table-cell;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-label {
            font-weight: bold;
            width: 40%;
            color: #555;
            position: relative;
            padding-left: 25px;
        }
        .info-label:before {
            content: '•';
            position: absolute;
            left: 10px;
            color: #33A9E0;
            font-size: 18px;
        }
        .info-value {
            width: 60%;
            font-weight: 500;
        }
        
        /* Important Note Styles */
        .important-note {
            background-color: #f8f9fa;
            border-left: 5px solid #33A9E0;
            padding: 20px;
            margin: 30px 0;
            border-radius: 0 8px 8px 0;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .important-note:before {
            content: '!';
            position: absolute;
            top: -15px;
            left: -15px;
            width: 30px;
            height: 30px;
            background-color: #3D3F94;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-weight: bold;
            font-size: 20px;
        }
        .important-note strong {
            display: block;
            margin-bottom: 10px;
            color: #3D3F94;
            font-size: 18px;
        }
        .important-note ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .important-note li {
            margin-bottom: 8px;
            position: relative;
        }
        
        /* Barcode Styles */
        .barcode {
            text-align: center;
            margin: 40px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        /* QR Code Styles */
        .qr-code {
            text-align: center;
            margin: 30px 0;
        }
        
        /* Footer Styles */
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 2px solid #e0e0e0;
            padding-top: 25px;
            position: relative;
        }
        .footer:before {
            content: '';
            position: absolute;
            top: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background-color: #33A9E0;
        }
        .footer p {
            margin: 5px 0;
        }
        
        /* Decorative Elements */
        .corner-decoration {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid #33A9E0;
            opacity: 0.5;
        }
        .top-left {
            top: 20px;
            left: 20px;
            border-right: none;
            border-bottom: none;
        }
        .top-right {
            top: 20px;
            right: 20px;
            border-left: none;
            border-bottom: none;
        }
        .bottom-left {
            bottom: 20px;
            left: 20px;
            border-right: none;
            border-top: none;
        }
        .bottom-right {
            bottom: 20px;
            right: 20px;
            border-left: none;
            border-top: none;
        }
        
        /* Responsive Adjustments */
        @media print {
            body {
                font-size: 12pt;
            }
            .container {
                padding: 15px;
            }
            .race-number-box {
                padding: 15px 40px;
                font-size: 48px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Decorative corner elements -->
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>
        
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
