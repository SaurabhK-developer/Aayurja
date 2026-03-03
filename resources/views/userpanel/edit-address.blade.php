@include('userpanel.header')


            <h3 class="heading">User Profile Details</h3>

    <div class="user-form address-wrap">
                <h4 class="add-text">Add A New Address</h4>
                <button class="theme-button">
                    <img src="{{url('public/userpanel/images/location-img.webp')}}" /> Use my current location
                </button>
       <form class="check-form" action="{{ route('user.address-update.edit.update', [$address->id]) }}" method="post" id="addressform">
       @csrf
        <div class="row mr-5 address-manage">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputPassword1">First Name</label>
              <input type="text" name="fname"  id="check-first-name"  onblur="removestyle('check-first-name')" value="{{@$address->name}}" class="form-control" placeholder="Enter your name">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputPassword1">Last Name</label>
              <input type="text" name="lname" id="check-last-name" name="lname" placeholder="Last name" onblur="removestyle('check-last-name')" value="{{@$address->last_name}}"  class="form-control" placeholder="Enter your name">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputPassword1">Email Id</label>
              <input type="email" name="email"  id="check-Email" onblur="removestyle('check-email')"  value="{{@$address->email}}" class="form-control" placeholder="Enter your email id">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputPassword1">Mobile No.</label>
              <input type="tel" class="form-control" id="phone-number" placeholder="Phone Number" name="mobile" minlength="10" tabindex="4" maxlength="10" onkeydown="return ( event.ctrlKey || event.altKey
                                || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                || (event.keyCode==8) || (event.keyCode==9)
                                || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                || (event.keyCode==46) )" autocomplete="off" value="{{@$address->mobile}}" required="">
              <!-- <span class="user-var">Varify</span> -->
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputPassword1">Alternative Mobile No.</label>
              <input type="text" class="form-control" placeholder="Enter your alternative no.">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="Address">Address Line 1</label>
              <input type="text" class="form-control" id="check-address"  name="address" value="{{@$address->address}}" placeholder="Area & Street" onblur="removestyle('check-address')" >
             
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Address">Address Line 2</label>
              <input type="text"  id="check-apartment" name="address2" value="{{@$address->address2}}" onblur="removestyle('check-apartment')" class="form-control" placeholder="Locality & Landmark">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="City">City Name</label>
              <input type="text" name="city" id="check-city" class="form-control" value="{{@$address->city}}" placeholder="Enter City/Town/District Name">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputPassword1">State</label>
               <input type="text" class="form-control" name="state" id="check-province" value="{{@$address->state}}" onblur="removestyle('check-province')"  placeholder="state">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="exampleInputPassword1">country</label>
               <input type="text" class="form-control" name="country" id="check-country" value="{{@$address->country}}" onblur="removestyle('check-province')"  placeholder="country">
            </div>
          </div>
         
          <div class="col-sm-6">
            <div class="form-group">
              <label for="Postal Code">Postal Code</label>
              <input type="text" name="pin_code" id="zip-code" onblur="removestyle('zip-code')" value="{{@$address->pin_code}}"   class="form-control" placeholder="Enter Pincode">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="subs">
              <div class="left">
                Address Type:
              </div>
              <div class="right">
                <div class="radio-wrap">
                  <span>
                    <input type="radio" value="home" <?php if (@$address->address_type == 'home') echo "checked='checked'"; ?> name="address_type" checked> Home
                  </span>
                  <span>
                    <input type="radio" value="Work"<?php if (@$address->address_type == 'Work') echo "checked='checked'"; ?> name="address_type">Work
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row bottom-btn">
                <div class="col-6 col-md-3">
                    <div class="submit-btn">
                        <button type="submit" class="theme-button">
                            <span>Save</span>
                        </button>
                        
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="submit-btn">
                        <button type="submit" class="theme-button transparent-btn">
                            <span>Cancel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
          </form>

        

        </div>
      
    </div>
  </div>
</div>
</div>
</div>
</div>

@include('userpanel.footer')
<script>
  $("#contact_code").intlTelInput({
    initialCountry: "in",
    separateDialCode: true,
  });
</script>



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


<!--submit and validate form-->
<script>
   $(".submitaddressform").on("click", function() {
      var email = $("#check-Email").val();
      //alert(email);
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

<!-- <script>
  $(".submitaddressform").on("click", function() {
    var fields = [
      { id: "check-Email", type: "email" },
      { id: "check-first-name", type: "text" },
      { id: "check-last-name", type: "text" },
      { id: "check-address", type: "text" },
      { id: "check-city", type: "text" },
      { id: "check-province", type: "text" },
      { id: "check-country", type: "text" },
      { id: "zip-code", type: "text" },
      { id: "phone-number", type: "tel" }
    ];

    var valid = true;
    fields.forEach(function(field) {
      var input = $("#" + field.id);
      var value = input.val().trim();

      if (value === "") {
        input.focus();
        input.css({ "border-color": "red" });
        valid = false;
      } else if (field.type === "email" && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value)) {
        input.focus();
        input.css({ "border-color": "red" });
        valid = false;
      } else if (field.type === "tel" && value.length < 10) {
        input.focus();
        input.css({ "border-color": "red" });
        valid = false;
      }
    });

    if (valid) {
      document.forms["addressform"].submit();
    }
  });

  function removestyle(id) {
    $("#" + id).css({ "border-color": "" });
  }
</script> -->