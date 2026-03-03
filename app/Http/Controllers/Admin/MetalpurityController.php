<?php
namespace App\Http\Controllers\Admin;
use App\Metalpurity;
use App\Material;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class MetalpurityController extends Controller
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

        $metalpuritys = Metalpurity::all();
   // dd($metalpuritys);
        
        return view('admin.metalpurity.index',compact('metalpuritys'));
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
        $materials = Material::all();
        return view('admin.metalpurity.create',compact('materials'));
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
    
       if(\App\Metalpurity::where('name', '=', $request->name)->where('material_id', '=', $request->material_id)->exists()){
        return redirect('admin/metalpurity/create')->with('failed'," Already Exists  ...");
       }
       
        $slug = Str::slug($request->name,'-');
        $categories = Metalpurity::create([
            'name'=> $request->name,
            'slug' =>$slug,
           'material_id' =>$request->material_id,
			
        ]);

       
        return redirect()->route('admin.metalpurity.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Metalpurity $metalpurity)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        $materials = Material::all();
       //dd($category);
        return view('admin.metalpurity.edit', compact('metalpurity','materials'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metalpurity $metalpurity)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
     
         
        $slug = Str::slug($request->name,'-');
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $slug,
               'material_id' =>$request->material_id,
             ); 
        $metalpurity->update($form_data);
      
        return redirect()->route('admin.metalpurity.index');
    }

    public function show(Metalpurity $metalpurity)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        return view('admin.style.show', compact('metalpurity'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metalpurity $metalpurity)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $metalpurity->delete();

        return redirect()->route('admin.metalpurity.index');
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
        Metalpurity::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
