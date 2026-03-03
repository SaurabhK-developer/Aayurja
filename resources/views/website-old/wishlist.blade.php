@include('website.header')
<section class="about-banner banner-area ">
   <img src="{{url('website/images/wishlist-image.png')}}">
   <div class="container">
      <div class="content-wrap">
         <h1 class="banner-title">Wishlist</h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"> <a href="/wishlist">Wishlist</a> </li>
            </ol>
         </nav>
      </div>
   </div>
</section>
<section class="wishlist-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
		 @if(count($wishlists) > 0)
            @foreach($wishlists as $wishlist)
            <div class="wishlist-col product_card_{{ $wishlist->product_id }}">
               <div class="wishlist-inner">
                  <div class="close-icon"><i class="fa fa-times remove-inners" data-id="{{ $wishlist->product_id }}" aria-hidden="true"></i></div>
                  <div class="image-inner">
                     <img src="{{url('public')}}/{{$wishlist->product->firstimage->url}}">
                  </div>
                  <div class="heading-wrap">
                     <h1>{{$wishlist->product->product_name}}</h1>
                     <p>INR {{$wishlist->product->product_variants[0]->selling_price}}</p>
                     <div class="date">{{date('M d, Y', strtotime($wishlist->created_at))}}</div>
                  </div>
               </div>
               <div class="wishlist-col2">
                  <div class="weight-wrap">
                     Weight :  {{$wishlist->product_weight->size}}
                  </div>
                  <div class="flovpur-wrap">
                     Flavour :  {{$wishlist->flavour}}
                  </div>
               </div>
               <div class="stock-btn">
                  <span class="stock-innner">In Stock</span>
                  <form method="POST" action="{{url('/add-to-cart')}}">
                  @csrf
                  <input type="hidden" name="flavour[]" value="{{$wishlist->flavour}}">
                  <input type="hidden" name="weight[]" value="{{$wishlist->weight}}">
                  <input type="hidden" name="sell_price" value="{{$wishlist->product->product_variants[0]->selling_price}}">
                  <input type="hidden" name="quantity[]" value="{{ $wishlist->chosenqty }}">
                  <input type="hidden" name="product_id" value="{{ $wishlist->product_id }}">
                  <button class="cart-btn theme-btn-custom" type="submit">
                  Add to Cart
                  </button>
</form>
               </div>
            </div>
            @endforeach
		@else
			<!--<div class="add-card-wrapper">
		  <div class="add-error-wrap">
<div class="empty__image">
<div class="image-wraps">
 <img src="{{url('website/images/cart_empty.gif')}}">
</div>
</div>
<div class="content-wraps">
<h1 class="empty__title">OH NO!</h1>
<div class="empty__text">Hit a little plateau? Don’t worry, our products are here to help you lift off!</div>
<a href="/" class="shop-btn theme-btn-custom">Shop Just Go Nutrition</a>
</div>
  
  </div>	
 </div>-->
 
 	<div class="add-card-wrapper wishlist-error">
		  <div class="add-error-wrap">



<h1 class="empty__title">OH NO!</h1>
<div class="empty__text">Your wishlist is empty !</div>



  
  </div>	
 </div>
 
		@endif
			    
			   
			
			
            </div>
         </div>
		 
		 
		 
		 
		  <div class="coutinue-Shopping">
	  
	  <a href="#">Continue Shopping</a>
	  </div>
      </div>
	  
	 
	  
   </div>
</section>
@include('website.footer')
<script>
   $(document).on("click", ".remove-inners", function() {
   var product_id = $(this).data("id");
   var token = $("meta[name='csrf-token']").attr("content");
   $.ajax({
      type: 'POST',
      url: '{{ url('remove-to-wish') }}',
      data: {
         product_id: product_id,
         _token: "{{ csrf_token() }}"
      },
      success: function(data) {
         $(".product_card_"+product_id).remove()
         // $(".remove-wish-" + product_id).addClass('inners');
         // $(".remove-wish-" + product_id).addClass('add-wish-' + product_id);
         // $(".remove-wish-" + product_id).removeClass('remove-inners');
         // $('#wishlistcount').text(data.wish_count);
         // $('#wishlistcount').show();
         $('#wish-count').html(data.wish_count);
      }
   });
});
</script>