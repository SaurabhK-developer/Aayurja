<?php
session_start();

// List of slugs to be blocked from direct access
$blocked_slugs = [
    'organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer'
];

// Get the current request URI
$current_slug = basename($_SERVER['REQUEST_URI']);

// Check if the current slug is in the blocked list
if (in_array($current_slug, $blocked_slugs)) {
    // 1. Check for a valid token in the session (if using a token-based approach)
    // OR
    // 2. Check if the request has a valid referrer
    if (!isset($_SESSION['valid_token']) && 
        (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'https://aayurja.com') === false)) {
        
        // If invalid, redirect to an error page or a different URL
        header('Location: https://aayurja.com');
        exit();
    }
}

// If the request is valid, show the product page content
// echo "Welcome to the Product Page: " . htmlspecialchars($current_slug);
?>


<?php

// echo $_GET['token'];

// if(!empty($_GET['token']) && $_GET['token'] != session('token'))
// {
//     header('Location: https://aayurja.com');
//         exit();
// }


?>


@include('website.header')


<style>
    .sharepop.modal {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
    }

    .sharepop .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
        width: 300px;
        text-align: center;
    }

    .sharepop .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: absolute;
        right:6px;
        top:6px;
    }

    .sharepop p#modalMessage {
        margin: 0px;
    }

    .sharepop .close:hover, .sharepop .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

@php
    if (Auth::check()) {
        $wishlist = App\Wishlist::where('user_id', Auth::user()->id)
            ->where('product_id', $product->id)
            ->count();
    } else {
        $wishlist = '';
    }
@endphp
{{-- <div class="top-marqee">
    <div class="marqee-area">
        <div class="marqee-col">
            <marquee>
                <p>Gucchi Mushroom Superfood! Enjoy 20% Off Your First Order and Experience the Natural Powerhouse That Supports Your Health, Wellness, and Vitality.</p>
            </marquee>
        </div>


    </div>
</div> --}}




