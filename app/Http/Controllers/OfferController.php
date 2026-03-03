<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Response;
use DB;
use Log;
use App\Http\Controllers\Traits\MasterTrait;


class OfferController extends Controller
{
   use MasterTrait;

    public function find_coupon_type(Request $request)
    {
        $cupon_code = $request->coupon;
        $check = 'App\Offer'::where('title', $cupon_code)->first();

        if ($check) {
            $status = 201;
            $type = $check->type;
        } else {
            
            $status = 401;
            $type = 0;
        }

        return response()->json(["status" => $status, "type" => $type]);
    }

    public function apply_coupon_amount_code(Request $request)
    {
        Session::forget('current_offer_id');
        $cupon_code =  $request->cupon;
        $date = date("Y-m-d");
        $check = 'App\Offer'::where('title', $cupon_code)->where('type', '5')->where('deactive', 0)->where('valid_upto', '>', $date)->count();

        if ($check) {
            $data = $this->singleData("\App\Offer", ["title" => $cupon_code, "type" => 5]);
            $status = 201;
            $discount = $data->discount;
            $cupon_id = $data->id;
        } else{
            $status = 401;
            $discount = '0';
            $cupon_id = 0;
        }

        if (!empty(session('currencyfactor'))) {
            $discount = round($discount * session('currencyfactor'), 2);
        }
        Session::put('current_offer_id', $cupon_id);
        Session::put('removecoupon', 0);

        return response()->json(["status" => $status, "discount" => $discount, 'cupon_id' => $cupon_code, "check" => $check]);
    }

    public function apply_cupon_code_on_product(Request $request)
    {
        Session::forget('current_offer_id');
        $cupon_code =  $request->cupon;
        $date = date("Y-m-d");
        $check = 'App\Offer'::where('title', $cupon_code)->where('type', '8')->where('deactive', 0)->where('valid_upto', '>=', $date)->count();
       
        if ($check) {
            $usage_check = 'App\Offer'::where('title', $cupon_code)->where('type', '8')->where('deactive', 0)->where('valid_upto', '>=', $date)->where('limitupto', '>', '0')->first();
            if(!$usage_check){
                $status = 401;
                $discount = '0';
                $cupon_id = 0;
                $product_id = 0;
                $message = 'limit_is_0';
            }else{
            // $order_count = 'App\Order'::where('offer_id', $usage_check->id)->get();
            // $offer_count = $order_count->count();
            // $limit_coupon = $usage_check->limitupto;
            //     if($offer_count < $limit_coupon){
                    $data = $this->singleData("\App\Offer", ["title" => $cupon_code, "type" => 8]);
                    $product_id ='App\Product_offer'::where('offer_id', $data->id)->pluck('product_id')->toArray();
                    $status = 201;
                    $discount = $data->discount;
                    $product_id = $product_id;
                    $cupon_id = $data->id;
                    $message= 'coupon_found';
                // }else{
                //     $status = 401;
                //     $discount = '0';
                //     $product_id = 0;
                //     $cupon_id = 0;
                //     $message = 'limit_reached';
                // }
            }
        }else{
            $status = 401;
            $discount = '0';
            $cupon_id = 0;
            $product_id = 0;
            $message = 'invalid_coupon';
        }
        Session::put('current_offer_id', $cupon_id);
        Session::put('removecoupon', 0);
        return response()->json(["status" => $status, "discount" => $discount,"product_id"=>$product_id, 'cupon_id' => $cupon_code, "check" => $check, "message" =>  $message]);
    }

    public function apply_cupon_code_for_free_product(Request $request)
    {
        Session::forget('current_offer_id');
        $cupon_code =  $request->cupon;
        $date = date("Y-m-d");
        $check = 'App\Offer'::where('title', $cupon_code)->where('type', '9')->where('deactive', 0)->where('valid_upto', '>=', $date)->count();
       
        if ($check) {
            $usage_check = 'App\Offer'::where('title', $cupon_code)->where('type', '9')->where('deactive', 0)->where('valid_upto', '>=', $date)->where('limitupto', '>', '0')->first();
            if(!$usage_check){
                $status = 401;
                $discount = '0';
                $cupon_id = 0;
                $product_id = 0;
                $message = 'limit_is_0';
            }else{
            // $order_count = 'App\Order'::where('offer_id', $usage_check->id)->get();
            // $offer_count = $order_count->count();
            // $limit_coupon = $usage_check->limitupto;
            //     if($offer_count < $limit_coupon){
                    $data = $this->singleData("\App\Offer", ["title" => $cupon_code, "type" => 9]);
                    $product = "App\Product"::where('id', $data->product_id)->first();
                    $status = 201;
                    $discount = $data->discount;
                    $product_id = $product;
                    $cupon_id = $data->id;
                    $message= 'coupon_found';
                // }else{
                //     $status = 401;
                //     $discount = '0';
                //     $product_id = 0;
                //     $cupon_id = 0;
                //     $message = 'limit_reached';
                // }
            }
        }else{
            $status = 401;
            $discount = '0';
            $cupon_id = 0;
            $product_id = 0;
            $message = 'invalid_coupon';
        }
        Session::put('current_offer_id', $cupon_id);
        Session::put('removecoupon', 0);
        return response()->json(["status" => $status, "discount" => $discount,"product_id"=>$product_id, 'cupon_id' => $cupon_code, "check" => $check, "message" =>  $message]);
    }


    public function apply_cupon_code(Request $request)
    {
        Session::forget('current_offer_id');
        $refer_by = null;
        $cupon_code =  $request->cupon;
        $date = date("Y-m-d");
        
        $check = 'App\Offer'::where('title', $cupon_code)->where('type', 1)->where('deactive', 0)
            ->where('valid_upto', '>=', $date)
            ->where('limitupto', '>', '0')
            ->count();
        if ($check) {
            $usage_check = 'App\Offer'::where('title', $cupon_code)
            ->where('type', 1)->where('deactive', 0)
            ->where('valid_upto', '>=', $date)
            ->where('limitupto', '>', '0')
            ->first();
           
            if(!$usage_check){
                $status = 401;
                $discount = '0';
                $cupon_id = 0;
                $product_id = 0;
                $message = 'limit_is_0';
            }else{        
                // $order_count = 'App\Order'::where('offer_id', $usage_check->id)->get();
                // $offer_count = $order_count->count();
                // $limit_coupon = $usage_check->limitupto;

                // if($offer_count < $limit_coupon){
                    $data = 'App\Offer'::where('title', $cupon_code)->where('type', 1)->first();
                    // $product_id ='App\Product'::where('category_id', 23)->pluck('id')->toArray();
                    $product_id =[];
                    $status = 201;
                    $discount = $data->discount;
                    $cupon_id = $data->id;
                    $product_id = $product_id;
                    $product_id = array_merge($product_id, [188,192]);
                    $message= 'coupon_found';
                // }else{
                //     $status = 401;
                //     $discount = '0';
                //     $cupon_id = 0;
                //     $product_id = 0;
                //     $message = 'limit_reached';
                // }
            }
        }else{
            $status = 401;
            $discount = '0';
            $product_id = 0;
            $cupon_id = 0;
            $message = 'invalid_coupon';
        }
        Session::put('current_offer_id', $cupon_id);
        Session::put('removecoupon', 0);

        return response()->json(["status" => $status,"product_id"=>$product_id, "discount" => $discount, 'cupon_id' => $cupon_code, "check" => $check, "message" =>  $message]);
    }

    public function forgetSessionOfferId(){
        Session::forget('current_offer_id');
    }
    
}
