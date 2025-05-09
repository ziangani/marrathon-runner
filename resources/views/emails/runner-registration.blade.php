<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Marathon Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #33A9E0;
            padding-bottom: 10px;
        }
        .header-logo {
            margin-bottom: 15px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #3D3F94;
        }
        .subtitle {
            font-size: 16px;
            color: #555;
        }
        .race-number {
            text-align: center;
            margin: 25px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
        }
        .race-number p {
            font-size: 16px;
            font-weight: bold;
            color: #3D3F94;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .race-number-box {
            display: inline-block;
            padding: 10px 30px;
            border: 3px solid #33A9E0;
            font-size: 36px;
            font-weight: bold;
            color: #33A9E0;
            background-color: #f8f9fa;
        }
        .section {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #e0e0e0;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #3D3F94;
            border-bottom: 2px solid #33A9E0;
            padding-bottom: 5px;
        }
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
        .important-note {
            background-color: #f8f9fa;
            border-left: 4px solid #33A9E0;
            padding: 15px;
            margin: 20px 0;
        }
        .important-note strong {
            display: block;
            margin-bottom: 10px;
            color: #3D3F94;
            font-size: 16px;
        }
        .important-note ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .important-note li {
            margin-bottom: 6px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #e0e0e0;
            padding-top: 15px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #33A9E0;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">Marathon Registration Confirmation</div>
            <div class="subtitle">Thank you for registering!</div>
        </div>

        <p>Dear {{ $name }},</p>
        
        <p>Your payment has been successfully processed and your registration for the marathon is now confirmed. Below are your registration details:</p>

        <div class="race-number">
            <p>Your Race Number</p>
            <div class="race-number-box">{{ $race_number }}</div>
        </div>

        <div class="section">
            <div class="section-title">Runner Information</div>
            <table class="info-table">
                <tr>
                    <td>Name:</td>
                    <td>{{ $name }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $email }}</td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>{{ $phone }}</td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>{{ $gender }}</td>
                </tr>
                <tr>
                    <td>Age:</td>
                    <td>{{ $age }}</td>
                </tr>
                <tr>
                    <td>T-Shirt Size:</td>
                    <td>{{ $t_shirt_size }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Race Information</div>
            <table class="info-table">
                <tr>
                    <td>Race Category:</td>
                    <td>{{ $race_category }}</td>
                </tr>
                <tr>
                    <td>Package:</td>
                    <td>{{ $package }}</td>
                </tr>
                <tr>
                    <td>Reference Number:</td>
                    <td>{{ $reference }}</td>
                </tr>
            </table>
        </div>

        <div class="important-note">
            <strong>Important Information:</strong>
            <ul>
                <li>Please arrive at least 1 hour before your race start time.</li>
                <li>Bring this confirmation (printed or digital) and a valid ID to collect your race pack.</li>
                <li>Your race number must be visible at all times during the race.</li>
            </ul>
        </div>

        <p style="text-align: center;">
            <a href="{{ $download_url }}" class="button">Download Registration PDF</a>
        </p>

        <div class="footer">
            <p>Thank you for participating!</p>
            <p>For any questions, please contact us at {{ config('marathon.contact.email') }} or {{ config('marathon.contact.phone') }}</p>
        </div>
    </div>
</body>
</html>