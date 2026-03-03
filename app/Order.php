<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
    protected $fillable = ['order_id','user_id','ssid','customer_name','customer_email','customer_phone','customer_alt_phone','shipping_address','billing_address','product_id','product_name','product_quantity','product_color','product_size','size_id','per_product_price','total','discount_percentage','coupon_used','discount_amount','subtotal','taxes','shipping_method','shipping_charges','grand_total','reference_no','status','transation_code','providerReferenceId','payment_source','invoice_no','shipping_pincode','shipping_state'];
    
    public function productsizetab(){
      return $this->belongsTo(product_available_size::class, 'size_id','id');
    }
}
