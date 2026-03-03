@include('website.header')
<section class="about-banner banner-area">
   <img src="{{url('website/images/product-listing.png')}}">
   <div class="container">
      <div class="content-wrap">
         <h1 class="banner-title">  Product Listing </h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"> <a href="{{url('product')}}">Product Listing</a> </li>
            </ol>
         </nav>
      </div>
   </div>
</section>
<section class="product-listing-wrap">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
            <div class="listing-sidebar  filter-box-wraps">
               <div class="category-section">
                  <form>
                     <div class="filter-box ">
                        <div class="title is-flex">
                           <span>Categories</span>
                           <a id="category-clear" href="javascript:void(0)" class="link">
                           Clear
                           </a>
                        </div>
                        <ul class="filter-list">

                        @if($Product_category)
                       @foreach($Product_category as $Product_categorys)
                           <li>

                           <?php
                                            if(!empty($_GET['category']) && $_GET['category'] != null && $_GET['category'] != '')
                                            {
                                                $arrCat = explode('=', $_GET['category']);
                                                $arrCat2 = implode($arrCat);
                                                $arrCat3 = explode(',', $arrCat2);

                                                
                                            }
                                        ?>
                              <div class="text-wrap">
                              
                                 
                                 <div><span> <input type="checkbox" id="{{$Product_categorys->name}}" name="category[]"  value="{{$Product_categorys->id}}" @if(!empty($_GET['category']) && in_array($Product_categorys->id, $arrCat3)) checked @endif class="checkbox-wrap">
                                 <label for="{{$Product_categorys->name}}">{{$Product_categorys->name}}</label>
                        </span> </div>
                              </div>
                              <!--<div class="number">
                                 (6)
                              </div>-->
                           </li>
                          @endforeach
                          @endif
                        </ul>
                     </div>
                  </form>
               </div>
           <div class="category-section">
                  <form>
                     <div class="filter-box">
                        <div class="title is-flex range-slider-wrap">
                           <span>Filter by Price</span>
                           <a id="budget-clear" href="javascript:void(0)" class="link">
                           Clear
                           </a>
                        </div>
                        <div class="main-wrapper"> 
                           <div class="slider">
                              <div class="progress"></div>
                           </div>
                           <div class="range-input">
                              <input type="range" class="range-min sliders" min="{{$minproductCost}}" max="{{$maxproductCost}}" value="<?php if(!empty($_GET['minprice'])){ echo $_GET['minprice']; }else{ echo $minproductCost; } ?>"
                                    step="100" id="lower">
                              <input type="range" class="range-max sliders" min="{{$minproductCost}}" max="{{$maxproductCost}}" value="<?php if(!empty($_GET['maxprice'])){ echo $_GET['maxprice']; }else{ echo $maxproductCost; } ?>"
                                    step="100" id="upper">
                           </div>
                           <div class="price-input">
                           
                              <div class="field">
                              
                                    <input type="number" class="input-min" value="<?php if(!empty($_GET['minprice'])){ echo $_GET['minprice']; }else{ echo $minproductCost; } ?>">                                                    
                              </div>
                              <div class="separator">to</div>
                              <div class="field">
                                 
                                    <input type="number" class="input-max" value="<?php if(!empty($_GET['maxprice'])){ echo $_GET['maxprice']; }else{ echo $maxproductCost; } ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
			   
			   
			   
			   
			   
               <div class="category-section">
                  <form>
                  <?php
                                            if(!empty($_GET['sale']) && $_GET['sale'] != null && $_GET['sale'] != '')
                                            {
                                                $arrSale = explode('=', $_GET['sale']);
                                                $arrSale2 = implode($arrSale);
                                                $arrSale3 = explode(',', $arrSale2);
                                            }
                                        ?>
                     <div class="filter-box">
                        <div class="title is-flex">
                           <span>On Sale!</span>
                        </div>
                     </div>
                     <div class="switch-wraps">
                        <p>Product Currently on sale</p>
                        <div class="toggle-btn <?php if(isset($_GET['sale']) && $_GET['sale'] != null){ echo 'activate'; }?>">
                           <input type="checkbox" name="sale"  value="1" @if(!empty($_GET['sale']) && in_array(1, $arrSale3)) checked @endif class="cb-value" />
                           <span class="round-btn"></span>

                         
                        </div>
						

          </div>
                    
                  </form>
               </div>
               <div class="category-section scroll-box">
                  <form>
                     <div class="filter-box">
                        <div class="title is-flex">
                           <span>Choose Your Lifestyle</span>
                           <a id="goal-clear" href="javascript:void(0)" class="link">
                           Clear
                           </a>
                        </div>
                        <ul class="filter-list">

                        @if($Product_goal)
                       @foreach($Product_goal as $Product_goals)

                           <li>
                         <?php
                           if(!empty($_GET['goal']) && $_GET['goal'] != null && $_GET['goal'] != '')
                                            {
                                                $arrgol = explode('=', $_GET['goal']);
                                                $arrgol2 = implode($arrgol);
                                                $arrgol3 = explode(',', $arrgol2);
                                            }
                                        ?>
                              <div class="text-wrap">
                                
                                 
                                 <div >
                                 <span><input type="checkbox" id="{{$Product_goals->name}}" name="goal[]"  value="{{$Product_goals->id}}" @if(!empty($_GET['goal']) && in_array($Product_goals->id, $arrgol3)) checked @endif class="checkbox-wrap">
                                            <label for="{{$Product_goals->name}}">{{$Product_goals->name}}</label>
								 </span>
                                 </div>
                              </div>
                              <!--<div class="number">
                                 (33)
                              </div>-->
                           </li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                  </form>
               </div>


             <div class="category-section scroll-box">
                  <form>
                     <div class="filter-box">
                        <div class="title is-flex">
                           <span>Choose Flavours</span>
                           <a id="flavour-clear" href="javascript:void(0)" class="link">
                           Clear
                           </a>
                        </div>
                        <ul class="filter-list">

                        @if($Product_falaever)
                       @foreach($Product_falaever as $Product_falaevers)

                           <li>
                              <?php
                           if(!empty($_GET['flavour']) && $_GET['flavour'] != null && $_GET['flavour'] != '')
                                            {
                                                $arrFal = explode('=', $_GET['flavour']);
                                                $arrFal2 = implode($arrFal);
                                                $arrFal3 = explode(',', $arrFal2);

                                                
                                            }
                                        ?>
                              <div class="text-wrap">
                                
                                 
                                 <div >
                                 <span><input type="checkbox" id="{{$Product_falaevers->flavour}}" name="flavour[]"  value="{{$Product_falaevers->flavour}}" @if(!empty($_GET['flavour']) && in_array($Product_falaevers->flavour, $arrFal3)) checked @endif class="checkbox-wrap">
                                            <label for="{{$Product_falaevers->flavour}}">{{$Product_falaevers->flavour}}</label>
								 </span>
                                 </div>
                              </div>
                             
                           </li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                  </form>
               </div>



               <div class="category-section">
                  <form>
                     <div class="filter-box">
                        <div class="title is-flex">
                           <span>Best Sellers</span>
                        </div>
                      
                          
                           <ul class="best-seller">
                           @if(isset($best_seller))
                           @foreach(@$best_seller as $best_sellers )
                           <li>
                              <a href="{{url('product')}}/{{$best_sellers->slug}}">
                              <div class="best-seller-wrap">
                              <div class="image">
                               <img src="{{url('public')}}/{{$best_sellers->firstimage->url}}">
                                 </div>
                                 <div class="content">
                                    <p class="heading">{{$best_sellers->product_name}}</p>
                                    <div class="rating">
                                 <span class="rating-number"> 
                                                    
                                                    <?php 
                                                      $cunt=DB::table('rating')->where('product_id',$best_sellers->id)->where('status','1')->count();
                                                        $avg_ratings=DB::table('rating')->where('product_id',$best_sellers->id)->where('status','1')->avg('rating');
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
                                                    
                                 </span>
                                       <span>({{$cunt}})</span>

                              </div>
                                    <div class="product-price">INR  <span><del>{{$best_sellers->variants_price->price}} </del></span>{{$best_sellers->variants_price->selling_price}}  <span><strong></strong></span> </div>
                                    <!--<div class="product-price">INR  <span><del> 700</del></span> <span><strong>525</strong></span> </div>-->
                                 </div>
                              </div>
                              </a>
                           </li>
                           @endforeach
                          @endif
                        </ul>




                        </ul>
                     </div>
                  </form>
                  
               </div>
            </div>
         </div>
         <div class="col-lg-9">
            <div class="listing-wrapper">
               <div class="listing-top-wrapper row align-items-center">
                  <div class="col-xl-3">
                     <p class="property-list-number">Showing <?php if(!empty($product)){ echo count($product); } ?> out of <?php echo $allproductCount; ?></p>

                  </div>
                  <div class="col-xl-6">
                    
                     <!-- <form class="listing-search-form" id="search_inner_form" method="get">
                                    @csrf
                        <input type="text" name="search" id="search_inner" class="form-control" placeholder="Search Product, Category or Goal" value="{{!empty($_GET['search']) ? $_GET['search'] : ''}}" required>
                        <button class="theme-btn-custom" type="submit">
                        Search
                        </button>
                     </form> -->
                  </div>
                  <div class="col-xl-3">
                     <div class="price-filter">
                        <p>Sort by:</p>
                        <div class="nice-select">
                           <!-- <span class="current">Price Low to High</span>
                          <ul class="list">
                              <li  class="option ">Price Low to High</li>
                              <li  class="option">Price Low to High</li>
                              <li class="option">Price Hight to Low</li>
                              <li  class="option">Newest</li>
                           </ul>-->
                           <select class="current" name="sortby" onchange="sortByFilter(this.value)">
                                 <option value="relevance" @if(!empty($_GET['sortby'])) disabled @endif>Relevance</option>
                                 <option value="low_to_high" @if(!empty($_GET['sortby']) && $_GET['sortby'] == "low_to_high") selected @endif>Price Low to High</option>
                                 <option value="high_to_low" @if(!empty($_GET['sortby']) && $_GET['sortby'] == "high_to_low") selected @endif>Price Hight to Low</option>
                                 <option value="newest" @if(!empty($_GET['sortby']) && $_GET['sortby'] == "newest") selected @endif>Newest</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  @if(isset($product))
                  @foreach($product as  $products) 
                  <div class="col-md-4">
                     <div class="listing-col">
                        <div class="image-wrap">
                           <img src="{{url('public')}}/{{$products->firstimage->url}}">
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
                           
                           <p>{{$products->variants_price->product_weight->size}},@if($products->flavours!='')  {{$products->flavours->flavour}}  @else Unflavoured @endif</p>
                           <div class="price-wrap">

                          <div class="rating">
                           <span class="rating-number"> 
                                                    
                                                    <?php 
                                                      $cunt=DB::table('rating')->where('product_id',$products->id)->where('status','1')->count();
                                                        $avg_ratings=DB::table('rating')->where('product_id',$products->id)->where('status','1')->avg('rating');
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
                                                    
                                                        </span>
                                                        <span>({{$cunt}})</span>

                                            </div>

                            <!-- <div class="rating">
                                 <span class="rating-number"> 
                                 <i class="fa fa-star checked"></i>
                                 <i class="fa fa-star checked"></i>
                                 <i class="fa fa-star checked"></i>
                                 <i class="fa fa-star checked"></i>
                                 <i class="fa fa-star checked"></i>
                                 </span>
                                 <span>(148)</span>
                              </div>-->
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
                  @endif
               </div>
           
          @if(count($product)>9)
         <div class="load-more-wrap">
            <a href="#" class="theme-btn-custom" id="seeMore">Show More</a>
            
         </div>
         <div class="load-more-wrap">
         <a href="#" class="theme-btn-custom" id="seeLess">Show Less</a>
         </div>

