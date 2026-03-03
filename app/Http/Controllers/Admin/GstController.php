<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Product_category;
use App\Product;
use App\GstManagement;



class GstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gst = GstManagement::get();
        return view('admin.gst.index',compact('gst'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $products=Product::get();

        // return view("admin.gst.create", compact('products'));

        $gstProductIds = GstManagement::pluck('product_id')->toArray();

        $products = Product::whereNotIn('id', $gstProductIds)->get();

        return view("admin.gst.create", compact('products'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        foreach ($request->product_ids as $productId) {
            GstManagement::create([
                'product_id'     => $productId,
                'hsn_code'       => $request->hsn_code,
                'gst_percentage' => $request->gst_percentage,
            ]);
        }

        return redirect('admin/gst/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($gst_id)
    {
        $gst=GstManagement::where('id', $gst_id)->first();
        $products=Product::get();

        // dd($gst->hsn_code);

        return view("admin.gst.edit", compact('gst','products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $gst = GstManagement::findOrFail($request->gst_id);

        $gst->update([
            'hsn_code' => $request->hsn_code,
            'gst_percentage' => $request->gst_percentage,
        ]);

       
        return redirect('admin/gst/index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
