<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PDFController;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use Exception;
use App\Transactions;
use PDF;
use Mail;
use DB;
use App\Order;
use App\Cart;
use App\Http\Controllers\GupshupController;
use App\Http\Controllers\DelhiveryController;
use App\Http\Controllers\Traits\MasterTrait;
use Softon\Indipay\Facades\Indipay; 
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client; 
use Cashfree\Cashfree;
use Cashfree\Model\CreateOrderRequest;
use Cashfree\Model\CustomerDetails;
use Cashfree\Model\OrderMeta;
use Carbon\Carbon;
class CashfreeController extends Controller
{
    
       

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
                        $subtotal_price = 0;
                        $total_saving = 0;
                        for ($i = 0; $i < count($carts); $i++) {
                            $con += $carts[$i]->quantity;
                            $item_Price = $carts[$i]->product_variants->price;
                            $item_sel_Price = $carts[$i]->product_variants->selling_price;
                            $subtotal += ($item_sel_Price * $carts[$i]->quantity);
                            $subtotal_price += ($item_Price * $carts[$i]->quantity);
                            }
                            $shipping = 0.00;
                            $taxes = 0.00;
                            $discount_type = Session::get('discount_type');
                            $discount_percentage = Session::get('discount_percentage');
                            $discount_flat = Session::get('discount_flat');
                            $coupon_title = Session::get('coupon_title');
                            $discount_products = Session::get('products');
                            $specific_product_discount = Session::get('specific_product_discount');
                    
                            if (!empty($carts) && count($carts) > 0) {
                            if ($discount_percentage == 0.00 && $discount_flat == 0.00 && $specific_product_discount==0.00) {
                            $initial_discount = 0.00;
                            $coupon_code = null;
                            } else {
                            if ($discount_type == 'discount_percentage' || $discount_percentage != 0.00) {
                            $initial_discount = $discount_percentage;
                            } elseif ($discount_type == 'discount_flat') {
                            $initial_discount = $discount_flat;
                            } elseif ($discount_type == 'specific_product') {
                            // Calculate discount only for specific products
                            $initial_discount = 0.00; // Reset initial discount
                            foreach ($carts as $cart) {
                            if (in_array($cart->product_id, $discount_products)) {
                            // Calculate the specific product discount based on selling price
                            $product_discount = ($specific_product_discount / 100) * $cart->product_variants->selling_price;
                            $initial_discount += $product_discount * $cart->quantity; // Apply specific product discount
                            }
                            }
                            }
                            }
                            $coupon_code = $coupon_title;
                            }
                            else {
                            Session::put('discount_percentage', 0.00);
                            Session::put('discount_flat', 0.00);
                            Session::put('coupon_title', null);
                            Session::put('specific_product_discount', null);
                            Session::put('products', null);
                            $initial_discount = 0.00;
                            $coupon_code = null;
                            }
                            // Calculate discount amount
                            if ($discount_percentage != 0.00) {
                            $discount_amount = ($subtotal * $initial_discount) / 100;
                            } else {
                            $discount_amount = $initial_discount;
                            }
                            $total = ($subtotal - $discount_amount) + $taxes + $shipping;
                            $total_savings = ($subtotal_price - $subtotal) + $discount_amount;
            
