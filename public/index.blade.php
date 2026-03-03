@include('website.header')

<!-- banner -->
<!--<section class="banner-section">
  <div class="banner-slider">
    <div class="banner-col">
      <div class="banner-inner">
        <img src="{{url('public/images/banner-mage.png')}}" alt="Heart" />
        <div class="banner-content">
          <div class="container">
            <div class="title">
              Golden Goodness: Pure Honey from Nature’s Finest
            </div>
            <div class="button-wrap">
              <a href="{{url('shop')}}" class="theme-button">
                Shop Now <span></span>
                <span></span>
                <span></span>
                <span></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
	
	
    <div class="banner-col">
      <div class="banner-inner">
        <img src="{{url('public/images/banner-mage.png')}}" alt="Heart" />
        <div class="banner-content">
          <div class="container">
            <div class="title">
              Golden Goodness: Pure Honey from Nature’s Finest
            </div>
            <div class="button-wrap">
              <a href="{{url('shop')}}" class="theme-button">
                Shop Now <span></span>
                <span></span>
                <span></span>
                <span></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
	
	
  </div>
</section>-->



<section class="new-banner-setion desktop-banner">
   <div class="banner-slider">
      <div class="banner-col">
         <div class="banner-inner">
            <div class="banner-wrap">
               <img src="{{url('public/images/banner-new1.png')}}" alt="Heart" />
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
               <img src="{{url('public/images/banner-new2.webp')}}" alt="banner" />
               <div class="banner-text">
                  <div class="container">
                     <div class="row banner-col-right">
                        <div class="col-md-7 col-lg-7">
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
              <img src="{{url('public/images/banner-new3.webp')}}" alt="banner" />
              <div class="deskbanner-btn">
                  <a href="{{url('shop')}}" class="theme-button"> Shop Now </a>
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
            <img src="{{url('public/images/mobile-ban-1.webp')}}" alt="banner"/>
            <div>
              <h4 class="heading">Embrace the <br>Richness of Nature!</h4>
              <p>🌿 Sustainably Sourced | 🌍 Pure Himalayan Essence | 🌱 Fully Organic</p>
              <a href="{{url('shop')}}" class="theme-button">Shop Now </a>
            </div>
         </div>
      </div>

      <div class="mobile-col">
         <div class="mobileban-content mobileB-2">
            <img src="{{url('public/images/mobile-ban-2.webp')}}" alt="banner"/>
            <div>
              <h4 class="heading">Natural Sweetness <br>You Can Trust!</h4>
              <p>🌼 Pure & Organic | 🍃 Raw & Unprocessed | 🐝 Direct from Beekeepers</p>
              <a href="{{url('shop')}}" class="theme-button">Shop Now </a>
            </div>
         </div>
      </div>

      <div class="mobile-col">
         <div class="mobileban-onlyimage">
            <img src="{{url('public/images/mobile-ban-3.webp')}}" alt="banner"/>
            <div>
                <a href="{{url('shop')}}" class="theme-button"> Shop Now </a>
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
  <img
    class="popular-vector"
    src="{{url('public/images/popular-vector.png')}}"
    alt="Popular" />
  <div class="container">
    <div class="heading-section">
      <h2 class="heading">Most popular</h2>
    </div>
    <div class="popular-slider">

    @if(count($products) > 0)
    @foreach($products as $key => $product)
      <div class="popular-col">
        <div class="popular-inner">
          <div class="image-wrap">
            <div class="image image-style">
            <a href="{{url('product')}}/{{@$product->slug}}"><img src="{{url('public')}}/uploads/product/{{$product->list_image}}" alt="{{$product->product_name}}" />  </a> 
            </div>

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
            <a href="javascript:void(0);" class="like-btn" onclick="addToWishlist({{ $product->id }}, this)">
              <div class="heart-wrap @if($wishlist) active-heart @endif">
                <i class="fa-solid fa-heart"></i>
              </div>
            </a>
            @else
            <a href="javascript:void(0);" class="like-btn" data-toggle="modal" data-target="#loginModel">
              <div class="heart-wrap @if($wishlist) active-heart @endif">
                <i class="fa-solid fa-heart"></i>
              </div>
            </a>
            @endif
          </div>
          <div class="content">
            <h4>
            <a href="{{url('product')}}/{{@$product->slug}}">{{$product->product_name}}</a>
            </h4>
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
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </a>
                </div>
                  @else

                  <div class="button-wrap">
                  <a class="theme-button">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out of Stock
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
                      <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </a>
                  </div>
                  @else

                  <div class="button-wrap">
                  <a class="theme-button">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out of Stock
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
      @endforeach
      @endif

      <!-- <div class="popular-col">
        <div class="popular-inner">
          <div class="image-wrap">
            <div class="image image-style">
              <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
            </div>
            <div class="heart-wrap">
              <a href="#" class="like-btn">
                <i class="fa-regular fa-heart"></i>
              </a>
            </div>
          </div>
          <div class="content">
            <h4>
              Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
              (250g)
            </h4>
            <div class="price-wrap">
              <span>
                <strong>₹16999</strong>
              </span>
              <span>
                <del>₹431</del>
              </span>
              <span class="off-items">10% off</span>
            </div>
            <div class="review-wrap">
              <div class="review-icon">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <div class="review-txt">
                <p>299 ratings</p>
              </div>
            </div>
            <div class="button-wrap">
              <a href="#" class="theme-button">
                <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="popular-col">
        <div class="popular-inner">
          <div class="image-wrap">
            <div class="image image-style">
              <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
            </div>
            <div class="heart-wrap">
              <a href="#" class="like-btn">
                <i class="fa-regular fa-heart"></i>
              </a>
            </div>
          </div>
          <div class="content">
            <h4>
              Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
              (250g)
            </h4>
            <div class="price-wrap">
              <span>
                <strong>₹16999</strong>
              </span>
              <span>
                <del>₹431</del>
              </span>
              <span class="off-items">10% off</span>
            </div>
            <div class="review-wrap">
              <div class="review-icon">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <div class="review-txt">
                <p>299 ratings</p>
              </div>
            </div>
            <div class="button-wrap">
              <a href="#" class="theme-button">
                <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="popular-col">
        <div class="popular-inner">
          <div class="image-wrap">
            <div class="image image-style">
              <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
            </div>
            <div class="heart-wrap">
              <a href="#" class="like-btn">
                <i class="fa-regular fa-heart"></i>
              </a>
            </div>
          </div>
          <div class="content">
            <h4>
              Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
              (250g)
            </h4>
            <div class="price-wrap">
              <span>
                <strong>₹16999</strong>
              </span>
              <span>
                <del>₹431</del>
              </span>
              <span class="off-items">10% off</span>
            </div>
            <div class="review-wrap">
              <div class="review-icon">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <div class="review-txt">
                <p>299 ratings</p>
              </div>
            </div>
            <div class="button-wrap">
              <a href="#" class="theme-button">
                <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="popular-col">
        <div class="popular-inner">
          <div class="image-wrap">
            <div class="image image-style">
              <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
            </div>
            <div class="heart-wrap">
              <a href="#" class="like-btn">
                <i class="fa-regular fa-heart"></i>
              </a>
            </div>
          </div>
          <div class="content">
            <h4>
              Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
              (250g)
            </h4>
            <div class="price-wrap">
              <span>
                <strong>₹16999</strong>
              </span>
              <span>
                <del>₹431</del>
              </span>
              <span class="off-items">10% off</span>
            </div>
            <div class="review-wrap">
              <div class="review-icon">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
              <div class="review-txt">
                <p>299 ratings</p>
              </div>
            </div>
            <div class="button-wrap">
              <a href="#" class="theme-button">
                <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
              </a>
            </div>
          </div>
        </div>
      </div> -->

    </div>
  </div>
  <img class="popular-vector1" src="{{url('public/images/lotus-icon.png')}}" alt="Popular" />
