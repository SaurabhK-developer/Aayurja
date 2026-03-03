<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Rules\Recaptcha;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use Illuminate\Support\Facades\Crypt;
use App\Occasion;
use Auth;
use Mail;
// use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendEnquiry;
use Config;
use Response;
use DB;
use App\Slider;
use App\Wishlist;
use App\Deal;
use App\Coupon;
use Carbon\Carbon;
use App\Blog;
use App\NewsLetter;
use App\Goal;
use App\Designer;
use App\Product_category;
use App\User;
use App\Tag;
use App\Seo;
use App\Dynamicemail;
use App\Formtype;
use App\Sitemap; 
use App\Robots; 
use App\Ror; 
use App\Urllist; 
use App\Altimage;
use App\Product;
use App\Cart;
use App\Metalcolor;
use App\Metalpurity;
use App\Style;
use App\ProductVariants;
use App\Product_Image;
use App\Product_sub_category;
use App\flavourmappings;
use App\Type;
use App\Subcategory;
use App\Size;
use App\product_available_size;
use App\Season;
use App\Media;
use App\Rating;
use App\Occasioncategory;
use App\Color;
use App\Http\Controllers\Traits\MasterTrait;
use App\Survey;
use App\BillingAddress;
use App\Concern;
use App\AbandonedCart;
use App\News;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Order;
use App\Referral;




class WebsiteController extends Controller

{

    use MasterTrait;





    // public function new_index()
    // {

    //     $seo = Seo::all();
        
    //     // $deal=deal::where('start_date',date("Y-m-d") )->where('status',1 )->get();
    //     // $product = Product::orderBy('id', 'desc')->where('active', 1)->get(); 
    //     // $Product_goal=all();
    //     $seasons = Season::get();


    //     $productLimited = Product::where('on_sale', 0)->orderBy('id', 'desc')->limit(5)->get();
    //     $favouriteProducts = Product::where('on_sale', 0)->where('favourite', 1)->limit(10)->get();
    //     $categories = Product_sub_category::where('category_on_home', 1)->limit(10)->get();
    //     $blogs = Blog::orderBy('id', 'desc')->get()->take('4');
    //     $occasions = Occasion::orderBy('id', 'desc')->limit('7')->get();
    //     $productcategories = Product_category::orderBy('id','desc')->limit('10')->get();
         


    //     // $products = Product::orderby('created_at', 'desc')->limit(10)->get();
    //     // $products = Product::where('on_sale', 0)->with('review')->orderby('created_at', 'desc')->get();
    //     $products = Product::where('on_sale', 0)->with('review')->orderBy('product_name', 'desc')->orderBy('created_at', 'desc')->get();
    //     // $groupedProducts = $products->groupBy('product_subcategory');


    //     $bestProducts = Product::where('on_sale', 0)->where('bestproduct', 1)->orderby('created_at', 'desc')->limit(10)->get();
    //     $limitFourproducts = Product::where('on_sale', 0)->orderby('created_at', 'desc')->limit(4)->get();

    //      $limitFourBlogs= Blog::orderBy('id', 'desc')->take('3')->get();

    //     $couponSpecificProduct = Coupon::where('discount_type', 'specific_product')->where('active', 1)->get();

    //     return view('website.old-index', compact('seo', 'productcategories','seasons', 'productLimited', 'categories', 'products', 'favouriteProducts', 'blogs', 'occasions','bestProducts','limitFourproducts','limitFourBlogs','couponSpecificProduct'));
    // }

    public function index()
    {
        $seo = Seo::all();
        $seasons = Season::get();

        $productLimited = Product::where('on_sale', 0)->orderBy('id', 'desc')->limit(5)->get();
        $favouriteProducts = Product::where('on_sale', 0)->where('favourite', 1)->limit(10)->get();
        $categories = Product_sub_category::where('category_on_home', 1)->limit(10)->get();
        $blogs = Blog::orderBy('id', 'desc')->get()->take('4');
        $occasions = Occasion::orderBy('id', 'desc')->limit('7')->get();
        $productcategories = Product_category::orderBy('id','desc')->limit('10')->get();

        $productcategry_list = Product_category::withCount('products')->get();

        $products = Product::where('on_sale', 0)->where('most_popular', 1)->with('review')->orderBy('product_name', 'desc')->orderBy('created_at', 'desc')->get();

        $bestProducts = Product::where('on_sale', 0)->where('bestproduct', 1)->orderby('created_at', 'desc')->limit(10)->get();
        $limitFourproducts = Product::where('on_sale', 0)->orderby('created_at', 'desc')->limit(4)->get();

        $limitFourBlogs= Blog::orderBy('id', 'desc')->take('3')->get();

        $concerns = Concern::get();
        $couponSpecificProduct = Coupon::where('discount_type', 'specific_product')->where('active', 1)->get();

        $bestSellers = Product::where('on_sale', 0)->where('best_sellers', 1)->orderBy('product_name', 'desc')->orderBy('created_at', 'desc')->get();
        $reviews = Rating::with('user')->orderBy('created_at', 'desc')->limit(10)->get();
        $media_list = News::latest()->limit(3)->get();

        return view('website.index', compact('media_list','seo', 'productcategories','seasons', 'productLimited', 'categories', 'products', 'favouriteProducts', 'blogs', 'occasions','bestProducts','limitFourproducts','limitFourBlogs','couponSpecificProduct','bestSellers','reviews','concerns','productcategry_list'));
    }

    public function payment()
    {

        $seo = Seo::all();

        return view('website.payment', compact('seo'));
    }
    public function payment_continue()
    {

        $seo = Seo::all();

        return view('website.payment-continue', compact('seo'));
    }

    public function pincode()
    {

        $seo = Seo::all();

        return view('website.pincode', compact('seo'));
    }
    
    public function forwar()
    {

        $seo = Seo::all();

        return view('website.forwar', compact('seo'));
    }
    



    public function showSitemap()
     {
         $sitemaps = Sitemap::first(); 
        
         return response()->view('website.sitemap', compact('sitemaps'))
          ->header('Content-Type', 'application/xml');
 
     }
 
 
     public function showRobots()
     {
         $robots = Robots::first(); 
         return response($robots->content, 200)
             ->header('Content-Type', 'text/plain');
     }
 
 
     public function showRor()
     {
         $rors = Ror::first();
         $content = $rors->content;
 
         if ($this->isValidXml($content)) {
             return response($content, 200)
                 ->header('Content-Type', 'application/xml');
         } else {
             return response('Invalid XML content', 400);
         }
     }
 
     private function isValidXml($content)
     {
         libxml_use_internal_errors(true);
         simplexml_load_string($content);
         return libxml_get_errors() ? false : true;
     }
 
 
     public function showUrllist()
     {
     $urls = Urllist::first();
     return response($urls->url)
         ->header('Content-Type', 'text/plain'); 
     }


    public function dealofday()
    {
        $deal = [];
        $dealstart = deal::where('start_date', date("Y-m-d"))->get();
        if (count($dealstart) > 0) {

            foreach ($dealstart as $dealstarts) {

                $deal = ProductVariants::where('product_id', $dealstarts->product_id)->get();

                foreach ($deal as $deals) {
                    ProductVariants::where('product_id', $deals->product_id)->update(['discount' => $dealstarts->discount, 'status' => 1]);
                }
                $dealstart = ProductVariants::where('product_id', $dealstarts->product_id)->get();

                for ($i = 0; $i < count($dealstart); $i++) {

                    ProductVariants::where('id', $dealstart[$i]->id)->update(['selling_price' => $dealstart[$i]->price - ($dealstart[$i]->price * $dealstart[$i]->discount) / 100, 'status' => 1]);
                }
            }
        }


        $dealend = deal::where('end_date', date("Y-m-d"))->get();
        if (count($dealend) > 0) {
            foreach ($dealend as $dealends) {

                $dealen = ProductVariants::where('product_id', $dealends->product_id)->get();

                foreach ($dealen as $dealens) {
                    ProductVariants::where('product_id', $dealens->product_id)->update(['discount' => $dealends->previous_discount, 'status' => 0]);
                }
                $dealendsd = ProductVariants::where('product_id', $dealends->product_id)->get();

                for ($i = 0; $i < count($dealendsd); $i++) {

                    ProductVariants::where('id', $dealendsd[$i]->id)->update(['selling_price' => $dealendsd[$i]->price - ($dealendsd[$i]->price * $dealendsd[$i]->discount) / 100, 'status' => 0]);
                }
            }
        }


        return redirect()->back();
    }










    public function about_us()
    {
        $seo = Seo::all();
        //dd('tt');
        $limitFourproducts = Product::orderby('created_at', 'desc')->limit(4)->get();

        return view('website.about-us', compact('seo','limitFourproducts'));
    }


    public function book_appointment()
    {
        $seo = Seo::all();
        //dd('tt');
        return view('website.book-appointment', compact('seo'));
    }


    public function address()
    {
        // dd('hi');
        $seo = Seo::all();
        return view('website.address', compact('seo'));
    }





    public function     payement_success()
    {

        $seo = Seo::all();
        return view('website.payement-success', compact('seo'));
    }




    public function  offer_page()
    {

        $seo = Seo::all();
        return view('website.offer-page', compact('seo'));
    }




    public function payment_failed()
    {

        $seo = Seo::all();
        return view('website.payment-failed', compact('seo'));
    }

    public function otp_signup()
    {
        $seo = Seo::all();
        return view('website.otp-signup', compact('seo'));
    }





    public function smart_food()
    {
        $seo = Seo::all();
        return view('website.smart-food', compact('seo'));
    }





    // public function add_to_cart(Request $request)
    // {
    //     $seo = Seo::all();
    //     $coupan = Coupon::where("active", 1)->get();
    //     $carts = Cart::where("order_status", 0)->where("user_id", "=", Auth::user()->id)->get();
    //     $item_Price = 0;
    //     $item_sel_Price = 0;
    //     $con = 0;
    //     $subtotal = 0;
    //     $subtotal_price = 0;
    //     $total_saving = 0;

    //     for ($i = 0; $i < count($carts); $i++) {

    //         $con = $con + $carts[$i]->quantity;
    //         $item_Price = $carts[$i]->product_variants->price;
    //         $item_sel_Price = $carts[$i]->product_variants->selling_price;
    //         $subtotal = $subtotal + ($item_sel_Price * $carts[$i]->quantity);
    //         $subtotal_price = $subtotal_price + ($item_Price * $carts[$i]->quantity);
    //     }


    //     $shipping = 0.00;
    //     $taxes = 0.00;
    //     $shipping = 0.00;
    //     $discount_type = Session::get('discount_type');
    //     $discount_percentage = Session::get('discount_percentage');
    //     $discount_flat = Session::get('discount_flat');
    //     $coupon_title = Session::get('coupon_title');
    //     $discount_products = Session::get('products');
    //     $specific_product_discount = Session::get('specific_product_discount');




    //     if (!empty($carts) && count($carts) > 0) {
    //          if ($discount_percentage == 0.00 && $discount_flat == 0.00) 
    //          {
    //             $initial_discount = 0.00;
    //             $coupon_code = null;
    //            } 
    //             else {
              


    //                   if ($discount_type == 'discount_percentage' || $discount_percentage != 0.00) {
    //                     $initial_discount = $discount_percentage;
    //                 } elseif ($discount_type == 'discount_flat') {
    //                     $initial_discount = $discount_flat;
    //                 } elseif ($discount_type == 'specific_product') { // Use elseif instead of else

    //                     $initial_discount = $specific_product_discount;
    //                 }

    //                  $coupon_code = $coupon_title;
    //               }
    //         } 
        
            
    //         else {
    //         Session::put('discount_percentage', 0.00);
    //         Session::put('discount_flat', 0.00);
    //         Session::put('coupon_title', null);
    //         Session::put('specific_product_discount',null);
    //         Session::put('products',null);

    //         $initial_discount = 0.00;
    //         $coupon_code = null;
    //     }

    //     if ($discount_percentage != 0.00) {
    //         $discount_amount = ($subtotal * $initial_discount) / 100;
    //     } else {
    //         $discount_amount = $initial_discount;
    //     }

    //     $total = ($subtotal - $discount_amount) + $taxes + $shipping;

    //     $total_savings = ($subtotal_price - $subtotal) +  $discount_amount;

    //     $isEmpty = $carts->isEmpty();


    //     return view('website.add-to-cart', compact('seo', 'coupan', 'carts', 'subtotal', 'coupon_code', 'initial_discount', 'discount_amount', 'total', 'discount_percentage', 'discount_flat', 'total_savings','isEmpty'));
    // }



    public function add_to_cart(Request $request)
    {
        // Session::flush();
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


        //REFER AND EARN REDEEM POINTS START
        // $coupon = null;
        // $referrerDetails = null;
        // $rewardPointsAfterReferral = null;

        // if(Auth::check())
        // {
        //     $user_id = Auth::user()->id;

        //     $coupon = Coupon::where('user_id', $user_id)->first();
        //     $referrerDetails = Referral::where('referrer_id', $user_id)->get();

        //     $rewardPointsAfterReferral =  Referral::where('referred_id', $user_id)->get();

        // }
        //REFER AND EARN REDEEM POINTS END





        //TEST CALCULATIONS OF POINTS START
        if(Auth::check())
        {
            $checkTotalPoints = Referral::where('referrer_id', Auth::user()->id)->get();

            $totalPoints = 0;
            if(count($checkTotalPoints) > 0)
            {
                for($i=0;$i<count($checkTotalPoints);$i++)
                {
                    $totalPoints += floatval($checkTotalPoints[$i]->reward_value);
                }
            }


            $checkRedeemedPoints = Referral::where('referrer_id', Auth::user()->id)->get();

            $redeemedPoints = 0;
            if(count($checkRedeemedPoints) > 0)
            {
                for($i=0;$i<count($checkRedeemedPoints);$i++)
                {
                    $redeemedPoints += floatval($checkRedeemedPoints[$i]->redemed_value);
                }
            }

            $balancePoints = $totalPoints - $redeemedPoints;

        }
        //TEST CALCULATIONS OF POINTS END



   // dd($initial_discount);
        return view('website.add-to-cart', compact('seo', 'coupan', 'carts', 'subtotal', 'coupon_code', 'initial_discount', 'discount_amount', 'total','specific_product_discount', 'discount_percentage', 'discount_flat', 'total_savings', 'isEmpty','discount_products','balancePoints'));
    }











