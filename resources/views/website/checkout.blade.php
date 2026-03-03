
@include('website.header')
@if($carts->count() <= 0)
    <script>
        window.location.href = "{{ url('shop') }}";
    </script>
@else
<!-- Event snippet for Aayurja - Checkout Page 1 Started conversion page -->
<!-- Event snippet for Checkout Page 1 conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-16756919325/JYV8CNjcmOMZEJ2YqbY-'});
</script>




<script>
  fbq('track', 'InitiateCheckout');
</script>




<section class="checkout-wrapper">
   <div class="container-fluid">

<div class="mobile-progress">
               <ul id="progressbar-wrap" class="mobile-progres-sec">
                  <div class="loading-dots--dot"></div>
                  <li class="active">
                     <a href="{{url('add-to-cart')}}">
                        <div class="stepper-head" tabindex="0">
                           <span class="stepper-head-icon"> <i class="fa-solid fa-check"></i></span>
                           <span class="stepper-head-text"> Cart </span>
                        </div>
                     </a>
                     
                  </li>
                  <li>
                     <a href="{{url('checkout')}}">
                        <div class="stepper-head" tabindex="0">
                           <span class="stepper-head-icon"> 2 </span>
                           <span class="stepper-head-text"> Add Address </span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> 3 </span>
                        <span class="stepper-head-text"> Payment </span>
                     </div>
                  </li>
                  <div class="loading-dots-dot-right"></div>
               </ul>
