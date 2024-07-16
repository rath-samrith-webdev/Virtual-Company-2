<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to Our Community!</title>
    <style>
        /* Reset some default styles for better email compatibility */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                padding: 0 10px;
            }
        }
    </style>
</head>
<body style="background-color: #f4f4f4; padding: 20px">
<table
    class="container"
    style="
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      "
>
    <tr>
        <td style="text-align: center">
            <img
                src="https://example.com/logo.png"
                alt="Logo"
                style="max-width: 100%; height: auto"
            />
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0">
            <h1 style="font-size: 24px; color: #333">
                Welcome to Our Community!
            </h1>
            <p style="font-size: 16px; color: #666">Dear {{$user->first_name}} {{$user->last_name}},</p>
            <p style="font-size: 16px; color: #666">
                We're excited to have you join our community. Get ready for exciting
                updates and useful information!
            </p>
            <p style="font-size: 16px; color: #666">
                Best regards,<br />
                The Team
            </p>
        </td>
    </tr>
</table>
</body>
</html>
