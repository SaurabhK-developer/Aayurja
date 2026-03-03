<?php
   
namespace App\Http\Controllers;
use App\Http\Controllers\PDFController;   
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Paymentdetail;
use App\Order;
use App\Cart;
use Auth;
use Mail;
use PDF;
use Config;
use Carbon\Carbon;
use App\Shipping_address;
use DB;
use App\product_available_size;
use App\Coupon;

   
class StripePaymentController extends Controller
{
     
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    // public function stripe()
    // {
    //     return view('stripe');
    //     // dd("aa");
    // }
  
    // /**
    //  * success response method.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function stripePost(Request $request)
    // {
    //     // dd($request->grandTotal * 100);
    //     $ssid = Session::getId();
    //     //FOR RANDOM ORDER ID START
    //     $orderID = 'AR-'.rand(100000,1000000);
    //     //FOR RANDOM ORDER ID END



    //     //STRIPE CODE START
    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $charge = Stripe\Charge::create ([
    //             "amount" => $request->grandTotal,
    //             "currency" => "INR",
    //             "source" => $request->stripeToken,
    //             "description" => "Test payment from arcade.com" 
    //     ]);



        

    //     // if($charge['status'] == 'succeeded') {
    //     //     return redirect('succeeded');
    //     // }
    //     // else
    //     // {
    //     //     return redirect('fail');   
    //     // }
  
    //     // Session::flash('success', 'Payment successful!');
          
    //     // return back();

    //     //STRIPE CODE END



    //     $paymentdetails = Paymentdetail::create([
    //                 'transaction_id' => $charge['balance_transaction'],
    //                 'transaction_amount' => $request->grandTotal,
    //                 'currency' => 'INR',
    //                 'order_id' => $orderID,
    //                 'name_on_card' => $request->name_on_card,
    //                 'card_number' => $request->cardnumber,
    //                 'cvc' => $request->cvc,
    //                 'expiry_month' => $request->month,
    //                 'expiry_year' => $request->year,
    //                 'payment_status' => $charge['status']
    //     ]);



        

    //     if($charge['status'] == 'succeeded')
    //     {
    //         $carts = Cart::where("ssid", "=", $ssid)->orderby('id', 'desc')->paginate(10);

    //         foreach($carts as $key => $cart)
    //         {
    //             $orders = Order::where('ssid', $ssid)->where('status', null)->where('product_id', $cart->product->id)->where('transaction_id', null)->update([
    //                'order_id' => $orderID,
    //                'transaction_id' => $charge['balance_transaction'],
    //                'status' => $charge['status']
    //             ]);
    //         }

    //         $current_user_cart = Cart::where("ssid", "=", $ssid)->delete();

    //         session()->forget(['payment_page','billing_address_same_as']);

    //         return back()->with('success','Payment successful ! Your order ID is: '.$orderID.' and Transaction ID is: '.$charge['balance_transaction']);
    //     }
    //     elseif($charge['status'] == 'payment_failed')
    //     {
    //         return back()->with('failed','Payment failed ! Please try again');
    //     }
    //     elseif($charge['status'] == 'processing')
    //     {
    //         return back()->with('processing','Payment processing !');
    //     }
    //     else
    //     {
    //         return back()->withErrors();
    //     }


    //     // return back();
    // }

    public function paynow(Request $request)
    {
        
        // dd($request->all());
        // dd($request->grandTotal * 100);
        $ssid = Session::getId();
        //FOR RANDOM ORDER ID START
        $orderID = 'AR-'.rand(100000,1000000);
        //FOR RANDOM ORDER ID END

        if(Auth::check())
        {
            $userID = Auth::user()->id;
        }
        else
        {
            $userID = null;   
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        if(Auth::check())
        {
            $orders = Order::where("ssid", "=", $ssid)->orwhere("user_id", "=", $userID)->where("order_id", "=", null)->where("transaction_id", "=", null)->where("status", "=", null)->orderby('id', 'desc')->first();
        }
        else
        {
            $orders = Order::where("ssid", "=", $ssid)->where("order_id", "=", null)->where("transaction_id", "=", null)->where("status", "=", null)->orderby('id', 'desc')->first();
        }

        // $lineitems = array();
        // $temp = array();
        // // dd($orders[0]->user_id);
        
        // foreach ($orders as $order) {
        //     $temp['name'] = $order->product_name;
        //     $temp['quantity'] = $order->product_quantity;
        //     $temp['amount'] = $order->grand_total*100;

        //     $temp['currency'] = 'CAD';
        //     $temp['tax_rates'] = $order->taxes;

        //     $lineitems[] = $temp;
        // }

        // dd($lineitems);
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // $stripe->customers->create(
        //   [
        //     'name' => 'Jenny Rosen',
        //     'shipping' => [
        //       'address' => '510 Townsend St CA US',
        //       'name' => 'ship address name',
        //       'phone' => '9837',
        //     ],
        //   ]
        // );

        $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'name' => 'Pay Arcade Collection',
                        'currency' => 'USD',
                        'amount' => floor($request->grand_total*100),
                        'quantity' => 1
                    ],
                
                ],
                
                // 'customer' => [
                //     'name' => 'Jenny Rosen',
                //     'customer_email' => 'cus@gmal.com'
                // ],
               

                'metadata' =>  [
                "orderid" => $orderID,
                "sessionid" => $ssid,
                "userid" => $userID,
                "emailid" => $request->email_id,
                "customername" => $request->customer_name
                ],

            
            
            
            'mode' => 'payment',
            'success_url' => url('stripe-payment-success'),
            'cancel_url' => url('stripe-payment-cancel')
        ]);

