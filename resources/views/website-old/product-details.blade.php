@include('website.header')
<link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<div id="guide-template" class="project-detail-section  product-section" >
   <div class="container">
      <div class="row">
         <div class="col-lg-7">
            <div id="sidebar-nav">
               <div class="rev_slider">
                  
                  @if(isset($product_image))
              @foreach($product_image as $pimage)
                  <div class="rev_slide">
                     <div class="test">
                        <img src="{{url('public')}}/{{$pimage->url}}">
                     </div>
                  </div>
                 @endforeach
                 @endif
               </div>
            </div>
         </div>
         <div class="col-lg-5">

         <!-- <div class="wishlist">
            <?php
               $userid = Auth::user()->id ?? 0;
            
               $wishliststatus = DB::table('whishlists')
                  ->where(['user_id' => $userid, 'product_id' => $product->id])
                  ->count();
                  
               ?>

               @if (!Auth::check())
                  <a href="javascript:void(0);" onclick="wishloginprompt()"
                     class="whislist_add"><i class="fa fa-heart-o"
                           aria-hidden="true"></i></a>
                           @elseif($wishliststatus > 0)
                  <a href="javascript:void(0);" onclick="return false;"
                     class="whislist_add remove-inners remove-wish-{{ $product->id }} active"
                     data-id="{{ $product->id }}"><i class="fa fa-heart-o"
                           aria-hidden="true"></i></a>
               @else
                  <a href="javascript:void(0);"
                     class="whislist_add inners add-wish-{{ $product->id }}"
                     data-id="{{ $product->id }}"><i class="fa fa-heart-o"
                           aria-hidden="true"></i></a>
               @endif
         </div> -->


            <div id="content-move" class="project-detail-inner">
               <div class="info-group1">
                  <h1 class="product__title">{{$product->product_name}}</h1>
                  <div class="rating-box">
                     <!--<div class="rating">
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <span>(4.5)</span>
                     </div>-->
                     <div class="rating">
                     <?php 
                                                      $cunt=DB::table('rating')->where('product_id',$product->id)->where('status','1')->count();
                                                        $avg_ratings=DB::table('rating')->where('product_id',$product->id)->where('status','1')->avg('rating');
                                                        $avg_ratings = str_replace('.0','',round($avg_ratings,1));
                                       
                                                      for($i = 1; $i <= 5; $i++) { 
                                                     
                                                         if($i <= @$avg_ratings){
                                                         ?> 
                                                            <i class="fa fa-star checked" aria-hidden="true"></i>
                                                        <?php 
                                                             
                                                           }else{
                                                              break; 
                                                           }
                                                         } 
                                                        if(strpos($avg_ratings,'.') == true && $avg_ratings != 0.0){
                                                        
                                                        ?>
                                                            <i class="fa fa-star-half checked" aria-hidden="true"></i>
                                                        
                                                        
                                                        <?php } 
                                                    
                                                            $empty_stars = floor(5-$avg_ratings);
                                                            echo str_repeat('<i class="far fa-star star-icon" aria-hidden="true"></i>', $empty_stars);
                                                        ?>
                                                        <span>({{$avg_ratings}})</span>
                                                        </div>
                     @if (!Auth::check())
                     <a  href="javascript:void(0)"  onclick="loginprompt()">Write a review</a>
                     @else
                     <a data-toggle="modal" data-target="#review_pop" href="javascript:void(0)">Write a review</a>
                     @endif
                  </div>
                  <div class="product__description">
                     <p> {!!$product->first_content!!}</p>
                  </div>
                  
                  <div class="nutri__score-section">
                     <div class="nutri__section_icon">
					 <p>Nutri Score</p>
					 <ul class="nutri-items"> 
					 <li class="a-item"><a <?php if ($product->nutri_score=='A') { ?> class="active" <?php } ?>href="javascript:void(0)">A</a></li>
					 		 <li class="b-item"><a  <?php if ($product->nutri_score=='B') { ?> class="active" <?php } ?> href="javascript:void(0)">B</a></li>
							 		 <li class="c-item"><a <?php if ($product->nutri_score=='C'){ ?> class="active"<?php } ?> href="javascript:void(0)">C</a></li>
									 		 <li class="d-item"><a <?php if ($product->nutri_score=='D'){ ?>class="active"<?php } ?> href="javascript:void(0)">D</a></li>
											 <li class="e-item"> <a <?php if ($product->nutri_score=='E'){ ?>class="active" <?php } ?> href="javascript:void(0)">E</a></li>
					 </ul>
                       
					   
                     </div>
					 
					 
					 
					 
					 
                     <div class="nutri__section_box">
                        <span id="foodmodalOpen" data-toggle="modal" data-target="#thefoodModal" class="open_nutri_section_mod"><span class="underline">All information about the nutriscore</span></span>
                     </div>
                  </div>
                  <div class="ab-nutrition-info multistep__step">
                     <h4 >We have nothing to hide. Conivnce yourself.</h4>
                     @if($product->nutritional_image!='')
                     <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 24 24" width="24px" height="24px" style="position: relative; ">
                        <path d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 9 L 13 9 L 13 7 L 11 7 z M 11 11 L 11 17 L 13 17 L 13 11 L 11 11 z"></path>
                     </svg>
                    
                     <span class="modal-opener" data-modal-id="nutrition_table--modal">Nutritional table</span>
                     @endif
                  </div>
				  
				       
