
   <section class="subscribe-wrapper">
         <div class="container">
            <div class="row">
               <div class="subs-left">
                  <div class="subs-wrap">
                     <div class="subs-container">
                        <img src="{{url('website/images/currency-icon.png')}}" class="currency-icon">
                        <h2>10<span>%</span></h2>
                        <div class="font-second">OFF YOUR FIRST ORDER WHEN YOU <br>SIGN-UP TO OUR NEWSLETTER</div>
                     </div>
                  </div>
               </div>
               <div class="subs-right">
                  <form action="/send-news" method="POST"  name="EmailTestForm">
                    @csrf
                     <input type="email" name="email" value="" class="form-input" required  placeholder="Your email address...">
                     <button type="submit" value="subscribe" class="form-btn">Subscribe Now <i class='fas fa-arrow-right'></i> </button>
                  </form>
               </div>
            </div>
         </div>
      </section>
  
  
  
  <footer class="footer">
         <div class="container f-top-container">
            <div class="row">
               <div class="footer-logo">
                  <a href="/">
                  <img src="{{url('website/images/footer-logo.png')}}">
                  </a>
               </div>
               <nav class="footer-link">
                  <ul>
                      <li>
                                   <a href="{{url('/product')}}">SHOP</a>
                              </li>
                              <li><a href="{{url('/about')}}">About</a></li>
                              <li><a href="{{url('/blog')}}">Blogs</a></li>
                              <li><a href="{{url('/what-fuels-you')}}">Fuel</a></li>
							    
								
                     <!--<li>
                        <a href="#">Refer & Earn </a>
                     </li>
                     <li>
                        <a href="#">Spotlight</a>
                     </li>
                     <li>
                        <a href="#">Challenges</a>
                     </li>-->
                  </ul>
				  
               </nav>
               <div class="footer-address row">
                  <div class="location-wrap col-md-4">
                     <div class="location-section">
                        <div class="icon">
                           <img src="{{url('website/images/location.png')}}">
                        </div>
                        <div class="content">
                           <h6 data-toggle="modal" data-target="#subscribe_pop" href="javascript:void(0)">Our Location</h6>
                           <p>
                            Mango Nutraceuticals Pvt Ltd
                            <br>
                            Plot No : GR - 166B-167A, GDIA, Bahadurgarh, Dist- Jhajjar, <br>Haryana - 124507
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="location-wrap col-md-4">
                     <div class="location-section">
                        <div class="icon">
                           <img src="{{url('website/images/phone.png')}}">
                        </div>
                        <div class="content">
                           <h6>Call Us Now</h6>
                           <p><a href="tel:+918595122207">+91-8595122207</a>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="location-wrap col-md-4">
                     <div class="location-section">
                        <div class="icon">
                           <img src="{{url('website/images/email.png')}}">
                        </div>
                        <div class="content">
                           <h6>Mail Us</h6>
                           <p><a href="mailto:helpdesk@justgonutrition.com">helpdesk@justgonutrition.com</a>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="brand-logo row">
                  <div class="logo-col col-md-2">
                     <p>Also available on:</p>
                  </div>
                  <div class="logo-col col-md-5">
				  <div class="amazon-logo-wrap">
				  <div class="amazon-col">
				   <img src="{{url('website/images/amazon-logo1.png')}}">
				  </div>
				  
				   <div class="amazon-col">
				   <img src="{{url('website/images/amazon-logo2.png')}}">
				  </div>
				  
				  
				   <div class="amazon-col">
				   <img src="{{url('website/images/amazon-logo3.png')}}">
				  </div>
				  
				  
				   <div class="amazon-col">
				   <img src="{{url('website/images/amazon-logo4.png')}}">
				  </div>
				  
				  </div>
                    
                  </div>
                  <div class="logo-col col-md-5">
				  <div class="img-col-inner">
				  <div class="img-col">
				   <img src="{{url('website/images/brand-logo1.png')}}">
				  </div>
				  
				    <div class="img-col">
				   <img src="{{url('website/images/brand-logo2.png')}}">
				  </div>
				  
				  
				    <div class="img-col">
				   <img src="{{url('website/images/brand-logo3.png')}}">
				  </div>
				    <div class="img-col">
                        <img src="{{url('website/images/brand-logo4.png')}}" class="no-effect">
                        <img src="{{url('website/images/brand-logo42.png')}}" class="with-effect">
                    </div>
				    <div class="img-col">
				        <img src="{{url('website/images/brand-logo5.png')}}">
				    </div>
				    <div class="img-col">
				   <img src="{{url('website/images/brand-logo6.png')}}">
				  </div>
                   </div>
                  </div>
                  
				  
               </div>
            </div>
         </div>
         <div class="copyright-section">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 col-xl-4">
                     <p>Copyright © 2023 <a href="/"> JustGoNutrition </a> All rights reserved.</p>
                  </div>
				     <div class="col-lg-12 col-xl-7">
                      <nav class="footer-link copyright-link">
                  <ul>
                    
                           
						   
							    <li><a href="{{url('/privacy-policy')}}">Privacy</a></li>
							    <li><a href="{{url('/terms-and-conditions')}}">Terms</a></li>
								 <li><a href="{{url('/return-policy')}}">Returns</a></li>
								 	 <li><a href="{{url('/shipping-policy')}}">Shipping</a></li>
                     <!--<li>
                        <a href="#">Refer & Earn </a>
                     </li>
                     <li>
                        <a href="#">Spotlight</a>
                     </li>
                     <li>
                        <a href="#">Challenges</a>
                     </li>-->
                  </ul>
				  
               </nav>
                  </div>
				  
				  <div class="col-lg-12 col-xl-1">
                  <div class="social_link">
                     <ul>
                        <li>
                           <a  class="facebook-link" href="https://www.facebook.com/justgonutrition" target="_blank">
                           <i class="fa fa-facebook" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li>
                           <a  class="instagram-link" href="https://www.instagram.com/justgonutrition/ " target="_blank">
                           <i class="fa fa-instagram"></i>
                           </a>
                        </li>
                        <!--<li>
                           <a href="#">
                           <i class="fa fa-twitter"></i>
                           </a>
                        </li>-->
                        <li>
                           <a class="youtube-link" href="#">
                           <i class="fa fa-youtube-play"></i>
                           </a>
                        </li>
                     </ul>
                  </div>
				  </div>
               </div>
            </div>
         </div>
 <!-- Mobile Number Popup -->

