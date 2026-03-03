<?php
namespace App\Http\Controllers\Admin;
use App\Style;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class StyleController extends Controller
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

        $styles = Style::all();
        //dd($styles);

        return view('admin.style.index', compact('styles'));
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
      
        return view('admin.style.create');
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
    
       if(\App\Style::where('name', '=', $request->name)->exists()){
           return view('admin.style.create');
       }
       
        //$slug = Str::slug($request->name,'-');
        $categories = Style::create([
            'name'=> $request->name,
            'slug' =>$request->slug,
			
        ]);

       
        return redirect()->route('admin.style.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Style $style)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
       //dd($category);
        return view('admin.style.edit', compact('style'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Style $style)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
         
       
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $request->slug,
             ); 
        $style->update($form_data);
      
        return redirect()->route('admin.style.index');
    }

    public function show(Style $style)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        return view('admin.style.show', compact('style'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Style $style)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $style->delete();

        return redirect()->route('admin.style.index');
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
        Style::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
