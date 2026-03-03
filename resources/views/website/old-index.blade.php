@include('website.header')

<section class="new-banner-setion desktop-banner">
   <div class="banner-slider">
      <div class="banner-col">
         <div class="banner-inner">
            <div class="banner-wrap">
               <img src="{{url('public/images/banner-new1.webp')}}" loading="lazy" alt="Heart" />
               <div class="banner-text">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8 col-lg-6">
                           <div class="banner-inner-content">
                              <h1 class="heading">Embrace the </br> Richness of Nature!</h1>
                              <ul class="bannerlist-item">
                                <li>🌿 Sustainably Sourced</li>
                                <li>🌍 Pure Himalayan Essence</li>
                                <li>🌱 Fully Organic</li>
                              </ul>
                              <div class="button-wrap">
                                 <a href="{{url('shop')}}" class="theme-button">Shop Now </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  
	    <div class="banner-col">
         <div class="banner-inner">
            <div class="banner-wrap">
               <img src="{{url('public/images/banner-new2.webp')}}" loading="lazy" alt="banner" />
               <div class="banner-text">
                  <div class="container">
                     <div class="row banner-col-right">
                        <div class="col-md-7 col-lg-7 col-sm-7">
                           <div class="banner-inner-content">
                              <h2 class="heading">Natural Sweetness </br> You Can Trust!</h2>
                              <ul class="bannerlist-item">
                                <li>🌼 Pure & Organic</li>
                                <li>🍃 Raw & Unprocessed</li>
                                <li>🐝 Direct from Beekeepers</li>
                              </ul>
                              <div class="button-wrap">
                                 <a href="{{url('shop')}}" class="theme-button"> Shop Now </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

	   <div class="banner-col">
         <div class="banner-inner third-slider">
            <div class="banner-wrap">
              <img src="{{url('public/images/banner-new3.webp')}}" loading="lazy" alt="banner" />
              <div class="deskbanner-btn">
                  <a href="{{url('shop')}}" class="theme-button"> Shop Now </a>
              </div>
            </div>
         </div>
      </div>

      <div class="banner-col">
         <div class="banner-inner">
            <div class="banner-wrap">
               <img src="{{url('public/images/banner-new4.webp')}}" loading="lazy" alt="banner" />
               <div class="banner-text">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-8 col-lg-6 col-sm-7">
                           <div class="banner-inner-content forth-slide">
                              <h2 class="heading white-color">Golden Goodness: Pure Honey from Nature’s Finest</h2>
                              <div class="button-wrap">
                                 <a href="{{url('shop')}}" class="theme-button"> Shop Now </a>
                              </div>
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

<!----------->

<section class="mobile-banner mobile-banner">
   <div class="mobile-slider">
      <div class="mobile-col">
         <div class="mobileban-content mobileB-1"> 
            <img src="{{url('public/images/mobile-ban-1.webp')}}" loading="lazy" alt="banner"/>
            <div>
              <h4 class="heading">Embrace the <br>Richness of Nature!</h4>
              <p>🌿 Sustainably Sourced | 🌍 Pure Himalayan Essence | 🌱 Fully Organic</p>
              <a href="{{url('shop')}}" class="theme-button">Shop Now </a>
            </div>
         </div>
      </div>

      <div class="mobile-col">
         <div class="mobileban-content mobileB-2">
            <img src="{{url('public/images/mobile-ban-2.webp')}}" loading="lazy" alt="banner"/>
            <div>
              <h4 class="heading">Natural Sweetness <br>You Can Trust!</h4>
              <p>🌼 Pure & Organic | 🍃 Raw & Unprocessed | 🐝 Direct from Beekeepers</p>
              <a href="{{url('shop')}}" class="theme-button">Shop Now </a>
            </div>
         </div>
      </div>

      <div class="mobile-col">
         <div class="mobileban-onlyimage">
            <img src="{{url('public/images/mobile-ban-3.webp')}}" loading="lazy" alt="banner"/>
            <div>
                <a href="{{url('shop')}}" class="theme-button"> Shop Now </a>
            </div>
         </div>
      </div>

      <div class="mobile-col">
         <div class="mobileban-content mobileB-3">
            <img src="{{url('public/images/mobile-ban-4.webp')}}" loading="lazy" alt="banner"/>
            <div>
              <h4 class="heading">Golden Goodness: <br>Pure Honey from <br>Nature’s Finest</h4>
              <a href="{{url('shop')}}" class="theme-button">Shop Now </a>
            </div>
         </div>
      </div>

   </div>
