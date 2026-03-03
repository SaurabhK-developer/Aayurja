@include('userpanel.header')




            <h3 class="heading">Recently Viewed</h3>

            <div class="user-form recent-view-wrap">
                <div class="recent-view row">

                @if($products)
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-6  col-lg-4 recent-product">
                        <div class="recent-col">
                            <div class="popular-col">
                                <div class="popular-inner">
                                    <div class="image-wrap">
                                        <div class="image image-style">
                                            <a href="#"><img src="{{url('public/userpanel/images/recent-img1.webp')}}"
                                                    alt="Product Image" />
                                            </a>
                                        </div>

                                        <a href="javascript:void(0);" class="like-btn" data-toggle="modal"
                                            data-target="#loginModel">
                                            <div class="heart-wrap">
                                                <i class="fa-solid fa-heart"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4>
                                            <a href="{{url('/product')}}/{{@$product->product_details->slug}}">{{@$product->product_details->product_name}}</a>
                                        </h4>
                                        <div class="price-wrap">
                                            <span>
                                                <strong>₹{{number_format($product->product_details->variants_price->selling_price,2)}}</strong>
                                            </span>
                                            <span>
                                                <del>₹{{number_format($product->product_details->variants_price->price,2)}}</del>
                                            </span>
                                            @if($product->product_details->variants_price->discount!=0 or $product->product_details->variants_price->discount='') <span class="off-items">({{$product->product_details->variants_price->discount}}% off)</span>@endif
                                        </div>
                                        <div class="review-wrap">
                                            <div class="review-icon">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>

                                                <i class="fa-solid fa-star"></i>

                                                <i class="fa-solid fa-star"></i>

                                                <i class="fa-solid fa-star-half-alt"></i>
                                            </div>
                                            <div class="review-txt">
                                                <p>107 ratings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                    
                    <div class="col-md-12">
                        <div class="view-all">
                            <a href="javascript:void(0)" id="viewMore" class="theme-button"> View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>



@include('userpanel.footer')


<script>
$(document).ready(function() {
    $(".recent-product").slice(0, 8).show();
    $("#viewMore").on("click", function(e) {
        e.preventDefault();
        $(".recent-product:hidden").slice(0, 4).slideDown();


    });
})
</script>