<div class="modal fade mobilenumPopup" id="mobilenumPopup" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content login_popup">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

            <div class="modal-body">

                <div class="popup_body">
                  <div class="popup_image">
                     <img id="login_image" src="{{ url('website/images/login/login-popup.webp') }}" alt="chekicon">
                  </div>
                    <div class="image_content" >
					<div class="image_content_inner">
                   <p class="" id="popup_text"></p>
                        <p class="heading-wrap" >Enter Your Number</p>


                        <div class="subscribe-new-area-detail">

                        <form action="#" id="enter_mobile_form" method="post">
						<label>Enter Mobile Number</label>
                               <!-- <input type="number" name="phonenumber"class="mobile_num"  id="phonenumber"
                                    placeholder="" required>-->

                                    <input class="mobile_num" id="phonenumber" required="" name="mobile" type="text" maxlength="10" minlength="10" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                    || (95<event.keyCode &amp;&amp; event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                    || (event.keyCode==46) )"placeholder="" required>

                                <div class="submit_btn">
                                <button type="submit" id="next" class="btn__text theme-btn2 theme-btn-custom">Request OTP <span class="arrow">⟶</span></button>
                                </div>
                            </form>
                        </div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Number Popup  -->




 <!-- Subscribe Popup -->

 <div class="modal fade subscribePopup" id="subscribe_pop" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content login_popup">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

            <div class="modal-body">

                <div class="popup_body">
                  <p class="blue-text">₹200 Discount</p> 
                  <p>For Newsletter </p>
                  <p>Subscribers</p>
                    <div class="image_content" >
					<div class="image_content_inner">
                   <p class="" id="popup_text"></p>
                        


                        <div class="subscribe-new-area-detail">

                        
                        <form action="{{url('/send-news')}}" method="POST"  name="EmailTestForm">
                         @csrf
                            <input type="email" name="email"  class="form-control" required placeholder="Enter Email Address">
                            <label for="date">Please Enter Date Of Birth</label>
                            <div class="dob">
                                <div class="date-box dates">
                               

                                <select name="date" required id="date" class="form-control">
                                    <option value="" disabled selected>DD</option>
                                </select>
                                </div>

                                <div class="date-box month">

                                <select name="month" required id="month" class="form-control">
                                <option value="" disabled selected>MM</option>
                                <option value="Jan">Jan</option>
                                <option value="Feb">Feb</option>
                                <option value="Mar">Mar</option>
                                <option value="Apr">Apr</option>
                                <option value="May">May</option>
                                <option value="Jun">Jun</option>
                                <option value="Jul">Jul</option>
                                <option value="Aug">Aug</option>
                                <option value="Sep">Sep</option>
                                <option value="Oct">Oct</option>
                                <option value="Nov">Nov</option>
                                <option value="Dec">Dec</option>
                                </select>
                                </div>

                                <div class="date-box year">

                                <select name="year" id="year" required  class="form-control">
                                <option value="" disabled selected>YYYY</option>
                                
                                </select>
                                </div>
                            </div>
                                <div class="submit_btn">
                                    <button type="submit" id="next" class="btn__text theme-btn2 theme-btn-custom">Subscribe Now <span class="arrow">⟶</span></button>
                                </div>
                            </form>
                        </div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Subscribe Popup  -->


