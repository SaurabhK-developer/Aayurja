<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use App\Product;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderby('id', 'desc')->paginate(10);
    	return view('admin.coupon.index', compact('coupons'));
    }
    
    public function create()
    {
        $products = Product::all();
       
    	return view('admin.coupon.create', compact('products'));
    }
   
    
    public function store(Request $request)
    {
        // dd($request->all());
        $coupon = new Coupon;
        $coupon->title = $request->coupon;
        $coupon->discription  = $request->discription;
        $coupon->discount_type = $request->discount_type;
        
        if($request->discount_type == 'discount_percentage')
        {
            $coupon->discount_percentage = $request->discount_percentage;
        }
        else if($request->discount_type == 'discount_flat')
        {
            $coupon->discount_flat = $request->discount_flat;
        }
        else{
            $coupon->discount_percentage = $request->discount_percentage;
            $product_id = [];
            $coupon->product = implode(',', $request->product_id);
            
        }
        
        $coupon->valid_from = $request->valid_from;
        $coupon->valid_upto = $request->valid_upto;
        $coupon->limit_upto = $request->limit_upto;
        $coupon->active = $request->status;
        $coupon->save();
        
    	return redirect()->back()->with('status', 'Coupon created successfully...');
    }
    
    public function edit($id, Request $request)
    {   
        $coupon = Coupon::where('id', $id)->first();
        $products = Product::get()->pluck('product_name', 'id');
       // dd($products);
    	return view('admin.coupon.edit', compact('coupon','products'));
    }
    
    public function update($id, Request $request)
    {
        $coupon = Coupon::where('id', $id)->first();
        $coupon->title = $request->coupon;
        $coupon->discription  = $request->discription;
        $coupon->discount_type = $request->discount_type;

        if($request->discount_type == 'discount_percentage')
        {
            $coupon->discount_percentage = $request->discount_percentage;
            $coupon->discount_flat = null;
        }
        else if($request->discount_type == 'discount_flat')
        {
            $coupon->discount_flat = $request->discount_flat;
            $coupon->discount_percentage = null;
        }
        else{
            $coupon->discount_flat = null;
            $product_id = [];
            $coupon->product = implode(',', $request->product_id);
             $coupon->discount_percentage = $request->discount_percentage;

            
        }



        
        $coupon->valid_from = $request->valid_from;
        $coupon->valid_upto = $request->valid_upto;
        $coupon->limit_upto = $request->limit_upto;
        $coupon->active = $request->status;
        $coupon->update();
        
    	return redirect()->back()->with('status', 'Coupon updated successfully...');
    }
}
