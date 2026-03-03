<?php include 'header.php'; ?>

<!-- Banner -->
<section class="banner-section">
   <div class="banner-slider">
      <div class="slider-items">
         <img src="images/banner-slider1.png" alt="Giftopia Logo">
      </div>
      <div class="slider-items">
         <img src="images/banner-slider1.png" alt="Giftopia Logo">
      </div>
   </div>
</section>
<section class="gifted-section">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="quick-search">
               <h3 class="quick-search-title">
                  Find your desired gift
               </h3>
               <form id="quick-search-form" autocomplete="off">
                  <div class="sec occassions-input pincodeSec">
                     <input type="text" id="QuickSeacrchpincode" placeholder="Enter Pincode">
                  </div>
                  <a data-toggle="modal" data-target="#basicModal" class="sec occassions-input">
                     <span class="inputs-sec" id="occassions">Occasion<span class="placeholders">Birthday, Anniversary etc.</span></span>
                  </a>
                  <a data-toggle="modal" data-target="#basicModal2" class="sec gift-input">
                     <span class="inputs-sec" id="giftType">Gift Type<span class="placeholders">Flowers, Cakes, Plants, etc.</span></span>
                  </a>
                  <div class="sec submit">
                     <button type="button" id="quick-search-btn"> <i class="fa-solid fa-magnifying-glass"></i> Find Gifts</button>
                  </div>
               </form>
               <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title" id="myModalLabel">Select Occasion</h4>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <div class="listPopup">
                              <ul>
                                 <li>Raksha Bandhan</li>
                                 <li>Birthday</li>
                                 <li>Anniversary</li>
                                 <li>Love N Romance</li>
                                 <li>Congratulations</li>
                                 <li>House Warming</li>
                                 <li>Get Well Soon</li>
                                 <li>Sympathy N Funeral</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal fade" id="basicModal2" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title" id="myModalLabel">Select Gift Type </h4>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <div class="listPopup">
                              <ul>
                                 <li>All Gifts</li>
                                 <li>Cakes</li>
                                 <li>Flowers</li>
                                 <li>Personalised Gifts</li>
                                 <li>Chocolates</li>
                                 <li>Plants</li>
                                 <li>Combos</li>
                                 <li>Premium Gifts</li>
                                 <li>Balloon Decorations</li>
                                 <li>Gift Hampers</li>
                                 <li>All Rakhi</li>
                                 <li>Single Rakhi</li>
                                 <li>Set of 2 Rakhi</li>
                                 <li>Kids Rakhi</li>
                                 <li>Bhaiya Bhabhi Rakhi</li>
                                 <li>Rakhi Sets</li>
                                 <li>Sweets</li>
                                 <li>DryFruits</li>
                                 <li>Quirky Gifts</li>
                                 <li>Toys and Games</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="Bestsellers space-top">
   <div class="container-fluid">
      <div class="stsellers-wrap">
         <div class="row align-items-center">
            <div class="col-md-12 col-lg-6">
               <div class="category-title">
                  Effortlessly Stylish Bestsellers
               </div>
            </div>
            <div class="col-md-12 col-lg-6">
               <div class="view-wrap">
                  <a href="#" class="theme-button ">
                     View all
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container max-container">
      <div class="sellers-slider">
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img1.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img2.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img3.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="category-section space-top">
   <div class=" container-fluid">
      <div class="category-title">
         Thoughtfully Curated Gifts
      </div>
      <div class="categories  wow fadeInUp" data-wow-duration="2.0s">
         <div class=" categories1 impressionBannerPoc">
            <div class="row">
               <div class="col-sm-6 col-lg-6">
                  <div class="singleCat  BannerPoc">
                     <a href=" #">
                        <div class="aspectRation col2 sbb">
                           <div class="image">
                              <img loading="lazy" src="images/category1.png" alt="Orchids">
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-6">
                  <div class="singleCat  BannerPoc ">
                     <a href="#">
                        <div class="aspectRation col2 sbb">
                           <div class="image">
                              <img loading="lazy" src="images/category2.png" data-imageurl="/assets/images/custom/new-desk-home/shop-by-cat/new/SBB-Hero_Desk_Plants.jpg" alt="Plants">
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="singleCat  wow  slideInLeft" data-wow-duration="1.0s">
                     <a href=" #">
                        <div class="gifted-col">
                           <div class="image-wrap">
                              <img loading="lazy" src="images/gift1.png" alt="Cakes Bestsellers">
                           </div>
                           <div class="badge-overlay">
                              <!-- Change Badge Position, Color, Text here-->
                              <span class="top-left badge orange">Sale 50% Off</span>
                           </div>
                        </div>
                        <div class="content">
                           <h3 class="subheading">Let them relish each moment with a Cake from you</h3>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="singleCat  wow  slideInLeft" data-wow-duration="2.0s">
                     <a href="#">
                        <div class="gifted-col">
                           <div class="image-wrap">
                              <img loading="lazy" src="images/gift2.png" alt="Cakes Bestsellers">
                           </div>
                           <div class="badge-overlay">
                              <h3 class="top-left badge orange">Sale 50% Off</h3>
                           </div>
                        </div>
                        <div class="content">
                           <h3 class="subheading">Let them relish each moment with a Cake from you</h3>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="singleCat wow  slideInLeft" data-wow-duration="3.0s">
                     <a href=" #">
                        <div class="gifted-col">
                           <div class="image-wrap">
                              <img loading="lazy" src="images/gift3.png" alt="Cakes Bestsellers">
                           </div>
                           <div class="badge-overlay">
                              <h3 class="top-left badge orange">Sale 50% Off</h3>
                           </div>
                        </div>
                        <div class="content">
                           <h3 class="subheading">Let them relish each moment with a Cake from you</h3>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3">
                  <div class="singleCat wow  slideInLeft" data-wow-duration="4.0s">
                     <a href=" #">
                        <div class="gifted-col">
                           <div class="image-wrap">
                              <img loading="lazy" src="images/gift4.png" alt="Cakes Bestsellers">
                           </div>
                           <div class="badge-overlay">
                              <h3 class="top-left badge orange">Sale 50% Off</h3>
                           </div>
                        </div>
                        <div class="content">
                           <h3 class="subheading">Let them relish each moment with a Cake from you</h3>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--  -->
