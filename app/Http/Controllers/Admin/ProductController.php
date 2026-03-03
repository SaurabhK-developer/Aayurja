<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Product;
use App\Occasion;
use App\Goal;
use DB;
use App\product_available_size;
use App\Product_Image;
use App\Designer;
use App\Wishlist;
use App\Cart;
use App\Material;
use App\Falavor;
use App\Product_sub_category;
use App\Product_category;
use App\Size;
use Auth;
use Image;
use App\Season;
use App\Composition;
use App\Weave;
use App\Stretch;
use App\Tag;
use App\Type;
use App\ProductVariants;
use App\Metalcolor;
use App\Metalpurity;
use App\Style;
use App\Concern;
use App\Product_color;
use App\Occasioncategory;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if (!empty($search)) {
            $products = Product::where('product_name', 'LIKE', "%{$search}%")->orwhere('design', 'LIKE', "%{$search}%")->paginate(10);
            $search_value = $search;
        } else {
            $products = Product::all();
            $search_value = null;
        }
        $concerns = Concern::get();
        return view('admin.product.index', compact('products', 'search_value','concerns'));
    }

    public function create()
    {
        $category = 'App\Product_category'::all();
        $subcategory = Product_sub_category::all();
        $metal_color=Metalcolor::get();
        $metal_purity=Metalpurity::get();
        $style=Style::get();
        $size = Size::all();
        $tags= Tag::get();
        $flavor= Falavor::get();
        $design=Designer::get();
        $occasion = Occasion::get();
        $concerns = Concern::get();
        $meterial = Material::get();
      
        return view("admin.product.create", compact('category','tags','flavor','size','subcategory','design','metal_purity','metal_color','occasion','style','meterial','concerns'));
    }

    public function getproduct(Request $request)
    {
        $data['product'] = Product::where("product_category", $request->category_id)
            ->get(["product_name", "id"]);
        return response()->json($data);
    }

    

    public function store(Request $request)
    { 
        // dd($request->file('product_images')[1]);

       $fileName1=null;
       $fileName2=null;
       $fileName3=null;
      $fileName4=null;



        $rules = [
            'product_name' => 'required|unique:products|string|min:2|max:100',
            'description' => 'required',
            'concern' => 'required|array', 
            'product_video' => 'nullable|mimes:mp4,mov,avi,wmv,wemb|max:51200', // Max 50MB
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/product/create')->withInput()->withErrors($validator);
        } else {

           
            // if (request()->hasFile('video')) {
            //     $file = request()->file('video');
            //     $fileName2 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            //     $file->move(base_path().'/public/uploads/product/video', $fileName2);    
            // }

            if (request()->hasFile('list_image')) {
                $file = request()->file('list_image');
                $fileName3 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move(base_path().'/public/uploads/product', $fileName3);    
            }


            
        

            
            $tranding = 0;
              if ($request->tranding)
            {
                $tranding = 1;
            }
    
            $best_sellers= 0;
            if ($request->best_sellers) {
                $best_sellers = 1;
            }
      
            $most_popular= 0;
            if ($request->most_popular) {
                $most_popular = 1;
            }

           

            $on_sale = 0;
            if ($request->on_sale) {
                $on_sale = 1;
            }

            if ($request->size=='') {
                $request->size = 0;
            }

           
           // dd($request- all());
           $concern = $request->concern;

           $products = array(
                   
            'product_name' => $request->product_name,
                    'slug' => Str::slug($request->product_name,'-'),
                    'product_category' => $request->product_category,
                    'product_subcategory' => $request->product_subcategory,
                     'offer'=>$request->offer,
                    'first_content' => $request->first_content,
                    'additional_info' => $request->additional_info,
                    'key_benefits' => $request->key_benefits,
                    'description' => $request->description,
                    'outofstock' => $request->isoutofstock,
                    'tranding' => $tranding,
                    'on_sale' => $on_sale,
                    'most_popular' => $most_popular,
                    'concern' => $concern,
                    'best_sellers' => $best_sellers,
                    'list_image' =>$fileName3,
                    'short_description' => $request->short_description,
            
        );


                // $products = Product::create([
                  
                //     'product_name' => $request->product_name,
                //     'slug' => Str::slug($request->product_name,'-'),
                //     'product_category' => $request->product_category,
                //     'product_subcategory' => $request->product_subcategory,
                //      'offer'=>$request->offer,
                //     'first_content' => $request->first_content,
                //     'additional_info' => $request->additional_info,
                //     'key_benefits' => $request->key_benefits,
                //     'description' => $request->description,
                //     'outofstock' => $request->isoutofstock,
                //     'tranding' => $tranding,
                //     'on_sale' => $on_sale,
                //     'most_popular' => $most_popular,
                //     'concern' => $concern,
                //     'best_sellers' => $best_sellers,
                //     'list_image' =>$fileName3,
                //     'product_video' =>$videoPath,
                //     'short_description' => $request->short_description,
                    
                    
                  
                    
                // ]);

                if ($request->hasFile('product_video')) {
                    $video = $request->file('product_video');
                    $fileName2 = time() . '.' . $video->getClientOriginalExtension();
                    $video->move(public_path('uploads/productVideo/'), $fileName2);
                    $videoPath = 'uploads/productVideo/' . $fileName2;
                    $products['product_video'] = $videoPath;    
                } else {
                    $fileName2 = null;
                }

                $products = Product::create($products);



                


               
                foreach ($request->weight as $key => $w) {
                    if (isset($request->outofstock[$key])) {
                        $out_of_stock = 1;
                    } else {
                        $out_of_stock = 0;
                    }
                    ProductVariants::create([
                        'product_id' => $products->id,
                        'category' => $products->product_category,
                        'subcategory' => $products->product_subcategory,
                        'weight' => $w,
                        'price' => $request->price[$key],
                        'discount' => $request->discount[$key],
                        'selling_price' => $request->selling_price[$key],
                        'out_of_stock' => $out_of_stock,
        
                    ]);







                    //MAPPING CODE IMPLEMENT
                    $maxProductVariantID = ProductVariants::max('id');
                   
                    $maxProductID = DB::table('products')->max('id');

                    foreach ($request->file('product_images')[$key] as $imagefile) {
                        $image = new Product_Image;
                        $file_name4 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';
                        //$file_name4 = 'comp' . '_' . self::random_string(20) . '.' . 'webp';
                        $file_width1 = Image::make($imagefile)->width();
                        $file_height1 = Image::make($imagefile)->height();
                        $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                        $constraint->aspectratio(); //maintain image ratio
                        });
                        $compressPath = base_path() . '/public/uploads/product/';
                        $dbImage1Path = '/public/uploads/product/' . $file_name4;
                        $arrImage = explode("blic/", $dbImage1Path);
                        $dbImage1Path = $arrImage[1];
                        $compressd_image1->save($compressPath . $file_name4);
                        $image->url = $dbImage1Path;
                        $image->product_id = $maxProductID;
                        $image->product_variant_id = $maxProductVariantID;
                        $image->save();
                    }
                }
             
                


                //FOR UPLOAD IMAGES END

                return redirect("admin/product/create")->with('status', "Product Added Successfully...");
            }
                
            } 
      
    

    public function edit($id)
    {


        // $pcat='App\Product'::findOrFail($id);

        $product = 'App\Product'::where('id', $id)->first();
        $category = 'App\Product_category'::all();
        //dd($category);
        $subcategory = Product_sub_category::all();
        $tags = Tag::get()->pluck('name', 'id');
        $occasion = Occasion::get()->pluck('name', 'id');
        $size =Size::get()->pluck('size', 'id');
        $flavor=Falavor::get();
        $style = Style::all();
        $design=Designer::get();
        $concerns = Concern::get();
        $metal_color=Metalcolor::get();
        $images = Product_Image::where('product_id', $id)->orderBy('id', 'asc')->get();
        $selectedConcerns = is_array($product->concern) ? $product->concern : explode(',', $product->concern);
        // dd($selectedConcerns[1]);
        return view('admin.product.edit', compact('product', 'category', 'images', 'subcategory','size','tags','occasion','flavor','design','metal_color','style','concerns','selectedConcerns'));
    }

    // public function update(Request $request, $id)
    // {
    // //    $fileName2=null;
    //     $product = 'App\Product'::findOrFail($id);


    //          $tranding = 0;
    //           if ($request->tranding)
    //         {
    //             $tranding = 1;
    //         }
                
    //         $best_sellers= 0;
    //         if ($request->best_sellers) {
    //             $best_sellers = 1;
    //         }

    //         $concern= 0;
    //         if ($request->concern) {
    //             $concern = 1;
    //         }
      
    //         $most_popular= 0;
    //         if ($request->most_popular) {
    //             $most_popular = 1;
    //         }

    //         $on_sale = 0;
    //         if ($request->on_sale) {
    //             $on_sale = 1;
    //         }
    //         if (is_array($request->size)){
    //         $product_size= implode(",",$request->size);
    //         }
    //         else
    //         {  
    //             $product_size="";
    //         }  
            

    //             if ($request->slug == $product->slug) {
    //                 $updated_slug = Str::slug($request->product_name, '-');
    //             } else {
    //                 $updated_slug = Str::slug($request->slug, '-');
    //             }
    //             $updated_by='admin';


                
                

    //             $form_data = array(
                   
    //                 'product_name' => $request->product_name,
    //                 'slug' => $request->slug,
    //                 'product_category' => $request->product_category,
    //                 'product_subcategory' => $request->product_subcategory,
    //                 'offer'=>$request->offer,
    //                 // 'metal_color'=>$request->metal_color,
    //                 // 'gender'=>$request->gender,
    //                 // 'product_tags'=> implode(",",$request->tags),
    //                 // 'occasion'=> implode(",",$request->occasion),
    //                 // 'flavors'=>$request->flavors,
    //                 // 'group_code'=>$request->group_code,
    //                 // 'color_code'=>$request->color_code,
    //                 // 'product_code'=>$request->product_code,
    //                 'first_content' => $request->first_content,
    //                 'additional_info' => $request->additional_info,
    //                 'description' => $request->description,
    //                 'key_benefits' => $request->key_benefits,
    //                 'concern' => $request->concern,
    //                 'outofstock' => $request->isoutofstock,
    //                 'tranding' => $tranding,
    //                 'on_sale' => $on_sale,
    //                 'most_popular' => $most_popular,
    //                 'best_sellers' => $best_sellers,  
    //                 'short_description' => $request->short_description,
    //                 // 'product_video' => $request->product_video,
                    
    //             );
             
    //                 // if (request()->hasFile('viedo')) {
    //                 //     $file = request()->file('background_image');
    //                 //     $fileName2 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
    //                 //     $file->move(base_path().'/public/uploads/product/video', $fileName2); 
    //                 //     $form_data['viedo'] = "$fileName2";   
    //                 // }

    //                 if ($request->hasFile('product_video')) {
    //                     $video = $request->file('product_video');
    //                     $fileName2 = time() . '.' . $video->getClientOriginalExtension();
    //                     $video->move(public_path('uploads/productVideo/'), $fileName2);
    //                     $videoPath = 'uploads/productVideo/' . $fileName2;
    //                     $form_data['product_video'] = "$videoPath";    
    
    //                 }
        
    //                 if (request()->hasFile('list_image')) {
    //                     $file = request()->file('list_image');
    //                     $fileName3 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
    //                     $file->move(base_path().'/public/uploads/product', $fileName3); 
    //                     $form_data['list_image'] = "$fileName3";    
    //                 }

                   

    //             $product->update($form_data);
    //             $old_data = ProductVariants::where('product_id', $product->id)->delete();
    //             $wishlist = Wishlist::where('product_id', $product->id)->delete();
    //             $cart = Cart::where('product_id', $product->id)->delete();
    //             foreach ($request->weight as $key => $w) {
    //                 if (isset($request->outofstock[$key])) {
    //                     $out_of_stock = 1;
    //                 } else {
    //                     $out_of_stock = 0;
    //                 }
    //                 ProductVariants::create([
    //                     'product_id' => $product->id,
    //                     'category' => $product->product_category,
    //                     'subcategory' => $product->product_subcategory,
    //                     'weight' => $w,
    //                     'price' => $request->price[$key],
    //                     'discount' => $request->discount[$key],
    //                     'selling_price' => $request->selling_price[$key],
    //                     'out_of_stock' => $out_of_stock,
        
    //                 ]);
    //             }


    //             if (is_array($request->product_images)) {
    //                 $productimg = Product_Image::where('product_id', $id)->get();
    //                 $oldImageDeleted = FALSE;

    //                 if (count($productimg) > 0) {
    //                     if (is_array($productimg) || is_object($productimg)) {
    //                         for ($i = 0; $i < count($productimg); $i++) {
    //                             // unlink(public_path() . '/' . $productimg[$i]->url);
    //                         }
    //                         $image_database = Product_Image::where('product_id', $id);

    //                         $image_database->delete();
    //                         $oldImageDeleted = TRUE;
    //                     } else {
    //                         foreach ($request->file('product_images') as $imagefile) {
    //                             $image = new Product_Image;

    //                             $file_name3 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';


    //                             $file_width1 = Image::make($imagefile)->width();
    //                             $file_height1 = Image::make($imagefile)->height();

    //                             $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
    //                                 $constraint->aspectratio(); //maintain image ratio
    //                             });


    //                             $compressPath = base_path() . '/public/uploads/product/';

    //                             $dbImage1Path = '/public/uploads/product/' .  $file_name3;

    //                             $arrImage = explode("blic/", $dbImage1Path);
    //                             $dbImage1Path = $arrImage[1];

    //                             $compressd_image1->save($compressPath .  $file_name3);

    //                             $image->url = $dbImage1Path;

    //                             $image->product_id = $id;
    //                             $image->save();
    //                         }
    //                     }
    //                 } else {
    //                     $oldImageDeleted = TRUE;
    //                 }

    //                 if ($oldImageDeleted == TRUE) {
    //                     foreach ($request->file('product_images') as $imagefile) {
    //                         $image = new Product_Image;
    //                          $file_name3 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';


    //                         $file_width1 = Image::make($imagefile)->width();
    //                         $file_height1 = Image::make($imagefile)->height();

    //                         $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
    //                             $constraint->aspectratio(); //maintain image ratio
    //                         });


    //                         $compressPath = base_path() . '/public/uploads/product/';

    //                         $dbImage1Path = '/public/uploads/product/' . $file_name3;

    //                         $arrImage = explode("blic/", $dbImage1Path);
    //                         $dbImage1Path = $arrImage[1];

    //                         $compressd_image1->save($compressPath . $file_name3);

    //                         $image->url = $dbImage1Path;


    //                         $image->product_id = $id;
    //                         $image->save();
    //                     }
    //                 }
    //             }

    //             return redirect('admin/product')->with('status', "Product updated successfully...");
    // }





    /////////////////////// UPDATE NEW START
    public function updateNew(Request $request, $id)
    {
// dd($request->all());

        $product = 'App\Product'::findOrFail($id);

        $tranding = 0;
        if ($request->tranding)
        {
            $tranding = 1;
        }
            
        $best_sellers= 0;
        if ($request->best_sellers) {
            $best_sellers = 1;
        }

        $concern= 0;
        if ($request->concern) {
            $concern = 1;
        }
    
        $most_popular= 0;
        if ($request->most_popular) {
            $most_popular = 1;
        }

        $on_sale = 0;
        if ($request->on_sale) {
            $on_sale = 1;
        }

        if (is_array($request->size)){
        $product_size= implode(",",$request->size);
        }
        else
        {  
            $product_size="";
        }  
            

        if ($request->slug == $product->slug) {
            $updated_slug = Str::slug($request->product_name, '-');
        } else {
            $updated_slug = Str::slug($request->slug, '-');
        }

        $updated_by='admin';


        $form_data = array(
            'product_name' => $request->product_name,
            'slug' => $request->slug,
            'product_category' => $request->product_category,
            'product_subcategory' => $request->product_subcategory,
            'offer'=>$request->offer,
            'first_content' => $request->first_content,
            'additional_info' => $request->additional_info,
            'description' => $request->description,
            'key_benefits' => $request->key_benefits,
            'concern' => $request->concern,
            'outofstock' => $request->isoutofstock,
            'tranding' => $tranding,
            'on_sale' => $on_sale,
            'most_popular' => $most_popular,
            'best_sellers' => $best_sellers,  
            'short_description' => $request->short_description,
        );
             

        if ($request->hasFile('product_video')) {
            $video = $request->file('product_video');
            $fileName2 = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/productVideo/'), $fileName2);
            $videoPath = 'uploads/productVideo/' . $fileName2;
            $form_data['product_video'] = "$videoPath";    
        }

        if (request()->hasFile('list_image')) {
            $file = request()->file('list_image');
            $fileName3 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(base_path().'/public/uploads/product', $fileName3); 
            $form_data['list_image'] = "$fileName3";    
        }

        $product->update($form_data);
        
        $wishlist = Wishlist::where('product_id', $product->id)->delete();
        $cart = Cart::where('product_id', $product->id)->delete();

        // foreach ($request->weight as $key => $w) {
        //     if (isset($request->outofstock[$key])) {
        //         $out_of_stock = 1;
        //     } else {
        //         $out_of_stock = 0;
        //     }
        //     $variant = ProductVariants::create([
        //         'product_id' => $product->id,
        //         'category' => $product->product_category,
        //         'subcategory' => $product->product_subcategory,
        //         'weight' => $w,
        //         'price' => $request->price[$key],
        //         'discount' => $request->discount[$key],
        //         'selling_price' => $request->selling_price[$key],
        //         'out_of_stock' => $out_of_stock,

        //     ]);

        //     foreach($request->weight_id as $weight_id) {
        //         // Update all images to new variant ID
        //         // Product_Image::where('product_variant_id', $weight_id)->update(['product_variant_id' => $variant->id]);
            
        //         // Delete old variant
        //         ProductVariants::where('id', $weight_id)->delete();
        //         // break;
        //     }

        //     Product_Image::whereIn('product_variant_id', $request->weight_id)->update(['product_variant_id' => $variant->id]);



        // foreach ($request->weight as $key => $w) {
        //     $out_of_stock = isset($request->outofstock[$key]) ? 1 : 0;
        
        //     // Create new variant
        //     $variant = ProductVariants::create([
        //         'product_id' => $product->id,
        //         'category' => $product->product_category,
        //         'subcategory' => $product->product_subcategory,
        //         'weight' => $w,
        //         'price' => $request->price[$key],
        //         'discount' => $request->discount[$key],
        //         'selling_price' => $request->selling_price[$key],
        //         'out_of_stock' => $out_of_stock,
        //     ]);
        
        //     // Update images for that specific old variant
        //     if (!empty($request->weight_id[$key])) {
        //         $old_variant_id = $request->weight_id[$key];
        
        //         // Update images mapped to this old variant
        //         Product_Image::where('product_variant_id', $old_variant_id)
        //             ->update(['product_variant_id' => $variant->id]);
        
        //         // Delete the old variant
        //         ProductVariants::where('id', $old_variant_id)->delete();
        //     }
        



        //     foreach ($request->file('product_images')[$key] as $imagefile) {
        //         // ProductVariants::where('product_variant_id', $old_variant_id)->delete();



        //         $image = new Product_Image;
        //         $file_name3 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';

        //         $file_width1 = Image::make($imagefile)->width();
        //         $file_height1 = Image::make($imagefile)->height();

        //         $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
        //             $constraint->aspectratio(); //maintain image ratio
        //         });

        //         $compressPath = base_path() . '/public/uploads/product/';

        //         $dbImage1Path = '/public/uploads/product/' . $file_name3;

        //         $arrImage = explode("blic/", $dbImage1Path);
        //         $dbImage1Path = $arrImage[1];
        //         $compressd_image1->save($compressPath . $file_name3);

        //         $image->url = $dbImage1Path;
        //         $image->product_id = $id;
        //         $image->product_variant_id = $variant->id;
        //         $image->save();
        //     }



        // foreach ($request->weight as $key => $w) {
        //     $out_of_stock = isset($request->outofstock[$key]) ? 1 : 0;
        
        //     // Create new variant
        //     $variant = ProductVariants::create([
        //         'product_id' => $product->id,
        //         'category' => $product->product_category,
        //         'subcategory' => $product->product_subcategory,
        //         'weight' => $w,
        //         'price' => $request->price[$key],
        //         'discount' => $request->discount[$key],
        //         'selling_price' => $request->selling_price[$key],
        //         'out_of_stock' => $out_of_stock,
        //     ]);
        
        //     // Update images from old variant if any
        //     if (!empty($request->weight_id[$key])) {
        //         $old_variant_id = $request->weight_id[$key];
        
        //         Product_Image::where('product_variant_id', $old_variant_id)
        //             ->update(['product_variant_id' => $variant->id]);
        
        //         ProductVariants::where('id', $old_variant_id)->delete();
        //     }
        
        //     // Upload images for this variant
        //     if ($request->hasFile("product_images.$key")) {
        //         foreach ($request->file('product_images')[$key] as $imagefile) {
        //             $image = new Product_Image;
        //             $file_name = md5($imagefile->getClientOriginalName() . time()) . ".webp";
        
        //             $img = Image::make($imagefile->getRealPath())
        //                 ->orientate()
        //                 ->resize(
        //                     Image::make($imagefile)->width(),
        //                     Image::make($imagefile)->height(),
        //                     function ($constraint) {
        //                         $constraint->aspectRatio();
        //                     }
        //                 );
        
        //             $img->save(public_path("uploads/product/") . $file_name);
        
        //             $image->url = "uploads/product/" . $file_name;
        //             $image->product_id = $id;
        //             $image->product_variant_id = $variant->id;
        //             $image->save();
        //         }
        //     }
        


        foreach ($request->weight as $key => $w) {
            $out_of_stock = isset($request->outofstock[$key]) ? 1 : 0;
        
            // Create new variant
            $variant = ProductVariants::create([
                'product_id' => $product->id,
                'category' => $product->product_category,
                'subcategory' => $product->product_subcategory,
                'weight' => $w,
                'price' => $request->price[$key],
                'discount' => $request->discount[$key],
                'selling_price' => $request->selling_price[$key],
                'out_of_stock' => $out_of_stock,
            ]);
        
            // Update images for the old variant and delete the old variant
            if (!empty($request->weight_id[$key])) {
                $old_variant_id = $request->weight_id[$key];
        
                // Move images to new variant
                Product_Image::where('product_variant_id', $old_variant_id)
                    ->update(['product_variant_id' => $variant->id]);
        
                // Delete old variant
                ProductVariants::where('id', $old_variant_id)->delete();
            }
        
            // Upload new images for this specific variant
            if ($request->hasFile("product_images.$key")) {
                // Delete existing images from database and file system
                $existingImages = Product_Image::where('product_variant_id', $variant->id)->get();
                foreach ($existingImages as $img) {
                    $imagePath = public_path($img->url);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
        
                // Delete from DB
                Product_Image::where('product_variant_id', $variant->id)->delete();
        
                // Save new images
                foreach ($request->file('product_images')[$key] as $imagefile) {
                    $image = new Product_Image;
                    $file_name = md5($imagefile->getClientOriginalName() . time()) . ".webp";
        
                    $img = Image::make($imagefile->getRealPath())
                        ->orientate()
                        ->resize(
                            Image::make($imagefile)->width(),
                            Image::make($imagefile)->height(),
                            function ($constraint) {
                                $constraint->aspectRatio();
                            }
                        );
        
                    $uploadPath = public_path("uploads/product/");
                    $img->save($uploadPath . $file_name);
        
                    $image->url = "uploads/product/" . $file_name;
                    $image->product_id = $product->id;
                    $image->product_variant_id = $variant->id;
                    $image->save();
                }
            }
        



            // if (is_array($request->product_images)) {
            //     $productimg = Product_Image::where('product_id', $id)->get();
            //     $oldImageDeleted = FALSE;
    
            //     if (count($productimg) > 0) {
            //         if (is_array($productimg) || is_object($productimg)) {
            //             for ($i = 0; $i < count($productimg); $i++) {
            //             }
            //             $image_database = Product_Image::where('product_id', $id);
    
            //             $image_database->delete();
            //             $oldImageDeleted = TRUE;
            //         } else {
            //             foreach ($request->file('product_images') as $imagefile) {
            //                 $image = new Product_Image;
    
            //                 $file_name3 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';
    
            //                 $file_width1 = Image::make($imagefile)->width();
            //                 $file_height1 = Image::make($imagefile)->height();
    
            //                 $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
            //                     $constraint->aspectratio(); //maintain image ratio
            //                 });
    
    
            //                 $compressPath = base_path() . '/public/uploads/product/';
    
            //                 $dbImage1Path = '/public/uploads/product/' .  $file_name3;
    
            //                 $arrImage = explode("blic/", $dbImage1Path);
            //                 $dbImage1Path = $arrImage[1];
    
            //                 $compressd_image1->save($compressPath .  $file_name3);
    
            //                 $image->url = $dbImage1Path;
    
            //                 $image->product_id = $id;
            //                 $image->save();
            //             }
            //         }
            //     } else {
            //         $oldImageDeleted = TRUE;
            //     }
    
            //     if ($oldImageDeleted == TRUE) {
            //         foreach ($request->file('product_images') as $imagefile) {
            //             $image = new Product_Image;
            //             $file_name3 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';
    
            //             $file_width1 = Image::make($imagefile)->width();
            //             $file_height1 = Image::make($imagefile)->height();
    
            //             $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
            //                 $constraint->aspectratio(); //maintain image ratio
            //             });
    
            //             $compressPath = base_path() . '/public/uploads/product/';
    
            //             $dbImage1Path = '/public/uploads/product/' . $file_name3;
    
            //             $arrImage = explode("blic/", $dbImage1Path);
            //             $dbImage1Path = $arrImage[1];
    
            //             $compressd_image1->save($compressPath . $file_name3);
    
            //             $image->url = $dbImage1Path;
    
    
            //             $image->product_id = $id;
            //             $image->save();
            //         }
            //     }
            // }


            
        }

        // if (is_array($request->product_images)) {
        //     $productimg = Product_Image::where('product_id', $id)->get();
        //     $oldImageDeleted = FALSE;

        //     if (count($productimg) > 0) {
        //         if (is_array($productimg) || is_object($productimg)) {
        //             for ($i = 0; $i < count($productimg); $i++) {
        //             }
        //             $image_database = Product_Image::where('product_id', $id);

        //             $image_database->delete();
        //             $oldImageDeleted = TRUE;
        //         } else {
        //             foreach ($request->file('product_images') as $imagefile) {
        //                 $image = new Product_Image;

        //                 $file_name3 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';

        //                 $file_width1 = Image::make($imagefile)->width();
        //                 $file_height1 = Image::make($imagefile)->height();

        //                 $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
        //                     $constraint->aspectratio(); //maintain image ratio
        //                 });


        //                 $compressPath = base_path() . '/public/uploads/product/';

        //                 $dbImage1Path = '/public/uploads/product/' .  $file_name3;

        //                 $arrImage = explode("blic/", $dbImage1Path);
        //                 $dbImage1Path = $arrImage[1];

        //                 $compressd_image1->save($compressPath .  $file_name3);

        //                 $image->url = $dbImage1Path;

        //                 $image->product_id = $id;
        //                 $image->save();
        //             }
        //         }
        //     } else {
        //         $oldImageDeleted = TRUE;
        //     }

        //     if ($oldImageDeleted == TRUE) {
        //         foreach ($request->file('product_images') as $imagefile) {
        //             $image = new Product_Image;
        //             $file_name3 = md5($imagefile->getClientOriginalName() . time()) . "." . 'webp';

        //             $file_width1 = Image::make($imagefile)->width();
        //             $file_height1 = Image::make($imagefile)->height();

        //             $compressd_image1 = Image::make($imagefile->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
        //                 $constraint->aspectratio(); //maintain image ratio
        //             });

        //             $compressPath = base_path() . '/public/uploads/product/';

        //             $dbImage1Path = '/public/uploads/product/' . $file_name3;

        //             $arrImage = explode("blic/", $dbImage1Path);
        //             $dbImage1Path = $arrImage[1];

        //             $compressd_image1->save($compressPath . $file_name3);

        //             $image->url = $dbImage1Path;


        //             $image->product_id = $id;
        //             $image->save();
        //         }
        //     }
        // }

        return redirect('admin/product')->with('status', "Product updated successfully...");
    }
    //////////////////////  UPDATE NEW END






    public function destroy($id)
{
    try {
        $checkImage = false;
        $checkWishlist = false;
        $checkCart = false;
        $checkAvailableSize = true;  // Assuming it's not needed unless specified

        // Fetch related records
        $productImages = Product_Image::where('product_id', $id)->get();
        $wishlists = Wishlist::where('product_id', $id)->get();
        $carts = Cart::where('product_id', $id)->get();

        // Handle Product Images
        if ($productImages->count() > 0) {
            foreach ($productImages as $image) {
                // Uncomment this line if you want to delete the images from the filesystem
                // unlink(public_path() . '/' . $image->url);
            }

            Product_Image::where('product_id', $id)->delete();
            $checkImage = true;
        } else {
            $checkImage = true;
        }

        // Handle Wishlist
        if ($wishlists->count() > 0) {
            Wishlist::where('product_id', $id)->delete();
            $checkWishlist = true;
        } else {
            $checkWishlist = true;
        }

        // Handle Cart
        if ($carts->count() > 0) {
            Cart::where('product_id', $id)->delete();
            $checkCart = true;
        } else {
            $checkCart = true;
        }

        // Check all conditions before deleting the product
        if ($checkImage && $checkWishlist && $checkCart && $checkAvailableSize) {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                return redirect('admin/product')->with('status', "Product deleted successfully.");
            } else {
                return redirect('admin/product')->with('failed', "Product not found.");
            }
        }

    } catch (Exception $e) {
        return redirect('admin/product')->with('failed', "Operation failed: " . $e->getMessage());
    }
}



    
   

   
    public function massDestroy(Request $request)
    {
       //dd('hi');
         Product::whereIn('id', request('ids'))->delete();
         Product_Image::whereIn('product_id', request('ids'))->delete();
         Wishlist::where('product_id', request('ids'))->delete();
         Cart::where('product_id', request('ids'))->delete();
        return response()->noContent();
    }




}