<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product_category;
use App\Occasion;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;
use Auth;
use Image;

class OccasionController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $occasion = Occasion::all();

        return view('admin.occasion.index', compact('occasion'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
    //    $category = Product_category::get()->pluck('name', 'id');
        return view('admin.occasion.create');
        
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        // dd($request->all());
        $fileName2=null;
        $fileName3=null;
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        //  $validator = Validator::make($request->all(), [
        //   'image' => 'dimensions:width=1349,height=400',
        //   ]);
        //     if ($validator->fails()){
        //     return back()->withErrors("You Have to upload 1349X400 size image")->withInput();
        //  }
         
         
       if(\App\Occasion::where('name', '=', $request->name)->exists()){
           return view('admin.occasion.create');
       }
        
       
       if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName2 = md5($file->getClientOriginalName() . time()) . "." .'webp';
        $file_width1 = Image::make($file)->width();
        $file_height1 = Image::make($file)->height();
        $compressd_image2 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
            $constraint->aspectratio(); //maintain image ratio
        });
        $compressd_image2->save('./public/uploads/occasion/'.$fileName2);

    }

    if (request()->hasFile('image1')) {
        $file = request()->file('image1');
        $fileName3 = md5($file->getClientOriginalName() . time()) . "." .'webp';
        $file_width1 = Image::make($file)->width();
        $file_height1 = Image::make($file)->height();
        $compressd_image2 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
            $constraint->aspectratio(); //maintain image ratio
        });
        $compressd_image2->save('./public/uploads/occasion/'.$fileName3);

    }
        $slug = Str::slug($request->name,'-');
        $occasion = Occasion::create([
            'name'=> $request->name,
            'slug' =>$slug,
            'image' => $fileName2,
            'image1' => $fileName3,
        ]);

       
        return redirect()->route('admin.occasion.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Occasion $occasion)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
      
    //   $category = Product_category::get()->pluck('name', 'id');

        return view('admin.occasion.edit', compact('occasion'));
      
       
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, Occasion $occasion)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
       
         
        $slug = Str::slug($request->name,'-');
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $slug,
             
              
             );
             if (request()->hasFile('image')) {
                $file = request()->file('image');
                $fileName2 = md5($file->getClientOriginalName() . time()) . "." .'webp';
                $file_width1 = Image::make($file)->width();
                $file_height1 = Image::make($file)->height();
                $compressd_image1 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image1->save('./public/uploads/occasion/'.$fileName2);
                // $file->move('./public/uploads/', $fileName1);
                $form_data['image'] = "$fileName2";
        
            }

            if (request()->hasFile('image1')) {
                $file = request()->file('image1');
                $fileName3 = md5($file->getClientOriginalName() . time()) . "." .'webp';
                $file_width1 = Image::make($file)->width();
                $file_height1 = Image::make($file)->height();
                $compressd_image1 = Image::make($file->getRealPath())->orientate()->resize($file_width1, $file_height1, function ($constraint) {
                    $constraint->aspectratio(); //maintain image ratio
                });
                $compressd_image1->save('./public/uploads/occasion/'.$fileName3);
                $form_data['image1'] = "$fileName3";
        
            }
        $occasion->update($form_data);
      
        return redirect()->route('admin.occasion.index');
    }

    public function show(Occasion $occasion)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

       

        return view('admin.occasion.show', compact('occasion'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(occasion $occasion)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $occasion->delete();

        return redirect()->route('admin.occasion.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        Occasion::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}