</div>

      <div class="row  check-row  checkouts-row">

      <!-- <div class="col-lg-6">
            <div class="checkout-left">
               <ul id="progressbar-wrap">
                  <div class="loading-dots--dot"></div>
                  <li class="active">
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> <i class="fa-solid fa-check"></i></span>
                        <span class="stepper-head-text"> Card </span>
                     </div>
                  </li>
                  <li>
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

               <form class="check-form" action="{{ url('checkout-2') }}" method="post" id="addressform">
                  @csrf
                  <input type="hidden" name="addressid" id="addressid" value="{{ $userinfo->id ?? 0 }}">
                  <input type="hidden" name="addressfound" id="addressfound" value="{{ $addressfound }}">

              
                  <div class="form-checkbox">
               <input type="email" class="form-control" name="email" onblur="removestyle('check-Email')" id="check-Email" placeholder="Email" value="{{ $userinfo->email ?? '' }}">
                     <div class="checkbox-wrap">
                        <input class="form-check-input" type="checkbox" name="newsletter" id="gridCheck">
                        <label class="form-check-label" for="gridCheck" id="emailLabel">Receive News and Exclusive
                           Promotions</label>
                     </div>
                  </div>
                  <h4>Ship To</h4>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <label>First name</label>
                        <input type="text" class="form-control" id="check-first-name" name="name" onblur="removestyle('check-first-name')" placeholder="First name" value="{{ $userinfo->name ?? '' }}">
                     </div>
                     <div class="col-sm-6">
                        <label>Last name</label>
                        <input type="text" class="form-control" id="check-last-name" name="last_name" placeholder="Last name" onblur="removestyle('check-last-name')" value="{{ $userinfo->last_name ?? '' }}">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-12">
                     <input type="text" class="form-control" id="check-address" name="address" placeholder="Address" onblur="removestyle('check-address')" value="{{ $userinfo->address ?? '' }}">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                     <input type="text" class="form-control" id="check-apartment" name="address2" onblur="removestyle('check-apartment')" placeholder="Apartment, suite, etc.(Optional)" value="{{ $userinfo->address2 ?? '' }}">
                     </div>
                     <div class="col-sm-6">
                     <input type="text" class="form-control" name="country" id="check-country" onblur="removestyle('check-country')" value="{{ $userinfo->country ?? '' }}" placeholder="Country">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                     <input type="text" class="form-control" name="state" id="check-province" onblur="removestyle('check-province')" value="{{ $userinfo->state ?? '' }}" placeholder="Province">
                     </div>
                     <div class="col-sm-6">
                     <input type="text" class="form-control" id="check-city" onblur="removestyle('check-city')" name="city" placeholder="City" value="{{ $userinfo->city ?? '' }}">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                     <input type="text" class="form-control" autocomplete="nope" id="phone-number" placeholder="Phone Number" onblur="removestyle('phone-number')" name="mobile" value="{{ $userinfo->mobile ?? '' }}" name="mobile" minlength="10" tabindex="4" maxlength="10" onkeydown="return ( event.ctrlKey || event.altKey
                              || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                              || (95<event.keyCode &amp;&amp; event.keyCode<106)
                              || (event.keyCode==8) || (event.keyCode==9)
                              || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                              || (event.keyCode==46) )" required="">
                     </div>
                     <div class="col-sm-6">
                     <input type="text" class="form-control" name="pin_code" id="zip-code" onblur="removestyle('zip-code')" value="{{ $userinfo->pin_code ?? '' }}" placeholder="ZIP Code">
                     </div>
                    
                  </div>
                 
                  <div class="form-wrapper">
                     <div class="form-btn-inner">
                         <a href="{{url('add-to-cart')}}"> <i class="fa fa-chevron-left"></i> RETURN TO CART </a>
                     </div>
                     <div class="form-btn-inner">
                        <div class="default-btn">
                           <span class="mas">CONTINUE</span>
                           <button class="submitaddressform"> CONTINUE  </button>
                        </div>
                        
                     </div>
                  </div>
               </form>
            </div>
         </div> -->






         <div class="col-lg-6">
            <div class="checkout-left">
               <ul id="progressbar-wrap"  class="desktop-progress">
                  <div class="loading-dots--dot"></div>
                  <li class="active">
                     <a href="{{url('add-to-cart')}}">
                        <div class="stepper-head" tabindex="0">
                           <span class="stepper-head-icon"> <i class="fa-solid fa-check"></i></span>
                           <span class="stepper-head-text"> Cart </span>
                        </div>
                     </a>
                     
                  </li>
                  <li>
                     <a href="{{url('checkout')}}">
                        <div class="stepper-head" tabindex="0">
                           <span class="stepper-head-icon"> 2 </span>
                           <span class="stepper-head-text"> Add Address </span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> 3 </span>
                        <span class="stepper-head-text"> Payment </span>
                     </div>
                  </li>
                  <div class="loading-dots-dot-right"></div>
               </ul>
               
               <form class="check-form" action="{{ url('checkout-2') }}" method="post" id="addressform">
                  @csrf
                  <input type="hidden" name="addressid" id="addressid" value="{{ $userinfo->id ?? 0 }}">
                  <input type="hidden" name="addressfound" id="addressfound" value="{{ $addressfound }}">

                  <div class="form-checkbox">
                     <input type="email" class="form-control" name="email" onblur="removestyle('check-Email')" id="check-Email" placeholder="Email" value="{{ $userinfo->email ?? '' }}">
                     <div class="mice-checkfield">
                         <span>
                             <input type="checkbox" name="newsletter" id="gridCheck">
                             <label for="gridCheck" id="emailLabel">Receive News and Exclusive Promotions</label>
                         </span>
                     </div>
                  </div>
                  <h4>Ship To</h4>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="check-first-name" name="name" onblur="removestyle('check-first-name')" placeholder="First name" value="@if($userinfo->name != 'User') {{ $userinfo->name}} @endif">
                     </div>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="check-last-name" name="last_name" placeholder="Last name" onblur="removestyle('check-last-name')" value="{{ $userinfo->last_name ?? '' }}">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="check-address" name="address" placeholder="Address" onblur="removestyle('check-address')" value="{{ $userinfo->address ?? '' }}">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="check-apartment" name="address2" onblur="removestyle('check-apartment')" placeholder="Apartment, suite, etc.(Optional)" value="{{ $userinfo->address2 ?? '' }}">
                     </div>
                     <div class="col-sm-6">
                     <input type="text" class="form-control" name="country" id="check-country" onblur="removestyle('check-country')" value="{{ $userinfo->country ?? '' }}" placeholder="Country">
                     </div>
                     <!-- <div class="col-sm-6">
                        <select  class="form-control" >
                           <option value="Country/Region">Country/Region</option>
                           <option value="Country/Region1">Country/Region1</option>
                           <option value="Country/Region2">Country/Region2</option>
                        </select>
                     </div> -->
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="state" id="check-province" onblur="removestyle('check-province')" value="{{ $userinfo->state ?? '' }}" placeholder="State">
                     </div>
                     <div class="col-sm-6">
                     <input type="text" class="form-control" id="check-city" onblur="removestyle('check-city')" name="city" placeholder="City" value="{{ $userinfo->city ?? '' }}">
                     </div>
                     <!-- <div class="col-sm-6">
                        <select  class="form-control" >
                           <option value="Country/Region">State</option>
                           <option value="Country/Region1">Country/Region1</option>
                           <option value="Country/Region2">Country/Region2</option>
                        </select>
                     </div> -->
                     <!-- <div class="col-sm-6">
                        <input type="text" class="form-control" id="check-city"  name="city" placeholder="City" value="">
                     </div> -->
                  </div>
                  
                  
                  <div class="row clearfix">
                     <div class="col-sm-6">
                     <input type="text" class="form-control" autocomplete="nope" id="phone-number" placeholder="Phone Number" onblur="removestyle('phone-number')" name="mobile" value="{{ $userinfo->mobile ?? '' }}" name="mobile" minlength="10" tabindex="4" maxlength="10" onkeydown="return ( event.ctrlKey || event.altKey
                              || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                              || (95<event.keyCode &amp;&amp; event.keyCode<106)
                              || (event.keyCode==8) || (event.keyCode==9)
                              || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                              || (event.keyCode==46) )" required="">
                        <!-- <input type="text" class="form-control" autocomplete="nope" id="phone-number" placeholder="Phone Number" name="mobile" value="" name="mobile" minlength="10" tabindex="4" maxlength="10" onkeydown="return ( event.ctrlKey || event.altKey
                           || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                           || (95<event.keyCode &amp;&amp; event.keyCode<106)
                           || (event.keyCode==8) || (event.keyCode==9)
                           || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                           || (event.keyCode==46) )" required=""> -->
                     </div>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="pin_code" id="zip-code" onblur="removestyle('zip-code')" value="{{ $userinfo->pin_code ?? '' }}" placeholder="ZIP Code">
                     </div>
                     <!-- <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Comment"></textarea>
                     </div> -->
                  </div>
                  <!-- <div class="radio-button">
                     <div class="radio-text">
                        <input type="radio" id="test1" name="radio-group" checked>
                        <label for="test1">Use different address for billing</label>
                     </div>
                     <div class="radio-text">
                        <input type="radio" id="test2" name="radio-group">
                        <label for="test2">Save this for future orders</label>
                     </div>
                  </div> -->
                  <div class="form-wrapper">
                     <div class="form-btn-inner">
                        <a href="{{url('/shop')}}"> Go Back Shopping</a>
                     </div>
                     <div class="form-btn-inner">
                        <button class="theme-button submitaddressform" >Continue to Shipping </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>



         <div class="col-lg-6 check1-right">
            <div class="checkout-right">
               <div class="method-inner-wrap ">
                  <div class="shipping-content-section">
                      <div class="item-scroll-section">
                        @foreach ($carts as $cart)
                        <div class="checkout-img">
                           <div class="left-img">
                              <img src="{{url('public/uploads/product')}}/{{ @$cart->product->list_image }}" alt="Product" loading="lazy">
                           </div>		  
                           <div class="right-img">
                           <div class="content">
                              <h5>{{@$cart->product->product_name}}</h5>
                              <div class="cart-item-detail">
                                    
                                 <div class="que">Quantity : {{ @$cart->quantity }}</div>
                                 <p class="price">₹ <del>{{@$cart->product_variants->price * $cart->quantity }}</del></p>
                                 <p class="price">₹ {{@$cart->product_variants->selling_price * $cart->quantity }}</p>
                              </div>
                           </div>
                           </div>
                        </div>

                           
                     <hr>
                        @endforeach
                     </div>



				  
				        <hr/>
				  
                     <div class="shipping-box2">
                        <div class="left-box1">
                           <p>Subtotal</p>
                           <p id="item-total-price"> ₹{{number_format($subtotal,2)}}</p>
                        </div>
                        <div class="left-box1">
                           <p>Promo Discount</p>
                           <p class="promo_discount" id="refresh_discount_amount">₹{{isset($discount_amount) ? number_format($discount_amount,2) : '0'}}</p>
                        </div>
                        <div class="left-box1">
                           <p>Shipping</p>
                           <p style="text-align: right;"><span style="color:#33A40C">Free
                              Shipping</span><span>Shipping options will be <br> updated during
                              checkout.</span>
                           </p>
                        </div>
             





                        <div class="discount-form">
                           <div class="row">
                                <div class="col-lg-7 col-sm-7 col-12 pr-0">
                                   <input type="text" placeholder="Coupon/Referral Code" class="form-control" id="coupon_applied" value="{{ @$coupon_code }}">
                                 </div>
                                 <div class="col-lg-5 col-sm-5 col-12">
                                 <div class="btn-wrap">
                                 <div class="refresh_coupon_section">
                                 @if (
                              (!empty($discount_percentage) && $discount_percentage != 0) ||
                              (!empty($discount_flat) && $discount_flat != 0) ||
                              (!empty($specific_product_discount) && $specific_product_discount != 0)
                           )
                      
                              <button class="subscribe theme-button" onclick="removeCoupon()">Remove</button>
               
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
                                 </div>
                                 </div>
                                 <!--status-->
                                    <div class="checkout-coupon-status">
                                       <p id="coupon_status"></p>
                                       <div id="refresh_using_ajax">
                                          @if (!empty($discount_percentage) && $discount_percentage != null && $discount_percentage !=
                                          0.0)
                                          <p class="mb-1" style="color:#2e4a27;"><span
                                                style="color:#2e4a27;font-weight: bold;">{{ @$coupon_code }} Applied:
                                             </span>A discount of {{ $discount_percentage }}% has been applied successfully.
                                          </p>
                                          <!-- <a href="javascript:void(0);" class="close-coupen" onclick="removeCoupon()">&times;</a> -->
                                          @endif

                                          @if (!empty($discount_flat) && $discount_flat != null && $discount_flat != 0.0)
                                          <p class="mb-1" style="color:#2e4a27;"><span
                                                style="color:#2e4a27;font-weight: bold;">{{ @$coupon_code }} Applied:
                                             </span>A discount of flat {{ $discount_flat }} INR has been applied
                                             successfully!</p>
                                          <!-- <a href="javascript:void(0);" class="close-coupen" onclick="removeCoupon()">&times;</a> -->
                                          @endif

                                          @if (!empty($specific_product_discount) && $specific_product_discount != null && $specific_product_discount != 0.0)
                                          <p class="mb-0" style="color:#2e4a27;"><span
                                                style="color:#2e4a27;font-weight: bold;">{{ @$coupon_code }} Applied:
                                             </span>A discount of {{ $specific_product_discount }}% has been applied
                                             successfully.</p>
                                           @endif  
 

                                       </div>
                                    </div>   
                              <!--status End-->
                           </div>
                        </div>





                        <div class="left-box1">
                           <p>To Pay</p>
                           <span><strong id="refresh_calculation_ajax" class="checkout-total"> ₹{{ceil(@$total)}}</strong></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>


      </div>
   </div>