    public function change_quantity(Request $request)
{
    $cart_id = $request->id;
    $type = $request->type;

    $cart_value = "App\Cart"::where('id', $cart_id)->first();
    if ($cart_value) {
        if ($type == 'up') {

            $cart_value->quantity += 1;
        } else {

            if ($cart_value->quantity > 1) {
                $cart_value->quantity -= 1;
            }
        }
        $cart_value->save();
    }

    return response()->json(['success' => true, 'quantity' => $cart_value->quantity]);
}


    public function removeProductToCart($id)
    {
        $carts = "App\Cart"::where('id', $id)->delete();
        return redirect()->back();
    }

    public function updateProductQtyToCart($id, $qty)
    {
        if ($qty == 0) {
            $carts = "App\Cart"::where('id', $id)->delete();
        } else {
            $carts = "App\Cart"::where('id', $id)->update(['quantity' => $qty]);
        }
        return redirect()->back();
    }

    



    public function what_fuels_you()
    {

        $seo = Seo::all();
        $product = Product::orderBy('id', 'desc')->where('outofstock', 0)->where('active', 1)->get();
        $Tranding_product = Product::orderBy('id', 'desc')->where('outofstock', 0)->where('tranding', 1)->where('active', 1)->get();
        return view('website.what-fuels-you', compact('seo', 'product', 'Tranding_product'));
    }



    // public function payment_method()
    // {

    //     $seo = Seo::all();
    //     if (Auth::check()) {
    //         $carts = "App\Cart"::where('user_id', Auth::user()->id)->where("order_status", 0)->orwhere('ssid', Session::getId())->get();

    //         $userinfo = "App\BillingAddress"::latest()->where('user_id', Auth::user()->id)->first();

    //         if (!$userinfo) {
    //             $userinfo = User::where('id', Auth::user()->id)->first();
    //         }
    //     } else {
    //         return redirect('/add-to-cart');
    //     }

    //     return view('website.payment-method', compact('seo', 'userinfo', 'carts'));
    // }

