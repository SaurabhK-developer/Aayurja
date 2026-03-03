<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;
use App\Seo;
use Auth;
use App\Product;
use DB;
use App\Wishlist;
use App\product_available_size;
use App\Coupon;
use Carbon\Carbon;
use App\Product_color;
use App\ProductVariants;
use App\Http\Controllers\Traits\MasterTrait;


class CartController extends Controller
{
    use MasterTrait;

    public function __construct() {
        $this->middleware(['auth']);
    }


    public function index()
    {
        
        $seo=Seo::all();
        $user = Auth::user();
        $currentSSID = Session::getId();

        if(Auth::check())
        {
            $carts = Cart::where("ssid", "=", $currentSSID)->where("order_status", 0)->orwhere("user_id", "=", $user->id)->orderby('id', 'asc')->get();
            
            $data = DB::table('carts')->where('ssid', '=', $currentSSID)->where("order_status", 0)->orwhere("user_id", "=", $user->id)
            ->join('products', function($join)
            {
                $join->on('carts.product_id', '=', 'products.id');
                 
            })
            ->get();
        }
        else
        {
            $carts = Cart::where("ssid", "=", $currentSSID)->where("order_status", 0)->orderby('id', 'asc')->get();
            
            $data = DB::table('carts')->where('ssid', '=', $currentSSID)->where("order_status", 0)->join('products', function($join)
            {
                $join->on('carts.product_id', '=', 'products.id');
                 
            })
            ->get();
        }
        
        $itemPrice = 0;
        $itemSize = null;
        $subtotalamount = 0;
        
       for($i=0;$i<count($data);$i++)
        {
            $itemPrice = $data[$i]->item_price_by_size;
            $subtotalamount = $subtotalamount + ($itemPrice * $data[$i]->quantity);
            
        }
        
        //CALCULATIONS
        $shipping = 0.00;
        
        $discount_percentage = Session::get('discount_percentage');
        $discount_flat = Session::get('discount_flat');
        $coupon_title = Session::get('coupon_title');
        
        
        
        if(!empty($carts) && count($carts) > 0)
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
        
        
        
        
        $subtotal = $subtotalamount;
        
        if($discount_percentage != 0.00)
        {
            $discount_amount = ($subtotal * $initial_discount)/100;
        }
        else
        {
            $discount_amount = $initial_discount;
        }
        
        $taxes = (($subtotalamount - $discount_amount) * 0)/100;
        
        $total = ($subtotalamount - $discount_amount) + $taxes + $shipping;
        //CALCULATIONS
       
        
        $products = Product::where('best_sellers', 1)->where('approved', 1)->limit(4)->get();
        
        
        
        //-- VERIFY CONTENT IS OUT OF STOCK OR NOT START --//
        
        $outofstock = 'no';
        $outofstockArr =array();
        
        if(count($data) > 0)
        {
            for($i=0;$i<count($data);$i++)
            {
                
                if($data[$i]->outofstock == 0)
                {
                    $outofstock = 'no';
                    // $msg = $msg.''.$data[$i]->product_name.' is in stock!';
                    $checkSize = product_available_size::where('productid', $data[$i]->product_id)->where('sizes', $data[$i]->size)->first();
                    
                    if(!empty($checkSize) && $checkSize != null)
                    {   
                        $outofstock = 'no';
                        //cart color check
                        if(count($carts) > 0)
                        {
                                $product = Product::where('id', $carts[$i]->product_id)->first();
                                
                                if($carts[$i]->color == $product->color1 || $carts[$i]->color == $product->color2 || $carts[$i]->color == $product->color3 || $carts[$i]->color == $product->color4 || $carts[$i]->color == $product->color5)
                                {
                                    $outofstock = 'no';
                                    // BLANK
                                }
                                else
                                {
                                    // $msg = $msg.''.$data[$i]->product_name.' ('.$carts[$i]->color.') is currently out of stock! Please try different color.<br>';
                                    $outofstock = 'yes';
                                }
                        }
                        //cart color check end
                    }
                    else
                    {
                        // $msg = $msg.''.$data[$i]->product_name.' ('.$data[$i]->size.') is currently out of stock! Please try different size.<br>';
                        $outofstock = 'yes';
                    }
                }
                else
                {
                    // $msg = $msg.''.$data[$i]->product_name.' ('.$data[$i]->size.' | '.$data[$i]->color.') is currently out of stock!<br>';
                    $outofstock = 'yes';
                }
                
                $outofstockArr[] = $outofstock;
                
            }

        }
        //-- VERIFY CONTENT IS OUT OF STOCK OR NOT END --//
        
        
        return view('website.add-cart',compact('seo','carts','currentSSID','subtotal','products','taxes', 'discount_amount', 'shipping','total','discount_percentage','discount_flat','coupon_code','outofstockArr'));
        
        
    }
        
        

