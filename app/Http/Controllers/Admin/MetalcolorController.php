<?php
namespace App\Http\Controllers\Admin;
use App\Metalcolor;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class MetalcolorController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd('hh');
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $metalcolors = Metalcolor::all();
   // dd($metalcolors);
        
        return view('admin.metalcolor.index',compact('metalcolors'));
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
      
        return view('admin.metalcolor.create');
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
    
       if(\App\Metalcolor::where('name', '=', $request->name)->exists()){
           return view('admin.metalcolor.create');
       }
       
        $slug = Str::slug($request->name,'-');
        $categories = Metalcolor::create([
            'name'=> $request->name,
            'slug' =>$slug,
			
        ]);

       
        return redirect()->route('admin.metalcolor.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Metalcolor $metalcolor)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
       //dd($category);
        return view('admin.metalcolor.edit', compact('metalcolor'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metalcolor $metalcolor)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
         
        $slug = Str::slug($request->name,'-');
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $slug,
             ); 
        $metalcolor->update($form_data);
      
        return redirect()->route('admin.metalcolor.index');
    }

    public function show(Metalcolor $metalcolor)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        return view('admin.style.show', compact('metalcolor'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metalcolor $metalcolor)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $metalcolor->delete();

        return redirect()->route('admin.metalcolor.index');
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
        Metalcolor::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