    public function product_listing()
    {


        //DECODE START
        if (!empty($_GET['search'])) {
            $_GET['search'] = base64_decode($_GET['search']);
        }

        if (!empty($_GET['category'])) {
            $_GET['category'] = base64_decode($_GET['category']);
        }

        if (!empty($_GET['weight'])) {
            $_GET['weight'] = base64_decode($_GET['weight']);
        }


        if (!empty($_GET['type'])) {
            $_GET['type'] = base64_decode($_GET['type']);
        }

        if (!empty($_GET['gender'])) {
            $_GET['gender'] = base64_decode($_GET['gender']);
        }

        if (!empty($_GET['occasions'])) {
            $_GET['occasions'] = base64_decode($_GET['occasions']);
        }

        if (!empty($_GET['style'])) {
            $_GET['style'] = base64_decode($_GET['style']);
        }


        if (!empty($_GET['purity'])) {
            $_GET['purity'] = base64_decode($_GET['purity']);
        }

        if (!empty($_GET['metal_color'])) {
            $_GET['metal_color'] = base64_decode($_GET['metal_color']);
        }

        if (!empty($_GET['design'])) {
            $_GET['design'] = base64_decode($_GET['design']);
        }




        if (!empty($_GET['sale'])) {
            $_GET['sale'] = base64_decode($_GET['sale']);
        }

        if (!empty($_GET['mindiscount'])) {
            $_GET['mindiscount'] = base64_decode($_GET['mindiscount']);
        }

        if (!empty($_GET['maxdiscount'])) {
            $_GET['maxdiscount'] = base64_decode($_GET['maxdiscount']);
        }

        if (!empty($_GET['discountid'])) {
            $_GET['discountid'] = base64_decode($_GET['discountid']);
        }


        if (!empty($_GET['minprice'])) {
            $_GET['minprice'] = base64_decode($_GET['minprice']);
        }

        if (!empty($_GET['maxprice'])) {
            $_GET['maxprice'] = base64_decode($_GET['maxprice']);
        }



        //DECODE END

        $seo = Seo::all();

        $slider = Slider::all();
        $Product_category = Product_category::all();
        // $Product_category_list = Product_category::inRandomOrder()->limit(5)->get();
        $Product_category_list = Product_category::orderby('created_at', 'asc')->get();
        $best_seller = product::where('best_sellers', 1)->where('outofstock', 0)->orderBy('id', 'desc')->take(5)->get();
        $product_design = Designer::all();
        $product_style = Style::all();
        $concerns = Concern::get();
        $Product_occasion = Occasion::all();
        $product_metal_color = Metalcolor::all();
        $maxproductCost = ProductVariants::max('selling_price');
        $minproductCost = ProductVariants::min('selling_price');
        $product_variantss = ProductVariants::distinct('weight')->get(['weight']);
        $maxproductCost = $maxproductCost + 50;
        $allproductCount = product::count();
        
        $q = product::query();

        if (!empty($_GET['category'])) {
            $category = $_GET['category'];
            $categories = explode(',', $category);
        } else {
            $categories = [];
        }

        if (!empty($_GET['weight'])) {
            $weight = $_GET['weight'];
            $weights = explode(',', $weight);
        } else {
            $weights = [];
        }

     

        if (!empty($_GET['design'])) {
            $design = $_GET['design'];
            $designs = explode(',', $design);
        } else {
            $designs = [];
        }





        if (!empty($_GET['metal_color'])) {
            $metal_color = $_GET['metal_color'];
            $metal_colors = explode(',', $metal_color);
        } else {
            $metal_colors = [];
        }

        if (!empty($_GET['gender'])) {
            $gender = $_GET['gender'];
            $genders = explode(',', $gender);
        } else {
            $genders = [];
        }

        if (!empty($_GET['occasions'])) {
            $occasion = $_GET['occasions'];
            $occasions = explode(',', $occasion);
        } else {
            $occasions = [];
        }
        if (!empty($_GET['sale'])) {
            $sale = $_GET['sale'];
        } else {
            $sale = 0;
        }


        if (!empty($_GET['mindiscount'])) {
            $mindiscount = $_GET['mindiscount'];
        } else {
            $mindiscount = 0;
        }

        if (!empty($_GET['maxdiscount'])) {
            $maxdiscount = $_GET['maxdiscount'];
        } else {
            $maxdiscount = 0;
        }

        
        if (!empty($_GET['discountid'])) {
            $discountid = $_GET['discountid'];
        } else {
            $discountid = 0;
        }


        if (!empty($_GET['minprice'])) {
            $minprice = $_GET['minprice'];
        } else {
            $minprice = 0;
        }

        if (!empty($_GET['maxprice'])) {
            $maxprice = $_GET['maxprice'];
        } else {
            $maxprice = 0;
        }




        if (!empty($_GET['search'])) {
            $search = $_GET['search'];
            $search = $_GET['search'];
        } else {
            $search = null;
        }

        if (!empty($_GET['sortby'])) {
            $sortby = $_GET['sortby'];
            $sortby = $_GET['sortby'];
        } else {
            $sortby = null;
        }


        if ($categories || $sale || $occasions || $mindiscount || $maxdiscount || $minprice || $maxprice || $search || $sortby || $metal_colors || $designs || $genders || $weights) {


            if ($categories) {

                $q->whereHas('category', function ($q) use ($categories) {
                    $q->whereIn('id', $categories);
                });
            }


            if ($weights) {

                $q->whereHas('variants_size', function ($q) use ($weights) {
                    $q->whereIn('weight', $weights);
                });
            }
           


            if ($occasions) {
                $q->whereHas('occasion', function ($q) use ($occasions) {
                    $q->whereIn('id', $occasions);
                });
            }

           


            if ($designs) {
                $q->whereHas('design', function ($q) use ($designs) {
                    $q->whereIn('id', $designs);
                });
            }




            if ($metal_colors) {

                $q->whereHas('metal_color', function ($q) use ($metal_colors) {
                    $q->whereIn('id', $metal_colors);
                });
            }




            if ($sale) {

                $q->where('on_sale', $sale);
            }


            if ($genders) {

                $q->wherein('gender', $genders);
            }

            if ($mindiscount && $maxdiscount) {

                $q->whereHas('variants_price_desc', function ($q) use ($mindiscount, $maxdiscount) {
                    $q->where('discount', '>=', $mindiscount)->where('discount', '<=', $maxdiscount);
                });
            }


            if ($minprice && $maxprice) {

                $q->whereHas('variants_price_desc', function ($q) use ($minprice, $maxprice) {
                    $q->where('selling_price', '>=', $minprice)->where('selling_price', '<=', $maxprice);
                });
            }


            if ($search) {

                $q->where('product_name', 'like', '%' . $search . '%');


                $q->orWhereHas('occasion', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            }

            
            if ($sortby) {
                if ($sortby == 'low_to_high') {
                    $products = $q->where('on_sale', 0)->with('variants_price_desc')->get()->sortBy('variants_price_desc.selling_price');
                } elseif ($sortby == 'high_to_low') {
                    $products = $q->where('on_sale', 0)->with('variants_price_desc')->get()->sortByDesc('variants_price_desc.selling_price');
                } elseif ($sortby == 'newest') {
                    $products = $q->where('on_sale', 0)->orderBy('id', 'desc')->get();
                } elseif ($sortby == 'relevance') {
                    $products = $q->where('on_sale', 0)->orderBy('id', 'asc')->get();
                }
            } else {
                $products = $q->where('on_sale', 0)->orderby('created_at', 'desc')->get();
            }

        } else {

            $products = $q->where('on_sale', 0)->orderby('created_at', 'desc')->get();
        }

        $avgAllReviews = Rating::where('status', 1)->avg('rating');
        $countAllReviews = Rating::where('status', 1)->count();
        $totalProducts = product::where('on_sale', 0)->count();

        $couponSpecificProduct = Coupon::where('discount_type', 'specific_product')->where('active', 1)->get();



    //    dd($products);

        return view('website.shop', compact('concerns','seo', 'slider', 'Product_occasion', 'best_seller', 'product_design', 'products', 'Product_category', 'allproductCount', 'maxproductCost', 'minproductCost', 'product_metal_color',  'Product_category_list','product_variantss','avgAllReviews','countAllReviews','totalProducts', 'couponSpecificProduct'));
    }



    

    public function productListingSlugWise($category)
    {

        $categorySlugWise = Product_category::where('slug', $category)->first();

        $shop_page_title = null;
        $shop_page_desc = null;

        $shop_page_title = $categorySlugWise->shop_page_title;
        $shop_page_desc = $categorySlugWise->shop_page_desc;


        //DECODE START
        if (!empty($_GET['search'])) {
            $_GET['search'] = base64_decode($_GET['search']);
        }

        if (!empty($_GET['category'])) {
            $_GET['category'] = base64_decode($_GET['category']);
        }

        if (!empty($_GET['weight'])) {
            $_GET['weight'] = base64_decode($_GET['weight']);
        }


        if (!empty($_GET['type'])) {
            $_GET['type'] = base64_decode($_GET['type']);
        }

        if (!empty($_GET['gender'])) {
            $_GET['gender'] = base64_decode($_GET['gender']);
        }

        if (!empty($_GET['occasions'])) {
            $_GET['occasions'] = base64_decode($_GET['occasions']);
        }

        if (!empty($_GET['style'])) {
            $_GET['style'] = base64_decode($_GET['style']);
        }


        if (!empty($_GET['purity'])) {
            $_GET['purity'] = base64_decode($_GET['purity']);
        }

        if (!empty($_GET['metal_color'])) {
            $_GET['metal_color'] = base64_decode($_GET['metal_color']);
        }

        if (!empty($_GET['design'])) {
            $_GET['design'] = base64_decode($_GET['design']);
        }




        if (!empty($_GET['sale'])) {
            $_GET['sale'] = base64_decode($_GET['sale']);
        }

        if (!empty($_GET['mindiscount'])) {
            $_GET['mindiscount'] = base64_decode($_GET['mindiscount']);
        }

        if (!empty($_GET['maxdiscount'])) {
            $_GET['maxdiscount'] = base64_decode($_GET['maxdiscount']);
        }

        if (!empty($_GET['discountid'])) {
            $_GET['discountid'] = base64_decode($_GET['discountid']);
        }


        if (!empty($_GET['minprice'])) {
            $_GET['minprice'] = base64_decode($_GET['minprice']);
        }

        if (!empty($_GET['maxprice'])) {
            $_GET['maxprice'] = base64_decode($_GET['maxprice']);
        }



        //DECODE END

        $seo = Seo::all();

        $slider = Slider::all();
        $Product_category = Product_category::all();
        // $Product_category_list = Product_category::inRandomOrder()->limit(5)->get();
        $Product_category_list = Product_category::orderby('created_at', 'asc')->get();
        $best_seller = product::where('best_sellers', 1)->where('outofstock', 0)->orderBy('id', 'desc')->take(5)->get();
        $product_design = Designer::all();
        $product_style = Style::all();
        $Product_occasion = Occasion::all();
        $concerns = Concern::get();
        $product_metal_color = Metalcolor::all();
        $maxproductCost = ProductVariants::max('selling_price');
        $minproductCost = ProductVariants::min('selling_price');
        $product_variantss = ProductVariants::distinct('weight')->get(['weight']);
        $maxproductCost = $maxproductCost + 50;
        $allproductCount = product::count();
        $q = product::query();

        if (!empty($_GET['category'])) {
            $category = $_GET['category'];
            $categories = explode(',', $category);
        } else {
            $categories = [];
        }

        if (!empty($_GET['weight'])) {
            $weight = $_GET['weight'];
            $weights = explode(',', $weight);
        } else {
            $weights = [];
        }

     

        if (!empty($_GET['design'])) {
            $design = $_GET['design'];
            $designs = explode(',', $design);
        } else {
            $designs = [];
        }





        if (!empty($_GET['metal_color'])) {
            $metal_color = $_GET['metal_color'];
            $metal_colors = explode(',', $metal_color);
        } else {
            $metal_colors = [];
        }

        if (!empty($_GET['gender'])) {
            $gender = $_GET['gender'];
            $genders = explode(',', $gender);
        } else {
            $genders = [];
        }

        if (!empty($_GET['occasions'])) {
            $occasion = $_GET['occasions'];
            $occasions = explode(',', $occasion);
        } else {
            $occasions = [];
        }
        if (!empty($_GET['sale'])) {
            $sale = $_GET['sale'];
        } else {
            $sale = 0;
        }


        if (!empty($_GET['mindiscount'])) {
            $mindiscount = $_GET['mindiscount'];
        } else {
            $mindiscount = 0;
        }

        if (!empty($_GET['maxdiscount'])) {
            $maxdiscount = $_GET['maxdiscount'];
        } else {
            $maxdiscount = 0;
        }

        
        if (!empty($_GET['discountid'])) {
            $discountid = $_GET['discountid'];
        } else {
            $discountid = 0;
        }


        if (!empty($_GET['minprice'])) {
            $minprice = $_GET['minprice'];
        } else {
            $minprice = 0;
        }

        if (!empty($_GET['maxprice'])) {
            $maxprice = $_GET['maxprice'];
        } else {
            $maxprice = 0;
        }




        if (!empty($_GET['search'])) {
            $search = $_GET['search'];
            $search = $_GET['search'];
        } else {
            $search = null;
        }

        if (!empty($_GET['sortby'])) {
            $sortby = $_GET['sortby'];
            $sortby = $_GET['sortby'];
        } else {
            $sortby = null;
        }


        if ($categories || $sale || $occasions || $mindiscount || $maxdiscount || $minprice || $maxprice || $search || $sortby || $metal_colors || $designs || $genders || $weights) {


            if ($categories) {

                $q->whereHas('category', function ($q) use ($categories) {
                    $q->whereIn('id', $categories);
                });
            }


            if ($weights) {

                $q->whereHas('variants_size', function ($q) use ($weights) {
                    $q->whereIn('weight', $weights);
                });
            }
           


            if ($occasions) {
                $q->whereHas('occasion', function ($q) use ($occasions) {
                    $q->whereIn('id', $occasions);
                });
            }

           


            if ($designs) {
                $q->whereHas('design', function ($q) use ($designs) {
                    $q->whereIn('id', $designs);
                });
            }




            if ($metal_colors) {

                $q->whereHas('metal_color', function ($q) use ($metal_colors) {
                    $q->whereIn('id', $metal_colors);
                });
            }




            if ($sale) {

                $q->where('on_sale', $sale);
            }


            if ($genders) {

                $q->wherein('gender', $genders);
            }

            if ($mindiscount && $maxdiscount) {

                $q->whereHas('variants_price_desc', function ($q) use ($mindiscount, $maxdiscount) {
                    $q->where('discount', '>=', $mindiscount)->where('discount', '<=', $maxdiscount);
                });
            }


            if ($minprice && $maxprice) {

                $q->whereHas('variants_price_desc', function ($q) use ($minprice, $maxprice) {
                    $q->where('selling_price', '>=', $minprice)->where('selling_price', '<=', $maxprice);
                });
            }


            if ($search) {

                $q->where('product_name', 'like', '%' . $search . '%');


                $q->orWhereHas('occasion', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            }

            
            if ($sortby) {
                if ($sortby == 'low_to_high') {
                    $products = $q->where('product_category', $categorySlugWise->id)->where('on_sale', 0)->with('variants_price_desc')->get()->sortBy('variants_price_desc.selling_price');
                } elseif ($sortby == 'high_to_low') {
                    $products = $q->where('product_category', $categorySlugWise->id)->where('on_sale', 0)->with('variants_price_desc')->get()->sortByDesc('variants_price_desc.selling_price');
                } elseif ($sortby == 'newest') {
                    $products = $q->where('product_category', $categorySlugWise->id)->where('on_sale', 0)->orderBy('id', 'desc')->get();
                } elseif ($sortby == 'relevance') {
                    $products = $q->where('product_category', $categorySlugWise->id)->where('on_sale', 0)->orderBy('id', 'asc')->get();
                }
            } else {
                $products = $q->where('product_category', $categorySlugWise->id)->where('on_sale', 0)->orderby('created_at', 'desc')->get();
            }

        } else {

            $products = $q->where('product_category', $categorySlugWise->id)->where('on_sale', 0)->orderby('created_at', 'desc')->get();
        }

        $avgAllReviews = Rating::where('status', 1)->avg('rating');
        $countAllReviews = Rating::where('status', 1)->count();
        $totalProducts = product::where('on_sale', 0)->count();

        $couponSpecificProduct = Coupon::where('discount_type', 'specific_product')->where('active', 1)->get();
        
    //    dd($products);

        // $concerns = Concern::get();
        return view('website.shop', compact('concerns','seo', 'slider', 'Product_occasion', 'best_seller', 'product_design', 'products', 'Product_category', 'allproductCount', 'maxproductCost', 'minproductCost', 'product_metal_color',  'Product_category_list','product_variantss','avgAllReviews','countAllReviews','totalProducts', 'couponSpecificProduct','shop_page_title','shop_page_desc'));
    }



    public function productListingByConcern($concern_slug)
    {

    
        // dd($products);

        //DECODE START
        if (!empty($_GET['search'])) {
            $_GET['search'] = base64_decode($_GET['search']);
        }

        if (!empty($_GET['category'])) {
            $_GET['category'] = base64_decode($_GET['category']);
        }

        if (!empty($_GET['weight'])) {
            $_GET['weight'] = base64_decode($_GET['weight']);
        }


        if (!empty($_GET['type'])) {
            $_GET['type'] = base64_decode($_GET['type']);
        }

        if (!empty($_GET['gender'])) {
            $_GET['gender'] = base64_decode($_GET['gender']);
        }

        if (!empty($_GET['occasions'])) {
            $_GET['occasions'] = base64_decode($_GET['occasions']);
        }

        if (!empty($_GET['style'])) {
            $_GET['style'] = base64_decode($_GET['style']);
        }


        if (!empty($_GET['purity'])) {
            $_GET['purity'] = base64_decode($_GET['purity']);
        }

        if (!empty($_GET['metal_color'])) {
            $_GET['metal_color'] = base64_decode($_GET['metal_color']);
        }

        if (!empty($_GET['design'])) {
            $_GET['design'] = base64_decode($_GET['design']);
        }




        if (!empty($_GET['sale'])) {
            $_GET['sale'] = base64_decode($_GET['sale']);
        }

        if (!empty($_GET['mindiscount'])) {
            $_GET['mindiscount'] = base64_decode($_GET['mindiscount']);
        }

        if (!empty($_GET['maxdiscount'])) {
            $_GET['maxdiscount'] = base64_decode($_GET['maxdiscount']);
        }

        if (!empty($_GET['discountid'])) {
            $_GET['discountid'] = base64_decode($_GET['discountid']);
        }


        if (!empty($_GET['minprice'])) {
            $_GET['minprice'] = base64_decode($_GET['minprice']);
        }

        if (!empty($_GET['maxprice'])) {
            $_GET['maxprice'] = base64_decode($_GET['maxprice']);
        }



        //DECODE END

        $seo = Seo::all();

        $slider = Slider::all();
        $Product_category = Product_category::all();
        // $Product_category_list = Product_category::inRandomOrder()->limit(5)->get();
        $Product_category_list = Product_category::orderby('created_at', 'asc')->get();
        $best_seller = product::where('best_sellers', 1)->where('outofstock', 0)->orderBy('id', 'desc')->take(5)->get();
        $product_design = Designer::all();
        $product_style = Style::all();
        $Product_occasion = Occasion::all();
        $concerns = Concern::get();
        $product_metal_color = Metalcolor::all();
        $maxproductCost = ProductVariants::max('selling_price');
        $minproductCost = ProductVariants::min('selling_price');
        $product_variantss = ProductVariants::distinct('weight')->get(['weight']);
        $maxproductCost = $maxproductCost + 50;
        $allproductCount = product::count();
        $q = product::query();

        $concern = Concern::where('slug', $concern_slug)->first();

        $shop_page_title_concern = null;
        $shop_page_desc_concern = null;

        $shop_page_title_concern = $concern->shop_page_title;
        $shop_page_desc_concern = $concern->shop_page_desc;


        $id = (string) $concern->id; 
        // $query = Product::whereJsonContains('concern', $id);
        // $q = $query->get();

        if (!empty($_GET['category'])) {
            $category = $_GET['category'];
            $categories = explode(',', $category);
        } else {
            $categories = [];
        }

        if (!empty($_GET['weight'])) {
            $weight = $_GET['weight'];
            $weights = explode(',', $weight);
        } else {
            $weights = [];
        }

     

        if (!empty($_GET['design'])) {
            $design = $_GET['design'];
            $designs = explode(',', $design);
        } else {
            $designs = [];
        }


        if (!empty($_GET['metal_color'])) {
            $metal_color = $_GET['metal_color'];
            $metal_colors = explode(',', $metal_color);
        } else {
            $metal_colors = [];
        }

        if (!empty($_GET['gender'])) {
            $gender = $_GET['gender'];
            $genders = explode(',', $gender);
        } else {
            $genders = [];
        }

        if (!empty($_GET['occasions'])) {
            $occasion = $_GET['occasions'];
            $occasions = explode(',', $occasion);
        } else {
            $occasions = [];
        }
        if (!empty($_GET['sale'])) {
            $sale = $_GET['sale'];
        } else {
            $sale = 0;
        }


        if (!empty($_GET['mindiscount'])) {
            $mindiscount = $_GET['mindiscount'];
        } else {
            $mindiscount = 0;
        }

        if (!empty($_GET['maxdiscount'])) {
            $maxdiscount = $_GET['maxdiscount'];
        } else {
            $maxdiscount = 0;
        }

        
        if (!empty($_GET['discountid'])) {
            $discountid = $_GET['discountid'];
        } else {
            $discountid = 0;
        }


        if (!empty($_GET['minprice'])) {
            $minprice = $_GET['minprice'];
        } else {
            $minprice = 0;
        }

        if (!empty($_GET['maxprice'])) {
            $maxprice = $_GET['maxprice'];
        } else {
            $maxprice = 0;
        }




        if (!empty($_GET['search'])) {
            $search = $_GET['search'];
            $search = $_GET['search'];
        } else {
            $search = null;
        }

        if (!empty($_GET['sortby'])) {
            $sortby = $_GET['sortby'];
            $sortby = $_GET['sortby'];
        } else {
            $sortby = null;
        }


        if ($categories || $sale || $occasions || $mindiscount || $maxdiscount || $minprice || $maxprice || $search || $sortby || $metal_colors || $designs || $genders || $weights) {


            if ($categories) {

                $q->whereHas('category', function ($q) use ($categories) {
                    $q->whereIn('id', $categories);
                });
            }


            if ($weights) {

                $q->whereHas('variants_size', function ($q) use ($weights) {
                    $q->whereIn('weight', $weights);
                });
            }
           


            if ($occasions) {
                $q->whereHas('occasion', function ($q) use ($occasions) {
                    $q->whereIn('id', $occasions);
                });
            }

           


            if ($designs) {
                $q->whereHas('design', function ($q) use ($designs) {
                    $q->whereIn('id', $designs);
                });
            }




            if ($metal_colors) {

                $q->whereHas('metal_color', function ($q) use ($metal_colors) {
                    $q->whereIn('id', $metal_colors);
                });
            }




            if ($sale) {

                $q->where('on_sale', $sale);
            }


            if ($genders) {

                $q->wherein('gender', $genders);
            }

            if ($mindiscount && $maxdiscount) {

                $q->whereHas('variants_price_desc', function ($q) use ($mindiscount, $maxdiscount) {
                    $q->where('discount', '>=', $mindiscount)->where('discount', '<=', $maxdiscount);
                });
            }


            if ($minprice && $maxprice) {

                $q->whereHas('variants_price_desc', function ($q) use ($minprice, $maxprice) {
                    $q->where('selling_price', '>=', $minprice)->where('selling_price', '<=', $maxprice);
                });
            }


            if ($search) {

                $q->where('product_name', 'like', '%' . $search . '%');


                $q->orWhereHas('occasion', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            }

    // $query = Product::whereJsonContains('concern', $id);
    
            if ($sortby) {
                if ($sortby == 'low_to_high') {
                    $products = $q->whereJsonContains('concern', $id)->where('on_sale', 0)->with('variants_price_desc')->get()->sortBy('variants_price_desc.selling_price');
                } elseif ($sortby == 'high_to_low') {
                    $products = $q->whereJsonContains('concern', $id)->where('on_sale', 0)->with('variants_price_desc')->get()->sortByDesc('variants_price_desc.selling_price');
                } elseif ($sortby == 'newest') {
                    $products = $q->whereJsonContains('concern', $id)->where('on_sale', 0)->orderBy('id', 'desc')->get();
                } elseif ($sortby == 'relevance') {
                    $products = $q->whereJsonContains('concern', $id)->where('on_sale', 0)->orderBy('id', 'asc')->get();
                }
            } else {
                $products = $q->whereJsonContains('concern', $id)->where('on_sale', 0)->orderby('created_at', 'desc')->get();
            }

        } else {

            $products = $q->whereJsonContains('concern', $id)->where('on_sale', 0)->orderby('created_at', 'desc')->get();
        }

        $avgAllReviews = Rating::where('status', 1)->avg('rating');
        $countAllReviews = Rating::where('status', 1)->count();
        $totalProducts = product::where('on_sale', 0)->count();

        $couponSpecificProduct = Coupon::where('discount_type', 'specific_product')->where('active', 1)->get();
        

        return view('website.shop', compact('concerns','seo', 'slider', 'Product_occasion', 'best_seller', 'product_design', 'products', 'Product_category', 'allproductCount', 'maxproductCost', 'minproductCost', 'product_metal_color',  'Product_category_list','product_variantss','avgAllReviews','countAllReviews','totalProducts', 'couponSpecificProduct','shop_page_title_concern','shop_page_desc_concern'));
    
    }



    public function signIn()
    {

        $seo = Seo::all();



        return view('website.login', compact('seo'));
    }





    public function signup()
    {

        $seo = Seo::all();



        return view('website.signup', compact('seo'));
    }





    // public function product_grid(Request $request)
    // {

    //     $seo = Seo::all();
    //     $minProductPrice = Product::min('price');
    //     $maxProductPrice = Product::max('price');
    //     $maxProductPrice = $maxProductPrice + 50;
    //     $allProductSizes = Size::where('category_id', 2)->get();
    //     $occasion = Occasion::get();
    //     $occasioncategories = Occasioncategory::get();
    //     $colors = Color::get();
    //     $q = Product::query();
    //     $collection = '';

    //     if (!empty($_GET['search'])) {
    //         $search = $_GET['search'];
    //         $search = $_GET['search'];
    //     } else {
    //         $search = null;
    //     }
    //     if (!empty($_GET['collection'])) {
    //         $collection = $_GET['collection'];
    //         $collection = $_GET['collection'];
    //     } else {
    //         $collection = null;
    //     }
    //     if (!empty($_GET['occasion'])) {
    //         $occasion = $_GET['occasion'];
    //         $occasion = $_GET['occasion'];
    //     } else {
    //         $occasion = null;
    //     }
    //     if (!empty($_GET['occasioncat'])) {
    //         $occasioncat = $_GET['occasioncat'];
    //         $occasioncat = $_GET['occasioncat'];
    //     } else {
    //         $occasioncat = null;
    //     }
    //     if (!empty($_GET['color'])) {
    //         $color = $_GET['color'];
    //         $color = $_GET['color'];
    //     } else {
    //         $color = null;
    //     }
    //     if (!empty($_GET['size'])) {
    //         $size = $_GET['size'];
    //         $size = $_GET['size'];
    //     } else {
    //         $size = null;
    //     }
    //     if (!empty($_GET['season'])) {
    //         $season = $_GET['season'];
    //         $season = $_GET['season'];
    //     } else {
    //         $season = null;
    //     }
    //     if (!empty($_GET['discount'])) {
    //         $discount = $_GET['discount'];
    //         $discount = $_GET['discount'];
    //     } else {
    //         $discount = null;
    //     }
    //     if (!empty($_GET['rating'])) {
    //         $rating = $_GET['rating'];
    //         $rating = $_GET['rating'];
    //     } else {
    //         $rating = null;
    //     }
    //     if (!empty($_GET['sortby'])) {
    //         $sortby = $_GET['sortby'];
    //         $sortby = $_GET['sortby'];
    //     } else {
    //         $sortby = null;
    //     }
    //     if (!empty($_GET['minprice'])) {
    //         $minprice = $_GET['minprice'];
    //         $minprice = $_GET['minprice'];
    //     } else {
    //         $minprice = null;
    //     }
    //     if (!empty($_GET['maxprice'])) {
    //         $maxprice = $_GET['maxprice'];
    //         $maxprice = $_GET['maxprice'];
    //     } else {
    //         $maxprice = null;
    //     }

    //     if ($search || $collection || $size || $season || $discount || $rating || $sortby || $maxprice  || $occasion || $occasioncat || $color || $types) {

    //         if ($rating) {
    //             $nextRating = $rating + 1;
    //             $q->where('avg_rating', '>=', $rating)->where('avg_rating', '<', $nextRating);
    //         }

    //         if ($discount) {
    //             $q->whereHas('discount', function ($q) use ($discount) {
    //                 $q->where('discount', '>=', $discount);
    //             });
    //         }

    //         if ($season) {
    //             $q->where('season_id', $season);
    //         }

    //         if ($collection) {
    //             $q->whereHas('typeofproduct', function ($q) use ($collection) {
    //                 $q->where('type_of_product', $collection);
    //             });
    //         }


    //         if ($occasion) {
    //             $q->where('occasion_id', $occasion);
    //         }


    //         if ($occasioncat) {
    //             $q->where('occasion_category_id', $occasioncat);
    //         }

    //         if ($color) {
    //             $q->whereHas('product_colors', function ($q) use ($color) {
    //                 $q->where('color_id', $color);
    //             });
    //         }


    //         if ($size) {
    //             $q->whereHas('availSize', function ($q) use ($size) {
    //                 $q->where('sizes', $size);
    //             });
    //         }

    //         if ($minprice && $maxprice) {
    //             $q->where('price', '>=', $minprice)->where('price', '<=', $maxprice);
    //         }

    //         if ($search) {
    //             $q->where('product_name', 'like', '%' . $search . '%');
    //         }

    //         if ($sortby) {
    //             if ($sortby == 'low_to_high') {
    //                 $q->orderBy('price', 'asc');
    //             } elseif ($sortby == 'high_to_low') {
    //                 $q->orderBy('price', 'desc');
    //             } elseif ($sortby == 'latest') {
    //                 $q->orderBy('id', 'desc');
    //             }
    //         }

    //         $products = $q->where('outofstock', 0)->get();
    //     } else {
    //         $products = $q->where('outofstock', 0)->orderBy('id', 'desc')->get();
    //     }

    //     $subcategories = Subcategory::get();

    //     return view('website.product-grid', compact('seo', 'products', 'subcategories', 'minProductPrice', 'maxProductPrice', 'allProductSizes', 'occasions', 'occasioncategories', 'colors', 'collection'));
    // }

    public function product_listing_test(Request $request, $param1)
    {
// //dd($param1);
//         $product_categorys = Product_category::where('slug', '=', $param1)->first();
       
//         abort_if(!$product_categorys, 404);
//         //DECODE START
//        // dd($product_categorys);
//         if (!empty($_GET['search'])) {
//             $_GET['search'] = base64_decode($_GET['search']);
//         }
//         if (!empty($_GET['subcategory'])) {
//             $_GET['subcategory'] = base64_decode($_GET['subcategory']);
//         }
      
//         if (!empty($_GET['gender'])) {
//             $_GET['gender'] = base64_decode($_GET['gender']);
//         }

//         if (!empty($_GET['size'])) {
//             $_GET['size'] = base64_decode($_GET['size']);
//         }
//         if (!empty($_GET['occasions'])) {
//             $_GET['occasions'] = base64_decode($_GET['occasions']);
//         }
    
//         if (!empty($_GET['sale'])) {
//             $_GET['sale'] = base64_decode($_GET['sale']);
//         }
//         if (!empty($_GET['minprice'])) {
//             $_GET['minprice'];
//         }
//         if (!empty($_GET['maxprice'])) {
//             $_GET['maxprice'];
//         }
//         $seo = Seo::all();
//         $slider = Slider::all();
//         $Product_subcategory = Product_sub_category::where('main_cat_id', $product_categorys->id)->get();
//         $size = DB::table('product_variants')->where('category', $product_categorys->id)->where('weight', '<>', 'N/A')->select('weight')->groupBy('weight')->get();   
//         $best_seller = product::where('best_sellers', 1)->where('active', 1)->orderBy('id', 'desc')->take(5)->get();
//         $Product_occasion = Occasion::all();
//         $maxproductCost = ProductVariants::where('category', $product_categorys->id)->max('selling_price');
//         $minproductCost = ProductVariants::where('category', $product_categorys->id)->min('selling_price');
//         $maxproductCost = $maxproductCost + 50;
//         $allproductCount = product::where('product_category', $product_categorys->id)->count();
//        // dd($allproductCount);
//         $q = product::query();
//         $q->where('product_category', $product_categorys->id);

//         if (!empty($_GET['subcategory'])) {
//             $subcategory = $_GET['subcategory'];
//             $subcategorys = explode(',', $subcategory);
//         } else {
//             $subcategorys = [];
//         }
     
//         if (!empty($_GET['metal_color'])) {
//             $metal_color = $_GET['metal_color'];
//             $metal_colors = explode(',', $metal_color);
//         } else {
//             $metal_colors = [];
//         }
        
//         if (!empty($_GET['gender'])) {
//             $gender = $_GET['gender'];
//             $genders = explode(',', $gender);
//         } else {
//             $genders = [];
//         }


//         if (!empty($_GET['size'])) {
//             $sizer = $_GET['size'];
//             $sizes = explode(',', $sizer);
//         } else {
//             $sizes = [];
//         }

//         if (!empty($_GET['occasions'])) {
//             $occasion = $_GET['occasions'];
//             $occasions = explode(',', $occasion);
//         } else {
//             $occasions = [];
//         }
//         if (!empty($_GET['sale'])) {
//             $sale = $_GET['sale'];
//         } else {
//             $sale = 0;
//         }
//         if (!empty($_GET['minprice'])) {
//             $minprice = $_GET['minprice'];
//         } else {
//             $minprice = 0;
//         }
//         if (!empty($_GET['maxprice'])) {
//             $maxprice = $_GET['maxprice'];
//         } else {
//             $maxprice = 0;
//         }
//         if (!empty($_GET['search'])) {
//             $search = $_GET['search'];
//             $search = $_GET['search'];
//         } else {
//             $search = null;
//         }
//         if (!empty($_GET['sortby'])) {
//             $sortby = $_GET['sortby'];
//             $sortby = $_GET['sortby'];
//         } else {
//             $sortby = null;
//         }
//         if ($subcategorys || $sale || $occasions || $minprice || $maxprice || $search || $sortby|| $genders || $sizes) {

//             if ($subcategorys) {
//                 $q->whereHas('subcategory', function ($q) use ($subcategorys) {
//                     $q->whereIn('id', $subcategorys);
//                 });
               
//             }

//             if ($occasions) {
//                 $q->whereHas('occasion', function ($q) use ($occasions) {
//                     $q->whereIn('id', $occasions);
//                 });
//             }
//             if ($sale) {
//                 $q->where('on_sale', $sale);
//             }
//             if ($genders) {
//                 $q->wherein('gender', $genders);
//             }

          
//             if ($sizes) {
//                 $q->whereHas('variants_size', function ($q) use ($sizes) {
//                     $q->wherein('weight', $sizes);
//                 });
//             }

//             if ($minprice && $maxprice) {
//                 $q->whereHas('variants_price_desc', function ($q) use ($minprice, $maxprice) {
//                     $q->where('selling_price', '>=', $minprice)->where('selling_price', '<=', $maxprice);
//                 });
//             }
//             if ($search) {
//                 $q->where('product_name', 'like', '%' . $search . '%');
//                 $q->orWhereHas('occasion', function ($q) use ($search) {
//                     $q->where('name', 'like', '%' . $search . '%');
//                 })
//                     ->orWhereHas('product_category', function ($q) use ($search) {
//                         $q->where('name', 'like', '%' . $search . '%');
//                     });
//             }

//             if ($sortby) {
//                 if ($sortby == 'low_to_high') {
//                     $product = $q->where('active', 1)->with('variants_price_desc')->get()->sortBy('variants_price_desc.selling_price');
//                 } elseif ($sortby == 'high_to_low') {
//                     $product = $q->where('active', 1)->with('variants_price_desc')->get()->sortByDesc('variants_price_desc.selling_price');
//                 } elseif ($sortby == 'newest') {
//                     $product = $q->where('active', 1)->orderBy('id', 'desc')->get();
//                     // $q->orderBy('id', 'desc');
//                 } elseif ($sortby == 'relevance') {
//                     $product = $q->where('active', 1)->orderBy('id', 'asc')->get();
//                     // $q->orderBy('id', 'desc');
//                 }
//             } else {
//                 $product = $q->where('active', 1)->get();
//             }
            
//         } else {
//             $product = $q->where('active', 1)->get();
//         }
//        // dd($product);
//         return view('website.product-listingbycat', compact('seo','size','slider', 'Product_occasion', 'best_seller',  'product', 'Product_subcategory', 'allproductCount', 'maxproductCost', 'minproductCost' ));
    }





    //product listing main category and suncategory
    public function product_listing_tests(Request $request, $param1, $param2)
    {

        // $product_cat = Product_category::where('slug', '=', $param1)->first();
        // abort_if(!$product_cat, 404);

        // $product_subcat = Product_sub_category::where('slug', '=', $param2)->first();
        // abort_if(!$product_subcat, 404);
        // //DECODE START
        // if (!empty($_GET['search'])) {
        //     $_GET['search'] = base64_decode($_GET['search']);
        // }
        // if (!empty($_GET['category'])) {
        //     $_GET['category'] = base64_decode($_GET['category']);
        // }
       
        // if (!empty($_GET['gender'])) {
        //     $_GET['gender'] = base64_decode($_GET['gender']);
        // }
        // if (!empty($_GET['occasions'])) {
        //     $_GET['occasions'] = base64_decode($_GET['occasions']);
        // }
       
        // if (!empty($_GET['size'])) {
        //     $_GET['size'] = base64_decode($_GET['size']);
        // }
       
        // if (!empty($_GET['metal_color'])) {
        //     $_GET['metal_color'] = base64_decode($_GET['metal_color']);
        // }
        // if (!empty($_GET['design'])) {
        //     $_GET['design'] = base64_decode($_GET['design']);
        // }
        // if (!empty($_GET['sale'])) {
        //     $_GET['sale'] = base64_decode($_GET['sale']);
        // }

        
        // if (!empty($_GET['minprice'])) {
        //     $_GET['minprice'];
        // }
        // if (!empty($_GET['maxprice'])) {
        //     $_GET['maxprice'];
        // }
        // $seo = Seo::all();
        // $slider = Slider::all();
        // $Product_subcategory = Product_sub_category::where('main_cat_id', $product_cat->id)->get();
        // $best_seller = product::where('best_sellers', 1)->where('active', 1)->orderBy('id', 'desc')->take(5)->get();
        // $size = DB::table('product_variants')->where('category', $product_cat->id)->where('weight', '<>', 'N/A')->select('weight')->groupBy('weight')->get();   
        // $Product_occasion = Occasion::all();
        // $product_metal_color = Metalcolor::all();
        // $maxproductCost = ProductVariants::where('category', $product_cat->id)->max('selling_price');
        // $minproductCost = ProductVariants::where('category', $product_cat->id)->min('selling_price');
        // $maxproductCost = $maxproductCost + 50;
        // $allproductCount = product::count();
        // $q = product::query();
        // $q->where('product_subcategory', $product_subcat->id)->where('product_category', $product_cat->id);

        // if (!empty($_GET['subcategory'])) {
        //     $subcategory = $_GET['subcategory'];
        //     $subcategorys = explode(',', $subcategory);
        // } else {
        //     $subcategorys = [];
        // }
        
       
        // if (!empty($_GET['size'])) {
        //     $sizer = $_GET['size'];
        //     $sizes = explode(',', $sizer);
        // } else {
        //     $sizes = [];
        // }

     
        // if (!empty($_GET['metal_color'])) {
        //     $metal_color = $_GET['metal_color'];
        //     $metal_colors = explode(',', $metal_color);
        // } else {
        //     $metal_colors = [];
        // }
        // if (!empty($_GET['gender'])) {
        //     $gender = $_GET['gender'];
        //     $genders = explode(',', $gender);
        // } else {
        //     $genders = [];
        // }
        // if (!empty($_GET['occasions'])) {
        //     $occasion = $_GET['occasions'];
        //     $occasions = explode(',', $occasion);
        // } else {
        //     $occasions = [];
        // }
        // if (!empty($_GET['sale'])) {
        //     $sale = $_GET['sale'];
        // } else {
        //     $sale = 0;
        // }
        // if (!empty($_GET['minprice'])) {
        //     $minprice = $_GET['minprice'];
        // } else {
        //     $minprice = 0;
        // }
        // if (!empty($_GET['maxprice'])) {
        //     $maxprice = $_GET['maxprice'];
        // } else {
        //     $maxprice = 0;
        // }
        // if (!empty($_GET['search'])) {
        //     $search = $_GET['search'];
        //     $search = $_GET['search'];
        // } else {
        //     $search = null;
        // }
        // if (!empty($_GET['sortby'])) {
        //     $sortby = $_GET['sortby'];
        //     $sortby = $_GET['sortby'];
        // } else {
        //     $sortby = null;
        // }
        // if ($subcategorys || $sale || $occasions || $minprice || $maxprice || $search || $sortby || $metal_colors || $sizes ||  $genders) {
          
        //     if ($subcategorys) {
        //         $q->whereHas('subcategory', function ($q) use ($subcategorys) {
        //             $q->whereIn('id', $subcategorys);
        //         });
               
        //     }

        //     if ($occasions) {
        //         $q->whereHas('occasion', function ($q) use ($occasions) {
        //             $q->whereIn('id', $occasions);
        //         });
        //     }
        //     if ($sale) {
        //         $q->where('on_sale', $sale);
        //     }

        //     if ($genders) {
        //         $q->wherein('gender', $genders);
        //     }

          
        //     if ($sizes) {
        //         $q->whereHas('variants_size', function ($q) use ($sizes) {
        //             $q->wherein('weight', $sizes);
        //         });
        //     }
          
          
        //     if ($metal_colors) {
        //         $q->whereHas('metal_color', function ($q) use ($metal_colors) {
        //             $q->whereIn('id', $metal_colors);
        //         });
        //     }
           
        //     if ($sale) {
        //         $q->where('on_sale', $sale);
        //     }
        //     if ($genders) {
        //         $q->wherein('gender', $genders);
        //     }
        //     if ($minprice && $maxprice) {
        //         $q->whereHas('variants_price_desc', function ($q) use ($minprice, $maxprice) {
        //             $q->where('selling_price', '>=', $minprice)->where('selling_price', '<=', $maxprice);
        //         });
        //     }
        //     if ($search) {
        //         $q->where('product_name', 'like', '%' . $search . '%');
        //         $q->orWhereHas('occasion', function ($q) use ($search) {
        //             $q->where('name', 'like', '%' . $search . '%');
        //         })
        //             ->orWhereHas('category', function ($q) use ($search) {
        //                 $q->where('name', 'like', '%' . $search . '%');
        //             });
        //     }

        //     if ($sortby) {
        //         if ($sortby == 'low_to_high') {
        //             $product = $q->where('active', 1)->with('variants_price_desc')->get()->sortBy('variants_price_desc.selling_price');
        //         } elseif ($sortby == 'high_to_low') {
        //             $product = $q->where('active', 1)->with('variants_price_desc')->get()->sortByDesc('variants_price_desc.selling_price');
        //         } elseif ($sortby == 'newest') {
        //             $product = $q->where('active', 1)->orderBy('id', 'desc')->get();
        //             // $q->orderBy('id', 'desc');
        //         } elseif ($sortby == 'relevance') {
        //             $product = $q->where('active', 1)->orderBy('id', 'asc')->get();
        //             // $q->orderBy('id', 'desc');
        //         }
        //     } else {
        //         $product = $q->where('active', 1)->get();
        //     }
        //     // dd($properties);
        // } else {
        //     $product = $q->where('active', 1)->get();
        // }
       
        // return view('website.product-listingbycat', compact('seo', 'slider', 'Product_occasion', 'best_seller',   'product', 'Product_subcategory', 'allproductCount', 'maxproductCost', 'minproductCost','size'));
    }







    public function designer_listing()
    {

        $seo = Seo::all();



        $designers = Designer::where('approved', 1)->get();

        return view('website.designer-listing', compact('seo', 'designers'));
    }

    public function paymentfailed()
    {
        $seo = Seo::all();
        return view('website.payment-failed', compact('seo'));
    }
    public function loginotp()
    {
        $seo = Seo::all();
        return view('website.login-otp', compact('seo'));
    }



    public function thank_you()
    {

        $seo = Seo::all();



        return view('website.thank-you', compact('seo'));
    }

    public function thankyou()
    {

        $seo = Seo::all();



        return view('website.thank-you', compact('seo'));
    }

    public function subscribeThankyou()
    {
        $seo = Seo::all();
        return view('website.thankyou', compact('seo'));
    }

    public function gold_guide()
    {

        $seo = Seo::all();
        return view('website.gold-guide', compact('seo'));
    }
	
	
    // public function wishlist_page()
    // {
    //     $userId = Auth()->id();
    
    //     $wishlists = Wishlist::with(['product', 'product_variants', 'product_sizet', 'firstimagewishlist'])
    //         ->where('user_id', $userId)
    //         ->get();
    
    //     $seo = Seo::all();
    //     $isEmpty = $wishlists->isEmpty();
    //     return view('website.wishlist-page', compact('seo', 'wishlists','isEmpty'));
    // }
    
	

    public function size_guide()
    {
        $seo = Seo::all();
        return view('website.size-guide', compact('seo'));
    }



    // public function checkout_shipping()
    // {
    //     $seo = Seo::all();
    //     return view('website.checkout-shipping', compact('seo'));
    // }

    


   public function wishlist()
    {
       $seo = Seo::all();
       $wishlists = "App\Wishlist"::where('user_id', Auth::user()->id)->with('product', 'product.firstimage')->get();
       $isEmpty = $wishlists->isEmpty();

       return view('website.wishlist', compact('seo', 'wishlists','isEmpty'));
    }




    // public function product_detail($slug)
    // {

    //     if (Auth::check()) {
    //         $user_id = Auth::user()->id;
    //     } else {
    //         $user_id = 0;
    //     }

    //     $seo = Seo::all();
    //     $product = Product::where('slug', '=', $slug)->first();
       
    //     abort_if(!$product, 404);

    //     if (Auth::user()) {

    //         if (DB::table('quick_view_timestamps')->where('userid', Auth::user()->id)->where('productid', $product->id)->count() > 0) {
    //             $currdatetime = Carbon::now()->format("Y-m-d H:i:s"); //dd($currdatetime);
    //             DB::table('quick_view_timestamps')->where('userid', Auth::user()->id)->where('productid', $product->id)->update(['created_at' => $currdatetime]);
    //         } else {
    //             $data = array();
    //             $currdatetime = Carbon::now()->format("Y-m-d H:i:s");
    //             $data[] = array('userid' => Auth::user()->id, 'productid' => $product->id, 'created_at' => $currdatetime);
    //             DB::table('quick_view_timestamps')->insert($data);
    //         }
    //     }

    //     $product_image = Product_Image::where('product_id', '=', $product->id)->orderBy('id', 'asc')->get();
    //     $product_variants = ProductVariants::where('product_id', '=', $product->id)->orderBy('price', 'asc')->get();
      
    //     $sizes_arrey = explode(",", $product->size);
    //     $sizes = Size::whereIn('id', $sizes_arrey)->get();
    //     $youmayalsolike = Product::where('outofstock', 0)->inRandomOrder()->limit(20)->get();
    //      //ratting
    //      $totalRatings = Rating::where('product_id', $product->id)->where('status', '1')->get()->count();
    //      $positiveRatings = \DB::table('rating')->where('product_id', $product->id)->where('status', '1')->whereIn('rating', [4, 5])->count();
    //      $recommendationPercentage = $totalRatings > 0 ? round(($positiveRatings / $totalRatings) * 100) : 0;
    
    //      $ratingsDistribution = \DB::table('rating')->where('product_id', $product->id)->where('status', '1')
    //      ->select('rating', \DB::raw('count(*) as count'))
    //      ->groupBy('rating')
    //      ->pluck('count', 'rating')
    //      ->toArray();
     
    //      $maxCount = !empty($ratingsDistribution) ? max($ratingsDistribution) : 0;
      
    //     $averageRating = \DB::table('rating')->where('product_id', $product->id)->where('status', '1')->avg('rating');
       
           
    //         $reviews = Rating::where('product_id', $product->id)->where('status', '1')->get();
    //         $mostLikedReview = Rating::where('status', '1')->where('product_id', $product->id)->orderBy('likes', 'desc')->first();
    //         $groupProduct=array();
    //         if(!empty($product['group_code'])){
    //         $groupProduct = Product::select('id', 'slug', 'list_image')
    //         ->where('id', '!=', $product->id)
    //         ->where('group_code', $product->group_code)
    //         ->get();
    //         }
        
    //     return view('website.product-detail', compact('seo','groupProduct', 'reviews','totalRatings','mostLikedReview','ratingsDistribution','averageRating','maxCount','recommendationPercentage', 'product', 'user_id', 'product_image', 'product_variants', 'youmayalsolike', 'sizes'));
    // }

    // public function productdetail($slug){
    // 	if(Auth::check()){
    //      	$user_id = Auth::user()->id;
    //      }
    //      else{
    //      	$user_id = 0;
    //      }

    //     $seo=Seo::all();
    //      $product = Product::where('slug','=', $slug)->first();

    //      abort_if(!$product, 404);
    //     $product_image = Product_Image::where('product_id','=', $product->id)->orderBy('id', 'asc')->get();
    //     $product_variants = ProductVariants::where('product_id','=', $product->id)->orderBy('price', 'asc')->get();
    //     $total_review=Rating::where('product_id',$product->id)->where('status','1')->get()->count();
    //     $reviews = Rating::where('product_id',$product->id)->where('status','1')->get();
    //     $sizes_arrey = explode(",",$product->size);
    //     $sizes = Size::whereIn('id', $sizes_arrey)->get();
    //     $avg_rating=Rating::where('product_id',$product->id)->where('status','1')->avg('rating');  
    //     $avg_ratingsg = str_replace('.0','',round($avg_rating,1));  
    //    // $youmayalsolike = Product::where('product_id',$product->id)->where('status','1')->get();
    //     //dd($product_variants);

    //     $youmayalsolike=Product::where('outofstock',0)->inRandomOrder()->limit(20)->get();

    //     return view('website.productdetail', compact('seo','product','user_id','reviews','avg_ratingsg','product_image','product_variants','total_review','youmayalsolike','sizes'));
    // }

    public function getProductInfoForCart(Request $request)
    {
        $product = Product::find($request->new_product_id);
        $flavours = [];
        $weight = '';
        $type = 3;
        if ($product->all_flavours->count() > 0) {
            $flavours = $product->all_flavours;
        }

        if ($product->product_variants->count() > 0) {
            $weight = $product->product_variants[0]->weight;
        }

        return response()->json(['status' => 201, 'type' => $type, 'flavours' => $flavours, 'weight' => $weight]);
    }

    public function getProductprice(Request $request)
    {

        $data = ProductVariants::where("product_id", $request->product_id)->where("weight", $request->weight_id)
            ->first();
        // $flavour = flavourmappings::where('productid','=', $request->product_id)->orderBy('id', 'desc')->get();
        // dd($data);

        return response()->json($data);
    }







    public function getprice_usingsize(Request $request)
    {

        if ($request->product_size) {
            $product_price =ProductVariants::where('product_id', $request->product_id)->where('weight', $request->product_size)->orderBy('id', 'asc')->first();
           // dd($product_price);
            return response()->json($product_price);
        }
    }




    public function faqs()
    {

        $seo = Seo::all();



        return view('website.faqs', compact('seo'));
    }




    public function terms_and_conditions()
    {

        $seo = Seo::all();



        return view('website.terms-condition', compact('seo'));
    }



    public function shipping_policy()
    {

        $seo = Seo::all();



        return view('website.shipping-policy', compact('seo'));
    }


    public function refund_policy()
    {

        $seo = Seo::all();



        return view('website.refund-policy', compact('seo'));
    }



    public function return_policy()
    {

        $seo = Seo::all();



        return view('website.return-policy', compact('seo'));
    }

    public function privacy_policy()
    {

        $seo = Seo::all();
        return view('website.privacy-policy', compact('seo'));
    }



   

    public function referal_page()
    {
        // dd('aaa');
        $seo = Seo::all();
        return view('website.referal-page', compact('seo'));
    }

    public function referal_with_login()
    {
        $seo = Seo::all();
        $referalCode = null;

        if(Auth::user())
        {
            $referalCode = Coupon::where('user_id', Auth::user()->id)->first();
        }
        
        return view('website.referal-with-login', compact('seo','referalCode'));
    }


    public function gift_card()
    {

        $seo = Seo::all();
        return view('website.gift-card', compact('seo'));
    }



    public function contact_us()
    {

        $seo = Seo::all();

        return view('website.contact-us', compact('seo'));
    }





    public function logbook()
    {
        $seo = Seo::all();
        $blog_categ = 'App\Category'::orderBy('id', 'desc')->get();
        $center_recent_blog = 'App\Blog'::orderBy('id', 'desc')->get()->take('1');
        $recent_blog = 'App\Blog'::orderBy('id', 'desc')->LIMIT(10000)->OFFSET(1)->get()->take('2');
        $trending_blog = 'App\Blog'::where('trending', 1)->orderBy('id', 'desc')->get()->take('5');
        $trending_blog_section = 'App\Blog'::where('trending', 1)->orderBy('id', 'desc')->LIMIT(10000)->OFFSET(1)->get()->take('3');
        $recipes_blog = 'App\Blog'::where('category', 9)->orderBy('id', 'desc')->get()->take('3');
        $catalyst_blog_section_left = 'App\Blog'::where('catalyst', 1)->orderBy('id', 'desc')->get()->take('1');
        $catalyst_blog_section_right = 'App\Blog'::where('catalyst', 1)->orderBy('id', 'desc')->LIMIT(10000)->OFFSET(1)->get()->take('30');
        $brand_ambassador_blog_section_left = 'App\Blog'::where('brand_ambassador', 1)->orderBy('id', 'desc')->get()->take('3');

        return view('website.logbook', compact('seo', 'blog_categ', 'recent_blog', 'center_recent_blog', 'trending_blog', 'trending_blog_section', 'recipes_blog', 'catalyst_blog_section_left', 'catalyst_blog_section_right', 'brand_ambassador_blog_section_left'));
    }






    public function press_release()
    {

        $seo = Seo::all();

        return view('website.press-release', compact('seo'));
    }
    public function product_detail($slug)
    {
        $seo = Seo::all();
        $product = Product::where('slug', $slug)->first();
        abort_if(!$product, 404);
//recent view

        if (Auth::user()) {

            if (DB::table('quick_view_timestamps')->where('userid', Auth::user()->id)->where('productid', $product->id)->count() > 0) {
                $currdatetime = Carbon::now()->format("Y-m-d H:i:s"); //dd($currdatetime);
                DB::table('quick_view_timestamps')->where('userid', Auth::user()->id)->where('productid', $product->id)->update(['created_at' => $currdatetime]);
            } else {
                $data = array();
                $currdatetime = Carbon::now()->format("Y-m-d H:i:s");
                $data[] = array('userid' => Auth::user()->id, 'productid' => $product->id, 'created_at' => $currdatetime);
                DB::table('quick_view_timestamps')->insert($data);
            }
        }


        $product_variants = ProductVariants::where('product_id', '=', $product->id)->orderBy('price', 'asc')->get();
        $products = Product::where('on_sale', 0)->where('active', 1)->where('slug', '!=', $slug)->orderby('created_at', 'desc')->get()->take(4);
        $product_image = Product_Image::where('product_id', '=', $product->id)->orderBy('id', 'desc')->get();
         // Fetch reviews for the product
        $reviews = Rating::where('product_id', $product->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        $averageRating = $reviews->avg('rating'); // Calculate average rating
        $totalRatings = $reviews->count(); // Get total number of reviews

        // Check if the user has already reviewed this product
        $userReview = null;
        // dd($userReview);
        if (auth()->check()) {
        $userReview = Rating::where('product_id', $product->id)
                            ->where('user_email', auth()->user()->email)
                            ->first();

        // $countReviewPerProduct = Rating::where('product_id', $product->id)->where('status', 1)->count();

        
        
    }

    $couponSpecificProduct = Coupon::where('discount_type', 'specific_product')->where('active', 1)->get();

        return view('website.product-detail', compact('totalRatings','averageRating','seo','product','product_variants','products','product_image', 'reviews','userReview','couponSpecificProduct'));
    }




    public function blogcategory($slug)
    {

        $seo = Seo::all();
        $category = 'App\Category'::where('slug', $slug)->pluck('id');

        if (!$category->count()) {
            abort(404);
        } else {
            $category_name = 'App\Category'::where('id', $category)->first();
            $blog = 'App\Blog'::where('category', $category)->get();
            // dd($blog);
            return view('website.blog', compact('blog', 'seo', 'category_name'));
        }
    }


    public function popularblog()
    {

        $seo = Seo::all();

        $blog = 'App\Blog'::where('popular_articles', '1')->orderBy('id', 'desc')->get()->take('6');
        return view('website.blog-pages', compact('blog', 'seo'));
    }

    public function blogs()
    {
        $start = microtime(true); // Start time


        $seo = Seo::all();

        $end = microtime(true); // End time
        $executionTime = $end - $start; 
        // dd("Query Execution Time: {$executionTime} seconds");

        $blogs= 'App\Blog'::orderBy('id', 'desc')->LIMIT(10000)->OFFSET(1)->get();


        $latestBlog = \App\Blog::orderBy('id', 'desc')->first();

        




        return view('website.blog', compact('blogs', 'seo','latestBlog'));
    }

    // public function blogs()
    // {

    //     $seo = Seo::all();
    //     return view('website.blog');
    // }

    public function Invoice()
    {

        $seo = Seo::all();
        return view('website.invoice');
    }



    public function new_invoice()
    {

        $seo = Seo::all();
        return view('website.new-invoice');
    }


    public function blog_details($slug)
{

    $seo = Seo::all();
    $blog = \App\Blog::where('slug', $slug)->first(); // Fetching the current blog post

    if (!$blog) {
        abort(404);
    }
    $p_blog = \App\Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first(); // Previous post
    $n_blog = \App\Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();  // Next post
    $recent_blog = \App\Blog::where('id', '!=', $blog->id)->orderBy('id', 'desc')->take(3)->get();
    $blog_category = \App\Category::orderBy('id', 'desc')->get();
    $slides = \App\Blog::orderBy('created_at', 'desc')->take(3)->get();
    
    return view('website.blog-detail', compact('blog', 'p_blog', 'n_blog', 'seo', 'blog_category', 'recent_blog', 'slides'));
}


    // public function blog_details()
    // {
    
    //     return view('website.blog-detail');
    // }
    


    public function logbook_details($slug)
    {

        $seo = Seo::all();
        //$category='App\Category'::where('slug',$slug)->pluck('id');
        $blogs = 'App\Blog'::where('slug', $slug)->pluck('id');

        if (!$blogs->count()) {
            abort(404);
        }

        $blog = 'App\blog'::where('id', $blogs)->first();
        if ($blog) {
            $p_blog = 'App\Blog'::where('id', '>', $blog->id)->orderBy('id', 'desc')->first();
            $n_blog = 'App\Blog'::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        }
        $recent_blog = 'App\Blog'::where('id', '!=', $blog->id)->orderBy('id', 'desc')->get()->take('5');
        // dd( $recent_blog);
        $blog_category = 'App\Category'::orderBy('id', 'desc')->get();
        return view('website.blog-detail', compact('blog', 'p_blog', 'n_blog', 'seo', 'blog_category', 'recent_blog'));
    }

    public function logbookcategory($slug)
    {

        $seo = Seo::all();
        $category = 'App\Category'::where('slug', $slug)->pluck('id');
        $category_all = 'App\Category'::orderBy('id', 'desc')->get();
        //dd($category);

        if (!$category->count()) {
            abort(404);
        } else {
            $category_name = 'App\Category'::where('id', $category)->first();
            $blog = 'App\Blog'::where('category', $category)->get();
            // dd($blog);
            return view('website.logbook-listing', compact('blog', 'seo', 'category_name', 'category', 'category_all'));
        }
    }




    public function login(Request $request)
    {

        $email = $request->get('name1');
        $pass = $request->get('name2');
        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            return Response::json(['success' => '1']);
        }
        return Response::json(['success' => 'You Have Enter Wrong Email And Password ']);
    }









    public function course_details($id)
    {

        $seo = Seo::all();

        //dd($id);

        $course = 'App\Course'::where('slug', $id)->first();



        //dd($course);





        return view('website.courses-detail', compact('course', 'seo'));
    }

    // public function contact_save(Request $request)
    // {
    //    $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:50|min:3',
    //         'email' => [
    //             'required',
    //             'email',
    //             function ($attribute, $value, $fail) {
    //                 if (preg_match('/@(hotmail\.com|yahoo\.com|aol\.com|.*\.ru|.*\.pl)$/i', $value)) {
    //                     $fail('The ' . $attribute . ' must be a business email address and cannot be from the specified domains.');
    //                 }
    //             },
    //         ],
    //         'mobile' => 'required|digits:10',
    //         'message' => 'required',
    //         'g-recaptcha-response' => ['required', new Recaptcha()],
    //     ]);

    //    if ($validator->fails()) {
    //     return response()->json([
    //         'success' => false,
    //         'errors' => $validator->errors()
    //     ], 422);
    //     }
    //     $name = $request->name;
    //     $email = $request->email;
    //     $formtype = $request->formtype;
    //     $phoneno = $request->mobile;
    //     $message = $request->input('message', ''); 
    //     $source_url = $request->source_url;
    //     $product = null;
    //     $product_weight = null;
    //     $product_quantity = null;
    //     $interested_in = null;
    //     $person = null;

        

    //     if($request->product)
    //     {
    //         $product = $request->product;
    //     }

    //     if($request->product_weight)
    //     {
    //         $product_weight = $request->product_weight;
    //     }

    //     if($request->product_quantity)
    //     {
    //         $product_quantity = $request->product_quantity;
    //     }
        
    //     if($request->interested_in)
    //     {
    //         $interested_in = $request->interested_in;
    //     }

    //     if($request->person)
    //     {
    //         $person = $request->person;
    //     }
        

    //     // $google_meet = $request->google_meet;
    //     //dd($service);
    //     $data = ["name" => $name, "email" => $email,  "mobile" => $phoneno,  "message" => $message, "source_url" => $source_url, "product" => $product, "product_weight" => $product_weight, "product_quantity" => $product_quantity, "interested_in" => $interested_in,"person" => $person,"formtype" => $formtype];
    //     $this->createTable("\App\Contact", $data);

    //     $formTypeData = Formtype::where('form_type_name', 'contact')->pluck('id')->first();
    //     $emails = Dynamicemail::whereRaw("FIND_IN_SET(?, form_type_id)", [$formTypeData])
    //      ->where('email_types', 'contact')
    //      ->get();
 
    //      if ($emails->isNotEmpty()) {
    //       $to = $emails->pluck('to_emails')->flatMap(function ($toEmails) {
    //           return collect(explode(',', $toEmails));  
    //       })->filter(function ($email) {
    //           return filter_var(trim($email), FILTER_VALIDATE_EMAIL);  
    //       })->all();  
  
    //       $cc = $emails->pluck('cc_emails')->flatMap(function ($ccEmails) {
    //           return collect(explode(',', $ccEmails));  
    //       })->filter(function ($email) {
    //           return filter_var(trim($email), FILTER_VALIDATE_EMAIL);  
    //       })->all();  
  
    //       $bcc = $emails->pluck('bcc_emails')->flatMap(function ($bccEmails) {
    //           return collect(explode(',', $bccEmails));  
    //       })->filter(function ($email) {
    //           return filter_var(trim($email), FILTER_VALIDATE_EMAIL);  
    //       })->all();  
    //      Mail::send('email.contact', $data, function ($mail) use ($to, $cc, $bcc) {
    //          if ($to) $mail->to($to);
    //          if ($cc) $mail->cc($cc);
    //          if ($bcc) $mail->bcc($bcc);

    //          $mail->from('saurabhkumar1@88gravity.com','Aayurja');
    //          $mail->subject('Contact');

                
    //     // Mail::send('email.contact', $data, function ($message) use ($data) {
    //     //     $message->to(['anmolgalaxy38@gmail.com']);
    //     //     $message->bcc(['dev.anmolrastogi@gmail.com']);
    //     //     $message->bcc(['anmol@88gravity.com']);
    //     //      $message->bcc(['nitishc50@gmail.com','depreet@88gravity.com']);
    //     //     $message->from('Aayurja@gmail.com','Aayurja');
    //     //     $message->subject('Contact');
    //     //     }); 
    

    //      });
    //     } else {
    //         return redirect()->back()->with('error', 'No email addresses found for this form type.');
    //     }


    //    return response()->json([
    //     'success' => true,
    //     'message' => 'Form submitted successfully.'
    // ]);

    // }


public function contact_save(Request $request)
{
    try {
        // -------------------------
        // 1. Validation
        // -------------------------
        $validator = Validator::make($request->all(), [
            'name'   => 'required|max:50|min:3',
            'email'  => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (preg_match('/@(hotmail\.com|yahoo\.com|aol\.com|.*\.ru|.*\.pl)$/i', $value)) {
                        $fail('The ' . $attribute . ' must be a business email address and cannot be from the specified domains.');
                    }
                },
            ],
            'mobile' => 'required|digits:10',
            'message'=> 'required',
            'g-recaptcha-response' => ['required', new Recaptcha()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // -------------------------
        // 2. Collect Data
        // -------------------------
        $data = [
            "name"             => $request->name,
            "email"            => $request->email,
            "mobile"           => $request->mobile,
            "message"          => $request->message,
            "source_url"       => $request->source_url,
            "product"          => $request->product ?? null,
            "product_weight"   => $request->product_weight ?? null,
            "product_quantity" => $request->product_quantity ?? null,
            "interested_in"    => $request->interested_in ?? null,
            "person"           => $request->person ?? null,
            "formtype"         => $request->formtype ?? 'contact',
        ];

        // ✅ Save to DB
        $this->createTable("\App\Contact", $data);

        // -------------------------
        // 3. Get Recipients
        // -------------------------
        $formTypeData = Formtype::where('form_type_name', 'contact')
            ->pluck('id')
            ->first();

        $emails = Dynamicemail::whereRaw("FIND_IN_SET(?, form_type_id)", [$formTypeData])
            ->where('email_types', 'contact')
            ->get();

        if ($emails->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No email address found for this form type.',
            ], 404);
        }

        // ✅ Extract TO, CC, BCC
        $to = $emails->pluck('to_emails')->flatMap(function ($e) {
            return explode(',', $e);
        })->filter(function ($email) {
            return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        })->values()->all();

        $cc = $emails->pluck('cc_emails')->flatMap(function ($e) {
            return explode(',', $e);
        })->filter(function ($email) {
            return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        })->values()->all();

        $bcc = $emails->pluck('bcc_emails')->flatMap(function ($e) {
            return explode(',', $e);
        })->filter(function ($email) {
            return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        })->values()->all();

        // Log recipients (debugging)
        \Log::info('Contact Form TO:', $to);
        \Log::info('Contact Form CC:', $cc);
        \Log::info('Contact Form BCC:', $bcc);

        // -------------------------
        // 4. Render Blade View
        // -------------------------
        $html = view('email.contact', [
            'name'             => $request->name,
            'email'            => $request->email,
            'mobile'           => $request->mobile,
            'message'          => $request->message,
            'source_url'       => $request->source_url,
            'location'         => $request->location ?? null,
            'service'          => $request->service ?? null,
            'product'          => $request->product ?? null,
            'product_weight'   => $request->product_weight ?? null,
            'product_quantity' => $request->product_quantity ?? null,
            'interested_in'    => $request->interested_in ?? null,
            'person'           => $request->person ?? null,
            'formtype'         => $request->formtype ?? 'contact',
        ])->render();

        // -------------------------
        // 5. Brevo API Config
        // -------------------------
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        $emailData = new SendSmtpEmail([
            'subject' => "Aayurja - New Inquiry Received from {$request->name}",
            'sender'  => [
                'name'  => env('BREVO_SENDER_NAME', 'Aayurja'),
                'email' => env('BREVO_SENDER_EMAIL', 'info@aayurja.com'),
            ],
            'to' => array_map(function ($e) {
                return ['email' => trim($e)];
            }, $to),
            'cc' => array_map(function ($e) {
                return ['email' => trim($e)];
            }, $cc),
            'bcc' => array_map(function ($e) {
                return ['email' => trim($e)];
            }, $bcc),
            'htmlContent' => $html,
        ]);

        // ✅ Send Email with Logging
        try {
            $result = $apiInstance->sendTransacEmail($emailData);
            \Log::info('Brevo Email Response:', (array) $result);
        } catch (\Exception $e) {
            \Log::error('Brevo Email Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Email sending failed.',
                'error'   => $e->getMessage(),
            ], 500);
        }

        // -------------------------
        // 6. Success Response
        // -------------------------
        return response()->json([
            'success' => true,
            'message' => 'Form submitted successfully',
        ], 200);

    } catch (\Exception $e) {
        \Log::error('Contact Save Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while submitting the form.',
            'error'   => $e->getMessage(),
        ], 500);
    }
}



