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
use App\Product;
use App\Product_Image;
use App\Newsletter;
use App\product_available_size;

class BuynowController extends Controller
{

    public function checkout_info_buynow(Request $request)
    {
        // dd($request->all());
        session(['payment_page' => 'checked']);

        //  if(session('payment_page') == 'checked')
        //  {
         
             $seo=Seo::all();
             $currentSSID = Session::getId();

             if(Auth::check())
             {
                $currentUserID =Auth::user()->id;   
             }
             

            //FOR RETRIEVE ADDRESS START
            if(Auth::check())
            {
                $shippingAddress = Shipping_address::where("ssid", $currentSSID)->where("address_type", "shipping")->orderBy('id', 'desc')->first();
            }
            else
            {
                $shippingAddress = Shipping_address::where("ssid", $currentSSID)->where("address_type", "shipping")->orderBy('id', 'desc')->first();
            }
            //FOR RETRIEVE ADDRESS END

                
                // FOR CALCULATIONS START
                    $products = Product::where("id", "=", $request->product_id)->orderby('id', 'desc')->first();
                    $productImage = Product_Image::where('product_id', '=', $request->product_id)->orderby('id', 'desc')->first();

                    $productPrice = product_available_size::where('productid', $request->product_id)->where('sizes', $request->selected_size)->first();
                  
                    $total = 0;

                    if(!empty($products->product_category) && $products->product_category == 4)
                    {
                        //NOTE: product_category = 4 MEANS KIDS
                        $total = $total + ($productPrice->price * $request->quantity);
                    }
                    else
                    {
                        $total = $total + ($products->price * $request->quantity);
                    }
                    

                    $shippingCharges = 0;
                    $discountPercentage = 0;
                    $discountAmount = $total * ($discountPercentage/100);
                    $subtotal = $total - $discountAmount;
                    $taxPercentage = 0;
                    $taxAmount = $subtotal * ($taxPercentage/100);
                    $grandTotal = $subtotal + $taxAmount + $shippingCharges;
                    
                // FOR CALCULATIONS END
                    $productid = $request->product_id;
                    $quantity = $request->quantity;
                    $color = $request->selected_color;
                    $size = $request->selected_size;

                return view('website.buynow.checkout-info',compact('seo','products','productid','quantity','color','size','shippingAddress','total','shippingCharges','discountPercentage','discountAmount','subtotal','taxPercentage','taxAmount','grandTotal','productImage','productPrice')); 
        // }
        // else
        // {
        //     return redirect('/');
        // }
    }

