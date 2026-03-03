@include('website.header')
<section class="surveybanner-section">
    <div class="surveybanner-slider">
        <div class="surveybanner-item">
            <img src="{{url('public/images/survey-banner-1.webp')}}" alt="banner" loading="lazy">
        </div>
        <div class="surveybanner-item">
            <img src="{{url('public/images/survey-banner-2.webp')}}" alt="banner" loading="lazy">
        </div>
        <div class="surveybanner-item">
            <img src="{{url('public/images/survey-banner-3.webp')}}" alt="banner" loading="lazy">
        </div>
   </div>

   <div class="surveybanner-content">
        <h1 class="heading">Tell Us About Your Lifestyle Connection with Morel Mushrooms!</h1>
        <p>Help us explore the connection between healthy living and the benefits of morel mushrooms Your input will help us create better experiences!</p>
        <a href="javascript:void(0)" class="theme-button" data-toggle="modal" data-target="#survey-popup" onclick="$('.surveybanner-slider').slick('slickPause');">Start the Lifestyle Survey</a>
   </div>
</section>

<div class="modal surveyform-model fade" id="survey-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">

            <div class="surveyform-box">
                <div class="surveyform-head">
                    <p>Lets begin to know little more about your lifestyle </p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <form class="multi-step-form" method="post" action="{{url('survey-save')}}" id="survey_form"> 
                @csrf
                
                    <div class="multi-content-butn">
                        <div class="default-btn prev-step">
                            <a href="javascript:void(0)" class="theme-button">Back</a>
                        </div>
                        <div class="dynamicBtn">
                            <div class="default-btn next-step">
                                <a href="javascript:void(0)" class="theme-button">Next</a>
                            </div>
                        </div>
                    </div>

                    <div class="multi-content step step-1">
                        <h4 class="heading">Essential Personal and Contact Information Details</h4>

                            <input type="hidden" name="formtype" id="formtype" value="survey">

                        <div class="form-field">
                            <label>Your Full Name</label>
                            <input type="text" class="form-control" placeholder="Full name" id="user_name" name="user_name" required>
                        </div>
                        
                        <div class="form-field half-left">
                            <label>Your Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email Address" id="user_email" name="user_email" required>
                        </div>

                        <div class="form-field half-right">
                            <label>Your Mobile Number</label>
                            <input type="text" class="form-control" placeholder="Enter Mobile Number" id="user_mobile" name="user_mobile" minlength="10" maxlength="10"onkeydown="return ( event.ctrlKey || event.altKey
                                || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                || (event.keyCode==8) || (event.keyCode==9)
                                || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                || (event.keyCode==46) )" required="required">
                        </div>
                    </div>

                    <div class="multi-content step step-2">
                        <h4 class="heading">Little More about your demographic profile</h4>

                        <div class="form-field half-left">
                            <label>Your Age</label>
                            <input type="text" class="form-control" placeholder="Age" id="user_age" name="user_age" required>
                        </div>

                        <div class="form-field half-right">
                            <label>Your Gender</label>
                            <div class="gender-radio">
                                <div class="radio-text">
                                    <input type="radio" id="test1" name="user_gender" value="Male" checked>
                                    <label for="test1">Male</label>
                                </div>
                                <div class="radio-text">
                                    <input type="radio" id="test2" name="user_gender" value="Female">
                                    <label for="test2">Female</label>
                                </div>
                                <div class="radio-text">
                                    <input type="radio" id="test3" name="user_gender" value="Other">
                                    <label for="test3">Other</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="multi-content step step-3">
                        <h4 class="heading">Communication Address and Family insights</h4>

                        <div class="form-field">
                            <label>Address for Correspondence</label>
                            <input type="text" class="form-control" placeholder="Enter Address" id="check-address" name="user_address" required>
                        </div>

                        <div class="form-field half-left">
                            <label>Apartment (optional)</label>
                            <input type="text" class="form-control" placeholder="Apartment, suite, etc." id="check-apartment" name="user_apartment">
                        </div>

                        <div class="form-field half-right">
                            <label>Country</label>
                            <input type="text" class="form-control" placeholder="Enter Country" id="check-country" name="user_country" required>
                        </div>

                        <div class="form-field half-left">
                            <label>State</label>
                            <input type="text" class="form-control" placeholder="Enter State" id="check-province" name="user_state" required>
                        </div>

                        <div class="form-field half-right">
                            <label>City</label>
                            <input type="text" class="form-control" placeholder="Enter City" id="check-city" name="user_city" required>
                        </div>

                        <div class="form-field half-left">
                            <label>ZIP Code</label>
                            <input type="text" class="form-control" placeholder="Enter ZIP Code" id="zip-code" name="user_zip_code" required>
                        </div>

                        <div class="form-field half-right">
                            <label>Profession</label>
                            <input type="text" class="form-control" placeholder="Enter Profession" id="user_profession" name="user_profession" required>
                        </div>

                        <div class="form-field half-left">
                            <label>No. of Family Members (optional)</label>
                            <input type="number" class="form-control" placeholder="Enter here" id="" name="family_members" required>
                        </div>
                    </div>

                    <div class="multi-content step step-4">
                        <h4 class="heading">How often do you consume Gucchi mushrooms in your daily routine?</h4>

                        <div class="form-field">
                            <select class="form-control" name="routine">
                                <option value="">-- Select --</option>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Occasionally">Occasionally</option>
                                <option value="Rare">Rare</option>
                            </select>
                        </div>

                      
                        <div class="survey-seprate"></div>

                        <h4 class="heading">In what form or source do you typically consume Gucchi mushrooms?</h4>

                        <div class="form-field">
                            <select class="form-control" name="consume_source">
                                <option value="">-- Select --</option>
                                <option value="Cooked dishes (e.g., curries,stews)">Cooked dishes (e.g., curries,stews)</option>
                                <option value="Rice">Rice</option>
                                <option value="Soups">Soups</option>
                                <option value="As a supplement or extract">As a supplement or extract</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="multi-content step step-5">
                        <h4 class="heading">What are your primary reasons for including Gucchi mushrooms in your diet?</h4>

                        <div class="form-field">
                            <select class="form-control" name="reason">
                                <option value="">-- Select --</option>
                                <option value="Health benefits">Health benefits</option>
                                <option value="Taste preference">Taste preference</option>
                                <option value="Cultural or traditional reasons">Cultural or traditional reasons</option>
                                <option value="Recommendations from any Nutritionist & Doctor">Recommendations from any Nutritionist & Doctor</option>
                            </select>
                        </div>


                        <div class="survey-seprate"></div>

                        <h4 class="heading">How would you describe your current lifestyle?</h4>

                        <div class="form-field">
                            <select class="form-control" name="lifestyle">
                                <option value="">-- Select --</option>
                                <option value="Active and health-conscious">Active and health-conscious</option>
                                <option value="Moderately active with a balanced lifestyle">Moderately active with a balanced lifestyle</option>
                                <option value="Sedentary with occasional physical activity">Sedentary with occasional physical activity</option>
                                <option value="Mostly sitting">Mostly sitting</option>
                            </select>
                        </div>

                    </div>

                    <div class="multi-content step step-6">
                        <h4 class="heading">What types of sports or physical activities do you regularly participate in?</h4>

                        <div class="form-field">
                            <select class="form-control" name="activity">
                                <option value="">-- Select --</option>
                                <option value="Running or jogging">Running or jogging</option>
                                <option value="Gym workouts">Gym workouts</option>
                                <option value="Yoga or Pilates">Yoga or Pilates</option>
                                <option value="Team sports (e.g., football, basketball)">Team sports (e.g., football, basketball)</option>
                                <option value="Outdoor activities (e.g., hiking, cycling)">Outdoor activities (e.g., hiking, cycling)</option>
                                <option value="None">None</option>
                            </select>
                        </div>


                        <div class="survey-seprate"></div>

                        <h4 class="heading">How often do you seek out or try new premium or exotic food ingredients?</h4>

                        <div class="form-field">
                            <select class="form-control" name="exotic_food">
                                <option value="">-- Select --</option>
                                <option value="Regularly">Regularly</option>
                                <option value="Occasionally">Occasionally</option>
                                <option value="Rarely">Rarely</option>
                                <option value="Never">Never</option>
                            </select>
                        </div>

                    </div>

                    <div class="multi-content step step-7">
                        <h4 class="heading">What products would you be interested in purchasing in the future? (multiple Selection)</h4>

                        <div class="survey-radio-btn">
                            <div class="survey-my-radio">
                            <input type="checkbox" id="honey" name="interested_in_purchase[]" value="Honey" checked>
                            <label for="honey">Honey</label>

                            <input type="checkbox" id="shilajit" name="interested_in_purchase[]" value="Shilajit">
                            <label for="shilajit">Shilajit</label>

                            <input type="checkbox" id="apricot" name="interested_in_purchase[]" value="Apricot oil">
                            <label for="apricot">Apricot oil</label>
                            </div>
                        </div>

                        <div class="survey-seprate"></div>

                        <h4 class="heading">What is your typical monthly expenditure on premium or specialty foods, including Gucchi mushrooms?</h4>

                        <div class="form-field">
                            <select class="form-control" name="expenditure">
                                <option value="">-- Select --</option>
                                <option value="Less than Rs 5K">Less than Rs 5K</option>
                                <option value="Rs 5K – Rs 8K">Rs 5K – Rs 8K</option>
                                <option value="Rs 9K – Rs 15K">Rs 9K – Rs 15K</option>
                                <option value="Rs 16K – Rs 20K">Rs 16K – Rs 20K</option>
                                <option value="More than Rs 20K">More than Rs 20K</option>
                            </select>
                        </div>

                    </div>

                    <div class="multi-content step step-8">
                        <h4 class="heading">Refer your friends and family to avail additional 10% off on their first order with us who would be interested in using Gucchi Mushroom</h4>

                        <div class="form-field">
                            <label class="mb-3">Please mention Name & Contact No. of your 3 Friends or family (Optional)</label>
                        </div>

                        <div class="form-field mb-0">    
                             <label for="">First Friend / Family Member</label>
                         </div>

                        <div class="input-wrap-modal">
                            <div class="form-field"> 
                                <input type="text" class="form-control" name="ref_first_name1" id="" placeholder="Name *" required="required">
                            </div>

                            <div class="form-field"> 
                                <input type="email" class="form-control" name="ref_email1" id="" placeholder="Email" >
                            </div>

                            <div class="form-field"> 
                                <input type="text" class="form-control" name="ref_contact1" id="" placeholder="Contact number *" minlength="10" maxlength="10"onkeydown="return ( event.ctrlKey || event.altKey
                                || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                || (event.keyCode==8) || (event.keyCode==9)
                                || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                || (event.keyCode==46) )" required="required">
                            </div>
                        </div>

                        <div class="form-field mb-0">  
                            <label for="">Second Friend / Family Member</label>
                        </div>

                        <div class="input-wrap-modal">
                            <div class="form-field"> 
                                <input type="text" class="form-control" name="ref_first_name2" id="" placeholder="Name *" required="required">
                            </div>

                            <div class="form-field"> 
                                <input type="email" class="form-control" name="ref_email2" id="" placeholder="Email" >
                            </div>

                            <div class="form-field"> 
                                <input type="text" class="form-control" name="ref_contact2" id="" placeholder="Contact number *" minlength="10" maxlength="10"onkeydown="return ( event.ctrlKey || event.altKey
                                || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                || (event.keyCode==8) || (event.keyCode==9)
                                || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                || (event.keyCode==46) )" required="required">
                            </div>
                        </div>

                        <div class="form-field mb-0"> 
                            <label for="">Third Friend / Family Member (Optional) </label>
                        </div>

                        <div class="input-wrap-modal">
                            <div class="form-field"> 
                                <input type="text" class="form-control" name="ref_first_name3" id="" placeholder="Name">
                            </div>

                            <div class="form-field"> 
                                <input type="email" class="form-control" name="ref_email3" id="" placeholder="Email">
                            </div>

                            <div class="form-field"> 
                                <input type="text" class="form-control" name="ref_contact3" id="" placeholder="Contact number" minlength="10" maxlength="10"onkeydown="return ( event.ctrlKey || event.altKey
                                || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                || (event.keyCode==8) || (event.keyCode==9)
                                || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                || (event.keyCode==46) )">
                            </div>
                        </div>
                    
                    </div>
                </form>

                <img src="{{url('public/images/popular-vector.png')}}" class="servy-vector-1" alt="vector" loading="lazy">
                <img src="{{url('public/images/lotus-icon.png')}}" class="servy-vector-2" alt="vector" loading="lazy">
                <img src="{{url('public/images/survey-shape.png')}}" class="servy-vector-3" alt="vector" loading="lazy"> 
                <div id="responseMessage"></div>
            </div>

            <div class="surveyform-thankyou" id="thankyou-slide" style="display: none;">
                <img src="{{url('public/images/servey-thank.webp')}}" class="thanku-resp" alt="vector" loading="lazy">

                <img src="{{url('public/images/popular-vector.png')}}" class="servy-vector-1" alt="vector" loading="lazy">
                <img src="{{url('public/images/lotus-icon.png')}}" class="servy-vector-2" alt="vector" loading="lazy">
            </div>

      </div>
   </div>
