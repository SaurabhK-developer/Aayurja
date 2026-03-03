@include('website.header')

<section class="referral-area">
  <div class="container">
    <div class="row">

      <div class="col-lg-6">
        <div class="referral-detail-box">
          <h1 class="heading">Connect with loved ones, enhance health and prosperity!</h1>
          <p>Aayurja’s Referral Program lets you introduce friends to our premium organic products. Share the link, and when they buy, you earn exclusive rewards. It’s a win-win for health and happiness, benefiting both you and your loved ones.</p>
          
          @if(Auth::check())
            

            <div class="referral-code-wrap">
                <span>Your referral code</span>
                <div>
                    <label id="referral-code">{{@$referalCode->title}}</label>
                    <a class="theme-button" id="copy-btn">Copy</a>
                </div>
                <button data-toggle="modal" data-target="#exampleModal">
                    <i class="fa-solid fa-link"></i>
                </button>
            </div>
          @else
            <a href="javascript:void(0);" class="theme-button" data-toggle="modal" data-target="#loginModel" aria-label="Like this item">Share Your Referral Link</a>
          @endif


        </div>
      </div>

      <div class="col-lg-6">
        <div class="referral-image">
          <img src="{{url('public/images/referral-img.webp')}}" alt="text" loading="lazy">
        </div>
      </div>
    </div>
  </div>
  <img src="{{url('public/images/referral-vec-one.png')}}" class="referral-vec-one" alt="text" loading="lazy">
  <img src="{{url('public/images/popular-vector.png')}}" class="referral-vec-two" alt="text" loading="lazy">
</section>

<section class="referral-works">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="heading">How It Works & Benefits</h2>
      </div>

      <div class="col-lg-4">
        <div class="referral-benefit-box">
        <img src="{{url('public/images/referral-benefit-1.png')}}" alt="text" loading="lazy">
        <h3 class="heading"> Invite Friends</h3>
        <p>Invite your friends with your referral link and let them discover the benefits of organic health. As they join, you unlock exciting rewards and exclusive offers.</p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="referral-benefit-box">
        <img src="{{url('public/images/referral-benefit-2.png')}}" alt="text" loading="lazy">
        <h3 class="heading"> They Purchase, <br> You Earn</h3>
        <p>When your friends complete their first purchase, you earn a special discount or get cashback as a token of appreciation.</p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="referral-benefit-box">
        <img src="{{url('public/images/referral-benefit-3.png')}}" alt="text" loading="lazy">
        <h3 class="heading"> Enjoy Exclusive <br> Rewards</h3>
        <p>Earn exclusive referral points and enjoy special discounts with every successful referral. and watch your rewards grow!</p>
        </div>
      </div>
    </div>
  </div>

  <img src="{{url('public/images/referral-work-vec-one.png')}}" class="referral-work-vecone" alt="text" loading="lazy">
  <img src="{{url('public/images/referral-work-vec-two.png')}}" class="referral-work-vectwo" alt="text" loading="lazy" >
</section>

<div class="modal fade refer-modal-back" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">share referral code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="referral-share-body">
          <p>share this link via</p>
          <div class="sharing-links-referral">
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://yourwebsite.com/referral?code={{@$referalCode->title}}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
            
            <span><i class="fa-brands fa-x-twitter"></i></span>
            <span><i class="fa-brands fa-instagram"></i></span>
            <span><i class="fa-brands fa-whatsapp"></i></span>
            <span><i class="fa-solid fa-link"></i></span>
          </div>
          <p>or copy code</p>
          <div class="modal-refferal-code-copy">
            <label id="referral-code-two">{{@$referalCode->title}}</label>
            <a class="theme-button" id="copy-btn-two">copy</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('website.footer')


<script>
  $(document).ready(function() {
      $('#copy-btn').on('click', function() {
          // Get the referral code text
          var referralCode = $('#referral-code').text();

          // Copy the text to the clipboard
          var tempInput = $('<input>');
          $('body').append(tempInput);
          tempInput.val(referralCode).select();
          document.execCommand('copy');
          tempInput.remove();

          // Change button label to "Copied"
          $(this).text('Copied');

          // Reset the button label back to "Copy" after 3 seconds
          setTimeout(() => {
              $(this).text('Copy');
          }, 5000);
      });



      // Handle the second copy functionality
    $('#copy-btn-two').click(function () {
      const referralCodeTwo = $('#referral-code-two').text();
      navigator.clipboard.writeText(referralCodeTwo).then(() => {
        $(this).text('Copied');
        setTimeout(() => {
          $(this).text('Copy');
        }, 2000); // Reset after 2 seconds
      });
    });
  });


  
</script>