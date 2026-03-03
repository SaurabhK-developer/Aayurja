<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Mail;
use Config;
use Response;
use DB;
use App\Cart;
use App\Seo;
use App\User;
use App\Coupon;
use App\BillingAddress;
use App\Season;
use App\Http\Controllers\Traits\MasterTrait;
class CheckoutController extends Controller

{   
    
    use MasterTrait;

    public function checkout(){
        $addressfound = 0;
        $seo = Seo::all();
        $coupan = Coupon::where("active", 1)->get();
        $carts = Cart::where("order_status", 0)->where("user_id", "=", Auth::user()->id)->get();
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
        $isEmpty = $carts->isEmpty();
        if (Auth::user()) {
        $userinfo = "App\BillingAddress"::latest()->where('user_id', Auth::user()->id)->first();
        if ($userinfo && $userinfo->count() > 0)
        $addressfound = 1;
        else {
        $userinfo = User::where('id', Auth::user()->id)->first();
        }
        }else{
        $userinfo = "App\BillingAddress"::latest()->where('ssid', Session::getId())->first();
        if ($userinfo && $userinfo->count() > 0){
        $addressfound = 1;
        }
        }
        return view('website.checkout',compact('seo','carts','subtotal','userinfo','addressfound','total','coupon_code','initial_discount','discount_amount','total','discount_percentage','total_saving','discount_flat','specific_product_discount','discount_products'));
        }

                    public function checkout_2(){


                        $addressfound = 0;
                        $seo = Seo::all();
                        $coupan = Coupon::where("active", 1)->get();
                        $carts = Cart::where("order_status", 0)->where("user_id", "=", Auth::user()->id)->get();
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
                            


                        if (Auth::user()) {
                            $userinfo = "App\BillingAddress"::latest()->where('user_id', Auth::user()->id)->first();
                            if (!$userinfo){
                                $userinfo = User::where('id', Auth::user()->id)->first();
                            }
                        }else{
                            $userinfo = "App\BillingAddress"::latest()->where('ssid', Session::getId())->first();
                        }
            
                       
                        //////////////////////////////////////////////END

                        return view('website.checkout-2',compact('seo','userinfo','carts','subtotal','coupon_code','initial_discount','discount_amount','total','discount_percentage','specific_product_discount','total_saving'));
                    }

                    

                    public function checkout_2post(Request $request){

                        $seo=Seo::all();
                        // dd($request->all());
                        $carts = "App\Cart"::where("order_status", 0)->where("user_id", "=", Auth::user()->id)->get();
                    
                        if (Auth::user()) {
                            $userinfo = "App\BillingAddress"::latest()->where('user_id', Auth::user()->id)->first();
                            if (!$userinfo){
                                $userinfo = User::where('id', Auth::user()->id)->first();
                            }
                        }else{
                            $userinfo = "App\BillingAddress"::latest()->where('ssid', Session::getId())->first();
                        }

                        if ($request->addressfound && Auth::user()) {
                        // dd('1st');
                        $request['ssid'] = Session::getId();
                        "App\BillingAddress"::where('user_id', Auth::user()->id)->where('id', $request->addressid)->update($request->except('_token', 'addressid', 'addressfound','newsletter'));
                        "App\Cart"::where('user_id',Auth::user()->id)->update(['billing_address'=>$request->addressid]);
                        } elseif (!$request->addressfound && Auth::user()) {
                        
                        $request['ssid'] = Session::getId();
                        $request['user_id'] = Auth::user()->id;
                        $add_id = "App\BillingAddress"::insertGetId($request->except('_token', 'addressid', 'addressfound','newsletter'));
                        // dd($add_id);
                        "App\Cart"::where('user_id',Auth::user()->id)->update(['billing_address'=>$add_id]);
                        } elseif ($request->addressfound) {
                        $request['ssid'] = Session::getId();
                        "App\BillingAddress"::where('ssid', Session::getId())->update($request->except('_token', 'addressid', 'addressfound','newsletter'));
                        "App\Cart"::where('ssid',Session::getId())->update(['billing_address'=>$request->addressid]);
                        } else {
                        $request['ssid'] = Session::getId();
                        $add_id = "App\BillingAddress"::insertGetId($request->except('_token', 'addressid', 'addressfound','newsletter'));
                        "App\Cart"::where('ssid',Session::getId())->update(['billing_address'=>$add_id]);
                        }

                        return redirect('/checkout-2');
                    // return view('website.checkout-2',compact('seo','userinfo','carts'));
                    }



    }              