<!-- Mobile otp Popup -->

<div class="modal fade mobilenumPopup" id="mobile_otp_Popup" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" >

    <div class="modal-dialog" role="document">

        <div class="modal-content newsletter_popup item_added_carts">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>

            </button>

            <div class="modal-body">

                <div class="otp_popup_box">

                    <div class="left-otp-image-box">
                       <img  src="{{ url('website/images/login/login-popup.webp') }}" alt="chekicon">
                    </div>

                    <div class="otp_content">




                        <div class="subscribe-new-area-detail">
                            <p class="h3 text-center" id="addcart_popup_text">OTP Verification</p>
                            <div class="otp-box">
                                <label>Please enter 6 digit code sent on +91 <span id="change_number"></span></label>
                                <form action="#" id="Login_form" class="mt-3 otp-password">

                                    <input class="form-control field" type="password" id="digit-1" name="login_password" data-next="digit-2" required="" maxlength="1">
                                    <input class="form-control field" type="password" id="digit-2" name="login_password" data-next="digit-3" data-previous="digit-1" required="" maxlength="1">
                                    <input class="form-control field" type="password" id="digit-3" name="login_password" data-next="digit-4" data-previous="digit-2" required="" maxlength="1">
                                    <input class="form-control field" type="password" id="digit-4" name="login_password" data-next="digit-5" data-previous="digit-3" required="" maxlength="1">
                                    <input class="form-control field" type="password" id="digit-5" name="login_password" data-next="digit-6" data-previous="digit-4" required="" maxlength="1">
                                    <input class="form-control field" type="password" id="digit-6" name="login_password" data-previous="digit-5" required="" maxlength="1">

                                    <input type="hidden" class="field" id="pwd" value="" maxlength="1">
                                    <p><span id="login-validation"  style="display:none;"></span></p>

                                    <div class="submit_btn">
                                        <button id="next" type="submit" class="view_button  btn__text next theme-btn2 theme-btn-custom">Verfy &amp; Continue
                                            <span class="arrow">⟶</span></button>
                                    </div>
                                    <div class="resend-code">
                                        <p class="resend-text-bold">Did'nt Received the Code?</p>
                                        <p><a class="resend-text" href="javascript:void(0)" id="otp_Resend_button"><i class="fa fa-refresh resend_code" aria-hidden="true"></i> Resend
                                                Code</a></p>


                                        
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- wishlist-popup-->

<!--<div class="modal fade signup-section mobilenumPopup" id="signnup" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content login_popup">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

            <div class="modal-body">

                <div class="popup_body">
                  <div class="popup_image">
                     <img id="login_image" src="{{ url('website/images/wishlist-image.jpg') }}" alt="chekicon">
                  </div>
                    <div class="image_content" >
					<div class="image_content_inner">
                    <script>
      let output = document.getElementById("popup_text");
      var v = null;
      if (v === null) {
         output.innerHTML = "Value is null";
      } else {
         output.innerHTML = "Value is not null";
      }
   </script>
   
 <p class="" id="popup_text"></p>

                       


                        <div class="subscribe-new-area-detail">

                        <form action="#" id="enter_mobile_form" method="post">
						<label>Enter Mobile Number</label>
                               

                                    <input class="mobile_num" id="phonenumber" required="" name="mobile" type="text" maxlength="10" minlength="10" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                    || (95<event.keyCode &amp;&amp; event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                    || (event.keyCode==46) )"placeholder="" required>

                                <div class="submit_btn">
                                <button type="submit" id="next" class="btn__text theme-btn2 theme-btn-custom">Request OTP <span class="arrow">⟶</span></button>
                                </div>
                            </form>
                        </div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->


