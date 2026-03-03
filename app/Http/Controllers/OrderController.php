<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use DB;
use App\Seo;
use App\Cart;
use Auth;
use App\Shipping_address;
use App\Order;
use App\Newsletter;
use App\product_available_size;

class OrderController extends Controller
{
    public function checkout_info(){
         //session(['payment_page' => 'checked']);

        //  if(session('payment_page') == 'checked')
        //  {
             $currentSSID = null;
             $currentUserID = null;
             
             $seo=Seo::all();
             $currentSSID = Session::getId();

             if(Auth::check())
             {
                $currentUserID =Auth::user()->id;   
             }
             

            //FOR RETRIEVE ADDRESS START
            if(Auth::check())
            {
                $shippingAddress = Shipping_address::where("ssid", $currentSSID)->where("address_type", "shipping")->orderby('id', 'desc')->first();
            }
            else
            {
                $shippingAddress = Shipping_address::where("ssid", $currentSSID)->where("address_type", "shipping")->orderby('id', 'desc')->first();
            }
            //FOR RETRIEVE ADDRESS END


            //FOR CART RETRIEVE START
                if(Auth::check())
                {
                    $carts = Cart::where("ssid", "=", $currentSSID)->orwhere("user_id", "=", $currentUserID)->orderby('id', 'desc')->paginate(10);
                }
                else
                {
                    $carts = Cart::where("ssid", "=", $currentSSID)->orderby('id', 'desc')->paginate(10);
                }

                
                // FOR SUBTOTAL CALCULATIONS START
                    if(Auth::check())
                    {
                        $data = DB::table('carts')->where('ssid', '=', $currentSSID)->orwhere("user_id", "=", $currentUserID)
                        ->join('products', function($join)
                        {
                            $join->on('carts.product_id', '=', 'products.id');
                             
                        })
                        ->get();
                    }
                    else
                    {
                        $data = DB::table('carts')->where('ssid', '=', $currentSSID)->join('products', function($join)
                        {
                            $join->on('carts.product_id', '=', 'products.id');
                             
                        })
                        ->get();
                    }

                    $subtotalamount = 0;

                    for($i=0;$i<count($data);$i++)
                    {
                        
                        
                        if($data[$i]->product_category == 4)
                        {
                            $size_id = $data[$i]->size_id;
                            $product_id = $data[$i]->id;
                            
                            $product_price = product_available_size::where('productid', $data[$i]->product_id)->where('sizes', $data[$i]->size)->first();
                            
                            $subtotalamount = $subtotalamount + ($product_price->price * $data[$i]->quantity);
                            
                        }
                        else
                        {
                            $subtotalamount = $subtotalamount + ($data[$i]->price * $data[$i]->quantity);
                        }
            
                    }
                // FOR SUBTOTAL CALCULATIONS END
            //FOR CART RETRIEVE START

                //CALCULATIONS
                $shipping = 0.00;
                
                
                $discount_percentage = Session::get('discount_percentage');
                $discount_flat = Session::get('discount_flat');
                $coupon_title = Session::get('coupon_title');
        
                if($discount_percentage == 0.00 && $discount_flat == 0.00)
                {
                    $initial_discount = 0.00;
                    $coupon_code = null;
                }
                else
                {
                    if($discount_percentage != 0.00)
                    {
                        $initial_discount = $discount_percentage;
                    }
                    else
                    {
                        $initial_discount = $discount_flat;
                    }

                    $coupon_code = $coupon_title;
                }
                
                $subtotal = $subtotalamount;
                
                if($discount_percentage != 0.00)
                {
                    $discount_amount = ($subtotal * $initial_discount)/100;
                }
                else
                {
                    $discount_amount = $initial_discount;
                }
                
                $taxes = (($subtotalamount - $discount_amount)* 0)/100;
                $total = ($subtotalamount - $discount_amount) + $taxes + $shipping;
                //CALCULATIONS

		
             return view('website.checkout',compact('seo','carts','total','subtotal','shippingAddress','taxes','discount_amount','shipping','coupon_code','currentSSID','currentUserID'));
        // }
        // else
        // {
        //     return redirect('/');
        // }
    }