    public function password_reset()
    {
        // $seo=Seo::all();

        // return view('website.password-reset',compact('seo')); 

    }



    //Pickle Wickle NEW FUNCTIONS START
    public function helpDesk()
    {
        $seo = Seo::all();
        return view('website.help-desk', compact('seo'));
    }


    public function refundPolicy()
    {
        $seo = Seo::all();
        return view('website.refund-policy', compact('seo'));
    }

    public function termsCondition()
    {
        $seo = Seo::all();
        return view('website.terms-condition', compact('seo'));
    }

    public function shippingPolicy()
    {
        $seo = Seo::all();
        return view('website.shipping-policy', compact('seo'));
    }

    public function media()
    {
        $seo = Seo::all();
        $medias = Media::get();
        return view('website.media', compact('seo', 'medias'));
    }

    public function mediaDetail()
    {
        $seo = Seo::all();
        return view('website.media-detail', compact('seo'));
    }



    public function gallery_model($product_id)
    {


        $images = DB::table('product_images')->where("product_id", "=", $product_id)->get();

        return response()->json($images);

        // return redirect()->back();

    }
    //Pickle Wickle NEW FUNCTIONS END

public function error_404()
{
    return view('website.404');
}


public function survey()
{
    $seo = Seo::all();
    return view('website.survey', compact('seo'));
}


public function survey_thankyou()
{
    $seo = Seo::all();
    return view('website.survey-thankyou', compact('seo'));
}



public function surveySave(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'user_name' => 'required|string|min:3|max:255',
        'user_email' => 'required|email|max:255',
        'user_mobile' => 'required|digits:10',
        'user_age' => 'required|integer|min:1|max:120',
        'user_gender' => 'required|string',
        'user_address' => 'required|string|max:500',
        'user_profession' => 'required|string|max:255',
        'routine' => 'required|string',
        'family_members' => 'required|string',
        'consume_source' => 'required|string',
        'reason' => 'required|string',
        'lifestyle' => 'required|string',
        'activity' => 'required|string',
        'exotic_food' => 'required|string',
        'expenditure' => 'required|string',
        // 'reference' => 'nullable|string|max:500',
        'interested_in_purchase' => 'nullable|array',
        'user_country' => 'required|string',
        'user_state' => 'required|string',
        'user_city' => 'required|string',
        'user_zip_code' => 'required|string',
        'formtype' => 'required',

    ]);

    try {
        // Save the survey data to the database
        $survey = new Survey();
        $survey->user_name = $request->user_name;
        $survey->user_email = $request->user_email;
        $survey->user_mobile = $request->user_mobile;
        $survey->user_age = $request->user_age;
        $survey->user_gender = $request->user_gender;
        $survey->user_address = $request->user_address;
        $survey->user_profession = $request->user_profession;
        $survey->routine = $request->routine;
        $survey->consume_source = $request->consume_source;
        $survey->reason = $request->reason;
        $survey->lifestyle = $request->lifestyle;
        $survey->activity = $request->activity;
        $survey->exotic_food = $request->exotic_food;
        $survey->expenditure = $request->expenditure;
        $survey->formtype = $request->formtype;
        $survey->family_members = $request->family_members;

        $survey->ref_first_name1 = $request->ref_first_name1;
        $survey->ref_email1 = $request->ref_email1;
        $survey->ref_contact1 = $request->ref_contact1;
        $survey->ref_first_name2 = $request->ref_first_name2;
        $survey->ref_email2 = $request->ref_email2;
        $survey->ref_contact2 = $request->ref_contact2;
        $survey->ref_first_name3 = $request->ref_first_name3;
        $survey->ref_email3 = $request->ref_email3;
        $survey->ref_contact3 = $request->ref_contact3;
        $survey->user_apartment = $request->user_apartment;
        $survey->user_country = $request->user_country;
        $survey->user_state = $request->user_state;
        $survey->user_city = $request->user_city;
        $survey->user_zip_code = $request->user_zip_code;




        
        // Convert interested_in_purchase array to JSON if it's present
        $survey->interested_in_purchase = $request->interested_in_purchase ? json_encode($request->interested_in_purchase) : null;

        $survey->save();


        // $data = ["user_name" => $request->user_name, "user_email" => $request->user_email,  "user_mobile" => $request->user_mobile, "user_age" => $request->user_age, "user_gender" => $request->user_gender, "user_address" => $request->user_address, "user_profession" => $request->user_profession, "routine" => $request->routine, "consume_source" => $request->consume_source, "reason" => $request->reason, "lifestyle" => $request->lifestyle, "activity" => $request->activity, "exotic_food" => $request->exotic_food, "expenditure" => $request->expenditure, "family_members" => $request->family_members, "ref_first_name1" => $request->ref_first_name1, "ref_email1" => $request->ref_email1, "ref_contact1" => $request->ref_contact1, "ref_first_name2" => $request->ref_first_name2, "ref_email2" => $request->ref_email2, "ref_contact2" => $request->ref_contact2, "ref_first_name3" => $request->ref_first_name3, "ref_email3" => $request->ref_email3, "ref_contact3" => $request->ref_contact3, "interested_in_purchase" => $request->interested_in_purchase];

        $user_name = $request->user_name;

        // if($request->ref_email3)
        // {
        //     $referralEmails = [$request->ref_email1, $request->ref_email2, $request->ref_email3];
        // }
        // else
        // {
        //     $referralEmails = [$request->ref_email1, $request->ref_email2];
        // }


        // Mail::send('email.survey', ['user_name' => $user_name], function ($message) use ($referralEmails) {
        //     $message->to($referralEmails);
        //     $message->from('anmol@88gravity.com', 'Aayurja');
        //     $message->subject('Contact');
        // });



        //SEND EMAIL ONLY IF ANY EMAIL EXISTS
        $referralEmails = array_filter([
            $request->ref_email1, 
            $request->ref_email2, 
            $request->ref_email3
        ], function($email) {
            return !empty($email); // Filter out null or empty values
        });
        
        if (!empty($referralEmails)) {
            Mail::send('email.survey', ['user_name' => $user_name], function ($message) use ($referralEmails) {
                $message->to($referralEmails);
                $message->from('saurabhkumar1@88gravity.com', 'Aayurja');
                $message->subject('Contact');
            });
        }



        //AUTO SIGNUP START
        $userExists = User::where('mobile', $request->user_mobile)->first();

        if($userExists)
        {
            $userExists->name = $request->user_name;
            $userExists->email = $request->user_email;
            $userExists->save();

            $userId = $userExists->id;
        }
        else
        {
            $user = new User();
            $user->name = $request->user_name;
            $user->email = $request->user_email;
            $user->mobile = $request->user_mobile;
            $user->save();

            $userId = $user->id;
        }
        

        //BILLING ADDRESS UPDATE START
        $billingAddress = new BillingAddress();
        $billingAddress->name = $request->user_name;
        $billingAddress->city = $request->user_city;
        $billingAddress->state = $request->user_state;
        $billingAddress->country = $request->user_country;
        $billingAddress->address = $request->user_address;
        $billingAddress->address2 = $request->user_apartment;
        $billingAddress->pin_code = $request->user_zip_code;
        $billingAddress->mobile = $request->user_mobile;
        $billingAddress->email = $request->user_email;
        $billingAddress->user_id = $userId;
        $billingAddress->ssid = Session::getId();

        $billingAddress->save();
        //BILLING ADDRESS UPDATE END


//DYNAMIC EMAIL START


$data = ["user_name" => $user_name ];
$this->createTable("\App\Survey", $data);
$formTypeData = Formtype::where('form_type_name', 'survey')->pluck('id')->first();
$emails = Dynamicemail::whereRaw("FIND_IN_SET(?, form_type_id)", [$formTypeData])
 ->where('email_types', 'survey')
 ->get();

 if ($emails->isNotEmpty()) {
  $to = $emails->pluck('to_emails')->flatMap(function ($toEmails) {
      return collect(explode(',', $toEmails));  
  })->filter(function ($email) {
      return filter_var(trim($email), FILTER_VALIDATE_EMAIL);  
  })->all();  

  $cc = $emails->pluck('cc_emails')->flatMap(function ($ccEmails) {
      return collect(explode(',', $ccEmails));  
  })->filter(function ($email) {
      return filter_var(trim($email), FILTER_VALIDATE_EMAIL);  
  })->all();  

  $bcc = $emails->pluck('bcc_emails')->flatMap(function ($bccEmails) {
      return collect(explode(',', $bccEmails));  
  })->filter(function ($email) {
      return filter_var(trim($email), FILTER_VALIDATE_EMAIL);  
  })->all();  
 Mail::send('email.survey', $data, function ($mail) use ($to, $cc, $bcc) {
     if ($to) $mail->to($to);
     if ($cc) $mail->cc($cc);
     if ($bcc) $mail->bcc($bcc);
    // dd($to, $cc, $bcc);
     $mail->from('saurabhkumar1@88gravity.com','Aayurja');
     $mail->subject('Survey');

  
    });
    } else {
        return redirect()->back()->with('error', 'No email addresses found for this form type.');
    }


//DYNAMIC EMAIL END



        //AUTO SIGNUP END

        // Return success response
        return response()->json([
            'message' => 'Survey data saved successfully!',
        ], 200);
    } catch (\Exception $e) {
        // Return error response if something goes wrong
        return response()->json([
            'message' => 'Failed to save survey data!',
            'error' => $e->getMessage(),
        ], 500);
    }

    session(['manual_token' => 123]);
}




