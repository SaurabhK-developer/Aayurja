@include('website.header')
<section class="login-otp admin-gift   otp-signs">
    <div class="container">
        <div class="row justify-content-center">
        <div class="admin-gift-row row align-items-center">
                <!-- <div class="col-md-6">
                    <div class="popup_image">
                        <img src="http://142.93.214.118/giftopiaonline/website/images/git-img1.webp">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="subscribe--detail">
                        <h2 class="category-title">Welcome to Giftopia</h2>

                        <form action="#" method="post" class="mobile_form" id="enter_mobile_form">
                            <div class="form-group">
                                <label>Enter Mobile Number</label>
                                <input class="form-control  mobile_num" required="" name="mobile" type="text" maxlength="10" minlength="10" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                        || (95<event.keyCode &amp;&amp; event.keyCode<106)
                        || (event.keyCode==8) || (event.keyCode==9)
                        || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                        || (event.keyCode==46) )" placeholder="">
                            </div>
                            <div class="submit_btn">
                                <button type="submit" class="theme-button"> Request OTP </button>
                            </div>
                        </form>
                    </div>
					
                </div> -->

                <div class="col-md-6 pop-nopadd">
                        <div class="image-wrap">
                            <img src="{{url('public/images/login-modal-img.webp')}}" alt="modal" loading="lazy"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="loginpopup-detail">
                            <div class="popup-text otppage-para">
                                <h1 class="heading">welcome to aayurja</h1>
                                <p>Please enter the OTP sent to your updated registered mobile number to complete your sign-up process and start enjoying our 100% pure and organic products offering solutions to numerous health-related issues.</p>
                            </div>
                            <form action="#" method="post" class="mobile_form" id="enter_mobile_form">
                                <label for="fname">Enter Mobile Number</label>
                                <!-- <input type="tel" class="form-control mobile_num" required="" maxlength="10" minlength="10"> -->
                                <input class="form-control  mobile_num" required="" name="mobile" type="text" maxlength="10" minlength="10" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                    || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                    || (event.keyCode==8) || (event.keyCode==9)
                                    || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                    || (event.keyCode==46) )" placeholder="">
                                <!-- <div class="btn-wrapper">
                                    <button class="theme-button" type="submit" data-toggle="modal" data-target="#OTPModel">REQUEST OTP</button>
                                </div> -->

                                <div class="submit_btn">
                                <button type="submit" class="theme-button"> Request OTP </button>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>



<!-- <div class="modal login-model fade" id="loginModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <img src="{{url('public/images/popular-vector.png')}}" alt="vector" class="login-vec-one">
            <img src="{{url('public/images/lotus-icon.png')}}" alt="lotus" class="login-vec-lotus">
            <img src="{{url('public/images/blogcard-vector.png')}}" alt="lotus" class="login-vec-two">
            <img src="{{url('public/images/seller-vector1.png')}}" alt="vector" class="login-vec-three">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i></button>
         
            <div class="login-model login-popdetail">
                <div class="row align-items-center">
                    <div class="col-md-6 pop-nopadd">
                        <div class="image-wrap">
                            <img src="{{url('public/images/login-modal-img.webp')}}" alt="modal" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="loginpopup-detail">
                            <div class="popup-text">
                                <h4 class="heading">welcome to aayurja</h4>
                            </div>
                            <form action="#" method="" id="">
                                <label for="fname">Enter Mobile Number</label>
                                <input type="tel" class="form-control mobile_num" required="" maxlength="10" minlength="10">
                                <input class="form-control  mobile_num" required="" name="mobile" type="text" maxlength="10" minlength="10" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                    || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                    || (event.keyCode==8) || (event.keyCode==9)
                                    || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                    || (event.keyCode==46) )" placeholder="">
                                <div class="btn-wrapper">
                                    <button class="theme-button" type="submit" data-toggle="modal" data-target="#OTPModel">REQUEST OTP</button>
                                </div>

                                <div class="submit_btn">
                                <button type="submit" class="theme-button"> Request OTP </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->






@include('website.footer')