     public function checkout_info_store(Request $request)
     {
             $order_id = 'UB-'.rand(1000,1000000);
             //FOR SUBSCRIPTION CHECKBOX START
             //if(!empty($request->newsletter))
             //{
             //    $newsletter = Newsletter::create([
             //        'email' => $request->email
             //    ]);
             //    $newsletter->save();
             //}
             //FOR SUBSCRIPTION CHECKBOX START
            
             $ssid = $request->ssid;

             if(!empty($request->user_id))
             {
                 $userID = $request->user_id;
             }
             else
             {
             	$userID = null;
             }

            /*$shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'shipping'],
                 [
                     'user_id' =>  $userID,
                     'ssid' => $ssid,
                     'address_type' => $request->address_type,
                     'name' => $request->name,
                     'email' => $request->email,
                     'phone' => $request->phone,
                     'alt_phone' => $request->alt_phone,
                     'city' => $request->city,
                     'state' => $request->state,
                     'apartment' => $request->apartment,
                     'country' => $request->country,
                     'address' => $request->address,
                     'zip_code' => $request->zipcode,
                     'shipping_method' => $request->shipping_method,
                     'comment' => $request->comment
                 ]);*/
                 
          if(Auth::check())
          {
          	$carts = Cart::where("ssid", "=", $ssid)->orwhere("user_id", "=", $userID)->orderby('id', 'desc')->paginate(10);
          }
          else
          {
          	$carts = Cart::where("ssid", "=", $ssid)->orderby('id', 'desc')->paginate(10);
          }
                 
          $full_address = $request->address.','.$request->city.','.$request->state.','.$request->pincode;
          
          $sub_total = 0;
          foreach($carts as $key => $cart)
          {
          	$sub_total = $sub_total+($cart->item_price_by_size*$cart->quantity);
          }
          
          foreach($carts as $key => $cart)
          {
          	
          	$grandTotal = $sub_total;
          	
          	$orders = Order::create(
                 [
                 	  'order_id' => $order_id,
                         'user_id' => $userID,
                         'ssid' => $ssid,
                         'customer_name' => $request->name,
                         'customer_email' => $request->email,
                         'customer_phone' => $request->mobile,
                         'shipping_address' => $full_address,
                         'product_id' => $cart->product->id,
                         'product_name' => $cart->product->product_name,
                         'product_quantity' => $cart->quantity,
                         'product_size' => $cart->size,
                         'product_color' => $cart->color,
                         'per_product_price' => $cart->item_price_by_size,
                         'total' => $cart->item_price_by_size*$cart->quantity,
                         'subtotal' => $sub_total,
                         'grand_total' => $grandTotal,
                 ]);
           }
           
           if(Auth::check())
          {
          	$carts = Cart::where("ssid", "=", $ssid)->orwhere("user_id", "=", $userID)->orderby('id', 'desc')->delete();
          }
          else
          {
          	$carts = Cart::where("ssid", "=", $ssid)->orderby('id', 'desc')->delete();
          }
          
          return redirect()->route('thankyou');
     }

    // public function checkout_shipping()
    // {
    //     // if(session('payment_page') == 'checked')
    //     // {
    //         $currentSSID = Session::getId();

    //         if(Auth::check())
    //          {
    //             $currentUserID =Auth::user()->id;   
    //          }

    //         $seo=Seo::all();

    //         //FOR RETRIEVE ADDRESS START
    //         if(Auth::check())
    //         {
    //             $shippingAddressBilling = Shipping_address::where("ssid", $currentSSID)->where('address_type','=','billing')->orderby('id', 'desc')->first();
    //             $shippingAddressShipping = Shipping_address::where("ssid", $currentSSID)->where('address_type','=','shipping')->orderby('id', 'desc')->first();
    //         }
    //         else
    //         {
    //             $shippingAddressBilling = Shipping_address::where("ssid", $currentSSID)->where("address_type",'=',"billing")->orderby('id', 'desc')->first();
    //             $shippingAddressShipping = Shipping_address::where("ssid", $currentSSID)->where("address_type",'=',"shipping")->orderby('id', 'desc')->first();
    //         }
    
    //         //FOR RETRIEVE ADDRESS START

    //         $check_billing_address_same_as = session('billing_address_same_as');

    //         if($check_billing_address_same_as != null)
    //         {
    //             $session_billing_address_same_as = session('billing_address_same_as');
    //         }
    //         else
    //         {
    //             $session_billing_address_same_as = null;
    //         }