// public function runWati(Request $request)
// {
//     // dd('run wati....');

//     // $abandonedCarts = Cart::where('is_reminded', false)
//     //         // ->where('created_at', '<=', now()->subHours(2)) // Carts older than 2 hours
//     //         ->get();

//     // $abandonedCarts = Cart::groupBy('user_id')->get();
//     $abandonedCarts = Cart::select('user_id')
//     ->groupBy('user_id')
//     ->get();

//             // dd($abandonedCarts);
//         // $watiApiUrl = 'https://api.wati.io/v1/sendTemplateMessage';
//         $watiApiUrl = 'https://live-mt-server.wati.io/356491/api/v1/sendTemplateMessage?whatsappNumber=919990605721';
        
//         // $apiKey = env('WATI_API_KEY');

//         $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJmMjdmZjAzYS0zMTU0LTRmNTktODA5MC02Zjc5OGNhZDFmNWQiLCJ1bmlxdWVfbmFtZSI6ImluZm9AYWF5dXJqYS5jb20iLCJuYW1laWQiOiJpbmZvQGFheXVyamEuY29tIiwiZW1haWwiOiJpbmZvQGFheXVyamEuY29tIiwiYXV0aF90aW1lIjoiMTEvMjIvMjAyNCAxMDo1MDo1MiIsInRlbmFudF9pZCI6IjM1NjQ5MSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.YPj6NVk8_ocJzjwDpTBSkmfqnqKzgBmvyGGo9cAxQ_c';
//         // dd($apiKey);
//         $client = new Client();

