@include('website.header')
<section class="fuels-main-section">
   <div class="container">
      <h3>Supplements as per Your Goals</h3>
      <div class="row">
         <div class="col-sm-6">
            <div class="fuels-inner">
               <div class="fuels-image details-image">
                  <img src="{{url('website/images/fuels-1.png')}}">
               </div>
               <div class="fuels-content">
                  <h2>Bulking</h2>
                  <p>Grow Big With Top Bulking Supplements</p>
                  <div class="collection-btn">
                     <a href="{{url('product?goal=OQ%3D%3D')}}" class="theme-btn2 theme-btn-custom">
                     Shop Now  <i class="fas fa-arrow-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="fuels-item1">
               <div class="fuels-inner">
                  <div class="fuels-image details-image">
                     <img src="{{url('website/images/fuels-2.png')}}">
                  </div>
                  <div class="fuels-content">
                     <h2>Lean Muscle Gaining</h2>
                     <p>The Ultimate Stack for Building Lean Muscles </p>
                     <div class="collection-btn">
                        <a href="{{url('product?goal=NQ%3D%3D')}}" class="theme-btn2 theme-btn-custom">
                        Shop Now <i class="fas fa-arrow-right"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="fuels-item2">
               <div class="fuels-inner">
                  <div class="fuels-image details-image" >
                     <img src="{{url('website/images/fuels-3.png')}}">
                  </div>
                  <div class="fuels-content">
                     <h2>Fat Loss </h2>
                     <p>Get Rid of Stubborn Fat Cells and Get Your Dream Shape</p>
                     <div class="collection-btn">
                        <a href="{{url('product?goal=OA%3D%3D')}}" class="theme-btn2 theme-btn-custom">
                        Shop Now <i class="fas fa-arrow-right"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="Beat-section beat-se what-fuels-slider" style="display:none;">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="wrapper">
               <div class="fuels-slider1">
                  @foreach($product as $products)
                 <div>
                   <div class="product-wrap">
					         <div class="product-wrap-inner">
					         <div class="image-wrap">
                        <img src="{{url('public')}}/{{$products->firstimage->url}}">
                        </div>
                        @if(@$products->on_sale=='1')
                        <div class="sale-wrap">
                           <span>Sale</span>
                        </div>
                        @endif
						      <div class="fat-loss">
                           <span>{{@$products->goal->name}}</span>
                        </div>
                      
                        <!--<div class="wishlist">
                           <a href="#">
                           <i class="fa fa-heart-o"></i>
                           </a>
                        </div>-->
					         </div>
                      
                      <div class="content-wrap">
                      <h2>{{$products->product_name}}</h2>
                      <p>{{$products->variants_price->product_weight->size}},@if($products->flavours!='')  {{$products->flavours->flavour}} @else Unflavoured @endif</p>
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
                              <div class="product-price">INR  <span><del>{{$products->variants_price->price}} </del></span>{{$products->variants_price->selling_price}}  <span><strong></strong>{{$products->variants_price->discount}}% off</span> </div>
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
            </div>
         </div>
      </div>
   </div>
</section>
<section class="fuels-main-section">
   <div class="container">
      <div class="row">
         <div class="col-sm-6">
            <div class="fuels-item1">
               <div class="fuels-inner">
                  <div class="fuels-image details-image">
                     <img src="{{url('website/images/fuels-4.png')}}">
                  </div>
                  <div class="fuels-content">
                     <h2>Muscle Recovery </h2>
                     <p>Recharge Your Muscles for Upcoming Workout Sessions</p>
                     <div class="collection-btn">
                        <a href="{{url('product?goal=MTA%3D')}}" class="theme-btn2 theme-btn-custom">
                        Shop Now <i class="fas fa-arrow-right"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="fuels-item2">
               <div class="fuels-inner">
                  <div class="fuels-image details-image" >
                     <img src="{{url('website/images/fuels-5.png')}}">
                  </div>
                  <div class="fuels-content">
                     <h2>Health & Fitness</h2>
                     <p>Supplements to Maintain Your Overall Health and Wellness</p>
                     <div class="collection-btn">
                        <a href="{{url('product?goal=MTE%3D')}}#" class="theme-btn2 theme-btn-custom">
                        Shop Now<i class="fas fa-arrow-right"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="fuels-inner">
               <div class="fuels-image details-image">
                  <img src="{{url('website/images/fuels-6.png')}}">
               </div>
               <div class="fuels-content">
                  <h2>Weight Management</h2>
                  <p>Gain and Maintain a Healthy Weight With These Supplements</p>
                  <div class="collection-btn">
                     <a href="{{url('product?goal=Mg%3D%3D')}}" class="theme-btn2 theme-btn-custom">
                     Shop Now  <i class="fas fa-arrow-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


<section class="Beat-section beat-se what-fuels-slider">
   <div class="container">
      <div class="row">
      <div class="col-lg-12 col-md-12">
            <div class="wrapper">
               <div class="fuels-slider1">
                  @foreach($Tranding_product as $products)
                 <div>
                   <div class="product-wrap">
					         <div class="product-wrap-inner">
					         <div class="image-wrap">
                        <img src="{{url('public')}}/{{$products->firstimage->url}}">
                        </div>
                        @if(@$products->on_sale=='1')
                        <div class="sale-wrap">
                           <span>Sale</span>
                        </div>
                        @endif
						      <div class="fat-loss">
                           <span>{{@$products->goal->name}}</span>
                        </div>
                      
                        <!--<div class="wishlist">
                           <a href="#">
                           <i class="fa fa-heart-o"></i>
                           </a>
                        </div>-->
					         </div>
                      
                      <div class="content-wrap">
                      <h2>{{$products->product_name}}</h2>
                      <p>{{$products->variants_price->product_weight->size}},@if($products->flavours!='')  {{$products->flavours->flavour}} @else Unflavoured @endif</p>
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
                              <div class="product-price">INR  <span><del>{{$products->variants_price->price}} </del></span>{{$products->variants_price->selling_price}}  <span><strong></strong>{{$products->variants_price->discount}}% off</span> </div>
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
            </div>
         </div>
      </div>
   </div>
</section>


@include('website.footer')