    public function store(Request $request)
   {
//    dd($request->all());
    $data = ProductVariants::where("product_id", $request->product_id)
             ->where("weight", $request->weight)->first();


             if (!$data) {
                // Handle the case where the product variant is not found
                return response()->json([
                    'message' => 'Product variant not found',
                    'alert' => 'error'
                ]);
            }
    
    $updateProduct = Cart::where('user_id', Auth::user()->id)
                        ->where('product_id', $request->product_id)
                        ->where('weight', $request->weight)
                        ->where("order_status", 0)
                        ->where('product_variants_id', $data->id)->first();
          

    if (!empty($updateProduct)) {
        return response()->json([
            'message' => 'Product Already in Cart',
            'alert' => 'error'
        ]);
    } else {
        $cart = new Cart;
        if (Auth::check()) {
            $cart->ssid = Session::getId();
            $cart->user_id = Auth::user()->id;
        } else {
            $cart->ssid = Session::getId();
        }
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->weight = $request->weight;
        $cart->size_id = $request->size;
        $cart->price = $request->price; 
        $cart->product_variants_id = $data->id;
        $cart->save();

        return response()->json([
            'message' => 'Product Added to Cart',
            'alert' => 'success'
        ]);
    }
}




        public function cart_To_wish(Request $request)
        {  // dd($request->all());
            if($request->weight)
            {   
           $data = ProductVariants::where("product_id", $request->product_id)->where("weight", $request->weight)->first();
           $updateProduct = "App\Wishlist"::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->where('weight', $request->weight)->where('chosenweight', $data->id)->first();
           if(empty($updateProduct)){
           $wish = new Wishlist;
           $wish->ssid = Session::getId();
           $wish->user_id = Auth::user()->id;
           $wish->product_id = $request->product_id;
           $wish->weight = $request->weight;
           $wish->size = $request->size;
           $wish->chosenweight = $data->id;
           $wish->save();
            $d = "App\Cart"::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->where('weight', $request->weight)->delete();
            $notification = array(
                'message' => 'Successfully Moved To wishlist',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification); 
            }
            else{

                $notification = array(
                    'message' => 'Product Already Exist in wishlist',
                    'alert-type' => 'error'
                );
        
                return redirect()->back()->with($notification);

               
            }




           return redirect('add-to-cart');
            
            }
   
   
       }




    public function destroy($productid, $size, $color)
    {
        
      // $cart = Cart::findOrFail($id);
      // $cart->delete();

      // return redirect()->route('website.add-cart')
      //     ->with('flash_message',
      //      'Item successfully deleted');
        $ssid = Session::getId();

        if(Auth::check())
        {
            $cart = Cart::where("user_id", "=", Auth::user()->id)->where("product_id", "=", $productid)->where("size", "=", $size)->where("color", "=", $color)->first();
        }
        else
        {
            $cart = Cart::where("ssid", "=", $ssid)->where("product_id", "=", $productid)->where("size", "=", $size)->where("color", "=", $color)->first();
        }

        $cart->delete();
        
        Session::flash('success', 'Product removed from your cart.');
        
        return redirect()->back();
    }