<section class="ProDetails-wrapper">
    <div class="container">
        <div class="row">


        
            <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="pro-left ">
                    <div class="product-left">
                        <div id="detail">

                            <div class="product-images demo-gallery">
                            <div class="imageContainer ">

                                <div class="main-img-slider image-wrapper ">

                                    @if ($product->product_video)
                                       
                                    

                                    <a data-fancybox href="{{ url('public') }}/{{ $product->product_video }}">
                                    <video class="zoom-video  slideshow-items active" id="productImageSrc" autoplay muted>
                                        <source src="{{ url('public') }}/{{ $product->product_video }}" type="video/mp4">
                                    </video>
                                    </a>
                                    @endif





                                    @if ($product_image)
                                        @foreach ($product_image as $product_images)
                                         
                                            <a data-fancybox="gallery" href="{{ url('public') }}/{{ @$product_images->url }}" class="image-weight-mapping">
                                                <img class="zoom-image slideshow-items active" id="productImageSrc" src="{{ url('public') }}/{{ @$product_images->url }}" alt="{{$product->product_name}}" loading="lazy">
                                            </a>
                                        @endforeach
                                    @endif

                                    


                                
                                </div>
                                </div>

                                <div class="imageContainer mapping-img">

                                <ul class="thumb-nav">

                                    @if ($product->product_video)
                                    <li>
                                        <span class="video-thumbnail">
                                        <video autoplay  muted>
                                           <source src="{{ url('public') }}/{{ $product->product_video }}" type="video/mp4"> 
                                        </video>
                                        </span>
                                    </li>
                                    @endif

                                    
                                    @if ($product_image)
                                    

                                        @foreach ($product_image as $product_images)
                                            <li class="image-weight-mapping"> <img src="{{ url('public') }}/{{ @$product_images->url }}" alt="{{$product->product_name}}" loading="lazy"></li>
                                        
                                            @endforeach
                                    @endif

                             
                                </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-12 col-lg-6 col-xl-6">
                <div class="zoom-display" id="zoom-display"></div>
                <div class="pro-section">
    
                    <div class="social-left">
                        @if(Request::url() != 'https://aayurja.com/product/organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer')
                        <a href="javascript:void(0);" class="like-btn" onclick="addToWishlist({{ $product->id }}, this)">
                                    <div class="heart-wrap @if($wishlist) active-heart @endif">
                                    <i class="fa-solid fa-heart"></i>
                                    </div>
                                </a>

                        @endif
                        <div class="share-wrap">
                            <div class="share-inner" >
                                <a class="share-url">
                                <i class="fa-solid fa-share-nodes"></i>
                        </a>
                            </div>

                            <?php $currentFullUrl = Request::fullUrl();?>
                            <div class="tooltip-box"> 
                                <ul>
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u={{ $currentFullUrl }}&p[title]={{$product->product_name }}" target="_blank" class="facebook" aria-label="Visit our Facebook page"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    
                                    <li>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentFullUrl }}&title={{$product->product_name }}" class="linkedin" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                    <a href="whatsapp://send?text={{ $currentFullUrl }}" data-action="share/whatsapp/share" target="_blank" class="whatsapp" ><i class="fa-brands fa-whatsapp"></i></a>
                                    </li>
                                    <li>
                                        <a href="http://twitter.com/share?text={{$product->product_name}}&url={{ $currentFullUrl }}" class="twitter" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" aria-label="Copy to clipboard" onclick="copyURL()"><i class="fa-solid fa-copy"></i></a>
                                    </li>
                                   
                                </ul>
                            </div>








                        </div>
                    </div>

                    <div class="pro-deatils">
                        <ul class="special-item">
                            <li> <img src="{{url('public/images/special-img1.png')}}" alt="Special Item" loading="lazy"></li>
                            <li> <img src="{{url('public/images/bestsell-icon.png')}}" alt="Best Seller" loading="lazy"></li>
                           
                        </ul>
                        <h1 class="heading" id="product_name">{{$product->product_name}}</h1>
                        <div class="rating-box">
                            <div class="rating">
                                {{-- <span>(4.5)</span> --}}
                                @php
                                    $averageRating = $product->review->isNotEmpty() ? $product->review->avg('rating') : 0;
                                    $totalRatings = $product->review->isNotEmpty() ? $product->review->count() : 0;
                                @endphp
                                <span>({{ number_format($averageRating, 1) }})</span>
                                @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($averageRating))
                                    <i class="fa-solid fa-star"></i> 
                                @elseif ($i == ceil($averageRating) && $averageRating - floor($averageRating) > 0)
                                    <i class="fa-solid fa-star-half-alt"></i> 
                                @else
                                    <i class="fa-regular fa-star"></i> 
                                @endif
                            @endfor
                                {{-- <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i> --}}
                                <a class="e-review" href="#">
                                    <span class="review-text">{{ $product->review->count() }} ratings</span>
                                </a>
                            </div>
                          
                                @if (auth()->check())
                                    <a class="review-icon write_review" data-toggle="modal" data-target="#review_pop" href="javascript:void(0)">Write a review</a>
                                @else
                                    <a class="nav-link write_review" data-toggle="modal" data-target="#loginModel" href="#">Write a Review</a>
                                @endif
                        </div>

                        <div class="stock-left-item">
                            <div class="stock-left">
                                In Stock
                            </div>
                            <div class="stock-right">
                                <img src="{{url('public/images/stock-progress.png')}}" alt="Progress" loading="lazy"> 70,000+ sold in 30 days
                            </div>
                        </div>
                        <div class="package-quality">
                            <p>Package Quantity: <span id="updatedWeight">{{$product->variants_size->weight}}</span></p>
                            <div class="quality-box-inner">

                                @foreach($product_variants as $key => $product_variant)
                                <div class="quality-box  @if($key == 0) active @endif  @if($product_variant->out_of_stock == 1) out-stock @else quality-box-function @endif">
                                    <p class="productWeight">{{$product_variant->weight}}</p>
                                    <div class="price">
                                        <span>₹</span><span class="productSellingPrice">{{$product_variant->selling_price}}</span>
                                        @if($product_variant->selling_price != $product_variant->price) <del>₹</del><del class="productPrice">{{$product_variant->price}}</del> @endif
                                        <input type="hidden" value="{{$product_variant->discount}}" class="discount">
                                    </div>
                                </div>
                                @endforeach

                                <!-- <div class="quality-box">
                                    <p>250 g</p>
                                    <div class="price">
                                        <span>₹24,340</span>
                                    </div>
                                </div>
                                <div class="quality-box">
                                    <p>250 g</p>
                                    <div class="price">
                                        <span>₹24,340</span>
                                    </div>
                                </div>
                                <div class="quality-box out-stock">
                                    <p>250 g</p>
                                    <div class="price">
                                        <span>₹68,340</span>
                                    </div>
                                </div> -->

                                @php
                                    $productId = $product->id; // The product ID to check.
                                @endphp

                                @foreach($couponSpecificProduct as $coupon)
                                    @php
                                        // Convert the product string into an array
                                        $productIds = explode(',', $coupon->product);
                                    @endphp

                                    @if(in_array($productId, $productIds))
                                        <div class="product-offer">
                                        
                                            <div class="offer-wrap">
                                                        <div class="offer-heading">
                                                            <img class="offer-icon"  src="{{url('public/images/offer-img.gif')}}" alt="Offer Icon" loading="lazy">
                                                            Available Offers
                                                        </div>

                                                        <div class="offer-col">
                                                        <div class="offer-inner">
                                                            <!-- <p>{{$product->offer}}</p> -->

                                                            <p>Flat {{ceil($coupon->discount_percentage)}}% Off | Use code <span>{{strtoupper($coupon->title)}}</span> | Applicable on this product Only</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endif
                                @endforeach
                            </div>
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
                        <div class="flat-bg">
                            <div class="flat-inner">
                                <div class="flat-left">
                                    <div class="discount-inner">
                                        <div class="discount-left">
                                        Flat <span>{{$coupon->discount_percentage}}%</span>
                                        </div>
                                        <div class="discount-right">
                                        <div class="right-inner">
                                            <strong>OFF</strong>
                                            <p>T&C*</p>
                                        </div>
                                        </div>
                                    </div>
                                    <p>your First Purchase above Rs.499 on this Product.</p>
                                </div>
                                <div class="flat-middle">
                                    <span>Use Code:</span>
                                    <p>{{strtoupper($coupon->title)}}</p>
                                </div>
                                <div class="flat-right">
                                    <img class="offer-icon"  src="{{url('public/images/per-img.webp')}}" alt="Offer Icon" loading="lazy">
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <div class="description-section">
                            {!!$product->key_benefits!!}


                            




                            <!-- <ul class="authentic-items">
                                <li>
                                    <p>100% authentic </p>
                                </li>
                                <li>
                                    <p><strong>Best by: 01/2027  </strong></p>
                                </li>
                                <li>
                                    <p>First available: 08/2015</p>
                                </li>
                                <li>
                                    <p>Shipping weight:  0.25 kg </p>
                                </li>
                                <li>
                                    <p>Product code: CGN-01033</p>
                                </li>
                                <li>
                                    <p>UPC: 898220010332</p>
                                </li>
                                <li>
                                    <p>Package quantity: 250 g</p>
                                </li>
                            </ul> -->
                        </div>
                        
                        {{-- <div class="description-section ranking-wraps">
                            <p>Product Rankings</p>
                            <ul class="authentic-items">
                                <li>
                                    <p>#1 Guchhi Mushroom</p>
                                </li>
                                <li>
                                    <p>#2 Shilajit Resin </p>
                                </li>
                                <li>
                                    <p>#3 Honey</p>
                                </li>
                                <li>
                                    <p>#4 Kesar</p>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-3">
                <div class="pro-right">
                    <div class="card-sec">
                        <div class="del">
                            <del id="rupeeSignUptPrice">₹</del><del id="updatedPrice">{{$product->variants_price->price}}</del>
                            <input type="hidden" value="{{$product->variants_price->price}}" id="oldPrice">
                        </div>
                        <div class="special-wrap">
                            <div class="left">
                                <span>Special Price!</span>
                            </div>
                            <div class="right">
                                <span>₹</span><span id="updatedSellingPrice">{{$product->variants_price->selling_price}}</span>
                                <input type="hidden" value="{{$product->variants_price->selling_price}}" id="oldSellingPrice">

                            </div>
                        </div>
                        <!-- <div class="del">
                            <span>₹28/serving</span>
                        </div> -->
                        <div class="save-wrap">
                            <div class="left">
                                <span>You Save:</span>
                            </div>
                            <div class="right">
                                <span>₹</span><span id="updatedSaving">{{$product->variants_price->price - $product->variants_price->selling_price}}</span><span> (</span><span id="updatedDiscount">{{$product->variants_price->discount}}</span><span>%)</span>
                            </div>
                        </div>
                            <form action="{{ url('add-to-cart') }}" method="POST" style="display: inline;" id="addToCartForm">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="qtr-section">
                                    <div class="qty-container">
                                        <button class="qty-btn-minus btn-light qtyWiseDataUpdate" type="button" <?php if($product->slug == 'organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer') { echo 'disabled'; } ?>><i class="fa fa-minus"></i></button>
                                        <input type="text" name="quantity" value="1" class="input-qty" readonly>
                                        <button class="qty-btn-plus btn-light qtyWiseDataUpdate" type="button" <?php if($product->slug == 'organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer') { echo 'disabled'; } ?>><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="btn-section">
                                    <!-- <a class="new-button theme-button">
                                        Add to Cart
                                    </a> -->
                                    

                                        @if ($product->product_variants->isNotEmpty())
                                            @php
                                                $variant = $product->product_variants->first(); // or select a specific variant if needed
                                            @endphp

                                            <input type="hidden" name="default_weight" id="default_weight" value="N/A">
                                            <input type="hidden" name="weight" id="selected_weight" value="{{$product->variants_size->weight}}">
                                        @endif


                                        @if(auth()->check())
                                            @if($product->outofstock == 0)
                                            <a class="new-button theme-button" id="submitBtn">
                                                Add to cart
                                            </a>
                                            @else
                                            <a class="new-button theme-button">
                                                Out Of Stock
                                            </a>
                                            @endif
                                        @else
                                        
                                            

                                            @if($product->outofstock == 0)
                                            <a class="new-button theme-button setPendingCart" data-toggle="modal" data-target="#loginModel" href="#" data-weight="{{$product->variants_size->weight}}" data-quantity="1" data-productid="{{$product->id}}" data-productname="{{$product->product_name}}" data-sellingprice="{{number_format($product->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$product->list_image}}">
                                                Add to cart
                                            </a>
                                            @else
                                            <a class="new-button theme-button" >
                                                Out Of Stock
                                            </a>
                                            @endif
                                        @endif
                                    
                                </div>
                            </form>
                    </div>
                    <div class="wishlist-section">
                        <!-- <a class="new-add-btn theme-button ">
                            <i class="fa-regular fa-heart"></i> Add to Wishlist
                        </a> -->

                        

                            @if(Request::url() != 'https://aayurja.com/product/organic-gucchi-mushrooms-a-natural-source-of-health-benefits-100gm-offer')

                       
                                @if (auth()->check())
                                <!-- <div class="default-btn black-btn">
                                    <a href="javascript:void(0);" class="new-add-btn theme-button" onclick="addToWishlist({{ $product->id }}, this)">
                                        <i class="fa-regular fa-heart @if($wishlist) active-heart @endif"></i>Add to Wishlist
                                    </a>
                                </div> -->

                            
                                
                                <div class="default-btn black-btn @if($wishlist) active-heart @endif">
                                    <a href="javascript:void(0);" class="new-add-btn theme-button" onclick="addToWishlist({{ $product->id }}, this)">
                                        <i class="fa-regular fa-heart"></i> @if($wishlist) <span class="wishlistDetailPageBtn">Added to Wishlist</span> @else <span class="wishlistDetailPageBtn">Add to Wishlist<span> @endif
                                    </a>   
                                </div>

                                @else
                                
                                <div class="default-btn black-btn">
                                    <a href="javascript:void(0);"  class="new-add-btn theme-button" data-toggle="modal" data-target="#loginModel"> <i class="fa-regular fa-heart @if($wishlist) active-heart @endif"></i> Add to Wishlist </a> 
                                </div>
                                @endif


                            @endif


                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-accordian">
    <img
        class="acc-vector"
        src="{{url('public/images/blogcard-vector.png')}}"
        alt="Seller" />
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="accordion-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Product Overview
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    {!!$product->first_content!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Details
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    {!!$product->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    ingredient info
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    <div class="row mt-4">
                                        <div class="col-md-12 col-lg-6">
                                            <div class="accordion-inner supplement-facts-container">
                                                <?php echo $product->additional_info; ?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 col-lg-6">
                                            <div class="incredient-wrap">
                                                <h2>Other Ingredients</h2>
                                                <strong>Main Ingredients</strong>
                                                <p>Vitamin C (as Calcium Ascorbate), Sodium, Hydrolyzed Marine Collagen Peptides, Hyaluronic Acid (as Sodium Hyaluronate</p>
                                                <strong>Other Ingredients</strong>
                                                <p>CONTAINS: Fish (one or more of the following: Atlantic and Channel Catfish, Cod, Haddock, Ling, Pangasius, Pollock, Salmon, Tilapia, Trout)</p>
                                                <i>Not manufactured with milk, eggs, crustacean shellfish, tree nuts, peanuts, wheat, soy, sesame, or gluten. Produced in an FDA-registered, third-party audited, and cGMP-compliant facility that may process other products that contain these allergens or ingredients.</i>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(count($reviews) > 0)
                    <div class="card">
                        <div class="card-header" id="headingfive">
                            <h2 class="mb-0">
                                <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                    Reviews ({{ $product->review->count() }})
                                </button>
                            </h2>
                        </div>
                        
                        <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
                            <div class="card-body">

                                @foreach ($reviews as $key => $review)
                                    @if ($key < 3)
                                        <!-- First 3 reviews with 'review-bodybox' class -->
                                        <div class="review-bodybox">
                                    @else
                                        <!-- Reviews after the first 3 with 'review-loadmore' class -->
                                        <div class="review-loadmore">
                                            <div class="review-bodybox">
                                    @endif
                                                <div class="star-given">
                                                    <ul>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                @if ($i <= $review->rating)
                                                               
                                                                <i class="fa-solid fa-star"></i> <!-- Filled star -->
                                                                @else
                                                                    <i class="fa-regular fa-star"></i> <!-- Blank star -->
                                                                    {{-- <i class="fa-regular fa-star-half-stroke"></i> --}}
                                                                    @endif
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                                <label>{{ ucwords($review->title) }}</label>
                                                <p>{{ ucwords($review->description) }}.</p>
                                                <div class="review-writeby">
                                                    <img src="{{ url('public/images/reviewby.png') }}" alt="review" loading="lazy"/>
                                                    <span>{{ ucwords($review->user_name) }}</span>
                                                </div>
                                            @if ($key >= 3)
                                            </div> <!-- Close review-bodybox inside review-loadmore -->
                                            @endif
                                        </div>
                                @endforeach
                                {{-- <div class="review-bodybox">
                                    <div class="star-given">
                                        <ul>
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                        </ul>
                                        <span>5 Stars</span>
                                    </div>
                                    <label>Nature’s Hidden Gem: The Exquisite Taste of Morel Mushrooms</label>
                                    <p>I can’t say enough good things about morel mushrooms! Their distinctive, earthy flavor brings a touch of the forest to any dish. The texture is beautifully firm yet tender, making them ideal for sautéing or adding to soups and stews. My personal favorite is tossing them in a garlic butter sauce with fresh herbs—an absolute treat for the senses.</p>
                                    <div class="review-writeby">
                                        <img src="{{url('public/images/reviewby.png')}}" alt="review" loading="lazy"/>
                                        <span>Geet Verma</span>
                                    </div>
                                </div>

                                <div class="review-bodybox">
                                    <div class="star-given">
                                        <ul>
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                            <li><i class="fa-solid fa-star"></i></li> 
                                        </ul>
                                        <span>5 Stars</span>
                                    </div>
                                    <label>A Gourmet Delight: Morel Mushrooms at Their Best</label>
                                    <p>Morel mushrooms are simply unmatched when it comes to gourmet cooking. The nutty, slightly smoky flavor they bring to dishes is extraordinary. Whether it’s a decadent pasta, a rich mushroom ragout, or even a simple grilled preparation, they add so much depth and complexity. I’m always amazed at how they manage to absorb other flavors while still standing out with their unique taste.</p>
                                    <div class="review-writeby">
                                        <img src="{{url('public/images/reviewby.png')}}" alt="review" loading="lazy"/>
                                        <span>Karan Sharma</span>
                                    </div>
                                </div>

                                <div class="review-loadmore">
                                    <div class="review-bodybox">
                                        <div class="star-given">
                                            <ul>
                                                <li><i class="fa-solid fa-star"></i></li> 
                                                <li><i class="fa-solid fa-star"></i></li> 
                                                <li><i class="fa-solid fa-star"></i></li> 
                                                <li><i class="fa-solid fa-star"></i></li> 
                                                <li><i class="fa-solid fa-star"></i></li> 
                                            </ul>
                                            <span>5 Stars</span>
                                        </div>
                                        <label>Nature’s Hidden Gem: The Exquisite Taste of Morel Mushrooms</label>
                                        <p>I can’t say enough good things about morel mushrooms! Their distinctive, earthy flavor brings a touch of the forest to any dish. The texture is beautifully firm yet tender, making them ideal for sautéing or adding to soups and stews. My personal favorite is tossing them in a garlic butter sauce with fresh herbs—an absolute treat for the senses.</p>
                                        <div class="review-writeby">
                                            <img src="{{url('public/images/reviewby.png')}}" alt="review" loading="lazy" />
                                            <span>Geet Verma</span>
                                        </div>
                                    </div>
                                </div> --}}
                                @if($reviews->count() > 3)
                                <div class="review-morebtn">
                                    <a id="review-more" href="javascript:void(0)" class="review-showmore"> View More <i class="fa fa-angle-right"></i></a>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    @endif

                    <!-- <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Q & A (1,074)
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    <p>Answers posted solely reflect the views and opinions expressed by the contributors and not those of Justgo. Justgo does not verify or endorse such answers or claims. Statements regarding dietary supplements have not been evaluated by the FDA and are not intended to diagnose, treat, cure, or prevent any disease or health condition.</p>
                                    <div class="QReflect-section">
                                        <div class="main-form">
                                            <div class="pdp-qna-search">
                                                <div class="ugc-input-wrap">
                                                    <input type="text" id="Search" placeholder="Search" class="pointer" autofocus>
                                                    <div class="search-button">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 2C15.9706 2 20 6.02944 20 11C20 13.1248 19.2637 15.0776 18.0323 16.6172L21.7071 20.2929C22.0976 20.6834 22.0976 21.3166 21.7071 21.7071C21.3466 22.0676 20.7794 22.0953 20.3871 21.7903L20.2929 21.7071L16.6172 18.0323C15.0776 19.2637 13.1248 20 11 20C6.02944 20 2 15.9706 2 11C2 6.02944 6.02944 2 11 2ZM11 4.00009C7.13396 4.00009 3.99995 7.1341 3.99995 11.0001C3.99995 14.8661 7.13396 18.0001 11 18.0001C14.8659 18.0001 18 14.8661 18 11.0001C18 7.1341 14.8659 4.00009 11 4.00009Z" fill="#666"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pdp-qna-filter">
                                                <div class="relative">
                                                    <div id="Category-select" class="ugc-select-wrap actived">
                                                        <label for="Category" class="fs-14 pointer">Category</label>
                                                        <select id="Category">
                                                            <option value="All"> All </option>
                                                            <option value="Specifications"> Specifications </option>
                                                            <option value="Brand"> Brand </option>
                                                            <option value="Ingredients"> Ingredients </option>
                                                            <option value=""> Usage </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pdp-qna-sort">
                                                <div class="relative">
                                                    <div id="Sort by-select" class="ugc-select-wrap actived">
                                                        <label for="Sort by" class="fs-14 pointer">Sort by</label>
                                                        <select id="Category">
                                                            <option value="Most relevant"> Most relevant </option>
                                                            <option value="Newly answered"> Newly answered </option>
                                                            <option value="Most helpful"> Most helpful </option>
                                                            <option value="Newest"> Newest </option>
                                                            <option value="Oldest"> Oldest </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ask-question">
                                                <button class="ugc-button">Ask a Question</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Question-main">
                                        <div class="Question-section">
                                            <div class="hydrated">
                                                <div class="ugc-question-and-answer">
                                                    <div class="hydrated-title">
                                                        <div class="ugc-question-title">
                                                            <div class="question-text">
                                                                <div class="flex-col">
                                                                    <p>Can i take more than 1 capsule a day?</p>
                                                                </div>
                                                            </div>
                                                            <div class="question-button">
                                                                <div class="pdp-qna-answer-button">
                                                                    <button class="ugc-btn">Answer</button>
                                                                </div>
                                                                <div class="report">
                                                                    <div class="question-abuse">
                                                                        <button class="ugc-text">Report abuse</span></button>
                                                                    </div>
                                                                    <div class="question-share">
                                                                        Share <i class="fa-solid fa-share-nodes"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hydrated">
                                                        <div class="gray-bg">
                                                            <div class="flex-row-wrap">
                                                                <div class="row-inner">
                                                                    <a href="#" class="flex-row-start">
                                                                        <span class="profile-icon">
                                                                            <i class="fa-solid fa-user"></i>
                                                                        </span>
                                                                    </a>
                                                                    <a href="#" class="profile-name">Justgo Customer</a>
                                                                </div>
                                                                <div class="date">Sep 22, 2021</div>
                                                            </div>
                                                            <div class="hydrated-inner">
                                                                <div class="flex-row-area">
                                                                    <div class="sign-wrap ">
                                                                        <svg viewBox="0 0 16 16" width="16" height="16" fill="none">
                                                                            <path fill="#666" fill-rule="evenodd" d="M6.862 10.471l-2-2c-.26-.26-.26-.682 0-.942.26-.26.682-.26.943 0l1.293 1.293c.13.13.34.13.47 0l3.294-3.293c.26-.26.682-.26.943 0 .26.26.26.682 0 .942l-4 4c-.13.13-.301.196-.472.196-.17 0-.341-.065-.471-.196zM8 14.667c-3.682 0-6.667-2.985-6.667-6.667S4.318 1.333 8 1.333 14.667 4.318 14.667 8 11.682 14.667 8 14.667zm0-1.334c2.945 0 5.333-2.387 5.333-5.333 0-2.945-2.388-5.333-5.333-5.333-2.946 0-5.333 2.388-5.333 5.333 0 2.946 2.387 5.333 5.333 5.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Verified purchase</span>
                                                                    </div>
                                                                    <div class="sign-wrap ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M12.714 35.516c-1.36.708-3.043.19-3.758-1.157-.284-.536-.383-1.15-.28-1.748l1.392-8.035-5.894-5.69c-1.1-1.062-1.123-2.807-.05-3.897.427-.434.986-.716 1.592-.803l8.146-1.172 3.643-7.31c.68-1.366 2.348-1.926 3.726-1.252.55.268.993.708 1.264 1.251l3.643 7.31 8.146 1.173c1.52.219 2.575 1.617 2.354 3.123-.088.6-.374 1.154-.812 1.577l-5.894 5.69 1.391 8.035c.26 1.5-.757 2.925-2.272 3.182-.603.102-1.223.005-1.765-.277L20 31.723l-7.286 3.793zm5.991-7.27c.81-.422 1.78-.422 2.59 0l6.054 3.152-1.156-6.677c-.155-.893.144-1.805.8-2.439l4.898-4.728-6.769-.974c-.906-.13-1.69-.694-2.095-1.507L20 8.998l-3.027 6.075c-.405.813-1.189 1.377-2.095 1.507l-6.77.974 4.899 4.729c.656.633.955 1.545.8 2.438l-1.156 6.677 6.054-3.152z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Best answer</span>
                                                                    </div>
                                                                    <div class="sign-wrap">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M20 3.333c6.444 0 11.667 5.224 11.667 11.667 0 2.198-.608 4.254-1.665 6.01L30 33.528c0 1.381-1.12 2.5-2.5 2.5-.362 0-.72-.078-1.047-.23l-.24-.126-5.355-3.214c-.462-.277-1.025-.311-1.512-.104l-.203.104-5.357 3.214c-1.184.71-2.72.327-3.43-.857-.186-.311-.302-.658-.341-1.016l-.015-.27V21.012C8.942 19.257 8.334 17.2 8.334 15 8.334 8.557 13.556 3.334 20 3.334zm6.667 28.724l.002-7.483c-1.89 1.32-4.19 2.093-6.669 2.093-2.479 0-4.777-.773-6.667-2.092v7.482l4.095-2.457c1.484-.89 3.316-.946 4.843-.167l.302.167 4.094 2.457.002-7.483-.002 7.483zM20 6.667c-4.602 0-8.333 3.73-8.333 8.333s3.73 8.334 8.333 8.334c4.602 0 8.333-3.731 8.333-8.334 0-4.602-3.73-8.333-8.333-8.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="reward-text">Rewarded answer</span>
                                                                        <div class="tooltip-rewarded-answer" a>
                                                                            <i class="info-icon-wrap">
                                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99992 14.6667C4.31802 14.6667 1.33325 11.6819 1.33325 8.00004C1.33325 4.31814 4.31802 1.33337 7.99992 1.33337C11.6818 1.33337 14.6666 4.31814 14.6666 8.00004C14.6666 11.6819 11.6818 14.6667 7.99992 14.6667ZM7.99989 13.3334C10.9454 13.3334 13.3332 10.9456 13.3332 8.0001C13.3332 5.05458 10.9454 2.66677 7.99989 2.66677C5.05437 2.66677 2.66655 5.05458 2.66655 8.0001C2.66655 10.9456 5.05437 13.3334 7.99989 13.3334ZM7.99992 6.66677C8.36811 6.66677 8.66658 6.96524 8.66658 7.33343V11.3334C8.66658 11.7016 8.36811 12.0001 7.99992 12.0001C7.63173 12.0001 7.33325 11.7016 7.33325 11.3334V7.33343C7.33325 6.96524 7.63173 6.66677 7.99992 6.66677ZM7.99992 5.33331C7.63173 5.33331 7.33325 5.03484 7.33325 4.66665C7.33325 4.29846 7.63173 3.99998 7.99992 3.99998C8.36811 3.99998 8.66658 4.29846 8.66658 4.66665C8.66658 5.03484 8.36811 5.33331 7.99992 5.33331Z" fill="#666"></path>
                                                                                </svg>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="top-text">
                                                                <p>Yes, you can consume it 4-5 servings.🌾🍊</p>
                                                            </div>
                                                            <div class="desclaimer-text">
                                                                <span class="desclaimer-inner">
                                                                    <span class="color-tex">Disclaimer:</span>Not medical or professional advice.
                                                                </span>
                                                            </div>
                                                            <div class="flex-bottom">
                                                                <div class="flex-brow">
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-up"></i>
                                                                        <span class="">25</span>
                                                                    </button>
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-down"></i>
                                                                        <span class="">7</span>
                                                                    </button>
                                                                </div>
                                                                <div class="question-button">
                                                                    <div class="report">
                                                                        <div class="question-abuse">
                                                                            <button class="ugc-text">Report abuse</span></button>
                                                                        </div>
                                                                        <div class="question-share">
                                                                            Share <i class="fa-solid fa-share-nodes"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="see-area">
                                                        <a href="#" class="see-more">See more answers (160) <i class="fa-solid fa-chevron-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Question-section">
                                            <div class="hydrated">
                                                <div class="ugc-question-and-answer">
                                                    <div class="hydrated-title">
                                                        <div class="ugc-question-title">
                                                            <div class="question-text">
                                                                <div class="flex-col">
                                                                    <p>Can i take more than 1 capsule a day?</p>
                                                                </div>
                                                            </div>
                                                            <div class="question-button">
                                                                <div class="pdp-qna-answer-button">
                                                                    <button class="ugc-btn">Answer</button>
                                                                </div>
                                                                <div class="report">
                                                                    <div class="question-abuse">
                                                                        <button class="ugc-text">Report abuse</span></button>
                                                                    </div>
                                                                    <div class="question-share">
                                                                        Share <i class="fa-solid fa-share-nodes"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hydrated">
                                                        <div class="gray-bg">
                                                            <div class="flex-row-wrap">
                                                                <div class="row-inner">
                                                                    <a href="#" class="flex-row-start">
                                                                        <span class="profile-icon">
                                                                            <i class="fa-solid fa-user"></i>
                                                                        </span>
                                                                    </a>
                                                                    <a href="#" class="profile-name">Justgo Customer</a>
                                                                </div>
                                                                <div class="date">Sep 22, 2021</div>
                                                            </div>
                                                            <div class="hydrated-inner">
                                                                <div class="flex-row-area">
                                                                    <div class="sign-wrap ">
                                                                        <svg viewBox="0 0 16 16" width="16" height="16" fill="none">
                                                                            <path fill="#666" fill-rule="evenodd" d="M6.862 10.471l-2-2c-.26-.26-.26-.682 0-.942.26-.26.682-.26.943 0l1.293 1.293c.13.13.34.13.47 0l3.294-3.293c.26-.26.682-.26.943 0 .26.26.26.682 0 .942l-4 4c-.13.13-.301.196-.472.196-.17 0-.341-.065-.471-.196zM8 14.667c-3.682 0-6.667-2.985-6.667-6.667S4.318 1.333 8 1.333 14.667 4.318 14.667 8 11.682 14.667 8 14.667zm0-1.334c2.945 0 5.333-2.387 5.333-5.333 0-2.945-2.388-5.333-5.333-5.333-2.946 0-5.333 2.388-5.333 5.333 0 2.946 2.387 5.333 5.333 5.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Verified purchase</span>
                                                                    </div>
                                                                    <div class="sign-wrap ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M12.714 35.516c-1.36.708-3.043.19-3.758-1.157-.284-.536-.383-1.15-.28-1.748l1.392-8.035-5.894-5.69c-1.1-1.062-1.123-2.807-.05-3.897.427-.434.986-.716 1.592-.803l8.146-1.172 3.643-7.31c.68-1.366 2.348-1.926 3.726-1.252.55.268.993.708 1.264 1.251l3.643 7.31 8.146 1.173c1.52.219 2.575 1.617 2.354 3.123-.088.6-.374 1.154-.812 1.577l-5.894 5.69 1.391 8.035c.26 1.5-.757 2.925-2.272 3.182-.603.102-1.223.005-1.765-.277L20 31.723l-7.286 3.793zm5.991-7.27c.81-.422 1.78-.422 2.59 0l6.054 3.152-1.156-6.677c-.155-.893.144-1.805.8-2.439l4.898-4.728-6.769-.974c-.906-.13-1.69-.694-2.095-1.507L20 8.998l-3.027 6.075c-.405.813-1.189 1.377-2.095 1.507l-6.77.974 4.899 4.729c.656.633.955 1.545.8 2.438l-1.156 6.677 6.054-3.152z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Best answer</span>
                                                                    </div>
                                                                    <div class="sign-wrap">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M20 3.333c6.444 0 11.667 5.224 11.667 11.667 0 2.198-.608 4.254-1.665 6.01L30 33.528c0 1.381-1.12 2.5-2.5 2.5-.362 0-.72-.078-1.047-.23l-.24-.126-5.355-3.214c-.462-.277-1.025-.311-1.512-.104l-.203.104-5.357 3.214c-1.184.71-2.72.327-3.43-.857-.186-.311-.302-.658-.341-1.016l-.015-.27V21.012C8.942 19.257 8.334 17.2 8.334 15 8.334 8.557 13.556 3.334 20 3.334zm6.667 28.724l.002-7.483c-1.89 1.32-4.19 2.093-6.669 2.093-2.479 0-4.777-.773-6.667-2.092v7.482l4.095-2.457c1.484-.89 3.316-.946 4.843-.167l.302.167 4.094 2.457.002-7.483-.002 7.483zM20 6.667c-4.602 0-8.333 3.73-8.333 8.333s3.73 8.334 8.333 8.334c4.602 0 8.333-3.731 8.333-8.334 0-4.602-3.73-8.333-8.333-8.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="reward-text">Rewarded answer</span>
                                                                        <div class="tooltip-rewarded-answer" a>
                                                                            <i class="info-icon-wrap">
                                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99992 14.6667C4.31802 14.6667 1.33325 11.6819 1.33325 8.00004C1.33325 4.31814 4.31802 1.33337 7.99992 1.33337C11.6818 1.33337 14.6666 4.31814 14.6666 8.00004C14.6666 11.6819 11.6818 14.6667 7.99992 14.6667ZM7.99989 13.3334C10.9454 13.3334 13.3332 10.9456 13.3332 8.0001C13.3332 5.05458 10.9454 2.66677 7.99989 2.66677C5.05437 2.66677 2.66655 5.05458 2.66655 8.0001C2.66655 10.9456 5.05437 13.3334 7.99989 13.3334ZM7.99992 6.66677C8.36811 6.66677 8.66658 6.96524 8.66658 7.33343V11.3334C8.66658 11.7016 8.36811 12.0001 7.99992 12.0001C7.63173 12.0001 7.33325 11.7016 7.33325 11.3334V7.33343C7.33325 6.96524 7.63173 6.66677 7.99992 6.66677ZM7.99992 5.33331C7.63173 5.33331 7.33325 5.03484 7.33325 4.66665C7.33325 4.29846 7.63173 3.99998 7.99992 3.99998C8.36811 3.99998 8.66658 4.29846 8.66658 4.66665C8.66658 5.03484 8.36811 5.33331 7.99992 5.33331Z" fill="#666"></path>
                                                                                </svg>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="top-text">
                                                                <p>Yes, you can consume it 4-5 servings.🌾🍊</p>
                                                            </div>
                                                            <div class="desclaimer-text">
                                                                <span class="desclaimer-inner">
                                                                    <span class="color-tex">Disclaimer:</span>Not medical or professional advice.
                                                                </span>
                                                            </div>
                                                            <div class="flex-bottom">
                                                                <div class="flex-brow">
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-up"></i>
                                                                        <span class="">25</span>
                                                                    </button>
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-down"></i>
                                                                        <span class="">7</span>
                                                                    </button>
                                                                </div>
                                                                <div class="question-button">
                                                                    <div class="report">
                                                                        <div class="question-abuse">
                                                                            <button class="ugc-text">Report abuse</span></button>
                                                                        </div>
                                                                        <div class="question-share">
                                                                            Share <i class="fa-solid fa-share-nodes"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="see-area">
                                                        <a href="#" class="see-more">See more answers (160) <i class="fa-solid fa-chevron-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Question-section">
                                            <div class="hydrated">
                                                <div class="ugc-question-and-answer">
                                                    <div class="hydrated-title">
                                                        <div class="ugc-question-title">
                                                            <div class="question-text">
                                                                <div class="flex-col">
                                                                    <p>Can i take more than 1 capsule a day?</p>
                                                                </div>
                                                            </div>
                                                            <div class="question-button">
                                                                <div class="pdp-qna-answer-button">
                                                                    <button class="ugc-btn">Answer</button>
                                                                </div>
                                                                <div class="report">
                                                                    <div class="question-abuse">
                                                                        <button class="ugc-text">Report abuse</span></button>
                                                                    </div>
                                                                    <div class="question-share">
                                                                        Share <i class="fa-solid fa-share-nodes"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hydrated">
                                                        <div class="gray-bg">
                                                            <div class="flex-row-wrap">
                                                                <div class="row-inner">
                                                                    <a href="#" class="flex-row-start">
                                                                        <span class="profile-icon">
                                                                            <i class="fa-solid fa-user"></i>
                                                                        </span>
                                                                    </a>
                                                                    <a href="#" class="profile-name">Justgo Customer</a>
                                                                </div>
                                                                <div class="date">Sep 22, 2021</div>
                                                            </div>
                                                            <div class="hydrated-inner">
                                                                <div class="flex-row-area">
                                                                    <div class="sign-wrap ">
                                                                        <svg viewBox="0 0 16 16" width="16" height="16" fill="none">
                                                                            <path fill="#666" fill-rule="evenodd" d="M6.862 10.471l-2-2c-.26-.26-.26-.682 0-.942.26-.26.682-.26.943 0l1.293 1.293c.13.13.34.13.47 0l3.294-3.293c.26-.26.682-.26.943 0 .26.26.26.682 0 .942l-4 4c-.13.13-.301.196-.472.196-.17 0-.341-.065-.471-.196zM8 14.667c-3.682 0-6.667-2.985-6.667-6.667S4.318 1.333 8 1.333 14.667 4.318 14.667 8 11.682 14.667 8 14.667zm0-1.334c2.945 0 5.333-2.387 5.333-5.333 0-2.945-2.388-5.333-5.333-5.333-2.946 0-5.333 2.388-5.333 5.333 0 2.946 2.387 5.333 5.333 5.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Verified purchase</span>
                                                                    </div>
                                                                    <div class="sign-wrap ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M12.714 35.516c-1.36.708-3.043.19-3.758-1.157-.284-.536-.383-1.15-.28-1.748l1.392-8.035-5.894-5.69c-1.1-1.062-1.123-2.807-.05-3.897.427-.434.986-.716 1.592-.803l8.146-1.172 3.643-7.31c.68-1.366 2.348-1.926 3.726-1.252.55.268.993.708 1.264 1.251l3.643 7.31 8.146 1.173c1.52.219 2.575 1.617 2.354 3.123-.088.6-.374 1.154-.812 1.577l-5.894 5.69 1.391 8.035c.26 1.5-.757 2.925-2.272 3.182-.603.102-1.223.005-1.765-.277L20 31.723l-7.286 3.793zm5.991-7.27c.81-.422 1.78-.422 2.59 0l6.054 3.152-1.156-6.677c-.155-.893.144-1.805.8-2.439l4.898-4.728-6.769-.974c-.906-.13-1.69-.694-2.095-1.507L20 8.998l-3.027 6.075c-.405.813-1.189 1.377-2.095 1.507l-6.77.974 4.899 4.729c.656.633.955 1.545.8 2.438l-1.156 6.677 6.054-3.152z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Best answer</span>
                                                                    </div>
                                                                    <div class="sign-wrap">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M20 3.333c6.444 0 11.667 5.224 11.667 11.667 0 2.198-.608 4.254-1.665 6.01L30 33.528c0 1.381-1.12 2.5-2.5 2.5-.362 0-.72-.078-1.047-.23l-.24-.126-5.355-3.214c-.462-.277-1.025-.311-1.512-.104l-.203.104-5.357 3.214c-1.184.71-2.72.327-3.43-.857-.186-.311-.302-.658-.341-1.016l-.015-.27V21.012C8.942 19.257 8.334 17.2 8.334 15 8.334 8.557 13.556 3.334 20 3.334zm6.667 28.724l.002-7.483c-1.89 1.32-4.19 2.093-6.669 2.093-2.479 0-4.777-.773-6.667-2.092v7.482l4.095-2.457c1.484-.89 3.316-.946 4.843-.167l.302.167 4.094 2.457.002-7.483-.002 7.483zM20 6.667c-4.602 0-8.333 3.73-8.333 8.333s3.73 8.334 8.333 8.334c4.602 0 8.333-3.731 8.333-8.334 0-4.602-3.73-8.333-8.333-8.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="reward-text">Rewarded answer</span>
                                                                        <div class="tooltip-rewarded-answer" a>
                                                                            <i class="info-icon-wrap">
                                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99992 14.6667C4.31802 14.6667 1.33325 11.6819 1.33325 8.00004C1.33325 4.31814 4.31802 1.33337 7.99992 1.33337C11.6818 1.33337 14.6666 4.31814 14.6666 8.00004C14.6666 11.6819 11.6818 14.6667 7.99992 14.6667ZM7.99989 13.3334C10.9454 13.3334 13.3332 10.9456 13.3332 8.0001C13.3332 5.05458 10.9454 2.66677 7.99989 2.66677C5.05437 2.66677 2.66655 5.05458 2.66655 8.0001C2.66655 10.9456 5.05437 13.3334 7.99989 13.3334ZM7.99992 6.66677C8.36811 6.66677 8.66658 6.96524 8.66658 7.33343V11.3334C8.66658 11.7016 8.36811 12.0001 7.99992 12.0001C7.63173 12.0001 7.33325 11.7016 7.33325 11.3334V7.33343C7.33325 6.96524 7.63173 6.66677 7.99992 6.66677ZM7.99992 5.33331C7.63173 5.33331 7.33325 5.03484 7.33325 4.66665C7.33325 4.29846 7.63173 3.99998 7.99992 3.99998C8.36811 3.99998 8.66658 4.29846 8.66658 4.66665C8.66658 5.03484 8.36811 5.33331 7.99992 5.33331Z" fill="#666"></path>
                                                                                </svg>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="top-text">
                                                                <p>Yes, you can consume it 4-5 servings.🌾🍊</p>
                                                            </div>
                                                            <div class="desclaimer-text">
                                                                <span class="desclaimer-inner">
                                                                    <span class="color-tex">Disclaimer:</span>Not medical or professional advice.
                                                                </span>
                                                            </div>
                                                            <div class="flex-bottom">
                                                                <div class="flex-brow">
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-up"></i>
                                                                        <span class="">25</span>
                                                                    </button>
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-down"></i>
                                                                        <span class="">7</span>
                                                                    </button>
                                                                </div>
                                                                <div class="question-button">
                                                                    
                                                                    <div class="report">
                                                                        <div class="question-abuse">
                                                                            <button class="ugc-text">Report abuse</span></button>
                                                                        </div>
                                                                        <div class="question-share">
                                                                            Share <i class="fa-solid fa-share-nodes"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="see-area">
                                                        <a href="#" class="see-more">See more answers (160) <i class="fa-solid fa-chevron-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="allSee-wrap">
                                            <div class="see-area">
                                                <a href="#" class="see-more">See all 448 questions <i class="fa-solid fa-chevron-right"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
</section>




<!-- <section class="product-accordian">
    <img
        class="acc-vector"
        src="{{url('public/images/blogcard-vector.png')}}"
        alt="Seller" />
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="accordion-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Product Overview
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    <ul>
                                        <li>
                                            <p>California Gold Nutrition ProteinUP, 7.26 oz (206 g)</p>
                                        </li>
                                        <li>
                                            <p>Marine Sourced Protein Peptides + Hyaluronic Acid + Vitamin C</p>
                                        </li>
                                        <li>
                                            <p>Featuring Unflavored, Non-Bovine, Hydrolyzed Fish Protein</p>
                                        </li>
                                        <li>
                                            <p>With Non-Animal Source Hyaluronic Acid and Vitamin C</p>
                                        </li>
                                        <li>
                                            <p>Support for Healthy Hair, Skin, Nails, Joints, and Bones*</p>
                                        </li>
                                        <li>
                                            <p>Enzymatically Hydrolyzed Protein Broken Down into Bioavailable Peptides</p>
                                        </li>
                                        <li>
                                            <p>Formulated without Gluten, GMOs, or Soy</p>
                                        </li>
                                        <li>
                                            <p>Produced in a 3rd Party Audited cGMP Registered (Certified) Facility</p>
                                        </li>
                                        <li>
                                            <p>100% Gold Guarantee</p>
                                        </li>
                                        <li>
                                            <p>Now in a Resealable Pouch for Easier Storage</p>
                                        </li>
                                    </ul>
                                    <p>Collagen, hyaluronic acid, and vitamin C all contribute to the health and well-being of the musculoskeletal system. CollagenUP contains all three of these ingredients to help support healthy hair, skin, nails, joints, and bones.* The unflavored powder can be quickly added to your favorite drink, providing a convenient way to add collagen to your diet.</p>
                                    <h2>Types of Collagen</h2>
                                    <p>Collagen is the primary structural protein found throughout the body and provides crucial infrastructure, both inside and out. There are many types of collagen that differ by how the molecules are assembled and where the collagen is used in your body. Our CollagenUP powder contains both type I and type III collagen, which are 2 of the 5 main types of collagen:</p>
                                    <ul>
                                        <li>
                                            <p>Type I: This type of collagen makes up 80 to 90% of your body’s total collagen. Because it is densely packed, type I collagen provides structure to skin, bones, tendons, and ligaments.</p>
                                        </li>
                                        <li>
                                            <p>Type II: Found in elastic cartilage, such as knees and shoulders, this type of collagen provides support for joints.</p>
                                        </li>
                                        <li>
                                            <p>Type III: This type of collagen is commonly present with Type I and is found in muscles, arteries, and organs.</p>
                                        </li>
                                        <li>
                                            <p>Type IV: Found in the layers of your skin, type IV collagen helps support various functions of the skin.</p>
                                        </li>
                                        <li>
                                            <p>Type V: This type of collagen is found in the cornea of your eyes, bones, some layers of skin, hair, and tissue of the placenta.</p>
                                        </li>
                                    </ul>
                                    <h2>Plus Hyaluronic Acid and Vitamin C</h2>
                                    <p>Our advanced collagen formula also includes two additional powerhouse ingredients – hyaluronic acid and vitamin C. Hyaluronic acid is a component of connective tissue and can provide the fluid matrix for joint lubrication, skin hydration, and repair.* Vitamin C plays a role in the production of collagen and assists in antioxidant protection.* Research suggests that regular consumption of these nutrients can provide the body with the fundamental building blocks that can help to support the health of joints, bones, skin, hair, and nails.*</p>
                                    <p>CollagenUP features non-bovine, marine-sourced collagen peptides with hyaluronic acid and vitamin C. The specially processed fish collagen is enzymatically hydrolyzed (broken down) into low molecular weight component amino acid peptides in order to help ensure optimal absorption and bioavailability.*</p>
                                    <div class="doc-table">
                                        <table>
                                            <caption>Typical Amino Acids Profile (mg) Per Serving</caption>
                                            <tbody>
                                                <tr>
                                                    <td>Visa - 3412</td>
                                                    <td>04/01/2016</td>
                                                    <td>$1,190</td>
                                                    <td>03/01/2016 - 03/31/2016</td>
                                                </tr>
                                                <tr>
                                                    <td>Visa - 6076</td>
                                                    <td>03/01/2016</td>
                                                    <td>$2,443</td>
                                                    <td>02/01/2016 - 02/29/2016</td>
                                                </tr>
                                                <tr>
                                                    <td>Corporate AMEX</td>
                                                    <td>03/01/2016</td>
                                                    <td>$1,181</td>
                                                    <td>02/01/2016 - 02/29/2016</td>
                                                </tr>
                                                <tr>
                                                    <td>Visa - 3412</td>
                                                    <td>02/01/2016</td>
                                                    <td>$842</td>
                                                    <td>01/01/2016 - 01/31/2016</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p style="margin-bottom: 0px;">May vary slightly from batch to batch</p>
                                    <p>Essential Amino Acids</p>
                                    <h2>Third-Party Tested</h2>
                                    <p>Our products undergo quality testing where they are evaluated by an independent ISO-certified lab using scientifically-validated test methods to ensure authenticity, purity, and potency of ingredients. For added transparency, we make the results available to you in our iTested Verified Reports so you can see for yourself.
                                        Check out the iTested Report for this product to see the analysis.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Details
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    <h2>Suggested use</h2>
                                    <p>Mix 1 scoop daily (5 grams♦) in 6-8 fl oz of room temperature water or juice and mix well (for best results, mix in a blender bottle). Drink on an empty stomach at least 1 hour before or 2 hours after meals, or as recommended by a healthcare professional. ♦5 grams per scoop is an average. Individual scooping technique may yield slightly less than or slightly more than 5 grams.</p>
                                    <h2>Warnings</h2>
                                    <p>Keep out of reach of children. Consult with a physician, pharmacist, naturopath or other qualified healthcare professional prior to taking dietary supplements.
                                        Sealed for your protection. Do not use if pouch is punctured or seal is missing or broken. Store in a cool, dry place. Protect from heat, light, and moisture. Aroma, color, consistency and taste may vary. Color shift is normal and cannot be avoided.
                                        THIS PRODUCT IS PACKAGED AND SOLD BY WEIGHT, NOT BY VOLUME. SETTLING OF CONTENTS OCCURS OVER TIME.
                                        CONTAINS A FOOD-GRADE MOISTURE ABSORBER TO MAINTAIN FRESHNESS. DO NOT EAT.
                                    </p>
                                    <h2>Disclaimer</h2>
                                    <p>The content in this video is intended for entertainment and informational purposes only. All opinions expressed are my own and are not influenced by any external factors. Please note that the information shared may not be entirely accurate or up-to-date, and it’s always best to do your own research or consult a professional before making any decisions based on the content. Viewer discretion is advised.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    ingredient info
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    <div class="row mt-4">
                                        <div class="col-md-12 col-lg-6">
                                            <div class="accordion-inner supplement-facts-container">
                                                <table border="1" cellpadding="3" cellspacing="0" width="100%">
                                                    <tbody>
                                                        <tr valign="top">
                                                            <td colspan="3"><strong>Supplement facts</strong></td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td colspan="3"><strong>Serving Size:</strong> 1 Capsule</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td colspan="3"><strong>Servings Per Container:</strong> 60</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td width="60%"><br></td>
                                                            <td width="20%"><strong>Amount Per Serving</strong></td>
                                                            <td width="20%"><strong>%Daily Value</strong></td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td>Calories</td>
                                                            <td>20</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td>Protein</td>
                                                            <td>4g</td>
                                                            <td> 1%**</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td>Vitamin C ( as Calcium Ascorbate)</td>
                                                            <td>90mg</td>
                                                            <td> 100%</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td>Sodium </td>
                                                            <td>20mg</td>
                                                            <td> 1%</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td>Hydrolyzed Marine Collagen Peptides </td>
                                                            <td>5g</td>
                                                            <td> 1%</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td>Hydrolyzed Acid (as ) Sodium Hyaluronate </td>
                                                            <td>60g</td>
                                                            <td> 1%</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td>Percent Daily Values are based on a 2000 calorie diet.Daily Value not established </td>
                                                            <td></td>
                                                            <td> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6">
                                            <div class="incredient-wrap">
                                                <h2>Other Ingredients</h2>
                                                <strong>Main Ingredients</strong>
                                                <p>Vitamin C (as Calcium Ascorbate), Sodium, Hydrolyzed Marine Collagen Peptides, Hyaluronic Acid (as Sodium Hyaluronate</p>
                                                <strong>Other Ingredients</strong>
                                                <p>CONTAINS: Fish (one or more of the following: Atlantic and Channel Catfish, Cod, Haddock, Ling, Pangasius, Pollock, Salmon, Tilapia, Trout)</p>
                                                <i>Not manufactured with milk, eggs, crustacean shellfish, tree nuts, peanuts, wheat, soy, sesame, or gluten. Produced in an FDA-registered, third-party audited, and cGMP-compliant facility that may process other products that contain these allergens or ingredients.</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="accordion-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Q & A (1,074)
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="pro-accordion">
                                    <p>Answers posted solely reflect the views and opinions expressed by the contributors and not those of Justgo. Justgo does not verify or endorse such answers or claims. Statements regarding dietary supplements have not been evaluated by the FDA and are not intended to diagnose, treat, cure, or prevent any disease or health condition.</p>
                                    <div class="QReflect-section">
                                        <div class="main-form">
                                            <div class="pdp-qna-search">
                                                <div class="ugc-input-wrap">
                                                    <input type="text" id="Search" placeholder="Search" class="pointer" autofocus>
                                                    <div class="search-button">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 2C15.9706 2 20 6.02944 20 11C20 13.1248 19.2637 15.0776 18.0323 16.6172L21.7071 20.2929C22.0976 20.6834 22.0976 21.3166 21.7071 21.7071C21.3466 22.0676 20.7794 22.0953 20.3871 21.7903L20.2929 21.7071L16.6172 18.0323C15.0776 19.2637 13.1248 20 11 20C6.02944 20 2 15.9706 2 11C2 6.02944 6.02944 2 11 2ZM11 4.00009C7.13396 4.00009 3.99995 7.1341 3.99995 11.0001C3.99995 14.8661 7.13396 18.0001 11 18.0001C14.8659 18.0001 18 14.8661 18 11.0001C18 7.1341 14.8659 4.00009 11 4.00009Z" fill="#666"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pdp-qna-filter">
                                                <div class="relative">
                                                    <div id="Category-select" class="ugc-select-wrap actived">
                                                        <label for="Category" class="fs-14 pointer">Category</label>
                                                        <select id="Category">
                                                            <option value="All"> All </option>
                                                            <option value="Specifications"> Specifications </option>
                                                            <option value="Brand"> Brand </option>
                                                            <option value="Ingredients"> Ingredients </option>
                                                            <option value=""> Usage </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pdp-qna-sort">
                                                <div class="relative">
                                                    <div id="Sort by-select" class="ugc-select-wrap actived">
                                                        <label for="Sort by" class="fs-14 pointer">Sort by</label>
                                                        <select id="Category">
                                                            <option value="Most relevant"> Most relevant </option>
                                                            <option value="Newly answered"> Newly answered </option>
                                                            <option value="Most helpful"> Most helpful </option>
                                                            <option value="Newest"> Newest </option>
                                                            <option value="Oldest"> Oldest </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ask-question">
                                                <button class="ugc-button">Ask a Question</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Question-main">
                                        <div class="Question-section">
                                            <div class="hydrated">
                                                <div class="ugc-question-and-answer">
                                                    <div class="hydrated-title">
                                                        <div class="ugc-question-title">
                                                            <div class="question-text">
                                                                <div class="flex-col">
                                                                    <p>Can i take more than 1 capsule a day?</p>
                                                                </div>
                                                            </div>
                                                            <div class="question-button">
                                                                <div class="pdp-qna-answer-button">
                                                                    <button class="ugc-btn">Answer</button>
                                                                </div>
                                                                <div class="report">
                                                                    <div class="question-abuse">
                                                                        <button class="ugc-text">Report abuse</span></button>
                                                                    </div>
                                                                    <div class="question-share">
                                                                        Share <i class="fa-solid fa-share-nodes"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hydrated">
                                                        <div class="gray-bg">
                                                            <div class="flex-row-wrap">
                                                                <div class="row-inner">
                                                                    <a href="#" class="flex-row-start">
                                                                        <span class="profile-icon">
                                                                            <i class="fa-solid fa-user"></i>
                                                                        </span>
                                                                    </a>
                                                                    <a href="#" class="profile-name">Justgo Customer</a>
                                                                </div>
                                                                <div class="date">Sep 22, 2021</div>
                                                            </div>
                                                            <div class="hydrated-inner">
                                                                <div class="flex-row-area">
                                                                    <div class="sign-wrap ">
                                                                        <svg viewBox="0 0 16 16" width="16" height="16" fill="none">
                                                                            <path fill="#666" fill-rule="evenodd" d="M6.862 10.471l-2-2c-.26-.26-.26-.682 0-.942.26-.26.682-.26.943 0l1.293 1.293c.13.13.34.13.47 0l3.294-3.293c.26-.26.682-.26.943 0 .26.26.26.682 0 .942l-4 4c-.13.13-.301.196-.472.196-.17 0-.341-.065-.471-.196zM8 14.667c-3.682 0-6.667-2.985-6.667-6.667S4.318 1.333 8 1.333 14.667 4.318 14.667 8 11.682 14.667 8 14.667zm0-1.334c2.945 0 5.333-2.387 5.333-5.333 0-2.945-2.388-5.333-5.333-5.333-2.946 0-5.333 2.388-5.333 5.333 0 2.946 2.387 5.333 5.333 5.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Verified purchase</span>
                                                                    </div>
                                                                    <div class="sign-wrap ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M12.714 35.516c-1.36.708-3.043.19-3.758-1.157-.284-.536-.383-1.15-.28-1.748l1.392-8.035-5.894-5.69c-1.1-1.062-1.123-2.807-.05-3.897.427-.434.986-.716 1.592-.803l8.146-1.172 3.643-7.31c.68-1.366 2.348-1.926 3.726-1.252.55.268.993.708 1.264 1.251l3.643 7.31 8.146 1.173c1.52.219 2.575 1.617 2.354 3.123-.088.6-.374 1.154-.812 1.577l-5.894 5.69 1.391 8.035c.26 1.5-.757 2.925-2.272 3.182-.603.102-1.223.005-1.765-.277L20 31.723l-7.286 3.793zm5.991-7.27c.81-.422 1.78-.422 2.59 0l6.054 3.152-1.156-6.677c-.155-.893.144-1.805.8-2.439l4.898-4.728-6.769-.974c-.906-.13-1.69-.694-2.095-1.507L20 8.998l-3.027 6.075c-.405.813-1.189 1.377-2.095 1.507l-6.77.974 4.899 4.729c.656.633.955 1.545.8 2.438l-1.156 6.677 6.054-3.152z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Best answer</span>
                                                                    </div>
                                                                    <div class="sign-wrap">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M20 3.333c6.444 0 11.667 5.224 11.667 11.667 0 2.198-.608 4.254-1.665 6.01L30 33.528c0 1.381-1.12 2.5-2.5 2.5-.362 0-.72-.078-1.047-.23l-.24-.126-5.355-3.214c-.462-.277-1.025-.311-1.512-.104l-.203.104-5.357 3.214c-1.184.71-2.72.327-3.43-.857-.186-.311-.302-.658-.341-1.016l-.015-.27V21.012C8.942 19.257 8.334 17.2 8.334 15 8.334 8.557 13.556 3.334 20 3.334zm6.667 28.724l.002-7.483c-1.89 1.32-4.19 2.093-6.669 2.093-2.479 0-4.777-.773-6.667-2.092v7.482l4.095-2.457c1.484-.89 3.316-.946 4.843-.167l.302.167 4.094 2.457.002-7.483-.002 7.483zM20 6.667c-4.602 0-8.333 3.73-8.333 8.333s3.73 8.334 8.333 8.334c4.602 0 8.333-3.731 8.333-8.334 0-4.602-3.73-8.333-8.333-8.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="reward-text">Rewarded answer</span>
                                                                        <div class="tooltip-rewarded-answer" a>
                                                                            <i class="info-icon-wrap">
                                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99992 14.6667C4.31802 14.6667 1.33325 11.6819 1.33325 8.00004C1.33325 4.31814 4.31802 1.33337 7.99992 1.33337C11.6818 1.33337 14.6666 4.31814 14.6666 8.00004C14.6666 11.6819 11.6818 14.6667 7.99992 14.6667ZM7.99989 13.3334C10.9454 13.3334 13.3332 10.9456 13.3332 8.0001C13.3332 5.05458 10.9454 2.66677 7.99989 2.66677C5.05437 2.66677 2.66655 5.05458 2.66655 8.0001C2.66655 10.9456 5.05437 13.3334 7.99989 13.3334ZM7.99992 6.66677C8.36811 6.66677 8.66658 6.96524 8.66658 7.33343V11.3334C8.66658 11.7016 8.36811 12.0001 7.99992 12.0001C7.63173 12.0001 7.33325 11.7016 7.33325 11.3334V7.33343C7.33325 6.96524 7.63173 6.66677 7.99992 6.66677ZM7.99992 5.33331C7.63173 5.33331 7.33325 5.03484 7.33325 4.66665C7.33325 4.29846 7.63173 3.99998 7.99992 3.99998C8.36811 3.99998 8.66658 4.29846 8.66658 4.66665C8.66658 5.03484 8.36811 5.33331 7.99992 5.33331Z" fill="#666"></path>
                                                                                </svg>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="top-text">
                                                                <p>Yes, you can consume it 4-5 servings.🌾🍊</p>
                                                            </div>
                                                            <div class="desclaimer-text">
                                                                <span class="desclaimer-inner">
                                                                    <span class="color-tex">Disclaimer:</span>Not medical or professional advice.
                                                                </span>
                                                            </div>
                                                            <div class="flex-bottom">
                                                                <div class="flex-brow">
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-up"></i>
                                                                        <span class="">25</span>
                                                                    </button>
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-down"></i>
                                                                        <span class="">7</span>
                                                                    </button>
                                                                </div>
                                                                <div class="question-button">
                                                                    <div class="report">
                                                                        <div class="question-abuse">
                                                                            <button class="ugc-text">Report abuse</span></button>
                                                                        </div>
                                                                        <div class="question-share">
                                                                            Share <i class="fa-solid fa-share-nodes"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="see-area">
                                                        <a href="#" class="see-more">See more answers (160) <i class="fa-solid fa-chevron-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Question-section">
                                            <div class="hydrated">
                                                <div class="ugc-question-and-answer">
                                                    <div class="hydrated-title">
                                                        <div class="ugc-question-title">
                                                            <div class="question-text">
                                                                <div class="flex-col">
                                                                    <p>Can i take more than 1 capsule a day?</p>
                                                                </div>
                                                            </div>
                                                            <div class="question-button">
                                                                <div class="pdp-qna-answer-button">
                                                                    <button class="ugc-btn">Answer</button>
                                                                </div>
                                                                <div class="report">
                                                                    <div class="question-abuse">
                                                                        <button class="ugc-text">Report abuse</span></button>
                                                                    </div>
                                                                    <div class="question-share">
                                                                        Share <i class="fa-solid fa-share-nodes"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hydrated">
                                                        <div class="gray-bg">
                                                            <div class="flex-row-wrap">
                                                                <div class="row-inner">
                                                                    <a href="#" class="flex-row-start">
                                                                        <span class="profile-icon">
                                                                            <i class="fa-solid fa-user"></i>
                                                                        </span>
                                                                    </a>
                                                                    <a href="#" class="profile-name">Justgo Customer</a>
                                                                </div>
                                                                <div class="date">Sep 22, 2021</div>
                                                            </div>
                                                            <div class="hydrated-inner">
                                                                <div class="flex-row-area">
                                                                    <div class="sign-wrap ">
                                                                        <svg viewBox="0 0 16 16" width="16" height="16" fill="none">
                                                                            <path fill="#666" fill-rule="evenodd" d="M6.862 10.471l-2-2c-.26-.26-.26-.682 0-.942.26-.26.682-.26.943 0l1.293 1.293c.13.13.34.13.47 0l3.294-3.293c.26-.26.682-.26.943 0 .26.26.26.682 0 .942l-4 4c-.13.13-.301.196-.472.196-.17 0-.341-.065-.471-.196zM8 14.667c-3.682 0-6.667-2.985-6.667-6.667S4.318 1.333 8 1.333 14.667 4.318 14.667 8 11.682 14.667 8 14.667zm0-1.334c2.945 0 5.333-2.387 5.333-5.333 0-2.945-2.388-5.333-5.333-5.333-2.946 0-5.333 2.388-5.333 5.333 0 2.946 2.387 5.333 5.333 5.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Verified purchase</span>
                                                                    </div>
                                                                    <div class="sign-wrap ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M12.714 35.516c-1.36.708-3.043.19-3.758-1.157-.284-.536-.383-1.15-.28-1.748l1.392-8.035-5.894-5.69c-1.1-1.062-1.123-2.807-.05-3.897.427-.434.986-.716 1.592-.803l8.146-1.172 3.643-7.31c.68-1.366 2.348-1.926 3.726-1.252.55.268.993.708 1.264 1.251l3.643 7.31 8.146 1.173c1.52.219 2.575 1.617 2.354 3.123-.088.6-.374 1.154-.812 1.577l-5.894 5.69 1.391 8.035c.26 1.5-.757 2.925-2.272 3.182-.603.102-1.223.005-1.765-.277L20 31.723l-7.286 3.793zm5.991-7.27c.81-.422 1.78-.422 2.59 0l6.054 3.152-1.156-6.677c-.155-.893.144-1.805.8-2.439l4.898-4.728-6.769-.974c-.906-.13-1.69-.694-2.095-1.507L20 8.998l-3.027 6.075c-.405.813-1.189 1.377-2.095 1.507l-6.77.974 4.899 4.729c.656.633.955 1.545.8 2.438l-1.156 6.677 6.054-3.152z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Best answer</span>
                                                                    </div>
                                                                    <div class="sign-wrap">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M20 3.333c6.444 0 11.667 5.224 11.667 11.667 0 2.198-.608 4.254-1.665 6.01L30 33.528c0 1.381-1.12 2.5-2.5 2.5-.362 0-.72-.078-1.047-.23l-.24-.126-5.355-3.214c-.462-.277-1.025-.311-1.512-.104l-.203.104-5.357 3.214c-1.184.71-2.72.327-3.43-.857-.186-.311-.302-.658-.341-1.016l-.015-.27V21.012C8.942 19.257 8.334 17.2 8.334 15 8.334 8.557 13.556 3.334 20 3.334zm6.667 28.724l.002-7.483c-1.89 1.32-4.19 2.093-6.669 2.093-2.479 0-4.777-.773-6.667-2.092v7.482l4.095-2.457c1.484-.89 3.316-.946 4.843-.167l.302.167 4.094 2.457.002-7.483-.002 7.483zM20 6.667c-4.602 0-8.333 3.73-8.333 8.333s3.73 8.334 8.333 8.334c4.602 0 8.333-3.731 8.333-8.334 0-4.602-3.73-8.333-8.333-8.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="reward-text">Rewarded answer</span>
                                                                        <div class="tooltip-rewarded-answer" a>
                                                                            <i class="info-icon-wrap">
                                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99992 14.6667C4.31802 14.6667 1.33325 11.6819 1.33325 8.00004C1.33325 4.31814 4.31802 1.33337 7.99992 1.33337C11.6818 1.33337 14.6666 4.31814 14.6666 8.00004C14.6666 11.6819 11.6818 14.6667 7.99992 14.6667ZM7.99989 13.3334C10.9454 13.3334 13.3332 10.9456 13.3332 8.0001C13.3332 5.05458 10.9454 2.66677 7.99989 2.66677C5.05437 2.66677 2.66655 5.05458 2.66655 8.0001C2.66655 10.9456 5.05437 13.3334 7.99989 13.3334ZM7.99992 6.66677C8.36811 6.66677 8.66658 6.96524 8.66658 7.33343V11.3334C8.66658 11.7016 8.36811 12.0001 7.99992 12.0001C7.63173 12.0001 7.33325 11.7016 7.33325 11.3334V7.33343C7.33325 6.96524 7.63173 6.66677 7.99992 6.66677ZM7.99992 5.33331C7.63173 5.33331 7.33325 5.03484 7.33325 4.66665C7.33325 4.29846 7.63173 3.99998 7.99992 3.99998C8.36811 3.99998 8.66658 4.29846 8.66658 4.66665C8.66658 5.03484 8.36811 5.33331 7.99992 5.33331Z" fill="#666"></path>
                                                                                </svg>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="top-text">
                                                                <p>Yes, you can consume it 4-5 servings.🌾🍊</p>
                                                            </div>
                                                            <div class="desclaimer-text">
                                                                <span class="desclaimer-inner">
                                                                    <span class="color-tex">Disclaimer:</span>Not medical or professional advice.
                                                                </span>
                                                            </div>
                                                            <div class="flex-bottom">
                                                                <div class="flex-brow">
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-up"></i>
                                                                        <span class="">25</span>
                                                                    </button>
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-down"></i>
                                                                        <span class="">7</span>
                                                                    </button>
                                                                </div>
                                                                <div class="question-button">
                                                                    <div class="report">
                                                                        <div class="question-abuse">
                                                                            <button class="ugc-text">Report abuse</span></button>
                                                                        </div>
                                                                        <div class="question-share">
                                                                            Share <i class="fa-solid fa-share-nodes"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="see-area">
                                                        <a href="#" class="see-more">See more answers (160) <i class="fa-solid fa-chevron-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Question-section">
                                            <div class="hydrated">
                                                <div class="ugc-question-and-answer">
                                                    <div class="hydrated-title">
                                                        <div class="ugc-question-title">
                                                            <div class="question-text">
                                                                <div class="flex-col">
                                                                    <p>Can i take more than 1 capsule a day?</p>
                                                                </div>
                                                            </div>
                                                            <div class="question-button">
                                                                <div class="pdp-qna-answer-button">
                                                                    <button class="ugc-btn">Answer</button>
                                                                </div>
                                                                <div class="report">
                                                                    <div class="question-abuse">
                                                                        <button class="ugc-text">Report abuse</span></button>
                                                                    </div>
                                                                    <div class="question-share">
                                                                        Share <i class="fa-solid fa-share-nodes"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hydrated">
                                                        <div class="gray-bg">
                                                            <div class="flex-row-wrap">
                                                                <div class="row-inner">
                                                                    <a href="#" class="flex-row-start">
                                                                        <span class="profile-icon">
                                                                            <i class="fa-solid fa-user"></i>
                                                                        </span>
                                                                    </a>
                                                                    <a href="#" class="profile-name">Justgo Customer</a>
                                                                </div>
                                                                <div class="date">Sep 22, 2021</div>
                                                            </div>
                                                            <div class="hydrated-inner">
                                                                <div class="flex-row-area">
                                                                    <div class="sign-wrap ">
                                                                        <svg viewBox="0 0 16 16" width="16" height="16" fill="none">
                                                                            <path fill="#666" fill-rule="evenodd" d="M6.862 10.471l-2-2c-.26-.26-.26-.682 0-.942.26-.26.682-.26.943 0l1.293 1.293c.13.13.34.13.47 0l3.294-3.293c.26-.26.682-.26.943 0 .26.26.26.682 0 .942l-4 4c-.13.13-.301.196-.472.196-.17 0-.341-.065-.471-.196zM8 14.667c-3.682 0-6.667-2.985-6.667-6.667S4.318 1.333 8 1.333 14.667 4.318 14.667 8 11.682 14.667 8 14.667zm0-1.334c2.945 0 5.333-2.387 5.333-5.333 0-2.945-2.388-5.333-5.333-5.333-2.946 0-5.333 2.388-5.333 5.333 0 2.946 2.387 5.333 5.333 5.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Verified purchase</span>
                                                                    </div>
                                                                    <div class="sign-wrap ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M12.714 35.516c-1.36.708-3.043.19-3.758-1.157-.284-.536-.383-1.15-.28-1.748l1.392-8.035-5.894-5.69c-1.1-1.062-1.123-2.807-.05-3.897.427-.434.986-.716 1.592-.803l8.146-1.172 3.643-7.31c.68-1.366 2.348-1.926 3.726-1.252.55.268.993.708 1.264 1.251l3.643 7.31 8.146 1.173c1.52.219 2.575 1.617 2.354 3.123-.088.6-.374 1.154-.812 1.577l-5.894 5.69 1.391 8.035c.26 1.5-.757 2.925-2.272 3.182-.603.102-1.223.005-1.765-.277L20 31.723l-7.286 3.793zm5.991-7.27c.81-.422 1.78-.422 2.59 0l6.054 3.152-1.156-6.677c-.155-.893.144-1.805.8-2.439l4.898-4.728-6.769-.974c-.906-.13-1.69-.694-2.095-1.507L20 8.998l-3.027 6.075c-.405.813-1.189 1.377-2.095 1.507l-6.77.974 4.899 4.729c.656.633.955 1.545.8 2.438l-1.156 6.677 6.054-3.152z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="fs-14 c-666">Best answer</span>
                                                                    </div>
                                                                    <div class="sign-wrap">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 40 40">
                                                                            <path fill="#666" fill-rule="evenodd" d="M20 3.333c6.444 0 11.667 5.224 11.667 11.667 0 2.198-.608 4.254-1.665 6.01L30 33.528c0 1.381-1.12 2.5-2.5 2.5-.362 0-.72-.078-1.047-.23l-.24-.126-5.355-3.214c-.462-.277-1.025-.311-1.512-.104l-.203.104-5.357 3.214c-1.184.71-2.72.327-3.43-.857-.186-.311-.302-.658-.341-1.016l-.015-.27V21.012C8.942 19.257 8.334 17.2 8.334 15 8.334 8.557 13.556 3.334 20 3.334zm6.667 28.724l.002-7.483c-1.89 1.32-4.19 2.093-6.669 2.093-2.479 0-4.777-.773-6.667-2.092v7.482l4.095-2.457c1.484-.89 3.316-.946 4.843-.167l.302.167 4.094 2.457.002-7.483-.002 7.483zM20 6.667c-4.602 0-8.333 3.73-8.333 8.333s3.73 8.334 8.333 8.334c4.602 0 8.333-3.731 8.333-8.334 0-4.602-3.73-8.333-8.333-8.333z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        <span class="reward-text">Rewarded answer</span>
                                                                        <div class="tooltip-rewarded-answer" a>
                                                                            <i class="info-icon-wrap">
                                                                                <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99992 14.6667C4.31802 14.6667 1.33325 11.6819 1.33325 8.00004C1.33325 4.31814 4.31802 1.33337 7.99992 1.33337C11.6818 1.33337 14.6666 4.31814 14.6666 8.00004C14.6666 11.6819 11.6818 14.6667 7.99992 14.6667ZM7.99989 13.3334C10.9454 13.3334 13.3332 10.9456 13.3332 8.0001C13.3332 5.05458 10.9454 2.66677 7.99989 2.66677C5.05437 2.66677 2.66655 5.05458 2.66655 8.0001C2.66655 10.9456 5.05437 13.3334 7.99989 13.3334ZM7.99992 6.66677C8.36811 6.66677 8.66658 6.96524 8.66658 7.33343V11.3334C8.66658 11.7016 8.36811 12.0001 7.99992 12.0001C7.63173 12.0001 7.33325 11.7016 7.33325 11.3334V7.33343C7.33325 6.96524 7.63173 6.66677 7.99992 6.66677ZM7.99992 5.33331C7.63173 5.33331 7.33325 5.03484 7.33325 4.66665C7.33325 4.29846 7.63173 3.99998 7.99992 3.99998C8.36811 3.99998 8.66658 4.29846 8.66658 4.66665C8.66658 5.03484 8.36811 5.33331 7.99992 5.33331Z" fill="#666"></path>
                                                                                </svg>
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="top-text">
                                                                <p>Yes, you can consume it 4-5 servings.🌾🍊</p>
                                                            </div>
                                                            <div class="desclaimer-text">
                                                                <span class="desclaimer-inner">
                                                                    <span class="color-tex">Disclaimer:</span>Not medical or professional advice.
                                                                </span>
                                                            </div>
                                                            <div class="flex-bottom">
                                                                <div class="flex-brow">
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-up"></i>
                                                                        <span class="">25</span>
                                                                    </button>
                                                                    <button class="ugc-button-text">
                                                                        <i class="fa-regular fa-thumbs-down"></i>
                                                                        <span class="">7</span>
                                                                    </button>
                                                                </div>
                                                                <div class="question-button">
                                                                    
                                                                    <div class="report">
                                                                        <div class="question-abuse">
                                                                            <button class="ugc-text">Report abuse</span></button>
                                                                        </div>
                                                                        <div class="question-share">
                                                                            Share <i class="fa-solid fa-share-nodes"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="see-area">
                                                        <a href="#" class="see-more">See more answers (160) <i class="fa-solid fa-chevron-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="allSee-wrap">
                                            <div class="see-area">
                                                <a href="#" class="see-more">See all 448 questions <i class="fa-solid fa-chevron-right"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section> -->



<!-- <section class="testimonial-section product-detail-testi top-space">
    <img
        class="testimonial-vector1"
        src="{{url('public/images/testimonial-vector.png')}}"
        alt="Seller" />


    <div class="container">

    <div class="heading-section">
                        <h2 class="heading">
                            Customer Cheers<br />
                            Wellness Reviews
                        </h2>
                    </div>

        <div class="testimonial-slider">
            <div class="testimonial-col">
                <div class="testimonial-inn">
                 
                    <img
                        class="quotes-wrap"
                        src="{{url('public/images/quotes-icon.png')}}"
                        alt="Seller" />
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
                        alt="Seller" />
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
                        alt="Seller" />
                    <p>
                        I love the pure sweetness of Aayurja Honey. It’s the perfect addition to my morning tea, and it feels great to consume something so natural and unprocessed.
                    </p>
                    <div class="name">Sunita Arora</div>
                </div>
            </div>
        </div>
    </div>
</section> -->


<!-- seller -->
<section class="seller-section popular-section detail-pro detail-moreproduct">
    <img
        class="seller-vector1"
        src="{{url('public/images/popular-vector.png')}}"
        alt="Seller" />
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section">
                    <h3 class="heading">Customers also viewed</h3>
                </div>
            </div>
        </div>
        <div class="popp-slides popp-new-slides row">
            @if(count($products) > 0)
                @foreach($products as $key => $productss)
                <div class="popp-col">
                    <div class="popular-col">
                        <div class="popular-inner">
                            <div class="image-wrap">
                                <div class="image image-style">
                                <a href="{{url('product')}}/{{@$productss->slug}}"><img src="{{url('public')}}/uploads/product/{{$productss->list_image}}" alt="{{$productss->product_name}}" loading="lazy" />  </a> 
                                </div>



                                @php
                                    $productId = $productss->id; // The product ID to check.
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


                                <!-- <div class="flat-dis">
                                    <div class="flat-text">
                                        <div class="flat-dis-inner">
                                            Get flat 20% off
                                        </div>
                                        <div class="circle-text">
                                            <div class="circle-img">
                                                <img  src="{{url('public/images/card-circle.webp')}}" loading="lazy" alt="Circle">
                                                <div class="circle-content">
                                                Code
                                                <strong>AAYURJA20</strong>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                @php
                                if(Auth::check()){
                                    $wishlist = App\Wishlist::where('user_id', Auth::user()->id)->where('product_id',$productss->id)->count(); 
                                }else{
                                    $wishlist = '';
                                }
                                @endphp
                                

                                @if(Auth()->check())
                                <a href="javascript:void(0);" class="like-btn" onclick="addToWishlist({{ $productss->id }}, this)">
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
                                <h3>
                                <a href="{{url('product')}}/{{@$productss->slug}}">{{$productss->product_name}}</a>
                                </h3>
                                <!-- <div class="des">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>
 -->

                                <div class="price-wrap">
                                    <span>
                                        <strong>₹{{number_format($productss->variants_price->selling_price)}}</strong>
                                    </span>
                                    <span>
                                        <del>₹{{number_format($productss->variants_price->price)}}</del>
                                    </span>
                                    @if($productss->variants_price->discount!=0 or $productss->variants_price->discount='')  <span class="off-items">({{$productss->variants_price->discount}}% off)</span> @endif
                                </div>
                                @php
                                    $averageRating = $productss->review->isNotEmpty() ? $productss->review->avg('rating') : 0;
                                    $totalRatings = $productss->review->isNotEmpty() ? $productss->review->count() : 0;
                                @endphp
                                <div class="review-wrap">
                                    <div class="review-icon">
                                        <!-- <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i> -->
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
                                        <p>{{ $totalRatings }} ratings</p>
                                    </div>
                                </div>
                                <div class="button-wrap">
                                    @if(auth()->check())
                                        @if($productss->outofstock == 0)
                                        <button class="theme-button submitbtnbyclass" data-weight="{{$productss->variants_size->weight}}" data-quantity="1" data-productid="{{$productss->id}}" data-productname="{{$productss->product_name}}" data-sellingprice="{{number_format($productss->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$productss->list_image}}">
                                            <img src="{{url('public/images/shopping-icon.png')}}" alt="Shopping Icon" loading="lazy"/> Add to cart
                                        </button>
                                        @else
                                        <button class="theme-button" >
                                            <img src="{{url('public/images/shopping-icon.png')}}" alt="Shopping Icon" loading="lazy"/> Out Of Stock
                                        </button>
                                        @endif

                                       
                                    @else
                                   
                                        

                                        @if($productss->outofstock == 0)
                                        <a class="theme-button setPendingCart" data-toggle="modal" data-target="#loginModel" href="#" data-weight="{{$productss->variants_size->weight}}" data-quantity="1" data-productid="{{$productss->id}}" data-productname="{{$productss->product_name}}" data-sellingprice="{{number_format($productss->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$productss->list_image}}">
                                            <img src="{{url('public/images/shopping-icon.png')}}" alt="Shopping Icon" loading="lazy"/> Add to cart
                                        </a>
                                        @else
                                        <a class="theme-button" >
                                            <img src="{{url('public/images/shopping-icon.png')}}"  alt="Shopping Icon" loading="lazy"/> Out Of Stock
                                        </a>
                                        @endif
                                    @endif
                                    
                                    <!-- <a href="#" class="theme-button">
                                        <img src="{{url('public/images/shopping-icon.png')}}" /> Add to cart
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <h6>No Products Found<h6>
            @endif

            <!-- <div class="col-sm-6 col-md-6 col-lg-3">
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
            <div class="col-sm-6 col-md-6 col-lg-3">
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
            <div class="col-sm-6 col-md-6 col-lg-3">
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





        </div>
    </div>

</section>

<!---------- write review Popup ---------->

<div class="modal fade review-model" id="review_pop" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i></button>
          
            <div class="modal-body">
                <h5 id="reviewModalLabel">Write a Review</h5>
                @if (is_null($userReview))
                <form action="{{ route('save-review') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ @$product->id }}">
                    <input type="hidden" name="user_id" value="{{ @Auth::user()->id }}">
                    
                    <div class="form-field">
                        <label>Your Full Name*</label>
                        <input class="form-control" placeholder="Full name" id="user_name" type="text" name="user_name" required>
                    </div>
                    
                    <div class="form-field">
                        <label>Your Email*</label>
                        <input class="form-control" placeholder="Your Email Address" id="user_email" type="email" name="user_email" required>
                    </div>

                    <div class="form-field">
                        <label>Title*</label>
                        <input class="form-control" placeholder="Give Title" name="title" type="text" required>
                    </div>

                    <fieldset id="rating_review" class="review-rating">
                        <label>Rate This Product*</label>
                        <div class="rating__group">
                            {{-- <input type="radio" id="star1" class="rating__star" name="rating"
                            data-value="1">
                            <input type="radio" id="star2" class="rating__star" name="rating"
                            data-value="2">
                            <input type="radio" id="star3" class="rating__star" name="rating"
                            data-value="3">
                            <input type="radio" id="star4" class="rating__star" name="rating"
                            data-value="4">
                            <input type="radio" id="star5" class="rating__star" name="rating"
                            data-value="5"> --}}

                            <input type="radio" id="star1" class="rating__star" name="rating" data-value="1" required>
                            <input type="radio" id="star2" class="rating__star" name="rating" data-value="2" required>
                            <input type="radio" id="star3" class="rating__star" name="rating" data-value="3" required>
                            <input type="radio" id="star4" class="rating__star" name="rating" data-value="4" required>
                            <input type="radio" id="star5" class="rating__star" name="rating" data-value="5" required>
                        </div>
                    </fieldset>
                    <input type="hidden" name="rating" id="rating_value" value="">

                    <div class="form-field">
                        <label>Write Your Review*</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Tell us What You Like most about our Product..." required>{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="theme-button">Submit Review</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>


<input type="hidden" name="tokenInURL" id="tokenInURL" value="<?php if(isset($_GET['token'])) { echo $_GET['token']; } ?>">

 <!-------->


 <div id="myModal" class="sharepop modal">
    <div class="modal-content">
        <p id="modalMessage">URL copied to clipboard!</p>
    </div>
</div>


@include('website.footer')


<script>
    document.getElementById('Search').focus();
</script>
<script>
$(".share-inner").click(function () {
  $("body").toggleClass("share-open");
});
</script>


<script>

$(document).ready(function(){
    $(".quality-box-function").click(function(){
        $(".quality-box-function").removeClass("active");
        $(this).addClass("active");

        // $(".image-weight-mapping").hide();


        var productWeight = $(this).find('.productWeight').text();
        var productSellingPrice = $(this).find('.productSellingPrice').text();
        var productPrice = $(this).find('.productPrice').text();
        var discount = $(this).find('.discount').val();

        $("#updatedWeight").text(productWeight);
        $("#selected_weight").val(productWeight);
        $("#updatedSellingPrice").text(productSellingPrice);
        $("#oldSellingPrice").val(productSellingPrice);
        $("#updatedDiscount").text(discount);
        $(".input-qty").val(1);

        if(productPrice)
        {
            $("#updatedPrice").text(productPrice);
            $("#oldPrice").val(productPrice);
            $("#rupeeSignUptPrice").html('₹');

            var saving = productPrice - productSellingPrice;
            $("#updatedSaving").text(saving);

        }
        else
        {
            $("#updatedPrice").html('');
            $("#rupeeSignUptPrice").html('');
            $("#oldPrice").val(0);


            $("#updatedSaving").text(0);

        }

        var productId = $('[name="product_id"]').val();




        // $.ajax({
        //     url: "/get-weight-wise-images",
        //     type: "GET",
        //     data: { productWeight: productWeight, productId: productId },
        //     success: function (response) {
        //         if (response.success) {
        //             console.log(response.message);

        //             var images = response.product_image;
        //             var imageContainer = $(".main-img-slider"); // Select main slider container
        //             var thumbNav = $(".thumb-nav"); // Select thumbnail slider container

        //             // Destroy Slick before modifying
        //             imageContainer.slick('unslick');
        //             thumbNav.slick('unslick');

        //             // Clear old images
        //             imageContainer.empty();
        //             thumbNav.empty();

        //             // Append new images
        //             $.each(images, function (index, image) {
        //                 var imageUrl = "/public/" + image.url;

        //                 var newImageHtml = `
        //                     <div>
        //                         <a data-fancybox="gallery" href="${imageUrl}">
        //                             <img class="zoom-image slideshow-items active" src="${imageUrl}" alt="Product Image" loading="lazy">
        //                         </a>
        //                     </div>
        //                 `;
        //                 imageContainer.append(newImageHtml);

        //                 var thumbHtml = `<div> <div class="img-item"> <img src="${imageUrl}" alt="Product Image" loading="lazy"></div></div>`;
        //                 thumbNav.append(thumbHtml);
        //             });

        //             // Reinitialize Slick
        //             imageContainer.slick({
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1,
        //                 arrows: true,
        //                 fade: true,
        //                 asNavFor: ".thumb-nav"
        //             });

        //             thumbNav.slick({
        //                 slidesToShow: 3,
        //                 slidesToScroll: 1,
        //                 asNavFor: ".main-img-slider",
        //                 dots: false,
        //                 // centerMode: true,
        //                 focusOnSelect: true,
        //                 arrows: true,
        //                 prevArrow:
        //                 '<button class="arrow slick-prev"><i class="fa-solid fa-chevron-left"></i> </button>',
        //                 nextArrow:
        //                 '<button class="arrow slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
        //             });

        //             // Reinitialize Fancybox
        //             // $.fancybox.reinitialize();

        //         } else {
        //             console.log("No images found for this weight.");
        //         }
        //     },
        //     error: function () {
        //         console.log("Error fetching images.");
        //     }
        // });




    });



    $(".qtyWiseDataUpdate").click(function(){
        var oldPrice = $("#oldPrice").val();
        var oldSellingPrice = $("#oldSellingPrice").val();
        var updated_input_qty = $(".input-qty").val();
        
        var updatedPrice = oldPrice * updated_input_qty;
        var updatedSellingPrice = oldSellingPrice * updated_input_qty;

        var updatedSaving = updatedPrice - updatedSellingPrice;



        $("#updatedPrice").text(updatedPrice);
        $("#updatedSellingPrice").text(updatedSellingPrice);
        $('#updatedSaving').text(updatedSaving);

        
    });

});






</script>


<script>
    $(document).ready(function() {
        // Event handler for clicking on size options
        $('.getPriceUsingSize').click(function() {
            var productId = $('#product_id').val();
            var productSize = $(this).text();

            // Update the hidden input with the selected size
            $('#selected_weight').val(productSize);

            // Perform AJAX request to get price based on size
            $.ajax({
                url: "{{ url('getprice_usingsize') }}",
                type: "POST",
                data: {
                    product_id: productId,
                    product_size: productSize,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('.product_price').text('₹' + result.price);
                    $('.selling_price').text('₹' + result.selling_price);
                    $('.discount').text('(' + result.discount + '%)');
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to fetch the product price. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });

        // Event handler for form submission
        $('#submitBtn').click(function(e) {
            // alert('aa');
            e.preventDefault(); // Prevent the form from submitting initially

            var weight = $('#selected_weight').val();
            var defaultWeight = $('#default_weight').val();
            var hasSizes = $('.getPriceUsingSize').length > 0;

            // Set the value of selected_weight based on the defaultWeight
            if (weight === '' || weight === 'N/A') {
                if (defaultWeight === 'N/A') {
                    $('#selected_weight').val('N/A');
                } else {
                    $('#selected_weight').val(defaultWeight);
                }
            }

            // Check if a valid size is selected when size options are available
            if (hasSizes && (weight === '' || weight === 'N/A')) {
                toastr.error('Please select a size before adding to cart.');
            } else {
          
                // Submit the form via AJAX
                $.ajax({
                    url: "{{ url('add-to-cart') }}", // Ensure this route is correct
                    method: 'POST',
                    data: $('#addToCartForm').serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response);
                        console.log(response);

                        if (response.alert === 'error') {

                            
                            
                            var imgSrc = $('#productImageSrc').attr('src');
                            var updatedPrice = $('#updatedSellingPrice').text();
                            var productSize = $('#updatedWeight').text();
                            var productName = $('#product_name').text();

                            // var productName = $('.product_name').text();
                            $('#alert-msg h5').html(response.message);
                            $("#modal_product_img").attr("src",imgSrc);
                            $('#model_weight').html(productSize);
                            $('#modal_price').html(updatedPrice);
                            $('#total-price').html(updatedPrice);
                            $('#ProductNameDynamic').html(productName);


                            
                        
                            // $('#product_name').text(product_name);
                            // $('#modal_product_price').html(product_selling_price);


                            // $('#cartAlert').modal('show');
                            $('#successfull-popop').modal('show');


                            

                        } else if (response.alert === 'success') {
                            var imgSrc = $('#productImageSrc').attr('src');
                            var updatedPrice = $('#updatedSellingPrice').text();
                            var productSize = $('#updatedWeight').text();
                            var productName = $('#product_name').text();

                            $('#alert-msg h5').html(response.message);
                            $("#modal_product_img").attr("src",imgSrc);
                            $('#model_weight').html(productSize);
                            $('#modal_price').html(updatedPrice);
                            $('#total-price').html(updatedPrice);
                            $('#ProductNameDynamic').html(productName);

                            //UPDATE CART COUNTER
                            var currentcartCount = $("#cart_counter_id").text();
                            $("#cart_counter_id").text(parseInt(currentcartCount)+1);

                            $('#successfull-popop').modal('show');

                        }
                    },
                    error: function(xhr) {
                        //$('#cartAlert').modal('show');
                    }
                });
            }
        });

        // Function to update cart count
        function updateCartCount() {
            $.ajax({
                url: "{{ url('get-cart-count') }}", // Ensure this route is correct
                method: 'GET',
                success: function(response) {
                    if (response.cart_count !== undefined) {
                        $('.cart-count .count').text(response.cart_count);
                    }
                },
                error: function(xhr) {
                    console.error('An error occurred while fetching the cart count.');
                }
            });
        }
    });
</script>


<!-- start js for stars make dyamic -->
<script>
    $(document).ready(function() {
    $("input[name='rating']").on("change", function() {
        var selectedValue = $(this).data('value'); 
        $("#rating_value").val(selectedValue); 
        highlightStars(selectedValue);
    });
    function highlightStars(rating) {
        $("input.rating__star").each(function() {
            if ($(this).data('value') <= rating) {
                $(this).next().css("color", "gold"); 
            } else {
                $(this).next().css("color", "#ccc"); 
            }
        });
    }
});
</script>
<!-- End js for stars make dyamic -->



<script>
    $(document).ready(function() {
        var token = sessionStorage.getItem("token");
        console.log("token"+token);

        var tokenInURL = $("#tokenInURL").val();
        if (tokenInURL != '' && tokenInURL != null && tokenInURL != token) {
            window.location.href = "/";
        // console.log("aaaaaa");

        }

    });
</script>


<script>
    // Function to copy the current URL to the clipboard
    function copyURL() {
        // Get the current URL
        const currentURL = window.location.href;

        // Use the Clipboard API to copy the URL
        navigator.clipboard.writeText(currentURL).then(() => {
            // Display the modal with the success message
            document.getElementById('modalMessage').innerText = 'URL copied to clipboard!';
            openModal();
        }).catch(err => {
            // Show an error message in the modal
            document.getElementById('modalMessage').innerText = 'Failed to copy URL.';
            openModal();
            console.error('Could not copy text: ', err);
        });
    }

    // Function to open the modal
    function openModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    // Close the modal when the user clicks on the close button (x)
    document.querySelector('.close').onclick = function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    };

    // Close the modal when the user clicks anywhere outside the modal
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };


    // zoom video show 

    document.addEventListener("DOMContentLoaded", function() {
   Fancybox.bind('[data-fancybox="gallery"]', {
      // Optional settings
      buttons: ["zoom", "slideShow", "thumbs", "close"],
   });
});


</script>
