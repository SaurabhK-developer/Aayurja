@include('website.header')
<?php
   $subtotal = 0;
   $each_product_id = [];
   $product_data = [];
?>
<section class="checkout-wrapper checkout2-wrapper">
   <div class="container-wrap">
      <div class="row">
         <div class="col-lg-6">
            <div class="checkout-left">
               <ul id="progressbar-wrap">
                  <div class="loading-dots--dot"></div>
                  <li class="active">
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> <i class="fa-solid fa-check"></i></span>
                        <span class="stepper-head-text"> Card </span>
                     </div>
                  </li>
                  <li class="active">
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon">  <i class="fa-solid fa-check"></i> </span>
                        <span class="stepper-head-text"> Add Address </span>
                     </div>
                  </li>
                  <li>
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> 3 </span>
                        <span class="stepper-head-text"> Payment </span>
                     </div>
                  </li>
                  <div class="loading-dots-dot-right"></div>
               </ul>
			   
			   <div class="address-wrap">
			   <div class="contact-wrap">
			   <p> <span>Contact:</span>  <span>{{ $userinfo->name ?? '' }},</span> <span> {{ $userinfo->email ?? '' }}</span> </p>
			  <a class="change-wrap" href="{{url('checkout-1')}}">Change</a>
			   </div>
			   
			    <div class="ship-wrap contact-wrap">
			   <p> <span>Ship to:</span>  <span>{{ $userinfo->address ?? '' }},</span> <span>{{ $userinfo->city ?? '' }}, {{ $userinfo->state ?? '' }}, {{ $userinfo->country ?? '' }} {{ $userinfo->pin_code ?? '' }}</span> </p>
			  <a class="change-wrap" href="{{url('checkout-1')}}">Change</a>
			   </div>
			   
			   </div>
			   
			   
			   
			   <div class="shipping-section">
               <div class="shipping-method-wrap">
                  <h4>Shipping Method</h4>
                  <!-- <div class="radio">
                     <input id="radio-1" name="radio" type="radio" checked>
                     <label for="radio-1" class="radio-label">CDEK Courier Delivery, Free</label>
                  </div> -->
                  <div class="radio">
                     <input id="radio-2" name="radio1" type="radio" checked>
                     <label for="radio-1" class="radio-label">Postal Service Free</label>
                  </div>
               </div>
               <div class="shipping-method-wrap biling-method">
                  <h4>Billing Address</h4>
                  <div class="radio">
                     <input id="radio-3" name="radio" type="radio" checked>
                     <label for="radio-1" class="radio-label">Same as Shipping Address</label>
                  </div>
                  <!-- <div class="radio">
                     <input id="radio-4" name="radio" type="radio" checked>
                     <label for="radio-1" class="radio-label">Use Different Billing Address</label>
                  </div> -->
               </div>
			   </div>
			  <div class="form-wrapper">
				  <div class="form-btn-inner">
				    <a href="{{url('product')}}"><i class="fas fa-arrow-left"></i> Go Back Shopping</a>
				  </div>
						  <div class="form-btn-inner">
						    <button class="button theme-btn2 theme-btn-custom" type="button" onclick="location.href=`{{url('payment-method')}}`;" value="Sumbit">Continue to Shipping  <i class="fas fa-arrow-right"></i></button>
						  </div>
				  </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="checkout-right">
               <div class="shipping-wrap" >
               <?php
                        $subtotal = 0;
                        ?>
						<div class="main-image-section scroll-inner">
						<div class="shipping-image-section">
                        @foreach ($carts as $cart)
                            <div class="shipping-box">
                                <div class="image">
                                    <img src="{{ url('public') }}/{{ $cart->product->firstimage->url }}">
                                </div>
                                <div class="content">
                                    <h4>{{ $cart->product->product_name }}</h4>
                                    <span>INR {{ $cart->item_price_by_weight * $cart->quantity }}</span>
                                    <span>Quantity : {{ $cart->quantity }}</span>
                                    <span>Flavour : {{$cart->flavour}}</span>
                                </div>
                            </div>
                            <?php
                            $subtotal += $cart->item_price_by_weight * $cart->quantity;
                            $product_data[$cart->product_id] = $cart->item_price_by_weight * $cart->quantity;
                             $each_product_id[] = $cart->product_id;
                             ?>
                        @endforeach
                       
						</div>
						</div>
                  <div class="coupon new-coupon-wraps">
                     <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon Code" style="text-transform:uppercase;"> 
                     
                     <button type="button" class="button theme-btn2 theme-btn-custom applycoupon" name="apply_coupon" onClick="return findapplycouponfunction()" value="Apply coupon">Apply coupon</button>
                     <button type="button" class="button theme-btn2 theme-btn-custom" id="removepromodiscount" style="display:none"  onclick="removeCuponCode()">&nbsp;REMOVE</button>
                     
                  </div>
                  <p style="display: block;" class="coupon-text error-text" id="cupon_success"></p>
                
									<div class="shipping-content-section">
                        <div class="shipping-box2">
                            <div class="left-box1">
                                <p>Subtotal</p>
                                <p id="item-total-price">INR {{$subtotal}}</p>
                              
                     
                            </div>
                            <div class="left-box1">
                                <p>Shipping</p>
                                <p style="text-align: right;"><span style="color:#067DFF">Free
                                        Shipping</span><span>Shipping options will be <br> updated during
                                        checkout.</span></p>
                            </div>

                            <div class="left-box1">
                            
                               <p>Promo Discount</p>
                               <p class="promo_discount">INR 0</p>
                         </div>

                            <div class="left-box1">
                                <p>Total</p>
                             <strong id="totalvalue">INR {{$subtotal}}</strong>
                         
                            </div>

                        </div>
							</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@include('website.footer')
@include('website.offer-code',['each_product_id'=>$each_product_id,'product_data'=>$product_data])