<div class="custom-model-main Nutritional-wrap">
    <div class="custom-model-inner">        
    <div class="close-btnn">×</div>
        <div class="custom-model-wrap">
            <div class="pop-up-content-wrap">
            
			  <img src="{{url('public/uploads/product')}}/{{$product->nutritional_image}}">
			
			
            </div>
        </div>  
    </div>  
    <div class="bg-overlayy"></div>
</div> 



               <form method="POST" action="{{url('/add-to-cart')}}" id="add_to_cart_form">
                  @csrf
                  <div class="sorts-wrapper  sort-category">
                     <div class="sorts-img">
                           <div class="sorts-image">
                              <h4>Sorts</h4>
                           </div>             
                     </div>
				 
					
                     <ul>
                        @if(isset($flavour))
                        @foreach($flavour as $key => $flavours)
                           <li>
                              <div class="image-wrapper">
                                 <div class="image">
                                    <!--<img src="{{url('website/images/vigan.png')}}">-->
                                  
                                    @if($flavours->flavorimage!='')
                                    <img src="{{url('public')}}/{{$flavours->flavorimage->url}}">
                                    @else
                                    <img src="{{url('website/images/demo.png')}}">
                                    @endif
                                 </div>
                                 <div class="content">
                                    <h4>{{$flavours->flavour}}</h4>
                                    <input type="hidden" name="flavour[]" id="flavour" value="{{$flavours->flavour}}">
                                    <div class="select-dropdown">
                  
                                          <select name="weight[]" id="weight"  class="weight weight_{{$flavours->id}}">
                                             
                                             @if($product_variants)
                                             @foreach($product_variants as $product_variantss)
                                             <option value="{{$product_variantss->weight}}" data-price="{{$product_variantss->selling_price}}" data-achulprice="{{$product_variantss->price}}" data-flavour="{{$flavours->id}}" data-flavourname="{{$flavours->flavour}}">{{$product_variantss->product_weight->size}} </option>
                                             @endforeach
                                             @endif

                                          </select>
                                          <input type="hidden" value="" name="sell_price" id="sell_price" class="total_price_by_weight_{{$flavours->id}}">
                                    </div>
                                 </div>
                                 <div class="cart_quantity" id="product-2">
                                 <input class="button-btn quantityminus quantity_button" value="-" type="button" data-flavour="{{$flavours->id}}">
                                 <input type="number"  min="1" step="1" max="10" name="quantity[]" id="quantity" class="input quantity flavour_qty_{{$flavours->id}}" readonly @if($key == 0) value="1" @else value="0" @endif />
                                 <input class="button-btn quantityplus quantity_button" value="+" type="button" data-flavour="{{$flavours->id}}">
                              </div>
                                 
                              </div>
                              
                           
                           </li>
                           
                        @endforeach
                        @endif
                        <input type="hidden" value="{{$product->id}}" id="product_id" name="product_id">
                        @foreach($product_variants as $key => $variant)
                              <!-- <input type="text" value="{{$variant->selling_price}}" name="sell_price[]" id="{{$variant->id}}"> -->
                        @endforeach
                     </ul>
                  </div>
                  <div class="shipping-cast-wrapper">
                     <div class="shipping-cast">
                        <div class="shipping-cast-inner">
                        @if($product_variants)
                           INR  <span  class="base-price"><del id="achulgrand_total"> {{$product_variants[0]->price }}</del></span> <span id="grand_total" class="selling-price">{{$product_variants[0]->selling_price }}</span> 
                           @endif
                        </div>
                        <div class="off-price">
                        
                        
                        <p> {{$product_variants[0]->discount }}% OFF</p>
                        </div>
                       <!-- <div class="shipping-cast-image">
                           <div class="content">
                              <p>166 Serving</p>
                              <p>INR 19.28 per meal</p>
                           </div>
                           <div class="shiping-image">
                              <img src="{{url('website/images/shiping-vector.png')}}">
                              <span>166</span>
                           </div>
                        </div> -->
                     </div>
                     <input type="hidden" name="redirect_type" id="redirect_type" value="0">
                     <p class="gst-wrap">incl. GST, plus <strong>Shipping cost</strong></p>
                  <div class="buy-section">
                       <!--<a href="javascript:void(0)"  class="buy-wrap checkSizeValid" >Add to cart <i class="fas fa-arrow-right"></i> </a> -->
                        <!-- <input type="submit" value="Add to cart" class="buy-wrap "> -->
                        <button class="buy-wrap add-toggle theme-btn-custom" type="button">Add to basket</button>
                        <?php
                        $userid = Auth::user()->id ?? 0;
                        $wishliststatus = DB::table('whishlists')->where(['user_id' => $userid, 'product_id' => $product->id])->count();                           
                        ?>
                        
                        <div class="cart-wrap wishlist-wrap">
                        @if (!Auth::check())
                           <a href="javascript:void(0);" onclick="wishloginprompt()"
                              class="whislist_add"><i class="fa fa-heart-o"
                                    aria-hidden="true"></i></a>
                                    @elseif($wishliststatus > 0)
                           <a href="javascript:void(0);" onclick="return false;"
                              class="whislist_add remove-inners remove-wish-{{ $product->id }} active"
                              data-id="{{ $product->id }}"><i class="fa fa-heart-o"
                                    aria-hidden="true"></i></a>
                        @else
                           <a href="javascript:void(0);"
                              class="whislist_add inners add-wish-{{ $product->id }}"
                              data-id="{{ $product->id }}"><i class="fa fa-heart-o"
                                    aria-hidden="true"></i></a>
                        @endif
                           <!-- <img src="{{url('website/images/cart.png')}}"> -->
                           <!-- <i class="fa fa-heart-o" aria-hidden="true"></i> -->
                        </div>
                     </div>
					 
					    <!--<div class="buy-section">
                      <a href="javascript:void(0)"  class="buy-wrap add-toggle checkSizeValid" >Add to cart <i class="fas fa-arrow-right"></i> </a> 
                    
					
                        <div class="cart-wrap">
                           <img src="{{url('website/images/cart.png')}}">
                        </div>
                     </div> -->
					 
					 
                     <p class="shipping"><i class="fa-solid fa-truck-fast"></i> Free Shipping from INR 5000</p>
                     <p class="shipping"><i class="fa-solid fa-box"></i> Delivery within 2-3 working days </p>
                  </div>
               </form>
                  <ul class="accordion-wrap">
                     <li class="accordion-item">
                        <a class="toggle"  href="#"> Product Description</a>
                        <div class="inner">
                       {!!$product->description!!}
                        </div>
                     </li>
                     <li class="accordion-item">
                        <a class="toggle"  href="#">Benefits</a>
                        <div class="inner">
                        {!!$product->key_benefits!!}
                       </div>
                     </li>
                     <li class="accordion-item">
                        <a class="toggle" href="#">How to use ?</a>
                        <div class="inner">
                        {!!$product->how_to_use!!}
                        </div>
                     </li>
                  </ul>
                  <div class="payment__methods">
                     <div class="my-1 mx-2">
                        <div class="inline-block" style="height: ;width: 100%;">
                          <img src="{{url('website/images/paypal.png')}}">
						 
                        </div>
                     </div>
                     <div class="my-1 mx-2">
                        <div class="inline-block" style="height: ;width: 100%;">
                         
						        <img src="{{url('website/images/amazon.png')}}">
                        </div>
                     </div>
                     <div class="my-1 mx-2">
                        <div class="inline-block" style="height: ;width: 100%;">
                           <img src="{{url('website/images/mastercard.png')}}">
                        </div>
                     </div>
                     <div class="my-1 mx-2">
                        <div class="inline-block" style="height: ;width: 100%;">
                             <img src="{{url('website/images/visa.png')}}">
                        </div>
                     </div>
                     <div class="my-1 mx-2">
                        <div class="inline-block" style="height: ;width: 100%;">
                            <img src="{{url('website/images/amex.png')}}">
                        </div>
                     </div>
                     <div class="my-1 mx-2">
                        <div class="inline-block" style="height: ;width: 100%;">
                            <img src="{{url('website/images/sofort.png')}}">
                        </div>
                     </div>
                     <div class="my-1 mx-2">
                        <div class="inline-block" style="height: ;width: 100%;">
                              <img src="{{url('website/images/klara.png')}}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Food Model-->
  <div class="modal fade" id="thefoodModal" tabindex="-1" role="dialog" aria-labelledby="theModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nutri-Score</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <p>The <a href="/smart-food" >Nutri-Score</a> helps you to quickly and easily find out how wholesome and balanced a food product is. On the five-point scale, the green A is the best rating and the red E is the worst.The Nutri-Score is a voluntary, scientifically recognized food labeling system and is prominently displayed on the front of food packaging.<br><br></p>
        </div>
       
	   
      </div>
    </div>
  </div>




