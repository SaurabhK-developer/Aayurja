<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Brand;
use App\Tag;
use App\Author;
use App\Deal;
use App\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class DealController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $deal= 'App\Deal'::all();

        return view('admin.deal.index', compact('deal'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $product = Product::get();
      
        
       return view('admin.deal.create', compact('product'));
    }

   
    public function store(request $request)
    {
        
      
         $fileName1=null;
        
        
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $fileName1 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./public/uploads/deal', $fileName1);    
        }
       
    
             $deals = Deal::create([
                'product_id'=> $request->product_id,
                'discount'=> $request->discount,
                'start_date'=> $request->start_date,
                'end_date'=> $request->end_date,
                'previous_discount'=> $request->previous_discount,
    		    'image' =>$fileName1,
        	]);

       
        return redirect()->route('admin.deal.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
       
         $product= Product::get()->pluck('product_name', 'id');
       
        return view('admin.deal.edit', compact('product','deal'));
    }
    
    
   

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        
     
        
           $form_data = array(
            'product_id'=> $request->product_id,
            'discount'=> $request->discount,
            'start_date'=> $request->start_date,
            'end_date'=> $request->end_date,
            'previous_discount'=> $request->previous_discount,
            
		
        );
        
        if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName1 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./public/uploads/deal', $fileName1);
        $form_data['image'] = "$fileName1";
        }
        
        
        $deal->update($form_data);
      
        return redirect()->route('admin.deal.index');
    }
    
    
    
    
    
    
    
    

    public function show(Deal $deal)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

       

        return view('admin.deal.show', compact('deal'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {

        $deal->delete();

        return redirect()->route('admin.deal.index');
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
        Deal::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }




}