@endif


		   </div>
         </div>
      </div>
   </div>
</section>






  @include('website.footer')
  
 

<script>
   //-----JS for Price Range slider-----
   
   const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 100;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});
   
</script>
<script>
   $('.cb-value').click(function() {
     var mainParent = $(this).parent('.toggle-btn');
     if($(mainParent).find('input.cb-value').is(':checked')) {
       $(mainParent).addClass('active');
     } else {
       $(mainParent).removeClass('active');
     }
   
   })
   
</script>


<script>
$(document).ready(function(){
  $(".listing-col").slice(0,9).show();
  $("#seeMore").click(function(e){
    e.preventDefault();
    $(".listing-col:hidden").slice(0,3).fadeIn("slow");
    if($(".listing-col:hidden").length == 0){
       $("#seeMore").fadeOut();
      //  $("#seeLess").fadeIn("slow");
       $("#seeLess").css('display','inline-block');
      }
  
  });

  $("#seeLess").click(function(e){
    e.preventDefault();
    $(".listing-col").slice(0,3).fadeOut("slow");
   //  $(".listing-col:hidden").slice(0,3).fadeIn("slow");

    if($(".listing-col:hidden").length == 0){
       $("#seeMore").show();
       $("#seeLess").hide();
       
      }
  
  });
})