<section class="gift-section space-top wow  fadeInUp" data-wow-duration="4.0s">
   <div class=" container">
      <div class="gift-inner ">
         <div class=" top-heading">
            <h4>We deliver 200,000+ gifts annually <br> on behalf of our global clients</h4>
            <div class="row  align-items-center">
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/chicks.png" alt="chicks">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/loreal.png" alt="Loreal">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/pickle-wickle.png" alt="pickle-wickle">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/pikkol.png" alt="Pikkol">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/tiaraa.png" alt="Pikkol">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/haldirams.png" alt="haldirams">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/shiprocket.png" alt="shiprocket">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/awl.png" alt="shiprocket">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/skilevents.png" alt="shiprocket">
                  </div>
               </div>
               <div class="brand-items">
                  <div class="brand-logo">
                     <img src="images/texg-mahindra.png" alt="shiprocket">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="birthday-section">
   <div class="container">
      <div class="birthday-inner">
         <div class="birthday-col ">
            <div class="wow  slideInRight animated" data-wow-duration="1.0s">
               <div class=" image">
                  <img src="images/birthday.png" alt="shiprocket">
               </div>
               <h5> Birthday </h5>
            </div>
         </div>
         <div class="birthday-col">
            <div class="wow  slideInRight animated" data-wow-duration="2.0s">
               <div class=" image">
                  <img src="images/anniversary.png" alt="shiprocket">
               </div>
               <h5> Anniversary </h5>
            </div>
         </div>
         <div class="birthday-col">
            <div class="wow  slideInRight animated" data-wow-duration="3.0s">
               <div class=" image">
                  <img src="images/getwell.png" alt="shiprocket">
               </div>
               <h5> Get Well Soon </h5>
            </div>
         </div>
         <div class="birthday-col">
            <div class="wow  slideInRight animated" data-wow-duration="4.0s">
               <div class=" image">
                  <img src="images/romntic.png" alt="shiprocket">
               </div>
               <h5> Romantic </h5>
            </div>
         </div>
         <div class="birthday-col ">
            <div class="wow  slideInRight animated" data-wow-duration="5.0s">
               <div class=" image">
                  <img src="images/congratu.png" alt="shiprocket">
               </div>
               <h5> Congratulations </h5>
            </div>
         </div>
         <div class="birthday-col ">
            <div class="wow  slideInRight animated" data-wow-duration="6.0s">
               <div class=" image">
                  <img src="images/thank-yo.png" alt="shiprocket">
               </div>
               <h5> Thank You </h5>
            </div>
         </div>
         <div class="birthday-col ">
            <div class="wow  slideInRight animated" data-wow-duration="7.0s">
               <div class="image">
                  <img src="images/just-vibe.png" alt="shiprocket">
               </div>
               <h5> Just Happy Vibe </h5>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="trending-section space-top ">
   <div class="container">
      <div class="category-title">
         Top Trending Categories
      </div>
      <div class="row">
         <div class="trending-items">
            <div class="trending-col wow  slideInLeft" data-wow-duration="1.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/r-gift1.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Personalized Gifts </h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInLeft" data-wow-duration="2.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/gadgets.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Tech Gadgets </h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInLeft" data-wow-duration="3.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/eco-friendly.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Eco-Friendly Gifts </h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInLeft" data-wow-duration="4.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/artisanal.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Artisanal Products </h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInLeft" data-wow-duration="5.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/Wellness.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Wellness Gifts </h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInRight" data-wow-duration="5.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/home-decor.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Home Decor </h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInRight" data-wow-duration="4.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/pantry.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Pantry</h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInRight" data-wow-duration="3.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/fashion.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Fashion Accessories</h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInRight" data-wow-duration="2.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/festive1.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Festive Gift Hamper</h5>
               </div>
            </div>
         </div>
         <div class="trending-items">
            <div class="trending-col wow  slideInRight" data-wow-duration="1.0s">
               <div class=" trending-wraps">
                  <div class="image">
                     <img src="images/spiritual.png" alt="shiprocket">
                  </div>
                  <div class="dis">
                     Min. 25% OFF*
                  </div>
               </div>
               <div class="content">
                  <h5>Spiritual Products</h5>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="shop-now space-top wow rotateInUpLeft">
   <img src="images/shop-now.png" alt="shiprocket">