        // dd($checkout_session->display_items[0]);
            Session::put('checkout_session_id', $checkout_session->id);
            if(!empty($userID))
            {
                Session::put('userid', $userID);  
            }
            
        //FOR BUY NOW BUTTON START
            if(!empty($request->purchase_using))
            {
                Session::put('purchase_using', 'direct');
                Session::put('product_id', $request->product_id);
            }
        //FOR BUY NOW BUTTON START

        return redirect()->away($checkout_session->url);
    }

    public function success(Request $request)
    {

        $checkout_session_id = Session::get('checkout_session_id');
        $coupon_code = Session::get('coupon_title');

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = \Stripe\Checkout\Session::retrieve($checkout_session_id);

        if($checkout_session)
        {
            $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);

            $order_id = $checkout_session->metadata->orderid;
            $ssid = $checkout_session->metadata->sessionid;
            if(!empty($checkout_session->metadata->userid))
            {
                $user_id = $checkout_session->metadata->userid;
            }
            
            if(!empty($checkout_session->metadata->emailid))
            {
               $email_id = $checkout_session->metadata->emailid; 
            }
            
            if(!empty($checkout_session->metadata->customername))
            {
                $customer_name = $checkout_session->metadata->customername;
            }
        }

        if($paymentIntent)
        {
            if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded')
            {
                $paidAmount = $paymentIntent->amount;
                $payment_status = $paymentIntent->status;
                $currency = $paymentIntent->currency;

                $transaction_id = $paymentIntent->charges->data[0]->balance_transaction;
                $card_brand = $paymentIntent->charges->data[0]->payment_method_details->card->brand;
                $card_exp_month = $paymentIntent->charges->data[0]->payment_method_details->card->exp_month;
                $card_exp_year = $paymentIntent->charges->data[0]->payment_method_details->card->exp_year;
                $card_number = $paymentIntent->charges->data[0]->payment_method_details->card->last4;
                $card_accountholder_name = $paymentIntent->charges->data[0]->billing_details->name;
            }
        }

        // $user_email_field_from_checkout = $paymentIntent->charges->data[0]->billing_details->name;

        // dd($currency);
        

        
        $paymentdetails = Paymentdetail::create([
                    'transaction_id' => $transaction_id,
                    'transaction_amount' => $paidAmount/100,
                    'currency' => $currency,
                    'order_id' => $order_id,
                    'name_on_card' => $card_accountholder_name,
                    'card_number' => $card_number,
                    // 'cvc' => null,
                    'expiry_month' => $card_exp_month,
                    'expiry_year' => $card_exp_year,
                    'payment_status' => $payment_status
        ]);

        if($payment_status == 'succeeded')
        {
            $currentDate = new Carbon();
            
            if(!empty(Session::get('purchase_using')) && Session::get('purchase_using') == 'direct')
            {
                // $isDirectCheckout = 'yes';
          
                //FOR BUY NOW BUTTON START
                $orders = Order::where('ssid', $ssid)->where('status', null)->where('product_id', Session::get('product_id'))->where('transaction_id', null)->update([
                   'order_id' => $order_id,
                   'order_date' => $currentDate,
                   'transaction_id' => $transaction_id,
                   'status' => $payment_status
                ]);

                session()->forget(['payment_page','billing_address_same_as']);
                session()->forget(['purchase_using','direct']);
                session()->forget('product_id');
                
                
                 if (Auth::check()) {
                    $name = Auth::user()->name;
                    $emailto = Auth::user()->email;
        
                    $data = array();
                    $data['username'] = $name;
                    $arrayEmails = array($emailto);
                }
                else
                {
                    $name = $customer_name;
                    $emailto = $email_id;
        
                    $data = array();
                    $data['username'] = $name;
                    $arrayEmails = array($emailto);
                }
            
                $orderDetails = Order::where('order_id', '=', $order_id)->where('status', '=', 'succeeded')->first();
                $paymentDetails = Paymentdetail::where('order_id', '=', $order_id)->first();
                $shippingDetails = Shipping_address::where('ssid', '=', $orderDetails->ssid)->where('address_type', '=', 'shipping')->orderBy('id', 'desc')->first();
                $billingDetails = Shipping_address::where('ssid', '=', $orderDetails->ssid)->where('address_type', '=', 'billing')->orderBy('id', 'desc')->first();
            
                $items = Order::where('order_id', '=', $order_id)->where('status', '=', 'succeeded')->join('products', function($join)
                        {
                            $join->on('orders.product_id', '=', 'products.id');
                             
                        })
                        ->get();
                
                // dd($items); 
                
                
                
                // if(count($items) > 0 && !empty($items[0]->product_category) && $items[0]->product_category == 4)
                // {
                //     $productPrice = product_available_size::where('id', $items[0]->size_id)->first();
                //     $singleProductCost = $productPrice->price;
                // }
                // else
                // { 
                //     $singleProductCost = null;
                // }
         
     
                $pdf = PDF::loadView('email.testpdf', ['orderDetails' => $orderDetails, 'paymentDetails' => $paymentDetails, 'shippingDetails' => $shippingDetails, 'billingDetails' => $billingDetails, 'items' => $items])->setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
                
                
  
                Mail::send('email.paymantsuccessful', $data, function ($message) use ($arrayEmails, $data, $pdf) {
                $message->to($arrayEmails, 'Arcade');
                $message->bcc(['nitish.88gravity@gmail.com','rahulbaduk@88gravity.com','gagyin@gmail.com','depreet@88gravity.com']);
    
                $message->from('support@thearcadecollection.com', 'thearcadecollection');
                $message->subject('paymant successful');
                $message->attachData($pdf->output(), "text.pdf");
                });
                
                
                
                
                

                return view('website.thankyou')->with('success', 'Payment successful ! Your order ID is: '.$order_id.' and Transaction ID is: '.$transaction_id);
                //FOR BUY NOW BUTTON START
            }
            else
            {
                // $isDirectCheckout = 'no';
                
                $carts = Cart::where("ssid", "=", $ssid)->orderby('id', 'desc')->paginate(10);

                foreach($carts as $key => $cart)
                {
                    $orders = Order::where('ssid', $ssid)->where('status', null)->where('product_id', $cart->product->id)->where('transaction_id', null)->update([
                       'order_id' => $order_id,
                       'order_date' => $currentDate,
                       'coupon_used' => $coupon_code,
                       'transaction_id' => $transaction_id,
                       'status' => $payment_status
                    ]);
                }
    
                
                // UPDATE USER LIMIT USED FOR COUPONS START
                $totalDiscountGiven = 0;
                $coupon = Coupon::where('title', $coupon_code)->first();
                
                // dd($totalDiscountGiven);
                // dd('aa');
                if(!empty($coupon) && $coupon != null)
                {
                    $old_total_discount_given = $coupon->total_discount_given;
                
                    $orderDiscount = Order::where('order_id', $order_id)->where('status', 'succeeded')->first();
                    $new_discount_given = $orderDiscount->discount_amount;
                    
                    $totalDiscountGiven = $old_total_discount_given + $new_discount_given;
                
                    $old_limit_used = $coupon->limit_used;
                    $current_limit_used = $old_limit_used + 1;
                    
                    $coupon = Coupon::where('title', $coupon_code)->update(['limit_used' => $current_limit_used, 'total_discount_given' => $totalDiscountGiven]);
                    // $coupon->update(['limit_used' => $current_limit_used, 'total_discount_given' => $totalDiscountGiven]);
                }
                // UPDATE USER LIMIT USED FOR COUPONS END
                
                session()->forget(['payment_page','billing_address_same_as']);
                // session()->forget('discount_percentage');
                // session()->forget('coupon_title');
                Session::put('discount_percentage', 0.00);
                Session::put('discount_flat', 0.00);
                Session::put('coupon_title', null);
    
                if (Auth::check()) {
                    $name = Auth::user()->name;
                    $emailto = Auth::user()->email;
        
                    $data = array();
                    $data['username'] = $name;
                    $arrayEmails = array($emailto);
                }
                else
                {
                    $name = $customer_name;
                    $emailto = $email_id;
        
                    $data = array();
                    $data['username'] = $name;
                    $arrayEmails = array($emailto);
                }
            
                $orderDetails = Order::where('order_id', '=', $order_id)->where('status', '=', 'succeeded')->first();
                $paymentDetails = Paymentdetail::where('order_id', '=', $order_id)->first();
                $shippingDetails = Shipping_address::where('ssid', '=', $orderDetails->ssid)->where('address_type', '=', 'shipping')->orderBy('id', 'desc')->first();
                $billingDetails = Shipping_address::where('ssid', '=', $orderDetails->ssid)->where('address_type', '=', 'billing')->orderBy('id', 'desc')->first();
            
                $items = Order::where('order_id', '=', $order_id)->where('status', '=', 'succeeded')->join('products', function($join)
                        {
                            $join->on('orders.product_id', '=', 'products.id');
                             
                        })
                        ->get();
          
            
               $pdf = PDF::loadView('email.testpdf', ['orderDetails' => $orderDetails, 'paymentDetails' => $paymentDetails, 'shippingDetails' => $shippingDetails, 'billingDetails' => $billingDetails, 'items' => $items])->setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            
            
                 Mail::send('email.paymantsuccessful', $data, function ($message) use ($arrayEmails, $data, $pdf) {
                $message->to($arrayEmails, 'Arcade');
                 $message->bcc(['nitish.88gravity@gmail.com','gagyin@gmail.com','rahulbaduk@88gravity.com','depreet@88gravity.com']);
                $message->from('support@thearcadecollection.com', 'thearcadecollection');
                $message->subject('Payment successful');
                  $message->attachData($pdf->output(), "text.pdf");
                });
    
                $current_user_cart = Cart::where("ssid", "=", $ssid)->delete();
    
                return view('website.thankyou')->with('success', 'Payment successful ! Your order ID is: '.$order_id.' and Transaction ID is: '.$transaction_id);
                // return back()->with('success','Payment successful ! Your order ID is: '.$orderID.' and Transaction ID is: '.$charge['balance_transaction']);
            }
            
        }
        elseif($payment_status == 'payment_failed')
        {
             if (Auth::check()) {
            $name = Auth::user()->name;
            $emailto = Auth::user()->email;

            $data = array();
            $data['username'] = $name;
            $arrayEmails = array($emailto);
        }
            
            Session::put('discount_percentage', 0.00);
            Session::put('coupon_title', null);
            
            
             Mail::send('email.paymentfail', $data, function ($message) use ($arrayEmails) {
            $message->to($arrayEmails, 'Arcade');
             $message->bcc(['nitish.88gravity@gmail.com','rahulbaduk@88gravity.com','depreet@88gravity.com']);

            $message->from('support@thearcadecollection.com', 'thearcadecollection');
            $message->subject('Payment Failure');
        });
            
            return view('website.payment_failed')->with('failed', 'Payment failed ! Please try again');
            // return back()->with('failed','Payment failed ! Please try again');
        }
        elseif($payment_status == 'processing')
        {
            Session::put('discount_percentage', 0.00);
            Session::put('coupon_title', null);
                
            return view('website.payment_processing')->with('processing', 'Payment processing ! Please wait for the confirmation');
            // return back()->with('processing','Payment processing !');
        }
        else
        {
            Session::put('discount_percentage', 0.00);
            Session::put('coupon_title', null);
                
            return view('website.payment_error')->with('error', 'Error !');
            // return back()->withErrors();
        }

        //MAIL START
       // Mail::to('anmolgalaxy38@gmail.com')->send(new \App\Mail\PurchaseSuccessful);
        //MAIL END

        // dd($checkout_session->metadata->orderid);

        // dd($checkout_session->metadata->sessionid);
        // dd($paymentIntent->charges->data[0]->balance_transaction);
        // dd($paymentIntent->charges->data[0]->payment_method_details->card->brand);//exp_month//exp_year//last4

        // if (Auth::check()) {
        //     $name = Auth::user()->name;

        //     $ssid = Session::get('ssid');
        //     // $userinfo = BillingAddress::latest()->where('ssid', $ssid)->first();
        //     // $emailto = Auth::user()->email;
        //     // $emailto = $userinfo->email;
        //     $userid = Auth::user()->id;
        //     // $txninfo = Transaction::latest()->where('user_id', $userid)->first();
        //     // $orderid = $txninfo->txnid;
            
        //     // if(!empty($txninfo->card_type)){
        //     //     $card_type = $txninfo->card_type;
        //     //     $card_num = $txninfo->cardnum;
        //     // }  //by Anmol
            
        //     // $data = array();
        //     // $data['username'] = $name;
        //     // $data['orderid'] = $orderid;
        //     // $arrayEmails = array($emailto); //dd($orderid);
        //     dd($ssid , $userid);
        // } else {

        //     // echo Session::get('ssid');
        //     // die;
        //     $ssid = Session::get('ssid');
        //     // $userinfo = BillingAddress::latest()->where('ssid', $ssid)->first();
        //     // $name = $userinfo->name . ' ' . $userinfo->last_name;
        //     // $emailto = $userinfo->email;
        //     // $txninfo = Transaction::latest()->where('ssid', $ssid)->first();
        //     // $orderid = $txninfo->txnid;
            
        //     // if(!empty($txninfo->card_type)){
        //     //     $card_type = $txninfo->card_type;
        //     //     $card_num = $txninfo->cardnum;
        //     // }  //by Anmol
            
        //     // $data = array();
        //     // $data['username'] = $name;
        //     // $data['orderid'] = $orderid;
        //     // $arrayEmails = array($emailto);
        //     dd($ssid);
        // }
    }

    public function cancel(Request $request)
    {
        $currentDate = new Carbon();
        
        $checkout_session_id = Session::get('checkout_session_id');

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = \Stripe\Checkout\Session::retrieve($checkout_session_id);

        if($checkout_session)
        {
            $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);

            $order_id = $checkout_session->metadata->orderid;
            $ssid = $checkout_session->metadata->sessionid;
            if(!empty($checkout_session->metadata->userid))
            {
                $user_id = $checkout_session->metadata->userid;
            }
        }

   
        $payment_status = 'cancelled';

 

        

        if($payment_status == 'cancelled')
        {
            if(!empty(Session::get('purchase_using')) && Session::get('purchase_using') == 'direct')
            {
                //FOR BUY NOW BUTTON START
                $orders = Order::where('ssid', $ssid)->where('status', null)->where('product_id', Session::get('product_id'))->where('transaction_id', null)->update([
                   'order_id' => $order_id,
                   'order_date' => $currentDate,
                   'transaction_id' => null,
                   'status' => $payment_status
                ]);

                session()->forget(['payment_page','billing_address_same_as']);
                session()->forget(['purchase_using','direct']);
                session()->forget('product_id');

                //FOR BUY NOW BUTTON START
            }
            else
            {
                $carts = Cart::where("ssid", "=", $ssid)->orderby('id', 'desc')->paginate(10);

                foreach($carts as $key => $cart)
                {
                    $orders = Order::where('ssid', $ssid)->where('status', null)->where('product_id', $cart->product->id)->where('transaction_id', null)->update([
                       'order_id' => $order_id,
                       'order_date' => $currentDate,
                       'transaction_id' => null,
                       'status' => $payment_status
                    ]);
                }
                
                Session::put('discount_percentage', 0.00);
                Session::put('coupon_title', null);
            }
            
            return redirect('/add-cart');

            
        }
        else
        {
            return redirect('/add-cart');
            // return back()->withErrors();
        }

        
    }
}
