<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTES 2025 Registration {{ ucfirst($registrationData['action']) }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #2a5a87 0%, #1e3c5e 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .email-body {
            padding: 40px 30px;
        }
        .email-footer {
            background-color: #f5f5f5;
            padding: 25px 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #eaeaea;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eaeaea;
        }
        .info-table .label {
            font-weight: 600;
            color: #555;
            width: 35%;
        }
        .section-heading {
            background-color: #f5f9ff;
            padding: 12px 15px;
            margin: 30px 0 15px 0;
            border-left: 4px solid #2a5a87;
            font-weight: 600;
            color: #2a5a87;
            border-radius: 0 4px 4px 0;
        }
        .confirmation-box {
            background-color: #f0f7ff;
            padding: 20px;
            border-radius: 5px;
            margin: 25px 0;
            border-left: 4px solid #2a5a87;
        }
        .logo {
            max-width: 180px;
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #2a5a87;
            color: #FFF !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin: 15px 0;
        }
        .contact-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        @media (max-width: 600px) {
            .email-body {
                padding: 25px 15px;
            }
            .info-table .label {
                width: 40%;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>ICTES 2025 Registration {{ ucfirst($registrationData['action']) }}</h1>
            <p>
                @if($registrationData['action'] == 'confirmed')
                    Thank you for registering for the International Conference on Technology, Energy & Sustainability
                @else
                    Your registration has been updated for the International Conference on Technology, Energy & Sustainability
                @endif
            </p>
        </div>

        <div class="email-body">
            <div class="confirmation-box">
                <h2 style="margin-top: 0;">
                    @if($registrationData['action'] == 'confirmed')
                        Thank you for your registration, {{ $registrationData['title'] }} {{ $registrationData['last_name'] }}!
                    @else
                        Your registration has been updated, {{ $registrationData['title'] }} {{ $registrationData['last_name'] }}!
                    @endif
                </h2>
                <p>We have successfully received your registration details for ICTES 2025. Your registration ID is: <strong>{{ $registrationData['registration_id'] }}</strong></p>
                <p>Please keep this confirmation email for your records and present your registration ID at the conference venue.</p>
            </div>

            <h2 class="section-heading">Registration Details</h2>
            <table class="info-table">
                <tr>
                    <td class="label">Registration ID:</td>
                    <td><strong>{{ $registrationData['registration_id'] }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Registration Date:</td>
                    <td>{{ date('F j, Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Registration Type:</td>
                    <td>{{ $registrationData['category'] }}</td>
                </tr>
            </table>

            <h2 class="section-heading">Personal Information</h2>
            <table class="info-table">
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $registrationData['title'] }} {{ $registrationData['first_name'] }} {{ $registrationData['last_name'] }}</td>
                </tr>
                <tr>
                    <td class="label">Phone Number:</td>
                    <td>{{ $registrationData['phone'] }}</td>
                </tr>
                <tr>
                    <td class="label">Email Address:</td>
                    <td>{{ $registrationData['email'] }}</td>
                </tr>
            </table>

            <h2 class="section-heading">Professional Information</h2>
            <table class="info-table">
                <tr>
                    <td class="label">Organization:</td>
                    <td>{{ $registrationData['organization'] }}</td>
                </tr>
                <tr>
                    <td class="label">Country:</td>
                    <td>{{ $registrationData['country'] }}</td>
                </tr>
            </table>

            <div class="contact-info">
                <h3 style="margin-top: 0;">Conference Details</h3>
                <p><strong>Dates:</strong> November 24-26, 2025</p>
                <p><strong>Location:</strong> To be announced</p>
                <p>Further information about the conference schedule, venue, and accommodations will be sent to you as the event approaches.</p>
            </div>

            <p>For any questions or changes to your registration, please contact us at <a href="mailto:info@step.technology">info@step.technology</a> with your registration ID.</p>

            <div style="text-align: center; margin-top: 30px;">
                <a href="https://www.step.technology" class="button">Visit Conference Website</a>
            </div>
        </div>

        <div class="email-footer">
            <p><strong>ICTES 2025 Conference</strong><br>
            Organized by Council for Registration of Technology and Energy Professionals (CORETEP)<br>
            Under Society of Technology and Energy Professionals (STEP)</p>
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>&copy; 2025 ICTES Conference. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