<div class="campaign-modal-open" >
   <span><i class="fa fa-gift fa_custom"></i> INR 1000 Discount</span>
   <a class="campaign-trigger-close " href="#">×</a>
</div>
<div class="wd-inner-container">
   <div class="container">
      <h3>Known From</h3>
      <div class="row">
         <div class="col-md-12">
            <div class="wd-inner-inner">
           <div class="winner-col">
		    <img src="{{url('website/images/bild.png')}}">
		   </div>
		   
		   
		   <div class="winner-col">
		    <img src="{{url('website/images/gq_l.png')}}">
		   </div>
		   
		      <div class="winner-col">
		    <img src="{{url('website/images/pioneers.png')}}">
		   </div>
		   
		       <div class="winner-col">
		    <img src="{{url('website/images/jilie.png')}}">
		   </div>
		   
		      <div class="winner-col">
		    <img src="{{url('website/images/stern.png')}}">
		   </div>
		   
            </div>
         </div>
      </div>
   </div>
</div>
<section class="service-wrapper">
   <div class="container">
      <div class="row">
         <div class="content-wrap">
            <h5>All the advantages without any compromises.</h5>
            <p>If it has to be quick again, JustGoNutrition is the <strong style="text-decoration: underline;">healthy</strong> alternative. And it has to do one thing above all: taste good.</p>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-6 col-lg-3">
            <div class="service-col">
               <div class="icon">
                  <img src="{{url('website/images/thumb.png')}}">
               </div>
               <div class="content">
                  <h6>Simple & Practical</h6>
                  <p>Always and everywhere ready. Long lasting and without cooling.</p>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="service-col">
               <div class="icon">
                  <img src="{{url('website/images/healthh.png')}}">
               </div>
               <div class="content">
                  <h6>Healthy & Balanced</h6>
                  <p>Everything in it: vitamins, minerals, proteins, fiber.</p>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="service-col">
               <div class="icon">
                  <img src="{{url('website/images/smile.png')}}">
               </div>
               <div class="content">
                  <h6>Inexpensive & Stress-Free</h6>
                  <p>Delivered straight to your home. Even cheaper with a subscription.</p>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="service-col">
               <div class="icon">
                  <img src="{{url('website/images/heart.png')}}">
               </div>
               <div class="content">
                  <h6>Tasty & Versatile</h6>
                  <p>A large selection of great varieties for every taste and regular special editions.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section  class="vitamin-section">
   <div class="container">
      <div class="row">
         <div class="vitamin-wrap">
            <div class="col-lg-7">
               <div class="vitamin-image">
                  <img src="{{url('website/images/vitamin-image.png')}}">
               </div>
            </div>
            <div class="col-lg-5">
               <div class="content">
                  <span>WHAT Justgonutrition OFFERS YOUR HEALTH</span>
                  <h4>166 advantages <br> without any <br> compromises.</h4>
                  <p style="    margin-bottom: 30px;
                     margin-top: 15px;">Everyone talks about<strong style="text-decoration:underline"> being healthy</strong> So are we.</p>
                  <ul class="vitamin-items">
                     <li>
                        <div class="image">
                           <img src="{{url('website/images/flower.png')}}">
                        </div>
                        <div class="content">
                           <div>26 vitamins and minerals</div>
                           <p>cover at least 25% of your daily micronutrient requirements.</p>
                        </div>
                     </li>
                     <li>
                        <div class="image">
                           <img src="{{url('website/images/hand.png')}}">
                        </div>
                        <div class="content">
                           <div>30 grams of proteins</div>
                           <p>already provide you with 41% of your daily needs.</p>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="Best-Quality-section">
   <div class="container">
      <div class="Best-Quality-content">
         <h4>What Is Inside? Best<br> Quality. Thanks To The Best<br> Ingredients</h4>
      </div>
      <div class="row">
         <div class="image-wrapper">
            <div class="image">
               <img src="{{url('website/images/quality-image.png')}}">
            </div>
            <div class="content">
               <p class="description-wrap">Etiam porta sem id posuere congue. Donec nec ex libero. Nunc interdum rutrum blandit. Nam aliquet sagittis tortor, ac auctor ante sodales id. Ut auctor bibendum neque sed ullamcorper. In in quam mattis, ultricies libero .</p>
               <div class="collection-btn">
                  <a href="#" class="theme-btn2 theme-btn-custom">
                  To the list of ingredients  <i class="fas fa-arrow-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>