</section>
<!--  -->
<section class="product-sec space-top">
   <div class=" container-fluid">
      <div class="row justify-content-center">
         <div class="product-items">
            <div class="product-col wow  slideInUp " data-wow-duration="1s">
               <div class=" image">
                  <img src="images/pro-aniversary.png" alt="shiprocket">
               </div>
               <div class="content">
                  <h3 class="subheading">Anniversary</h3>
               </div>
            </div>
         </div>
         <div class="product-items">
            <div class="product-col wow  slideInUp " data-wow-duration="0.1s">
               <div class=" image">
                  <img src="images/pro-birthday.png" alt="shiprocket">
               </div>
               <div class="content">
                  <h3 class="subheading">Birthday</h3>
               </div>
            </div>
         </div>
         <div class="product-items">
            <div class="product-col wow  slideInUp " data-wow-duration="0.2s">
               <div class=" image">
                  <img src="images/pajama-party.png" alt="shiprocket">
               </div>
               <div class="content">
                  <h3 class="subheading">Pajama Party</h3>
               </div>
            </div>
         </div>
         <div class="product-items">
            <div class="product-col wow  slideInUp " data-wow-duration="0.3s">
               <div class=" image">
                  <img src="images/mother-party.png" alt="shiprocket">
               </div>
               <div class="content">
                  <h3 class="subheading">Mother's Day</h3>
               </div>
            </div>
         </div>
         <div class="product-items">
            <div class="product-col wow  slideInUp " data-wow-duration="0.4s">
               <div class=" image">
                  <img src="images/date-night.png" alt="shiprocket">
               </div>
               <div class="content">
                  <h3 class="subheading">Date Night</h3>
               </div>
            </div>
         </div>
         <div class="product-items">
            <div class="product-col wow  slideInUp " data-wow-duration="0.5s">
               <div class=" image">
                  <img src="images/get-together.png" alt="shiprocket">
               </div>
               <div class="content">
                  <h3 class="subheading">Get together</h3>
               </div>
            </div>
         </div>
         <div class="product-items">
            <div class="product-col wow  slideInUp " data-wow-duration="0.6s">
               <div class=" image">
                  <img src="images/books.png" alt="shiprocket">
               </div>
               <div class="content">
                  <h3 class="subheading">Books</h3>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="category-section  gift-city space-top">
   <div class="container-fluid">
      <div class="category-title">
         Gifts to Cities
      </div>
      <div class="categories wow animated fadeInUp" data-wow-duration="1s">
         <div class=" categories1 impressionBannerPoc">
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/gurugram.png" alt="Gurugram">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Gurugram</h3>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/bengaluru.png" alt="Bengaluru">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Bengaluru</h3>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/delhi.png" alt="Cakes Bestsellers">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Delhi</h3>
                     </div>
                  </div>
               </div>
               <div class=" col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/noida.png" alt="Cakes Bestsellers">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Noida</h3>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/jaipur.png" alt="Cakes Bestsellers">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Jaipur</h3>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/mumbai.png" alt="Cakes Bestsellers">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Mumbai</h3>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/amritsar.png" alt="Cakes Bestsellers">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Amritsar</h3>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="singleCat">
                     <div class="gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/lucknow.png" alt="Cakes Bestsellers">
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Lucknow</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--  -->
<section class="missed-section space-top">
   <div class="container-fluid">
      <div class="category-title">
         Too Hot To Be Missed
      </div>
      <div class="categories">
         <div class="Missed-row">
            <div class="row">
               <div class="col-sm-6 col-md-6">
                  <div class="singleCat  wow animated fadeInLeft" data-wow-duration="1s">
                     <div class=" gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/summer-gift1.png" alt="Cakes Bestsellers">
                        </div>
                        <div class="badge-overlay">
                           <!-- Change Badge Position, Color, Text here-->
                           <span class="top-left badge orange"> 45% Off</span>
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Get Your <br> Summer Gifts</h3>
                        <a href="#" class="theme-button"> Shop Now </a>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="singleCat  wow animated fadeInRight" data-wow-duration="1s">
                     <div class=" gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/summer-gift2.png" alt="Cakes Bestsellers">
                        </div>
                        <div class="badge-overlay">
                           <h3 class="top-left badge orange"> 33% Off</h3>
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Discover Your <br> Perfect Gift</h3>
                        <a href="#" class="theme-button"> Shop Now </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="gift-slider  space-top">
   <div class="gift-slider-col">
      <div class="slider-wraps white-color">
         <div class="image">
            <img src="images/boys1.png" alt="Boy">
         </div>
         <div class="content">
            <div class="top">
               <h3>For Him</h3>
               <p>Gifts for him to make him feel special</p>
            </div>
            <div class="bottom">
               <span>from</span>
               <strong>₹399</strong>
            </div>
         </div>
      </div>
      <div class="slider-wraps ">
         <div class="image">
            <img src="images/girls-img.png" alt="Boy">
         </div>
         <div class="content">
            <div class="top">
               <h3>For Him</h3>
               <p>Gifts for him to make him feel special</p>
            </div>
            <div class="bottom">
               <span>from</span>
               <strong>₹399</strong>
            </div>
         </div>
      </div>
      <div class="slider-wraps  white-color">
         <div class="image">
            <img src="images/boys1.png" alt="Boy">
         </div>
         <div class="content">
            <div class="top">
               <h3>For Him</h3>
               <p>Gifts for him to make him feel special</p>
            </div>
            <div class="bottom">
               <span>from</span>
               <strong>₹399</strong>
            </div>
         </div>
      </div>
      <div class="slider-wraps ">
         <div class="image">
            <img src="images/girls-img.png" alt="Boy">
         </div>
         <div class="content">
            <div class="top">
               <h3>For Him</h3>
               <p>Gifts for him to make him feel special</p>
            </div>
            <div class="bottom">
               <span>from</span>
               <strong>₹399</strong>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="missed-section space-top">
   <div class="container-fluid">
      <div class="category-title">
         Our Best Picks
      </div>
      <div class="categories">
         <div class="Missed-row">
            <div class="row">
               <div class="col-sm-6 col-md-6">
                  <div class="singleCat  wedding-one  wow animated fadeInLeft" data-wow-duration="1s">
                     <div class=" gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/w-gift1.png" alt="Cakes Bestsellers">
                        </div>
                        <div class="badge-overlay">
                           <!-- Change Badge Position, Color, Text here-->
                           <span class="top-left badge orange"> Special Offer </span>
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Precious <br> Wedding Gifts</h3>
                        <a href="#" class="shop-now"> Shop Now </a>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="singleCat  wedding-one  wow animated fadeInRight" data-wow-duration="1s">
                     <div class=" gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/w-gift2.png" alt="Cakes Bestsellers">
                        </div>
                        <div class="badge-overlay">
                           <h3 class="top-left badge orange"> upto 45% OFF </h3>
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">make them <br>feel special</h3>
                        <a href="#" class="shop-now"> Shop Now </a>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="singleCat wedding-one wedding-one2  wow animated fadeInUp" data-wow-duration="1s">
                     <div class=" gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/w-gift3.png" alt="Cakes Bestsellers">
                        </div>
                        <div class="badge-overlay">
                           <h3 class="top-left badge orange"> upto 33% OFF </h3>
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Unique Gifts <br> for Family and <br> friends</h3>
                        <a href="#" class="shop-now"> Shop Now </a>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="singleCat wedding-one  wedding-one3  wow animated fadeInUp" data-wow-duration="1s">
                     <div class=" gifted-col">
                        <div class="image-wrap">
                           <img loading="lazy" src="images/w-gift4.png" alt="Cakes Bestsellers">
                        </div>
                        <div class="badge-overlay">
                           <h3 class="top-left badge orange"> upto 33% OFF </h3>
                        </div>
                     </div>
                     <div class="content">
                        <h3 class="subheading">Premium <br> Employee Gifts</h3>
                        <a href="#" class="shop-now"> Shop Now </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- deal of the days -->
