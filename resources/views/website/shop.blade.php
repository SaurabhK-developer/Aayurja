@include('website.header')
<style>
 .product-item {
 opacity: 0;
    transition: opacity 0.6s ease, transform 0.6s ease;
    transform: translateY(20px);
}

.product-item.visible  {
  opacity: 1;
    transform: translateY(0);
}
</style>
<!-- blog Banner -->
<section class="contact-banner ">
    <img src="{{url('public/images/product-banner.webp')}}" alt="Banner">
    <div class="product-breadcrumb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="sub-header-content">
                    <label>Shop</label>
                    <div class="page-breadcrum">
                      <p><a href="{{url('/')}}">Home | </a>   </p>
                      <p class="last-text">Shop</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<div class="responsiveUsp ">
    <div class="responsiveUsp_slider container">
        <div class="row">
            <div class="col-12  col-sm-6 col-md-6 col-lg-3">
                <div class="responsiveUsp_link ">
                    <a href="#" class="responsiveUsp_clickable">
                        <div class="responsiveUsp_icon">
                            <img src="{{url('public/images/alarm-icon.webp')}}" alt="Alarm" />
                        </div>
                        <b>2 Hours Delivery</b>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="responsiveUsp_link">
                    <a href="#" class="responsiveUsp_clickable">
                        <div class="responsiveUsp_icon">
                            <img src="{{url('public/images/shipping-icon.webp')}}" alt="Alarm" />
                        </div>
                        <b>Free Shipping </b>
                    </a>
                </div>
            </div>
            <div class="col-12  col-sm-6 col-md-6 col-lg-3">
                <div class="responsiveUsp_link">
                    <a href="#" class="responsiveUsp_clickable">
                        <div class="responsiveUsp_icon">
                            <img src="{{url('public/images/gifts-icon.webp')}}" alt="Alarm" />
                        </div>
                        <b> 90 Thousand + Gifts</b>
                    </a>
                </div>
            </div>
            <div class="col-12  col-sm-6 col-md-6 col-lg-3">
                <div class="responsiveUsp_link">
                    <a href="#" class="responsiveUsp_clickable last-clickable">
                        <div class="responsiveUsp_icon">
                            <img src="{{url('public/images/smiley.webp')}}" alt="Alarm" />
                        </div>
                        <b> 8 Million Happy Customers</b>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product-listing-wrap top-space">
    <img src="{{url('public/images/popular-vector.png')}}" class="plisting-vector" alt="Vector" loading="lazy">
    <img src="{{url('public/images/award-vector.png')}}" class="plisting-vector"  alt="Vector" loading="lazy">
    <img src="{{url('public/images/blog-vector.png')}}" class="plisting-vector"  alt="Vector" loading="lazy">

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3">
                <div class="listing-image">
                    <div class="listing-sidebar ">
                        <h3 id="filters_click">Filter</h3>
                        <div class="product-accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-head" id="headingOne">
                                <a href="#" class="heading-item" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Price
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                        <div class="wrapper">
                                        <div class="slider">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <div class="range-input">
                                                    <input type="range" class="range-min slider" min="{{$minproductCost}}" max="{{$maxproductCost}}" value="<?php if (!empty($_GET['minprice'])) { echo $_GET['minprice']; } else { echo $minproductCost; } ?>" step="10" id="lower">
                                                    <input type="range" class="range-max slider" min="{{$minproductCost}}" max="{{$maxproductCost}}" value="<?php if (!empty($_GET['maxprice'])) { echo $_GET['maxprice']; } else { echo $maxproductCost; } ?>" step="10" id="upper">
                                            </div>
                                        </div>
                                        <div class="price-input">
                                            <div class="field">
                                                    <span><i class="fa-solid fa-indian-rupee-sign"></i></span>
                                                    <input type="number" class="input-min" value="<?php if(!empty($_GET['minprice'])) { echo $_GET['minprice']; } else { echo $minproductCost; } ?>">
                                            </div>
                                            <div class="separator"> to </div>
                                            <div class="field">
                                                    <span><i class="fa-solid fa-indian-rupee-sign"></i></span>
                                                    <input type="number" class="input-max" value="<?php if(!empty($_GET['maxprice'])) { echo $_GET['maxprice']; } else { echo $maxproductCost; } ?>">
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>


                            <div class="card">
                                <div class="card-head" id="headingTwo">
                                    <a class="heading-item " data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Product Category
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="discount-check single-click-filter">

                                            @if($Product_category_list->isNotEmpty())
                                            <div class="form-check">
                                            <a href="{{url('shop')}}"><label class="form-check-label" for="all">All</label></a>
                                            </div>
                                            @foreach($Product_category_list as $key=> $Products)
                                            <div class="form-check">
                                                <?php
                                                if (!empty($_GET['category']) && $_GET['category'] != null && $_GET['category'] != '') {
                                                    $arrCat = explode('=', $_GET['category']);
                                                    $arrCat2 = implode($arrCat);
                                                    $arrCat3 = explode(',', $arrCat2);
                                                    // print_r($arrCat3);
                                                }
                                                ?>
                                                <!-- <input type="checkbox" id="{{$Products->name}}"  name="category[]" value="{{$Products->id}}" class="form-check-input" @if(!empty($_GET['category']) && in_array($Products->id, $arrCat3)) checked @endif> -->
                                                <a href="{{url('shop')}}/{{$Products->slug}}"><label class="form-check-label" for="{{$Products->name}}">{{$Products->name}}</label></a>
                                            </div>
                                            @endforeach
                                            @endif

                                            {{-- <div class="form-check">
                                                <input type="checkbox" id="Pickles" name="category[]" value="3" class="form-check-input">
                                                <label class="form-check-label" for="Honey">Honey</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Chutney" name="category[]" value="4" class="form-check-input">
                                                <label class="form-check-label" for="Kesar">Kesar</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Juices" name="category[]" value="11" class="form-check-input">
                                                <label class="form-check-label" for="Shilajit">Shilajit</label>
                                            </div> --}}


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-head" id="headingThree">
                                    <a class="heading-item" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Shop By Concern
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="discount-check single-click-filter">
                                            @if(isset($concerns) && $concerns->isNotEmpty()) 
                                                <div class="form-check">
                                                    <a href="{{ url('shop') }}">
                                                        <label class="form-check-label">All</label>
                                                    </a>
                                                </div>
                                                @foreach($concerns as $concern)
                                                    <div class="form-check">
                                                        <a href="{{ url('shop/shop-by-concern/'.$concern->slug) }}{{ request()->getQueryString() ? '?'.request()->getQueryString() : '' }}">
                                                            <label class="form-check-label">{{ $concern->title }}</label>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="card">
                                <div class="card-head" id="headingFour">
                                    <a class="heading-item" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        weight
                                    </a>
                                </div>
                                <div id="collapseFour" class="collapse " aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="discount-check">
                                            @if($product_variantss->isNotEmpty())
                                            @foreach($product_variantss as $key => $weights)
                                            <div class="form-check">
                                                <?php
                                                if (!empty($_GET['weight']) && $_GET['weight'] != null && $_GET['weight'] != '') {
                                                    $arrCat = explode('=', $_GET['weight']);
                                                    $arrCat2 = implode($arrCat);
                                                    $arrCat3 = explode(',', $arrCat2);
                                                    // print_r($arrCat3);
                                                    // echo $weights->weight;

                                                }
                                                ?>
                                                <input type="checkbox" id="{{$weights->weight}}"  name="weight[]" value="{{$weights->weight}}" class="form-check-input" @if(!empty($_GET['weight']) && in_array($weights->weight, $arrCat3)) checked @endif>
                                                <label class="form-check-label" for="{{$weights->weight}}">{{$weights->weight}}</label>
                                                  
                                            </div>
                                            @endforeach
                                            @endif

                                            {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Fondant Cake (44)" name="goal[]" value="5">
                                                <label class="form-check-label" for="100g">
                                                    100g
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Photo Cake (21)" name="goal[]" value="8">
                                                <label class="form-check-label" for="200g">
                                                    200g
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Dry Cake (10)" name="goal[]" value="9">
                                                <label class="form-check-label" for="500g">
                                                    500g
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Designer Cake (09)" name="goal[]" value="10">
                                                <label class="form-check-label" for="750g">
                                                    750g
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Pinata Cake (34)" name="goal[]" value="11">
                                                <label class="form-check-label" for="1Kg">
                                                    1Kg
                                                </label>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-head" id="headingFive">
                                    <a class="heading-item" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Discount
                                    </a>
                                </div>
                                <div id="collapseFive" class="collapse " aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php 
                                            if(!empty($_GET['discountid']) && $_GET['discountid'] != null && $_GET['discountid'] != '')
                                            {
                                                $arrDiscount = explode('=', $_GET['discountid']);
                                                $arrDiscount2 = implode($arrDiscount);
                                                $arrDiscount3 = explode(',', $arrDiscount2);
                                                // print_r($arrDiscount3);
                                            }
                                            
                                        ?>
                                        <div class="discount-check">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="1" name="discount[]" value="20" min="10" max="20" @if(!empty($_GET['discountid']) && in_array(1, $arrDiscount3)) checked @endif >
                                                <label class="form-check-label" for="10%-20%">10%-20%</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="2" name="discount[]" value="30" min="21" max="30" @if(!empty($_GET['discountid']) && in_array(2, $arrDiscount3)) checked @endif>
                                                <label class="form-check-label" for="20%-30%">21%-30%</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="3" name="discount[]" value="55" min="31" max="55" @if(!empty($_GET['discountid']) && in_array(3, $arrDiscount3)) checked @endif>
                                                <label class="form-check-label" for="30%-55%">31%-55%</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="4" name="discount[]" value="75" min="56" max="75" @if(!empty($_GET['discountid']) && in_array(4, $arrDiscount3)) checked @endif>
                                                <label class="form-check-label" for="55%-75%">56%-75%</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="5" name="discount[]" value="80" min="76" max="80" @if(!empty($_GET['discountid']) && in_array(5, $arrDiscount3)) checked @endif>
                                                <label class="form-check-label" for="75%-80%">76%-80%</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-9">
                <div class="listing-content">
                    <div class="online-main">
                        <div class="online-sec">
                            <div class="online-text">
                                <!-- <h1>Buy Superfood Online</h1> -->
                                <h1>@if(@$shop_page_title || @$shop_page_title_concern) 
                                        {{@$shop_page_title}} 

                                        @if(@$shop_page_title_concern)
                                            {{@$shop_page_title_concern}}
                                        @endif
                                    @else 
                                        Buy Superfood Online 
                                    @endif</h1>
                            </div>
                            <!-- <div class="online-review">
                                <a>{{@number_format($avgAllReviews, 1)}} <i class="fa-regular fa-star fa-fw"></i> </a>
                            </div> -->
                            <!-- <div class="review-sec">
                                <select>
                                    <option value="5668 Reviews">
                                        5668 Reviews
                                    </option>
                                    <option value="5668 Reviews">
                                        5668 Reviews
                                    </option>
                                    <option value="5668 Reviews">
                                        5668 Reviews
                                    </option>
                                </select>
                            </div> -->
                            <!-- <div class="review-sec">
                                {{@$countAllReviews}} Reviews
                            </div> -->
                            <!-- <div class="blank-border">
                            </div> -->
                            <div class="gift-text">
                                <p>{{@count($products)}} of {{@$totalProducts}} Products</p>
                            </div>
                        </div>
                        <!-- <div class="online-bottom">
                            <span>Sort by:</span>
                            <button class="btn-wraps active">
                                Recommended
                            </button>
                            <button class="btn-wraps">
                                New
                            </button>
                            <button class="btn-wraps">
                                Price: Low to High
                            </button>
                            <button class="btn-wraps">
                                Price: High to Low
                            </button>
                        </div> -->

                        <div class="online-bottom">
                            <span>Sort by:</span>
                            <button value="relevance" name="sortby" onclick="sortByFilter(this.value)"  @if(!empty($_GET['sortby']) && $_GET['sortby']=="relevance" ) class="btn-wraps active" @else  class="btn-wraps" @endif>
                                Recommended
                            </button>
                            <button value="newest" name="sortby" onclick="sortByFilter(this.value)"  @if(!empty($_GET['sortby']) && $_GET['sortby']=="newest" ) class="btn-wraps active" @else  class="btn-wraps" @endif>
                            Newest
                            </button>
                            <button value="low_to_high"  name="sortby" onclick="sortByFilter(this.value)"   @if(!empty($_GET['sortby']) && $_GET['sortby']=="low_to_high" ) class="btn-wraps active" @else  class="btn-wraps" @endif>
                                Price: Low to High
                            </button>
                            <button   name="sortby"  value="high_to_low" onclick="sortByFilter(this.value)"   @if(!empty($_GET['sortby']) && $_GET['sortby']=="high_to_low" ) class="btn-wraps active" @else  class="btn-wraps" @endif>
                                Price: High to Low
                            </button>
                        </div>
                    </div>


                    <div class="Bestsellers  popular-section  product-listing-wrap2" id="product-list">
                        <div class="row " id="productContainer">

                        @if(count($products) > 0)
                        @foreach($products as $key => $product)
                            <div class="col-sm-6 col-md-6 col-lg-4 product-item">
                                <div class="popular-col">
                                    <div class="popular-inner">
                                        <div class="image-wrap">
                                            <div class="image image-style">
                                            <a href="{{url('product')}}/{{@$product->slug}}"><img src="{{url('public')}}/uploads/product/{{$product->list_image}}" alt="{{$product->product_name}}" loading="lazy"/>  </a>  
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
                                                                Get flat {{ceil($coupon->discount_percentage)}}% off
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

                                            <h3>
                                                <a href="{{url('product')}}/{{@$product->slug}}">{{$product->product_name}}</a>
                                            </h3>

                                            <!-- <div class="des" >Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div> -->

                                            <div class="prodetail-brief">
                                                {{$product->short_description}}
                                            </div>

                                            <div class="price-wrap">
                                                <span>
                                                    <i class="strong-tag">₹{{number_format($product->variants_price->selling_price)}}</i>
                                                </span>
                                                @if($product->variants_price->selling_price != $product->variants_price->price)
                                                <span>
                                                    <del>₹{{number_format($product->variants_price->price)}}</del>
                                                </span>
                                                @endif
                                                @if($product->variants_price->discount!=0 or $product->variants_price->discount='')  <span class="off-items">({{$product->variants_price->discount}}% off)</span> @endif
                                                <!-- <span class="off-items">10% off</span> -->
                                            </div>
                                            @php
                                            
                                            $averageRating = $product->review->avg('rating') ?? 0; // Calculate average rating
                                            $filledStars = floor($averageRating); // Full stars
                                            $halfStar = ($averageRating - $filledStars) >= 0.5 ? 1 : 0; // Half star if applicable
                                            $emptyStars = 5 - ($filledStars + $halfStar); // Empty stars
                                            $totalRatings = $product->review->count(); // Total number of ratings
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
                                            @if(Auth::check())
                                                @if($product->outofstock == 0)
                                                    <div class="button-wrap submitbtnbyclass" data-weight="{{$product->variants_size->weight}}" data-quantity="1" data-productid="{{$product->id}}" data-productname="{{$product->product_name}}" data-sellingprice="{{number_format($product->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$product->list_image}}">
                                                        <a class="theme-button" >
                                                            <img src="{{url('public/images/shopping-icon.png')}}" alt="shopping" loading="lazy"/> Add to cart
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button-wrap">
                                                        <a class="theme-button" >
                                                            <img src="{{url('public/images/shopping-icon.png')}}"  alt="shopping" loading="lazy" /> Out Of Stock
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
                                                        <a class="theme-button setPendingCart" data-toggle="modal" data-target="#loginModel" href="#" data-weight="{{$product->variants_size->weight}}" data-quantity="1" data-productid="{{$product->id}}" data-productname="{{$product->product_name}}" data-sellingprice="{{number_format($product->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$product->list_image}}">
                                                            <img src="{{url('public/images/shopping-icon.png')}}"  alt="shopping" loading="lazy"  /> Add to cart
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="button-wrap">
                                                        <a class="theme-button" >
                                                            <img src="{{url('public/images/shopping-icon.png')}}"  alt="shopping" loading="lazy" /> Out Of Stock
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


                            <!-- <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-6 col-lg-4">

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
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                        </div>
                    </div>
                    
                    <!-- <div class="pagination">
                        <ul>
                            <li class="btn prev">
                                <span>
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                            </li>
                            <li class="first numb"><span>1</span></li>
                            <li class="numb  "><span>2</span></li>
                            <li class="numb active"><span>3</span></li>
                            <li class="numb "><span>4</span></li>
                            <li class="btn next active"><span>
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </li>
                        </ul>
                    </div> -->
                    <div class="row">
                        
                    @if(count($products) > 6)
                    <!-- <div class="col-lg-12 text-center">
                        <a id="loadMore" class="theme-button">load more</a>
                        <a id="loadLess" class="theme-button">load less</a>
                    </div> -->
                    @endif
                    </div>
                    
                </div>
            </div>

            @if(@$shop_page_desc || @$shop_page_desc_concern)
            <div class="col-lg-12">
                <div class="shopcateg-descrip">
                    @if(@$shop_page_desc || @$shop_page_desc_concern) 
                        {!!@$shop_page_desc!!} 

                        @if(@$shop_page_desc_concern)
                            {!!@$shop_page_desc_concern!!}
                        @endif
                    @endif
                </div>
            </div>
            @endif

            @if(Request::url() == 'https://www.aayurja.com/shop')
                <div class="col-lg-12">
                <div class="shopcateg-descrip">
                    <p>Welcome to Aayurja, your destination to buy holistic superfoods online that are not just natural but also backed by science! In today’s fast-paced world, maintaining your health and well-being is more important than ever. That’s why our mission is to offer you the finest organic products, thoughtfully curated to help you thrive and feel your best.</p>

                    <p>Explore our fantastic selection of premium goods, including organic honey, Shilajit, Gucchi mushrooms, and Kesar. Each of these superfoods is derived from nature's abundant richness, providing you with the best that Mother Earth has to offer. We understand how difficult it can be to find healthy solutions amidst the chaos, so we've done the work for you. Every item has been carefully selected to ensure that it fulfills our high-quality and purity requirements, allowing you to confidently invest in your health.</p>

                    <p>At Aayurja, we firmly believe in the ability of natural substances to promote a better lifestyle. Whether you want to enhance your energy, strengthen your immune system, or simply enjoy the rich flavours of nature, we have something special for you. Our products are designed to nourish your body and uplift your spirit.</p>

                    <p>We invite you to join us on a journey to rediscover the ancient wisdom of holistic wellness, enhanced by modern scientific research. It's time to embrace a lifestyle that celebrates nature’s goodness. Browse through our carefully curated collection today, and experience the transformative power of nature in every bite. We’re excited to accompany you on your path to better health and well-being with our exceptional superfoods!</p>
                </div>
            </div>
            @endif    

        </div>
    </div>
</section>

<!------>

<div class="enq-model">
    <span>Flat 20% OFF <img src="{{url('public/images/vector-icons.png')}}" alt="Vector" loading="lazy"> </span>
</div>

<div class="FreeShippingBanner-banner-expanded">
    <button class="close-icon"> <i class="fa-solid fa-xmark"></i> </button>
    <div class="FreeShippingBanner-first-row row">
        <div class="FreeShippingBanner-description col-sm-6">
            <div class="FreeShippingBanner-pre-header">Avail Flat</div>
            <div class=" FreeShippingBanner-header FreeShippingBanner-header-primary"> <i class="fa-solid fa-indian-rupee-sign"></i> 20% OFF</div>
            <div class="FreeShippingBanner-pre-header"> on Gucchi Mushrooms</div>
            <div class=" FreeShippingBanner-header FreeShippingBanner-header-secondary"></div>
        </div>
        <div class="FreeShippingBanner-image col-sm-6">
            <img draggable="false" class="FreeShippingBanner-imageContent" src="{{url('public/images/mynthra-image.webp')}}" alt="Banner Image">
        </div>
    </div>
    <div class="FreeShippingBanner-second-row">
        <div class="FreeShippingBanner-coupon">
            <div><span class="FreeShippingBanner-text">Coupon Code:</span><span class="FreeShippingBanner-code">AAYURJA20</span></div>
            <div class="FreeShippingBanner-footer"> Applicable on  Gucchi Mushrooms only.</div>
        </div>
        <div class="FreeShippingBanner-signup">
            <a class="FreeShippingBanner-button" href="{{url('/shop/gucchi-mushroom')}}">
                <div class="FreeShippingBanner-text theme-button"> Shop Now</div>
            </a>
        </div>
    </div>
    <div class="FreeShippingBanner-trust-builders">
        <div class="FreeShippingBanner-item">
            <img src="{{url('public/images/product-icon.png')}}" class="FreeShippingBanner-icon" alt="Product" loading="lazy">
            <span class="FreeShippingBanner-text">Genuine Products</span>
        </div>

        <div class="border-wrap">

        </div>

        <div class="FreeShippingBanner-item">
            <img src="{{url('public/images/return-icon.png')}}" class="FreeShippingBanner-icon" alt="Return" loading="lazy">
            <span class="FreeShippingBanner-text">Try &amp; Buy</span>
        </div>


        <div class="border-wrap">

        </div>
        <div class="FreeShippingBanner-item">
            <img src="{{url('public/images/payment-icon.png')}}" class="FreeShippingBanner-icon" alt="Payment" loading="lazy">
            <span class="FreeShippingBanner-text">Easy Exchanges &amp; Returns</span>
        </div>
    </div>
</div>


@include('website.footer')
<script>
document.addEventListener("DOMContentLoaded", function () {
  const items = document.querySelectorAll(".product-item");
  const initialVisibleCount = 12;
  
  // Initially hide all items beyond 12
  items.forEach((item, i) => {
    if (i < initialVisibleCount) {
      item.classList.add("visible");
    } else {
      item.classList.remove("visible");
    }
  });

  function checkVisibility() {
    const pageTop = window.scrollY;
    const pageBottom = pageTop + window.innerHeight;

    for (let i = 0; i < items.length; i++) {
      const item = items[i];
      const itemTop = item.getBoundingClientRect().top + window.scrollY;

      // Only check items not visible yet
      if (!item.classList.contains("visible")) {
        if (itemTop < pageBottom) {
          item.classList.add("visible");
        }
      }
    }
  }

  window.addEventListener("scroll", checkVisibility);
});

</script>
<script>
//     $(document).ready(function(){
//   $("#loadLess").hide();
//   $(".product-item").slice(0,6).show();

//   $("#loadMore").click(function(e){
//     e.preventDefault();

//     $(".product-item:hidden").slice(0,3).fadeIn("slow");

//     if($(".product-item:hidden").length == 0){
//       $("#loadMore").hide();
//       $("#loadLess").show();
//     }
//   });

//   $("#loadLess").click(function(e){
//     $(".product-item").hide();
//     $(".product-item").slice(0,6).show();
//     $("#loadMore").show();
//     $("#loadLess").hide();
//   });
// });



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


<!---sorting-->

<script>
    function sortByFilter(filter) {
       const urlParams = new URLSearchParams(window.location.search);
       urlParams.set('sortby', filter);
       window.location.search = urlParams;
       // updateQueryStringParameter(urlParams,'sortby',filter)
    }
 </script>
 
 <!----category--->
 <script>
    $(document).ready(function() {

       //CATEGORY FILTER START
       $('input[name="category[]"]').click(function(e) {
       const urlParams = new URLSearchParams(window.location.search);

 
          var category = '',
             tempCatArray = [];
 
 
          $('input[name="category[]"]:checked').each(function() {
             tempCatArray.push($(this).val());
 
          })
          if (tempCatArray.length !== 0) {
             category += tempCatArray.toString();
             console.log(category);
 
             //ENCRYPT DATA START
             category = btoa(category);
             //ENCRYPT DATA END
 
             urlParams.set('category', category);
             tempCatArray = [];
             window.location.search = urlParams;
          } else {
             urlParams.delete('category');
             window.location.search = urlParams;
          }
       });
       //CATEGORY FILTER END





        //WEIGHT FILTER START 
       $('input[name="weight[]"]').click(function(e) {
        const urlParams = new URLSearchParams(window.location.search);
 
            var weight = '',
                tempCatArray = [];


            $('input[name="weight[]"]:checked').each(function() {
                tempCatArray.push($(this).val());

            })
            if (tempCatArray.length !== 0) {
                weight += tempCatArray.toString();
                console.log(weight);

                //ENCRYPT DATA START
             weight = btoa(weight);
                //ENCRYPT DATA END

                urlParams.set('weight', weight);
                tempCatArray = [];
                window.location.search = urlParams;
            } else {
                urlParams.delete('weight');
                window.location.search = urlParams;
            }
        });
        //WEIGHT FILTER START
    });



    //DISCOUNT FILTER START
    $('input[name="discount[]"]').click(function (e) {
       const urlParams = new URLSearchParams(window.location.search);

        var discount = '', tempDiscountArray = [], tempMaxArray = [], tempMinArray = [], tempDiscountId = [];
        
        $('input[name="discount[]"]:checked').each(function(){
            // tempAreaArray.push($(this).val());
            tempMinArray.push($(this).attr('min'));
            tempMaxArray.push($(this).attr('max'));
            tempDiscountId.push($(this).attr('id'));
            
        })
        
        if(tempMinArray.length !== 0){
                var mindiscount = tempMinArray[0];
                var arrayLength = tempMaxArray.length;
                var maxdiscount = tempMaxArray[arrayLength-1];
                var discountid = tempDiscountId.toString();
        
                //ENCRYPT DATA START
                mindiscount = btoa(mindiscount);
                maxdiscount = btoa(maxdiscount);
                discountid = btoa(discountid);
                //ENCRYPT DATA END
            
                urlParams.set('mindiscount', mindiscount);
                urlParams.set('maxdiscount', maxdiscount);
                urlParams.set('discountid', discountid);
                window.location.search = urlParams;
        }
        else
        {
            urlParams.delete('mindiscount');
            urlParams.delete('maxdiscount');
            urlParams.delete('discountid');
            window.location.search = urlParams;
        }
        
        

    });
    //DISCOUNT FILTER END
</script>



<script>
   $(".slider").change(function() {
      // $("#slider-range").slider('values',0,$(this).val());
      var lowerSlider = document.getElementById('lower').value;
      var upperSlider = document.getElementById('upper').value;
      console.log('min value: ' + lowerSlider + 'Max Value' + upperSlider);

      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set('minprice', btoa(lowerSlider));
      urlParams.set('maxprice', btoa(upperSlider));
      window.location.search = urlParams;
   });
</script>


