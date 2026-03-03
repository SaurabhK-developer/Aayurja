@include('website.header')

<section class="error-page thankyou-page top-space fail-page">
    <div class="errorpage-content container">
        <div>
            <img src="{{url('public/images/fail.webp')}}" class="img-responsive" alt="fail" loading="lazy"/>
         
            <h1 class="heading">Payment Declined</h1> 
            <p>Sorry your payment did not go through. Please retry again</p>
        
            <!-- <ul class="thanks-social">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="https://www.instagram.com/aayurjaofficial?igsh=Yng0M2tmc293ZDM5"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
            </ul> -->
        </div> 
    </div>

    <img src="{{url('public/images/popular-vector.png')}}" class="errorvector-1" alt="vector" loading="lazy">
    <img src="{{url('public/images/lotus-icon.png')}}" class="errorvector-2" alt="vector" loading="lazy">
    <img src="{{url('public/images/award-vector.png')}}" class="errorvector-3" alt="vector" loading="lazy">
</section>

@include('website.footer')