@if(count($reviews)>0) 
<section class="customer-section">
   <p class="top-heading">Fitness Enthusiasts on Just Go Products</p>
   <div class="container">
      <div class="customers-slider">
         @if(isset($reviews))
         @foreach( $reviews as $reviewes )
         <div class="customers-col">
            <div class="customer-inner">
             <div class="rating">
               <span>{{$reviewes->rating}}</span>
               <?php
              $l=$reviewes->rating;
               for($i = 1; $i <=$l; $i++) { ?>
               <i class="fa fa-star checked"></i>
             <?php  }
               ?>
             
               
             </div>
               <div class="heading">"{{$reviewes->comment_heading}}"</div>
               <p>{!!$reviewes->comment!!}</p>
             
               <div class="author-wrap">
                  <div class="image-wrap">
                     <img src="{{url('public/uploads/profile.png')}}">
                    
                  </div>
                  <div class="autor-name">
                    {{$reviewes->user->name}}
                  </div>
               </div>
            </div>
         </div>
      @endforeach
      @endif
      </div>
   </div>
</section>
@endif

<div class="modal add-card-model">
   <div class="modal-overlay modal-toggle"></div>
   <div class="modal-wrapper modal-transition">
      <div class="modal-header">
         <button type="button" class="close modal-close " data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
         </button>
      </div>
      <div class="modal-body">
         <div class="modal-inner">
            <div class="box-design">
            </div>
            <div class="modal-content">
               <h2> Do you want to Continue <br> Shopping </h2>
               <div class="button-section">
                  <button  class="yes_btn theme-btn-custom " type="button" id="redirect_btn_yes">Yes</button>
                  <button class="no_btn theme-btn-custom" type="button" id="redirect_btn_no">No</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
  
 <!-- Review Popup -->

 <div class="modal fade subscribePopup" id="review_pop" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalLabel" aria-hidden="true">

 <div class="modal-dialog" role="document">

     <div class="modal-content login_popup">

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">

             <span aria-hidden="true">&times;</span>

         </button>

         <div class="modal-body">

             <div class="review-body">
                 <div class="product-image">
                 
                 <img src="{{url('public')}}/{{$product_image[0]->url}}" alt="{{$product->product_name}}">
                     <!--<img src="{{url('public/uploads/product/9174adf7539a6f1b4016c436f3bea50a.webp')}}" alt="Review Image">-->
                 </div>
                 <form action="{{url('/save-review')}}" id="" method="POST">
                 
                         @csrf
                 <div class="product-description">
                     <p class="product-title">{{$product->product_name}}</p>
                     <p class="review-title">Rate this product <span class="review-rating">
                         <span class="span" value="1"><i class="fa fa-star" aria-hidden="true"></i></span>
                         <span class="span" value="2"><i class="fa fa-star" aria-hidden="true"></i></span>
                         <span class="span" value="3"><i class="fa fa-star" aria-hidden="true"></i></span>
                         <span class="span" value="4"><i class="fa fa-star" aria-hidden="true"></i></span>
                         <span class="span" value="5"><i class="fa fa-star" aria-hidden="true"></i></span>
                     </span></p>
                 </div>

                 <div class="image_content" >
                <div class="image_content_inner">
                     <div class="subscribe-new-area-detail">
                     <input type="hidden" name="rating" id="rating_hidden" value="">
                     <input type="hidden" name="product_id" value="{{$product->id}}">
                    
                         <label for="date">Write Review Title</label>
                         <input type="text"  name="review_title" class="form-control" required placeholder="Type Here...">
                         <label for="date">Write a Review</label>
                         <textarea name="review_desc" class="form-control" id="" cols="30" rows="5"  placeholder="Write a Review"></textarea>
                             <div class="submit_btn">
                                 <button type="submit" id="next" class="btn__text theme-btn2 theme-btn-custom">Submit Review <span class="arrow">⟶</span></button>
                             </div>
                         </form>
                     </div>
               </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
