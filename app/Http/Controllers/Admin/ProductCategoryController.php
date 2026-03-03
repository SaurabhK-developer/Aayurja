<?php

namespace App\Http\Controllers\Admin;

use App\Product_category;
use App\Category;
use App\Subcategory;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Illuminate\Support\Str;
use Auth;
use Image;


class ProductCategoryController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd('dfsdfdf');
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $categories = Product_category::get();
        return view('admin.product-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('aa');
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
      

        return view('admin.product-categories.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $fileName2=null;
        
       if(\App\Product_category::where('name', '=', $request->name)->exists()){
          $category = Product_category::get()->pluck('name', 'id');
           return view('admin.product-categories.create',compact('category'));
       }
       
       if (request()->hasFile('image')) {
        $file = request()->file('image');
        
        $fileName2 = md5($file->getClientOriginalName() . time()) . "." .'webp';
        
        $file_width1 = Image::make($file)->width();
        $file_height1 = Image::make($file)->height();
        $compressd_image2 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
            $constraint->aspectratio(); //maintain image ratio
        });
        $compressd_image2->save('./public/uploads/productcategory/'.$fileName2);
        
    }
        
        $data = [
            'name' => $request->name,
            'shop_page_title' => $request->shop_page_title,
            'shop_page_desc' => $request->shop_page_desc,
             'category_id' => $request->category_id,
             'slug' => Str::slug($request->name,'-'),
             'image' => $fileName2,
            ];
          
            Product_category::create($data);
         return redirect()->route('admin.product_categories.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_category $product_category)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
       
        // $category = Product_category::get()->pluck('name', 'id');

        return view('admin.product-categories.edit', compact('product_category'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_category $product_category)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
        // $slug = Str::slug($request->name,'-');
        
    
        $data = [
            'name' => $request->name,
            'shop_page_title' => $request->shop_page_title,
            'shop_page_desc' => $request->shop_page_desc,
             'slug' => Str::slug($request->name,'-'),
            ];

            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $fileName2 = md5($file->getClientOriginalName() . time()) . "." .'webp';
                $file_width1 = Image::make($file)->width();
                $file_height1 = Image::make($file)->height();
                $compressd_image1 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image1->save('./public/uploads/productcategory/'.$fileName2);
                // $file->move('./public/uploads/', $fileName1);
                $data['image'] = "$fileName2";
        
            }

        $product_category->update($data);
        //$subcategory->update($request->all());
      
        return redirect()->route('admin.product_categories.index');
    }

    public function show(Product_category $product_category)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        return view('admin.product_categories.show', compact('product_category'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_category $product_category)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $product_category->delete();

        return redirect()->route('admin.product_categories.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        product_category::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