<section class="deal-section  space-top  wow animated fadeInUp" data-wow-duration="1s">
   <div class=" container">
      <div class="deal-bg">
         <div class="deal-day">
            <div class="day-inner">
               <div class="left-day">
                  <div class="category-title">
                     Deal of the day
                  </div>
               </div>
               <div class="blank-day"></div>
               <div class="right-day">
                  <div id="week-countdown">
                     <p></p>
                  </div>
               </div>
            </div>
         </div>
         <div class="deal-width">
            <div class="row">
               <div class="col-md-4">
                  <div class="deal-inner">
                     <h5>Cakes <br> Upto 70% Off</h5>
                     <div class="image">
                        <img src="images/deal1.png">
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="deal-inner">
                     <h5>Photo Frames <br> Upto 55% Off </h5>
                     <div class="image">
                        <img src="images/deal2.png">
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="deal-inner">
                     <h5>Home Decor <br> Upto 65% Off </h5>
                     <div class="image">
                        <img src="images/deal3.png">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- gift form  -->
<section class="gift-form ">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-6 col-lg-6 ">
            <div class="gift-content">
               <div class="category-title">
                  Get surprise gift <br> on your birthday
               </div>
               <p>
                  Celebrate your special day with an extra dose of excitement! Sign up now and receive a surprise gift on your birthday, curated just for you.
               </p>
               <form>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="name">Please Enter Your Date of Birth</label>
                           <input class="form-control" id="name" type="date" name="Name" placeholder="DD/MM/YY">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="email" class="email-text"></label>
                           <input class="form-control" id="email" type="email" name="Email" placeholder="Enter Email">
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <button type="submit" class="theme-button"> Get Surprise </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-md-6 col-lg-6">
            <div class="gift-image wow animated slideInRight" data-wow-duration="2s">
               <img src=" images/gift-image.png">
            </div>
         </div>
      </div>
   </div>
