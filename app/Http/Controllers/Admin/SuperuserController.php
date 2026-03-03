<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Subcategory;
use App\Designer;
use App\Occasion;

class SuperuserController extends Controller
{
    public function approvalIndex()
    {
        $products = Product::where('approved', 0)->get();
        $subcategories = Subcategory::where('approved', 0)->get();
        $designers = Designer::where('approved', 0)->get();
        $occasions = Occasion::where('approved', 0)->get();
        
        return view('admin.approval.index', compact('products','subcategories','designers','occasions'));
    }
    
    public function productsApproval(Request $request)
    {
        $products = Product::where('id', $request->id)->update(['approved' => 1]);

        return redirect()->back();
    }
    
    public function subcategoriesApproval(Request $request)
    {
        $subcategories = Subcategory::where('id', $request->id)->update(['approved' => 1]);

        return redirect()->back();
    }
    
    public function designersApproval(Request $request)
    {
        $designers = Designer::where('id', $request->id)->update(['approved' => 1]);

        return redirect()->back();
    }
    
    public function occasionsApproval(Request $request)
    {
        $occasions = Occasion::where('id', $request->id)->update(['approved' => 1]);

        return redirect()->back();
    }
}