</div>

@include('website.footer')


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


                  console.log('address: '+address);
                  console.log('formatted_address: '+results[0].formatted_address);


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






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function () {
    // Initialize multi-step form display logic
    $('.multi-step-form').find('.step').slice(1).hide();
    
    var currentStep = 1;
    var totalSteps = 8;

    // Show thank you message and hide form after successful submission
    function showThankYou() {
        $('.surveyform-box').hide(); // Hide the main survey form
        $('#thankyou-slide').show(); // Show the thank-you slide
    }

    // Update the progress bar based on the current step
    function updateProgressBar() {
        var progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
        $(".progress-bar").css("width", progressPercentage + "%");
    }

    // Update the button text and functionality based on the current step
    function updateButtons() {
        if (currentStep === totalSteps) {
            $('.next-step a').text('Submit');
            $('.next-step a').off('click').on('click', function () {
                $("#survey_form").submit();
            });
        } else {
            $('.next-step a').text('Next');
            $('.next-step a').off('click').on('click', function () {
                if ($('#survey_form').valid()) {
                    nextStep();
                }
            });
        }
    }

    // Function to move to the next step
    function nextStep() {
        if (currentStep < totalSteps) {
            $(".step-" + currentStep).addClass("animated fadeOutLeft");
            currentStep++;
            setTimeout(function () {
                $(".step").removeClass("animated fadeOutLeft").hide();
                $(".step-" + currentStep).show().addClass("animated fadeInRight");
                updateProgressBar();
                updateButtons(); // Update buttons after changing step
            }, 500);
        }
    }

    // Function to move to the previous step
    $(".prev-step").click(function () {
        if (currentStep > 1) {
            $(".step-" + currentStep).addClass("animated fadeOutRight");
            currentStep--;
            setTimeout(function () {
                $(".step").removeClass("animated fadeOutRight").hide();
                $(".step-" + currentStep).show().addClass("animated fadeInLeft");
                updateProgressBar();
                updateButtons(); // Update buttons after changing step
            }, 500);
        }
    });

    // Initialize jQuery validation on the form
    $('#survey_form').validate({
        errorElement: 'span',
        rules: {
            user_name: { required: true, minlength: 3 },
            user_email: { required: true, email: true },
            user_mobile: { required: true, minlength: 10, digits: true },
            user_age: { required: true, digits: true, min: 1, max: 120 },
            user_gender: { required: true },

            formtype: { required: true },


            user_address: { required: true },
            user_profession: { required: true },
            routine: { required: true },
            consume_source: { required: true },
            reason: { required: true },
            lifestyle: { required: true },
            activity: { required: true },
            exotic_food: { required: true },
            expenditure: { required: true }
        },
        messages: {
            user_name: "Please enter your full name",
            user_email: "Please enter a valid email",
            user_mobile: "Please enter a valid mobile number",
            user_age: "Please enter your age",
            user_address: "Please enter your address",
            user_profession: "Please enter your profession"
        }
    });

    // Form submission using AJAX
    $('#survey_form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Check if form is valid before submitting
        if ($('#survey_form').valid()) {
            // Gather the form data
            var formData = $('#survey_form').serialize(); // Serialize the form data

            // Send the AJAX request
            $.ajax({
                url: "{{ url('survey-save') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    // Show the thank you slide on success
                    // showThankYou();
                    window.location.href = "{{url('survey-thankyou')}}";
                },
                error: function (xhr) {
                    // Handle validation errors
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    $.each(errors, function (key, value) {
                        errorMessage += '<p>' + value[0] + '</p>';
                    });
                    $('#responseMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
                }
            });
        }
    });

    // Initial setup
    updateProgressBar();
    updateButtons(); // Initial button setup
});

</script>