</section>
@endif
@include('website.footer')

<!-- <script>
//========= hide footer
var bannerClass = document.getElementsByClassName("checkout-wrapper");
if (bannerClass.length) {
  document.querySelector('.service-section').classList.add('checkout-hide');
  document.querySelector('.footer').classList.add('checkout-hide');
}
</script> -->




<!-- //gogle api  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeFV1pkw1e-TWd1UKxmEzeHNoJuNuz40E&libraries=places"></script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function() {
        var options = {
            types: ['address'],
            componentRestrictions: {
                country: "in"
            } // 2-letters code
        };
      var places = new google.maps.places.Autocomplete(document.getElementById('check-address'), options);
      google.maps.event.addListener(places, 'place_changed', function() {
         var place = places.getPlace();
         var address = place.formatted_address;
         var latitude = place.geometry.location.lat();
         var longitude = place.geometry.location.lng();
         var latlng = new google.maps.LatLng(latitude, longitude);
         var geocoder = geocoder = new google.maps.Geocoder();
         geocoder.geocode({
            'latLng': latlng
         }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
               if (results[0]) {
                  var all_data = geocodeResponseToCityState(results);

                  function geocodeResponseToCityState(
                     results) { //will return and array of matching {city,state} objects
                     var parsedLocalities = [];
                     if (results.length) {
                        for (var i = 0; i < results.length; i++) {
                           var result = results[i];

                           var locality = {};
                           for (var j = 0; j < result.address_components.length; j++) {
                              var types = result.address_components[j].types;
                              for (var k = 0; k < types.length; k++) {
                                 if (types[k] == 'locality') {
                                    locality.city = result.address_components[j]
                                       .long_name;
                                 } else if (types[k] ==
                                    'administrative_area_level_1') {
                                    locality.state = result.address_components[j]
                                       .long_name;
                                 } else if (types[k] == 'country') {
                                    locality.country = result.address_components[j]
                                       .long_name;
                                 } else if (types[k] == 'postal_code') {
                                    locality.zip_code = result.address_components[j]
                                       .long_name;
                                 }
                              }
                           }
                           parsedLocalities.push(locality);

                           //check for additional cities within this zip code
                           if (result.postcode_localities) {
                              for (var l = 0; l < result.postcode_localities
                                 .length; l++) {
                                 parsedLocalities.push({
                                    city: result.postcode_localities[l],
                                    state: locality.state,
                                    country: locality.country,
                                    zip_code: locality.zip_code
                                 });
                              }
                           }
                        }
                     } else {
                        console.log('error: no address components found');
                     }
                     return parsedLocalities;
                  }
                  var address = results[0].formatted_address;
                  var pin = all_data[0].zip_code;
                  var country = all_data[0].country;
                  var state = all_data[0].state;
                  var city = all_data[0].city;

                  document.getElementById('check-city').value = city;
                  document.getElementById('check-province').value = state;
                  document.getElementById('check-country').value = country;
                  document.getElementById('zip-code').value = pin;
                  state = state.toLowerCase().replaceAll(' ', '_');
                  state = state.trim();
               }
            }
         });
      });
   });
