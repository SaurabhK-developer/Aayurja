<?php

namespace App\Http\Controllers\Admin;
use App\Product_category;
use App\Product;
use App\flavourmappings;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Illuminate\Support\Str;

class FlavourController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $flavourmappings = flavourmappings::all();

        return view('admin.flavours.index', compact('flavourmappings'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        
        $products = Product::get()->pluck('product_name', 'id');
        $category = Product_category::get()->pluck('name', 'id');
       

        return view('admin.flavours.create',compact('products','category'));
    }
    
    public function getProductImageById(Request $request)
    {
        
        
        $images = 'App\Product_Image'::where('product_id', $request->id)->orderBy('id', 'asc')->get();
        return response()->json(['status' => 200, 'data' => $images]);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if (! Gate::allows('categories_manage')) {
           return abort(401);
       }
        
       $flavourmappings = flavourmappings::all();
            
       if(\App\flavourmappings::where('productid', '=', $request->productid)->where('flavour', '=', $request->flavour)->exists()){
           return view('admin.flavours.index',compact('flavourmappings'));
       }
       
       
       $data = [
            'productid' => $request->productid,
             'flavour' => $request->flavour,
             'out_of_stock' => $request->out_of_request ? $request->out_of_request :0,
             'image_id' => $request->image_id,
            ];
          
       flavourmappings::create($data);
        
       return redirect()->route('admin.flavours.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        
        $flavourmappings = flavourmappings::find($id);
        $images = 'App\Product_Image'::where('product_id', $flavourmappings->productdetails->id)->get();
       

        return view('admin.flavours.edit', compact('flavourmappings','images'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        
        $data = [
             'flavour' => $request->flavour,
             'out_of_stock' => $request->out_of_request ? $request->out_of_request :0,
             'image_id' => $request->image_id,
            ];
            
        flavourmappings::where('id',$id)->update($data);
      
        return redirect()->route('admin.flavours.index');
    }

    
    public function destroy($id)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        flavourmappings::find($id)->delete();

        return redirect()->route('admin.flavours.index');
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
        Subcategory::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
