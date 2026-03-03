@include('website.header')
      <section class="banner-section banner-area">
         <div class="box">
            <div class="slider-nav">
               <div class="slide-btn"><span>
                  <img src="{{url('website/images/banner-1.webp')}}">
                  </span>
               </div>
               <div class="slide-btn"><span>
                  <img src="{{url('website/images/banner-2.webp')}}">
                  </span>
               </div>
               <div class="slide-btn"><span>
                  <img src="{{url('website/images/banner-3.webp')}}">
                  </span>
               </div>
               <div class="slide-btn"><span>
                  <img src="{{url('website/images/banner-4.webp')}}">
                  </span>
               </div>
               <div class="slide-btn"><span>
                  <img src="{{url('website/images/banner-5.webp')}}">
                  </span>
               </div>
               <div class="slide-btn"><span>
                  <img src="{{url('website/images/banner-6.webp')}}">
                  </span>
               </div>
            </div>
            <div class="slider-dots-box"></div>
         </div>
      </section>
      <!-- <section class="banner-bottom-wrap">
         <div class="container">
            <div class="banner-slider">
               <div class="banner-item">
                  <div class="banner-col">
                     <a href="{{url('product?category=Mw%3D%3D')}}">
                        <img src="{{url('website/images/banner-left.png')}}">
                     </a>
                  </div>
               </div>
               <div class="banner-item">
                  <div class="banner-col">
                     <a href="{{url('product')}}">
                        <img src="{{url('website/images/banner-right.png')}}">
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section> -->
      <section class="best-seller-wrapper">
         <div class="container">
            <div class="product_heading">
               <h1 class="text-center">Just Go's Best-Selling Fuels</h1>
            </div>
            <div class="product_wrapper">
               <div class="wrapper">
                  <div class="my-slider">
                  @if(isset($product))
                  @foreach($product as  $products) 
                     <div>
                        <div class="product-wrap">
                           <div class="image-wrap">
						   <a  href="{{url('product')}}/{{$products->slug}}" >
						   <img src="{{url('public')}}/{{$products->firstimage->url}}">
						   </a>
                           
                           </div>
                          <!-- <div class="wishlist">
                              <a href="#">
                              <i class="fa fa-heart-o"></i>
                              </a>
                           </div>-->
                           @if($products->on_sale=='1')
                        <div class="sale-wrap">
                           <span>Sale</span>
                        </div>
                        @endif
                           <div class="content-wrap">
                              <h2>{{$products->product_name}}</h2>
                              <div class="des" >{{$products->variants_price->product_weight->size}}
                               </div>
                              <div class="price-wrap">
                                 <div class="des">  @if($products->flavours!=''){{$products->flavours->flavour}} @else Unflavoured @endif</div>
                                 <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <span>(148)</span>
                                 </div>
                              </div>
                              <div class="price-wrap">
                                 <div class="product-price">INR <span><del> {{$products->variants_price->price}}</del></span> <span><strong>{{$products->variants_price->selling_price}}</strong>{{$products->variants_price->discount}}% off</span> </div>
                                 {{-- <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <span>(148)</span>
                                 </div> --}}
                              </div>
                              <div class="buy-section">

                              <a  class="buy-wrap" href="{{url('product')}}/{{$products->slug}}">
                                 Buy Now <i class="fas fa-arrow-right"></i>
								     </a>
                                
                                 <div class="cart-wrap">
                                    <img src="{{url('website/images/cart.png')}}">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
                     @endif
                  </div>
               </div>
               <div class="product-btn">
                  <a href="{{url('/product')}}" class="theme-btn">
                  View All <i class="fas fa-arrow-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </section>
      <section class="workout-section">
         <div class="row">
            <div class=" col-sm-6 col-md-7">
               <div class="img1">
                  <img src="{{url('website/images/img1.png')}}">
               </div>
            </div>
            <div class=" col-sm-6 col-md-5">
               <div class="img2">
                  <div class="top-img1">
                     <img src="{{url('website/images/img2.webp')}}">
                  </div>
                  <div class="heading-area">
                     <h3>Your Ultimate Running Companion - <br>Unleash the Beast   </h3>
                  </div>
                  <div class="content-area">
                     <p>Workout</p>
                  </div>
                  <div class="collection-btn">
                     <a href="{{url('/product')}}" class="theme-btn2 theme-btn-custom">
                     Shop Collection  <i class="fas fa-arrow-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="best-seller-wrapper  best-seller-wrapper2   ">
         <div class="container">
            <div class="product_heading">
               <h1 class="text-center">Explore Our Fresh Arrivals </h1>
            </div>
            <div class="product_wrapper">
               <div class="wrapper">
                  <div class="my-slider2">
                  @if(isset($product))
                  @foreach($product as  $products) 
                     <div>
                        <div class="product-wrap">
                           <!-- <div class="wishlist">
                              <a href="#">
                              <i class="fa fa-heart-o"></i>
                              </a>
                           </div> -->
                           <div class="image-wrap">
                              <a href="{{url('product')}}/{{$products->slug}}">
                                    <img src="{{url('public')}}/{{$products->firstimage->url}}">
                              </a>
                    
                           </div>
                           <div class="sale-wrap">
                           <span>Sale</span>
                        </div>
                           <div class="content-wrap">
                           <h2>{{$products->product_name}}</h2>
                              <div class="price-wrap">
                                 <div class="product-price">INR <span><strong>{{$products->variants_price->selling_price}}</strong></span> </div>
                                 <div class="rating">
                                    <span class="rating-number"> 4.6<i class="fa fa-star checked"></i></span>
                                    <span>(65)</span>
                                 </div>
                              </div>
							  <div class="discount-wrapper">
							  {{$products->variants_price->discount}}% off
							  </div>
							  
                              <div class="buy-section">
                              <a  class="buy-wrap" href="{{url('product')}}/{{$products->slug}}">
                                 Buy Now <i class="fas fa-arrow-right"></i>
								     </a>
                                 <div class="cart-wrap">
                                    <img src="{{url('website/images/cart.png')}}">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                    @endforeach
                    @endif
                    
                  </div>
               </div>
               
            </div>
         </div>
      </section>
      <section class="deal-section">
         <div class="container">
            <div class="deal-wrap">
                  <h1 id="headline">Deal of the day</h1>
                  <div id="countdown">
                     <ul>
                        <li><span id="days"></span><span>days</span></li>
                        <li><span id="hours"></span> <span>Hours</span></li>
                        <li><span id="minutes"></span> <span>Minutes</span></li>
                        <li><span id="seconds"></span><span>Seconds</span> </li>
                     </ul>
                  </div>
            </div>
            <div class="product-item">
               <div class="deal-of-day ">
			   <div class="product-deal" >
					<div class="product-wrap">
                     <a  href="{{url('/')}}/product?category=<?php echo base64_encode('4'); ?>" class="product-col">
                        <div class="product-img">
                           <img src="{{url('website/images/protein1.webp')}}">
                        </div>
                        <div class="product-content">
                           <h4>Mass <br> Gainer</h4>
                           <p>UP TO</p>
                           <p>70% Off</p>
                        </div>
                     </a>
                  <div>
               </div>
            </div>
			   </div>
			   
			   
			    <div class="product-deal" >
			   <div class="product-wrap">
                        <a href="{{url('/')}}/product?category=<?php echo base64_encode('11'); ?>" class="product-col">
                           <div class="product-img">
                              <img src="{{url('website/images/protein2.webp')}}">
                           </div>
                           <div class="product-content">
                              <h4>Fat <br> Loss</h4>
                              <p>UP TO</p>
                              <p>55% Off</p>
                           </div>
                        </a>
                  <div>
                     
               </div>
            </div>
			   </div>
			   
                
			    <div class="product-deal" >
				<div class="product-wrap">
                           <a href="{{url('/')}}/product?category=<?php echo base64_encode('3'); ?>" class="product-col">
                              <div class="product-img">
                                 <img src="{{url('website/images/protein3.webp')}}">
                              </div>
                              <div class="product-content">
                                 <h4>Whey <br> Protein</h4>
                                 <p>UP TO</p>
                                 <p>45% Off</p>
                              </div>
                           </a>
                  <div>
                     
               </div>
				</div>
			   </div>

            <div class="product-deal" >
			   <div class="product-wrap">
                        <a href="{{url('/')}}/product?category=<?php echo base64_encode('11'); ?>" class="product-col">
                           <div class="product-img">
                              <img src="{{url('website/images/protein2.webp')}}">
                           </div>
                           <div class="product-content">
                              <h4>Fat <br> Loss</h4>
                              <p>UP TO</p>
                              <p>55% Off</p>
                           </div>
                        </a>
                  <div>
                     
               </div>
            </div>
			   </div>

            <div class="product-deal" >
			   <div class="product-wrap">
                        <a href="{{url('/')}}/product?category=<?php echo base64_encode('11'); ?>" class="product-col">
                           <div class="product-img">
                              <img src="{{url('website/images/protein2.webp')}}">
                           </div>
                           <div class="product-content">
                              <h4>Fat <br> Loss</h4>
                              <p>UP TO</p>
                              <p>55% Off</p>
                           </div>
                        </a>
                  <div>
                     
               </div>
            </div>
			   </div>
                
			
			
         </div>
      </section>
      <section class="Beat-section beat-se">
         <div class="container">
            <div class="product_heading">
               <h1 class="text-center">Beat the Summer</h1>
            </div>
            <div class="row">
               
               <div class=" col-lg-6 col-md-12">
                  <div class="beat-image">
                     <img src="{{url('website/images/beat-image.webp')}}">
                  </div>
               </div>
               <div class="col-lg-6 col-md-12">
                  <div class="wrapper">
                     <div class="my-slider4">
                     @if(isset($product))
                  @foreach($product as  $products) 
                        <div>
                           <div class="product-wrap">
                              <!-- <div class="wishlist">
                                 <a href="#">
                                 <i class="fa fa-heart-o"></i>
                                 </a>
                              </div> -->
                              <div class="image-wrap">
							  <a href="{{url('product')}}/{{$products->slug}}">
							  <img src="{{url('public')}}/{{$products->firstimage->url}}" alt="{{$products->product_name}}">
							  </a>
                              
                              </div>
                              @if($products->on_sale=='1')
                        <div class="sale-wrap">
                           <span>Sale</span>
                        </div>
                        @endif
                              <!--<div class="wishlist">
                                 <a href="#">
                                 <i class="fa fa-heart-o"></i>
                                 </a>
                              </div>-->
                              <div class="content-wrap">
                                 <h2>{{$products->product_name}}</h2>
                                 <p>{{$products->variants_price->product_weight->size}},@if($products->flavours!=''){{$products->flavours->flavour}} @else Unflavoured @endif</p>
                                 <div class="price-wrap">
                                    
                                    <div class="rating">
                                       <span class="rating-number"> 
                                       <i class="fa fa-star checked"></i>
                                       <i class="fa fa-star checked"></i>
                                       <i class="fa fa-star checked"></i>
                                       <i class="fa fa-star checked"></i>
                                       <i class="fa fa-star checked"></i>
                                       </span>
                                       <span>(148)</span>
                                    </div>
                                    <div class="product-price">INR <span><del> {{$products->variants_price->price}}</del></span> <span><strong>{{$products->variants_price->selling_price}}</strong>{{$products->variants_price->discount}}% off</span> </div>
                                 </div>
                                 <div class="buy-section">
                                 <a  class="buy-wrap" href="{{url('product')}}/{{$products->slug}}">
                                 Buy Now <i class="fas fa-arrow-right"></i>
								     </a>
                                    <div class="cart-wrap">
                                       <img src="{{url('website/images/cart.png')}}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                   @endforeach
                   @endif
                  

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="product-section product_wrapper" style="display: none;">
         <div class="container">
            <div class="my-slider3">
               @if(count($productLimited) > 0)
                  @foreach($productLimited as $key => $productOnly)
                  <div>
                     <div class="image-col">
                        <a href="{{url('product')}}/{{$productOnly->slug}}">
                           <div class="img-wrap">
                              <div class="sale-wrap">
                                 <span>Sale</span>
                              </div>
                              <img src="{{url('public')}}/{{$productOnly->firstimage->url}}">
                           </div>
                        </a>
                        <div class="content">
                           <p>{{$productOnly->product_name}}</p>
                        </div>
                     </div>
                  </div>
                  @endforeach
               @endif

            </div>
         </div>
      </section>
      <section class="life-style-wrap beat-se">
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-lg-3">
                  <div class="heading-wrap">
                     <h5>Supplements Aligned With Your Lifestyle</h5>
                  </div>
               </div>
               <div class="col-md-8 col-lg-9">
                  <div class="life-wrap">
                     <div class="wrapper">
                        <div class="my-slider8">
                           <div>
                              <a href="{{url('/')}}/product?goal=<?php echo base64_encode('9'); ?>" class="life-col">
                                 <div class="top-heading">
                                    <p>Health & Wellness</p>
                                 </div>
                                 <div class="bottom-image bounce-effect">
                                    <img src="{{url('website/images/Health.png')}}" class="">
                                 </div>
                              </a>
                           </div>
                           <div>
                              <a href="{{url('/')}}/product?category=<?php echo base64_encode('11'); ?>"  class="life-col">
                                 <div class="top-heading">
                                    <p>Fat Loss</p>
                                 </div>
                                 <div class="bottom-image bounce-effect">
                                    <img src="{{url('website/images/WEight-Loss.png')}}">
                                 </div>
                              </a>
                           </div>
                           <div>
                              <a href="{{url('/')}}/product?category=<?php echo base64_encode('4'); ?>"  class="life-col">
                                 <div class="top-heading">
                                    <p>Weight Gainer</p>
                                 </div>
                                 <div class="bottom-image bounce-effect">
                                    <img src="{{url('website/images/protein_p.png')}}">
                                 </div>
                              </a>
                           </div>
                           <div>
                              <a href="{{url('/')}}/product?category=<?php echo base64_encode('3'); ?>" class="life-col">
                                 <div class="top-heading">
                                    <p>Proteins</p>
                                 </div>
                                 <div class="bottom-image bounce-effect">
                                    <img src="{{url('website/images/protein_p.png')}}">
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="best-seller-wrapper best-seller-wrapper3 best-seller-wrapper2 more-products beat-se">
         <div class="container">
            <div class="product_heading">
               <h1 class="text-center">Shop for More Products</h1>
            </div>
            <div class="product_wrapper">
               <div class="wrapper">
                  <div class="my-slider5">
                     @foreach($product as $key => $products)
                     <!-- @if($key%2 == 0)
                     <div>
                     @endif -->
                        <article>
                           
                           <div class="product-wrap">
                              
                              <div class="image-wrap">
                                 <img src="{{url('public')}}/{{$products->firstimage->url}}">
                              </div>
                              <div class="sale-wrap">
                              <span>Sale</span>
                           </div>
                              <!-- <div class="wishlist">
                                 <a href="#">
                                 <i class="fa fa-heart-o"></i>
                                 </a>
                              </div> -->
                              <div class="content-wrap">
                                 <h2>{{$products->product_name}}</h2>
                                 <div class="price-wrap">
                                    <div class="product-price">INR <span><strong> {{$products->variants_price->selling_price}}</strong></span>  </div>
                                    <div class="rating">
                                       <span class="rating-number"> 4.6<i class="fa fa-star checked"></i></span>
                                       <span>(65)</span>
                                    </div>
                                 </div>
								 
								 <div class="discount-wrapper">
								 {{$products->variants_price->discount}}% off
								 </div>
								 
                                 <div class="buy-section">
                                    <a href="{{url('product')}}/{{$products->slug}}" class="buy-wrap">
                                       Buy Now <i class='fas fa-arrow-right'></i>
                                    </a>
                                    <div class="cart-wrap">
                                       <img src="{{url('website/images/cart.png')}}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </article>
                        
                     <!-- @if($key%2 != 0)
                     </div>
                     @endif -->
                     @endforeach
                    
                  </div>
               </div>
               <div class="product-btn">
                  <a href="{{url('/product')}}" class="theme-btn">
                  View All <i class="fas fa-arrow-right"></i>
                  </a>
               </div>
            </div>
         </div>
         </div>
      </section>
      <section class="fuels-wrapper">
         <div class="container">
            <div class="product_heading">
               <h1 class="text-center">What Fuels you</h1>
            </div>
            <div class="row">
           @if($Product_goal)
           @foreach( $Product_goal as $Product_goals)
               <div class="col-lg-2 col-md-4 col-sm-4">
               <?php  $str =  strval($Product_goals->id);
                   $id = base64_encode($str); ?>
                  <a href="{{url('/')}}/product?goal={{$id}}">
                  <div class="fuel-col">
                     <div class="img-wrap">
                        <img src="{{ URL::to('/') }}/public/uploads/goal/{{ @$Product_goals->image }}" alt="{{$Product_goals->name}}">
                     </div>
                     <div class="content">
                        <p>{{$Product_goals->name}}</p>
                     </div>
                  </div>
                  </a>
               </div>
               @endforeach
               @endif
            </div>
         </div>
      </section>
      <section class="best-seller-wrapper best-sell2 beat-se">
         <div class="container">
            <div class="product_heading">
               <h1 class="text-center">What’s Hot at Just Go Nutrition
