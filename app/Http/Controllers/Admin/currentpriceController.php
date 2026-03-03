<?php
namespace App\Http\Controllers\Admin;
use App\Product_category;
use App\Category;
use App\Currentprice;
use App\Material;
use Carbon\Carbon;
use App\ProductVariants;
use App\Metalpurity;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Illuminate\Support\Str;
use Auth;
class currentpriceController extends Controller
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

        $currentprice = Currentprice::get();
        return view('admin.currentprice.index', compact('currentprice'));
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
        $meterial = Material::get()->pluck('name', 'id');
        $purity=Metalpurity::get()->pluck('name', 'id');;
        return view('admin.currentprice.create',compact('meterial','purity'));
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
        
        $check = Currentprice::where('material_id', $request->meterial_id)->where('purity_id', $request->purity_id)->count();

        if($check > 0){
            $notification = array(
                'message' => 'Gold Price Already Exist  ',
                'alert-type' => 'error'
            );
        }
        
        else {
           
        $data = [
             'material_id' => $request->meterial_id,
             'purity_id' => $request->purity_id,
             'current_price' => $request->current_price,
            
            ];
          
            
            Currentprice::create($data);

            $notification = array(
                'message' => 'Successfully update Gold Price',
                'alert-type' => 'success'
            );
            
        
       
        }

         return redirect()->route('admin.currentprice.index')->with($notification);
         
       
       
  

    }
    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currentprice $currentprice)
    {

       
       // dd('hi');
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $meterial = Material::get()->pluck('name', 'id');
        $purity=Metalpurity::get()->pluck('name', 'id');

       
       
       //currentprices

        return view('admin.currentprice.edit', compact('meterial','purity','currentprice'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currentprice $currentprice)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }
      
        $data = [
            'material_id' => $request->meterial_id,
            'purity_id' => $request->purity_id,
            'current_price' => $request->current_price,
            'updated_at' => Carbon::now(),
           ];
           $affected=$currentprice->update($data);
          
            if($affected > 0)
            { 
              $goldprice=$currentprice->current_price;
             $results = ProductVariants::where('meterial',$request->meterial_id)->where('purity',$request->purity_id)->get();
             foreach ($results as $result) {
                $goldprice=$currentprice->current_price;
                $gold_weight=$result->weight;
                $making=$result->making_charge;
                $stone_price =$result->stone_price;
                $making_charge_type=$result->making_charge_type;
                $discount=$result->discount;
                $gst=$result->gst;


              

                  $totalachulprice = ($goldprice * $gold_weight) + $stone_price;
                  if($making_charge_type == 1)
                  {
                  $totalmakingcharge = $totalachulprice * $making/100;
                  }
                  else{
                    $totalmakingcharge = $making ;
                  }
                  $afterdescountmaking = $totalmakingcharge - ($totalmakingcharge * $discount/100);
                  
                  $subtotaltemp= $totalachulprice  + $totalmakingcharge  ;
                  $subtotal=$subtotaltemp + ($subtotaltemp * $gst/100);
                  $selling_pricetemp= $totalachulprice + $afterdescountmaking;
                  $selling_price = $selling_pricetemp + ($selling_pricetemp*$gst/100);
                   
                  $dataup = [
                    'metal_price' =>$goldprice,
                    'price' => $subtotal,
                    'selling_price' => $selling_price,
                    'updated_at' => Carbon::now(),
                   ];


                   $updateOrder = ProductVariants::find($result->id)->update($dataup);

                 
            }

            $notification = array(
                'message' => 'Successfully update Gold Price',
                'alert-type' => 'success'
            );
            

        } 
        
        else{

            $notification = array(
                'message' => ' Gold Price Update Error',
                'alert-type' => 'error'
            );
            

        }
           
       // return redirect()->back()->with($notification);
        return redirect()->route('admin.currentprice.index')->with($notification);
    }

    public function show(Subcategory $subcategory)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

       

        return view('admin.currentprice.show', compact('currentprice'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currentprice $currentprice)
    {
        if (! Gate::allows('subcategories_manage')) {
            return abort(401);
        }

        $currentprice->delete();

        return redirect()->route('admin.currentprice.index');
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
        Currentprice::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
