<?php
namespace App\Http\Controllers\Admin;
use App\Category;
use App\Sitemap;
use App\Brand;
use App\Robot;
use App\Blog;
use App\Tag;
use App\Author;
use App\Subcategory;
use App\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class RobotController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $robots  = 'App\Robot'::all();

        return view('admin.robot.index', compact('robots'));
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
        
        
       return view('admin.robot.create');
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
      
             $sitemap = Robot::create([
                'title'=> $request->title,
                'description'=> $request->description,
    		    
        	]);

       
        return redirect()->route('admin.robot.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Robot $robot)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        
        return view('admin.robot.edit', compact('robot'));
    }
    
    
   

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Robot $robot)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

           $form_data = array(
            'title'=> $request->title,
           'description'=> $request->description,
            
		
        );
        
      
       
        
        
        $robot->update($form_data);
      
        return redirect()->route('admin.robot.index');
    }
    
    
    
    
    
    
    

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Robot $robot)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $robot->delete();

        return redirect()->route('admin.robot.index');
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
        robot::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
