<?php
namespace App\Http\Controllers\Admin;
use App\Category;
use App\Order;
use App\Cart;
use APP\Shipping_address;
use Response;
use Config;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Validator;
use Illuminate\Support\Str;

class AbandonedCartController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    $abandoneddata = DB::table('carts')
    ->leftJoin('users', 'carts.user_id', '=', 'users.id')
    ->select('carts.ssid as cart_ssid', 'carts.*', 'users.*')
    // ->distinct()
    ->get()->unique('user_id');
    // ->get()->unique('ssid');



      return view('admin.abandoned.index', compact('abandoneddata'));
      
       
    }
    
    public function abandonedCartProductDetails($user_id)
    {
        
        
        $products = DB::table('carts')->where('user_id', '=', $user_id)->join('products', function($join)
            {
                $join->on('carts.product_id', '=', 'products.id');
                 
            })
            ->get();
            
        
       // $products = DB::select("SELECT * FROM orders where order_id = '$orderid' order by 'product_id'");
       
        
        return view('admin.abandoned.product_detail',compact('products'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
   

}
