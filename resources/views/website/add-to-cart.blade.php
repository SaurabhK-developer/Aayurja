@include('website.header')
<style>
    body {background-color:#fff;}
</style>
<!-- Cart Banner -->
<section class="cart-banner ">
   <img src="{{url('public/images/add-to-cart.webp')}}" alt="Banner">
   <div class="cart-text">
      <div class="container">
         <div class="cart-inner">
            <h1 class="category-title">Cart</h1>
            <div class="breadcrum">
                <p><a href="{{url('/')}}">Home</a> |  </p>
                <p>Cart</p>
            </div>
         </div>
      </div>
   </div>
</section>
@if($isEmpty)
    <section class="empty-cart">
        <div class="container">
            <div class="empty-cart-message">
               <img src="{{url('website/images/empty-cart.webp')}}" alt="empty cart" loading="lazy">
                <h2 class="text-center">Your Cart is Empty</h2>
                <p class="text-center">Your cart is currently empty. Browse our products and add some items to your cart!</p>
                <div class="collection-btn">
                  <div class="default-btn">
                     <!-- <span class="mas">Start Shopping</span> -->
                     <a href="{{ url('shop') }}" class="theme-button">Start Shopping</a>
                  </div>
                </div>
                
            </div>
        </div>
    </section>
@else
<section class="add-card-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <div class="shipping-wraps">
               <h2 class="cart-box-title"> Shopping Cart (<span class="cart-count" id="shoppingCartCount">{{$carts->count()}}</span>) </h2>
            </div>
			
			
			  <ul class="card-item">
                  <li><span>Product</span></li>
                  <li><span>MRP</span></li>
                  <li><span>Price</span></li>
                  <li><span>Quantity</span></li>
                  <li><span>Subtotal</span></li>
               </ul>
			
			
            <div class="card-inner discount_note">
               @php
                  $sub_total= 0;
               @endphp

               @if(count($carts) > 0)
               @foreach($carts as $key => $cart)
               <div class="product-items">
                  <div class="product-items-inner" >
                     <div class="product-col" >
                        <div class="image">
                           <img src="{{url('public/uploads/product')}}/{{ @$cart->product->list_image }}" alt="{{ $cart->product->product_name }}" loading="lazy">
                        </div>
                        <div class="content">
                           <h2><a href="#">{{ $cart->product->product_name }}</a></h2>
                           <div class="weight-wrap">
                              <!-- <span> Weight :</span> <span> 1 KG</span> -->

                              @if($cart->product_variants->weight !='N/A')
                              <span> Weight :</span> <span> {{$cart->product_variants->weight }}</span>
                              @endif
                             

                  
                           </div>
                  
                           <?php if($cart->product->slug == 'organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer') { echo '<span>This is a promotional product</span>'; } ?>
                           <!-- <div class="flavour"> -->
                              <!-- <span> Flavour : </span> <span>Unflavoured</span> -->
                              
                           <!-- </div> -->
                        </div>
                     </div>
                     <div class="price-wrap">
                        <del><i class="fa-solid fa-indian-rupee-sign"></i> {{ $cart->product_variants->price }} </del>
                     </div>
                     <div class="price-wrap">
                        <span><i class="fa-solid fa-indian-rupee-sign"></i> {{ $cart->product_variants->selling_price }} </span>
                     </div>
                     <div class="qty-container">
                        @php
                           $sub_total += $cart->quantity * $cart->product_variants->selling_price;
                        @endphp
                        <button class="qty-btn-minus btn-light quantity_button" type="button" onclick="Quantity_update({{ $cart->id }},'down')" data-cart-id="{{ $cart->id }}" <?php if($cart->product->slug == 'organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer') { echo 'disabled'; } ?>><i class="fa fa-minus"></i></button>
                        <input type="text" name="qty" value="{{ $cart->quantity }}" class="input-qty" data-cart-id="{{ $cart->id }}">
                        <button class="qty-btn-plus btn-light quantity_button" type="button" onclick="Quantity_update({{ $cart->id }},'up')" data-cart-id="{{ $cart->id }}" <?php if($cart->product->slug == 'organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer') { echo 'disabled'; } ?>><i class="fa fa-plus"></i></button>
                     </div>
                     <div class="subtotal-wrap">
                        <span><i class="fa-solid fa-indian-rupee-sign"></i> {{ $cart->product_variants->selling_price * $cart->quantity }}</span>
						
						   <div class="shiping-btn">
                     <div class="move-btn">
					         <a href="javascript:void(0);" class="close-icon remove-from-cart" data-cart-id="{{ $cart->id }}" onclick="removeFromCart({{ $cart->id }})">Remove </a>

                     </div>

                  </div>
						
                     </div>
                    
            
                  </div>
                 
                              @if(isset($discount_products))
                              @if(in_array($cart->product_id, $discount_products))
                              <?php $product_discount = (($specific_product_discount / 100) * $cart->product_variants->selling_price) * @$cart->quantity ; ?>
                              <p  style="color: #1C9A07; font-weight: bold; padding: 5px; border-radius: 5px;">
                              A discount of INR {{@$product_discount}} has been applied  successfully  </p>
   
                              @endif
                              @endif
                  
               </div>
               
               @endforeach
               @else
               <h6>Your cart is empty</h6>
               @endif
           </div>
               




               <div class="bottom-cart">
                  <div class="coupon">

                        <input type="text" placeholder="Coupon/Referral Code" class="form-control" id="coupon_applied"
                           value="{{ @$coupon_code }}">
                        <div class="refresh_coupon_section">
                        @if (
                              (!empty($discount_percentage) && $discount_percentage != 0) ||
                              (!empty($discount_flat) && $discount_flat != 0) ||
                              (!empty($specific_product_discount) && $specific_product_discount != 0)
                           )
                           <!-- <div class="default-btn"> -->
                              <!-- <span class="mas">Remove</span> -->
                              <button class="subscribe theme-button" onclick="removeCoupon()">Remove</button>
                           <!-- </div> -->
                           @else
                           <!-- <div class="default-btn"> -->
                              <!-- <span class="mas">Apply
                              Coupon</span> -->
                              <button class="subscribe theme-button" onclick="applyCoupon()">Apply
                              Coupon</button>
                           <!-- </div> -->
                           @endif
                        </div>
                  </div>

                     
                  <div class="shopping">
                     
                     <a href="{{url('/shop')}}">Continue Shopping</a>
                     <!-- <div class="update-wrap">
                        <button class="update theme-button">Update Cart</button>
                     </div> -->
                  </div>
               </div>

               <div class="applycoupon-status">
                  <p id="coupon_status"></p>

                  <div id="refresh_using_ajax" class="applycoupon-message">
                     @if (!empty($discount_percentage) && $discount_percentage != null && $discount_percentage !=
                     0.0)
                     <p class="mb-0" style="color:#2e4a27;"><span
                           style="color:#2e4a27;font-weight: bold;">{{ @$coupon_code }} Applied:
                        </span>A discount of {{ $discount_percentage }}% has been applied successfully.
                     </p>
                     <!--<p style="color:green">{{ @$coupon_code }} applied: A discount of {{ $discount_percentage }}% has been applied successfully.</p>-->
                     <!-- <a href="javascript:void(0);" class="close-coupen" onclick="removeCoupon()">&times;</a> -->
                     @endif

                     @if (!empty($discount_flat) && $discount_flat != null && $discount_flat != 0.0)
                     <p class="mb-0" style="color:#2e4a27;"><span
                           style="color:#2e4a27;font-weight: bold;">{{ @$coupon_code }} Applied:
                        </span>A discount of flat {{ $discount_flat }} INR has been applied
                        successfully.</p>
                     <!--<p style="color:green">{{ @$coupon_code }} applied: A discount of {{ $discount_flat }}% has been applied successfully.</p>-->
                     <!-- <a href="javascript:void(0);" class="close-coupen" onclick="removeCoupon()">&times;</a> -->
                     @endif





                     @if (!empty($specific_product_discount) && $specific_product_discount != null && $specific_product_discount != 0.0)
                     <p class="mb-0" style="color:#2e4a27;"><span
                           style="color:#2e4a27;font-weight: bold;">{{ @$coupon_code }} Applied:
                        </span>A discount of spacific product {{ $specific_product_discount }} % has been applied
                        successfully.</p>
                     <!--<p style="color:green">{{ @$coupon_code }} applied: A discount of {{ $discount_flat }}% has been applied successfully.</p>-->
                     <!-- <a href="javascript:void(0);" class="close-coupen" onclick="removeCoupon()">&times;</a> -->
                     @endif
                  </div>
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
                        <span id="item-total-price" ><i class="fa-solid fa-indian-rupee-sign" ></i> {{$sub_total}}</span>
                     </div>
                  </li>
                  <li>
                  <div class="item1">
                  Promo Discount
                     </div>
                     <div class="item2">
                        <p class="promo_discount" id="refresh_discount_amount">INR {{isset($discount_amount) ? number_format($discount_amount,2) : '0'}}</p>
                     </div>


                        
                  </li>
                  <li>
                     <div class="item1">
                        Shipping
                     </div>
                     <div class="item2">
                        <span class="ship-title"> Free Shipping</span>
                        <p>Shipping options will be <br> updated during checkout.</p>
                     </div>
                  </li>
                  <li>
                     <div class="item1">
                        Total
                     </div>
                     <div class="item2" id="refresh_calculation_ajax">
                        <span class="grand-total" id="refresh_total"><i class="fa-solid fa-indian-rupee-sign" ></i> <span id="totalAmount">{{ceil($total)}}</span></span>
                     </div>
                  </li>

                  @if(Auth::check() && Auth::user()->is_influencer != 1 && $balancePoints > 0)
                  <li>
                     <div class="item1">
                        Available Referral Points: {{$balancePoints}} <br>Do you want to redeem?
                     </div>
                     <div class="item2" >
                        <button class="theme-button" onclick="redeemNowBtn({{$balancePoints}})">Redeem Now</button>
                     </div>
                  </li>
                  @endif
                  
                  <div class="collection-btn">
                     <!-- <a href="# " class="theme-button">
                     Proceed to Checkout 
                     </a> -->
                     <a href="@if(Auth::check()) {{url('checkout')}} @else javascript:void(0) @endif" class="theme-button" @if(!Auth::check()) data-toggle="modal" data-target="#exampleModalCenter" @endif>
                        Proceed to Checkout
                     </a>
                  </div>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>
@endif

@include('website.footer')



<script>
      function Quantity_update(card_id,type) {
        
        $.ajax({
           type:'get',
           url:'{{ url("update_qty" )}}',
           data:{id:card_id,type:type},
           success: function(response){
                console.log(response);
                location.reload();
           }
        }); 
    
    };


    function removeFromCart(cartId) {
        $.ajax({
            url: "{{ route('removeFromCart') }}", // Update this route to match your named route in Laravel
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                cart_id: cartId
            },
            success: function(response) {

               $('a[data-cart-id="' + cartId + '"]').closest('.product-items').remove();
               // location.reload();
               $('#item-total-price').load('add-to-cart' + ' #item-total-price');
               $('#refresh_total').load('add-to-cart' + ' #refresh_total');
               $('#refresh_discount_amount').load('add-to-cart' + ' #refresh_discount_amount');

               //UPDATE CART COUNTER
               var currentcartCount = $("#cart_counter_id").text();
               $("#cart_counter_id").text(parseInt(currentcartCount)-1);

               //SHOPPING CART COUNTER UPDATE
               var shoppingCartCount = $("#shoppingCartCount").text();
               // console.log('shoppingCartCount'+shoppingCartCount);
               $("#shoppingCartCount").html(parseInt(shoppingCartCount)-1);
               location.reload();
               
            },
            error: function(xhr) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while removing the product from the cart' + xhr.responseText,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                console.error(xhr.responseText);
            }
        });
    }
</script>




<script>
   function redeemNowBtn(points) {
      // alert(points);

         var total_amount = $("#totalAmount").text();

         // console.log('Amount is : '+total_amount);

        $.ajax({
            url: "{{ route('redeemPointsByUser') }}", // Update this route to match your named route in Laravel
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                points: points,
                total_amount: total_amount
            },
            success: function(response) {
               console.log('test response: '+response);

               location.reload();
               
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

</script>