    public function move_to_wishlist($userid, $productid, $color, $size)
    {
        $ssid = Session::getId();


        $status=Wishlist::where('user_id',Auth::user()->id)->where('product_id',$productid)->first();

        if(isset($status->user_id) and isset($productid))
           {
                $this->destroy($productid, $color, $size);
                Session::flash('success', 'Item is already in your wishlist');
                return redirect()->back();
           }
           else
           {
                $wishlist = new Wishlist;
                $wishlist->user_id = $userid;
                $wishlist->product_id = $productid;
                $wishlist->save();
                $this->destroy($productid, $size, $color);

                Session::flash('success', 'Added to your wishlist.');
                return redirect()->back();
           }
    }

    // public function increase_qty($ssid, $productid, $size, $color)
    // {

    //     if(Auth::check())
    //     {
    //         $cart = Cart::where("user_id", "=", Auth::user()->id)->where("product_id", "=", $productid)->where("size", "=", $size)->where("color", "=", $color)->first();
    //     }
    //     else
    //     {
    //         $cart = Cart::where("ssid", "=", $ssid)->where("product_id", "=", $productid)->where("size", "=", $size)->where("color", "=", $color)->first();
    //     }

        
    //     $cart->quantity = $cart->quantity + 1;
    //     $cart->update();

    //     Session::flash('success', 'Product quantity increased.');
        
    //     return response()->json('Qty increased');
        
    //     // return redirect()->back();

    // }

    // public function decrease_qty($ssid, $productid, $size, $color)
    // {
    //     if(Auth::check())
    //     {
    //         $cart = Cart::where("user_id", "=", Auth::user()->id)->where("product_id", "=", $productid)->where("size", "=", $size)->where("color", "=", $color)->first();
    //     }
    //     else
    //     {
    //         $cart = Cart::where("ssid", "=", $ssid)->where("product_id", "=", $productid)->where("size", "=", $size)->where("color", "=", $color)->first();
    //     }

    //     if($cart->quantity >=2)
    //     {
    //         $cart->quantity = $cart->quantity - 1;
    //         $cart->update();
    //     }
        
    //     Session::flash('success', 'Product quantity decreased.');
        
    //     return response()->json('Qty decreased');
    //     // return redirect()->back();
    // }

    public function addToWishlist(Request $request)
{
    try {
        $userId = Auth::user()->id;

        // Check if the product is already in the wishlist
        $existingWishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingWishlistItem) {
            // Return a response indicating the product is already in the wishlist
            $wish_count = Wishlist::where('user_id', $userId)->count();
            return response()->json(['status' => 'exists', 'message' => 'Product is already in your wishlist.', 'wish_count' => $wish_count]);
        }

        // Add the product to the wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
        ]);

        // Get the updated wishlist count
        $wish_count = Wishlist::where('user_id', $userId)->count();

        return response()->json(['status' => 'success', 'message' => 'Product added to wishlist successfully!', 'wish_count' => $wish_count]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'An error occurred while adding to wishlist.'], 500);
    }
}

    
public function removeFromCart(Request $request)
{
    try {
        
        $cart = Cart::where('id', $request->cart_id)->where('user_id', Auth::id())->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Product removed from cart successfully!']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred while removing the product from the cart.'], 500);
    }
}


public function moveToWishlist(Request $request)
{
    try {
       
        $existingWishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingWishlistItem) {
            return response()->json(['message' => 'Product is already in the wishlist.'], 409);
        }

        // Add the product to the wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        // Remove the product from the cart after moving to the wishlist
        $cart = Cart::where('id', $request->cart_id)->where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->delete();
        }

        return response()->json(['message' => 'Product moved to wishlist successfully!']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred while moving the product to the wishlist.'], 500);
    }
}


