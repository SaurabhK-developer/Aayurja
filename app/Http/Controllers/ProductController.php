<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\MasterTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Mail;
use Config;
use Response;
use DB;
use App\Blog;
use App\Seo;

use App\ProductVariants;
use App\Product;
use App\Cart;
use App\Product_Image;
use App\Product_category;
use App\Designer;
use App\Rating;
use App\Subcategory;
class ProductController extends Controller
{
   use MasterTrait;
     public function ajaxSearch(Request $request)
    {
        // dd($request->all());
         $sorts = $request->sorts;
         $price_search=$request->price_search;
        $minprice = $request->minprice;
         $maxprice = $request->maxprice;   
         
        $category = $request->category;
        $product_type = $request->product_type;
        $designer = $request->designer;
        $occasion_value = $request->occasion_value;
        
        // dd($product_type);
        
        if($price_search == "price_search" && $sorts == "product_relevance" && $category == null && $product_type == null && $designer == null && $occasion_value == 0) 
        {
        // dd('a');                    
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
        
            $products = Product::where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();   
            
        }
        elseif($price_search == "price_search" && $sorts == "product_price_low_high" && $category == null && $product_type == null && $designer == null && $occasion_value == 0)
        {
            // dd('b');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'asc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_high_low" && $category == null && $product_type == null && $designer == null && $occasion_value == 0)
        {
            // dd('c');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'desc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_latest" && $category == null && $product_type == null && $designer == null && $occasion_value == 0)
        {
            // dd('d');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_relevance" && $category != null && $product_type != null && $designer == null && $occasion_value == 0)
        {
            // dd('e');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_low_high" && $category != null && $product_type != null && $designer == null && $occasion_value == 0)
        {
            // dd('f');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'asc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_high_low" && $category != null && $product_type != null && $designer == null && $occasion_value == 0)
        {
            // dd('g');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'desc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_latest" && $category != null && $product_type != null && $designer == null && $occasion_value == 0)
        {
            // dd('h');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_relevance" && $category == null && $product_type == null && $designer != null && $occasion_value == 0)
        {
            // dd('i');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_low_high" && $category == null && $product_type == null && $designer != null && $occasion_value == 0)
        {
            // dd('j');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'asc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_high_low" && $category == null && $product_type == null && $designer != null && $occasion_value == 0)
        {
            // dd('k');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'desc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_latest" && $category == null && $product_type == null && $designer != null && $occasion_value == 0)
        {
            // dd('k');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_relevance" && $category == null && $product_type == null && $designer == null && $occasion_value != 0)
        {
            // dd('l');                
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
        
            $products = Product::where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();   
            
        }
        elseif($price_search == "price_search" && $sorts == "product_price_low_high" && $category == null && $product_type == null && $designer == null && $occasion_value != 0)
        {
            // dd('m');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'asc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_high_low" && $category == null && $product_type == null && $designer == null && $occasion_value != 0)
        {
            // dd('n');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'desc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_latest" && $category == null && $product_type == null && $designer == null && $occasion_value != 0)
        {
            // dd('o');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_relevance" && $category != null && $product_type != null && $designer == null && $occasion_value != 0)
        {
            // dd('p');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_low_high" && $category != null && $product_type != null && $designer == null && $occasion_value != 0)
        {
            // dd('q');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'asc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_high_low" && $category != null && $product_type != null && $designer == null && $occasion_value != 0)
        {
            // dd('r');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'desc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_latest" && $category != null && $product_type != null && $designer == null && $occasion_value != 0)
        {
            // dd('s');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $categories = Product_category::where('slug', '=' , $category)->first();
            $producttypes = Subcategory::where('slug','=', $product_type)->first();
            
            $products = Product::where('product_category', '=' , $categories->id)->where('type_of_product', '=', $producttypes->id)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_relevance" && $category == null && $product_type == null && $designer != null && $occasion_value != 0)
        {
            // dd('t');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_low_high" && $category == null && $product_type == null && $designer != null && $occasion_value != 0)
        {
            // dd('u');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'asc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_price_high_low" && $category == null && $product_type == null && $designer != null && $occasion_value != 0)
        {
            // dd('v');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('price', 'desc')->orderBy('id', 'desc')->get();
        }
        elseif($price_search == "price_search" && $sorts == "product_latest" && $category == null && $product_type == null && $designer != null && $occasion_value != 0)
        {
            // dd('w');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
            
            $products = Product::where('designer_name', '=' , $designer)->where('ocassions', '=', $occasion_value)->where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();
        }
        else 
        {
            // dd('x');
            $min = $minprice;
            $max = $maxprice;
                            
            $min = (int)$min;
            $max = (int)$max;
        
            $products = Product::where('approved', 1)->whereBetween('price', [$min, $max])->orderBy('id', 'desc')->get();   
            
        }



//   elseif ($sorts == "product_price_low_high") {
//       $products = Product::where('product_category', '2')->orderBy('price', 'asc')->paginate(12);
//      // $products->orderBy('price','asc')->paginate(10);
//   } elseif ($sorts == "product_price_high_low") {
//       $products = Product::where('product_category', 'Women')->orderBy('price','desc')->paginate(12);
//   } elseif ($sorts == "product_latest") {
//      $products = Product::where('product_category', 'Women')->orderBy('products.id','desc')->paginate(12);
//   } elseif ($sorts == "product_relevance") {
//       $products = Product::where('product_category', 'Women')->paginate(12);
      
//   }

    $gridView = $request->gridView;
    $listView = $request->listView;

    return view('website.productgridsort',compact('products','gridView','listView'));
   
    }
    
    
    public function get_data(Request $request)
    {
        $search = $request->get('term');

        $result = Product::with('firstimage','variants_price_desc')->where('product_name', 'LIKE', '%' . $search . '%')->get();

        // $blogs = \App\Blog::where('title', 'LIKE', '%' . $search . '%')->get();

        // $mergedCollection = $result->concat($blogs);
        $mergedCollection = $result;

        

        if ($mergedCollection->count() > 0) {
            return response()->json($mergedCollection);
        } else {
            $collection = collect([
                ['title' => 'No record found.', 'status' => 0, 'slug' => 'error-404', 'image' => NULL],
            ]);
            return response()->json($collection);
        }
    }

    //side search
    public function get_datasidesearch(Request $request)
    {
        $agent = new \Jenssegers\Agent\Agent;
        $results = $agent->isMobile();
        if ($results) {
            $product_num = '6';
        } else {
            $product_num = '12';
        }
        $search = $request->get('term');
        $results = 'App\Product'::with('image_path')->where('active', 1)
            ->where('product_name', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $request->get('term') . '%')
            ->get()->take('5');

        //   $results = 'App\Product'::with('Product_images',function ($query) use ($product_id){
        //             $query->where('product_id',$product_id)->
        //             $query->orderBy('image_order','asc');
        //   })->where('active',1)
        //   ->where('name', 'LIKE', '%'. $search. '%')
        //   ->orWhere('short_description', 'LIKE', '%'. $request->get('term'). '%')
        //   ->get()->take('5');

        $results = \DB::table('products')
            ->select(
                DB::raw('(select product_images.url from product_images where product_images.product_id=products.id order by image_order asc limit 1) as imgname'),
                DB::raw('(select categories.slug from categories where categories.id=products.category_id) as category_slug'),
                'products.*'
            )
            ->where('products.active', 1)
            ->where('products.name', 'LIKE', '%' . $search . '%')
            ->orWhere('short_description', 'LIKE', '%' . $request->get('term') . '%')
            ->take(5)
            ->get();

        return response()->json($results);
    }
    



    public function get_blog(Request $request)

    {

         $search = $request->get('term');
          $data = Blog::where('title', 'LIKE', '%' . $search . '%')
          
          ->get();
          
            return response()->json($data);
  
              

    } 


    public function get_discount(Request $request)

    {
        $product_id = $request->get('product_id');
        $data = ProductVariants::where('product_id', $product_id)->take(1)->get()->pluck('discount');
        return response()->json($data);
    }

}