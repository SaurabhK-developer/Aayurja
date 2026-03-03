<?php
namespace App\Http\Controllers\Admin;
use App\Currentprice;
use App\Material;
use App\Metalpurity;
use App\Product_sub_category;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Illuminate\Support\Str;
use Validator;
class DropdownController extends Controller
{


    public function fetchpurity(Request $request)
    {
       // dd('hi');
        $data['purity'] = Metalpurity::where("material_id", $request->material_id)
                                ->get(["name", "id"]);
  
        return response()->json($data);
    }

    public function fetchprice(Request $request)
    {
    //    dd($request->all());
        $data = Currentprice::where("material_id", $request->material_id)->where("purity_id", $request->purity_id)->first();
        // $data = Currentprice::get();

        //dd($data->current_price);
  
        return response()->json($data);
    }
   


    public function getSubcategory(Request $request)
    {
   
        $data['subcategorydropdown'] = Product_sub_category::where("main_cat_id", $request->main_category_id)->get(["name", "id"]);
       
  
        return response()->json($data);
    }
    
}

