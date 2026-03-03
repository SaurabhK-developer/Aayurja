

@include('website.header')
<section class="error-page top-space">
    <div class="errorpage-content container">
        <div>
            <img src="{{url('public/images/404.webp')}}" class="img-responsive" alt="404"/>
            <h1 class="heading">Uh-oh!!!!! This Product is missing. <br>Let's find something special for you!</h1> 
            <a href="{{url('/')}}" class="theme-button">Back to Homepage</a>
            <a href="{{url('/contact-us')}}" class="theme-button">Contact Us<span></span></a>
        </div> 
    </div>

    <img src="images/popular-vector.png" class="errorvector-1" alt="vector">
    <img src="images/lotus-icon.png" class="errorvector-2" alt="vector">
    <img src="images/award-vector.png" class="errorvector-3" alt="vector">
</section>
@include('website.footer')