    //         //FOR CART RETRIEVE START
    //             if(Auth::check())
    //             {
    //                 $carts = Cart::where("ssid", "=", $currentSSID)->orwhere("user_id", "=", $currentUserID)->orderby('id', 'desc')->paginate(10);
    //             }
    //             else
    //             {
    //                 $carts = Cart::where("ssid", "=", $currentSSID)->orderby('id', 'desc')->paginate(10);
    //             }

                
    //             // FOR SUBTOTAL CALCULATIONS START
    //                 if(Auth::check())
    //                 {
    //                     $data = DB::table('carts')->where('ssid', '=', $currentSSID)->orwhere("user_id", "=", $currentUserID)
    //                     ->join('products', function($join)
    //                     {
    //                         $join->on('carts.product_id', '=', 'products.id');
                             
    //                     })
    //                     ->get();
    //                 }
    //                 else
    //                 {
    //                     $data = DB::table('carts')->where('ssid', '=', $currentSSID)->join('products', function($join)
    //                     {
    //                         $join->on('carts.product_id', '=', 'products.id');
                             
    //                     })
    //                     ->get();
    //                 }

    //                 $subtotalamount = 0;

    //                 for($i=0;$i<count($data);$i++)
    //                 {
    //                     if($data[$i]->product_category == 4)
    //                     {
    //                         $size_id = $data[$i]->size_id;
    //                         $product_id = $data[$i]->id;
                            
    //                         $product_price = product_available_size::where('productid', $data[$i]->product_id)->where('sizes', $data[$i]->size)->first();
                            
    //                         $subtotalamount = $subtotalamount + ($product_price->price * $data[$i]->quantity);
                            
    //                     }
    //                     else
    //                     {
    //                         $subtotalamount = $subtotalamount + ($data[$i]->price * $data[$i]->quantity);
    //                     }
    //                 }
    //             // FOR SUBTOTAL CALCULATIONS END
    //         //FOR CART RETRIEVE START
    //             //CALCULATIONS
    //             $shipping = 0.00;
                
    //             $discount_percentage = Session::get('discount_percentage');
    //             $discount_flat = Session::get('discount_flat');
    //             $coupon_title = Session::get('coupon_title');
                
    //             if($discount_percentage == 0.00 && $discount_flat == 0.00)
    //             {
    //                 $initial_discount = 0.00;
    //                 $coupon_code = null;
    //             }
    //             else
    //             {
    //                 if($discount_percentage != 0.00)
    //                 {
    //                     $initial_discount = $discount_percentage;
    //                 }
    //                 else
    //                 {
    //                     $initial_discount = $discount_flat;
    //                 }

    //                 $coupon_code = $coupon_title;
    //             }
                
    //             $subtotal = $subtotalamount;
                
    //             if($discount_percentage != 0.00)
    //             {
    //                 $discount_amount = ($subtotal * $initial_discount)/100;
    //             }
    //             else
    //             {
    //                 $discount_amount = $initial_discount;
    //             }
                
    //             $taxes = (($subtotalamount - $discount_amount)* 0)/100;
    //             // $initial_discount = 0.00;
    //             // $subtotal = $subtotalamount;
    //             $total = ($subtotalamount - $discount_amount) + $taxes + $shipping;
    //             //CALCULATIONS

             
    //         return view('website.checkout-shipping',compact('seo','shippingAddressBilling','shippingAddressShipping','session_billing_address_same_as','carts','subtotal','shipping','taxes','discount_amount','total','coupon_code'));
    //     // }
    //     // else
    //     // {
    //     //     return redirect('/');
    //     // }
    // }

    // public function checkout_shipping_store(Request $request)
    // {
    //     // if(session('payment_page') == 'checked')
    //     // {
    //         session(['billing_address_same_as' => $request->billing_address_same_as]);

    //         $ssid = Session::getId();

    //         if(Auth::check())
    //         {
    //             $userID = Auth::user()->id;
    //         }
    //         else
    //         {
    //             $userID = null;   
    //         }


    //         if($request->shipping_method != null){
    //             //FOR RETRIEVE ADDRESS START
    //             if(Auth::check())
    //             {
    //                 $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //             }
    //             else
    //             {
    //                 $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //             }
    //             //FOR RETRIEVE ADDRESS START

    //             $shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'shipping'],
    //             [
    //                 'shipping_method' => $request->shipping_method
    //             ]);
    //         }


