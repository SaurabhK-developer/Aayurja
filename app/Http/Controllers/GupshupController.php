<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use GuzzleHttp\Client;


class GupshupController extends Controller
{

    // public static function sendOtp($mobile,$otp){
    //     // $ch = curl_init();  
    //     // $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest";
    //     // $dataArray = ['method' => 'SendMessage',
    //     //               'send_to' => $mobile,
    //     //               'msg' => 'Your OTP to log in to your Muscle Trail Account is '.$otp.'. This will expire within 5 minutes. - Team Muscle Trail -Muscle Trail',
    //     //               'msg_type' => 'TEXT',
    //     //               'userid' => 2000221833,
    //     //               'password' => 'Muscle@trail8520',
    //     //               'v' => 1.1,
    //     //               'format'=> 'text'];
    
    //     //               $data = http_build_query($dataArray);
    
    //     //               $getUrl = $url."?".$data;
    
    //     // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    //     // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    //     // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //     // curl_setopt($ch, CURLOPT_URL, $getUrl);
    //     // curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
    //     // # Send request.
    //     // $result = curl_exec($ch);
    //     // curl_close($ch); // Close the cURL connection
    //     // $data1= json_decode($result);
    //     // return $data1;
        
    // $ch = curl_init(); 
    // $getUrl = "http://nimbusit.info/api/pushsms.php?user=101276&key=010k8qz33fD08IKJCuAr&sender=BPNJRM&mobile=$mobile&text=Your OTP is '.$otp.'. Do not share it with anyone by any means. This is confidential and to be used by you only. BATTULAAL PRAYAG NARAYAN JEWELLERS.&entityid=1201160654338189327&templateid=1207171705943792490" ;

    // //$data = http_build_query($dataArray);
    
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //     curl_setopt($ch, CURLOPT_URL, $getUrl);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
    //     # Send request.
    //     $result = curl_exec($ch);
    //     //dd($result);
    //     curl_close($ch); // Close the cURL connection
    //     $data1= json_decode($result);
    //     return $data1;








    // }



  



public static function sendOtp($mobile, $otp)  
{
//     $url = "https://myinboxmedia.in/api/mim/SendSMS";
//     $dataArray = [
//         'userid' => 'MIM2400266',
//         'apikey' => '!Xi3Uc47QAi7',
//          'pwd' =>  '!Xi3Uc47QAi7',
//         'sender' => 'AAYURJ',
//         'mobile' => $mobile,
//         'msg' => "Dear customer, use this OTP $otp to log in to your Aayurja account. This OTP will be valid for the next 5 mins.
//  VARDHAN HOLIDAYS",
//          'msgtype'=>33,
//         'peid' => '1201172673449426197',
//         'templateid' => '1207172923800322284',
//     ];
//     $data = http_build_query($dataArray);

//     $getUrl = $url . "?" . $data;

//     $ch = curl_init($getUrl); // Pass the full URL to curl_init
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_TIMEOUT, 80);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//     $result = curl_exec($ch);
//     curl_close($ch);

//     return json_decode($result);


    $url = "https://omnichannelapi.linkext.co.in/api/OmniChannel/OmniChannelMessageAPI";
    $token = "jE3NDMyMzI4ODIsImlhdCI6MTc0MjgwMDg4MiwiaXNzIjoiVmlrYXMiLCJhdWQiOiJWaWthc1M";

    $payload = [
        "profileId" => "CMIM250007",
        "mobileNo" => $mobile,
        "subclientCode" => "01",
        "sms" => [
            "sender" => "RESHTA",
            "msgType" => "13",
            "msgText" => "Dear customer, use this OTP $otp to log in to your Aayurja account. This OTP will be valid for the next 5 mins. RESHITA OVERSEAS LLP",
            "peid" => "1701174704580888673",
            "templateId" => "1707174730523524885"
        ]
    ];

    $client = new Client();

