<!-- <!DOCTYPE html>
<html>
<body>

<h2>{{$user_name}} sent to you Coupon Code: <b>HEALTH10</b> to get a 10% Discount on your next purchase from Aayurja (www.aayurja.com)</h2>

<ul>
  <li>Name: {{$user_name ?? ''}}</li>
  <li>Email: {{$user_email ?? ''}}</li>
  <li>Phone: {{$user_mobile ?? ''}}</li>
  <li>Age: {{$user_age ?? ''}}</li>
  <li>Gender: {{$user_gender ?? ''}}</li>
  <li>Address: {{$user_address ?? ''}}</li>
  <li>Profession: {{$user_profession ?? ''}}</li>
  <li>Routine: {{$routine ?? ''}}</li>
  <li>Consume Source: {{$consume_source ?? ''}}</li>
  <li>Reason: {{$reason ?? ''}}</li>
  <li>Lifestyle: {{$lifestyle ?? ''}}</li>
  <li>Activity: {{$activity ?? ''}}</li>
  <li>Exotic Food: {{$exotic_food ?? ''}}</li>
  <li>Expenditure: {{$expenditure ?? ''}}</li>
  <li>Family Members: {{$family_members ?? ''}}</li>
  <li>Reference name 1: {{$ref_first_name1 ?? ''}}</li>
  <li>Reference Email 1: {{$ref_email1 ?? ''}}</li>
  <li>Reference Contact 1: {{$ref_contact1 ?? ''}}</li>
  <li>Reference Name 2: {{$ref_first_name2 ?? ''}}</li>
  <li>Reference Email 2: {{$ref_email2 ?? ''}}</li>
  <li>Reference Contact 2: {{$ref_contact2 ?? ''}}</li>

  <li>Reference Name 3: {{$ref_first_name3 ?? ''}}</li>
  <li>Reference Email 3: {{$ref_email3 ?? ''}}</li>
  <li>Reference Contact 3: {{$ref_contact3 ?? ''}}</li>
  <li>Interested In Purchase: {{$interested_in_purchase ?? ''}}</li>
</ul>  


</body>
</html> -->







<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            padding: 20px;
            border: 1px solid #ccc;
            margin: 0 auto;
            max-width: 600px;
        }
        .discount-code {
            color: green;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 10px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello,</h2>
        <p><strong>{{ $user_name }}</strong> has sent you a coupon code: <span class="discount-code">HEALTH10</span> to get a 10% discount on your next purchase from Aayurja.</p>
        <p>You can use this code on our website: <a href="https://www.aayurja.com" target="_blank">www.aayurja.com</a>.</p>
        
        <p>Don't miss out on this offer! Enjoy your shopping experience.</p>
        
        <p>Best Regards,</p>
        <p><strong>Aayurja Team</strong></p>

        <div class="footer">
            <p>This is an automated message, please do not reply. If you have any questions, contact us at <a href="mailto:info@aayurja.com">info@aayurja.com</a>.</p>
        </div>
    </div>
</body>
</html>

