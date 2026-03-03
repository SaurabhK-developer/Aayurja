<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Brand;
use App\Testimonials;
use App\Slider;
use App\Offer;
use App\Subcategory;
use App\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Validator;

class sliderController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd('hh');
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $sliders = 'App\Slider'::all();

        return view('admin.slider.index', compact('sliders'));
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
        return view('admin.slider.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
         
         $fileName1=null;
         
        if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName1 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./public/uploads/', $fileName1);    
    }
       
  
             $slider = 'App\Slider'::create([
            'title'=> $request->title,
            'image' =>$fileName1,
		    
		
			
        ]);

       
        return redirect()->route('admin.slider.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
      //  dd($testimonial);
       
        return view('admin.slider.edit', compact('slider'));
    }
    
    
   
   

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

      /*  $slider->update($request->all());*/
        
         $form_data = array(
             'title'=> $request->title,
            
			);
			 if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName1 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./public/uploads/', $fileName1);
        $form_data['image'] = "$fileName1";
        }
        $slider->update($form_data);
      
        return redirect()->route('admin.slider.index');
        
    }




    public function show(Slider $slider)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

       

        return view('admin.slider.show', compact('slider'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $slider->delete();

        return redirect()->route('admin.slider.index');
    }

    /**
     * Delete all selected User at once
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        Product::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
