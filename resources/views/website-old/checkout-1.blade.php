@include('website.header')
<?php
   $subtotal = 0;
   $each_product_id = [];
   $product_data = [];
?>
<section class="checkout-wrapper">
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
                    <form class="check-form" action="{{ url('checkout-2') }}" method="post"
                                id="addressform">
                    <div class="form-checkbox">
                        <input type="email" class="form-control" name="email"
                           onblur="removestyle('check-Email')" id="check-Email" placeholder="Email"
                           value="{{ $userinfo->email ?? '' }}">
                        <div class="checkbox-wrap">
                            <input class="form-check-input" type="checkbox" name="newsletter" id="gridCheck">
                            <label class="form-check-label" for="gridCheck" id="emailLabel">Receive News and Exclusive
                                Promotions</label>
                        </div>
                    </div>
                    
                     @csrf
                     <input type="hidden" name="addressid" id="addressid" value="{{ $userinfo->id ?? 0 }}">
                     <input type="hidden" name="addressfound" id="addressfound" value="{{ $addressfound }}">
                        <h4>Ship To</h4>


                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label>First name</label>
                                <input type="text" class="form-control" id="check-first-name" name="name"
                                    onblur="removestyle('check-first-name')" placeholder="First name"
                                    value="{{ $userinfo->name ?? '' }}">
                            </div>
                            <div class="col-sm-6">
                                <label>Last name</label>
                                <input type="text" class="form-control" id="check-last-name" name="last_name"
                                    placeholder="Last name" onblur="removestyle('check-last-name')"
                                    value="{{ $userinfo->last_name ?? '' }}">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="check-address" name="address"
                                    placeholder="Address" onblur="removestyle('check-address')"
                                    value="{{ $userinfo->address ?? '' }}">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="check-apartment" name="address2"
                                    onblur="removestyle('check-apartment')"
                                    placeholder="Apartment, suite, etc.(Optional)"
                                    value="{{ $userinfo->address2 ?? '' }}">
                            </div>
                            <div class="col-sm-6">

                                <input type="text" class="form-control" name="country" id="check-country"
                                    onblur="removestyle('check-country')" value="{{ $userinfo->country ?? '' }}"
                                    placeholder="Country">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">

                                <input type="text" class="form-control" name="state" id="check-province"
                                    onblur="removestyle('check-province')" value="{{ $userinfo->state ?? '' }}"
                                    placeholder="Province">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="check-city"
                                    onblur="removestyle('check-city')" name="city" placeholder="City"
                                    value="{{ $userinfo->city ?? '' }}">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" autocomplete="nope" id="phone-number"
                                    placeholder="Phone Number" onblur="removestyle('phone-number')" name="mobile"
                                    value="{{ $userinfo->mobile ?? '' }}" name="mobile" minlength="10"
                                    tabindex="4" maxlength="10"
                                    onkeydown="return ( event.ctrlKey || event.altKey
                                || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                || (event.keyCode==8) || (event.keyCode==9)
                                || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                || (event.keyCode==46) )"
                                    required="">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pin_code" id="zip-code"
                                    onblur="removestyle('zip-code')" value="{{ $userinfo->pin_code ?? '' }}"
                                    placeholder="ZIP Code">
                            </div>
                        </div>
                        <div class="form-wrapper">
                            <div class="form-btn-inner">
                                <a href="#"><i class="fas fa-arrow-left"></i> Go Back Shopping</a>
                            </div>
                            <div class="form-btn-inner">
                                <button class="button theme-btn2 theme-btn-custom submitaddressform" type="button"
                                    value="">Continue to Shipping <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout-right">
                    <div class="shipping-wrap">
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
                                
                                <span><strong id="totalvalue" style="color:rgba(0, 0, 0, 0.9);">INR {{$subtotal}}</strong></span>
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
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZsojtmwI_i4tfDpuCHcCS1MrBgAEfx2k&libraries=places"></script>
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
