<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use PDF;
use Mail;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Referral;
use App\Coupon;
use App\User;                                   
use GuzzleHttp\Client;
use App\Cart;
use App\Order;
use App\BillingAddress;
use App\Transactions;
use Razorpay\Api\Api;
use Exception;

class RazorpayController extends Controller
{
    
    public function paynow(Request $request)
    {
        $ssid = Session::getId();    
        $user_id = Auth::user() ? Auth::user()->id : 0;

        // Get cart
        $carts = Cart::where("user_id", $user_id)
            ->where("order_status", 0)
            ->get();

        // Get user or guest info
        if (Auth::user()) {
            $userinfo = BillingAddress::latest()
                ->where("user_id", $user_id)
                ->first() ?? User::find($user_id);
        } else {
            $userinfo = BillingAddress::latest()
                ->where("ssid", $ssid)
                ->first();
        }

        $subtotal = $subtotal_price = $total_saving = 0;

        foreach ($carts as $cart) {
            $price = $cart->product_variants->price;
            $selling_price = $cart->product_variants->selling_price;
            $subtotal += $selling_price * $cart->quantity;
            $subtotal_price += $price * $cart->quantity;
        }

        $shipping = 0.00;
        $taxes = 0.00;

        $discount_percentage = Session::get('discount_percentage', 0.00);
        $discount_flat = Session::get('discount_flat', 0.00);
        $specific_product_discount = Session::get('specific_product_discount', 0.00);
        $discount_type = Session::get('discount_type');
        $discount_products = Session::get('products', []);
        $coupon_code = Session::get('coupon_title');

        $initial_discount = 0.00;

        if ($discount_type == 'discount_percentage') {
            $initial_discount = $discount_percentage;
        } elseif ($discount_type == 'discount_flat') {
            $initial_discount = $discount_flat;
        } elseif ($discount_type == 'specific_product') {
            
            $discount_products = $discount_products ?? [];

            foreach ($carts as $cart) {
                if (in_array($cart->product_id, $discount_products)) {
                    $product_discount = ($specific_product_discount / 100) * $cart->product_variants->selling_price;
                    $initial_discount += $product_discount * $cart->quantity;
                }
            }
            
        }

        $discount_amount = $discount_type == 'discount_percentage'
            ? ($subtotal * $initial_discount / 100)
            : $initial_discount;

        $total = ($subtotal - $discount_amount) + $taxes + $shipping;
        $total_saving = ($subtotal_price - $subtotal) + $discount_amount;

        // Create Razorpay Order
        // $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
        $api = new Api('rzp_live_sAshsWsYSTCa7o', 'DOUbYFiyPqxlPxGuOelGmxZ1');
        
        // dd(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        try {
            $razorpayOrder = $api->order->create([
                'receipt' => 'order_rcptid_' . uniqid(),
                'amount' => round(round($total) * 100),
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating Razorpay order: ' . $e->getMessage());
        }

        // Generate order_id
        do {
            $order_id = "AAY" . date("ymd") . rand(100000, 999999);
        } while (Order::where('order_id', $order_id)->exists());

        $lastInvoiceId = DB::table('orders')->latest('invoice_no')->value('invoice_no');
        $invoiceId = $lastInvoiceId ? $lastInvoiceId + 1 : 1001;

        foreach ($carts as $cart) {
            Order::create([
                'ssid' => $ssid,
                'order_id' => $order_id,
                'user_id' => $user_id,
                'invoice_no' => $invoiceId,
                'total' => $subtotal,
                'grand_total' => round($total),
                'customer_name' => $userinfo->name . ' ' . $userinfo->last_name,
                'customer_email' => $userinfo->email,
                'customer_phone' => $userinfo->mobile,
                'billing_address' => $userinfo->address . ', ' . $userinfo->city . ', ' . $userinfo->state . ', ' . $userinfo->country . ' - ' . $userinfo->pin_code,
                'shipping_address' => $userinfo->address . ', ' . $userinfo->city . ', ' . $userinfo->state . ', ' . $userinfo->country . ' - ' . $userinfo->pin_code,
                'shipping_pincode' => $userinfo->pin_code,
                'shipping_state' => $userinfo->state,
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->product_name,
                'per_product_price' => $cart->product_variants->selling_price,
                'product_quantity' => $cart->quantity,
                'product_size' => $cart->product_variants->weight ?? null,
                'coupon_used' => $coupon_code,
                'discount_amount' => $discount_amount,
                'status' => 0,
                'transation_code'=>"",
                'providerReferenceId' => $razorpayOrder['id'],
                'payment_source' => 'razorpay',
            ]);
        }

        Transactions::create([
            
            'user_id' => $user_id,
            'txnid' => $order_id,
            'order_id' => $order_id,
            'ssid' => $ssid,
            'transaction_amount' => round($total),
            'transation_code' => 'PAYMENT_PENDING',
            'payment_source' => 'razorpay',

        ]);

        return view('website.payment-page', [
            'key' => 'rzp_live_sAshsWsYSTCa7o',
            'order' => $razorpayOrder,
            'razorpay_order_id' => $razorpayOrder['id'],
            'total' => round($total),
            'user' => $userinfo,
        ]);
    }

   
    
    public function success(Request $request)
    {
        $response = $request->all();
        $razorpay_order_id = $response['razorpay_order_id'] ?? null;
        $payment_id = $response['razorpay_payment_id'] ?? null;
        $signature = $response['razorpay_signature'] ?? null;

        if (!$razorpay_order_id || !$payment_id || !$signature) {
            // Update transaction as FAILED if possible
            if ($razorpay_order_id) {
                Transactions::where('providerReferenceId', $razorpay_order_id)
                    ->update(['transation_code' => 'FAILED']);
            }

            return view('website.payment-failed')->with('error', 'Incomplete payment data received.');
        }

        $api = new \Razorpay\Api\Api('rzp_live_sAshsWsYSTCa7o', 'DOUbYFiyPqxlPxGuOelGmxZ1');

        try {
            // Verify signature
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $payment_id,
                'razorpay_signature' => $signature
            ]);
        } catch (\Exception $e) {
            // Update transaction as FAILED if verification fails
            Transactions::where('providerReferenceId', $razorpay_order_id)
                ->update(['transation_code' => 'FAILED']);

            return view('website.payment-failed')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }

        // Fetch order using Razorpay reference
        $order = Order::where('providerReferenceId', $razorpay_order_id)->first();
        
        if (!$order) {
            Transactions::where('providerReferenceId', $razorpay_order_id)
                ->update(['transation_code' => 'FAILED']);

            return view('website.payment-failed')->with('error', 'Order not found.');
        }

        // Mark order as successful
        Order::where('providerReferenceId', $razorpay_order_id)
            ->update(['status' => 1, 'transation_code' => 'success']);

            $orderid = $order->order_id;

        // Update transaction status to PAID
        Transactions::where('txnid', $order->order_id)
            ->update([
                'transation_code' => 'PAID'
            ]);

        // Mark cart items as ordered
        Cart::where('user_id', Auth::id())->update(['order_status' => 1]);

        // Generate invoice PDF
        $allOrderDetails = Order::where('order_id', $order->order_id)->get();
        $pdf = \PDF::loadView('invoice-pdf-latest-working', [
            'orders' => $order,
            'allOrderDetails' => $allOrderDetails,
            'card_type' => ''
        ]);
        
        $path = public_path('uploads/invoices');
        $fileName = 'Invoice_' . time() . '.pdf';
        $pdf->save($path . '/' . $fileName);
        $invoicePath = 'uploads/invoices/' . $fileName;

        // Send email with invoice
        $emailData = [
            'username' => $order->customer_name,
            'orderid' => $order->order_id
        ];


        //REFER AND EARN START
        if($order->coupon_used)
        {
        $couponDetails = Coupon::where('title', $order->coupon_used)->first();

        if($couponDetails && $couponDetails->user_id)
        {
            $referrer_user = User::where('id', $couponDetails->user_id)->first();

            $referral = new Referral;
            $referral->referrer_id = $referrer_user->id;
            $referral->referred_id = $order->user_id;
            $referral->reward_type = 'points';
            $referral->reward_value = $order->discount_amount;
            $referral->status = 'completed';
            $referral->order_id = $order->order_id;
            $referral->referral_code = $order->coupon_used;
            $referral->transaction_amount = $order->total;
            $referral->save();
        }
        }
        //REFER AND EARN END
        

        //REDEEM POINTS STATUS CHANGE START
        if($order->coupon_used == 'REDEEM_POINTS')
        {
        $redeemDetails = Referral::where('referrer_id', $order->user_id)->orderBy('id', 'desc')->first();

        if($redeemDetails && $redeemDetails->referrer_id)
        {
            // $referrer_user = User::where('id', $redeemDetails->referrer_id)->first();

            $redeemDetails->redemed_value = $order->discount_amount; // Assign the new value
            $redeemDetails->save(); // Save changes to the database
        }
        }
           //REDEEM POINTS STATUS CHANGE END
           Order::where('order_id', $orderid)->update(['invoice' => 'uploads/invoices/'.$fileName]);

        // \Mail::send('email.order_successful', $emailData, function ($message) use ($order, $invoicePath) {
        //     $message->to($order->customer_email, 'Customer')
        //             ->bcc(['contact@88gravity.com','depreet@88gravity.com','kuldeep@88gravity.com','Kushagra@88gravity.com','nitin@88gravity.com','fc@tiaraahotels.com','anmolgalaxy38@gmail.com'])
        //             ->from('anmol@88gravity.com', 'Aayurja')
        //             ->subject('Order Successful')
        //             ->attach(public_path($invoicePath), [
        //                 'as' => 'Invoice.pdf',
        //                 'mime' => 'application/pdf',
        //             ]);
        // });


       
        $config = Configuration::getDefaultConfiguration()
        ->setApiKey('api-key', env('BREVO_API_KEY'));

        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        // Recipients
       
        $to  = [$order->customer_email]; 
        $cc  = ['contact@88gravity.com','depreet@88gravity.com','kuldeep@88gravity.com','Kushagra@88gravity.com','nitin@88gravity.com','fc@tiaraahotels.com'];                       // Leave empty if not needed


        // Email content
        $html = view('email.order_successful', $emailData)->render();

        // Email data
        $emailData = new SendSmtpEmail([
            'subject' => 'Order Successful',
            'sender'  => [
                'name'  => env('BREVO_SENDER_NAME', 'Aayurja'),
                'email' => env('BREVO_SENDER_EMAIL', 'info@aayurja.com'),
            ],
            'to'  => array_map(fn($e) => ['email' => trim($e)], $to),
            'cc'  => array_map(fn($e) => ['email' => trim($e)], $cc),
            'htmlContent' => $html,
            'attachment' => [[
                'content' => base64_encode(file_get_contents(public_path($invoicePath))),
                'name'    => 'Invoice.pdf',
                'type'    => 'application/pdf'
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





        return view('website.payment-success', [
            'status' => 200,
            'order_id' => $order->order_id,
            'payment_id' => $payment_id
        ]);
    }


    public function failed(Request $request)
    {
    return view('website.payment-failed')->with('error', 'Payment cancelled.');
    }








   
    
}