    //         if($request->billing_address_same_as == 'billing')
    //         {
    //             $shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'billing'],
    //             [
    //                 'user_id' =>  $userID,
    //                 'ssid' => $ssid,
    //                 'address_type' => $request->address_type,
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'phone' => $request->phone,
    //                 'alt_phone' => $request->alt_phone,
    //                 'city' => $request->city,
    //                 'state' => $request->state,
    //                 'apartment' => $request->apartment,
    //                 'country' => $request->country,
    //                 'address' => $request->address,
    //                 'zip_code' => $request->zipcode,
    //                 'shipping_method' => $request->shipping_method,
    //                 'comment' => $request->comment
    //             ]);

    //             $fullBillingAddress = $request->name.'<br>'.$request->apartment.', '.$request->address.', '.$request->city.', '.$request->state.', '.$request->country.'-'.$request->zipcode.'<br>'.$request->email.'<br>'.$request->phone;
    //         }
    //         else
    //         {
    //             //FOR RETRIEVE ADDRESS START
    //             if(Auth::check())
    //             {
    //                 $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //             }
    //             else
    //             {
    //                 $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //             }
    //             //FOR RETRIEVE ADDRESS START

    //             $shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'billing'],
    //             [
    //                 'user_id' =>  $userID,
    //                 'ssid' => $ssid,
    //                 'address_type' => 'billing',
    //                 'name' => $shippingAddress->name,
    //                 'email' => $shippingAddress->email,
    //                 'phone' => $shippingAddress->phone,
    //                 'alt_phone' => $shippingAddress->alt_phone,
    //                 'city' => $shippingAddress->city,
    //                 'state' => $shippingAddress->state,
    //                 'apartment' => $shippingAddress->apartment,
    //                 'country' => $shippingAddress->country,
    //                 'address' => $shippingAddress->address,
    //                 'zip_code' => $shippingAddress->zip_code,
    //                 'shipping_method' => $shippingAddress->shipping_method,
    //                 'comment' => $shippingAddress->comment
    //             ]);            

    //             $fullBillingAddress = $shippingAddress->apartment.', '.$shippingAddress->address.', '.$shippingAddress->city.', '.$shippingAddress->state.', '.$shippingAddress->country.'-'.$shippingAddress->zip_code;
    //         }


    //         //FOR ORDERS TABLE START

    //             if(Auth::check())
    //             {
    //                 $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //             }
    //             else
    //             {
    //                 $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //             }

    //             $fullShippingAddress = $shippingAddress->apartment.', '.$shippingAddress->address.', '.$shippingAddress->city.', '.$shippingAddress->state.', '.$shippingAddress->country.'-'.$shippingAddress->zip_code;

    //         //FOR CART RETRIEVE START
    //             if(Auth::check())
    //             {
    //                 $carts = Cart::where("ssid", "=", $ssid)->orwhere("user_id", "=", $userID)->orderby('id', 'desc')->paginate(10);
    //             }
    //             else
    //             {
    //                 $carts = Cart::where("ssid", "=", $ssid)->orderby('id', 'desc')->paginate(10);
    //             }
                
    //             // FOR TOTAL CALCULATIONS START
    //                 if(Auth::check())
    //                 {
    //                     $data = DB::table('carts')->where('ssid', '=', $ssid)->orwhere("user_id", "=", $userID)
    //                     ->join('products', function($join)
    //                     {
    //                         $join->on('carts.product_id', '=', 'products.id');
                             
    //                     })
    //                     ->get();
    //                 }
    //                 else
    //                 {
    //                     $data = DB::table('carts')->where('ssid', '=', $ssid)->join('products', function($join)
    //                     {
    //                         $join->on('carts.product_id', '=', 'products.id');
                             
    //                     })
    //                     ->get();
    //                 }

    //                 $total = 0;

    //                 for($i=0;$i<count($data);$i++)
    //                 {
    //                     if($data[$i]->product_category == 4)
    //                     {
    //                         $size_id = $data[$i]->size_id;
    //                         $product_id = $data[$i]->id;
                            
    //                         $product_price = product_available_size::where('productid', $data[$i]->product_id)->where('sizes', $data[$i]->size)->first();
                            
    //                         $total = $total + ($product_price->price * $data[$i]->quantity);
                            
