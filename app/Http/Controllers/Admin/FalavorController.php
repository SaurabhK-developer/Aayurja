<?php
namespace App\Http\Controllers\Admin;
use App\Size;
use App\Gcategory;
use App\Falavor;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Illuminate\Support\Str;
use Validator;
class FalavorController extends Controller
{
    public function index(){
          //  dd('hh');
    
        $falavors = Falavor::all();
        
       // dd($falavors);
        return view('admin.falavor.index', compact('falavors'));
    }

    public function create(){
           // dd('hh');
           if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        return view("admin.falavor.create");
    }

    public function store(Request $request){

        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
        $rules = [
            'name' => 'required|string|min:2|max:30',
        ];
        
        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
            return redirect('admin/falavor')
            ->withInput()
            ->withErrors($validator);
        }
        else
        {
                $falavor = new Falavor;
                $falavor->name = $request['name'];
                $falavor->save();
               // return redirect()->route('admin.blog.index')->with('status',"Designer created successfully...");
                return redirect("admin/falavor")->with('status',"falavor created successfully...");;
           
        }
        

    }

    public function edit($id){

        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        // $pcat='App\designer'::findOrFail($id);
        $falavors = Falavor::where('id',$id)->first();

        return view('admin.falavor.edit', compact('falavors'));
    }

    
    public function update(Request $request, Falavor $falavor)
    {
        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
      
            $form_data = array(
            'name'=> $request->name,
	   
            );

            $falavor->update($form_data);

           

            return redirect()->route('admin.falavor.index')->with('status',"falavor updated successfully...");
        }
        

    public function destroy( Falavor $falavor){

        if (! Gate::allows('categories_manage')) {
            return abort(401);
        }
        
        try
        {
           
            $falavor->delete();
            return redirect()->route('admin.falavor.index')->with('status',"falavor deleted successfully...");
        }
        catch(Exception $e){
            return redirect()->route('admin.falavor.index')->with('failed',"operation failed...");
        }
        
    }



    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
        Falavor::whereIn('id', request('ids'))->delete();

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
