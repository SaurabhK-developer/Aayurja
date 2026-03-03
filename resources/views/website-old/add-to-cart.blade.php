@include('website.header')

<section class="about-banner banner-area ">
   <img src="{{url('website/images/add-to-cart.png')}}">
   <div class="container">
      <div class="content-wrap">
         <h1 class="banner-title">Cart</h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">  <a href="add-to-cart">Cart</a>  </li>
            </ol>
         </nav>
      </div>
   </div>
</section>
<?php
   $subtotal = 0;
   $each_product_id = [];
   $product_data = [];
?>
<section class="add-card-wrapper">
   <div class="container">
   @if($carts->count() <=0)
  <div class="add-error-wrap">
<div class="empty__image">
<div class="image-wraps">
 <img src="{{url('website/images/cart_empty.gif')}}">
</div>
</div>
<div class="content-wraps">
<h1 class="empty__title">OH NO!</h1>
<div class="empty__text">Hit a little plateau? Don’t worry, our products are here to help you lift off!</div>
<a href="/" class="shop-btn theme-btn-custom">Shop Just Go Nutrition</a>
</div>
  
  </div>
   @else
      <div class="row">
         <div class="col-lg-8">
		 <div class="shipping-wraps">
		 	 <a href="#" class="shipping-cards offer-toggle" > Shopping Cart<span class="cart-count">({{$carts->count()}})</span> </a>
		 </div>
	
            <div class="card-inner">
               <ul class="card-item">
                  <li><span>Product</span></li>
                  <li><span>Wishlist</span></li>
                  <li><span>Price</span></li>
                  <li><span>Quantity</span></li>
                  <li><span>Subtotal</span></li>
               </ul>
               
               @foreach($carts as $cart)
               <div class="product-items">
                  <div class="product-items-inner">
                     <div class="product-col" id="product_spacial_coupon_{{ $cart->product_id }}">
                        <div class="image">
                           <!-- <img src="{{url('website/images/vegan-1.png')}}"> -->
                           <img src="{{url('public')}}/{{$cart->product->firstimage->url}}">
                        </div>
                        <div class="content">
                           <h2><a href="{{url('product')}}/{{$cart->product->slug}}">{{$cart->product->product_name}}</a></h2>
                           <div class="weight-wrap">
                              <span>   Weight :</span> <span> {{$cart->product_weight->size}}</span>
                           </div>
                           <div class="flavour">
                              <span>   Flavour : </span> <span>{{$cart->flavour}}</span>
                           </div>
                        </div>
                     </div>
                     <?php
                     $userid = Auth::user()->id ?? 0;
                     $wishliststatus = DB::table('whishlists')->where(['user_id' => $userid, 'product_id' => $cart->product_id])->count();                        
                     ?>
                     <div class="price-wrap">
                        <a href="javascript:void(0);" class="whislist_add @if($wishliststatus > 0) remove-inners @else inners @endif" data-id="{{ $cart->id }}"><i @if($wishliststatus > 0) class="fa fa-heart" @else class="fa fa-heart-o" @endif aria-hidden="true"></i></a>
                        <form method="post" action="{{url('wish-to-cart')}}" id="cart_form_{{$cart->id}}">
                           @csrf
                           <input type="hidden" name="product_id" value="{{$cart->product_id}}">
                           <input type="hidden" name="sell_price" value="{{$cart->item_price_by_weight}}">
                           <input type="hidden" name="weight[]" value="{{$cart->weight}}">
                           <input type="hidden" name="flavour[]" value="{{$cart->flavour}}">
                           <input type="hidden" name="quantity[]" value="{{$cart->quantity}}">
                           <input type="hidden" name="redirect_type" value="1">
                        </form>
                        <form method="post" action="{{url('remove-to-wish')}}" id="cart_form_remove_{{$cart->id}}">
                           @csrf
                           <input type="hidden" name="product_id" value="{{$cart->product_id}}">
                           <input type="hidden" name="redirect_type" value="1">
                        </form>
                     </div>
                     <div class="price-wrap">
                        <span>INR {{$cart->item_price_by_weight }} </span>
                     </div>
                     <div class="qty-container">
                        <button class="qty-btn-minus btn-light quantity_button" type="button" data-cart="{{$cart->id}}"><i class="fa fa-minus"></i></button>
                        <input type="text" name="qty" value="{{$cart->quantity}}" class="input-qty qty_{{$cart->id}}">
                        <button class="qty-btn-plus btn-light quantity_button" type="button" data-cart="{{$cart->id}}"><i class="fa fa-plus"></i></button>
                     </div>
                     <div class="subtotal-wrap">
                        <span id="product_price-{{ $cart->product_id }}">INR {{$cart->item_price_by_weight * $cart->quantity}}</span>
                     </div>
                     <div class="close-wraps">
                        <a href="{{url('remove-cart-product')}}/{{$cart->id}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
               <?php
               $subtotal += $cart->item_price_by_weight * $cart->quantity;
               $product_data[$cart->product_id] = $cart->item_price_by_weight * $cart->quantity;
               $each_product_id[] = $cart->product_id;
               ?>
               @endforeach               
               <div class="bottom-cart">
                  <div class="coupon">
                     <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon Code" style="text-transform:uppercase;"> 
                     
                     <button type="button" class="button theme-btn2 theme-btn-custom applycoupon" name="apply_coupon" onClick="return findapplycouponfunction()" value="Apply coupon">Apply coupon</button>
                     <button type="button" class="button theme-btn2 theme-btn-custom" id="removepromodiscount" style="display:none"  onclick="removeCuponCode()">&nbsp;REMOVE</button>
                     
                  </div>
                  

                  <h2><a href="{{url('product')}}">Continue Shopping</a></h2>
                  
               </div>
               <p style="display: block;" class="coupon-text" id="cupon_success"></p>
            </div>
         </div>
         <div class=" col-lg-4">
            <div class="card-total-inner">
               <h4>Cart Totals</h4>
               <ul class="card-items">
                  <li>
                     <div class="item1">
                        Subtotal
                     </div>
                     <div class="item2">
                        <span id="item-total-price">INR {{$subtotal}}</span>
                     </div>
                  </li>
                  <li>
                     <div class="item1">
                        Shipping
                     </div>
                     <div class="item2">
                        <span style="    color: #067DFF;
                           font-size: 15px;">	Free Shipping</span>
                        <p>Shipping options will be <br> updated during checkout.</p>
                     </div>
                  </li>
                  <li>
                     <div class="item1">
                        Promo Discount
                     </div>
                     <div class="item2">
                        <span class="promo_discount">INR 0</span>
                     </div>
                  </li>
                  <li>
                     <div class="item1">
                        Total
                     </div>
                     <div class="item2">
                        <span id="totalvalue" style="font-weight: 600;">INR {{$subtotal}}</span>
                     </div>
                  </li>
                  <div class="collection-btn">
                     <a href="@if(Auth::check()) {{url('checkout-1')}} @else javascript:void(0) @endif" class="theme-btn2 theme-btn-custom " @if(!Auth::check()) data-toggle="modal" data-target="#mobilenumPopup" @endif>
                     Proceed to Checkout <i class="fas fa-arrow-right"></i>
                     </a>
                  </div>
               </ul>
            </div>
         </div>
      </div>
      @endif
   </div>
