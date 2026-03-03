<?php
namespace App\Http\Controllers\Admin;
use App\Size;
use App\Gcategory;
use App\Designer;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Illuminate\Support\Str;
use Validator;
class DesignerController extends Controller
{
    public function index(){
           // dd('hh');
           if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        $designers = Designer::all();
       // dd($designers);
        return view('admin.designer.index', compact('designers'));
    }

    public function create(){
           // dd('hh');
           if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        return view("admin.designer.create");
    }

    public function store(Request $request){

        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
        $rules = [
            'designer_name' => 'required|string|min:2|max:30',
        ];
        
        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
            return redirect('admin/designer')
            ->withInput()
            ->withErrors($validator);
        }
        else
        {
                $designer = new Designer;
                $designer->designer_name = $request['designer_name'];
                $designer->save();
               // return redirect()->route('admin.blog.index')->with('status',"Designer created successfully...");
                return redirect("admin/designer")->with('status',"Designer created successfully...");;
           
        }
        

    }

    public function edit($id){

        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        // $pcat='App\designer'::findOrFail($id);
        $designers = Designer::where('id',$id)->first();

        return view('admin.designer.edit', compact('designers'));
    }

    
    public function update(Request $request, Designer $designer)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
      
            $form_data = array(
            'designer_name'=> $request->designer_name,
	   
            );

            $designer->update($form_data);

           

            return redirect()->route('admin.designer.index')->with('status',"Designer updated successfully...");
        }
        

    public function destroy( Designer $designer){

        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
        try
        {
           
            $designer->delete();
            return redirect()->route('admin.blog.index')->with('status',"Designer deleted successfully...");
        }
        catch(Exception $e){
            return redirect()->route('admin.blog.index')->with('failed',"operation failed...");
        }
        
    }



    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        Designer::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    
    public static function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
}