<!-- Mobile otp Popup  -->

      </footer>
      <script src="{{url('website/js/jquery-3.6.1.min.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="{{url('website/js/slick.min.js')}}"></script>
      <script src="{{url('website/js/custom.js')}}"></script>
      
      <script>
      $('#enter_mobile_form').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var mob_no = $(".mobile_num").val();
            var formData = {
                mobile: $(".mobile_num").val(),
                "_token": "{{ csrf_token() }}",

            };
            $.ajax({
                method: "post",
                url: "{{url('generate-otp')}}",
                data: formData,
                success: function(result) {
                    if (result.status == false) {
                        if (result.error.otp) {
                            $("#mob-num-validation").show();
                            $("#mob-num-validation").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">' +
                                result.error.otp + '</label>');
                        } else if (result.error.mobile) {
                            $("#mob-num-validation").show();
                            $("#mob-num-validation").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">' +
                                result.error.mobile + '</label>');
                        } else {
                            $("#mob-num-validation").show();
                            $("#mob-num-validation").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">Something went wrong</label>'
                            );
                        }
                    } else if (result.status == true) {
                        $('#mobilenumPopup').modal('hide');
                        $('#change_number').text(mob_no)
                        $('#mobile_otp_Popup').modal('show');
                    }
                }
            });
        });
</script>



<script>
$('#Login_form').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $inputs = $('#Login_form :input');
            // not sure if you wanted this, but I thought I'd add it.
            // get an associative array of just the values.
            var values = '';

            $inputs.each(function() {
                if (this.name == 'login_password') {
                    values += $(this).val();

                }
            });
            $('#pwd').val(values)

            var formData = {
                mobile: $(".mobile_num").val(),
                password: $("#pwd").val(),
                "_token": "{{ csrf_token() }}",
            };
            $.ajax({
                method: "post",
                url: "{{ route('otp.login') }}",
                data: formData,
                success: function(result) {
                    if (result.status == false) {
                        if (result.error.otp) {
                            $("#login-validation").show();
                            $("#login-validation").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">' +
                                result.error.otp + '</label>');
                        } else if (result.error.mobile) {
                            $("#login-validation").show();
                            $("#login-validation").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">' +
                                result.error.mobile + '</label>');
                        } else {
                            $("#login-validation").show();
                            $("#login-validation").html(
                                '<label style="color: #dc3545;" class="control-label validation-message" for="inputError">Something went wrong</label>'
                            );
                        }
                    } else if (result.status == true) {
                        @if (Request::is('otp-signup'))
                            window.location.replace("{{ url('add-to-cart') }}");
                        @else
                            location.reload();
                        @endif
                    }
                }
            });
        });
</script>



<script>
        $(document).ready(function(){
        var nowY = new Date().getFullYear(),
        options = "";
    
    for(var Y=nowY; Y>=1980; Y--) {
      options += "<option value="+Y+">"+ Y +"</option>";
    }
    
    $("#year").append( options );



    $(function(){
    var $select = $("#date");
    for (i=1;i<=31;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
});
    
    })
$(document).ready(function () {
  
  $("#modalOpen").click(function () {
    $("#mobilenumPopup").modal("show");
  });

  $("#otp_Resend_button").click(function () {
    $('#enter_mobile_form').submit();
    $(".field").val('');
    $("#login-validation").css("display", "none");
   
  });


  
});


$(document).ready(function () {
  
  $("#wishlist-signup").click(function () {
    $("#signnup").modal("show");
  });


  
});




//otp max lenth 1 

$(document).ready(function() {
        $('.otp-box').find('input').each(function() {
            $(this).attr('maxlength', 1);
            $(this).on('keyup', function(e) {
                var parent = $($(this).parent());

                if (e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find('input#' + $(this).data('previous'));

                    if (prev.length) {
                        $(prev).select();
                    }
                } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e
                        .keyCode <= 90) || (
                        e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                    var next = parent.find('input#' + $(this).data('next'));

                    if (next.length) {
                        $(next).select();
                    } else {
                        if (parent.data('autosubmit')) {
                            parent.submit();
                        }
                    }
                }
            });
        });
    });
