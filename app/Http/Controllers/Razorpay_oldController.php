<?php
namespace App\Http\Controllers;
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
// use Barryvdh\DomPDF\Facade as PDF;

class RazorpayController extends Controller

{
    use MasterTrait;

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index()

    {        

        return view('razorpayView'); 

    }

    public function paymentResponse(Request $request){
     
        
        $input = $request->all();
  
    
    $api = new Api('rzp_test_0kMtSZqUs7bW6R', '3cwtqGn8LFrRCE9EoWnUoZVr');

        if($request->has('error')){
            // dd($request->all());
           
            $data = $request->error['metadata'];
            // dd($data);
            $payment_id = json_decode($data)->payment_id;
            $payment = $api->payment->fetch($payment_id);
           
            if(Auth::User()){
                $user_id = Auth::user()->id;
            }else{
                $user_id = 0;
            }
            
            if(isset($payment)){
               
                Transactions::create([
                'transaction_amount'=> $payment['amount']/100,
                'payment_id'=> $payment_id,
                'payment_type'=>$payment->method,
                'payment_source'=> 'razorpay',
                'user_id'=> $user_id,
                'ssid'=> $payment->notes->ssid,
                'txnid'=> $payment->notes->order_id,
                'raw_response'=>json_encode($payment),
                'status'=> 0]);
                //create order:

                $order = Order::create([
                    'payment_id'=> $payment_id,
                    'ssid'=>  $payment->notes->ssid,
                    'order_id'=>$payment->notes->order_id,
                    'user_id'=>$user_id,
                    'grand_total'=>$payment['amount']/100,
                    'status' => 0,
    
                ]);
              

            }
                //return redirect()->to('payment-failed');
                
                $url = url('razorpay-payment/failure').'?ssid='.$payment->notes->ssid.'&order_id='.$payment->notes->order_id;

        }else{
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            
            if(count($input)  && !empty($input['razorpay_payment_id'])) {

                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));  
                  //  dd($payment);

                
                  if(Auth::User()){
                      $user_id = Auth::user()->id;
                  }else{
                      $user_id = 0;
                  }
                    $transactions_id = Transactions::insertGetId([
                    'payment_type'=>$payment->method,
                    'transaction_amount'=> $payment['amount']/100,
                    'payment_id'=> $input['razorpay_payment_id'],
                    'payment_source'=> 'razorpay',
                    'user_id'=> $user_id,
                    'ssid'=> $payment->notes->ssid,
                    'txnid'=> $payment->notes->order_id,
                    'raw_response'=>json_encode($payment),
                    'status'=> 1]); 
                  
                    $order = Order::create([
                        'payment_id'=> $input['razorpay_payment_id'],
                        'ssid'=>  $payment->notes->ssid,
                        'order_id'=>$payment->notes->order_id,
                        'user_id'=>$user_id,
                        'grand_total'=>$payment['amount']/100,
                        'status' =>1,
        
                    ]);
                    
                    Cart::where(["user_id" => $user_id])->update(['order_status' => 1,"order_id" => $payment->notes->order_id]);
                    //Cart::where('ssid', $payment->notes->ssid)->delete();
                    $token = $token = (string) Str::uuid();
                    Session::put('pay_token', $token);
                    $url = url('razorpay-payment/success').'?ssid='.$payment->notes->ssid.'&order_id='.$payment->notes->order_id.'&token='.$token;
                } catch (Exception $e) {
                    // dd($e);
                    return  $e->getMessage();
                    return redirect()->back();
                }
    
            }
        }
        return redirect()->to($url);

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

  

  /*  public function sendMailTest($user_email, $send_data, $email_template,$subject,$attpath){
        \Mail::send($email_template, $send_data, function ($message) use ($user_email,$subject,$attpath){
            $message->to([$user_email]);
            $message->bcc(['depreet@88gravity.com'] );
            $message->from('abhishek@datafolkz.in', 'Data Folkz');
            $message->subject($subject);
            
            $message->attach(
                $attpath,
                array(
                    'as' => 'Invoice.pdf',
                    'mime' => 'application/pdf',
                )
            );
        });
    }*/
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
            $message->bcc(['contact@justgo.com']);
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

