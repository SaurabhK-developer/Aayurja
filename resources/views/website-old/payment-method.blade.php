@include('website.header')
<?php
   $subtotal = 0;
   $each_product_id = [];
   $product_data = [];
?>
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
<section class="checkout-wrapper payment-method-section">
   <div class="container-wrap">
      <div class="row">
         <div class="col-lg-6">
            <div class="checkout-left">
               <ul id="progressbar-wrap">
                  <div class="loading-dots--dot"></div>
                  <li class="active">
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> <i class="fa-solid fa-check"></i></span>
                        <span class="stepper-head-text"> Cart </span>
                     </div>
                  </li>
                  <li class="active">
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> 2 </span>
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
       
               <ul class="upi-type-wrap">
                  <li>
                     <div class="upi-items pay_now_button" data-val='MOBP'>
                        Pay Using UPI
                        <input type="hidden" value="MOBP" class="payment_type">
                        <img class="upi-icon" src="{{url('website/images/upi-1.png')}}">
                     </div>
                  </li>
                  <li>
                     <div class="upi-items pay_now_button"  data-val='CRDC'>
                       <span class="Debit"> Credit Card</spamn>
                       <input type="hidden" value="CRDC" class="payment_type">
                        <img class="upi-icon" src="{{url('website/images/v-visa.png')}}">
                        <img class="upi-icon" src="{{url('website/images/v-rupay.png')}}">
                        <img class="upi-icon" src="{{url('website/images/v-master-card.png')}}">
                     </div>
                  </li>
                 
                  <li>
                     <div class="upi-items pay_now_button"  data-val='DBCRD'>
                       <span class="Debit"> Debit Card</spamn>
                       <input type="hidden" value="DBCRD" class="payment_type">
                        <img class="upi-icon" src="{{url('website/images/v-visa.png')}}">
                        <img class="upi-icon" src="{{url('website/images/v-rupay.png')}}">
                        <img class="upi-icon" src="{{url('website/images/v-master-card.png')}}">
                     </div>
                  </li>
                  <li>
                     <div class="upi-items pay_now_button" data-val='DBDBCRDCAR'>
                        Simpl Pay-In-3
                        <img class="upi-icon" src="{{url('website/images/simple.png')}}">
                     </div>
                  </li>
                  <li>
                     <div class="upi-items pay_now_button" data-val='CRED'>
                        CRED Pay
                        <img class="upi-icon" src="{{url('website/images/crednew.png')}}">
                     </div>
                  </li>
                  <li>
                     <div class="upi-items pay_now_button" data-val='WLT'>
                        Wallets
                        <input type="hidden" value="WLT" class="payment_type">
                        <img class="upi-icon" src="{{url('website/images/phone-pay.png')}}">
                        <img class="upi-icon" src="{{url('website/images/paytm.png')}}">
                     </div>
                  </li>
                  <li>
                     <div class="upi-items">
                        Pay Later
                     </div>
                  </li>
                  <li>
                     <div class="upi-items pay_now_button" data-val='NBK'>
                        Internet Banking
                        <input type="hidden" value="NBK" class="payment_type">
                     </div>
                  </li>
                  
                  <li>
                     <div class="upi-items pay_now_button" data-val='EMI'>
                     EMI

                     <input type="hidden" value="EMI" class="payment_type">
                     </div>
                  </li>

                  <li>
                     <div class="upi-items">
                        Cash On Delivery
                     </div>
                  </li>
               </ul>
               <div class="card-wrapper">
                  <p>As per new RBI guidelines, some of your saved cards may not be shown. You can add &amp; save your card again to continue using it <a href="#">Learn More</a></p>
               </div>
              
               <form method="post" class="check-form" action="{{url('pay_now')}}">
               @csrf
                <input type="hidden" id="promo_discount_txt" name="discount">
               <input type="hidden" id="payment_response" name="payment_type">
              
           
              
          
                 <!-- <div class="row clearfix">
                     <div class="col-sm-6">
                        <label>Name on Card</label>
                        <input type="text" name="first_name" placeholder="Sachin" required />
                     </div>
                     <div class="col-sm-6">
                        <label style="height:18px;"></label>
                        <input type="number" name="last_name" placeholder="Card Number" />
                        <img class="card-icon" src="{{url('website/images/card-number.png')}}">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <input type="text" id="inputExpDate" placeholder="Expiry MM/YY" maxlength="7">
                     </div>
                     <div class="col-sm-6">
                        <input type="password" class="cvv" placeholder="CVV">
                        <div class="cvv-card">
                           What is this
                           <img class="cvv-icon" src="{{url('website/images/cvv-card.png')}}">
                        </div>
                     </div>
                  </div>
                  <div class="checkbox-wrap progress-checkbox-wrap">
                     <input class="form-check-input" type="checkbox" name="" checked="">
                     <label class="form-check-label" for="email" id="emailLabel">Save these card details as per the <a href="#">RBI Guidelines</a> for future transactions.</label>
                  </div>-->
                  <div class="form-wrapper">
                     <div class="form-btn-inner">
                        <button class="button theme-btn2 theme-btn-custom" type="submit" value="Sumbit" >Securely Pay  <i class="fas fa-arrow-right"></i></button>

                     </div>

                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="checkout-right">
               <div class="method-inner-wrap">
                  <div class="order-summary-wrap">
                     <h4>My Order Summary</h4>
                     <div class="delivery-wrap">
                        <span>Deliver to :</span>
                        <!--<span class="change">Change</span>-->
                        <a class="change-wrap" href="{{url('checkout-1')}}">Change</a>
                     </div>
                     <div class="name-wrap">
                     {{ $userinfo->name ?? '' }}
                     </div>
                     <div class="address-wrap">
                     <span>{{ $userinfo->address ?? '' }},</span> <span>{{ $userinfo->city ?? '' }}, {{ $userinfo->state ?? '' }}, {{ $userinfo->country ?? '' }} {{ $userinfo->pin_code ?? '' }}</span> 
                     </div>
                  </div>
                  <?php
                        $sellingpricr_subtotal = 0;
                        $pricr_subtotal=0;
                        ?>
                  @foreach ($carts as $cart)
                  
                  <?php
                 $product_prices= App\ProductVariants::where(['product_id' => @$cart->product_id])->where(['weight'=>@$cart->weight])->first();
               
                
                   $subtotal += $cart->item_price_by_weight * $cart->quantity;
                   $product_data[$cart->product_id] = $cart->item_price_by_weight * $cart->quantity;
                   $each_product_id[] = $cart->product_id;
                   ?>
                            
                  @endforeach
                  <div class="coupon new-coupon-wraps">
                     <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon Code" style="text-transform:uppercase;"> 
                     
                     <button type="button" class="button theme-btn2 theme-btn-custom applycoupon" name="apply_coupon" onClick="return findapplycouponfunction()" value="Apply coupon">Apply coupon</button>
                     <button type="button" class="button theme-btn2 theme-btn-custom" id="removepromodiscount" style="display:none"  onclick="removeCuponCode()">&nbsp;REMOVE</button>
                     
                  </div>
                  <p style="display: block;" class="coupon-text error-text" id="cupon_success"></p>
                  <div class="mrp-wrap">
                     <ul>
                        <li>
                           <span>Total MRP</span>
                           <p id="item-total-price">INR {{$subtotal}}</p>
                        </li>
                        <li>
                           
                           <span>Total Discount <img class="dis-icon" src="{{url('website/images/total-dic.png')}}">  </span>
                        <span style="color:#24C13D" class="promo_discount">INR 0</span>
                        
                        </li>
                     </ul>
                  </div>
                  <div class="mrp-wrap">
                     <ul>
                        <li>
                           <span>Total </span>
                           
                           <span  ><strong id="totalvalue" style="color:rgba(0, 0, 0, 0.9);">INR {{$subtotal}}</strong></span>
                          
                           
                        </li>
                     </ul>
                  </div>
				 

              
				  <div class="cash-wrap">
				  <div class="image-icon">
				      <img class="cvv-icon" src="{{url('website/images/hand-wap.png')}}">
				  </div>
				  <div class="contents">
				  You have saved <strong>₹ {{number_format($pricr_subtotal - $sellingpricr_subtotal)}}</strong> & will earn <strong>₹{{$sellingpricr_subtotal*10/100}} JG Cash</strong> on this order.
				  </div>
				  </div>
				  
				  
				  <div class="offers-wrap">
				  <ul>
				  <li>
				  <div class="offers-image">
				   <img class="offer-icon" src="{{url('website/images/offers.png')}}">
				  </div>
				  <div class="offers-content">
				  <span>Available Offers</span>
				  
				  </div>
				  
				  
				  </li>
				  
				  
				  <li>
				  <div class="offers-image">
				   <img class="offer-icon" src="{{url('website/images/offer-wallet.png')}}">
				  </div>
				  <div class="offers-content">
				  <span>Mobikwik Wallet :</span> Get upto Rs.500 Cashback on Just Go Nutrition on payment via MobiKwik Wallet T&C 
				  
				  </div>
				  
				  
				  </li>
				  
				  
				    <li>
				  <div class="offers-image">
				   <img class="offer-icon" src="{{url('website/images/offer-wallet.png')}}">
				  </div>
				  <div class="offers-content">
				  <span>CredPay  :</span>  Offer - Upto Rs 500 cashback on your CRED  Pay UPI transaction on a min spend of Rs 99 on JustGoNutrition. T&C
				  
				  </div>
				  
				  
				  </li>
				  
				  
				  
				  </ul>
				
				  <div class="read-more-content">
				  <ul>
				    <li>
				  <div class="offers-image">
				   <img class="offer-icon" src="{{url('website/images/offer-wallet.png')}}">
				  </div>
				  <div class="offers-content">
				  <span>Free Charge: </span>  Get 10% cashback up to Rs 150 using Freecharge Pay Later T&C 
				  
				  </div>
				  
				  
				  </li>
				  
				  
				  </ul>
				  </div>
				    <a href="javascript:void(0);" class="read-mores" title="Read More">Read More</a>
				  </div>
				  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


