<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PDFController;
use Illuminate\Http\Request;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use Session;
use Auth;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use Exception;
use App\Transactions;
use PDF;
use Mail;
use App\Order;
use App\Cart;
use App\Http\Controllers\Traits\MasterTrait;
use Softon\Indipay\Facades\Indipay; 
use Illuminate\Support\Facades\Redirect; 
use App\Http\Controllers\DelhiveryController;
use App\Http\Controllers\GupshupController;
use App\Referral;
use App\Coupon;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PayuController extends Controller
{
    use MasterTrait;

  


    protected $delhiveryController;

    public function __construct(DelhiveryController $delhiveryController)
    {
        $this->delhiveryController = $delhiveryController;
    }




    public function paynow(Request $request)
{   

    $ssid = Session::getId();
   // dd('hi');

    $payment_type = $request->payment_type;
   
    if (Auth::User()) {
        $user_id = Auth::user()->id;
    } else {
        $user_id = 0;
    }
   
    $sellingpricr_subtotal = 0;
    $carts = ("App\Cart")
        ::where("user_id", Auth::user()->id)
        ->where("order_status", 0)
        ->get();

    if (Auth::user()) {
        $userinfo = ("App\BillingAddress")
            ::latest()
            ->where("user_id", Auth::user()->id)
            ->first();
        if (!$userinfo) {
            $userinfo = User::where("id", Auth::user()->id)->first();
        }
    } else {
        $userinfo = ("App\BillingAddress")
            ::latest()
            ->where("ssid", Session::getId())
            ->first();
    }
    
    $item_Price = 0;
    $item_sel_Price = 0;
    $con = 0;
    $subtotal = 0;
    $total_saving = 0;
    for ($i = 0; $i < count($carts); $i++) {
        $con = $con + $carts[$i]->quantity;
        $item_Price = $carts[$i]->product_variants->price;
        $item_sel_Price = $carts[$i]->product_variants->selling_price;
        $subtotal = $subtotal + $item_sel_Price * $carts[$i]->quantity;
    }
    $shipping = 0.0;
    $taxes = 0.0;
    $shipping = 0.0;
    $discount_percentage = Session::get("discount_percentage");
    $discount_flat = Session::get("discount_flat");
    $coupon_title = Session::get("coupon_title");
    if (!empty($carts) && count($carts) > 0) {
        if ($discount_percentage == 0.0 && $discount_flat == 0.0) {
            $initial_discount = 0.0;
            $coupon_code = null;
        } else {
            if ($discount_percentage != 0.0) {
                $initial_discount = $discount_percentage;
            } else {
                $initial_discount = $discount_flat;
            }

            $coupon_code = $coupon_title;
        }
    } else {
        Session::put("discount_percentage", 0.0);
        Session::put("discount_flat", 0.0);
        Session::put("coupon_title", null);

        $initial_discount = 0.0;
        $coupon_code = null;
    }

    if ($discount_percentage != 0.0) {
        $discount_amount = ($subtotal * $initial_discount) / 100;
    } else {
        $discount_amount = $initial_discount;
    }
  
    $total = $subtotal - $discount_amount + $taxes + $shipping;
    $total_saving = $item_Price - $item_sel_Price + $discount_amount;

    $redirectUrl = route('confirm');
   // $order_id = "Aayuja-" . uniqid();

   do {
    $order_id = "AAY" . date("ymd") . rand(100000, 999999);
} while (Order::where('order_id', $order_id)->exists());

   // dd($userinfo);

    
//create order
 for ($i = 0; $i < count($carts); $i++) {
    $order = Order::create([
        'ssid'=>  $ssid,
        'order_id'=>$order_id,
        'user_id'=>$user_id,
        'total'=>$subtotal,  
        'grand_total'=>round($total),
        'customer_name' => $userinfo->name . ' ' . $userinfo->last_name,
        'customer_email'=>$userinfo->email,
        'customer_phone'=>$userinfo->mobile,
        'billing_address'=>$userinfo->address. ', ' . $userinfo->city. ', ' . $userinfo->state. ', ' .$userinfo->country. ' - ' .$userinfo->pin_code,
        'shipping_address'=>$userinfo->address. ', ' . $userinfo->city. ', ' . $userinfo->state. ', ' .$userinfo->country. ' - ' .$userinfo->pin_code,
        'shipping_pincode'=>$userinfo->pin_code,
        'shipping_state'=>$userinfo->state,
        'product_id'=>$carts[$i]->product_id,
        'product_name'=>$carts[$i]->product->product_name,
        'per_product_price'=>  $carts[$i]->product_variants->selling_price,
        'product_quantity'=> $carts[$i]->quantity,
        'product_size' => $carts[$i]->product_weight->size ?? null,
        'coupon_used'=>$coupon_title,
        'discount_amount'=>$discount_amount,
        'status' =>0,
        'payment_source'=>'payU',
        'transation_code'=>"",
        'providerReferenceId'=>'',
       ]);
    }

//create transation table
$data = [
    'user_id' => $user_id, 
    'txnid' => $order_id,
    'order_id' => $order_id,
    'ssid' => $ssid,
    'transaction_amount' => round($total),
    'transation_code' => "PAYMENT_PENDING",
];
Transactions::create($data);



    $parameters = [
        'txnid' => $order_id,
        'amount' => round($total),
        'firstname' => $userinfo->name . ' ' . $userinfo->last_name,
        'email' => $userinfo->email,
        'phone' =>$userinfo->mobile,
        'surl' => "$redirectUrl",
        'furl' => "$redirectUrl",
        'productinfo' => 'PHP Project Subscribe',
        'key' => '2dskrc',
        'service_provider' => 'payu_paisa',
        
    ];

     $order = Indipay::gateway('payu')->prepare($parameters);
     return Indipay::process($order);

}







public function confirmPayment(Request $request)
 {
    $ssid= Session::getId();
    if(Auth::User()){
        $user_id = Auth::user()->id;
    }else{
        $user_id = 0;
    }


       $response = Indipay::gateway('payu')->response($request);
    //    dd($response);
        $transactionId = $response['txnid'];
        $order_id = $response['txnid'];
        $amount=$response['amount'];
        $status = $response['status'];
        $customer_phone = $response['phone'];
        $providerReferenceId  = $response['bank_ref_num'];


        if ($status === 'success') {
        
        $data = [
        'user_id'=> $user_id,
        'ssid'=> $ssid,
        'transaction_amount'=>$amount,
        'payment_source'=> 'payu',
        'transation_code'=>$status,
        'status'=>1,
        'raw_response'=>$response,
        
        ];
        
        $lastInvoiceId = DB::table('orders')
        ->latest('invoice_no')
        ->value('invoice_no');
        $invoiceId = $lastInvoiceId + 1;


        Transactions::where('txnid', $transactionId)->update($data); 
        Order::where('order_id', $transactionId)->update([
            'status'=>1,'providerReferenceId'=>$providerReferenceId,'transation_code'=>$status,'invoice_no'=>$invoiceId]); 

        Cart::where("user_id", $user_id)->delete();  
    
    $token = $token = (string) Str::uuid();
    Session::put('pay_token', $token);
    GupshupController::orderSuccessfullMsg($customer_phone,$transactionId);
    $this->delhiveryController->forwardOrder($order_id);
    $url = url('payment/success').'?ssid='.$ssid.'&order_id='.$transactionId.'&token='.$token;
    return redirect()->to($url);
        }
        else{
            
            $data = [
                'transaction_amount'=>$amount,
                'payment_source'=> 'payu',
                'user_id'=> $user_id,
                'ssid'=> $ssid,
                'txnid'=> $transactionId,
                'transation_code'=>$status,
                'status'=>0,
                'raw_response'=>$response,
                ];
                Transactions::where('txnid', $transactionId)->update($data); 
                $token = $token = (string) Str::uuid();
                Session::put('pay_token', $token);
                $url = url('payment/failed').'?ssid='.$ssid.'&order_id='.$transactionId.'&token='.$token;
                return redirect()->to($url);

            }
}


public function success(Request $request){


    if(Session::has('pay_token')){
        $pay_token = Session::get('pay_token');
    }else{
        $pay_token = 'na';
    }
    
   if($request->token == $pay_token){
       Session::forget('pay_token');

    $ssid = $request->ssid;
    $orderid = $request->order_id; 
    $transactions = $this->singleData("\App\Transactions",["txnid" => $orderid,'ssid' => $ssid]);  
    $orders = Order::where('order_id',$orderid)->first();

    $card_type = '';
    $data = array();
    $data['username'] = $orders->customer_name;
    $data['orderid'] = $orderid;

    $allOrderDetails = Order::where('order_id',$orderid)->get();
    $pdf = PDF::loadView('invoice-pdf-latest-working', [
        'orders' => $orders,
        'allOrderDetails' => $allOrderDetails,
        'card_type' => $card_type,
        
    ]);
    $path = public_path('uploads/invoices');
    $fileName = 'Ayurja-invoice' . time() . '.pdf';
    $pdf->save($path . '/' . $fileName);
     $emailto = $orders->customer_email;
     $arrayEmails = array($emailto);
     $attpath = public_path() . '/uploads/invoices/'.$fileName;





    //REFER AND EARN START
     if($orders->coupon_used)
     {
        $couponDetails = Coupon::where('title', $orders->coupon_used)->first();

        if($couponDetails && $couponDetails->user_id)
        {
            $referrer_user = User::where('id', $couponDetails->user_id)->first();

            $referral = new Referral;
            $referral->referrer_id = $referrer_user->id;
            $referral->referred_id = $orders->user_id;
            $referral->reward_type = 'points';
            $referral->reward_value = $orders->discount_amount;
            $referral->status = 'completed';
            $referral->order_id = $orders->order_id;
            $referral->referral_code = $orders->coupon_used;
            $referral->transaction_amount = $orders->total;
            $referral->save();
        }
     }
     //REFER AND EARN END



     //REDEEM POINTS STATUS CHANGE START
     if($orders->coupon_used == 'REDEEM_POINTS')
     {
        $redeemDetails = Referral::where('referrer_id', $orders->user_id)->orderBy('id', 'desc')->first();

        if($redeemDetails && $redeemDetails->referrer_id)
        {
            // $referrer_user = User::where('id', $redeemDetails->referrer_id)->first();

            $redeemDetails->redemed_value = $orders->discount_amount; // Assign the new value
            $redeemDetails->save(); // Save changes to the database
        }
     }
     //REDEEM POINTS STATUS CHANGE END






    Order::where('order_id', $orderid)->update(['invoice' => 'uploads/invoices/'.$fileName]);


    // \Mail::send('email.order_successful', $data, function ($message) use ($arrayEmails , $attpath) {
    //     $message->to($arrayEmails, 'Aayurja ');
    //     $message->bcc(['contact@88gravity.com','depreet@88gravity.com','kuldeep@88gravity.com','Kushagra@88gravity.com','nitin@88gravity.com','fc@tiaraahotels.com','anmolgalaxy38@gmail.com']);
    //     $message->from('anmol@88gravity.com', 'Aayurja ');
    //     $message->subject('Order Successful');
    //     $message->attach(
    //         $attpath,
    //         array(
    //             'as' => 'Invoice.pdf',
    //             'mime' => 'application/pdf',
    //         )
    //     );
    // });
    
   
     $config = Configuration::getDefaultConfiguration()
    ->setApiKey('api-key', env('BREVO_API_KEY'));
$apiInstance = new TransactionalEmailsApi(new Client(), $config);

// Recipients
$to  = $arrayEmails; 
$cc  = ['contact@88gravity.com','depreet@88gravity.com','kuldeep@88gravity.com','Kushagra@88gravity.com','nitin@88gravity.com','fc@tiaraahotels.com'];

// Email content
$html = view('email.order_successful', $data)->render();

// Email data
$emailData = new SendSmtpEmail([
    'subject' => 'Order Successful',
    'sender'  => [
        'name'  => env('BREVO_SENDER_NAME', 'Aayurja'),
        'email' => env('BREVO_SENDER_EMAIL', 'info@aayurja.com'),
    ],
    'to'   => array_map(fn($e) => ['email' => trim($e)], $to),
    'cc'   => array_map(fn($e) => ['email' => trim($e)], $cc),
    'htmlContent' => $html,

    // ✅ safer: send file directly instead of URL
    'attachment' => [[
        'content' => base64_encode(file_get_contents($attpath)),
        'name'    => 'Invoice.pdf',
    ]],
]);

try {
    $result = $apiInstance->sendTransacEmail($emailData);
    \Log::info('Brevo Email Response:', (array) $result);
} catch (\Exception $e) {
    \Log::error('Brevo Email Error: ' . $e->getMessage());
    return response()->json([
        'success' => false,
        'message' => 'Email sending failed.',
        'error'   => $e->getMessage(),
    ], 500);
}


    //WHATSAPP MESSAGE SEND FOR ORDER SUCCESSFUL START
    $order = Order::where('order_id', $orderid)->first();

    if (!$order || !$order->user_id || !$order->customer_name || !$order->product_name) {
        Log::warning("Incomplete order data for Order ID: $orderid");
        return;
    }

    // Fetch user details
    $user = User::find($order->user_id); // Assuming a `User` model exists

    if (!$user || !$user->mobile) {
        Log::warning("No phone number for user ID: {$order->user_id}");
        return;
    }

    // Prepare dynamic product details
    $allOrders = Order::where('order_id', $orderid)->get();

    $productDetails = [];
    foreach ($allOrders as $allOrder) {
        $productDetails[] = "{$allOrder->product_name} (Qty: {$allOrder->product_quantity})";
    }
    $productsText = implode(", ", $productDetails);



    $client = new Client();
    $watiApiUrl = "https://live-mt-server.wati.io/444418/api/v1/sendTemplateMessage?whatsappNumber=91{$user->mobile}";
    $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJlOWIxMmMwZC03YWQ1LTRmMTQtOGRkYi1iOTYxZjkzNTk4MTciLCJ1bmlxdWVfbmFtZSI6Imt1bGRlZXBAODhncmF2aXR5LmNvbSIsIm5hbWVpZCI6Imt1bGRlZXBAODhncmF2aXR5LmNvbSIsImVtYWlsIjoia3VsZGVlcEA4OGdyYXZpdHkuY29tIiwiYXV0aF90aW1lIjoiMDUvMTkvMjAyNSAxMjoxOTowNiIsInRlbmFudF9pZCI6IjQ0NDQxOCIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.m_LvCzL8-W-Bsoo9ynEBynAQyYmqzEbUZ-B1Ko_HGIw';

    try {
        $response = $client->post($watiApiUrl, [
            'headers' => [
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'template_name' => 'order_successful_temp', // Your WATI template name
                'broadcast_name' => 'order_successful_temp',
                'parameters' => [
                    ['name' => 'name', 'value' => $order->customer_name], // Customer name
                    ['name' => 'order_number', 'value' => $order->order_id], // Order ID
                    ['name' => 'product_details', 'value' => $productsText], // Product details
                    ['name' => 'total_price', 'value' => $order->grand_total ?? 'N/A'], // Optional
                ],
                'phone_number' => '91' . $user->mobile,
            ],
        ]);

        // Log success
        $responseBody = $response->getBody()->getContents();
        $statusCode = $response->getStatusCode();
        Log::info("WhatsApp message sent successfully for Order ID: {$order->order_id} to: {$user->mobile}");
    } catch (\Exception $e) {
        Log::error("Failed to send WhatsApp message for Order ID: {$order->order_id} to {$user->mobile}: " . $e->getMessage());
    }
    //WHATSAPP MESSAGE SEND FOR ORDER SUCCESSFUL START








    return view('website.payment-success')->with(["status" => 400,"ssid" => $ssid,'txnid' => $orderid,"transaction"=>$transactions]);
    
   }

   else{
    return "invalid request";
   }

}


public function failed(Request $request){
    //sdd('dfdf');
    $ssid = $request->ssid;
    $orderid = $request->order_id; 
    $transactions = $this->singleData("\App\Transactions",["txnid" => $orderid,'ssid' => $ssid]);  
    $orders = Order::where('order_id',$orderid)->first();
    $data = array();
    $data['username'] = $orders->customer_name;
    $emailto = $orders->customer_email;
    $arrayEmails = array($emailto);




    //REFER AND EARN START
    if($orders->coupon_used)
    {
       $couponDetails = Coupon::where('title', $orders->coupon_used)->first();

       if($couponDetails->user_id)
       {
           $referrer_user = User::where('id', $couponDetails->user_id)->first();

           $referral = new Referral;
           $referral->referrer_id = $referrer_user->id;
           $referral->referred_id = $orders->user_id;
           $referral->reward_type = 'points';
           $referral->reward_value = $orders->discount_amount;
           $referral->status = 'pending';
           $referral->order_id = $orders->order_id;
           $referral->referral_code = $orders->coupon_used;
           $referral->save();
       }
    }
    //REFER AND EARN END






    // \Mail::send('email.fail_transaction', $data, function ($message) use ($arrayEmails) {
    //     $message->to($arrayEmails, 'Aayurja');
    //     $message->bcc(['nitish@88gravity.com','contact@88gravity.com','depreet@88gravity.com','ankushsharma@88gravity.com']);
    //     $message->from('anmol@88gravity.com', 'Aayurja ');
    //     $message->subject('Payment fail');
        
    // });

    $config = Configuration::getDefaultConfiguration()
    ->setApiKey('api-key', env('BREVO_API_KEY'));
$apiInstance = new TransactionalEmailsApi(new Client(), $config);

// Recipients
$to  = $arrayEmails; 
// $cc  = ['contact@88gravity.com','depreet@88gravity.com','kuldeep@88gravity.com','Kushagra@88gravity.com','nitin@88gravity.com','fc@tiaraahotels.com'];
$cc  = ['saurabhkumar1@88gravity.com','nitish@88gravity.com'];


// Email content
$html = view('email.fail_transaction', $data)->render();

// Email data
$emailData = new SendSmtpEmail([
    'subject' => 'Order Successful',
    'sender'  => [
        'name'  => env('BREVO_SENDER_NAME', 'Aayurja'),
        'email' => env('BREVO_SENDER_EMAIL', 'info@aayurja.com'),
    ],
    'to'   => array_map(fn($e) => ['email' => trim($e)], $to),
    'cc'   => array_map(fn($e) => ['email' => trim($e)], $cc),
    'htmlContent' => $html,
]);

try {
    $result = $apiInstance->sendTransacEmail($emailData);
    \Log::info('Brevo Email Response:', (array) $result);
} catch (\Exception $e) {
    \Log::error('Brevo Email Error: ' . $e->getMessage());
    return response()->json([
        'success' => false,
        'message' => 'Email sending failed.',
        'error'   => $e->getMessage(),
    ], 500);
}



    //WHATSAPP MESSAGE SEND FOR ORDER FAILED START
    $order = Order::where('order_id', $orderid)->first();

    if (!$order || !$order->user_id || !$order->customer_name || !$order->product_name) {
        Log::warning("Incomplete order data for Order ID: $orderid");
        return;
    }

    // Fetch user details
    $user = User::find($order->user_id); // Assuming a `User` model exists

    if (!$user || !$user->mobile) {
        Log::warning("No phone number for user ID: {$order->user_id}");
        return;
    }

    $client = new Client();
    $watiApiUrl = "https://live-mt-server.wati.io/356491/api/v1/sendTemplateMessage?whatsappNumber=91{$user->mobile}";
    $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJmMjdmZjAzYS0zMTU0LTRmNTktODA5MC02Zjc5OGNhZDFmNWQiLCJ1bmlxdWVfbmFtZSI6ImluZm9AYWF5dXJqYS5jb20iLCJuYW1laWQiOiJpbmZvQGFheXVyamEuY29tIiwiZW1haWwiOiJpbmZvQGFheXVyamEuY29tIiwiYXV0aF90aW1lIjoiMTEvMjIvMjAyNCAxMDo1MDo1MiIsInRlbmFudF9pZCI6IjM1NjQ5MSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.YPj6NVk8_ocJzjwDpTBSkmfqnqKzgBmvyGGo9cAxQ_c';

    try {
        $response = $client->post($watiApiUrl, [
            'headers' => [
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'template_name' => 'order_failed_temp', // Your WATI template name
                'broadcast_name' => 'order_failed_temp',
                'parameters' => [
                    ['name' => 'name', 'value' => $order->customer_name], // Customer name
                    ['name' => 'order_number', 'value' => $order->order_id], // Order ID
                ],
                'phone_number' => '91' . $user->mobile,
            ],
        ]);

        // Log success
        $responseBody = $response->getBody()->getContents();
        $statusCode = $response->getStatusCode();
        Log::info("Order failed, WhatsApp message sent successfully for Order ID: {$order->order_id} to: {$user->mobile}");
    } catch (\Exception $e) {
        Log::error("Order failed, Failed to send WhatsApp message for Order ID: {$order->order_id} to {$user->mobile}: " . $e->getMessage());
    }
    //WHATSAPP MESSAGE SEND FOR ORDER FAILED END






    return view('website.payment-failed')->with(["status" => 400,"ssid" => $ssid,'txnid' => $orderid,"transaction"=>$transactions]);
    


}






public function invoice_Genrate(Request $request)
{

    $request->validate([
        'order_id' => 'required|exists:orders,order_id',
    ]);

$orderid = $request->order_id; 
$order_id = $request->order_id; 
$orders = Order::where('order_id',$orderid)->first();

Order::where('order_id', $orderid)->update(['status' => '1']);
$allOrderDetails = Order::where('order_id',$orderid)->get();
$data = array();
    $data['username'] = $orders->customer_name;
    $data['orderid'] = $orderid;
    $pdf = PDF::loadView('invoice-pdf-latest-working', [
        'orders' => $orders,
        'allOrderDetails' => $allOrderDetails,
      
        
    ]);
        $path = public_path('uploads/invoices');
        $fileName = 'Ayurja-invoice' . time() . '.pdf';
        $pdf->save($path . '/' . $fileName);
        $emailto = $orders->customer_email;
        $arrayEmails = array($emailto);
        $attpath = public_path() . '/uploads/invoices/'.$fileName;

    //  \Mail::send('email.order_successful', $data, function ($message) use ($arrayEmails , $attpath) {
    //     $message->to($arrayEmails, 'Aayurja ');
    //     $message->bcc(['contact@88gravity.com','depreet@88gravity.com','kuldeep@88gravity.com','Kushagra@88gravity.com','nitin@88gravity.com','fc@tiaraahotels.com']);
    //     $message->from('saurabhkumar1@88gravity.com', 'Aayurja ');
    //     $message->subject('Order Successful');

    //     $message->attach($attpath, [
    //         'as' => 'Invoice.pdf',
    //         'mime' => 'application/pdf',
    //     ]);



// 1. Setup Brevo config
$config = Configuration::getDefaultConfiguration()
    ->setApiKey('api-key', env('BREVO_API_KEY'));
$apiInstance = new TransactionalEmailsApi(new Client(), $config);

// Recipients
$to  = $arrayEmails; 
$cc  = ['contact@88gravity.com','depreet@88gravity.com','kuldeep@88gravity.com','Kushagra@88gravity.com','nitin@88gravity.com','fc@tiaraahotels.com'];


// Email content
$html = view('email.order_successful', $data)->render();

// Email data
$emailData = new SendSmtpEmail([
    'subject' => 'Order Successful',
    'sender'  => [
        'name'  => env('BREVO_SENDER_NAME', 'Aayurja'),
        'email' => env('BREVO_SENDER_EMAIL', 'info@aayurja.com'),
    ],
    'to'   => array_map(fn($e) => ['email' => trim($e)], $to),
    'cc'   => array_map(fn($e) => ['email' => trim($e)], $cc),
    'htmlContent' => $html,

    // ✅ safer: send file directly instead of URL
    'attachment' => [[
        'content' => base64_encode(file_get_contents($attpath)),
        'name'    => 'Invoice.pdf',
    ]],
]);

try {
    $result = $apiInstance->sendTransacEmail($emailData);
    \Log::info('Brevo Email Response:', (array) $result);
} catch (\Exception $e) {
    \Log::error('Brevo Email Error: ' . $e->getMessage());
    return response()->json([
        'success' => false,
        'message' => 'Email sending failed.',
        'error'   => $e->getMessage(),
    ], 500);
}

// Update order and download invoice
Order::where('order_id', $orderid)->update(['invoice' => 'uploads/invoices/'.$fileName]);
return response()->download($path . '/' . $fileName);
}


}
