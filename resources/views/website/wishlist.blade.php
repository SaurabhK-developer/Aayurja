@include('website.header')
<style>
    body{
        background:#fff;
    }
</style>
<!-- Wishlist Banner -->
<section class="cart-banner ">
   <img src="{{url('public/images/wishlist.webp')}}" alt="Banner">
   <div class="cart-text">
      <div class="container">
         <div class="cart-inner">
            <h1 class="category-title">Wishlist</h1>
            <div class="breadcrum">
                <p><a href="/">Home</a> | </p>
                <p>Wishlist</p>
            </div>
         </div>
      </div>
   </div>
</section>
@if($isEmpty)
    <section class="empty-cart">
        <div class="container">
            <div class="empty-cart-message empty-cart-message">
               <img src="{{url('website/images/empty-wishlist.webp')}}" alt="empty wishlist" loading="lazy">
                <h2 class="text-center">Your Wishlist is Empty</h2>
                <p class="text-center">Your Wishlist is currently empty. Browse our products and save some items to your Wishlist!</p>
                <div class="collection-btn">
                  <a href="{{ url('shop') }}" class="theme-button">Start Shopping</a>
                </div>
            </div>
        </div>
    </section>
@else
<section class="wishlist-wrapper space-top">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            
            @foreach($wishlists as $key => $wishlist)
            <div class="wishlist-col">
               <div class="wishlist-inner">
                  <!-- <div class="close-icon"><i class="fa fa-times "  aria-hidden="true"></i></div> -->
                  
                  <meta name="csrf-token" content="{{ csrf_token() }}">

                  <div class="close-icon remove-inners" data-id="{{ $wishlist->product->id }}">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </div>


                  <div class="image-inner">
                     <img src="{{url('public/uploads/product')}}/{{ @$wishlist->product->list_image }}" alt="wishlist" loading="lazy">
                  </div>
                  <div class="heading-wrap">
                     <h4>{{ @$wishlist->product->product_name }}</h4>
                     <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ @$wishlist->product_variants->selling_price }}</p>
                     <div class="date">{{ @$wishlist->created_at->format('d M Y') }}</div>
                  </div>
               </div>
               <div class="wishlist-col2 wishlist-res-col2">
                  @if($wishlist->product_variants->weight !='N/A')
                  <div class="weight-wrap">
                     Weight : {{@$wishlist->product_variants->weight }} 
                  </div>
                  @endif
                  <!-- <div class="flovpur-wrap">
                     Flavour : Unflavoured
                  </div> -->
               </div>
               <div class="stock-btn stock-res-btn">
                  <span class="stock-innner">@if($wishlist->product->outofstock == 0) In Stock @else Out Of Stock @endif</span>
                  @if($wishlist->product->outofstock == 0)
                  <button class="theme-button moveToCart" data-weight="{{$wishlist->product->variants_size->weight}}" data-quantity="1" data-productid="{{$wishlist->product->id}}" data-productname="{{$wishlist->product->product_name}}" data-sellingprice="{{number_format($wishlist->product->variants_price->selling_price)}}" data-image="{{url('public')}}/uploads/product/{{$wishlist->product->list_image}}">
                  Move to Cart
                  </button>
                  @endif
               </div>
            </div>
            @endforeach

            <!-- <div class="wishlist-col">
               <div class="wishlist-inner">
                  <div class="close-icon"><i class="fa fa-times"  aria-hidden="true"></i></div>
                  <div class="image-inner">
                     <img src="{{url('public/images/popular-img1.png')}}" alt="wishlist">
                  </div>
                  <div class="heading-wrap">
                     <h1>Gucchi Mushroom Superfood: The Ultimate Natural Powerhouse for Optimal Health, Wellness, and Vitality</h1>
                     <p><i class="fa-solid fa-indian-rupee-sign"></i> 5749</p>
                     <div class="date">Aug 01, 2024</div>
                  </div>
               </div>
               <div class="wishlist-col2">
                  <div class="weight-wrap">
                     Weight : 3 KG
                  </div>
                 
               </div>
               <div class="stock-btn desable-btn">
                  <span class="stock-innner">In Stock</span>
                  <button class="theme-button" type="submit">
                  Add to Cart
                  </button>
               </div>
            </div>
            <div class="wishlist-col">
               <div class="wishlist-inner">
                  <div class="close-icon"><i class="fa fa-times" data-id="555" aria-hidden="true"></i></div>
                  <div class="image-inner">
                     <img src="{{url('public/images/popular-img1.png')}}" alt="wishlist">
                  </div>
                  <div class="heading-wrap">
                     <h1>Gucchi Mushroom Superfood: The Ultimate Natural Powerhouse for Optimal Health, Wellness, and Vitality</h1>
                     <p><i class="fa-solid fa-indian-rupee-sign"></i> 3749</p>
                     <div class="date">Aug 01, 2024</div>
                  </div>
               </div>
               <div class="wishlist-col2">
                  <div class="weight-wrap">
                     Weight : 2 KG
                  </div>
                  
               </div>
               <div class="stock-btn">
                  <span class="stock-innner">In Stock</span>
                  <button class="theme-button" type="submit">
                  Add to Cart
                  </button>
               </div>
            </div> -->
         </div>
      </div>
      <div class="coutinue-Shopping">
         <a href="/shop">Continue Shopping</a>
      </div>
   </div>
</section>
@endif

@include('website.footer')

<!-- Remove to wishlist -->
<script>
    $(document).on("click", ".remove-inners", function() {
        var product_id = $(this).data("id");
     
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            type: 'POST',
            url: '{{ route('wishlist.remove') }}', 
            data: {
                product_id: product_id,
                _token: token
            },
            success: function(data) {
                if (data.status === 200) {
                    // Remove the product card from the DOM
                  $('div[data-id="' + product_id + '"]').closest('.wishlist-col').remove();
                  //   $('#wish_count').text(data.wish_count);
                  var currentwishCount = $("#wish_counter_id").text();
                  $("#wish_counter_id").text(parseInt(currentwishCount)-1);



                } else {
                    console.log('Failed to remove from wishlist:');
                }
            },
            error: function(xhr, status, error) {
                console.log('An error occurred while removing the item from the wishlist:', xhr.responseText);
            }
        });
    });
</script>
<!--End Remove to wishlist -->