</section>
<!--  -->

<section class="revolution-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-10">
        <div class="content-text">
          <div class="heading-section">
            <span>About Aayurja</span>
            <h2 class="heading">Revolutionising Wellness, Naturally</h2>
          </div>
          <h4 class="subtitle">
            Pure Herbal Excellence. Nothing More, Nothing Less.
          </h4>
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
</section>


<!-- 
<div class="main-fixed-slider">
  <div class="container">
    <div class="fixed-slider">

    @if(count($limitFourproducts) > 0)
    @foreach($limitFourproducts as $key => $limitFourproducts)
      <div class="vertical-slide">
        <div class="hydra-col">
          <div class="section__img">
            <div class="section__img__inner">
            <a href="{{url('product')}}/{{@$limitFourproducts->slug}}"><img src="{{url('public')}}/uploads/product/{{$limitFourproducts->list_image}}" alt="{{$limitFourproducts->product_name}}" />  </a> 
            </div>
          </div>
          <div class="section__body">
            <div class="section__text">
              <h2>
                {{$limitFourproducts->product_name}}
              </h2>
              <div class="price-wrap">
                <span>
                  <strong>₹{{number_format($limitFourproducts->variants_price->selling_price)}}</strong>
                </span>
                <span>
                  <del>₹{{number_format($limitFourproducts->variants_price->price)}}</del>
                </span>
                @if($limitFourproducts->variants_price->discount!=0 or $limitFourproducts->variants_price->discount='')  <span class="off-items">({{$limitFourproducts->variants_price->discount}}% off)</span> @endif
              </div>
              @php
              $averageRating = $product->review->avg('rating') ?? 0; // Default to 0 if no ratings
              $totalRatings = $product->review->count();
          @endphp
              <div class="review-wrap">
                <div class="review-icon">
                  {{-- <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i> --}}
                  @for ($i = 1; $i <= 5; $i++)
                  @if ($i <= floor($averageRating))
                      <i class="fa-solid fa-star"></i> 
                  @elseif ($i == ceil($averageRating) && $averageRating - floor($averageRating) > 0)
                      <i class="fa-solid fa-star-half-alt"></i> 
                  @else
                      <i class="fa-regular fa-star"></i> 
                  @endif
              @endfor
                </div>
                <div class="review-txt">
                  <p>{{ $totalRatings }} ratings</p>
                </div>
              </div>
              @if(Auth()->check())
                @if($limitFourproducts->outofstock == 0)
                <div class="button-wrap">
                  <a href="javascript::void(0)" class="theme-button submitbtnbyclass" data-weight="{{$limitFourproducts->variants_size->weight}}" data-quantity="1" data-productid="{{$limitFourproducts->id}}" data-productname="{{$limitFourproducts->product_name}}" data-sellingprice="{{number_format($limitFourproducts->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$limitFourproducts->list_image}}">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                  </a>
                </div>
                @else
                <div class="button-wrap">
                  <a class="theme-button">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out of Stock
                  </a>
                </div>
                @endif
              @else
                @if($limitFourproducts->outofstock == 0)
                <div class="button-wrap">
                  <a class="theme-button" data-toggle="modal" data-target="#loginModel" href="#">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                  </a>
                </div>
                @else
                <div class="button-wrap">
                  <a class="theme-button" >
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out of Stock
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
</div>  -->