    try {
        $response = $client->post($url, [
            'headers' => [
                'Authorization' => "Bearer $token",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $payload
        ]);

        return json_decode($response->getBody()->getContents(), true);

    } catch (\Exception $e) {
        // Log or return error
        return ['error' => $e->getMessage()];
    }



}



    public static function orderShipedMsg($mobile,$name){
        $ch = curl_init();  
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest";
        $dataArray = ['method' => 'SendMessage',
                      'send_to' => $mobile,
                      'msg' => 'Hi '.$name.', great news: Your order from Muscle Trail is on the way! Tracking details are available on our website: https://muscletrail.shiprocket.co/ -Muscle Trail',
                      'msg_type' => 'TEXT',
                      'userid' => 2000221833,
                      'password' => 'rfw@wZR#',
                      'v' => 1.1,
                      'format'=> 'text'];
    
        $data = http_build_query($dataArray);
    
        $getUrl = $url."?".$data;
    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch); // Close the cURL connection
        $data1= json_decode($result);
        return $data1;
    }

    public static function orderSuccessfullMsg($mobile,$order_id){
        // $ch = curl_init();  

        //  $url = "https://myinboxmedia.in/api/mim/SendSMS";
        //  $dataArray = [
        // 'userid' => 'MIM2400266',
        // 'apikey' => '!Xi3Uc47QAi7',
        //  'pwd' =>  '!Xi3Uc47QAi7',
        // 'sender' => 'AAYURJ',
        // 'mobile' => $mobile,
        // 'msg' => "Order Successful! Your order has been placed successfully. Your order number is '.$order_id.', Thanks for shopping with Aayurja. VARDHAN HOLIDAYS ",
        //  'msgtype'=>33,
        // 'peid' => '1201172673449426197',
        // 'templateid' => '1207172923509846375',
        //  ];
    
        // $data = http_build_query($dataArray);
    
        // $getUrl = $url."?".$data;
    
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_URL, $getUrl);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        // # Send request.
        // $result = curl_exec($ch);
        // curl_close($ch); // Close the cURL connection
        // $data1= json_decode($result);
        // return $data1;




        $url = "https://omnichannelapi.linkext.co.in/api/OmniChannel/OmniChannelMessageAPI";
        $token = "jE3NDMyMzI4ODIsImlhdCI6MTc0MjgwMDg4MiwiaXNzIjoiVmlrYXMiLCJhdWQiOiJWaWthc1M";

        $payload = [
            "profileId" => "CMIM250007",
            "mobileNo" => $mobile,
            "subclientCode" => "01",
            "sms" => [
                "sender" => "RESHTA",
                "msgType" => "13",
                "msgText" => "Order Successful! Your order has been placed successfully. Your order number is '.$order_id.', Thanks for shopping with Aayurja. RESHITA OVERSEAS LLP",
                "peid" => "1701174704580888673",
                "templateId" => "1707174730534761090"
            ]
        ];

        $client = new Client();

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => "Bearer $token",
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $e) {
            // Log or return error
            return ['error' => $e->getMessage()];
        }
    }

    public static function orderCancelMsg($mobile,$order_id){
        $ch = curl_init();  
        $url = "https://myinboxmedia.in/api/mim/SendSMS";
        $dataArray = [
        'userid' => 'MIM2400266',
        'apikey' => '!Xi3Uc47QAi7',
         'pwd' =>  '!Xi3Uc47QAi7',
        'sender' => 'AAYURJ',
        'mobile' => $mobile,
        'msg' => "Payment Failed. Sorry, your payment for order '.$order_id.' was unsuccessful. Please update your payment information to complete your order. Contact Aayurja on 9098786590 for assistance. VARDHAN HOLIDAYS",
         'msgtype'=>33,
        'peid' => '1201172673449426197',
        'templateid' => '1207172923651244269',
        ];
        $data = http_build_query($dataArray);
    
        $getUrl = $url."?".$data;
    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch); // Close the cURL connection
        $data1= json_decode($result);
        return $data1;
    }

    public static function orderDelieveredMsg($mobile,$name){
        $ch = curl_init();  
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest";
        $dataArray = ['method' => 'SendMessage',
                      'send_to' => $mobile,
                      'msg' => "Hello ".$name.", We're happy to update you that your order from Muscle Trail has been delivered. Hope to see you shop again. . -Muscle Trail",
                      'msg_type' => 'TEXT',
                      'userid' => 2000221833,
                      'password' => 'rfw@wZR#',
                      'v' => 1.1,
                      'format'=> 'text'];
    
        $data = http_build_query($dataArray);
    
        $getUrl = $url."?".$data;
    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch); // Close the cURL connection
        $data1= json_decode($result);
        return $data1;
    }

    public static function orderConfirmationMsg($mobile,$name,$order_id){
        $ch = curl_init();  
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest";
        $dataArray = ['method' => 'SendMessage',
                      'send_to' => $mobile,
                    //   'msg' => "Hey ".$name.", Muscle Trail just received your order! We are processing your order now, and we'll let you know when it ships. Thanks for shopping with -Muscle Trail",
                      'msg' => "Hey ".$name.", Your payment has been received and confirmed! Your payment confirmation number is ".$order_id.". We'll keep you updated on the status of your order. Thanks for choosing - -Muscle Trail",
                      'msg_type' => 'TEXT',
                      'userid' => 2000221833,
                      'password' => 'rfw@wZR#',
                      'v' => 1.1,
                      'format'=> 'text'];
    
        $data = http_build_query($dataArray);
    
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch); // Close the cURL connection
        $data1= json_decode($result);
        return $data1;
    }

    public static function orderFeedBack($mobile,$name,$product_url){
        $ch = curl_init();  
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest";
        $dataArray = ['method' => 'SendMessage',
                      'send_to' => $mobile,
                      'msg' => "Hi ".$name."! Thanks for shopping with www.muscletrail.com. We value your feedback! Please post a review about the product and win 100 MT coins ".$product_url.". -Muscle Trail",
                      'msg_type' => 'TEXT',
                      'userid' => 2000221833,
                      'password' => 'rfw@wZR#',
                      'v' => 1.1,
                      'format'=> 'text'];
    
        $data = http_build_query($dataArray);
    
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch); // Close the cURL connection
        // dd($result);
        $data1= json_decode($result);
        return $data1;
    }

    public static function CartAbandoned($mobile){
        $ch = curl_init();  
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest";
        $dataArray = ['method' => 'SendMessage',
                      'send_to' => $mobile,
                      'msg' => "Muscle Trail: It seems you forgot something! Your cart is still waiting for payment. Use code SAVE to get a 25% off for the entire order. Offer Valid Till 30 Mins -Muscle Trail",
                      'msg_type' => 'TEXT',
                      'userid' => 2000221833,
                      'password' => 'rfw@wZR#',
                      'v' => 1.1,
                      'format'=> 'text'];
    
        $data = http_build_query($dataArray);
    
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch); // Close the cURL connection
        // dd($result);
        $data1= json_decode($result);
        return $data1;
    }

    public static function PaymentFailed($mobile,$name,$amount){
        $ch = curl_init();  
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest";
        $dataArray = ['method' => 'SendMessage',
                      'send_to' => $mobile,
                      'msg' => "Hello ".$name.", Your payment of ".$amount." is failed! Don't worry, if any amount has been debited from your account, it will be refunded in 5-7 business days. -Muscle Trail",
                      'msg_type' => 'TEXT',
                      'userid' => 2000221833,
                      'password' => 'rfw@wZR#',
                      'v' => 1.1,
                      'format'=> 'text'];
    
        $data = http_build_query($dataArray);
    
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch); // Close the cURL connection
        // dd($result);
        $data1= json_decode($result);
        return $data1;
    }
}