</section>



<div class="modal fade new_flavor_modal_select" id="add_free_offer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <img src="{{url('website/images/texture_1.png')}}" class="texture_1">
         <img src="{{url('website/images/texture-2.png')}}" class="texture_2">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
         </button>
         <div class="modal-body">
            <div class="add_free_offer_div new_flavor_modal" style="width: 100%; ">
            <form method="POST" action="{{url('/add-to-cart')}}">
            @csrf
               <div class="news_content">
                  <p class="h3 text-center" id="add_free_offer_product_name">pro series 100% natural<br>
                     whey protein
                  </p>
               </div>
               <div class="row text-center justify-content-center">
                  <div class="form-group col-md-10 col-xs-12 text-center">
                     <select class="form-control" name="flavour[]" id="add_free_offer_option">
                        <option>Select Flavor</option>
                     </select>
                  </div>
               </div>
               <input type="hidden" id="add_free_offer_product_id" name="product_id">
               <input type="hidden" id="add_free_offer_weight" name="weight[]">
               <input type="hidden" id="quantity" name="quantity[]" value="1">
               <input type="hidden" name="redirect_type" id="redirect_type" value="0">
               <input type="hidden" name="product_type" id="" value="1">
               <div class="text-center d-flex justify-content-center">
                  <button type="submit" class="btn__text  theme-btn2 theme-btn-custom " id="add_free_offer_save_button">Submit</button>
               </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>



@include('website.footer')
@include('website.offer-code',['each_product_id'=>$each_product_id,'product_data'=>$product_data])
<script>
 $(document).ready(function () {
  
  $('.offer-toggle').click(function () {
    $('#add_free_offer').modal("show");
  });


  
});

</script>