            // $order_id = "Aayuja-" . uniqid();
                                do {
                        $order_id = "AAY" . date("ymd") . rand(100000, 999999);
                    } while (Order::where('order_id', $order_id)->exists());
                     $customerID = "customer_" . rand(11111,99999);
                            // dd($userinfo);
        
                        
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
                            'billing_address'=>$userinfo->address. ', ' . $userinfo->city. ', ' . $userinfo->state. ', ' .$userinfo->country. ' - ' .$userinfo->pin_code,
                            'shipping_address'=>$userinfo->address. ', ' . $userinfo->city. ', ' . $userinfo->state. ', ' .$userinfo->country. ' - ' .$userinfo->pin_code,
                            'shipping_pincode'=>$userinfo->pin_code,
                            'shipping_state'=>$userinfo->state,
                            'product_id'=>$carts[$i]->product_id,
                            'product_name'=>$carts[$i]->product->product_name,
                            'per_product_price'=>  $carts[$i]->product_variants->selling_price,
                            'product_quantity'=> $carts[$i]->quantity,
                            'product_size' => $carts[$i]->product_variants->weight ?? null,
                            'coupon_used'=>$coupon_title,
                            'discount_amount'=>$discount_amount,
                            'status' =>0,
                            'payment_source'=>'cashfree',
                            'transation_code'=>"",
                            'providerReferenceId'=>'',
                        ]);
                        }
        
        //create transation table
        $data = [
            'user_id'=> $user_id, 
            'txnid' => $order_id,
            'order_id'=>$order_id,
            'ssid'=> $ssid,
            'transaction_amount'=>$total,
            'transation_code' => "PAYMENT_PENDING",
            ];
            Transactions::create($data);
           
        
        Cashfree::$XClientId = "7728942a21438fe1ab9deacaf3498277";
        Cashfree::$XClientSecret = "cfsk_ma_prod_bb6420fb4f4e8f0f874262ef1d17c515_02fa5852";
        //Cashfree::$XEnvironment = Cashfree::$SANDBOX;
         Cashfree::$XEnvironment = Cashfree::$PRODUCTION;

         $cashfree= new Cashfree();
         $x_api_version = "2023-08-01";
         $order_id= $order_id;
         $order_amount=$total;
         $order_note="Learn Code Zone";
         $customerID = $customerID;
         $customer_phone=$userinfo->mobile;
         $customer_email=$userinfo->email;
         $customer_name=$userinfo->name . ' ' . $userinfo->last_name;
         $customer_uid=$user_id;
         $return_url= route('cashfree-confirm', ['orderId' => $order_id]);
     
         $create_orders_request= new CreateOrderRequest();
         $create_orders_request->setOrderId($order_id);
         $create_orders_request->setOrderAmount($order_amount);
         $create_orders_request->setOrderCurrency('INR');
     
          $customer_details= new CustomerDetails();
          $customer_details->setCustomerId($customerID);
          $customer_details->setCustomerPhone($customer_phone);
          $customer_details->setCustomerEmail($customer_email);
          $customer_details->setCustomerName($customer_name);
          

     
          $create_orders_request->setCustomerDetails($customer_details);
     
          $order_meta= new OrderMeta();
          $order_meta->setReturnUrl($return_url);
          $create_orders_request->setOrderMeta($order_meta);
     
          try{
              $result = $cashfree->PGCreateOrder($x_api_version, $create_orders_request);
              $payment_session_id= $result[0]['payment_session_id'];
              return view('payment-page',compact('payment_session_id'));
     
          }catch(Exception $e){
              echo "Exception: ".$e->getMessage();
          }
     
    }

    public function confirmPayment($orderId){

        $ssid= Session::getId();
        if(Auth::User()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = 0;
        }
       // dd($orderId);
        //$url= "https://sandbox.cashfree.com/pg/orders/$orderId";
         $url= "https://api.cashfree.com/pg/orders/$orderId";
            $ch= curl_init();           
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 240); // Adjusted timeout value to 20 seconds
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Accept: application/json',
                'x-api-version: 2023-08-01',
                'Content-Type: application/json',
                'x-client-id: 7728942a21438fe1ab9deacaf3498277',
                'x-client-secret: cfsk_ma_prod_bb6420fb4f4e8f0f874262ef1d17c515_02fa5852'
            ]);
        
            // Execute cURL request
            $results = curl_exec($ch);
        
            // Check for errors
            // if (curl_errno($ch)) {
            //     $error_msg = curl_error($ch);
            //     curl_close($ch);
            //     return back()->withErrors('cURL Error: ' . $error_msg);
            // }

            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
                curl_close($ch);
                return view('payment-error', ['error_message' => 'cURL Error: ' . $error_msg]);
            }



            // Get the HTTP response code
            $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        
            // Decode the JSON response
            $response = json_decode($results, true);
            $customer_phone=$response['customer_details']['customer_phone'];
           //$customer_phone =$response['customer_phone'];
            $transactionId = $response['order_id'];
            $order_id = $response['order_id'];
            $amount=$response['order_amount'];
            $status = $response['order_status'];
            if ($status === 'PAID') {
            
          
                        // Get the last invoice ID from the database
                        $lastInvoiceId = DB::table('orders')
                        ->latest('invoice_no')
                        ->value('invoice_no');
                        $invoiceId = $lastInvoiceId + 1;



                        $data = [
                            'user_id'=> $user_id,
                            'ssid'=> $ssid,
                            'transaction_amount'=>$amount,
                            'payment_source'=> 'cashfree',
                            'transation_code'=>$status,
                            'status'=>1,
                            'raw_response'=>$response,
                            
                            ];

                           
                            
            Transactions::where('txnid', $transactionId)->update($data); 
            Order::where('order_id', $transactionId)->update([
                'status'=>1,'transation_code'=>$status,'invoice_no'=>$invoiceId]); 
               
    
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
                    'payment_source'=> 'cashfree',
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
                   GupshupController::orderCancelMsg($customer_phone,$transactionId);
    
                   $url = url('payment/failed').'?ssid='.$ssid.'&order_id='.$transactionId.'&token='.$token;
                    return redirect()->to($url);
    
                }




      }


    }

//Dehilivery