    public function checkout_info_store_buynow(Request $request)
    {
        // dd($request->all());
        $seo=Seo::all();

        // if(session('payment_page') == 'checked')
        //  {
            //FOR SUBSCRIPTION CHECKBOX START
            if(!empty($request->newsletter))
            {
                $newsletter = Newsletter::create([
                    'email' => $request->email
                ]);
                $newsletter->save();
            }
            //FOR SUBSCRIPTION CHECKBOX START

            $ssid = Session::getId();

            if(Auth::check())
            {
                $userID = Auth::user()->id;
            }
            else
            {
                $userID = null;   
            }

            $shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'shipping'],
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
                ]);

              $productid = $request->productid;
              $quantity = $request->quantity;
              $color = $request->color;
              $size = $request->size;
              $total = $request->total;
              $shippingCharges = $request->shippingCharges;
              $discountAmount = $request->discountAmount;
              $subtotal = $request->subtotal;
              $taxAmount = $request->taxAmount;
              $grandTotal = $request->grandTotal;

            //FOR RETRIEVE ADDRESS START
            if(Auth::check())
            {
                $shippingAddressBilling = Shipping_address::where("ssid", $ssid)->where("address_type", "billing")->orderby('id', 'desc')->first();
                $shippingAddressShipping = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
            }
            else
            {
                $shippingAddressBilling = Shipping_address::where("ssid", $ssid)->where("address_type", "billing")->orderby('id', 'desc')->first();
                $shippingAddressShipping = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
            }
            //FOR RETRIEVE ADDRESS START

            $check_billing_address_same_as = session('billing_address_same_as');

            if($check_billing_address_same_as != null)
            {
                $session_billing_address_same_as = session('billing_address_same_as');
            }
            else
            {
                $session_billing_address_same_as = null;
            }

            $products = Product::where("id", "=", $request->productid)->orderby('id', 'desc')->first();
            $productImage = Product_Image::where('product_id', '=', $request->productid)->orderby('id', 'desc')->first();
            $productPrice = product_available_size::where('productid', $request->productid)->where('sizes', $request->size)->first();

            return view('website.buynow.checkout-shipping',compact('seo','products','productid','quantity','color','size','total','shippingCharges','discountAmount','subtotal','taxAmount','grandTotal','productImage','shippingAddressBilling','shippingAddressShipping','session_billing_address_same_as','productPrice'));

        // }
        // else
        // {
        //     return redirect('/');
        // }
    }


    public function checkout_shipping_store_buynow(Request $request)
    {
        // dd($request->all());
        // if(session('payment_page') == 'checked')
        // {
            $seo=Seo::all();

            session(['billing_address_same_as' => $request->billing_address_same_as]);

            $ssid = Session::getId();

            if(Auth::check())
            {
                $userID = Auth::user()->id;
            }
            else
            {
                $userID = null;   
            }


            if($request->shipping_method != null){
                //FOR RETRIEVE ADDRESS START
                if(Auth::check())
                {
                    $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
                }
                else
                {
                    $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
                }
                //FOR RETRIEVE ADDRESS START

                $shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'shipping'],
                [
                    'shipping_method' => $request->shipping_method
                ]);
            }


            if($request->billing_address_same_as == 'billing')
            {
                $shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'billing'],
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
                ]);

                $fullBillingAddress = $request->name.'<br>'.$request->apartment.', '.$request->address.', '.$request->city.', '.$request->state.', '.$request->country.'-'.$request->zipcode.'<br>'.$request->email.'<br>'.$request->phone;
            }
            else
            {
                //FOR RETRIEVE ADDRESS START
                if(Auth::check())
                {
                    $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
                }
                else
                {
                    $shippingAddress = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
                }
                //FOR RETRIEVE ADDRESS START

                $shipping_address = Shipping_address::updateOrCreate(['user_id' => $userID, 'ssid' => $ssid, 'address_type' => 'billing'],
                [
                    'user_id' =>  $userID,
                    'ssid' => $ssid,
                    'address_type' => 'billing',
                    'name' => $shippingAddress->name,
                    'email' => $shippingAddress->email,
                    'phone' => $shippingAddress->phone,
                    'alt_phone' => $shippingAddress->alt_phone,
                    'city' => $shippingAddress->city,
                    'state' => $shippingAddress->state,
                    'apartment' => $shippingAddress->apartment,
                    'country' => $shippingAddress->country,
                    'address' => $shippingAddress->address,
                    'zip_code' => $shippingAddress->zip_code,
                    'shipping_method' => $shippingAddress->shipping_method,
                    'comment' => $shippingAddress->comment
                ]);            

                $fullBillingAddress = $shippingAddress->apartment.', '.$shippingAddress->address.', '.$shippingAddress->city.', '.$shippingAddress->state.', '.$shippingAddress->country.'-'.$shippingAddress->zip_code;
            }



                $fullShippingAddress = $shippingAddress->apartment.', '.$shippingAddress->address.', '.$shippingAddress->city.', '.$shippingAddress->state.', '.$shippingAddress->country.'-'.$shippingAddress->zip_code;

          
            // FOR CALCULATIONS START

              $productid = $request->productid;
              $quantity = $request->quantity;
              $color = $request->color;
              $size = $request->size;
              $total = $request->total;
              $shippingCharges = $request->shippingCharges;
              $discountAmount = $request->discountAmount;
              $subtotal = $request->subtotal;
              $taxAmount = $request->taxAmount;
              $grandTotal = $request->grandTotal;

              $discountPercentage = 0;


            // FOR CALCULATIONS END
            $products = Product::where("id", "=", $request->productid)->orderby('id', 'desc')->first();
            $productImage = Product_Image::where('product_id', '=', $request->productid)->orderby('id', 'desc')->first();
            $productPrice = product_available_size::where('productid', $request->productid)->where('sizes', $request->size)->first();
            
                // dd($cart->product->product_name);

            $perProductPrice = product_available_size::where('productid', $request->productid)->where('sizes', $request->size)->first();

                $orders = Order::updateOrCreate(['ssid' => $ssid, 'status' => null, 'product_id' => $productid],
                [
                        'user_id' => $userID,
                        'ssid' => $ssid,
                        'customer_name' => $shippingAddress->name,
                        'customer_email' => $shippingAddress->email,
                        'customer_phone' => $shippingAddress->phone,
                        'customer_alt_phone' => $shippingAddress->alt_phone,
                        'shipping_address' => $fullShippingAddress,
                        'billing_address' => $fullBillingAddress,
                        'product_id' => $productid,
                        'product_name' => $products->product_name,
                        'product_quantity' => $quantity,
                        'product_color' => $color,
                        'product_size' => $size,
                        'size_id' => $productPrice->id,
                        'per_product_price' => $perProductPrice->price,
                        'total' => $total,
                        'discount_percentage' => $discountPercentage,
                        'discount_amount' => $discountAmount,
                        'subtotal' => $subtotal,
                        'taxes' => $taxAmount,
                        'shipping_method' => $shippingAddress->shipping_method,
                        'shipping_charges' => $shippingCharges,
                        'grand_total' => $grandTotal,
                        // 'transaction_id' => $request->isoutofstock,
                        // 'status' => $request->isoutofstock,
                ]);



            //FOR ORDERS TABLE END

            //FOR RETRIEVE ADDRESS START
            if(Auth::check())
            {
                $shippingAddressBilling = Shipping_address::where("ssid", $ssid)->where("address_type", "billing")->orderby('id', 'desc')->first();
                $shippingAddressShipping = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
            }
            else
            {
                $shippingAddressBilling = Shipping_address::where("ssid", $ssid)->where("address_type", "billing")->orderby('id', 'desc')->first();
                $shippingAddressShipping = Shipping_address::where("ssid", $ssid)->where("address_type", "shipping")->orderby('id', 'desc')->first();
            }
            //FOR RETRIEVE ADDRESS START

            $check_billing_address_same_as = session('billing_address_same_as');

            if($check_billing_address_same_as != null)
            {
                $session_billing_address_same_as = session('billing_address_same_as');
            }
            else
            {
                $session_billing_address_same_as = null;
            }

            return view('website.buynow.checkout-payment',compact('seo','products','productid','quantity','color','size','total','shippingCharges','discountAmount','subtotal','taxAmount','grandTotal','productImage','shippingAddressBilling','shippingAddressShipping','session_billing_address_same_as','productPrice'));
        // }
        // else
        // {
        //     return redirect('/');
        // }
    }

    // public function checkout_payment_buynow(Request $request)
    // {
    //     dd($request->all());
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



          
    //         $productid = $request->productid;
    //           $quantity = $request->quantity;
    //           $color = $request->color;
    //           $size = $request->size;
    //           $total = $request->total;
    //           $shippingCharges = $request->shippingCharges;
    //           $discountAmount = $request->discountAmount;
    //           $subtotal = $request->subtotal;
    //           $taxAmount = $request->taxAmount;
    //           $grandTotal = $request->grandTotal;
                
    //          $products = Product::where("id", "=", $request->productid)->orderby('id', 'desc')->first();
    //         $productImage = Product_Image::where('product_id', '=', $request->productid)->orderby('id', 'desc')->first();

    //          // return view('website.buynow.checkout-payment',compact('seo','shippingAddressShipping','subtotal','grandTotal'));

    //              return view('website.buynow.checkout-payment',compact('seo','shippingAddressShipping','products','productImage', 'productid', 'quantity' ,'color','size','total','shippingCharges','discountAmount','subtotal','taxAmount','grandTotal'));
    //     // }
    //     // else
    //     // {
    //     //     return redirect('/');
    //     // }
    // }
}