<!--------->

<div class="homepage-video">
    <video class="video" loop playsinline muted>
        <source src="{{url('public/video/mushroom.mp4')}}" type="video/mp4">
    </video>

    <div class="playpause">
        <a class="video-play-button" href="javascript:void(0);"><span></span></a> 
    </div>
</div> 

<!--------->

<!-- shop by category -->
<section class="category-section top-space">
  <img
    class="popular-vector"
    src="{{url('public/images/popular-vector.png')}}"
    alt="Popular" />
  <div class="container">
    <div class="heading-section">
      <h2 class="heading">Shop by category</h2>
    </div>
  </div>
  
  <div class="category-slider">
    <div class="category-col">
      <div class="category-inner">
          <a href="javascript:void(0)">
            <div class="image">
              <img src="{{url('public/images/category-img-1.webp')}}" alt="category"/>
            </div>
            <div class="content">
              <h4>Honey</h4>
            </div>
          </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="javascript:void(0)">
          <div class="image">
            <img src="{{url('public/images/category-img-2.webp')}}" alt="category"/>
          </div>
          <div class="content">
            <h4>gucchi mushroom</h4>
          </div>
        </a>
      </div>
    </div>
    <div class="category-col">
      <div class="category-inner">
        <a href="javascript:void(0)">
          <div class="image">
            <img src="{{url('public/images/category-img-3.webp')}}" alt="category"/>
          </div>
          <div class="content">
            <h4>Shilajit</h4>
          </div>
        </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="javascript:void(0)">
          <div class="image">
            <img src="{{url('public/images/category-img-4.webp')}}" alt="category"/>
          </div>
          <div class="content">
            <h4>Honey</h4>
          </div>
        </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="javascript:void(0)">
          <div class="image">
            <img src="{{url('public/images/category-img-5.webp')}}" alt="category"/>
          </div>
          <div class="content">
            <h4>gucchi mushroom</h4>
          </div>
        </a>
      </div>
    </div>

    <div class="category-col">
      <div class="category-inner">
        <a href="javascript:void(0)">
          <div class="image">
            <img src="{{url('public/images/category-img-6.webp')}}" alt="category"/>
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
              <img src="{{url('public/images/recipe-1.webp')}}" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Risotto</h4>
                <p>Creamy Arborio rice cooked with tender morel mushrooms, white wine, and Parmesan cheese. This luxurious risotto highlights the earthy flavor of morels in every bite.</p>
            </div>
            <div class="recipebox-arrow">
              <span>01
                <img src="{{url('public/images/green-arrow.png')}}" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-2.webp')}}" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Soup</h4>
                <p>A rich and velvety soup made with sautéed morel mushrooms, onions, and garlic, finished with a splash of cream. Perfect as a comforting starter or light main course.</p>
            </div>
            <div class="recipebox-arrow">
              <span>02
                <img src="{{url('public/images/green-arrow.png')}}" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-3.webp')}}" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Pasta</h4>
                <p>Fresh pasta tossed with sautéed morel mushrooms, garlic, and herbs, and finished with a light cream sauce. A simple yet elegant dish showcasing the unique flavor of morels.</p>
            </div>
            <div class="recipebox-arrow">
              <span>03
                <img src="{{url('public/images/green-arrow.png')}}" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-4.webp')}}" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Morel Mushroom Tart</h4>
                <p>A savory tart filled with a mixture of sautéed morel mushrooms, cheese, and fresh herbs, all encased in a buttery pastry crust. Ideal for brunch or a sophisticated appetizer.</p>
            </div>
            <div class="recipebox-arrow">
              <span>04
                <img src="{{url('public/images/green-arrow.png')}}" alt="arrow"/>
              </span>
            </div>
          </a>
        </div>

        <div class="recipe-box recipe-item">
          <a href="javascript:void(0)">
            <div class="recipebox-image">
              <img src="{{url('public/images/recipe-5.webp')}}" alt="recipe"/>
            </div>
            <div class="recipebox-detail">
                <h4>Honey-Lavender Glazed panCakes</h4>
                <p>A succulent salmon fillet glazed with a sweet and aromatic honey-lavender sauce. The honey adds a rich sweetness, while the lavender infuses a floral note, creating a beautifully balanced and elegant dish.</p>
            </div>
            <div class="recipebox-arrow">
              <span>05
                <img src="{{url('public/images/green-arrow.png')}}" alt="arrow"/>
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

  <img src="{{url('public/images/recipe-pattern.png')}}" class="recipe-vector" alt="pattern"/>