</script>


<script>
   $(".submitaddressform").on("click", function() {
      var email = $("#check-Email").val();
      var atposition = email.indexOf("@");
      var dotposition = email.lastIndexOf(".");
      var mailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
      if ($("#check-Email").val() == '') {
         // alert('Please enter first name');
         $("#check-Email").focus();
         $("#check-Email").css({
            'border-color': 'red'
         });

         return false;

      } else if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email.length) {
         alert('Please Enter valid Email');
         $("#check-Email").focus();
         $("#check-Email").css({
            'border-color': 'red'
         });

         return false;
      } else if ($("#check-first-name").val() == '') {
         // alert('Please enter first name');
         $("#check-first-name").focus();
         $("#check-first-name").css({
            'border-color': 'red'
         });

         return false;
      } else if ($("#check-last-name").val() == '') {
         // alert('Please enter last name');
         $("#check-last-name").focus();
         $("#check-last-name").css({
            'border-color': 'red'
         });
         return false;
      } else if ($("#check-address").val() == '') {
         // alert('Please enter address');
         $("#check-address").focus();
         $("#check-address").css({
            'border-color': 'red'
         });
         return false;
      } else if ($("#check-city").val() == '') {
         // alert('Please enter city');
         $("#check-city").focus();
         $("#check-city").css({
            'border-color': 'red'
         });
         return false;
      } else if ($("#check-province").val() == '') {
         // alert('Please enter city');
         $("#check-province").focus();
         $("#check-province").css({
            'border-color': 'red'
         });
         return false;
      } else if ($("#check-country").val() == '') {
         // alert('Please enter city');
         $("#check-country").focus();
         $("#check-country").css({
            'border-color': 'red'
         });
         return false;
      } else if ($("#zip-code").val() == '') {
         // alert('Please enter zip code');
         $("#zip-code").focus();
         $("#zip-code").css({
            'border-color': 'red'
         });
         return false;
      } else if ($("#phone-number").val() == '') {
         // alert('Please enter phone number');
         $("#phone-number").focus();
         $("#phone-number").css({
            'border-color': 'red'
         });
         return false;
      } else if ($("#phone-number").val().toString().length < 10) {
         $("#phone-number").focus();
         $("#phone-number").css({
            'border-color': 'red'
         });
         return false;
      }

      document.forms['addressform'].submit();
   })

   function removestyle(id) {
      $("#" + id).css({
         'border-color': ''
      });
   }
