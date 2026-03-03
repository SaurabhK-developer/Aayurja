<?php
namespace App\Http\Controllers\Admin;
use App\Type;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $types = Type::all();
        //dd($types);

        return view('admin.type.index', compact('types'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
      
        return view('admin.type.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
       if(\App\Type::where('name', '=', $request->name)->exists()){
           return view('admin.type.create');
       }
       
        $slug = Str::slug($request->name,'-');
        $categories = Type::create([
            'name'=> $request->name,
            'slug' =>$slug,
			
        ]);

       
        return redirect()->route('admin.type.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
       
       //dd($category);
        return view('admin.type.edit', compact('type'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
      
        
         
        $slug = Str::slug($request->name,'-');
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $slug,
             ); 
        $type->update($form_data);
      
        return redirect()->route('admin.type.index');
    }

    public function show(Type $type)
    {
      
        return view('admin.type.show', compact('type'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
    

        $type->delete();

        return redirect()->route('admin.type.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
       
        Type::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
