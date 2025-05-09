<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registration Confirmation</title>
    <style>
        /* Base Styles - PDF Compatible */
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

        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 0px;
            border-bottom: 1px solid #33A9E0;
            padding-bottom: 10px;
        }
        .header-logo {
            margin-bottom: 15px;
        }
        .header-logo img {
            max-width: 200px;
            height: auto;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
            /*color: #3D3F94;*/
        }
        .subtitle {
            font-size: 16px;
            color: #555;
            font-weight: bold;
        }

        /* Race Number Styles */
        .race-number {
            text-align: center;
            margin: 35px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
        }
        .race-number p {
            font-size: 18px;
            font-weight: bold;
            color: #3D3F94;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        .race-number-box {
            display: inline-block;
            padding: 10px 50px;
            border: 4px solid #33A9E0;
            font-size: 52px;
            font-weight: bold;
            color: #33A9E0;
            background-color: #f8f9fa;
        }

        /* Section Styles */
        .section {
            margin-bottom: 30px;
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #e0e0e0;
        }
        .section-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #3D3F94;
            border-bottom: 2px solid #33A9E0;
            padding-bottom: 8px;
        }

        /* Table Styling for Runner Info */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 8px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-table td:first-child {
            font-weight: bold;
            width: 40%;
            color: #555;
        }

        /* Important Note Styles */
        .important-note {
            background-color: #f8f9fa;
            border-left: 5px solid #33A9E0;
            padding: 15px;
            margin: 25px 0;
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
        }

        /* Barcode Styles */
        .barcode {
            text-align: center;
            margin: 30px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            font-family: monospace;
            font-size: 16px;
        }

        /* Footer Styles */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 2px solid #e0e0e0;
            padding-top: 20px;
        }
        .footer p {
            margin: 5px 0;
        }

        /* Event Banner */
        .event-banner {
            background-color: #3D3F94;
            color: white;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 18px;
        }

        /* Highlight Box */
        .highlight-box {
            border: 2px solid #33A9E0;
            padding: 10px;
            margin: 15px 0;
            background-color: #f0f9ff;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <div class="header-logo">
                <img src="{{ public_path('img/logo-full.png') }}" alt="{{ $event_name }} Logo">
            </div>
            <div class="title">Registration Confirmation</div>
            <div class="subtitle">{{ date('d-M-Y', strtotime($event_date)) }} | {{ $event_location }}</div>
        </div>

        <div class="race-number">
            <p>Your Race Number</p>
            <div class="race-number-box">{{ $registration->race_number }}</div>
        </div>

        <div class="section">
            <div class="section-title">Runner Information</div>
            <table class="info-table">
                <tr>
                    <td>Name:</td>
                    <td>{{ $registration->name }}</td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>{{ $registration->gender }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Race Information</div>
            <table class="info-table">
                <tr>
                    <td>Race Category:</td>
                    <td>{{ $registration->race_category }}</td>
                </tr>
                <tr>
                    <td>Package:</td>
                    <td>{{ $registration->package_name }}</td>
                </tr>
                <tr>
                    <td>Reference Number:</td>
                    <td>{{ $registration->reference }}</td>
                </tr>
                <tr>
                    <td>Registration Date:</td>
                    <td>{{ $registration->created_at->format('F j, Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Emergency Contact</div>
            <table class="info-table">
                <tr>
                    <td>Name:</td>
                    <td>{{ $registration->emergency_contact_name }}</td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>{{ $registration->emergency_contact_phone }}</td>
                </tr>
            </table>
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
