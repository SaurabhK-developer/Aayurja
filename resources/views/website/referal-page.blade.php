@include('website.header')

<section class="referral-area">
  <div class="container">
    <div class="row">

      <div class="col-lg-6">
        <div class="referral-detail-box">
          <h1 class="heading">Connect with loved ones, enhance health and prosperity!</h1>
          <p>Aayurja’s Referral Program lets you introduce friends to our premium organic products. Share the link, and when they buy, you earn exclusive rewards. It’s a win-win for health and happiness, benefiting both you and your loved ones.</p>
          <a class="theme-button">Share Your Referral Link</a>

          <!-- <div class="referral-code-wrap">
            <span>your referral code</span>
            <div>
              <label>AYU-R12433466</label>
              <a class="theme-button">copy</a>
            </div>
            <button data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-link"></i></button>
          </div> -->

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
  <img src="{{url('public/images/referral-work-vec-two.png')}}" class="referral-work-vectwo" alt="text" loading="lazy">
</section>

@include('website.footer')