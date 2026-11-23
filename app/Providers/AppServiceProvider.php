<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Cart;
use App\Product_category;
use App\Wishlist;
use App\Style;
use Auth;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // CART PRODUCTS COUNT START
        view()->composer('*', function($view)
        {
            if (strpos($view->getName(), 'marketplace.') === 0) {
                return;
            }

            if(Auth::check())
            {
                $carts = Cart::where("user_id", "=", Auth::user()->id)->where("order_status", 0)->sum("quantity");
               $cartsvalue = Cart::where("order_status", 0)->where("user_id", "=", Auth::user()->id)->get();
              // dd($carts);
            }
            else
            {
                $cartsvalue = "App\Cart"::where('ssid', Session::getId())->where("order_status", 0)->get();
                $carts = Cart::where("ssid", "=", Session::getId())->where("order_status", 0)->sum("quantity");
            }
           
            // $carts = Cart::where("ssid", "=", Session::getId())->orwhere("user_id", "=", Auth::user()->id)->count();

            $item_Price = 0;
            $item_sel_Price=0;
            $con = 0;
            $subtotal = 0;
            $total_savings=0; 
            $subtotal_price=0;
           
           for($i=0;$i<count($cartsvalue);$i++)
            {
              
                $con= $con + $cartsvalue[$i]->quantity;
                $item_Price =$cartsvalue[$i]->product_variants->price;
                $item_sel_Price =$cartsvalue[$i]->product_variants->selling_price;
                $subtotal= $subtotal + ($item_sel_Price * $cartsvalue[$i]->quantity);
                $subtotal_price =$subtotal_price + ($item_Price * $cartsvalue[$i]->quantity);
            }

            $shipping = 0.00;
            $taxes=0.00;
            $shipping=0.00;
            $discount_percentage = Session::get('discount_percentage');
            $discount_flat = Session::get('discount_flat');
            $coupon_title = Session::get('coupon_title');



            if(!empty($cartsvalue) && count($cartsvalue) > 0)
            {
                if($discount_percentage == 0.00 && $discount_flat == 0.00 )
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
    
            }
            else
            {
                Session::put('discount_percentage', 0.00);
                Session::put('discount_flat', 0.00);
                Session::put('coupon_title', null);
                    
                $initial_discount = 0.00;
                $coupon_code = null;
            }
            
            if($discount_percentage != 0.00)
            {
                $discount_amount = ($subtotal * $initial_discount)/100;
            }
            else
            {
                $discount_amount = $initial_discount;
            }
            
            $total = ($subtotal - $discount_amount) + $taxes + $shipping;
             
         
           $total_saving= ($subtotal_price - $subtotal) +  $discount_amount;
           



            if ($carts > 0) {
                $view->with('cart_count', $carts);
                $view->with('cartsvalue', $cartsvalue);
                $view->with('subtotal_amount', $total);
                $view->with('total_saving', $total_saving);
            }else {
                $view->with('cart_count', null);
                $view->with('cartsvalue', $cartsvalue);
            }


            $category = Product_category::get();
           $category_count=count($category);
         

            if ($category_count > 0) {
                $view->with('header_cat', $category);
            }else {
                $view->with('header_cat', null);
            }
            
        });
        // CART PRODUCTS COUNT END


        view()->composer('*', function($view)
        { 
            if (strpos($view->getName(), 'marketplace.') === 0) {
                return;
            }

            $wish=[];
            if(Auth::check())
            {
                $wish = Wishlist::where("user_id", "=", Auth::user()->id)->count("id");
                
            }
            
            // $carts = Cart::where("ssid", "=", Session::getId())->orwhere("user_id", "=", Auth::user()->id)->count();

            if ($wish > 0) {
                $view->with('wish_count', $wish);
            }else {
                $view->with('wish_count', null);
            }


            
            
        });


      







    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        

    }







}
