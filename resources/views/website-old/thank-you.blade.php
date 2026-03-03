
@include('website.header')
<section class="thank-you-wrapper">
   <img src="{{url('website/images/thank-you-left.png')}}" class="left-image" >
   <img src="{{url('website/images/thank-you-right.png')}}" class="right-image" >
   <div class="container">
      <div class="row">
         <div class="thank-you-image">
            <img src="website/images/thank-you-image.png">
         </div>
         <div class="content">
            <p>We’ve sent your order details to your inbox. Now enjoy 20% off your next purchase Just apply the coupon code SAVE20 to your purchase within the next 24 hours</p>
            <div class="btn-wrap">
               <a href="#" class="theme-btn">
               Back to Homepage
               </a>
               <a href="#" class="theme-btn2 theme-btn-custom">
               Continue Shopping
               </a>
            </div>
         </div>
      </div>
   </div>
</section>
@include('website.footer')