<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Two-Factor Authentication Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h1 {
            font-size: 24px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #2d6a4f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Two-Factor Authentication Code</h1>
        <p>Hi {{ $email }},</p>
        <p>You are receiving this email because you requested to log in or perform an action that requires two-factor authentication.</p>
        <p>Use the code below to verify your identity:</p>
        <p class="code">{{ $code }}</p>
        <p>If you did not request this, please ignore this email.</p>
        <p>Thanks,<br>The {{ config('app.name') }} Team</p>
    </div>
</body>
</html>