public function getCartCount()
{
    try {
        $cartCount = Cart::where("order_status", 0 )->where('user_id', Auth::id())->count(); // Adjust query if needed
       
        return response()->json(['cart_count' => $cartCount]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Unable to fetch cart count'], 500);
    }
}



    // public function applyCoupon(Request $request)
    // {
    //     $msg = null;
    //     $step1 = FALSE;
    //     $step2 = FALSE;
    //     $step3 = FALSE;
    //     $step4 = FALSE;
    //     $step5 = FALSE;
    //     $discount_percentage = 0.00;
    //     $discount_flat = 0.00;
    //     // dd($request->coupon_applied);
    //     // return response()->json($query1);
        
        
        
        
    //     $user = Auth::user();
    //     $currentSSID = Session::getId();

    //     if(Auth::check())
    //     {
    //         $carts = Cart::where("ssid", "=", $currentSSID)->orwhere("user_id", "=", $user->id)->get();
    //     }
    //     else
    //     {
    //         $carts = Cart::where("ssid", "=", $currentSSID)->get();
    //     }

    //     //BEFORE STEP 1
    //     if(!empty($carts) && count($carts) > 0)
    //     {
    //         $step1 = TRUE;
    //     }
    //     else
    //     {
    //         $step1 = FALSE;
    //         $msg = 'Please add atleast one product to apply coupon!';
    //         return response()->json(['msg' => $msg,'discount_percentage' => $discount_percentage,'codeApplied' => 'no']);
    //     }
        
        
        
 
    //     //STEP 1
    //     if($step1 = TRUE)
    //     {
    //         $query1 = Coupon::where('title', $request->coupon_applied)->first();
        

    //         if(empty($query1) || $query1 == null)
    //         {
    //             Session::put('discount_percentage', 0.00);
    //             Session::put('coupon_title', null);
    //             $step2 = FALSE;
    //             $msg = 'Invalid Coupon!';
    //             return response()->json(['msg' => $msg,'discount_percentage' => $discount_percentage,'codeApplied' => 'no']); 
    //         }
    //         else
    //         {
    //             $step2 = TRUE;
    //         }
    //     }
        
    //     //STEP 2
    //     if($step2 = TRUE)
    //     {
    //         $query2 = Coupon::where('title', $request->coupon_applied)->Where('active', 1)->first();
            
    //         if(empty($query2) || $query2 == null)
    //         {
    //             Session::put('discount_percentage', 0.00);
    //             Session::put('coupon_title', null);
    //             $step3 = FALSE;
    //             $msg = 'Coupon Expired!';
    //             return response()->json(['msg' => $msg,'discount_percentage' => $discount_percentage,'codeApplied' => 'no']); 
    //         }
    //         else
    //         {
    //             $step3 = TRUE;
    //         }
    //     }
        
    //     //STEP 3
    //     if($step3 = TRUE)
    //     {
    //         $currentdate = Carbon::now();
    //         $query3 = Coupon::where('title', $request->coupon_applied)->Where('active', 1)->where('valid_from', '<=', $currentdate->toDateString())->where('valid_upto', '>=', $currentdate->toDateString())->first();
            
    //         if(empty($query3) || $query3 == null)
    //         {
    //             Session::put('discount_percentage', 0.00);
    //             Session::put('coupon_title', null);
    //             $step4 = FALSE;
    //             $msg = 'Coupon Expired!';
    //             return response()->json(['msg' => $msg,'discount_percentage' => $discount_percentage,'codeApplied' => 'no']); 
    //         }
    //         else
    //         {
    //             $step4 = TRUE;
    //         }
    //     }
        
    //     if($step4 = TRUE)
    //     {
    //         $currentdate = Carbon::now();
    //         $data = Coupon::where('title', $request->coupon_applied)->where('active', 1)->first();
    //         $query4 = Coupon::where('title', $request->coupon_applied)->Where('active', 1)->where('valid_from', '<=', $currentdate->toDateString())->where('valid_upto', '>=', $currentdate->toDateString())->where('limit_used', '<', $data->limit_upto)->first();
            
    //         if(empty($query4) || $query4 == null)
    //         {
    //             Session::put('discount_percentage', 0.00);
    //             Session::put('coupon_title', null);
    //             $step5 = FALSE;
    //             $msg = 'User Limit Exceeded!';
    //             return response()->json(['msg' => $msg,'discount_percentage' => $discount_percentage,'codeApplied' => 'no']); 
    //         }
    //         else
    //         {
    //             $step5 = TRUE;
    //         }
    //     }
        





    //     if($step5 = TRUE)
    //     {
    //         $currentdate = Carbon::now();
    //         $data = Coupon::where('title', $request->coupon_applied)->where('active', 1)->first();
    //         $query5 = Coupon::where('title', $request->coupon_applied)->Where('active', 1)->where('valid_from', '<=', $currentdate->toDateString())->where('valid_upto', '>=', $currentdate->toDateString())->where('limit_used', '<', $data->limit_upto)->first();
            
    //         if($query5->discount_type == 'discount_percentage')
    //         {
    //             $discount_percentage = $query5->discount_percentage;
    //         }
    //         else if($query5->discount_type == 'discount_flat')
    //         {
    //             $discount_flat = $query5->discount_flat;
    //         }
    //         else{
                
    //             $products = explode(',', $query5->product);

    //             // Convert the array elements to integers
    //             $products = array_map('intval', $products);
    //             $specific_product_discount= $query5->discount_percentage;
    //          }

             
    //         $coupon_title = $query5->title;
            
    //         if(empty($query5) || $query5 == null)
    //         {   
    //             Session::put('discount_type',$query5->discount_type);
    //             Session::put('discount_percentage', 0.00);
    //             Session::put('discount_flat', 0.00);
    //             Session::put('coupon_title', null);
    //             Session::put('specific_product_discount', null);
    //             Session::put('$products', null);
                
    //             $msg = 'Something went wrong!';
    //             return response()->json(['msg' => $msg,'codeApplied' => 'no']); 
    //         }
    //         else
    //         {
    //             if($query5->discount_type == 'discount_percentage' || $discount_percentage != 0.00)
                
    //             {   Session::put('discount_type',$query5->discount_type);
    //                 Session::put('discount_percentage', $discount_percentage);
    //                 Session::put('discount_flat', null);
    //                 Session::put('coupon_title', $coupon_title);
    //                 Session::put('specific_product_discount', null);
    //                 Session::put('$products', null);
    //                 $msg =  $coupon_title.' applied: A discount of '.$discount_percentage.'% has been applied successfully.';
    //                 // dd($msg);

    //                 return response()->json(['msg' => $msg,'discount_percentage' => $discount_percentage,'codeApplied' => 'yes']);
    //             }
    //             else if($query5->discount_type == 'discount_flat')
    //             {
    //                 // dd('bbb');
    //                 Session::put('discount_type',$query5->discount_type);
    //                 Session::put('discount_flat', $discount_flat);
    //                 Session::put('discount_percentage', $discount_percentage);
    //                 Session::put('coupon_title', $coupon_title);
    //                 Session::put('specific_product_discount', null);
    //                 Session::put('$products', null);
    //                 $msg =  $coupon_title.' applied: A discount of flat '.$discount_flat.' INR has been applied successfully.';
    //                 return response()->json(['msg' => $msg,'discount_flat' => $discount_flat,'codeApplied' => 'yes']);
    //             }
        

    //             else{
    //                 $product_ids = [];
    //                 $carts = Cart::where("order_status", 0)->where("user_id", "=", Auth::user()->id)->get();
    //                 foreach ($carts as $cart) {
    //                     $product_ids[] = $cart->product_id; // Append each product ID to the array
    //                 }
                    

    //                 //dd($products);
                 
    //                 if (empty(array_diff( $products ,$product_ids ))) {
                        
    //                     Session::put('discount_type',$query5->discount_type);
    //                     Session::put('discount_flat', null);
    //                     Session::put('discount_percentage', null);
    //                     Session::put('products', $products);
    //                     Session::put('coupon_title', $coupon_title);
    //                     Session::put('specific_product_discount', $specific_product_discount);
    //                     $msg =  $coupon_title.' applied: A  spacial discount of persent '.$specific_product_discount.' INR has been applied successfully.';
    //                     return response()->json(['msg' => $msg,'discount_percentage' => $specific_product_discount,'codeApplied' => 'yes']);
    //                 }

    //                 else{

    //                     Session::put('discount_type',$query5->discount_type);
    //                     Session::put('discount_flat', null);
    //                     Session::put('discount_percentage', null);
    //                     Session::put('products', $products);
    //                     Session::put('coupon_title', $coupon_title);
    //                     Session::put('specific_product_discount', null);
    //                     $msg = 'Something went wrong!';
    //                     return response()->json(['msg' => $msg,'codeApplied' => 'no']);
    //                 }










                  
                   

    //             }




    //         }
    //     }
        
    // }


    public function applyCoupon(Request $request)
{
    $msg = null;
    $discount_percentage = 0.00;
    $discount_flat = 0.00;
    $specific_product_discount = 0.00;

    $user = Auth::user();
    $currentSSID = Session::getId();

    // Retrieve carts based on user authentication
    $carts = Auth::check() 
        ? Cart::where("ssid", "=", $currentSSID)->orWhere("user_id", "=", $user->id)->get()
        : Cart::where("ssid", "=", $currentSSID)->get();

    // Check if there are any items in the cart
    if ($carts->isEmpty()) {
        return response()->json(['msg' => 'Please add at least one product to apply coupon!', 'discount_percentage' => $discount_percentage, 'codeApplied' => 'no']);
    }



    

    // Validate coupon
    $currentdate = Carbon::now();
    $coupon = Coupon::where('title', $request->coupon_applied)
        ->where('active', 1)
        ->where('valid_from', '<=', $currentdate->toDateString())
        ->where('valid_upto', '>=', $currentdate->toDateString())
        ->first();

    // Check if the coupon is valid
    if (!$coupon) {
        return response()->json(['msg' => 'Invalid or expired coupon!', 'discount_percentage' => $discount_percentage, 'codeApplied' => 'no']);
    }

    // Check usage limit
    if ($coupon->limit_used >= $coupon->limit_upto) {
        return response()->json(['msg' => 'User  Limit Exceeded!', 'discount_percentage' => $discount_percentage, 'codeApplied' => 'no']);
    }


    // Apply discounts based on coupon type
    if ($coupon->discount_type === 'discount_percentage') {
        $discount_percentage = $coupon->discount_percentage;
        Session::put('discount_type', 'discount_percentage');
        Session::put('discount_percentage', $discount_percentage);
        Session::put('discount_flat', null);
        $msg = "{$coupon->title} applied: A discount of {$discount_percentage}% has been applied successfully.";
    } elseif ($coupon->discount_type === 'discount_flat') {
        $discount_flat = $coupon->discount_flat;
        Session::put('discount_type', 'discount_flat');
        Session::put('discount_flat', $discount_flat);
        Session::put('discount_percentage', null);
        $msg = "{$coupon->title} applied: A flat discount of {$discount_flat} INR has been applied successfully.";
    } 
    
      else {
        // Assuming specific product discount logic
        $products = explode(',', $coupon->product);
        $product_ids = $carts->pluck('product_id')->toArray(); // Get product IDs from the cart
        $matching_products = array_intersect($products, $product_ids);
        // Check if the coupon is applicable to the items in the cart
        if (!empty($matching_products)) {
            $specific_product_discount = $coupon->discount_percentage; // Assuming this is the specific product discount
            Session::put('discount_type', 'specific_product');
            Session::put('specific_product_discount', $specific_product_discount);
            Session::put('products', $products);
            Session::put('coupon_title', $coupon->title);
            $msg = "{$coupon->title} applied: A special discount of {$specific_product_discount} persent has been applied successfully.";
        } else {
            return response()->json(['msg' => 'The coupon is not applicable to the items in your cart!', 'codeApplied' => 'no']);
        }
    }

    // Set the coupon title in the session
    Session::put('coupon_title', $coupon->title);

    return response()->json(['msg' => $msg, 'discount_percentage' => $discount_percentage, 'discount_flat' => $discount_flat, 'specific_product_discount'=> $specific_product_discount ,'codeApplied' => 'yes']);
}
    
    
    public function removeCoupon()
    {
        Session::put('discount_percentage', 0.00);
        Session::put('discount_flat', 0.00);
        Session::put('coupon_title', null);
        Session::put('products', null);
        Session::put('specific_product_discount',0.00);
        Session::put('discount_type',null);
        

        $codeRemoved =  'yes';
                
        return response()->json(['codeRemoved' => $codeRemoved]);
    }
    
    public function cartUpdateWhileLoadingPage()
    {
        $user = Auth::user();
        $currentSSID = Session::getId();
        
        $msg = '';

        if(Auth::check())
        {
            $carts = Cart::where("ssid", "=", $currentSSID)->orwhere("user_id", "=", $user->id)->get();
            
            $data = DB::table('carts')->where('ssid', '=', $currentSSID)->orwhere("user_id", "=", $user->id)
            ->join('products', function($join)
            {
                $join->on('carts.product_id', '=', 'products.id');
                 
            })
            ->get();
        }
        else
        {
            $carts = Cart::where("ssid", "=", $currentSSID)->get();
            
            $data = DB::table('carts')->where('ssid', '=', $currentSSID)->join('products', function($join)
            {
                $join->on('carts.product_id', '=', 'products.id');
                 
            })
            ->get();
        }
        
        
    
        
        if(count($data) > 0)
        {
            for($i=0;$i<count($data);$i++)
            {
                
                if($data[$i]->outofstock == 0)
                {
                    // $msg = $msg.''.$data[$i]->product_name.' is in stock!';
                    $checkSize = product_available_size::where('productid', $data[$i]->product_id)->where('sizes', $data[$i]->size)->first();
                    
                    if(!empty($checkSize) && $checkSize != null)
                    {
                        // $msg = $msg.'Size '.$data[$i]->size.' of '.$data[$i]->product_name.' is in stock!';
                        
                        Cart::where("ssid", "=", $currentSSID)->where('product_id', $data[$i]->product_id)->where('size', $data[$i]->size)->where('color', $data[$i]->color)->update(['item_price_by_size' => $checkSize->price]);
                        
                        //cart color check
                        if(count($carts) > 0)
                        {
                                $product = Product::where('id', $carts[$i]->product_id)->first();
                                
                                if($carts[$i]->color == $product->color1 || $carts[$i]->color == $product->color2 || $carts[$i]->color == $product->color3 || $carts[$i]->color == $product->color4 || $carts[$i]->color == $product->color5)
                                {
                                    // $msg = $msg.'Color '.$carts[$i]->color.' of '.$data[$i]->product_name.' is in stock!';
                                }
                                else
                                {
                                    $msg = $msg.''.$data[$i]->product_name.' ('.$carts[$i]->color.') is currently out of stock! Please try different color.<br>';
                                    Cart::where("ssid", "=", $currentSSID)->where('product_id', $data[$i]->product_id)->where('size', $data[$i]->size)->where('color', $data[$i]->color)->update(['quantity' => 0]);
                                    // $msg = $msg.'Color '.$carts[$i]->color.' of '.$data[$i]->product_name.' is out of stock!<br>';
                                }
                        }
                        //cart color check end
                    }
                    else
                    {
                        $msg = $msg.''.$data[$i]->product_name.' ('.$data[$i]->size.') is currently out of stock! Please try different size.<br>';
                        Cart::where("ssid", "=", $currentSSID)->where('product_id', $data[$i]->product_id)->where('size', $data[$i]->size)->where('color', $data[$i]->color)->update(['quantity' => 0]);
                        // $msg = $msg.'Size '.$data[$i]->size.' of '.$data[$i]->product_name.' is out of stock!<br>';
                    }
                }
                else
                {
                    $msg = $msg.''.$data[$i]->product_name.' ('.$data[$i]->size.' | '.$data[$i]->color.') is currently out of stock!<br>';
                    Cart::where("ssid", "=", $currentSSID)->where('product_id', $data[$i]->product_id)->where('size', $data[$i]->size)->where('color', $data[$i]->color)->update(['quantity' => 0]);
                    // $msg = $msg.'Size: '.$data[$i]->size.' and color: '.$data[$i]->color.' of '.$data[$i]->product_name.' is out of stock!<br>';
                }
                
                
                
            }
            return response()->json(['msg' => $msg]);
            
        }
        // else
        // {
        //     $msg = 'Your cart is still empty! Go Shopping!<br>';
        //     return response()->json(['msg' => $msg]);
        // }
        
        
        
    }
}