</script>




<!-- Coupon start -->

<!-- <script>
   function applyCoupon() {
      var coupon_applied = $('#coupon_applied').val();
      console.log('apply coupon:' + coupon_applied);
      $.ajax({
         type: 'post',
         url: '{{ url('apply/coupon') }}',
         data: {
            coupon_applied: coupon_applied,
            _token: "{{ csrf_token() }}"
         },
         success: function(response) {
            console.log('msg: ' + response.msg);
            
            $('#refresh_using_ajax').load('add-to-cart' + ' #refresh_using_ajax');
            $('.refresh_coupon_section').load('add-to-cart' + ' .refresh_coupon_section');
            $('#refresh_calculation_ajax').load('add-to-cart' + ' #refresh_calculation_ajax');
            $('#refresh_discount_amount').load('add-to-cart' + ' #refresh_discount_amount');

            // $('.refresh_coupon_btn').load('add-to-cart' +
            //    ' .refresh_coupon_btn'); //FOR COUPON BTN REFRESH
            // $('#refresh_coupon_btn2').load('add-to-cart' +
            //    ' #refresh_coupon_btn2'); //FOR COUPON BTN REFRESH //FOR MOBILE
            // $('#final_amount').load('add-to-cart' + ' #final_amount'); // FOR MOBILE

            if (response.codeApplied == 'yes') {
               $('#coupon_status').hide();
               $('#coupon_status').css("color", "#457335");
               $('#coupon_status').css("font-weight", "bold");
            } else {
               $('#coupon_status').css("color", "#8f6c53");
               $('#coupon_status').css("font-weight", "bold");
               $('#coupon_status').html(response.msg);
               $('#coupon_status').show();
            }
         }
      });
   }

   function removeCoupon() {
      var coupon_applied = $('#coupon_applied').val();
      $.ajax({
         type: 'post',
         url: '{{ url('remove/coupon') }}',
         data: {
            coupon_applied: coupon_applied,
            _token: "{{ csrf_token() }}"
         },
         success: function(response) {
            console.log('codeRemoved: ' + response.codeRemoved);
            $('#refresh_using_ajax').load('add-to-cart' + ' #refresh_using_ajax');
            $('.refresh_coupon_section').load('add-to-cart' + ' .refresh_coupon_section');
            $('#refresh_calculation_ajax').load('add-to-cart' + ' #refresh_calculation_ajax');
            $('#refresh_discount_amount').load('add-to-cart' + ' #refresh_discount_amount');

            
            // $('.refresh_coupon_btn').load('add-to-cart' +
            //    ' .refresh_coupon_btn'); //FOR COUPON BTN REFRESH
            // $('#refresh_coupon_btn2').load('add-to-cart' +
            //    ' #refresh_coupon_btn2'); //FOR COUPON BTN REFRESH //FOR MOBILE
            // $('#final_amount').load('add-to-cart' + ' #final_amount'); // FOR MOBILE
            $('#coupon_applied').val('');
         }
      });
   }
</script> -->

<!-- Coupon end -->