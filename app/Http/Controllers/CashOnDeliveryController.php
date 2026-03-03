<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Traits\MasterTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Transactions;
use App\Order;
use App\Cart;
use DB;
use App\BillingAddress;
use Exception;
use GuzzleHttp\Client; 
use Carbon\Carbon;
use App\Http\Controllers\DelhiveryController;
use App\Http\Controllers\GupshupController;

class CashOnDeliveryController extends Controller
{ 


    protected $delhiveryController;

    public function __construct(DelhiveryController $delhiveryController)
    {
        $this->delhiveryController = $delhiveryController;
    }


    public function paynow(Request $request)
    {

        // dd('testing');

        $ssid = Session::getId();
        $payment_type = $request->payment_type;

        // Get user ID
        $user_id = Auth::user() ? Auth::user()->id : 0;

        // Get cart items for the user
        $carts = Cart::where("user_id", $user_id)
            ->where("order_status", 0)
            ->get();

        // Get user billing information
        if (Auth::user()) {
            $userinfo = BillingAddress::latest()
                ->where("user_id", Auth::user()->id)
                ->first();
            if (!$userinfo) {
                $userinfo = User::where("id", Auth::user()->id)->first();
            }
        } else {
            $userinfo = BillingAddress::latest()
                ->where("ssid", Session::getId())
                ->first();
        }

        // Initialize variables
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
            

        // Generate order ID
       // $order_id = "Aayuja-" . uniqid();

do {
    $order_id = "AAY" . date("ymd") . rand(100000, 999999);
} while (Order::where('order_id', $order_id)->exists());

        // Create order
        foreach ($carts as $cart) {
            Order::create([
                'ssid' => $ssid,
                'order_id' => $order_id,
                'user_id' => $user_id,
                'total' => $subtotal,
                'grand_total' => $total,
                'customer_name' => $userinfo->name . ' ' . $userinfo->last_name,
                'customer_email' => $userinfo->email,
                'customer_phone' => $userinfo->mobile,
                'billing_address' => $userinfo->address. ', ' . $userinfo->city. ', ' . $userinfo->state. ', ' .$userinfo->country. ' -' .$userinfo->pin_code,
                'shipping_address' => $userinfo->address. ', ' . $userinfo->city. ', ' . $userinfo->state. ', ' .$userinfo->country. ' - ' .$userinfo->pin_code,
                'shipping_pincode'=>$userinfo->pin_code,
                'shipping_state'=>$userinfo->state,
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->product_name,
                'per_product_price' => $cart->product_variants->selling_price,
                'product_quantity' => $cart->quantity,
                'product_size' => $cart->product_variants->weight ?? null,
                'coupon_used' => Session::get("coupon_title"),
                'discount_amount' => $discount_amount,
                'status' => 1,
                'transation_code' => "COD",
                'providerReferenceId' => '',
                'payment_source'=>'COD',
            ]);
        }

        // Create transaction record
        Transactions::create([
            'user_id' => $user_id,
            'ssid'=> $ssid,
            'transaction_amount'=>$total,
            'txnid' => $order_id,
            'order_id' => $order_id,
            'transation_code' => 'COD',
            'payment_source'=> 'COD',
            'status'=>0,
        ]);

                // Get the last invoice ID from the database
                $lastInvoiceId = DB::table('orders')
                ->latest('invoice_no')
                ->value('invoice_no');
                $invoiceId = $lastInvoiceId + 1;


                
        Order::where('order_id', $order_id)->update(['invoice_no'=>$invoiceId]); 
        Cart::where("user_id", $user_id)->delete();  
        $token = $token = (string) Str::uuid();
        Session::put('pay_token', $token);
        GupshupController::orderSuccessfullMsg($userinfo->mobile,$order_id);
        $this->delhiveryController->forwardOrder($order_id);
        $url = url('payment/success').'?ssid='.$ssid.'&order_id='.$order_id.'&token='.$token;
        return redirect()->to($url);
    
 
    }



    

    }




