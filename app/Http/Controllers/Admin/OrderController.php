<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Brand;
use App\Order;
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
use Image;
use Illuminate\Support\Str;

class OrderController extends Controller
{
public function index()
     {
         $orders = Order::orderby('id', 'desc')->get()->unique('order_id');
         
         return view('admin.order.index',compact('orders'));
     }

     public function admin_order_details($orderid)
     {
         $orders = DB::select("SELECT * FROM orders where order_id = '$orderid' order by 'product_id'");
        
        
         //$orders = Order::where('order_id', $orderid)->get()->groupBy('order_id');
       
         return view('admin.order.details',compact('orders'));
     }


     public function Genrate_invoice()
     {
      // dd('hi');  
     return view('admin.order.generate_invoice');

     }
}
