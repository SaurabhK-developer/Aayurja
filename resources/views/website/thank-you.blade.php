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
            @php
            $type = request()->query('type');
            @endphp

            @if ($type === 'review')
            <h1 class="heading">Thanks for submitting Review! <br>Your review will be published soon.</h1> 
            <p>It was a pleasure serving you. Thank you for shopping with us!</p>
            @elseif($type == "againreview")
            <h1 class="heading">You submitting Review Already On This Product! <br>Thank You Again.</h1> 
            <p>It was a pleasure serving you. Thank you for shopping with us!</p>
            @else
            <h1 class="heading">Thanks for Shopping With Us! <br>We Hope You Love Your Purchase.</h1> 
            <p>It was a pleasure serving you. Thank you for shopping with us!</p>
            @endif
            <ul class="thanks-social">
                <li><a href="https://www.facebook.com/aayurja.official" target="_blank" class=""><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="https://www.instagram.com/aayurjaofficial?igsh=Yng0M2tmc293ZDM5" class="" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
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