//         foreach ($abandonedCarts as $cart) {
//             try {
//                 // Prepare data for WATI API
//                 $response = $client->post($watiApiUrl, [
//                     'headers' => [
//                         'Authorization' => "Bearer $apiKey",
//                         'Content-Type' => 'application/json',
//                     ],
//                     'json' => [
//                         'template_name' => 'reminder_template',
//                         'broadcast_name' => 'reminder_template',
//                         'parameters' => [
//                             ['name' => 'name', 'value' => 'Anmol Test by code'], // Name
//                             // ['name' => '2', 'value' => 'Gucchi Mushroom'], // Cart details
//                             // ['name' => '3', 'value' => 'AAYURJA20'], // Coupon code
//                         ],
//                         'phone_number' => '919990605721',
//                     ],
//                 ]);

//                 // Mark the cart as reminded
//                 // $cart->update(['is_reminded' => true]);

//                 // Log::info("WhatsApp message sent successfully to: {$cart->user->phone}");
//                 Log::info("WhatsApp message sent successfully.");

                
//                 dd('WhatsApp message sent successfully.'.$response->getBody());
//             } catch (\Exception $e) {
//                 Log::error("Failed to send WhatsApp message: " . $e->getMessage());
//                 dd('Failed to send WhatsApp message.'.$e->getMessage());

