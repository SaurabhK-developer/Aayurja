      <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{url('website/css/style.css')}}">
     <link rel="stylesheet" href="{{url('website/css/payment-failed.css')}}">


<div class="payment-failed-section">
	<div class="container">
		<div class="payment-failed-box">
			<div class="payment-img">
			     <img src="{{url('website/images/sipper.png')}}">
			
			</div>
			<div class="thanku_content_box">
				<h2>Payment Failed!</h2>
				<p>Sorry ! Payment For Order ID <span style="color: #000; font-weight: 600;">{{app('request')->input('order_id')}}</span> Could not be Proceed. Please Try Again</p>

				
				

				<div class="thanku_btn_wrap">
					<a href="/" class="theme-btn-custom">Go to Homepage <span class="arrow">⟶</span></a>
					<a href="/product" class="theme-btn">See Products <span class="arrow">⟶</span></a>
				</div>
			</div>
		</div>
	</div>
</div>