</section>

<!--------->

<section class="connect-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="connect-text">
          <h3 class="heading">Large Order Inquiries - Get in Touch!</h3>
          <p>
          Are you interested in placing a bulk order or require global delivery of our products? We are ready to assist you! Reach out to us on WhatsApp at +91-7088669966 for efficient coordination and tailored service.
          </p>
          <div class="conncet-btn">
            <a href="{{url('/contact-us')}}" class="theme-button">Contact Us for Bulk Order</a>
            <a href="#" class="theme-button theme-button2">Contact on What’s app</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- seller -->

 <!-- <section class="seller-section popular-section top-space">
  <img
    class="seller-vector1"
    src="{{url('public/images/seller-vector1.png')}}"
    alt="Seller" />
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-section">
          <h2 class="heading">Best Sellers</h2>
        </div>
      </div>
    </div>
    <div class="row">

    @if(count($bestProducts) > 0)
      @foreach($bestProducts as $key => $bestProduct)
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="seller-column">
          <div class="popular-inner">
            <div class="image-wrap">
              <div class="image image-style">
              <a href="{{url('product')}}/{{@$bestProduct->slug}}"><img src="{{url('public')}}/uploads/product/{{$bestProduct->list_image}}" alt="{{$bestProduct->product_name}}" />  </a> 
              </div>

              @php
              if(Auth::check()){
                  $wishlist = App\Wishlist::where('user_id', Auth::user()->id)->where('product_id',$bestProduct->id)->count(); 
              }else{
                  $wishlist = '';
              }
              @endphp

              @php
              $averageRating = $bestProduct->review->avg('rating') ?? 0; // Calculate average rating
            $filledStars = floor($averageRating); // Number of full stars (whole number part)
            $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0; // If there is a half star
            $emptyStars = 5 - ($filledStars + $halfStar); // Remaining empty stars
            $totalRatings = $bestProduct->review->count(); // Total number of ratings
              @endphp
              

              @if(Auth()->check())
              <a href="javascript:void(0);" class="like-btn" onclick="addToWishlist({{ $bestProduct->id }}, this)">
                <div class="heart-wrap @if($wishlist) active-heart @endif">
                  <i class="fa-solid fa-heart"></i>
                </div>
              </a>
              @else
              <a href="javascript:void(0);" class="like-btn" data-toggle="modal" data-target="#loginModel">
                <div class="heart-wrap @if($wishlist) active-heart @endif">
                  <i class="fa-solid fa-heart"></i>
                </div>
              </a>
              @endif
              
            </div>
            <div class="content">
              <h4>
                <a href="{{url('product')}}/{{@$bestProduct->slug}}">{{$bestProduct->product_name}}</a>
              </h4>
              <div class="price-wrap">
                <span>
                  <strong>₹{{number_format($bestProduct->variants_price->selling_price)}}</strong>
                </span>
                <span>
                  <del>₹{{number_format($bestProduct->variants_price->price)}}</del>
                </span>
                @if($bestProduct->variants_price->discount!=0 or $bestProduct->variants_price->discount='')  <span class="off-items">({{$bestProduct->variants_price->discount}}% off)</span> @endif
              </div>
              
              <div class="review-wrap">
                <div class="review-icon">
                  {{-- <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i> --}}
            
              @for($i = 1; $i <= $filledStars; $i++)
              <i class="fa-solid fa-star"></i>
            @endfor

            
              @if($halfStar)
                <i class="fa-solid fa-star-half-alt"></i>
              @endif

            
                @for($i = 1; $i <= $emptyStars; $i++)
                <i class="fa-regular fa-star"></i>
              @endfor
              
                </div>
                <div class="review-txt">
                  <p>{{ $totalRatings }} ratings</p>
                </div>
              </div>

              @if(Auth()->check())
                @if($bestProduct->outofstock == 0)
                    <div class="button-wrap">
                    <a href="javascript::void(0)" class="theme-button submitbtnbyclass" data-weight="{{$bestProduct->variants_size->weight}}" data-quantity="1" data-productid="{{$bestProduct->id}}" data-productname="{{$bestProduct->product_name}}" data-sellingprice="{{number_format($bestProduct->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$bestProduct->list_image}}">
                      
                        <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                      </a>
                    </div>
                @else

                <div class="button-wrap">
                  <a class="theme-button">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out Of Stock
                  </a>
                </div>
                @endif
              @else
                @if($bestProduct->outofstock == 0)
                    <div class="button-wrap">
                      <a href="aaa" class="theme-button" data-toggle="modal" data-target="#loginModel" href="#">
                        <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                      </a>
                    </div>
                @else

                <div class="button-wrap">
                  <a class="theme-button">
                    <img src="{{url('public/images/shopping-icon.png')}}" /> Out Of Stock
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

      <div class="col-md-12 col-lg-12">
        <div class="button-wrap view-btns">
          <a href="{{url('/shop')}}" id="viewAll" class="theme-button"> View All </a>
        </div>
      </div>
    </div>
  </div>
  <img
    class="seller-vector1 seller-vector2"
    src="{{url('public/images/seller-vector2.png')}}"
    alt="Seller" />
