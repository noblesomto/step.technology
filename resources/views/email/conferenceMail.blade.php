<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTES 2025 Registration Notification</title>
    <style>
        /* Add the CSS styles from above */
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New ICTES 2025 Registration</h1>
            <p>You have received a new conference registration</p>
        </div>

        <div class="email-body">
            <div class="alert">
                <strong>Action Required:</strong> This registration requires your attention.
            </div>

            <h2 class="section-heading">Registration Details</h2>
            <table class="info-table">
                <tr>
                    <td class="label">Registration ID:</td>
                    <td>ICTES2025-{{ substr(time(), -4) }}{{ rand(100, 999) }}</td>
                </tr>
                <tr>
                    <td class="label">Registration Date:</td>
                    <td>{{ now()->format('F j, Y, g:i a') }}</td>
                </tr>
                <tr>
                    <td class="label">Registration Type:</td>
                    <td>{{ $registrationData['category'] }}</td>
                </tr>
            </table>

            <h2 class="section-heading">Personal Information</h2>
            <table class="info-table">
                <tr>
                    <td class="label">Title:</td>
                    <td>{{ $registrationData['title'] }}</td>
                </tr>
                <tr>
                    <td class="label">First Name:</td>
                    <td>{{ $registrationData['first_name'] }}</td>
                </tr>
                <tr>
                    <td class="label">Last Name:</td>
                    <td>{{ $registrationData['last_name'] }}</td>
                </tr>
                <tr>
                    <td class="label">Phone Number:</td>
                    <td>{{ $registrationData['phone'] }}</td>
                </tr>
                <tr>
                    <td class="label">Email Address:</td>
                    <td><a href="mailto:{{ $registrationData['email'] }}">{{ $registrationData['email'] }}</a></td>
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

            @if(!empty($registrationData['message']))
            <h2 class="section-heading">Additional Information</h2>
            <p>{{ $registrationData['message'] }}</p>
            @endif
        </div>

        <div class="email-footer">
            <p>ICTES 2025 Conference Management System</p>
        </div>
    </div>
</body>
</html>