</h1>
            </div>
            <div class="product_wrapper">
               <div class="wrapper">
                  <div class="my-slider6">
                  @if(isset($product))
                  @foreach($product as  $products) 
                     <div>
                        <div class="product-wrap">
                           <div class="image-wrap">
						   <a href="{{url('product')}}/{{$products->slug}}">
						      <img src="{{url('public')}}/{{$products->firstimage->url}}" alt="{{$products->product_name}}">
						   </a>
                        
                           </div>
                          <!-- <div class="wishlist">
                              <a href="#">
                              <i class="fa fa-heart-o"></i>
                              </a>
                           </div> -->
                           @if($products->on_sale=='1')
                        <div class="sale-wrap">
                           <span>Sale</span>
                        </div>
                        @endif
                           <div class="content-wrap">
                              
                           <h2>{{$products->product_name}}</h2>
                              <div class="des" >{{$products->variants_price->product_weight->size}}</div>
                              <div class="price-wrap">
                                 <div class="des">@if($products->flavours!=''){{$products->flavours->flavour}} @else Unflavoured @endif</div>
                                 <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <span>(148)</span>
                                 </div>
                              </div>

                              <div class="price-wrap">
                                 <div class="product-price">INR <span><del> {{$products->variants_price->price}}</del></span> <span><strong>{{$products->variants_price->selling_price}}</strong>{{$products->variants_price->discount}}% off</span> </div>
                                 
                              </div>
                              <div class="buy-section">
                              <a  class="buy-wrap" href="{{url('product')}}/{{$products->slug}}">
                                 Buy Now <i class="fas fa-arrow-right"></i>
								     </a>
                                 <div class="cart-wrap">
                                    <img src="{{url('website/images/cart.png')}}">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                 @endforeach
                 @endif


                     
                  </div>
               </div>
               <div class="product-btn">
                  <a href="{{url('/product')}}" class="theme-btn">
                  View All <i class="fas fa-arrow-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </section>
  
  
      @include('website.footer')
	  
	  <script>
	  
	(function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  //I'm adding this section so I don't have to keep updating this pen every year :-)
  //remove this if you don't need it
  let today = new Date(),
      dd = String(today.getDate()).padStart(2, '0'),
      mm = String(today.getMonth() + 1).padStart(2, '0'),
      yyyy = today.getFullYear(),
      nextYear = yyyy + 1,
      dayMonth = "09/30/",
      birthday = dayMonth + yyyy;
  
  today = mm + "/" + dd + "/" + yyyy;
  if (today > birthday) {
    birthday = dayMonth + nextYear;
  }
  //end
  
  const countDown = new Date(birthday).getTime(),
      x = setInterval(function() {    

        const now = new Date().getTime(),
              distance = countDown - now;
        document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)).toString().padStart(2, '0'),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)).toString().padStart(2, '0'),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second).toString().padStart(2, '0');

        //do something later when date is reached
      
	  
        //seconds
      }, 0)
  }());
  
	  
	  </script>