<?php
namespace App\Http\Controllers\Admin;
use App\Material;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $materials = Material::all();
        

        return view('admin.material.index', compact('materials'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
      
        return view('admin.material.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
       if(\App\Material::where('name', '=', $request->name)->exists()){
           return view('admin.material.create');
       }
       
        $slug = Str::slug($request->name,'-');
        $categories = Material::create([
            'name'=> $request->name,
            'slug' =>$slug,
			
        ]);

       
        return redirect()->route('admin.material.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
       
       //dd($category);
        return view('admin.material.edit', compact('material'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
      
        
         
        $slug = Str::slug($request->name,'-');
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $slug,
             ); 
        $material->update($form_data);
      
        return redirect()->route('admin.material.index');
    }

    public function show(Material $material)
    {
      
        return view('admin.material.show', compact('material'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
    

        $material->delete();

        return redirect()->route('admin.material.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
       
        Material::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