</section>



<!-- <section class="order-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="order-text">
          <h2>20% on your first order</h2>
          <p>Use Code: <span>First20</span></p>
        </div>
      </div>
    </div>
  </div>
</section> -->


<section class="popular-section top-space">
  <img class="popular-vector" src="{{url('public/images/popular-vector.webp')}}" loading="lazy" alt="Popular" />

  <div class="container">


    <div class="col-lg-12">
      <div class="heading-section">
        <h2 class="heading">Most popular</h2>
      </div>
    </div>
    <div class="popp-slides row">
    @if(count($products) > 0)
    @foreach($products as $key => $product)
        <div class="popp-col">
          <div class="popular-col">
            <div class="popular-inner">
              <div class="image-wrap">
                <div class="image image-style">
                <a href="{{url('product')}}/{{@$product->slug}}"><img src="{{url('public')}}/uploads/product/{{$product->list_image}}"  loading="lazy" alt="{{$product->product_name}}" />  </a> 
                </div>




                @php
                    $productId = $product->id; // The product ID to check.
                @endphp

                @foreach($couponSpecificProduct as $coupon)
                    @php
                        // Convert the product string into an array
                        $productIds = explode(',', $coupon->product);
                    @endphp

                    @if(in_array($productId, $productIds))
                        <div class="flat-dis">
                            <div class="flat-text">
                                <div class="flat-dis-inner">
                                    Get flat {{$coupon->discount_percentage}}% off
                                </div>
                                <div class="circle-text">
                                    <div class="circle-img">
                                        <img src="{{url('public/images/card-circle.webp')}}" loading="lazy" alt="Circle">
                                        <div class="circle-content">
                                            Code
                                            <span>{{strtoupper($coupon->title)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach



                @php
                if(Auth::check()){
                    $wishlist = App\Wishlist::where('user_id', Auth::user()->id)->where('product_id',$product->id)->count(); 
                }else{
                    $wishlist = '';
                }
                @endphp

                <!-- <a href="javascript:void(0);" class="like-btn"  onclick="addToWishlist({{ $product->id }}, this)">
                  <div class="heart-wrap addactive">
                      <i class="fa-solid fa-heart"></i>
                  </div>
                </a> -->
                @if(Auth()->check())
                <a href="javascript:void(0);" class="like-btn" onclick="addToWishlist({{ $product->id }}, this)" aria-label="Like this item">
                  <div class="heart-wrap @if($wishlist) active-heart @endif">
                    <i class="fa-solid fa-heart"></i>
                  </div>
                </a>
                @else
                <a href="javascript:void(0);" class="like-btn" data-toggle="modal" data-target="#loginModel" aria-label="Like this item">
                  <div class="heart-wrap @if($wishlist) active-heart @endif">
                    <i class="fa-solid fa-heart"></i>
                  </div>
                </a>
                @endif
              </div>
              <div class="content">
                <h3>
                <a href="{{url('product')}}/{{@$product->slug}}">{{$product->product_name}}</a>
                </h3>
                <div class="price-wrap">
                  <span>
                    <strong>₹{{number_format($product->variants_price->selling_price)}}</strong>
                  </span>
                  <span>
                    <del>₹{{number_format($product->variants_price->price)}}</del>
                  </span>
                  @if($product->variants_price->discount!=0 or $product->variants_price->discount='')  <span class="off-items">({{$product->variants_price->discount}}% off)</span> @endif
                </div>
                @php
            // Safely handle null review relationship
                $averageRating = $product->review->isNotEmpty() ? $product->review->avg('rating') : 0;
                $totalRatings = $product->review->isNotEmpty() ? $product->review->count() : 0;
            @endphp
                <div class="review-wrap">
                  <div class="review-icon">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($averageRating))
                            <i class="fa-solid fa-star"></i> <!-- Full star -->
                        @elseif ($i == ceil($averageRating) && $averageRating - floor($averageRating) > 0)
                            <i class="fa-solid fa-star-half-alt"></i> <!-- Half star -->
                        @else
                            <i class="fa-regular fa-star"></i> <!-- Empty star -->
                        @endif
                    @endfor
      
                  </div>
                  <div class="review-txt">
                    {{-- <p>299 ratings</p> --}}
                    <p>{{ $totalRatings }} ratings</p>
                  </div>
                </div>
                @if(Auth()->check())
                    @if($product->outofstock == 0)
                    <div class="button-wrap">
                      <a href="javascript::void(0)" class="theme-button submitbtnbyclass" data-weight="{{$product->variants_size->weight}}" data-quantity="1" data-productid="{{$product->id}}" data-productname="{{$product->product_name}}" data-sellingprice="{{number_format($product->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$product->list_image}}">
                        <img src="{{url('public/images/shopping-icon.png')}}" alt="Shopping" loading="lazy" /> Add to cart
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                      </a>
                    </div>
                    
                      @else

                      <div class="button-wrap">
                      <a class="theme-button">
                        <img src="{{url('public/images/shopping-icon.png')}}"   alt="Shopping" loading="lazy"/> Out of Stock
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                      </a>
                    </div>
                    @endif
                  @else
                  @if($product->outofstock == 0)
                      <div class="button-wrap">
                        <a class="theme-button" data-toggle="modal" data-target="#loginModel" href="#">
                          <img src="{{url('public/images/shopping-icon.png')}}"  alt="Shopping"  loading="lazy" /> Add to cart
                          <span></span>
                          <span></span>
                          <span></span>
                          <span></span>
                        </a>
                      </div>
                      @else

                      <div class="button-wrap">
                      <a class="theme-button">
                        <img src="{{url('public/images/shopping-icon.png')}}"   alt="Shopping" loading="lazy"/> Out of Stock
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                      </a>
                    </div>
                    @endif
                  @endif
                
              </div>
            </div>
          </div>
        </div>
      @endforeach
      @endif
   </div>
  </div>
</section>

<!------->

<section class="revolution-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-10">
        <div class="content-text">
          <div class="heading-section">
            <span>About Aayurja</span>
            <h4 class="heading">Revolutionising Wellness, Naturally</h4>
          </div>
          <div class="subtitle">
          Pure Herbal Excellence. Nothing More, Nothing Less.
          </div>
          <p>
          Experience the blend of time-honoured Ayurvedic wisdom with advanced modern research, creating a powerful range of natural wellness products. Our offerings, including honey, Gucchi mushrooms, Shilajit, and Kesar, are crafted to bring the highest level of health benefits.
          </p>
          <p>
          Made from 100% pure ingredients, they boost vitality, support immunity, and elevate your well-being.
          </p>
          <p>
          Embrace the journey toward natural health with Aayurja’s premium selection, inspired by ancient traditions for the modern lifestyle.
          </p>
          <div class="button-wrap">
            <a href="{{url('/shop')}}" class="theme-button"> Shop Natural Product </a>
          </div>
        </div>
      </div>
    </div>
  </div>

    <img src="{{url('public/images/lotus-icon.webp')}}"  loading="lazy" class="revol-vector" alt="vector" />
</section>



<div class="homepage-video">
    <!-- <img src="{{url('public/images/video-thumbnail.webp')}}" class="video-thumb" alt="video" /> -->

    <div class="video" id="player" autoplay loop playsinline muted>
        <!-- <source src="{{url('public/video/aayurja-video.mp4')}}" loading="lazy" type="video/mp4"> -->
        <img src="{{url('public/video/aayurja-video.webp')}}" loading="lazy"  alt="vector" />
              </div>

    <a id="MuteButton" class="muted-butn desktop-video" onclick="toggleMute();"></a>

   <!--  <div class="playpause">
        <a class="video-play-button" href="javascript:void(0);"><span></span></a> 
    </div> -->
</div> 

<!--------->

<!-- shop by category -->
<section class="category-section top-space">
  <img
    class="popular-vector"
    src="{{url('public/images/popular-vector.webp')}}"
    loading="lazy"  alt="Popular" />
  <div class="container">
    <div class="heading-section">
      <h4 class="heading">Shop by category</h4>
    </div>
  </div>
  
  <div class="category-slider">
    <div class="category-col">
      <div class="category-inner">
          <a href="{{url('/')}}/shop/honey">
            <div class="image">
              <img src="{{url('public/images/category-img-1.webp')}}" loading="lazy" alt="category"/>
            </div>
            <div class="content">
              <h4>Honey</h4>
            </div>
          </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="{{url('/')}}/shop/gucchi-mushroom">
          <div class="image">
            <img src="{{url('public/images/category-img-2.webp')}}" loading="lazy" alt="category"/>
          </div>
          <div class="content">
            <h4>gucchi mushroom</h4>
          </div>
        </a>
      </div>
    </div>
    <div class="category-col">
      <div class="category-inner">
        <a href="{{url('/')}}/shop/shilajit">
          <div class="image">
            <img src="{{url('public/images/category-img-3.webp')}}" loading="lazy" alt="category"/>
          </div>
          <div class="content">
            <h4>Shilajit</h4>
          </div>
        </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="{{url('/')}}/shop/honey">
          <div class="image">
            <img src="{{url('public/images/category-img-4.webp')}}" loading="lazy" alt="category"/>
          </div>
          <div class="content">
            <h4>Honey</h4>
          </div>
        </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="{{url('/')}}/shop/gucchi-mushroom">
          <div class="image">
            <img src="{{url('public/images/category-img-5.webp')}}" loading="lazy"  alt="category"/>
          </div>
          <div class="content">
            <h4>gucchi mushroom</h4>
          </div>
        </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="{{url('/')}}/shop/shilajit">
          <div class="image">
            <img src="{{url('public/images/category-img-6.webp')}}" loading="lazy" alt="category"/>
          </div>
          <div class="content">
            <h4>Shilajit</h4>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!--------->

<section class="home-recipe">
  <div class="container">
    <div class="row">

      <div class="col-md-12 recipe-head">
          <h4 class="heading">Our Latest Recipes</h4>
          <p>Explore new tastes and flavors</p>
      </div>

      <div class="col-md-12">
        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-1.webp')}}" loading="lazy" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Risotto</h4>
                <p>Creamy Arborio rice cooked with tender morel mushrooms, white wine, and Parmesan cheese. This luxurious risotto highlights the earthy flavor of morels in every bite.</p>
            </div>
            <div class="recipebox-arrow">
              <span>01
                <img src="{{url('public/images/green-arrow.png')}}" loading="lazy" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-2.webp')}}" loading="lazy"  alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Soup</h4>
                <p>A rich and velvety soup made with sautéed morel mushrooms, onions, and garlic, finished with a splash of cream. Perfect as a comforting starter or light main course.</p>
            </div>
            <div class="recipebox-arrow">
              <span>02
                <img src="{{url('public/images/green-arrow.png')}}" loading="lazy"  alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-3.webp')}}" loading="lazy" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Pasta</h4>
                <p>Fresh pasta tossed with sautéed morel mushrooms, garlic, and herbs, and finished with a light cream sauce. A simple yet elegant dish showcasing the unique flavor of morels.</p>
            </div>
            <div class="recipebox-arrow">
              <span>03
                <img src="{{url('public/images/green-arrow.png')}}" loading="lazy" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-4.webp')}}" loading="lazy" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Tart</h4>
                <p>A savory tart filled with a mixture of sautéed morel mushrooms, cheese, and fresh herbs, all encased in a buttery pastry crust. Ideal for brunch or a sophisticated appetizer.</p>
            </div>
            <div class="recipebox-arrow">
              <span>04
                <img src="{{url('public/images/green-arrow.png')}}" loading="lazy" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-5.webp')}}" loading="lazy" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Honey-Lavender Glazed panCakes</h4>
                <p>A succulent salmon fillet glazed with a sweet and aromatic honey-lavender sauce. The honey adds a rich sweetness, while the lavender infuses a floral note, creating a beautifully balanced and elegant dish.</p>
            </div>
            <div class="recipebox-arrow">
              <span>05
                <img src="{{url('public/images/green-arrow.png')}}" loading="lazy" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>
      </div>

      <div class="col-md-12 recipe-more">
          <a href="javascript:void(0)" class="theme-button">View All</a>
      </div>

    </div>
  </div>

  <img src="{{url('public/images/recipe-pattern.png')}}" loading="lazy" class="recipe-vector" alt="pattern"/>
</section>

<!--------->

<section class="connect-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="connect-text">
          <h4 class="heading">Large Order Inquiries - Get in Touch!</h4>
          <p>
          Are you interested in placing a bulk order or require global delivery of our products? We are ready to assist you! Reach out to us on WhatsApp at <a href="https://wa.me/917055433885?text=Hi" target="_blank">+91-8057244477</a> for efficient coordination and tailored service.
          </p>
          <div class="conncet-btn">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#bulkbuy" class="theme-button">Contact Us for Bulk Order</a>
            <a href="https://wa.me/917055433885?text=Hi" target="_blank" class="theme-button theme-button2">Contact on What’s app</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-difference">  
    <div class="container">     
        <div class="row">   

            <div class="col-lg-7 col-md-12">
              <div class="home-whydetail">
                  <h4 class="heading">Why We Are Different The Guchhi Mushroom Journey</h4>
                  <p>At the heart of what we do is a commitment to delivering the finest morel mushrooms, cultivated and selected with the utmost care. Our process is meticulous, ensuring that every step—from farming to final selection—upholds the highest standards of quality.</p>
              </div> 
            </div> 

            <div class="col-lg-5 col-md-12 homewhy-space">
                <div class="homewhy-move">
                    <div class="webcard-header"></div>
                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-1.webp')}}" loading="lazy" alt="Mushroom">
                        <div>
                            <h4>Sustainable Farming Practices</h4>
                            <p>We pride ourselves on practicing environmentally conscious farming that mirrors the conditions of the wild where morel mushrooms naturally thrive.</p>
                        </div>
                    </div>

                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-2.webp')}}" loading="lazy" alt="Mushroom">
                        <div>
                            <h4>Hand-Picking at Peak Maturity</h4>
                            <p>Foraging is an art, and our team of skilled foragers is trained to know exactly when each morel is ready to be harvested.</p>
                        </div>
                    </div>

                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-3.webp')}}" loading="lazy" alt="Mushroom">
                        <div>
                            <h4>Rigorous Selection Process</h4>
                            <p>Once harvested, our morels go through a detailed selection process to ensure only the highest quality mushrooms make it to our customers.</p>
                        </div>
                    </div>

                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-4.webp')}}" loading="lazy" alt="Mushroom">
                        <div>
                            <h4>Preserving Freshness with Care</h4>
                            <p>Preserving the natural qualities of morel mushrooms is just as important as how they are grown and harvested, After selection.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 
    
    <img src="{{url('public/images/blog-vector.webp')}}" loading="lazy" class="homewhy-vector" alt="flower" />
</section>

<!------>

<section class="testimonial-section top-space homecard-top">
  <div class="container">

  <div class="heading-section">
            <h5 class="heading">
              Customer Cheers<br />
              Wellness Reviews
            </h5>
          </div>
    <div class="testimonial-slider">
      <div class="testimonial-col">
        <div class="testimonial-inn">
     
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            loading="lazy" alt="Seller" />
          <p>
          Aayurja’s Gucchi Mushrooms have transformed my cooking! Their rich, earthy flavour elevates every dish, and I love knowing they’re packed with nutrients. Highly recommended.
          </p>
          <div class="name">Priya Mehta</div>
        </div>
      </div>
      <div class="testimonial-col">
        <div class="testimonial-inn">
      
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            loading="lazy"  alt="Seller" />
          <p>
          The Aayurja Shilajit has been a lifesaver for my energy levels. Since I started taking it, I feel more focused and alert throughout the day. Natural and effective.

          </p>
          <div class="name">Rahul Singh</div>
        </div>
      </div>
      <div class="testimonial-col">
        <div class="testimonial-inn">
        
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            loading="lazy" alt="Seller" />
          <p>
          I love the pure sweetness of Aayurja Honey. It’s the perfect addition to my morning tea, and it feels great to consume something so natural and unprocessed.
          </p>
          <div class="name">Sunita Arora</div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- brand Logo -->


<section class="blog-section home-blogarea">
  <div class="container">
    <div class="heading-section">
      <h6 class="heading">Our Blogs</h6>
    </div>
    <div class="blog-slider">

    @if(count($limitFourBlogs) > 0)
    @foreach($limitFourBlogs as $key => $limitFourBlog)
      <div class="blog-cols">
        <div class="blog-col">
        @if($key%2 != 0)
        <a href="{{url('/blog/' .$limitFourBlog->slug)}}" class="read-more"> <span>Read More</span> </a>
         @endif
          <div class="blog-inner">
            <div class="image">
              <div class="image-style">
                <img
                  class="quotes-wrap"
                  src="{{url('/public/uploads/blog/' . $limitFourBlog->image2)}}"
                  alt="Seller" loading="lazy"/>
              </div>
            </div>
            <div class="content">
              <p>{{$limitFourBlog->title}}</p>
            </div>
          </div>
          @if($key%2 == 0)
          <a href="{{url('/blog/' .$limitFourBlog->slug)}}" class="read-more"> <span>Read More</span> </a>
          @endif
        </div>
      </div>
      @endforeach
      @endif
      </div>
      <div class="col-md-12">
        <div class="button-wrap">
          <a href="{{url('/blog')}}" class="theme-button"> View All</a>
        </div>
      </div>
    </div>
  
  </div>
  <img src="{{url('public/images/recipe-pattern.png')}}" loading="lazy" class="homeblog-vector" alt="pattern"/>
</section>
<!--  -->

<section class="instagram-section">
<script src="https://static.elfsight.com/platform/platform.js" async></script>
<div class="elfsight-app-fdf0a6a0-f74e-4d1f-9d38-0bfac0ba76d8" data-elfsight-app-lazy></div>
</section>


<div class="modal bulkbuy-popup fade" id="bulkbuy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <img src="{{url('public/images/popular-vector.png')}}" alt="vector" class="login-vec-one" loading="lazy">
            <img src="{{url('public/images/lotus-icon.webp')}}" alt="lotus" class="login-vec-lotus" loading="lazy">
            <img src="{{url('public/images/blogcard-vector.png')}}" alt="lotus" class="login-vec-two" loading="lazy">
            <img src="{{url('public/images/seller-vector1.webp')}}" alt="vector" class="login-vec-three" loading="lazy">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i></button>

            <div class="row align-items-center">
                <div class="col-md-6 pop-nopadd">
                    <div class="image-wrap">
                        <img src="{{url('public/images/bulkbuy-image.webp')}}" alt="product" loading="lazy" />
                    </div>
                </div>
                <div class="col-md-6 pop-nopadd">
                    <div class="bulkpop-detail">
                        <h4 class="heading">Fill out this form for booking online</h4>

                        <form action="{{url('contact-save')}}" method="post">
                          @csrf
                          <div class="row"> 
                        <input type="hidden" name="source_url" value="" id="source_url" class="source_url">
                            <div class="col-lg-12">
                              <input type="text" class="form-control" placeholder="Full Name" id="name"  name="name" required="">
                            </div> 

                            <div class="col-lg-6  col-md-6">
                              <input type="email" class="form-control" placeholder="Email" id="email"  name="email" required="">
                            </div> 

                            <div class="col-lg-6  col-md-6">
                              <input type="text" class="form-control" required="" name="mobile" maxlength="10" minlength="10" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                              || (95<event.keyCode &amp;&amp; event.keyCode<106)
                              || (event.keyCode==8) || (event.keyCode==9)
                              || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                              || (event.keyCode==46) )" placeholder="Phone Number">
                            </div> 

                            <div class="col-lg-6 col-md-6">
                              <select name="interested_in" id="interested_in" class="form-control"  required="require">
                                  <option value="" disabled="" selected="">Select Product</option>
                                  <option value="Mushroom">Mushroom</option>
                                  <option value="Shilajit">Shilajit</option>
                                  <option value="Honey">Honey</option>
                              </select>
                            </div> 

                            <div class="col-lg-6 col-md-6">
                                <div class="qty-container">
                                    <button class="qty-btn-minus" type="button"><i class="fa fa-minus"></i></button>
                                    <input type="text" name="person" value="1" class="input-qty form-control"/>
                                    <button class="qty-btn-plus" type="button"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>        

                            <div class="col-lg-12">
                              <textarea name="msg" id="" class="form-control" placeholder="Message" required=""></textarea>
                            </div>

                            <div class="col-lg-12 text-center">
                              <button type="submit" class="theme-button">Submit</button>
                            </div>
                          </div> 
                        </form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>




@include('website.footer')




<script>
    gsap.registerPlugin(ScrollTrigger);
    const cards = document.querySelectorAll(".homewhy-card");
    const header = document.querySelector(".webcard-header");
    const animation = gsap.timeline();

    cards.forEach((card, index) => {
        if (index > 0) {
            gsap.set(card, {
                y: index * 440
            });

            animation.to(card, {
                y: 0,
                duration: index * 0.5,
                ease: "none"
            }, 0);
        }
    });

    // mobile view
    if (window.innerWidth >= 992) {
        ScrollTrigger.create({
            trigger: ".home-difference",
            start: "top top",
            pin: true,
            end: `+=${cards.length * 260 + header.offsetHeight}`,
            scrub: true,
            animation: animation,
            markers: false
        });
    } 
</script>

<script type="text/javascript">
//---- mute btn desktop
function toggleMute() {
  var button=document.getElementById("MuteButton")
  var video=document.getElementById("player")
  
  if(video.muted){
    video.muted = false;
  } else {
    video.muted = true;
  }
  
  button.classList.toggle('muted-butn');
}
</script>

