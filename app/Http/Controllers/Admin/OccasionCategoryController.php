<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Occasioncategory;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Gate;

class OccasionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }

        $occasioncategory = Occasioncategory::all();

        return view('admin.occasioncategory.index', compact('occasioncategory'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }
    //    $category = Product_category::get()->pluck('name', 'id');
        return view('admin.occasioncategory.create');
        
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }
        //  $validator = Validator::make($request->all(), [
        //   'image' => 'dimensions:width=1349,height=400',
        //   ]);
        //     if ($validator->fails()){
        //     return back()->withErrors("You Have to upload 1349X400 size image")->withInput();
        //  }
         
         
       if(\App\Occasioncategory::where('name', '=', $request->name)->exists()){
           return view('admin.occasioncategory.create');
       }
        
        if(Auth::check())
        {   
            $approved = 0;
            // $updated_by = Auth::user()->name;
            
            // if(!empty($updated_by) && $updated_by != 'Super User')
            // {
            //     $approved = 0;
            // }
            // else
            // {
            //     $approved = 1;
            // }
        }
       
        $slug = Str::slug($request->name,'-');
        $occasioncategory = Occasioncategory::create([
            'name'=> $request->name,
            'slug' =>$slug,
			'approved' =>$approved,
        ]);

       
        return redirect()->route('admin.occasioncategory.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Occasioncategory $occasioncategory)
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }
      
    //   $category = Product_category::get()->pluck('name', 'id');

        return view('admin.occasioncategory.edit', compact('occasioncategory'));
      
       
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occasioncategory $occasioncategory)
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }
        
        if(Auth::check())
        {   
            $approved = 0;
            // $updated_by = Auth::user()->name;
            
            // if(!empty($updated_by) && $updated_by != 'Super User')
            // {
            //     $approved = 0;
            // }
            // else
            // {
            //     $approved = 1;
            // }
        }
         
        $slug = Str::slug($request->name,'-');
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $slug,
               'approved'=> $approved,
             );
         
        $occasioncategory->update($form_data);
      
        return redirect()->route('admin.occasioncategory.index');
    }

    public function show(Occasioncategory $occasioncategory)
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }

       

        return view('admin.occasioncategory.show', compact('occasioncategory'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occasioncategory $occasioncategory)
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }

        $occasioncategory->delete();

        return redirect()->route('admin.occasioncategory.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        // if (! Gate::allows('categories_manage')) {
        //     return abort(401);
        // }
        Occasioncategory::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