//             }
//         }

// }

public function redeemReferralSave(Request $request)
{
    $user_id = Auth::user()->id;
    $name = $request->name;
    $email = $request->email;
    $mobile = $request->mobile;
    $ifsc = $request->ifsc;
    $account = $request->account;
    $redeemed_points = $request->redeemed_points;
    $status = 'Pending';
    $total_points = $request->total_points;
    $balance_points = $request->balance_points;



    $data = ["user_id" => $user_id, "name" => $name, "email" => $email,  "mobile" => $mobile, "ifsc" => $ifsc, "account" => $account, "redeemed_points" => $redeemed_points, "status" => $status, "total_points" => $total_points, "balance_points" => $balance_points];


    // Mail::send('email.contact', $data, function ($message) use ($data) {
    // $message->to(['anmolgalaxy38@gmail.com']);
    // $message->bcc(['dev.anmolrastogi@gmail.com']);
    // $message->bcc(['anmol@88gravity.com']);
    // $message->bcc(['nitishc50@gmail.com','depreet@88gravity.com']);
    // $message->from('anmol@88gravity.com','Aayurja');
    // $message->subject('Contact');
    // }); 

    
    $this->createTable("\App\Redeem_referral", $data);
    return redirect()->away('thank-you');
}



public function runWati(Request $request)
{
    
     // Group cart data by user_id
     $abandonedCarts = Cart::with('user') // Assuming a `user` relationship exists
     ->select('user_id', 'product_id', 'quantity', 'weight') // Add required columns
     ->get()
     ->groupBy('user_id');

     // dd($abandonedCarts->first()[1]);
     $client = new Client();

     foreach ($abandonedCarts as $userId => $carts) {
         $user = $carts->first()->user; // Assuming all carts belong to the same user

         // dd($user);
         if (!$user || !$user->mobile) {
             Log::warning("No phone number for user ID: $userId");
             continue;
         }

         // Prepare dynamic product details
         $productDetails = [];
         foreach ($carts as $cart) {
             $productDetails[] = "{$cart->product->product_name} (Qty: {$cart->quantity})";
         }
         $productsText = implode(", ", $productDetails);

         // Send message via WATI API
         try {
             $watiApiUrl = "https://live-mt-server.wati.io/356491/api/v1/sendTemplateMessage?whatsappNumber=91{$user->mobile}";
             $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJmMjdmZjAzYS0zMTU0LTRmNTktODA5MC02Zjc5OGNhZDFmNWQiLCJ1bmlxdWVfbmFtZSI6ImluZm9AYWF5dXJqYS5jb20iLCJuYW1laWQiOiJpbmZvQGFheXVyamEuY29tIiwiZW1haWwiOiJpbmZvQGFheXVyamEuY29tIiwiYXV0aF90aW1lIjoiMTEvMjIvMjAyNCAxMDo1MDo1MiIsInRlbmFudF9pZCI6IjM1NjQ5MSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.YPj6NVk8_ocJzjwDpTBSkmfqnqKzgBmvyGGo9cAxQ_c';
         
             $response = $client->post($watiApiUrl, [
                 'headers' => [
                     'Authorization' => "Bearer $apiKey",
                     'Content-Type' => 'application/json',
                 ],
                 'json' => [
                     'template_name' => 'abandoned_cart_new',
                     'broadcast_name' => 'abandoned_cart_new',
                     'parameters' => [
                         ['name' => 'name', 'value' => $user->name], // Dynamic user name
                         ['name' => 'product_name', 'value' => $productsText], // Dynamic cart details
                         ['name' => 'coupon', 'value' => 'AAYURJA20'], // Dynamic or static coupon code
                         ['name' => 'coupon_percentage', 'value' => '20'], // Dynamic or static coupon code
                         ['name' => 'checkout_url', 'value' => 'https://www.aayurja.com/add-to-cart'], // Dynamic or static coupon code  
                     ],
                     'phone_number' => '91'.$user->mobile, // Dynamic phone number
                 ],
             ]);

             // Extract response body as string
             $responseBody = $response->getBody()->getContents();
             $statusCode = $response->getStatusCode();


             // Log success
             Log::info("abandoned WhatsApp message sent successfully to: {$user->mobile}");

         } catch (\Exception $e) {
             Log::error("abandoned  Failed to send WhatsApp message to {$user->mobile}: " . $e->getMessage());
         }
     }
}