    //                     }
    //                     else
    //                     {
    //                         $total = $total + ($data[$i]->price * $data[$i]->quantity);
    //                     }
    //                     // $total = $total + ($data[$i]->price * $data[$i]->quantity);
    //                 }
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
    //                 $shippingCharges = 0.00;
                    
    //                 $discount_percentage = Session::get('discount_percentage');
    //                 $discount_flat = Session::get('discount_flat');
                    
    //                 if(empty($discount_percentage) || $discount_percentage == null || $discount_percentage == 0.00)
    //                 {
    //                     $discountPercentage = 0.00; 
    //                 }
    //                 else
    //                 {
    //                     $discountPercentage = $discount_percentage;
    //                 }
                    
                    
    //                 if($discount_percentage != 0.00)
    //                 {
    //                     $discountAmount = $total * ($discountPercentage/100);
    //                 }
    //                 else
    //                 {
    //                     $discountAmount = $discount_flat;
    //                 }
                    
    //                 $subtotal = $total - $discountAmount;
    //                 $taxPercentage = 0;
    //                 $taxAmount = $subtotal * ($taxPercentage/100);
    //                 $grandTotal = $subtotal + $taxAmount + $shippingCharges;

    //             // FOR TOTAL CALCULATIONS END
    //         //FOR CART RETRIEVE START   

    //         foreach($carts as $key => $cart)
    //         {
    //             // dd($cart->product->product_name);


    //             $orders = Order::updateOrCreate(['ssid' => $ssid, 'status' => null, 'product_id' => $cart->product->id,'product_color' => $cart->color,'product_size' => $cart->size],
    //             [
    //                     'user_id' => $userID,
    //                     'ssid' => $ssid,
    //                     'customer_name' => $shippingAddress->name,
    //                     'customer_email' => $shippingAddress->email,
    //                     'customer_phone' => $shippingAddress->phone,
    //                     'customer_alt_phone' => $shippingAddress->alt_phone,
    //                     'shipping_address' => $fullShippingAddress,
    //                     'billing_address' => $fullBillingAddress,
    //                     'product_id' => $cart->product->id,
    //                     'product_name' => $cart->product->product_name,
    //                     'product_quantity' => $cart->quantity,
    //                     'product_color' => $cart->color,
    //                     'product_size' => $cart->size,
    //                     'size_id' => null,
    //                     'per_product_price' => $cart->item_price_by_size,
    //                     'total' => $total,
    //                     'discount_percentage' => $discountPercentage,
    //                     'discount_amount' => $discountAmount,
    //                     'subtotal' => $subtotal,
    //                     'taxes' => $taxAmount,
    //                     'shipping_method' => $shippingAddress->shipping_method,
    //                     'shipping_charges' => $shippingCharges,
    //                     'grand_total' => $grandTotal,
    //                     // 'transaction_id' => $request->isoutofstock,
    //                     // 'status' => $request->isoutofstock,
    //             ]);



    //         //FOR ORDERS TABLE END

    //         // return redirect('/checkout-payment');
    //         // return redirect('/checkout-payment')->with('orderID',$orderID);
    //         // return view('website.checkout-payment')->with('ssid',$ssid);
            
    //         }
    //         return redirect('/checkout-payment')->with('ssid', $ssid);
    //     // }
    //     // else
    //     // {
    //     //     return redirect('/');
    //     // }
    // }

    // public function checkout_payment()
    // {
    //     // if(session('payment_page') == 'checked')
    //     // {
    //         $currentSSID = Session::getId();

    //         if(Auth::check())
    //          {
    //             $currentUserID =Auth::user()->id;   
    //          }

    //         $seo=Seo::all();

    //         //FOR RETRIEVE ADDRESS START
    //         if(Auth::check())
    //         {
    //             $shippingAddressShipping = Shipping_address::where("ssid", $currentSSID)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //         }
    //         else
    //         {
    //             $shippingAddressShipping = Shipping_address::where("ssid", $currentSSID)->where("address_type", "shipping")->orderby('id', 'desc')->first();
    //         }
    //         //FOR RETRIEVE ADDRESS START