@include('website.footer')
@include('website.offer-code',['each_product_id'=>$each_product_id,'product_data'=>$product_data])


<script>
$('.read-mores').click(function() {
        $(this).prev().slideToggle();
        if (($(this).text()) == "Read More") {
            $(this).text("Read Less");
        } else {
            $(this).text("Read More");
        }
    });

</script>

</script>

<script>
  
      $(document).ready(function(){
  $(".pay_now_button").click(function(){
 //console.log($(this).child().classNmae());
   var payment_type= $(this).find('.payment_type').val();
    
       
      // var ssid = $("#ssid").val();
       //var order_id = $("#order_id").val();
       //var _token = '{{ csrf_token()}}';
       //var grandtotal = $("#amount").text().replace(/.+\s/,'');
       //var totalAmount = parseFloat(grandtotal).toFixed(0) ;
       //var total_discount = $("#totaldiscounts").text().replace(/.+\s/,'');
       //var totaldiscount = parseFloat(total_discount).toFixed(0) ;
       
    //   var url = "{{ url('ccavRequestHandler.php')}}
    //                      window.location.replace(url);



    
        $.ajax({
            type: 'POST',
            url: '{{url('pay_now')}}',
            data: {
                payment_type: payment_type,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                console.log(data.grandtotal);
                
            }
      });
   });

});


   /*document.getElementsClass('buy_plan1').onclick = function(e){
   rzp1.open();
   e.preventDefault();
   }*/


   $(document).ready(function(){
      $('.pay_now_button').click(function(){
         $('.pay_now_button.active').removeClass('active');
        $(this).addClass('active');
         
         $('#payment_response').val($(this).data('val'));
         
      });
      $(document).on('submit','form.check-form',function(){
         if($('#payment_response').val() == NULL || $('#payment_response').val() == " "){
            alert('Please Select Payment Method');
            return false;
         }
      });
      $('#payment_res_sbmt').click(function(){
         //alert();
         if($('#payment_response').val() == NULL || $('#payment_response').val() == ""){
            alert('Please Select Payment Method');
            return false;
         }
      })
   })
</script>