public function runWatiOrderFailed(Request $request)
{
    //WHATSAPP MESSAGE SEND FOR ORDER FAILED START
    // Fetch the order details
    $order = Order::where('order_id', 'AAY241127310286')->first();

    if (!$order || !$order->user_id || !$order->customer_name || !$order->product_name) {
        Log::warning("Incomplete order data for Order ID: $orderid");
        return;
    }

    // Fetch user details
    $user = User::find($order->user_id); // Assuming a `User` model exists

    if (!$user || !$user->mobile) {
        Log::warning("No phone number for user ID: {$order->user_id}");
        return;
    }

    // Prepare WhatsApp message content
    // $productsText = "{$order->product_name} (Qty: {$order->product_quantity})";

    // Prepare dynamic product details
    // $allOrders = Order::where('order_id', $orderid)->get();

    // $productDetails = [];
    // foreach ($allOrders as $allOrder) {
    //     $productDetails[] = "{$allOrder->product_name} (Qty: {$allOrder->product_quantity})";
    // }
    // $productsText = implode(", ", $productDetails);



    $client = new Client();
    $watiApiUrl = "https://live-mt-server.wati.io/356491/api/v1/sendTemplateMessage?whatsappNumber=91{$user->mobile}";
    $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJmMjdmZjAzYS0zMTU0LTRmNTktODA5MC02Zjc5OGNhZDFmNWQiLCJ1bmlxdWVfbmFtZSI6ImluZm9AYWF5dXJqYS5jb20iLCJuYW1laWQiOiJpbmZvQGFheXVyamEuY29tIiwiZW1haWwiOiJpbmZvQGFheXVyamEuY29tIiwiYXV0aF90aW1lIjoiMTEvMjIvMjAyNCAxMDo1MDo1MiIsInRlbmFudF9pZCI6IjM1NjQ5MSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.YPj6NVk8_ocJzjwDpTBSkmfqnqKzgBmvyGGo9cAxQ_c';

    try {
        $response = $client->post($watiApiUrl, [
            'headers' => [
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'template_name' => 'order_failed_temp', // Your WATI template name
                'broadcast_name' => 'order_failed_temp',
                'parameters' => [
                    ['name' => 'name', 'value' => $order->customer_name], // Customer name
                    ['name' => 'order_number', 'value' => $order->order_id], // Order ID
                    // ['name' => 'product_details', 'value' => $productsText], // Product details
                    // ['name' => 'total_price', 'value' => $order->grand_total ?? 'N/A'], // Optional
                    // ['name' => 'delivery_date', 'value' => $order->delivery_date ?? 'To be confirmed'], // Optional
                ],
                'phone_number' => '91' . $user->mobile,
            ],
        ]);

        // Log success
        $responseBody = $response->getBody()->getContents();
        $statusCode = $response->getStatusCode();
        Log::info("Order failed, WhatsApp message sent successfully for Order ID: {$order->order_id} to: {$user->mobile}");
    } catch (\Exception $e) {
        Log::error("Order failed, Failed to send WhatsApp message for Order ID: {$order->order_id} to {$user->mobile}: " . $e->getMessage());
    }
    //WHATSAPP MESSAGE SEND FOR ORDER FAILED END
}

public function redeemPointsByUser(Request $request){

    //TEST CALCULATIONS OF POINTS START
    if(Auth::check())
    {
        $checkTotalPoints = Referral::where('referrer_id', Auth::user()->id)->get();

        $totalPoints = 0;
        if(count($checkTotalPoints) > 0)
        {
            for($i=0;$i<count($checkTotalPoints);$i++)
            {
                $totalPoints += floatval($checkTotalPoints[$i]->reward_value);
            }
        }


        $checkRedeemedPoints = Referral::where('referrer_id', Auth::user()->id)->get();

        $redeemedPoints = 0;
        if(count($checkRedeemedPoints) > 0)
        {
            for($i=0;$i<count($checkRedeemedPoints);$i++)
            {
                $redeemedPoints += floatval($checkRedeemedPoints[$i]->redemed_value);
            }
        }

        $balancePoints = $totalPoints - $redeemedPoints;

    }
    //TEST CALCULATIONS OF POINTS END





    //REFER AND EARN REDEEM POINTS START
    // $coupon = null;
    // $referrerDetails = null;
    // $rewardPointsAfterReferral = null;
    
    // if(Auth::check())
    // {
    //     $user_id = Auth::user()->id;

    //     // $coupon = Coupon::where('user_id', $user_id)->first();
    //     $referrerDetails = Referral::where('referrer_id', $user_id)->get();

    //     // $rewardPointsAfterReferral =  Referral::where('referred_id', $user_id)->get();

    // }

    // $totalPoints = 0;
    
    // if(count($referrerDetails) > 0)
    // {
    //     foreach($referrerDetails as $key => $referrerDetail)
    //     {
    //         $totalPoints += floatval($referrerDetail->reward_value);
    //     }
        
    // }

    if($request->total_amount <= $balancePoints)
    {
        $balancePoints = $request->total_amount;
    }
    //REFER AND EARN REDEEM POINTS END



    Session::put('discount_flat', $balancePoints);
            Session::put('coupon_title', 'REDEEM_POINTS');
            Session::put('discount_type', 'discount_flat');
            

            $discount_type = Session::get('discount_type');
    $discount_flat = Session::get('discount_flat');
    $coupon_title = Session::get('coupon_title');

    return response()->json([
        'message' => 'Points redeem successfully!','discount_flat' => $discount_flat,'discount_type' => $discount_type, 'coupon_title' => $coupon_title
    ], 200);
}



public function getWeightWiseImages(Request $request){
    $ProductVariant = ProductVariants::where('product_id', $request->productId)->where('weight', $request->productWeight)->first();

    $product_image = Product_Image::where('product_variant_id', $ProductVariant->id)->get();

// dd($request->productWeight);

    return response()->json(['message' => 'successful', 'success' => true, 'product_image' => $product_image],200);
}



    public function shipmentTrack(){
        $seo = Seo::all();

        return view('website.shipment_tracking', compact('seo'));
    }

}