</script>
 
<!---filter------->
<script>
    function sortByFilter(filter)
    {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('sortby', filter);
        window.location.search = urlParams;
        // updateQueryStringParameter(urlParams,'sortby',filter)
    }
</script>

<script>
    $(document).ready(function () {

    const urlParams = new URLSearchParams(window.location.search);
    

   
    $('input[name="category[]"]').click(function (e) {
        var category = '', tempCatArray = [];
        
        
        $('input[name="category[]"]:checked').each(function(){
            tempCatArray.push($(this).val());
        })
        if(tempCatArray.length !== 0){
            category+=tempCatArray.toString();
            console.log(category);
            
            //ENCRYPT DATA START
            category = btoa(category);
            //ENCRYPT DATA END
            
            urlParams.set('category', category);
            tempCatArray = [];
            window.location.search = urlParams;
        }
        else{
            urlParams.delete('category');
            window.location.search = urlParams;
        }
    });




    

    $('input[name="flavour[]"]').click(function (e) {
        var flavour = '', tempFlaArray = [];
        
        
        $('input[name="flavour[]"]:checked').each(function(){
         tempFlaArray.push($(this).val());
        })
        if(tempFlaArray.length !== 0){
         flavour+=tempFlaArray.toString();
            console.log(flavour);
            
            //ENCRYPT DATA START
            flavour = btoa(flavour);
            //ENCRYPT DATA END
            
            urlParams.set('flavour', flavour);
            tempFlaArray = [];
            window.location.search = urlParams;
        }
        else{
            urlParams.delete('flavour');
            window.location.search = urlParams;
        }
    });




    $('input[name="goal[]"]').click(function (e) {
        var goal = '', tempGoalArray = [];
        
        $('input[name="goal[]"]:checked').each(function(){
         tempGoalArray.push($(this).val());
        })
        if(tempGoalArray.length !== 0){
         goal+=tempGoalArray.toString();
            console.log(goal);
            
            //ENCRYPT DATA START
            goal = btoa(goal);
            //ENCRYPT DATA END
            
            urlParams.set('goal', goal);
            tempGoalArray = [];
            window.location.search = urlParams;
        }
        else{
            urlParams.delete('goal');
            window.location.search = urlParams;
        }
    });
    $('input[name="sale"]').click(function (e) {
        var sale = '', tempSaleArray = [];
        
        $('input[name="sale"]:checked').each(function(){
         tempSaleArray.push($(this).val());
        })
        if(tempSaleArray.length !== 0){
         sale+=tempSaleArray.toString();
            console.log(sale);
            
            //ENCRYPT DATA START
            sale = btoa(sale);
            //ENCRYPT DATA END
            
            urlParams.set('sale', sale);
            tempSaleArray = [];
            window.location.search = urlParams;
        }
        else{
            urlParams.delete('sale');
            window.location.search = urlParams;
        }
    });

 
    
    

   });