</section>
<section class="Bestsellers space-top">
   <div class="container-fluid">
      <div class="stsellers-wrap">
         <div class="row align-items-center">
            <div class="col-md-12 col-lg-6">
               <div class="category-title">
                  Effortlessly Stylish Bestsellers
               </div>
            </div>
            <div class="col-md-12 col-lg-6">
               <div class="view-wrap">
                  <a href="#" class="theme-button ">
                     View all
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container max-container">
      <div class="sellers-slider">
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img1.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img2.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img3.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
         <div class="sellers-col">
            <div class="image-sec">
               <div class="image">
                  <img src="images/elephant-img.png">
               </div>
               <div class="rating">
                  <span>4.1</span>
                  <span class="star"><i class="fa-solid fa-star"></i> </span>
                  <span>13k</span>
               </div>
               <div class="heart-wrap">
                  <a href="#" class="like-btn"> <i class="fa-regular fa-heart"></i> </a>
                  <a href="#" class="like-btn eye-btn"> <i class="fa-regular fa-eye"></i> </a>
               </div>
            </div>
            <div class="content">
               <span class="cat">Giftopia co.</span>
               <h3 class="subheading">Elephant Family Decorative Piece</h3>
               <div class="price-wrap">
                  <span>
                     <strong>₹699</strong>
                  </span>
                  <span>
                     <del>₹1899</del>
                  </span>
                  <span class="off-items"> (₹300 off)</span>
               </div>
               <div class="card-btn">
                  <a href="#" class="theme-button"> Add to cart </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


<section class="delivery-section  space-top">
   <div class="container">
      <div class="delivery-inner">
         <div class="row">
            <div class="col-md-6 col-lg-4">
               <div class="delivery-items wow animated fadeInUp" data-wow-duration="1s">
                  <div class=" icon">
                     <img src="images/deliver-img1.png" alt="Giftopia Logo">
                  </div>
                  <div class="content">
                     <h5>Free Delivery</h5>
                     <p>
                        Explore our edit of everything that <br> ships within 24 hours.
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="delivery-items wow animated fadeInUp" data-wow-duration="2s">
                  <div class="icon">
                     <img src="images/music-icon.png" alt="Giftopia Logo">
                  </div>
                  <div class="content">
                     <h5>100% Money Back</h5>
                     <p>
                        Don't like product? Dont worry about <br> that
                        you will have money back.
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="delivery-items wow animated fadeInUp" data-wow-duration="3s">
                  <div class=" icon">
                     <img src="images/support.png" alt="Giftopia Logo">
                  </div>
                  <div class="content">
                     <h5>24x7 Support</h5>
                     <p>
                        We are here for you where you <br> feel needed
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php include 'footer.php'; ?>