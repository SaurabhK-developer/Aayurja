<?php

namespace App\Http\Controllers\Admin;

use App\Offer;
use App\Product;
use App\Product_offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OffersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::all();
        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products= Product::where('active','=',1)->get();
        return view('admin.offers.create',compact('products'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        try{
         $fileName5=null;
         if (request()->hasFile('image4')) {
            $file = request()->file('image4');
            $fileName5 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path().'/uploads/coupon/', $fileName5);  
            
            $request['image'] = $fileName5;    
        }

        $request['brief'] = $request->brief;
        $request['description'] = $request->description;


        if(\App\Offer::where('title', '=', $request->title)
            ->where('type','=',$request->type)
            ->exists()){

          return redirect()->back()->withErrors(["errors" => "Record already exists in system!"]);

       }
        $request['valid_upto'] = date("Y-m-d",strtotime($request->valid_upto));
        $request['WED'] = date("Y-m-d",strtotime($request->valid_from));
        
        if($request->limitupto == null){
            $request['limitupto'] = 0;    
        }
        
        
        if($request->type == 3){
            
            if(Offer::where('type',3)->where('deactive',0)->count() > 0){
                return back()->withInput()
                       ->withErrors(['message' => 'Another global offer already exists.']);
            }
            
            if($request->global_offer_amount != ''){
                $request['discount'] = $request->global_offer_amount;
            }elseif($request->global_offer_percent != ''){
                $request['discount'] = $request->global_offer_percent;
            }
            
            Offer::create($request->except(['_token','valid_from','global_disc_percent','global_offer_amount','global_offer_percent','product','image4']));    
        }else{
           $offer_id=Offer::insertGetId($request->except(['_token','valid_from','global_disc_percent','global_offer_amount','global_offer_percent','product','image4']));  
        if($request->type == 8)
        {
            $products_id= $request->product;
            foreach ($products_id as $product_id) {
                Product_offer::create(['offer_id'=>$offer_id,'product_id'=>$product_id]); 
              };
    };
};
        //return redirect()->route('admin.offers.index');
        return redirect()->route('admin.offers.index')
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
    public function edit(Offer $offer)
    {
        $products= Product::where('active','=',1)->get();
        return view('admin.offers.edit', compact('offer','products'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        try{

            $fileName5=null;

         if (request()->hasFile('image4')) {
            $file = request()->file('image4');
            $fileName5 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path().'/uploads/coupon/', $fileName5);  
            
            $request['image'] = $fileName5;    
        }

        $request['brief'] = $request->brief;
        $request['description'] = $request->description;


        if(\App\Offer::where('title', '=', $request->title)
            ->where('id','!=',$offer->id)
            ->exists()){

          return redirect()->back()->withErrors(["errors" => "Record already exists in system!"]);

       }
        $request['valid_upto'] = date("Y-m-d",strtotime($request->valid_upto));
        $request['WED'] = date("Y-m-d",strtotime($request->valid_from));
        
          if($request->limitupto == null){
            $request['limitupto'] = 0;    
        }
        
          if($request->type == 3){
            
            if($request->global_offer_amount != ''){
                $request['discount'] = $request->global_offer_amount;
            }elseif($request->global_offer_percent != ''){
                $request['discount'] = $request->global_offer_percent;
            }
            
            
            $offer->update($request->except(['valid_from','global_disc_percent','global_offer_amount','global_offer_percent','image4']));    
        }else{
            $offer->update($request->except(['valid_from','image4']));    
        }
        return redirect()->route('admin.offers.index')
                           ->with('success_message', 'Record successfully added.');
      } catch (Exception $exception) {

          return back()->withInput()
                       ->withErrors(['unexpected_error' => $exception->getMessage()]);
      }
    }

    public function show(Offer $offer)
    {
        return view('admin.offers.show', compact('offer'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->route('admin.offers.index');
    }
    
    
      public function deactivate_offer(Request $request,$id)
    {
        $offer = Offer::findOrFail($id);
        $data = array('deactive'=> 1);
        $offer->update($data);
        return redirect()->route('admin.offers.index');
    }
    
    public function activate_offer(Request $request,$id)
    {
        $offer = Offer::findOrFail($id);
        $data = array('deactive'=> 0);
        $offer->update($data);
        return redirect()->route('admin.offers.index');
    }

}