    //         //FOR CART RETRIEVE START
    //             if(Auth::check())
    //             {
    //                 $carts = Cart::where("ssid", "=", $currentSSID)->orwhere("user_id", "=", $currentUserID)->orderby('id', 'desc')->paginate(10);
    //             }
    //             else
    //             {
    //                 $carts = Cart::where("ssid", "=", $currentSSID)->orderby('id', 'desc')->paginate(10);
    //             }

                
    //             // FOR SUBTOTAL CALCULATIONS START
    //                 if(Auth::check())
    //                 {
    //                     $data = DB::table('carts')->where('ssid', '=', $currentSSID)->orwhere("user_id", "=", $currentUserID)
    //                     ->join('products', function($join)
    //                     {
    //                         $join->on('carts.product_id', '=', 'products.id');
                             
    //                     })
    //                     ->get();
    //                 }
    //                 else
    //                 {
    //                     $data = DB::table('carts')->where('ssid', '=', $currentSSID)->join('products', function($join)
    //                     {
    //                         $join->on('carts.product_id', '=', 'products.id');
                             
    //                     })
    //                     ->get();
    //                 }

    //                 $subtotalamount = 0;

    //                 for($i=0;$i<count($data);$i++)
    //                 {
    //                     if($data[$i]->product_category == 4)
    //                     {
    //                         $size_id = $data[$i]->size_id;
    //                         $product_id = $data[$i]->id;
                            
    //                         $product_price = product_available_size::where('productid', $data[$i]->product_id)->where('sizes', $data[$i]->size)->first();
                            
    //                         $subtotalamount = $subtotalamount + ($product_price->price * $data[$i]->quantity);
                            
    //                     }
    //                     else
    //                     {
    //                         $subtotalamount = $subtotalamount + ($data[$i]->price * $data[$i]->quantity);
    //                     }
    //                 }

    //                 // $shippingCharges = 0;
    //                 // $discountPercentage = 0;
    //                 // $discountAmount = $total * ($discountPercentage/100);
    //                 // $subtotal = $total - $discountAmount;
    //                 // $taxPercentage = 0;
    //                 // $taxAmount = $subtotal * ($taxPercentage/100);
    //                 // $grandTotal = $subtotal + $taxAmount + $shippingCharges;

    //                 //CALCULATIONS
    //                 $shipping = 0.00;
                    
    //                 $discount_percentage = Session::get('discount_percentage');
    //                 $discount_flat = Session::get('discount_flat');
    //                 $coupon_title = Session::get('coupon_title');
                    
    //                 if($discount_percentage == 0.00 && $discount_flat == 0.00)
    //                 {
    //                     $initial_discount = 0.00;
    //                     $coupon_code = null;
    //                 }
    //                 else
    //                 {
    //                     if($discount_percentage != 0.00)
    //                     {
    //                         $initial_discount = $discount_percentage;
    //                     }
    //                     else
    //                     {
    //                         $initial_discount = $discount_flat;
    //                     }

    //                     $coupon_code = $coupon_title;
    //                 }
                    
    //                 $subtotal = $subtotalamount;
                    
    //                 if($discount_percentage != 0.00)
    //                 {
    //                     $discount_amount = ($subtotal * $initial_discount)/100;
    //                 }
    //                 else
    //                 {
    //                     $discount_amount = $initial_discount;
    //                 }
                    
    //                 $taxes = (($subtotalamount - $discount_amount)* 0)/100;
    //                 // $initial_discount = 0.00;
    //                 // $subtotal = $subtotalamount;
    //                 $grandTotal = ($subtotalamount - $discount_amount) + $taxes + $shipping;
    //                 //CALCULATIONS

    //             // FOR SUBTOTAL CALCULATIONS END
    //         //FOR CART RETRIEVE START
             

    //          return view('website.checkout-payment',compact('seo','shippingAddressShipping','carts','subtotal','grandTotal','discount_amount','taxes','shipping','coupon_code'));
    //     // }
    //     // else
    //     // {
    //     //     return redirect('/');
    //     // }
    // }

     public function admin_order()
     {
         $orders = Order::orderby('id', 'desc')->get()->unique('order_id');
         return view('admin.order.index',compact('orders'));
     }

     public function admin_order_details($orderid)
     {
         $orders = DB::select("SELECT * FROM orders where order_id = '$orderid' order by 'product_id'");
         // $products = DB::select("SELECT * FROM products WHERE id = ANY (SELECT product_id FROM orders where order_id = '$orderid' order by 'product_id') order by 'id' asc");
        
         return view('admin.order.details',compact('orders'));
     }
}
