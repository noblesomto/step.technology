<!DOCTYPE html>
<html>

<head>
    <title>{{ config('global.site_title') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Your STEP exam result has been approved </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 32px; font-weight: 400; line-height: 40px;">
                            <img src="{{ asset('frontend/img/new-logo.png') }}" width="100" style="display: block; margin: 0 auto 20px; border: 0px;" />
                            <h1 style="font-size: 32px; font-weight: 400; margin: 2;">Congratulations, {{ $user->first_name }}!</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Your exam result has been reviewed and <strong style="color: #28a745;">approved</strong> by the {{ config('global.site_name') }} council.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #FFECD1; border-radius: 4px;">
                                <tr>
                                    <td align="center" style="padding: 20px; font-family: 'Lato', Helvetica, Arial, sans-serif;">
                                        <p style="margin: 0; color: #666666; font-size: 14px;">Your Score</p>
                                        <p style="margin: 4px 0 0; color: #111111; font-size: 36px; font-weight: 700;">{{ $score->score }}{{ $score->total_questions ? '/'.$score->total_questions : '' }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">You can view your full result by logging into your dashboard at any time.</p>
                            <p style="margin: 20px 0 0;">Cheers,<br>{{ config('global.site_title') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