</script>

<!--after login store session--->
<script>
function setSession() { 

var _token = '{{ csrf_token() }}';

if (localStorage.getItem('ssid') == null) {

    var sess_id = uuidv4();

    var sess_id = sess_id.slice(0, 8);

    var timestamp = new Date().getTime();

    sess_id = sess_id + timestamp;

} else {

    var sess_id = localStorage.getItem('ssid');

}

$.ajax({

    method: 'get',

    url: '{{ url('setSession') }}',

    dataType: 'JSON',

    data: {
        sess_id: sess_id,
        _token: _token
    },

    success: function(res) {

        if (res.status === 200) {

            localStorage.setItem('ssid', sess_id);

        }

    }

});



}
</script>
<!--end store session-->




<!--login popup open-->
<script>

    function loginprompt() {
        
        var url = '{{ url('/') }}';
        $('#popupimage').attr("src", url + '/website/images/home/icons/warning-icon.png');
        $('#popup_text').text('');
       
        $("#mobilenumPopup").modal("show");
    }
</script>
<!--login popup open-->
<!--------logout---->
<script>
     function signOut(acctype) {
localStorage.removeItem('ssid');


    // var baseurl = window.location.origin;
    var baseurl = '{{ url('/') }}';

    var url = baseurl + '/logout';

    window.location = url;

}
</script>
<!--- searching product and blog in header-->
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<!--blog search on blog page-->


<script>
 $(document).ready(function() {
    $( "#blogsearch" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ url('get-blog') }}",
                dataType: "json",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
              


                response($.map(data, function(result) {

                    return {
                                label: result.title ,
                                url: "{{ url('blog') }}" +
                                    '/' + result.slug,
                                    imgsrc: (result.image != null ?
                                    "{{ url('public/uploads/blog') }}/" +
                                    result.image : ''),
                                imagedisplay: 'visible'
                              
                            }

                }));
             
            }


            
        });
    },
    select: function(event, ui) {
            ui.item ? window.location.replace(ui.item.url) : null;
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li></li>")
            //.data( "item.autocomplete", item )  
            .append("<a href='" + item.url + "'>" + " " +
                "<img style='width:45px;height:35px; object-fit: contain; object-position: center;visibility:" +
                item.imagedisplay + "'' src='" + item.imgsrc + "' /> " + item.label + "</a>")
            .appendTo(ul)

    };
});

 
</script> 



<!-- main serach-->
<script> 
  $(document).ready(function(){   
$(".search_data").autocomplete({
        source: function(request, response) {

            if (request.term.trim() == '') return;

            $.ajax({
                url: "{{ url('get-product') }}",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(result) {

                        if (typeof result.firstimage != 'undefined') {
                            return {
                                label: result.product_name + " - " + result.variants_price_desc.selling_price,
                                url: "{{ url('product') }}" +
                                    '/' + result.slug,
                                   
                                imgsrc: (result.firstimage.url != null ?
                                    "{{ url('public/') }}/" +
                                    result.firstimage.url : ''),
                                imagedisplay: 'visible'
                            }
                        } else if (typeof result.status != 'undefined') {
                            return {
                                label: result.title,
                                url: "{{ url('blog') }}" +
                                    '/' + result.slug,
                                imgsrc: (result.image != null ?
                                    "{{ url('public/uploads/blog') }}/" +
                                    result.image : ''),
                                imagedisplay: 'hidden'
                            }
                        } else {
                            return {
                                label: result.title,
                                url: "{{ url('blog') }}" +
                                    '/' + result.slug,
                                imgsrc: (result.image != null ?
                                    "{{ url('public/uploads/blog') }}/" +
                                    result.image : ''),
                                imagedisplay: 'visible'
                            }
                        }

                    }));
                }
            });
        },
        select: function(event, ui) {
            ui.item ? window.location.replace(ui.item.url) : null;
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li></li>")
            //.data( "item.autocomplete", item )  
            .append("<a href='" + item.url + "'>" + " " +
                "<img style='width:45px;height:35px; object-fit: contain; object-position: center;visibility:" +
                item.imagedisplay + "'' src='" + item.imgsrc + "' /> " + item.label + "</a>")
            .appendTo(ul)

    };
});
</script>


<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>


   </body>
   
</html>