<!-- Subscribe Popup  -->
  
@include('website.footer')
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>



 <script>
 
 $(document).ready(function () {
  
  $('.add-toggle').click(function () {
    $('.add-card-model').modal("show");
  });

  $('#redirect_btn_yes').click(function () {
    $('#redirect_type').val(1);
    $('#add_to_cart_form').submit();
  });

  $('#redirect_btn_no').click(function () {
    $('#redirect_type').val(0);
    $('#add_to_cart_form').submit();
  });

  
//   Rating JS
var x=document.getElementsByClassName("span");
for(var i=0;i<x.length;i++){
  x[i].addEventListener("click",function(){
   
    var value=this.getAttribute("value");
    console.log('Rating  = ' + value);
    $('#rating_hidden').val(value);
    clearClass();
    for(var j=value-1;j>=0;j--){
      x[j].classList.toggle('a');
    }
  })
};

function clearClass(){
  var x=document.getElementsByTagName("span");
  for(var i=0;i<x.length;i++){
      //console.log(x[i].classList);
      x[i].classList.remove('a');
  };
}

  
});
 
 
 
  </script>
<!--slider script-->
<script>
   var rev = $('.rev_slider');
   rev.on('init', function(event, slick, currentSlide) {
     var
       cur = $(slick.$slides[slick.currentSlide]),
       next = cur.next(),
       next2 = cur.next().next(),
       prev = cur.prev(),
       prev2 = cur.prev().prev();
     prev.addClass('slick-sprev');
     next.addClass('slick-snext');  
     prev2.addClass('slick-sprev2');
     next2.addClass('slick-snext2');  
     cur.removeClass('slick-snext').removeClass('slick-sprev').removeClass('slick-snext2').removeClass('slick-sprev2');
     slick.$prev = prev;
     slick.$next = next;
   }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
     console.log('beforeChange');
     var
       cur = $(slick.$slides[nextSlide]);
     console.log(slick.$prev, slick.$next);
     slick.$prev.removeClass('slick-sprev');
     slick.$next.removeClass('slick-snext');
     slick.$prev.prev().removeClass('slick-sprev2');
     slick.$next.next().removeClass('slick-snext2');
     next = cur.next(),  
     prev = cur.prev();
     //prev2.prev().prev();
     //next2.next().next();
     prev.addClass('slick-sprev');
     next.addClass('slick-snext');
     prev.prev().addClass('slick-sprev2');
     next.next().addClass('slick-snext2');
     slick.$prev = prev;
     slick.$next = next;
     cur.removeClass('slick-next').removeClass('slick-sprev').removeClass('slick-next2').removeClass('slick-sprev2');
   });
   
   rev.slick({
     speed: 1000,
     arrows: true,
     dots: false,
     focusOnSelect: true,
     prevArrow: '<button class="prev"> prev</button>',
     nextArrow: '<button class="next"> next</button>',
     infinite: true,
     centerMode: true,
     slidesPerRow: 1,
     slidesToShow: 1,
     slidesToScroll: 1,
     centerPadding: '0',
     swipe: true,
     customPaging: function(slider, i) {
       return '';
     },
     /*infinite: false,*/
   });
   
   
