<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PDFController;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Auth;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use Exception;
use App\Transactions;
use PDF;
use App\Order;
use App\Cart;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Traits\MasterTrait;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Support\Facades\Redirect;

use GuzzleHttp\Client;

class PhonepayController extends Controller
{
    use MasterTrait;

    public function paynow(Request $request)
    {
        $ssid = Session::getId();
        $validator = Validator::make($request->all(), [
            "payment_type" => "required|",
          
        ]);

        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $payment_type = $request->payment_type;
        $discount = $request->discount;

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
       
         // test
         $merchantId = 'PGTESTPAYUAT86';
         $apiKey = '96434309-7796-489d-8924-ab56988a6076';

       

        $redirectUrl = route('confirm');
       // $order_id = uniqid();
        $order_id = "GiFT-" . uniqid();

        //dd(count($carts));

//create order
for ($i = 0; $i < count($carts); $i++) {
        $order = Order::create([
            'ssid'=>  $ssid,
            'order_id'=>$order_id,
            'user_id'=>$user_id,
            'total'=>$subtotal,  
            'grand_total'=>$total,
            'customer_name' => $userinfo->name . ' ' . $userinfo->last_name,
            'customer_email'=>$userinfo->email,
            'customer_phone'=>$userinfo->mobile,
            'billing_address'=>$userinfo->address. ' ' . $userinfo->city. ' ' . $userinfo->state. ' ' .$userinfo->country,
            'shipping_address'=>$userinfo->address. ' ' . $userinfo->city. ' ' . $userinfo->state. ' ' .$userinfo->country,
            'product_id'=>$carts[$i]->product_id,
            'product_name'=>$carts[$i]->product->product_name,
            'per_product_price'=>  $carts[$i]->product_variants->selling_price,
            'product_quantity'=> $carts[$i]->quantity,
            'product_size' => $carts[$i]->product_variants->weight ?? null,
            'coupon_used'=>$coupon_title,
            'discount_amount'=>$discount_amount,
            'status' =>0,
            'transation_code'=>"",
            'providerReferenceId'=>'',
           ]);
        }

       $transaction_data = array(
        'merchantId' => "$merchantId",
        'merchantTransactionId' => "$order_id",
        "merchantUserId"=>"$order_id",
        'amount' => $total*100,
        'redirectUrl'=>"$redirectUrl",
        'redirectMode'=>"POST",
        'callbackUrl'=>"$redirectUrl",
        'mobileNumber'=>"$userinfo->mobile",
       "paymentInstrument"=> array(    
        "type"=> "PAY_PAGE",
      )
    );
         

        $encode = json_encode($transaction_data);
        $payloadMain = base64_encode($encode);
        $salt_index = 1; //key index 1
        $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
        $sha256 = hash("sha256", $payload);
        $final_x_header = $sha256 . '###' . $salt_index;
        $request = json_encode(array('request'=>$payloadMain));
        
            $curl = curl_init();
            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $final_x_header,
            "accept: application/json"
            ],
          ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        $res = json_decode($response);
// //dd($res);
// // Store information into database

        $data = [
        'user_id'=> $user_id, 
        'txnid' => $order_id,
        'order_id'=>$order_id,
        'transation_code' => 'PAYMENT_PENDING',
        'raw_response'=>$response,
        'providerReferenceId'=>'',
        'merchantOrderId'=>'',
        'checksum'=>''
        ];
        Transactions::create($data);

// end database insert

if(isset($res->code) && ($res->code=='PAYMENT_INITIATED')){

$payUrl=$res->data->instrumentResponse->redirectInfo->url;

return redirect()->away($payUrl);
}else{
//HANDLE YOUR ERROR MESSAGE HERE
    dd($res);
}
}
} 

//responce

