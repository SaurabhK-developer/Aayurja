<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aayurja Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: #ad8f71;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .msg-text {
            color: #333;
            margin: 20px 0;
        }
        .footer {
            background: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Aayurja</h1>
        </div>
        <div class="content">
            <p>Dear {{$username}},</p>
            <p>Your order has been completed successfully. Your Order No. is {{$orderid}}.</p>
            <div class="msg-text">
                <p>Thank you for shopping with Aayurja.</p>
                <p>Best Regards,<br>Team Aayurja</p>
            </div>
        </div>
        <div class="footer">
            &copy; 2024 Aayurja. All rights reserved.
        </div>
    </div>
</body>
</html>