</script>
<!--slider script end-->
<script>
   //--------------------------  side bar fixed	
   
       var $sidebar = $('#sidebar-nav');
       var sidebarTop = $sidebar.position().top;
       var blogHeight = $('#content-move').outerHeight() - 360;
   
       $(window).scroll(fixSidebarOnScroll);
   
       function fixSidebarOnScroll() {
           var windowScrollTop = $(window).scrollTop() - 100;
   
       
           if (windowScrollTop >= blogHeight || windowScrollTop <= sidebarTop) {
               $sidebar.removeClass('sticky');
           }
           else if (windowScrollTop >= sidebarTop) {
               if (!$sidebar.hasClass('sticky')) {
                   $sidebar.addClass('sticky');
               }
           }
     
     
       }

   
   
</script>
<!--sidebar end script>-->
<script>


$( document ).ready(function() {

   function IsIdInArray(array, id) {
    for (var i = 0; i < array.length; i++) {
        if (array[i].flav_id === id){
            i = i+1;
            return i;
        }
    }
    return false;
    }

    var multi_flavour_array = [];
    
    var price = $(this).find(':selected').data("price")
    var achulprice=$(this).find(':selected').data("achulprice")
      var flav_id = $(this).find(':selected').data("flavour")
      var selected_weight = $(this).find(':selected').val()
      var flav_name = $(this).find(':selected').data("flavourname")
      var flav_val = $('.flavour_qty_'+flav_id).val()
      var final_amount = price * flav_val
      var achulfinal_amount = achulprice * flav_val

      var check = IsIdInArray(multi_flavour_array, flav_id);
        if(check){
            multi_flavour_array[check-1]['achulprice'] = achulfinal_amount
            multi_flavour_array[check-1]['price'] = final_amount
            multi_flavour_array[check-1]['qty'] = flav_val
            multi_flavour_array[check-1]['selected_weight'] = selected_weight
        }else{
            multi_flavour_array.push({flav_id:flav_id,price:final_amount,achulprice:achulfinal_amount,flav_name:flav_name,qty:flav_val,selected_weight:selected_weight})
        }
        var total = 0
        var achulprice = 0
        $.each(multi_flavour_array, function(key,val) {             
            total += val.price   
            achulprice += val.achulprice    
        });

      $('.total_price_by_weight_'+flav_id).val(final_amount)
      $('.achultotal_price_by_weight_'+flav_id).val(achulfinal_amount)
      $('#grand_total').text(total)
      $('#achulgrand_total').text(achulprice)

   $(".weight").change(function(){
      var achulprice=$(this).find(':selected').data("achulprice")
      var price = $(this).find(':selected').data("price")
      var selected_weight = $(this).find(':selected').val()
      var flav_id = $(this).find(':selected').data("flavour")
      var flav_name = $(this).find(':selected').data("flavourname")
      var flav_val = $('.flavour_qty_'+flav_id).val()
      var final_amount = price * flav_val
      var achulfinal_amount= achulprice* flav_val

      var check = IsIdInArray(multi_flavour_array, flav_id);
        if(check){
            multi_flavour_array[check-1]['achulprice'] = achulfinal_amount
            multi_flavour_array[check-1]['price'] = final_amount
            multi_flavour_array[check-1]['qty'] = flav_val
            multi_flavour_array[check-1]['selected_weight'] = selected_weight
        }else{
            multi_flavour_array.push({flav_id:flav_id,price:final_amount,achulprice:achulfinal_amount,flav_name:flav_name,qty:flav_val,selected_weight:selected_weight})
        }
        var total = 0
        var achulprice = 0
        $.each(multi_flavour_array, function(key,val) {             
            total += val.price 
            achulprice += val.achulprice         
        });

      $('.total_price_by_weight_'+flav_id).val(final_amount)
      $('#grand_total').text(total)
      $('.achultotal_price_by_weight_'+flav_id).val(achulfinal_amount)
      $('#achulgrand_total').text(achulprice)
    });


    $(".quantity_button").click(function(){
      var flav_id = $(this).data("flavour")
      var flav_val = $('.flavour_qty_'+flav_id).val()
      var selected_weight_achulprice = $('.weight_'+flav_id).find(":selected").data("achulprice")
      var selected_weight_price = $('.weight_'+flav_id).find(":selected").data("price")
      var flav_name = $('.weight_'+flav_id).find(":selected").data("flavourname")
      var selected_weight = $('.weight_'+flav_id).find(":selected").val()
      var final_amount = selected_weight_price * flav_val
      var achulfinal_amount = selected_weight_achulprice * flav_val

      $('.total_price_by_weight_'+flav_id).val(final_amount)
      $('.achultotal_price_by_weight_'+flav_id).val(achulfinal_amount)

      var check = IsIdInArray(multi_flavour_array, flav_id);
        if(check){
            multi_flavour_array[check-1]['price'] = final_amount
            multi_flavour_array[check-1]['achulprice'] = achulfinal_amount
            multi_flavour_array[check-1]['qty'] = flav_val
            multi_flavour_array[check-1]['selected_weight'] = selected_weight
        }else{
            multi_flavour_array.push({flav_id:flav_id,price:final_amount,achulprice:achulfinal_amount,flav_name:flav_name,qty:flav_val,selected_weight:selected_weight})
        }
        var total = 0
        var achulprice = 0
        $.each(multi_flavour_array, function(key,val) {             
            total += val.price      
            achulprice += val.achulprice       
        });
      $('#grand_total').text(total)
      $('#achulgrand_total').text(achulprice)

    });

   $(document).on("click", ".inners", function() {
  
         var selected_flavour = []
         var selected_weight = []
         var selected_quantity = []
         $.each(multi_flavour_array, function(key,val) { 
            if(val.price > 0){
               selected_flavour.push(val.flav_name) 
               selected_weight.push(val.selected_weight) 
               selected_quantity.push(val.qty) 
            }                  
         });

         var product_id = $(this).data("id");
         var weight= $("#weight").val();
         var flavour = $("#flavour").val();
         var quantity = $("#quantity").val();
         var sell_price = $("#sell_price").val();
         var token = $("meta[name='csrf-token']").attr("content");
      $.ajax({
         type: 'POST',
         url: '{{ url('wish-to-cart') }}',
         data: {
            product_id: product_id,
            weight: selected_weight,
            flavour: selected_flavour,
            quantity:selected_quantity,
            sell_price:sell_price,
            _token: "{{ csrf_token() }}"
         },
         success: function(data) {
            console.log(data);
            $(".add-wish-" + product_id).addClass('remove-inners');
            $(".add-wish-" + product_id).addClass('remove-wish-' + product_id);
            $(".add-wish-"+product_id).html('<i class="far fa-heart text-red"></i>');
            $(".add-wish-" + product_id).removeClass('inners');
            $('#wish-count').html(data.wish_count);
          
            
         }
      });
   });
});

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
         $(".remove-wish-" + product_id).addClass('inners');
         $(".remove-wish-" + product_id).addClass('add-wish-' + product_id);
         $(".remove-wish-" + product_id).removeClass('remove-inners');
         $('#wish-count').html(data.wish_count);
        
      }
   });
});
</script>



<!--add wish list -->


<script>

    function wishloginprompt() {
        setTimeout(function() {
            $(".whislist_add").removeClass('active');
        }, 1000);

        var url = '{{ url('/') }}';
        $('#popupimage').attr("src", url + '/website/images/home/icons/warning-icon.png');
        $('#popup_text').text('Please login to add to wishlist.');
       
        $("#mobilenumPopup").modal("show");
    }
</script>