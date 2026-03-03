@include('website.header')

<!-- Event snippet for Website Purchase conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-16756919325/18W2CM2KieMZEJ2YqbY-',
      'transaction_id': ''
  });
</script>



<script>
  fbq('track', 'Purchase', {
    value: 2200,
    currency: 'INR',
  });
</script>
<section class="error-page thankyou-page top-space">
    <div class="errorpage-content container">
        <div>
            <img src="{{url('public/images/thankyou.webp')}}" class="img-responsive" alt="thanks" loading="lazy"/>
         
            <h1 class="heading">Your Order Is Successful.</h1> 
            <p>It was a pleasure serving you. Thank you for shopping with us!</p>
        
            <ul class="thanks-social">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="https://www.instagram.com/aayurjaofficial?igsh=Yng0M2tmc293ZDM5"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
            </ul>
        </div> 
    </div>

    <img src="{{url('public/images/popular-vector.png')}}" class="errorvector-1" alt="vector" loading="lazy">
    <img src="{{url('public/images/lotus-icon.png')}}" class="errorvector-2" alt="vector" loading="lazy">
    <img src="{{url('public/images/award-vector.png')}}" class="errorvector-3" alt="vector" loading="lazy">
</section>

@include('website.footer')