</section>  -->

<!---->

 <!-- <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="seller-column">
          <div class="popular-inner">
            <div class="image-wrap">
              <div class="image image-style">
                <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
              </div>
              <div class="heart-wrap">
                <a href="#" class="like-btn">
                  <i class="fa-regular fa-heart"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <h4>
                Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
                (250g)
              </h4>
              <div class="price-wrap">
                <span>
                  <strong>₹16999</strong>
                </span>
                <span>
                  <del>₹431</del>
                </span>
                <span class="off-items">10% off</span>
              </div>
              <div class="review-wrap">
                <div class="review-icon">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="review-txt">
                  <p>299 ratings</p>
                </div>
              </div>
              <div class="button-wrap">
                <a href="#" class="theme-button">
                  <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="seller-column">
          <div class="popular-inner">
            <div class="image-wrap">
              <div class="image image-style">
                <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
              </div>
              <div class="heart-wrap">
                <a href="#" class="like-btn">
                  <i class="fa-regular fa-heart"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <h4>
                Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
                (250g)
              </h4>
              <div class="price-wrap">
                <span>
                  <strong>₹16999</strong>
                </span>
                <span>
                  <del>₹431</del>
                </span>
                <span class="off-items">10% off</span>
              </div>
              <div class="review-wrap">
                <div class="review-icon">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="review-txt">
                  <p>299 ratings</p>
                </div>
              </div>
              <div class="button-wrap">
                <a href="#" class="theme-button">
                  <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="seller-column">
          <div class="popular-inner">
            <div class="image-wrap">
              <div class="image image-style">
                <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
              </div>
              <div class="heart-wrap">
                <a href="#" class="like-btn">
                  <i class="fa-regular fa-heart"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <h4>
                Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
                (250g)
              </h4>
              <div class="price-wrap">
                <span>
                  <strong>₹16999</strong>
                </span>
                <span>
                  <del>₹431</del>
                </span>
                <span class="off-items">10% off</span>
              </div>
              <div class="review-wrap">
                <div class="review-icon">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="review-txt">
                  <p>299 ratings</p>
                </div>
              </div>
              <div class="button-wrap">
                <a href="#" class="theme-button">
                  <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="seller-column">
          <div class="popular-inner">
            <div class="image-wrap">
              <div class="image image-style">
                <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
              </div>
              <div class="heart-wrap">
                <a href="#" class="like-btn">
                  <i class="fa-regular fa-heart"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <h4>
                Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
                (250g)
              </h4>
              <div class="price-wrap">
                <span>
                  <strong>₹16999</strong>
                </span>
                <span>
                  <del>₹431</del>
                </span>
                <span class="off-items">10% off</span>
              </div>
              <div class="review-wrap">
                <div class="review-icon">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="review-txt">
                  <p>299 ratings</p>
                </div>
              </div>
              <div class="button-wrap">
                <a href="#" class="theme-button">
                  <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-4">
        <div class="seller-column">
          <div class="popular-inner">
            <div class="image-wrap">
              <div class="image image-style">
                <img src="{{url('public/images/popular-img1.png')}}" alt="Popular" />
              </div>
              <div class="heart-wrap">
                <a href="#" class="like-btn">
                  <i class="fa-regular fa-heart"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <h4>
                Pure 100% Organic Honey Antioxidant-Rich Natural Sweetener
                (250g)
              </h4>
              <div class="price-wrap">
                <span>
                  <strong>₹16999</strong>
                </span>
                <span>
                  <del>₹431</del>
                </span>
                <span class="off-items">10% off</span>
              </div>
              <div class="review-wrap">
                <div class="review-icon">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="review-txt">
                  <p>299 ratings</p>
                </div>
              </div>
              <div class="button-wrap">
                <a href="#" class="theme-button">
                  <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                </a>
              </div>
            </div>
          </div>
        </div>
      </div> -->