</script>

<script>
    $("#search_inner_form").submit(function( event ) {
        console.log('test click');
        var search = $("#search_inner").val();
        
        if(search == null && search == '')
        {
            search = '';
        }
        
        const urlParams = new URLSearchParams(window.location.search);
        search = btoa(search);
        urlParams.set('search', search);
        window.location.search = urlParams;
        
        event.preventDefault();
    });
</script>

<!--price filter-->
<script>
$(".sliders").change(function() {
  // $("#slider-range").slider('values',0,$(this).val());
  var lowerSlider = document.getElementById('lower').value;
  var upperSlider = document.getElementById('upper').value;
  console.log('min value: '+ lowerSlider+ 'Max Value' + upperSlider);

  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set('minprice', lowerSlider);
 urlParams.set('maxprice', upperSlider);
 window.location.search = urlParams;
});
</script>



<script>
    
    // category Type Filter
    
    $(document).ready(function(){
      $("#category-clear").click(function(){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('category');
        window.location.search = urlParams;
      });
    });
    //category Type Filter
    $(document).ready(function(){
      $("#flavour-clear").click(function(){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('flavour');
        window.location.search = urlParams;
      });
    });
    // Location Filter
    
    $(document).ready(function(){
      $("#location-clear").click(function(){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('city');
        window.location.search = urlParams;
      });
    });
    
    
    // Property Type Filter
    
    $(document).ready(function(){
      $("#p-type-clear").click(function(){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('type');
        window.location.search = urlParams;
      });
    });
    
    
    // Property Status Filter
    
    $(document).ready(function(){
      $("#p-status-clear").click(function(){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('status');
        window.location.search = urlParams;
      });
    });
    
    
    // Goal Filter
    
    $(document).ready(function(){
      $("#goal-clear").click(function(){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('goal');
        window.location.search = urlParams;
      });
    });
    
    
  
    
    
    // Budget Filter
    
    $(document).ready(function(){
      $("#budget-clear").click(function(){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('minprice');
        urlParams.delete('maxprice');
        window.location.search = urlParams;
      });
    });
</script>


