<!DOCTYPE html>
<html>
   <head>
      @if (isset($seo))
      @foreach ($seo as $s)
      @if (Request::url() == $s->url)
      <title>{{ @$s->meta_tag }}</title>
      <meta name="keywords" content="{{ @$s->keywords }}">
      <meta name="description" content="{{ @$s->description }}">
      <link rel="canonical" href="{{ @$s->canonical_tag }}">
      @if(@$s->product_schema!='')
      <script type="application/ld+json" defer async>
         <?php
            $str=@$s->product_schema;
            echo $str ?>
         
         
      </script>
      @endif
      @if(@$s->Faq_schema!='')
      <script type="application/ld+json" defer async>
         <?php
            $str=@$s->Faq_schema;
            echo $str 
            ?>
      </script>
      @endif
      @endif
      @endforeach
      @endif
      <META NAME="robots" CONTENT="noindex,nofollow">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{url('website/css/style.css')}}">
      <link rel="stylesheet" href="{{url('website/css/about.css')}}">
      <link rel="stylesheet" href="{{url('website/css/checkout.css')}}">
      <link rel="stylesheet" href="{{url('website/css/payment-failed.css')}}">
      <link rel="stylesheet" href="{{url('website/css/slick.css')}}">
      <link rel="stylesheet" href="{{url('website/css/slick-theme.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
      <
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <link rel="stylesheet" href=
         "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  
  
   </head>
<style type="text/css">
/* OTP CSS */
.main-login {
    display: flex;
    justify-content: space-between;
}
.login-image {
    position: relative;
    width: 50%;
}
.login-field {
    width: 50%;
    position: relative;
}
.dots-image {
    position: absolute;
    width: 100px;
    right: 0;
    top: 40%;
}
.right-texture-image {
    position: absolute;
    width: 230px;
    right: -20px;
    top: 50%;
}
.image_content_inner {
    width: 70%;
    box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
    display: block;
    margin: 0 auto;
    border-radius: 10px;
    padding: 10px;
    position: relative;
    top: 50%;
    left: 20%;
    transform: translate(-50%, -50%);
}
/* .login-image{
    background-image: url('./website/images/login/login-image1.png');
    
    height: 500px;
    width: 100%;

} */
.logo {
    width: 100px;
    position: absolute;
    z-index: 1;
    top: 30px;
    left: 90px;
}
img.main-image {
    position: relative;
    width: 660px;
}
.login-image{
    position: relative;
}
.left-texture-image {
    position: absolute;
    left: 120px;
    z-index: -1;
}
p.heading-wrap {
    text-align: center;
    font-size: 32px;
    color: #000;
    font-weight: 500;
}
p.title-line {
    text-align: center;
    font-size: 32px;
    color: #067DFF;
    font-weight: 500;
}
.digit-group
	input {
		width: 50px;
		height: 50px;
		border:none;
		border-bottom: 1px solid #ccc;
		line-height: 50px;
		text-align: center;
		font-size: 24px;
		font-family: 'Raleway', sans-serif;
		font-weight: 200;
		color: #000;
		margin: 0 2px;
	}

	.digit-group .splitter {
		padding: 0 5px;
		color: white;
		font-size: 24px;
	}

    .digit-group button{
    display: block;
    margin: 30px auto;
}
.bottom-text {
    position: absolute;
    bottom: 150px;
    display: block;
    margin: 0 auto;
    width: 70%;
}
.bottom-text p{
   text-align:center;
}
p.left-bottom-text {
    position: absolute;
    bottom: 0;
    left: 10%;
    text-align: left;
    /* width: 70%; */
    color: #fff;
    display: block;
    /* margin: 0 auto; */
}
p.right-bottom-text {

    bottom: 0;
    text-align: center;
    width: 70%;
    margin-left:20px
}
.bottom-flex {
    display: flex;
    position: absolute;
    bottom: 0;
    justify-content: center;
    width: 70%;
}
span.bottom-icon img {
    width: 20px;
    margin-right: 10px;
}
</style>


<section class="login-container">
    <div class="main-login">
        <div class="login-image">
            <img src="{{url('website/images/header-logo.png')}}" alt="" class="logo">
            <img src="{{url('website/images/login/login-image1.png')}}" alt="" class="main-image">
            <img src="{{url('website/images/login/left-texture.png')}}" alt="" class="left-texture-image">

            <p class="left-bottom-text">Copyright © 2023 <a href="">JustGoNutrition</a> All rights reserved.</p>

        </div>
        <div class="login-field">
        <img src="{{url('website/images/login/dots.png')}}" alt="" class="dots-image">
        <img src="{{url('website/images/login/right-texture.png')}}" alt="" class="right-texture-image">
        <div class="image_content_inner">
                   <p class="" id="popup_text"></p>
                        <p class="heading-wrap">OTP Verification</p>
                        <!-- <p class="title-line">JustGoNutrition</p> -->


                        <div class="subscribe-new-area-detail">
                            <p class="text-center">Please Enter 6 digit code sent on +91 1234567890</p>
                        
                            <form method="get" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                <input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
                                <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                                <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                                
                                <input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
                                <input type="text" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
                                <input type="text" id="digit-6" name="digit-6" data-previous="digit-5" />
                                <button class="theme-btn-custom">Verify & Continue</button>
                            </form>
                        </div>
					</div>
                    <div class="bottom-text">
                        <p>Didn’t received the code ?</p>
                        <p><a href="">Resend Code</a></p>
                    </div>
                    <div class="bottom-flex">
                    <p class="right-bottom-text first"><span class="bottom-icon"><img src="{{url('website/images/login/icon1.png')}}" alt=""></span>+01 123 456 7890</p>
                    <p class="right-bottom-text second"><span class="bottom-icon"><img src="{{url('website/images/login/icon2.png')}}" alt=""></span>contact@justgo.com</p>
                    </div>
                    
        </div>
    </div>
</section>
<script>
    $('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		var parent = $($(this).parent());
		
		if(e.keyCode === 8 || e.keyCode === 37) {
			var prev = parent.find('input#' + $(this).data('previous'));
			
			if(prev.length) {
				$(prev).select();
			}
		} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
			var next = parent.find('input#' + $(this).data('next'));
			
			if(next.length) {
				$(next).select();
			} else {
				if(parent.data('autosubmit')) {
					parent.submit();
				}
			}
		}
	});
});
</script>



