<!---->
<!-- 
<section class="connect-section discover-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="connect-text">
          <h3 class="heading">
          Outstanding Products for <br />
          Everyday Individuals
          </h3>
          <p>
          We are dedicated to offering outstanding products that improve the daily experiences of everyday individuals. Our mission is to ensure remarkable quality and exceptional value, making extraordinary solutions available to all. Whether you are in search of top-tier wellness items or high-quality daily essentials, our range is crafted to integrate excellence into your routine, demonstrating that exceptional quality can seamlessly fit into everyday life.
          </p>
          <div class="conncet-btn">
            <a href="{{url('/shop')}}" class="theme-button">Discover</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->

<!--  -->

<!-- 
<section class="counter-section">
  <img
    class="counter-vector"
    src="{{url('public/images/popular-vector.png')}}"
    alt="Seller" />
  <div class="container">
    <div class="counter-bg">
      <div class="row align-items-center">
        <div class="col-md-12 col-lg-7">
          <div class="heading-sec">
            <h4>
              We provide Proven quality and effectiveness, trusted by
              countless customers.
            </h4>
          </div>
        </div>
        <div class="col-md-12 col-lg-1">
          <div class="blanck-sec"></div>
        </div>
        <div class="col-md-12 col-lg-4">
          <div class="counter-sec">
            <div class="counter-inner">
              <h5>20K+</h5>
              <p>Happy Client</p>
            </div>
            <div class="counter-inner">
              <h5>32K+</h5>
              <p>Product Sold</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->

<!------>

<section class="home-difference">  
    <div class="container">     
        <div class="row">   

            <div class="col-lg-7 col-md-12">
              <div class="home-whydetail">
                  <h4 class="heading">Why We Are Different The Guchhi Mushroom Journey</h4>
                  <p>At the heart of what we do is a commitment to delivering the finest morel mushrooms, cultivated and selected with the utmost care. Our process is meticulous, ensuring that every step—from farming to final selection—upholds the highest standards of quality.</p>
              </div> 
            </div> 

            <div class="col-lg-5 col-md-12">
                <div class="homewhy-move">
                    <div class="webcard-header"></div>
                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-1.webp')}}" alt="Mushroom">
                        <div>
                            <h4>Sustainable Farming Practices</h4>
                            <p>We pride ourselves on practicing environmentally conscious farming that mirrors the conditions of the wild where morel mushrooms naturally thrive.</p>
                        </div>
                    </div>

                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-2.webp')}}" alt="Mushroom">
                        <div>
                            <h4>Hand-Picking at Peak Maturity</h4>
                            <p>Foraging is an art, and our team of skilled foragers is trained to know exactly when each morel is ready to be harvested.</p>
                        </div>
                    </div>

                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-3.webp')}}" alt="Mushroom">
                        <div>
                            <h4>Rigorous Selection Process</h4>
                            <p>Once harvested, our morels go through a detailed selection process to ensure only the highest quality mushrooms make it to our customers.</p>
                        </div>
                    </div>

                    <div class="homewhy-card">
                        <img src="{{url('public/images/homewhy-image-4.webp')}}" alt="Mushroom">
                        <div>
                            <h4>Preserving Freshness with Care</h4>
                            <p>Preserving the natural qualities of morel mushrooms is just as important as how they are grown and harvested, After selection.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 
    
    <img src="{{url('public/images/blog-vector.png')}}" class="homewhy-vector" alt="flower" />
</section>

<!------>

