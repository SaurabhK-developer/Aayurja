<?php
namespace App\Http\Controllers\Admin;

use App\Goal;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class GoalsController extends Controller
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

        $goals = Goal::all();

        return view('admin.goal.index', compact('goals'));
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
      
        return view('admin.goal.create');
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
        try{
        if(\App\Goal::where('name', '=', $request->name)->exists()){

          return redirect()->back()->withErrors(["errors" => "Record already exists in system!"]);

       }       
       $fileName5=null;
       if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName1 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./public/uploads/goal', $fileName1);    
    }
        $slug = Str::slug($request->name,'-');
        $categories = Goal::create([
            'name'=> $request->name,
            'slug' =>$slug,
            'image' =>$fileName1,
			
        ]);
       
        return redirect()->route('admin.goals.index')
                           ->with('success_message', 'Record successfully added.');
      } catch (Exception $exception) {

          return back()->withInput()
                       ->withErrors(['unexpected_error' => $exception->getMessage()]);
      }
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
       //dd($category);
        return view('admin.goal.edit', compact('goal'));
    }

    
    public function update(Request $request, Goal $goal)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
        try{
        if(\App\Goal::where('name', '=', $request->name)
        ->where('id','!=',$goal->id)->exists()){

          return redirect()->back()->withErrors(["errors" => "Record already exists in system!"]);

       } 
       
         $slug = Str::slug($request->name,'-');
         $form_data = array(
               'name'=> $request->name,
               'slug'=> $slug,
             );

             if (request()->hasFile('image')) {
                $file = request()->file('image');
                $fileName1 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./public/uploads/goal', $fileName1);
                $form_data['image'] = "$fileName1";
                }
        $goal->update($form_data);
      
       
        return redirect()->route('admin.goals.index')
                           ->with('success_message', 'Record successfully added.');
      } catch (Exception $exception) {

          return back()->withInput()
                       ->withErrors(['unexpected_error' => $exception->getMessage()]);
      }
    }

    public function show(Goal $goal)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

       

        return view('admin.goal.show', compact('goal'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }

        $goal->delete();

        return redirect()->route('admin.goals.index');
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
        Goal::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