public function confirmPayment(Request $request) {
    $ssid= Session::getId();
    if(Auth::User()){
        $user_id = Auth::user()->id;
    }else{
        $user_id = 0;
    }

    if (Auth::user()) {
        $userinfo = ("App\BillingAddress")
            ::latest()
            ->where("user_id", Auth::user()->id)
            ->first();
      
    }
        $transactionId = $request->transactionId;
        $merchantId=$request->merchantId;
        $providerReferenceId=$request->providerReferenceId;
        $merchantOrderId=$request->merchantOrderId;
        $checksum=$request->checksum;
        $status=$request->code;
        $amount=$request->amount;
        
        //Transaction completed, You can add transaction details into database
        if($request->code == 'PAYMENT_SUCCESS')
        {
        $data = [
        'transaction_amount'=>$amount,
        'providerReferenceId' => $providerReferenceId,
        'checksum' => $checksum,
        'payment_source'=> 'Phonepay',
        'user_id'=> $user_id,
        'ssid'=> $ssid,
        'txnid'=> $transactionId,
        'transation_code'=>$status,
        'status'=>1,
        ];
        if($merchantOrderId !=''){
        $data['merchantOrderId']=$merchantOrderId;
        }

        Transactions::where('txnid', $transactionId)->update($data); 

        Order::where('order_id', $transactionId)->update([
            'status'=>1,'transation_code'=>$status,
            'providerReferenceId' => $providerReferenceId]); 
        
    Cart::where(["user_id" => $user_id])->update(['order_status' => 1,"order_id" => $transactionId ]);
    $token = $token = (string) Str::uuid();
    Session::put('pay_token', $token);
    $url = url('phonepay/success').'?ssid='.$ssid.'&order_id='.$transactionId.'&token='.$token;
    return redirect()->to($url);
        }
        else{
            
            $data = [
                'transaction_amount'=>$amount,
                'providerReferenceId' => $providerReferenceId,
                'checksum' => $checksum,
                'payment_source'=> 'Phonepay',
                'user_id'=> $user_id,
                'ssid'=> $ssid,
                'txnid'=> $transactionId,
                'transation_code'=>$status,
                'status'=>0,
                ];
        
                if($merchantOrderId !=''){
                $data['merchantOrderId']=$merchantOrderId;
                }
                Transactions::where('txnid', $transactionId)->update($data); 
                $token = $token = (string) Str::uuid();
                Session::put('pay_token', $token);
                $url = url('phonepay/payment-failed').'?ssid='.$ssid.'&order_id='.$transactionId.'&token='.$token;
                return redirect()->to($url);

                //return view('website.dikline_payment',compact('providerReferenceId', 'transactionId'));
            }
}





//mail and invoice


public function success(Request $request){
    $ssid = $request->ssid;
    $orderid = $request->order_id; 
    $transactions = $this->singleData("\App\Transactions",["txnid" => $orderid,'ssid' => $ssid]);  
    $orders = Order::where('order_id',$orderid)->first();
   // $all_product = Cart::where("order_id", $orderid)->get();
    //$billinAdd = "App\BillingAddress"::where('id',$all_product[0]->billing_address)->first();
    $card_type = '';
    $data = array();
    $data['username'] = $orders->customer_name;

    $allOrderDetails = Order::where('order_id',$orderid)->get();
    $pdf = PDF::loadView('invoice-pdf', [
        'orders' => $orders,
        'allOrderDetails' => $allOrderDetails,
        'card_type' => $card_type,
        
    ]);
    $path = public_path('uploads/invoices');
    $fileName = 'GIFT-invoice' . time() . '.pdf';
    $pdf->save($path . '/' . $fileName);
     $emailto = $orders->customer_email;
     $arrayEmails = array($emailto);
     $attpath = public_path() . '/uploads/invoices/'.$fileName;

    \Mail::send('email.order_successful', $data, function ($message) use ($arrayEmails , $attpath) {
        $message->to($arrayEmails, 'Aayuraj ');
        $message->bcc(['nitish.88gravity@gmail.com']);
        $message->bcc(['depreet@88gravity.com']);
        $message->from('nitish@88gravity.com', 'Aayuraj ');
        $message->subject('Payment Successful');
        $message->attach(
            $attpath,
            array(
                'as' => 'Invoice.pdf',
                'mime' => 'application/pdf',
            )
        );
    });
    
    Order::where('order_id', $orderid)->update(['invoice' => 'uploads/invoices/'.$fileName]);
    Cart::where("user_id", $orders->user_id)->delete();
    return view('website.payment-success')->with(["status" => 400,"ssid" => $ssid,'txnid' => $orderid,"transaction"=>$transactions]);
    


}


public function failed(Request $request){
    $ssid = $request->ssid;
    $orderid = $request->order_id; 
    $transactions = $this->singleData("\App\Transactions",["txnid" => $orderid,'ssid' => $ssid]);  
    $orders = Order::where('order_id',$orderid)->get();
    $all_product = Cart::where("order_id", $orderid)->get();
    $billinAdd = "App\BillingAddress"::where('id',$all_product[0]->billing_address)->first();
    $data = array();
    $data['username'] = $orders->customer_name;;
    $emailto = $orders->email;
    $arrayEmails = array($emailto);

    \Mail::send('email.fail_transaction', $data, function ($message) use ($arrayEmails, $attpath) {
        $message->to($arrayEmails, 'Giftopia');
        $message->bcc(['nitish@88gravity.com']);
        $message->from('nitish@88gravity.com', 'Giftopia ');
        $message->subject('Payment fail');
        
    });
    return view('website.payment-failed')->with(["status" => 400,"ssid" => $ssid,'txnid' => $orderid,"transaction"=>$transactions]);
    


}


}




       