<section class="testimonial-section top-space homecard-top">
  <div class="container">
    <div class="testimonial-slider">
      <div class="testimonial-col">
        <div class="testimonial-inn">
          <div class="heading-section">
            <h2 class="heading">
              Customer Cheers:<br />
              Wellness Reviews
            </h2>
          </div>
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            alt="Seller" />
          <p>
          “Aayurja’s Gucchi Mushrooms have transformed my cooking! Their rich, earthy flavour elevates every dish, and I love knowing they’re packed with nutrients. Highly recommended!”
          </p>
          <div class="name">- Priya Mehta</div>
        </div>
      </div>
      <div class="testimonial-col">
        <div class="testimonial-inn">
          <div class="heading-section">
            <h2 class="heading">
              Customer Cheers:<br />
              Wellness Reviews
            </h2>
          </div>
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            alt="Seller" />
          <p>
          “The Aayurja Shilajit has been a lifesaver for my energy levels. Since I started taking it, I feel more focused and alert throughout the day. Natural and effective!”

          </p>
          <div class="name">-  Rahul Singh</div>
        </div>
      </div>
      <div class="testimonial-col">
        <div class="testimonial-inn">
          <div class="heading-section">
            <h2 class="heading">
              Customer Cheers:<br />
              Wellness Reviews
            </h2>
          </div>
          <img
            class="quotes-wrap"
            src="{{url('public/images/quotes-icon.png')}}"
            alt="Seller" />
          <p>
          “I love the pure sweetness of Aayurja Honey. It’s the perfect addition to my morning tea, and it feels great to consume something so natural and unprocessed.”
          </p>
          <div class="name">- Sunita Arora</div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- brand Logo -->
<!-- <section class="partner-section top-space">
  <div class="heading-section">
    <h2 class="heading">Our Delivery Partners</h2>
  </div>
  <div class="partner-slider partner-row">
    <div class="partner-col">
      <div class="partner-img shiksha-img">
        <img src="{{url('public/images/brand-img1.png')}}" alt="Slider" />
      </div>
    </div>
    <div class="partner-col">
      <div class="partner-img">
        <img src="{{url('public/images/brand-img2.png')}}" alt="Slider" />
      </div>
    </div>
    <div class="partner-col">
      <div class="partner-img delhi-capital">
        <img src="{{url('public/images/brand-img3.png')}}" alt="Slider" />
      </div>
    </div>
    <div class="partner-col">
      <div class="partner-img">
        <img src="{{url('public/images/brand-img4.png')}}" alt="Slider" />
      </div>
    </div>
    <div class="partner-col">
      <div class="partner-img">
        <img src="{{url('public/images/brand-img5.png')}}" alt="Slider" />
      </div>
    </div>
    <div class="partner-col air-partner">
      <div class="partner-img">
        <img src="{{url('public/images/brand-img6.png')}}" alt="Slider" />
      </div>
    </div>
    <div class="partner-col air-partner">
      <div class="partner-img">
        <img src="{{url('public/images/brand-img7.png')}}" alt="Slider" />
      </div>
    </div>
    <div class="partner-col air-partner">
      <div class="partner-img">
        <img src="{{url('public/images/brand-img8.png')}}" alt="Slider" />
      </div>
    </div>
  </div>
</section> -->
<!--  -->
<section class="blog-section home-blogarea">
  <div class="container">
    <div class="heading-section">
      <h2 class="heading">Our Blogs</h2>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="blog-col">
          <div class="blog-inner">
            <div class="image">
              <div class="image-style">
                <img
                  class="quotes-wrap"
                  src="{{url('public/images/blog-img1.png')}}"
                  alt="Seller" />
              </div>
            </div>
            <div class="content">
              <p>Organic Honey and Kesar for Glowing Skin</p>
            </div>
          </div>
          <a href="#" class="read-more"> <span>Read More</span> </a>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="blog-col">
          <a href="#" class="read-more"> <span>Read More</span> </a>
          <div class="blog-inner">
            <div class="image">
              <div class="image-style">
                <img
                  class="quotes-wrap"
                  src="{{url('public/images/blog-img2.png')}}"
                  alt="Seller" />
              </div>
            </div>
            <div class="content">
              <p>Organic Honey and Kesar for Glowing Skin</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="blog-col">
          <div class="blog-inner">
            <div class="image">
              <div class="image-style">
                <img
                  class="quotes-wrap"
                  src="{{url('public/images/blog-img3.png')}}"
                  alt="Seller" />
              </div>
            </div>
            <div class="content">
              <p>Organic Honey and Kesar for Glowing Skin</p>
            </div>
          </div>
          <a href="#" class="read-more"> <span>Read More</span> </a>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="blog-col">
          <a href="#" class="read-more"> <span>Read More</span> </a>
          <div class="blog-inner">
            <div class="image">
              <div class="image-style">
                <img
                  class="quotes-wrap"
                  src="{{url('public/images/blog-img4.png')}}"
                  alt="Seller" />
              </div>
            </div>
            <div class="content">
              <p>Organic Honey and Kesar for Glowing Skin</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="button-wrap">
          <a href="{{url('/blog')}}" class="theme-button"> View All</a>
        </div>
      </div>
    </div>
  </div>

  <img src="{{url('public/images/recipe-pattern.png')}}" class="homeblog-vector" alt="pattern"/>
