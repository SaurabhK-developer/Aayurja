<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Seo;
use App\ProductVariants;
use App\Size;

use App\Product;
use DB;
use App\Wishlist;
use App\Http\Controllers\Traits\MasterTrait;
use Auth;
use App\Cart;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller


{
   use MasterTrait;

    public function __construct() {
        $this->middleware(['auth']);
    }

 
//wish  -->










// public function wish_to_cart(Request $request)
// {
//     if (Auth::User()) {
//         $user_id = Auth::user()->id;
//     }

//     $ssid = $request->ssid;
//     $product_id = $request->product_id;
//     $wl = new Wishlist;
//     $wl->user_id = $user_id;
//     $wl->ssid = $ssid;
//     $wl->product_id = $product_id;
//     if ($request->weight) {
//         $product = "App\Product"::find($product_id);
//         $count = $product->product_variants ? count($product->product_variants) : 0;
//         if ($count > 0) {
//             $obj = ProductVariants::where('weight', $request->weight)->where('product_id', $product_id)->first();
//             $wl->chosenweight = $obj->id;
//             $wl->weight = $obj->weight;
//         }else{
//             $wl->chosenweight = $request->weight;
//             $wl->weight = $request->weight;
//         }
//     }else{
//         $product = "App\Product"::find($product_id);
//         $variants_count = $product->product_variants ? $product->product_variants->count() : 0;
//         if($product->product_variants->count() > 0){
//             $wl->chosenweight = $product->product_variants[0]->id;
//             $wl->weight = $product->product_variants[0]->weight;
//            // dd($wl->weight);
//         }else{
//             $wl->chosenweight = $product->weight;
//             $wl->weight = $product->weight;
//         }
//     }
    
//     if ($request->qty) {
//         $wl->chosenqty = $request->qty;
//     }
//     $wl->save();

//    // $carts =  $this->countProduct($ssid);

//     $wish_count   = DB::table('whishlists')->join('products', 'products.id', '=', 'whishlists.product_id')->where('user_id', $user_id)->where("products.active", "1")->sum('chosenqty');
//     //$wish_count = Wishlist::where("user_id", "=", Auth::user()->id)->count("id");
//     if($request->redirect_type){
//         return redirect()->back();
//     }else{
//         return response()->json(['success' => "1",'wish_count' => $wish_count]);
//     }



// wishend



//new



public function add_to_wish(Request $request)
{
   


    if($request->weight)
     {   
        $data = ProductVariants::where("product_id", $request->product_id)->where("weight", $request->weight)->first();
     
        $updateProduct = "App\Wishlist"::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->where('weight', $request->weight)->where('chosenweight', $data->id)->first();
      
        
        if(!empty($updateProduct))
        {
            $newQuantity = $updateProduct->quantity + $request->quantity;
            if(Auth::check())
            {
                $updateProduct->ssid = Session::getId();
                $updateProduct->user_id = Auth::user()->id;
                $updateProduct->product_id = $request->product_id;
               // $updateProduct->weight = $data->weight;
                $updateProduct->chosenweight = $data->id;
                $updateProduct->update();
              
            }
            
          
        }
        else
        {
            if(Auth::check())
            {
             // dd('hi');
            $wish = new Wishlist;
            $wish->ssid = Session::getId();
            $wish->user_id = Auth::user()->id;
            $wish->product_id = $request->product_id;
            $wish->weight = $data->weight;
            $wish->chosenweight = $data->id;
            $wish->save();

          
            //$weight= $request->weight;
           // DB::table('Carts')->where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id,'weight'=>$weight ])->delete();
           // $d = "App\Cart"::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->where('weight', $weight)->delete();

            }

            $notification = array(
                'message' => 'Added to your wishlist',
                'alert-type' => 'success'
            );

        }


    }
    else
    {
          
            if(Auth::check())
                {
                   
                    $product = "App\Product"::find($request->product_id);
                    $variants_count = $product->product_variants ? $product->product_variants->count() : 0;
                    $wish = new Wishlist;
                    $wish->ssid = Session::getId();
                    $wish->user_id = Auth::user()->id;
                    $wish->product_id = $request->product_id;
                    $wish->chosenweight = $product->product_variants[0]->id;
                    $wish->weight = $product->product_variants[0]->weight;
                    //$wish->size = $request->size;
                    $wish->save();
                  
                    $notification = array(
                        'message' => 'Added to your wishlist',
                        'alert' => 'success'
                    );

                }
                
        }
    


       

   
$wish_count = Wishlist::where("user_id", "=", Auth::user()->id)->count("id");
   // $wish_count   = DB::table('whishlists')->join('products', 'products.id', '=', 'whishlists.product_id')->where('user_id', $user_id)->where("products.active", "1")->sum('chosenqty');
    if($request->redirect_type){
        return redirect()->back()->with($notification);
    }else{

        
       // return redirect()->back()->with($notification);
       
        return response()->json(['success' => "1",'notification' => $notification,'wish_count' => $wish_count]);
    }
} 




//move to cart

public function backToCart(Request $request)
     {   
        //dd($request->all());

        $ifProductExists = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        $ifWeightExists = ProductVariants::where("product_id", $request->product_id)->where("weight", $request->weight)->first();

        // dd($ifProductExists.'___'.$ifWeightExists);

        if($ifProductExists && $ifWeightExists)
        {
            // $data = ProductVariants::where("product_id", $request->product_id)->where("weight", $request->weight)->first();
          
            $ds = "App\Wishlist"::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->delete();

       
            $notification = array(
                'message' => 'Successfully Move to cart',
                'alert' => 'exists'
            );
            
        }
        else
        {
            $data = ProductVariants::where("product_id", $request->product_id)->where("weight", $request->weight)->first();

            $cart = new Cart;
            $cart->ssid = Session::getId();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->weight = $request->weight;
        
            $cart->product_variants_id = $data->id;
            $cart->save();

            $ds = "App\Wishlist"::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->delete();

       
            $notification = array(
                'message' => 'Successfully Move to cart',
                'alert' => 'success'
            );
        }

        

        
    
            // return redirect('add-to-cart')->with($notification);
            return response()->json($notification);

    }



    public function delete_wish(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['status' => 401, 'notification' => ['message' => 'Unauthorized', 'alert' => 'error']]);
    }

    $user_id = Auth::id();
    $product_id = $request->product_id;

    $product = Product::find($product_id);
    if (!$product) {
        return response()->json(['status' => 404, 'notification' => ['message' => 'Product not found', 'alert' => 'error']]);
    }

    DB::table('whishlists')->where(['user_id' => $user_id, 'product_id' => $product_id])->delete();

    $wish_count = DB::table('whishlists')->where('user_id', $user_id)->count();

    return response()->json(['status' => 200, 'wish_count' => $wish_count]);
}   

}
