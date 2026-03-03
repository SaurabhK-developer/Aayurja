<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product_sub_category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Product_category;
use Image;

class ProductsubCategoryController extends Controller
{
    public function index(){
        
        $pro_category = 'App\Product_sub_category'::all();
      //  dd($pro_category);
        return view('admin.product-sub-category.index', compact('pro_category'));
    }

    public function create(){
      
        $product_category=Product_category::get();
     //dd($product_category);
        return view("admin.product-sub-category.create",compact('product_category'));
    }

    public function store(Request $request){
       
        
      
        $fileName=null;
        $fileName2=null;
        $fileName3=null;
        
        $rules = [
            'name' => 'required|string|min:2|max:30',
        ];
        
        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
            return redirect('admin/product_category')
            ->withInput()
            ->withErrors($validator);
        }
  
        else if(\App\Product_sub_category::where('name', '=', $request->name)->whereIn('main_cat_id', $request->main_cat_id)->exists()){
            return redirect('admin/product-sub-category/create')->with('failed'," Already Exists  ...");
          
        }





        else
        {
            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." .'webp';
        
                $file_width = Image::make($file)->width();
                $file_height = Image::make($file)->height();
                $compressd_image = Image::make($file->getRealPath())->orientate()->resize($file_width, $file_height, function ($constraint) {
                $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image->save('./public/uploads/catrgory/'.$fileName);
                // $file->move('./public/uploads/', $fileName1);
               
            }

            if (request()->hasFile('image1')) {
                $file = request()->file('image1');
                $fileName2 = md5($file->getClientOriginalName() . time()) . "." .'webp';
    
                $file_width1 = Image::make($file)->width();
                $file_height1 = Image::make($file)->height();
                $compressd_image2 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image2->save('./public/uploads/catrgory/'.$fileName2);

            }
            if (request()->hasFile('image2')) {
                $file = request()->file('image2');
                $fileName3 = md5($file->getClientOriginalName() . time()) . "." .'webp';
    
                $file_width1 = Image::make($file)->width();
                $file_height1 = Image::make($file)->height();
                $compressd_image3 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image3->save('./public/uploads/catrgory/'.$fileName3);
            }

            

            try{ 
                foreach ($request->main_cat_id as $key=> $main_cat_ids) {
                $category = new Product_sub_category;
                $category->name = $request['name'];
                $category->main_cat_id = $main_cat_ids;
                $category->slug = $request['slug'];
                $category->image = $fileName;
                $category->image1 = $fileName2;
                $category->image2 = $fileName3;           
                $category->save();
            }
                return redirect("admin/product-sub-category")->with('status',"Category created successfully...");
                }
           
            catch(Exception $e){
                return redirect('admin/product-sub-category')->with('failed',"operation failed...");
            }


            
        }
        

    }

    public function edit($id){
        // $pcat='App\Product_category'::findOrFail($id);
        $category=Product_category::get();
        $sub_category='App\Product_sub_category'::where('id',$id)->first();

        return view('admin.product-sub-category.edit', compact('sub_category','category'));
    }

    
  public function update(Request $request, $id)
{
    try {
        $category = 'App\Product_sub_category'::findOrFail($id);

        foreach ($request->main_cat_id as $main_cat_id) {
               $form_data = array(
                'main_cat_id' => $main_cat_id,
                'name' => $request->name,
                'slug' => $request->slug,
            );

            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . 'webp';
                $file_width = Image::make($file)->width();
                $file_height = Image::make($file)->height();
                $compressd_image = Image::make($file->getRealPath())->orientate()->resize($file_width, $file_height, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image->save('./public/uploads/catrgory/' . $fileName);
                $form_data['image'] = "$fileName";
            }

            if (request()->hasFile('image1')) {
                $file = request()->file('image1');
                $fileName2 = md5($file->getClientOriginalName() . time()) . "." . 'webp';
                $file_width1 = Image::make($file)->width();
                $file_height1 = Image::make($file)->height();
                $compressd_image1 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image1->save('./public/uploads/catrgory/' . $fileName2);
                $form_data['image1'] = "$fileName2";
            }

            if (request()->hasFile('image2')) {
                $file = request()->file('image2');
                $fileName3 = md5($file->getClientOriginalName() . time()) . "." . 'webp';
                $file_width1 = Image::make($file)->width();
                $file_height1 = Image::make($file)->height();
                $compressd_image1 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image1->save('./public/uploads/catrgory/' . $fileName3);
                $form_data['image2'] = "$fileName3";
            }

            // Create a new category object for each main category ID
            // $new_category = new Product_category();
            // $new_category->fill($form_data);
            // $new_category->save();
            $category->update($form_data);
        }

        return redirect('admin/product-sub-category')->with('status', "Category updated successfully...");
    } catch (Exception $e) {
        return redirect('adminproduct-sub-category')->with('failed', "operation failed...");
    }
}

    public function destroy($id){
        try
        {
            $category = Product_sub_category::find($id);    
            $category->delete();
            return redirect('admin/product-sub-category')->with('status',"Category deleted successfully...");
        }
        catch(Exception $e){
            return redirect('admin/product-sub-category')->with('failed',"operation failed...");
        }
        
    }
    
    public function massDestroy(Request $request)
    {
       
      
      $r='App\Product_sub_category'::whereIn('id', request('ids'))->delete();
    
        return response()->noContent();
    }



    public static function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
    
}