</section>
<!--  -->
<!-- <section class="award-sec top-space">
  <img class="award-vector" src="{{url('public/images/award-vector.png')}}" alt="Slider" />
  <div class="container">
    <div class="heading-section">
      <h2 class="heading">Awarded by</h2>
    </div>
    <div class="row">
      <div class="award-col">
        <div class="award-img">
          <img src="{{url('public/images/award-img1.png')}}" alt="Slider" />
        </div>
      </div>
      <div class="award-col">
        <div class="award-img">
          <img src="{{url('public/images/award-img2.png')}}" alt="Slider" />
        </div>
      </div>
      <div class="award-col">
        <div class="award-img">
          <img src="{{url('public/images/award-img3.png')}}" alt="Slider" />
        </div>
      </div>
      <div class="award-col">
        <div class="award-img">
          <img src="{{url('public/images/award-img4.png')}}" alt="Slider" />
        </div>
      </div>
      <div class="award-col">
        <div class="award-img">
          <img src="{{url('public/images/award-img5.png')}}" alt="Slider" />
        </div>
      </div>
    </div>
  </div>
</section> -->
<!--  -->


<section class="instagram-section">
    <div class="insta-slider">

        <div class="instagram-col">
          <div class="instagram-inner">
            <a href="javascript:void(0)">
              <div class="image">
                <div class="image-style">
                  <img src="{{url('public/images/instagram-img1.webp')}}" alt="instagram" />
                </div>
              </div>
              <div class="content">
                <span class="instagram-icon"
                  ><i class="fa-brands fa-instagram"></i>
                </span>
              </div>
            </a>
          </div>
        </div>

        <div class="instagram-col">
          <div class="instagram-inner">
            <a href="javascript:void(0)">
              <div class="image">
                <div class="image-style">
                <img src="{{url('public/images/instagram-img2.webp')}}" alt="instagram" />
                </div>
              </div>
              <div class="content">
                <span class="instagram-icon"
                  ><i class="fa-brands fa-instagram"></i>
                </span>
              </div>
            </a>
          </div>
        </div>

        <div class="instagram-col">
          <div class="instagram-inner">
            <a href="javascript:void(0)">
              <div class="image">
                <div class="image-style">
                <img src="{{url('public/images/instagram-img3.webp')}}" alt="instagram" />
                </div>
              </div>
              <div class="content">
                <span class="instagram-icon"
                  ><i class="fa-brands fa-instagram"></i>
                </span>
              </div>
            </a>
          </div>
        </div>

        <div class="instagram-col">
          <div class="instagram-inner">
            <a href="javascript:void(0)">
              <div class="image">
                <div class="image-style">
                <img src="{{url('public/images/instagram-img4.webp')}}" alt="instagram" />
                </div>
              </div>
              <div class="content">
                <span class="instagram-icon"
                  ><i class="fa-brands fa-instagram"></i>
                </span>
              </div>
            </a>
          </div>
        </div>

        <div class="instagram-col">
          <div class="instagram-inner">
            <a href="javascript:void(0)">
              <div class="image">
                <div class="image-style">
                <img src="{{url('public/images/instagram-img5.webp')}}" alt="instagram" />
                </div>
              </div>
              <div class="content">
                <span class="instagram-icon"
                  ><i class="fa-brands fa-instagram"></i>
                </span>
              </div>
            </a>
          </div>
        </div>

        <div class="instagram-col">
          <div class="instagram-inner">
            <a href="javascript:void(0)">
              <div class="image">
                <div class="image-style">
                <img src="{{url('public/images/instagram-img6.webp')}}" alt="instagram" />
                </div>
              </div>
              <div class="content">
                <span class="instagram-icon"
                  ><i class="fa-brands fa-instagram"></i>
                </span>
              </div>
            </a>
          </div>
        </div>

    </div>        
</section>


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

<script>
  // const elements = document.getElementsByClassName('addactive'); 
  // if (elements.length > 0) {
  //   elements[0].addEventListener('click', function() {
  //     this.classList.add('active-heart');
  //   });
  // }
</script>


<script>
  // function addToWishlist(productId, element) {
    // Add 'active-heart' class to the clicked element
    // element.querySelector('.heart-wrap').classList.add('active-heart');

    // Optional: Perform your AJAX logic here if needed
    // $.ajax({
    //   url: '/add-to-wishlist',
    //   method: 'POST',
    //   data: { productId: productId },
    //   success: function(response) {
    //     console.log('Product added to wishlist');
    //   }
    // });
  // }
</script>