<?php
namespace App\Http\Controllers\Admin;
use App\Size;
use App\Gcategory;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Illuminate\Support\Str;
use Validator;

class sizeController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $sizes = Size::all();

        return view('admin.size.index', compact('sizes'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.size.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(request $request)
    {
        
    
             $size = Size::create([
                'size'=> $request->size,
                'slug'=> Str::slug($request->size,"-")
        	]);

       
        return redirect()->route('admin.size.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        
       
        return view('admin.size.edit', compact('size'));
    }
    
    
   
   

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
      

      /*  $slider->update($request->all());*/
        
         $form_data = array(
             'size'=> $request->size,
             'slug'=> Str::slug($request->size,"-")
            
			);
			 
        
        $size->update($form_data);
      
        return redirect()->route('admin.size.index');
        
    }




    public function show(Size $size)
    {
        if (! Gate::allows('gallery-manage')) {
            return abort(401);
        }

       

        return view('admin.Size.show', compact('size'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // $size->delete();
        Size::where('id','=', $id)->delete();

        return redirect()->route('admin.size.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        
        size::whereIn('id', request('ids'))->delete();
        

        return response()->noContent();
    }

}
