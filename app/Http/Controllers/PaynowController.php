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
use GuzzleHttp\Client;
// use Barryvdh\DomPDF\Facade as PDF;

class PaynowController extends Controller

{
    use MasterTrait;


    public function paynow(Request $request){

   //dd($request->all());
        
        $ssid= Session::getId();
        $validator = Validator::make($request->all(), [

            'payment_type' => 'required|',
            'discount' => 'required|',
          
       ]);
       if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);

       }

       $payment_type = $request->payment_type;
       $discount = $request->discount;
     
        
        if(Auth::User()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = 0;
        }
        $order_id ='JG-' . time();
        $sellingpricr_subtotal=0;
        $carts = "App\Cart"::where('user_id', Auth::user()->id)->where("order_status", 0)->orwhere('ssid', Session::getId())->get();
        if (Auth::user()) {
           $userinfo = "App\BillingAddress"::latest()->where('user_id', Auth::user()->id)->first();
           if (!$userinfo){
               $userinfo = User::where('id', Auth::user()->id)->first();
           }
       }else{
           $userinfo = "App\BillingAddress"::latest()->where('ssid', Session::getId())->first();
       }
       
        for($i=0;$i<count($carts);$i++){
        $sellingpricr_subtotal += $carts[$i]->item_price_by_weight * $carts[$i]->quantity; 
        }
       $grandtotal = $sellingpricr_subtotal - $discount;
        $parameters = [
            'order_id' => $order_id,
            'currency' => 'INR',
            'merchant_id'=>'2711910',
            'transaction_no' => $order_id,
            'amount' => $grandtotal,
            'billing_name' => $userinfo->name,
            'billing_email' => $userinfo->email,
            'user_id'=> $user_id,
            'billing_address'=>$userinfo->address,
            "billing_city" =>$userinfo->city,
            "billing_state" => $userinfo->state,
            "billing_country"=>$userinfo->country,
            "billing_zip" => $userinfo->pin_code,
            "billing_tel" => $userinfo->mobile,
            'card_type'=>$payment_type,
          ];
          
          $order = Indipay::gateway('CCAvenue')->prepare($parameters);
//dd($order);
          return Indipay::process($order);
    

            }


public function successfulresponse(Request $request)
    
{
    $ssid= Session::getId();
    if(Auth::User()){
        $user_id = Auth::user()->id;
    }else{
        $user_id = 0;
    }
    // For default Gateway
    $response = Indipay::gateway('CCAvenue')->response($request);
//dd($response);
    $status=$response['order_status'];
    $transactions_id = Transactions::insertGetId([
    'payment_type'=>$response['payment_mode'],
    'transaction_amount'=>$response['amount'],
    'payment_id'=> '',
    'payment_source'=> 'ccavenue',
    'user_id'=> $user_id,
    'ssid'=> $ssid,
    'txnid'=> $response['order_status'],
    //'raw_response'=>json_encode($response),
    //'reference_no'=> $response['reference_no'],
    'status'=> 1]); 
  
    $order = Order::create([
        //'reference_no'=> $response['reference_no'],
        'ssid'=>  $ssid,
        'order_id'=>$response['order_id'],
        'user_id'=>$user_id,
        'grand_total'=>$response['amount'],
        'status' =>1,

    ]);
    
    Cart::where(["user_id" => $user_id])->update(['order_status' => 1,"order_id" => $response['order_id'] ]);
    //Cart::where('ssid', $payment->notes->ssid)->delete();
    $token = $token = (string) Str::uuid();
    Session::put('pay_token', $token);
    $url = url('razorpay-payment/success').'?ssid='.$ssid.'&order_id='.$response['order_id'].'&token='.$token;
   return redirect()->to($url);
   // return redirect()->back()->withErrors($e->getMessage());
}








public function cancleresponse(Request $request)
    
{
    
    $ssid= Session::getId();
    if(Auth::User()){
        $user_id = Auth::user()->id;
    }else{
        $user_id = 0;
    }
    // For default Gateway
    $response = Indipay::gateway('CCAvenue')->response($request);
    
    // For Otherthan Default Gateway
    $response = Indipay::gateway('CCAvenue')->response($request);
   // dd($response);
   Transactions::create([
    'payment_type'=>$response['card_type'],
    'transaction_amount'=>$response['amount'],
    'payment_source'=> 'ccavenue',
    'user_id'=> $user_id,
    'ssid'=> $ssid,
    'txnid'=> $response['order_id'],
    'raw_response'=>json_encode($response),
    'status'=> 0]);
    //create order:

    $order = Order::create([
        'ssid'=>  $ssid,
        'order_id'=>$response['order_id'],
        'user_id'=>$user_id,
        'grand_total'=>$response['amount'],
        'status' =>0,

    ]);
    $url = url('razorpay-payment/failure').'?ssid='.$ssid.'&order_id='.$response['order_id'];
    return redirect()->to($url);
}

public function failure(Request $request){
    $ssid = $request->ssid;
    $orderid = $request->order_id; 
    $transactions = $this->singleData("\App\Transactions",["txnid" => $orderid,'ssid' => $ssid]);  
    return view('website.payment-failed')->with(["status" => 400,"ssid" => $ssid,'txnid' => $orderid,"transaction"=>$transactions]);
    
}

public function success(Request $request){
    $ssid = $request->ssid;
    $orderid = $request->order_id; 
    $transactions = $this->singleData("\App\Transactions",["txnid" => $orderid,'ssid' => $ssid]);  
    $orders = Order::where('order_id',$orderid)->get();
    $all_product = Cart::where("order_id", $orderid)->get();
    $billinAdd = "App\BillingAddress"::where('id',$all_product[0]->billing_address)->first();
    $card_type = '';
    $data = array();
    $data['username'] = $billinAdd->name;
    if(!empty($transactions->payment_type)){
        $card_type = $transactions->payment_type;
    } 

    $pdf = PDF::loadView('pdf.invoice', ['orders' => $orders, 'all_product'=> $all_product,'card_type'=> $card_type, 'billinAdd' => $billinAdd]);
    $path = public_path('uploads/invoices');
    $fileName =  'courier' . time() . '.' . 'pdf';
    $pdf->save($path . '/' . $fileName);

    $emailto = $billinAdd->email;
    $arrayEmails = array($emailto);
    $attpath = public_path() . '/uploads/invoices/' . $fileName;

    \Mail::send('email.order_successful', $data, function ($message) use ($arrayEmails, $attpath) {
        $message->to($arrayEmails, 'Just Go');
        $message->bcc(['contact@88gravity.com','nitin@88gravity.com','Kushagra@88gravity.com','kuldeep@88gravity.com','fc@tiaraahotels.com']);
        $message->from('contact@justgo.com', 'Just Go');
        $message->subject('Payment Successful');
        $message->attach(
            $attpath,
            array(
                'as' => 'Invoice.pdf',
                'mime' => 'application/pdf',
            )
        );
    });
    return view('website.success')->with(["status" => 400,"ssid" => $ssid,'txnid' => $orderid,"transaction"=>$transactions]);
    
}



}