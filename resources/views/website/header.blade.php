<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- <meta name="robots" content="noindex,nofollow"> -->
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      @if(isset($seo))
      @foreach($seo as $seoItem)
      @if (Request::url() == $seoItem->url)
      <title>{{ $seoItem->meta_title }}</title>
      @if($seoItem->url)
      <meta name="url" content="{{ $seoItem->url }}" />
      @endif
      @if($seoItem->keywords)
      <meta name="keywords" content="{{ $seoItem->keywords }}" />
      @endif
      @if($seoItem->description)
      <meta name="description" content="{{ $seoItem->description }}" />
      @endif
      @if($seoItem->canonical_tag)
      <link rel="canonical" href="{{ $seoItem->canonical_tag }}" />
      @endif
      @if($seoItem->og_tags)
      <meta property="og:tags" content="{{ $seoItem->og_tags }}" />
      @endif
      @if($seoItem->meta_twitter)
      <meta name="twitter" content="{{ $seoItem->meta_twitter }}" />
      @endif
      @if($seoItem->meta_twitter_card)
      <meta name="twitter:card" content="{{ $seoItem->meta_twitter_card }}" />
      @endif
      @if($seoItem->meta_twitter_site)
      <meta name="twitter:site" content="{{ $seoItem->meta_twitter_site }}" />
      @endif
      @if($seoItem->meta_twitter_title)
      <meta name="twitter:title" content="{{ $seoItem->meta_twitter_title }}" />
      @endif
      @if($seoItem->meta_twitter_description)
      <meta name="twitter:description" content="{{ $seoItem->meta_twitter_description }}" />
      @endif
      @if($seoItem->og_title)
      <meta property="og:title" content="{{ $seoItem->og_title }}" />
      @endif
      @if($seoItem->og_site_name)
      <meta property="og:site_name" content="{{ $seoItem->og_site_name }}" />
      @endif
      @if($seoItem->og_description)
      <meta property="og:description" content="{{ $seoItem->og_description }}" />
      @endif
      @if($seoItem->og_image_url)
      <meta property="og:image" content="{{ $seoItem->og_image_url }}" />
      @endif
      @if($seoItem->og_url)
      <meta property="og:url" content="{{ $seoItem->og_url }}" />
      @endif
      @if($seoItem->og_type)
      <meta property="og:type" content="{{ $seoItem->og_type }}" />
      @endif
      @if($seoItem->robots_tag)
      <meta name="robots" content="{{ $seoItem->robots_tag }}" />
      @endif
      <!-- Corrected schema section -->
      @if(!empty($seoItem->faq_schema))
      {!! $seoItem->faq_schema !!}
      @endif
      @if(!empty($seoItem->product_schema))
      {!! $seoItem->product_schema !!}
      @endif
      @if(!empty($seoItem->review_schema))
      {!! $seoItem->review_schema !!}
      @endif
      @if(!empty($seoItem->article_schema))
      {!! $seoItem->article_schema !!}
      @endif   
      @if(!empty($seoItem->local_schema))
      {!! $seoItem->local_schema !!}
      @endif 
      @if(!empty($seoItem->video_schema))
      {!! $seoItem->video_schema !!}
      @endif 
      @endif
      @endforeach
      @endif
      <link rel="icon" type="image/png" href="{{url('public/images/favicon.png')}}" >
      <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/css/libs/animate.min.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap"
         rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
      <link rel="stylesheet" href="{{url('public/css/custom.css')}}" />
      <link rel="stylesheet" href="{{url('public/css/style.css')}}" />
      <link rel="stylesheet" href="{{url('public/css/index.css')}}" />
      <link rel="stylesheet" href="{{url('public/css/cart.css')}}" />
      <link rel="stylesheet" href="{{url('public/css/responsive.css')}}" />
      <link rel="stylesheet" href="{{url('public/css/responsive1.css')}}" />
      <link rel="preload" href="{{url('public/images/new-home/theme-banner1.webp')}}" as="image">
      <link rel="preload" href="{{url('public/images/new-home/theme-banner2.webp')}}" as="image">
      <link rel="preload" href="{{url('public/images/banner-new1.webp')}}" as="image">
      <link rel="preload" href="{{url('public/images/banner-new2.webp')}}" as="image">
      <link rel="preload" href="{{url('public/images/banner-new3.webp')}}" as="image">
      <link rel="preload" href="{{url('public/images/banner-new4.webp')}}" as="image">
      <!-- Google tag (gtag.js) -->
      {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-NYYHHB1R8L"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'G-NYYHHB1R8L');
      </script>
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16756919325"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'AW-16756919325');
      </script> --}}
      @php
      $trackingCodes = \DB::table('tracking_codes')->get();
      @endphp
      @if(isset($trackingCodes))
      <?php
         $str = @$trackingCodes[0]->TrackingCode;
         echo $str;
         ?>
      @endif
      <!-- Meta Pixel Code -->
      <script>
         !function(f,b,e,v,n,t,s)
         {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
         n.callMethod.apply(n,arguments):n.queue.push(arguments)};
         if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
         n.queue=[];t=b.createElement(e);t.async=!0;
         t.src=v;s=b.getElementsByTagName(e)[0];
         s.parentNode.insertBefore(t,s)}(window, document,'script',
         'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '3846816858894875');
         fbq('track', 'PageView');
      </script>
      <noscript><img height="1" width="1" style="display:none"
         src="https://www.facebook.com/tr?id=3846816858894875&ev=PageView&noscript=1"
         /></noscript>
      <!-- End Meta Pixel Code -->
      <meta name="google-site-verification" content="BMQy-RliCSYprMRzSvonHwfHdvWkyAEUFFFmauRwOhw" />
      <script type="application/ld+json">
         {
         "@context": "https://schema.org",
         "@type": "Organization",
         "name": "Aayurja",
         "alternateName": "Aayurja",
         "url": "https://www.aayurja.com/",
         "logo": "https://www.aayurja.com/public/images/header-logo.webp",
         "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+918057244477",
            "contactType": "customer service",
            "areaServed": "IN",
            "availableLanguage": "en"
         },
         "sameAs": [
            "https://www.facebook.com/aayurja.official",
            "https://www.youtube.com/@Aayurja",
            "https://www.instagram.com/aayurjaofficial"
         ]
         }
      </script>


      
   </head>
   <body class="gradient-header">
   <header class="header">
      <div class="theme-header-top">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-lg-3">
                  <div class="call-text">
                     Need help? call us:
                     <a href="tel:+91 70554 33886"> +91 70554 33886 </a>
                  </div>
               </div>
               <div class="col-md-12 col-lg-8">
                  <div class="call-wrap">
                     <div class="call-slider">
                        <div class="slider-cols">
                           <p class="w-100">
                              Get an extra 5% discount on orders over ₹1000, up to 100 -
                              Use coupon AAYU100
                           </p>
                        </div>
                        <div class="slider-cols">
                           <p class="w-100">
                              Get an extra 5% discount on orders over ₹1000, up to 100 -
                              Use coupon AAYU100
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            
               <div class="col-md-12 col-lg-1 ">
                  <div class="cross-header" style="color:#fff;line-height:1"> <i class="fa-solid fa-xmark"></i> </div>
               </div>
               <!-- <div class="col-md-12 col-lg-2 ">
                  <div class="select-city">
                     <div class="input-field">
                        <select id="country_select" name="country" aria-label="Select a country">
                           <option value="India">India</option>
                           <option value="Canada">Canada</option>
                           <option value="Greece">Greece</option>
                           <option value="Iraq">Iraq</option>
                           <option value="Malaysia">Malaysia</option>
                        </select>
                        <svg
                           class="select__arrow"
                           aria-hidden="true"
                           viewBox="0 0 16 16"
                           >
                           <polyline
                              points="3.5,6.5 8,11 12.5,6.5"
                              stroke-width="2"
                              fill="none"
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              ></polyline>
                        </svg>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </div>




         <!-- <div class="header-top">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="header-text">
                        <marquee behavior="" direction=""><p>
                           Seeking premium bulk orders for your restaurant or business? Connect with us directly on Whatsapp <i class="fa-brands fa-whatsapp"></i> at 
                           <a href="tel:+91-8057244477">+91-8057244477</a>
                        </p></marquee>
                     </div>
                  </div>
               </div>
           
               <div class="col-md-12 col-lg-1 ">
                  <div class="cross-header"> <i class="fa-solid fa-xmark"></i> </div>
               </div> -->
               <!-- <div class="col-md-12 col-lg-2 ">
                  <div class="select-city">
                     <div class="input-field">
                        <select id="country_select" name="country" aria-label="Select a country">
                           <option value="India">India</option>
                           <option value="Canada">Canada</option>
                           <option value="Greece">Greece</option>
                           <option value="Iraq">Iraq</option>
                           <option value="Malaysia">Malaysia</option>
                        </select>
                        <svg
                           class="select__arrow"
                           aria-hidden="true"
                           viewBox="0 0 16 16"
                           >
                           <polyline
                              points="3.5,6.5 8,11 12.5,6.5"
                              stroke-width="2"
                              fill="none"
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              ></polyline>
                        </svg>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
      <div class="new-header-section">
      <div class="main-top-header">
         <div class="main-header  ">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                     <div class="header-logo">
                        <a href="{{ url('/') }}"><img src="{{url('public/images/header-logo.webp')}}" alt="logo"/></a>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-md-6 col-lg-8 d-none d-sm-none d-md-none d-lg-block">
                     <!-- <div class="header-search">
                        <form class="searchContainer">
                           <input type="search" class="form-controls search_data" placeholder="Search product here.." type="text" autocomplete="off">
                           <button class="search-icon" aria-label="Search">
                           <i class="fa-solid fa-magnifying-glass"></i>
                           </button>
                        </form>
                        </div>
                        -->
                        <!-- <div class="header-search">  
                        <form class="searchContainer" data-gtm-form-interact-id="0">
                           <input type="search" class="form-controls search_data" placeholder="Search product here.." autocomplete="off" data-gtm-form-interact-field-id="0">
                           <button class="search-icon" aria-label="Search">
                           <i class="fa-solid fa-magnifying-glass"></i>
                           </button>
                        </form>
                     </div> -->

                     <div class="header-bottom-section">
                        <div class="container">
                           <div class="row align-items-center">
                              <div class="col-md-12">
                                 <div class="bottom-menu">
                                    <ul class="menu-item">
                                       <li> <a  href="{{ url('about-us') }}">About </a></li>
                                       <li class="product-dropdown">
                                          <a href="{{ url('shop') }}">Products <i class="fa-solid fa-chevron-right"></i>  </a>
                                          <div class="product-dropdown-area  product-dropdown-area2 product-item6  ">
                                             <div class="product-paneContent">
                                                <div class="product-paneContent">
                                                   <ul class="main-items">

                                                   @foreach($productcategry_list as $key => $productcategry)
                                                      <li>
                                                         <a href="{{url('/shop/'.$productcategry->slug)}}">
                                                            <div class="child-items">
                                                               <div class="img">  
                                                                  <!-- <img src="{{url('public/images/gucchi-icon.webp')}}" alt="logo"/>  -->
                                                                  <img src="{{url('public/uploads/productcategory/' .$productcategry->image)}}" alt="Slider" loading="lazy" />
                                                               </div>
                                                               <div class="content">
                                                                  <div class="content-inner">{{$productcategry->name}}</div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      @endforeach

                                                      <!-- <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/oil-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Oils </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/honey-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Honey</div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/shilaji-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Shilajit </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/powder-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Powders</div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/arthritis-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Ghee </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li> -->
                  
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="product-dropdown"> <a href="#">Health <i class="fa-solid fa-chevron-right"></i> </a>
                                    
                                       <div class="product-dropdown-area  product-dropdown-area2">
                                             <div class="product-paneContent">
                                                <div class="product-paneContent">
                                                   <ul class="main-items">
                                                   @foreach($concerns as $key => $concern)
                                                      <li>
                                                         <a href="{{url('shop')}}/shop-by-concern/{{$concern->slug}}">
                                                            <div class="child-items">
                                                               <div class="img">  
                                                                  <!-- <img src="{{url('public/images/immunity-icon.webp')}}" alt="logo"/>  -->
                                                                  <img src="{{ asset('public/' . $concern->image) }}" alt="Slider" loading="lazy"/>
                                                               </div>
                                                               <div class="content">
                                                                  <div class="content-inner">{{$concern->title}}</div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      @endforeach

                                                      <!-- <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/liver-care.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Liver Care  </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/gut-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Gut Health</div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/immunity-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Skin Care </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/skil-care.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Hair Care</div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/arthritis-icon.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Arthritis </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/health-care.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Heart Health </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/weight-care.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Weight Loss </div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li>
                                                      <li>
                                                         <a href="#">
                                                            <div class="child-items">
                                                               <div class="img">  <img src="{{url('public/images/kidney-care.webp')}}" alt="logo"/> </div>
                                                               <div class="content">
                                                                  <div class="content-inner">Kidney Health</div>
                                                               </div>
                                                            </div>
                                                         </a>
                                                      </li> -->
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                    
                                    </li>
                                       <li> <a href="{{ url('/') }}#top-sell">Top Selling</a></li>
                                       <li> <a href="javascript:void(0)"  data-toggle="modal" data-target="#bulkbuy">Bulk Order</a></li>
                                       <li> <a  href="{{ url('blog') }}">Blogs</a></li>
                                       <li> <a  href="{{ url('contact-us') }}">Contact</a></li>
                                       
                                    </ul>
                                 </div>
                              </div>
                           
                              
                           </div>
                        </div>
                     </div>

             
                  </div>
                  <div class="col-8 col-sm-8  col-md-9 col-lg-2">
                     <div class="header-admin">
                        <ul>
                           {{-- <span>Log in</span> --}}
                           <!-- <li class="mnobile-search">
                              <a   href="#">
                              <img src="{{url('public/images/mobile-search.png')}}" alt="Profile" loading="lazy"/></a>
                              </li> -->
                           <li class="login-icon">
                              <a  href="#">
                              <img src="{{url('public/images/profile-iconn.webp')}}" alt="Profile" loading="lazy"/>
                              </a>
                              <div class="dropdown-login">
                                 <?php
                                    $loggedinusername = '';
                                    $loggedinuseracctype = '';
                                    if (!empty(session('loggedinusername'))) {
                                       $loggedinusername = session('loggedinusername');
                                       $loggedinuseracctype = session('loggedinuseracctype');
                                    }
                                    ?> 
                                 @if(Auth::check())
                                 <div class="profile-dropdown profile-after-login">
                                    <div class="profile-inner">
                                       <div class="profile-items">
                                          <div class="icon">
                                             <img src="{{url('public/images/header-profile-icon.webp')}}" alt="Profile" />
                                          </div>
                                          <div class="content">
                                             <h4>Hi, {{@Auth::user()->name ? @Auth::user()->name : 'Guest'}} !</h4>
                                             @if (Auth::check() && Auth::user()->role == '1')
                                             <a href="{{ url('admin/home') }}">
                                                <p>Dashboard</p>
                                             </a>
                                             
                                             
                                             @else
                                             <a href="{{ url('/user/profile') }}">
                                                <p>View Profile</p>
                                             </a>
                                             <a  href="https://www.delhivery.com/tracking" target="_blank"><p>Track Your Order</p></a>
                                             @endif
                                             
                                          </div>
                                       </div>
                                       <div class="border-sec">
                                       </div>
                                       <div class="logout-wraps">
                                          <a href="javascript::void(0)" onclick="signOut('{{ $loggedinuseracctype }}');"> Logout</a>
                                       </div>
                                    </div>
                                 </div>
                                 @else
                                 <ul>
                                    <li><a data-toggle="modal" data-target="#loginModel"  href="#">Login</a></li>
                                 </ul>
                                 @endif
                              </div>
                           </li>
                           <li>
                              <a href="{{ url('add-to-cart') }}">
                                 <img src="{{url('public/images/shop-icon.webp')}}" alt="Shop" loading="lazy"/>
                                 @if(Auth::check())
                                 <div class="head-count" id="cart_counter_id">@if($cart_count) {{$cart_count}} @else 0 @endif</div>
                                 @endif
                              </a>
                           </li>
                           <li>
                              <a href="{{ url('wishlist') }}">
                                 <img src="{{url('public/images/heart-icon.webp')}}" alt="Heart" loading="lazy"/>
                                 @if(Auth::check())
                                 <div class="head-count" id="wish_counter_id">@if($wish_count) {{$wish_count}} @else 0 @endif</div>
                                 @endif
                              </a>
                           </li>
                        </ul>
                        <div class="hamburger-icon" id="hamburger-icon">
                           <span class="line"></span>
                           <span class="line"></span>
                           <span class="line"></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       
         
      </div>
   </header>
   <!-- <div class="mobile-menu menu " id="overlay">
      <div class="bigmenu-content">
         <div class="bigmenu-content-left">
            <div class="bigmenu-image-box">
               <img src="{{url('public/images/mobile-menu.webp')}}" alt="Profile" loading="lazy" />
            </div>
         </div>
         <div class="bigmenu-content-right">
    
            <a class="hamburger-menu hamburger-icon toogle-line">
               <label for="check" aria-label="check" class="menu-button wrapper-menu ">
                  <input type="checkbox" aria-label="checkbox" id="check"> 
                  <div class="line-menu half start"></div>
                  <div class="line-menu"></div>
                  <div class="line-menu half end"></div>
               </label>
            </a>
            <ul class="bigmenu-main-link">
               <li><a href="/"  data-src="{{url('public/images/home-menu1.webp')}}">Home</a></li>
               <li><a href="{{ url('about-us') }}" data-src="{{url('public/images/mobile-menu.webp')}}">About Us</a></li>
               <li>
                  <a href="{{ url('shop') }}" data-src="{{url('public/images/homne-meu-product.webp')}}">Our Products</a>
                  <div class="bigmenu-innerlinks">
                     <a href="https://www.aayurja.com/shop/gucchi-mushroom">Guchhi Mushroom</a> 
                     <a href="https://www.aayurja.com/shop/honey">Honey</a> 
                     <a href="https://www.aayurja.com/shop/shilajit">Shilajit</a>  
                     <a href="https://www.aayurja.com/shop/kesar">Kesar</a>
                  </div>
               </li>
               <li><a href="{{ url('blog') }}" data-src="{{url('public/images/home-menu-blog.webp')}}">Blogs</a></li>
               <li><a href="{{ url('contact-us') }}" data-src="{{url('public/images/home-menu-contact.webp')}}">Contact Us</a></li>
            </ul>
            <div class="menu-foot">
               <ul class="list-inline menu-terms">
                  <li><a href="{{ url('terms-and-conditions') }}" >Terms & Condition</a></li>
                  <li><a href="{{ url('privacy-policy') }}" >Privacy Policy</a></li>
                  <li><a href="{{ url('shipping-policy') }}" >Shipping Policy</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div> -->


   <div class="new-mobile-menu" id="overlay-menu">

   <div class="mobile-navbar">
      <div class="container">
      <ul class="mobile-items">
         <li><a href="{{ url('about-us') }}">About Us </a></li>
         <li class="mobile-dropdown">
            <a href="#">Products</a>
            <span class="toggle-arrow"></span>
               <div class="mobile-dropdown-menu ">
                  <ul class="dropdown-inner">

                     @foreach($productcategry_list as $key => $productcategry)
                        <li><a href="{{url('/shop/'.$productcategry->slug)}}">  <span> <img src="{{url('public/uploads/productcategory/' .$productcategry->image)}}" alt="Slider" loading="lazy" /> </span>{{$productcategry->name}}</a></li>
                     @endforeach
                        <!-- <li><a href="#"> <span><img src="{{url('public/images/oil-icon.webp')}}" alt="logo"/> </span>  Oils</a></li>
                        <li><a href="#"> <span><img src="{{url('public/images/honey-icon.webp')}}" alt="logo"/> </span> Honey</a></li>
                        <li><a href="#"> <span> <img src="{{url('public/images/shilaji-icon.webp')}}" alt="logo"/></span> Shilajit</a></li>
                        <li><a href="#"> <span> <img src="{{url('public/images/powder-icon.webp')}}" alt="logo"/> </span> Powders</a></li>
                        <li><a href="#"> <span> <img src="{{url('public/images/arthritis-icon.webp')}}" alt="logo"/></span> Ghee</a></li> -->
                   </ul>
               </div>
         </li>
         <li class="mobile-dropdown"><a href="#">Health</a>
            <span class="toggle-arrow"></span>



            <div class="mobile-dropdown-menu ">
                  <ul class="dropdown-inner">
                     @foreach($concerns as $key => $concern)
                        <li><a href="{{url('shop')}}/shop-by-concern/{{$concern->slug}}">  <span> <img src="{{ asset('public/' . $concern->image) }}" alt="Slider" loading="lazy"/> </span>{{$concern->title}}</a></li>
                     @endforeach
                        <!-- <li><a href="#"> <span><img src="{{url('public/images/liver-care.webp')}}" alt="logo"/></span>  Liver Care</a></li>
                        <li><a href="#"> <span><img src="{{url('public/images/gut-icon.webp')}}" alt="logo"/> </span>Gut Health</a></li>
                        <li><a href="#"> <span> <img src="{{url('public/images/immunity-icon.webp')}}" alt="logo"/> </span> Skin Care </a></li>
                        <li><a href="#"> <span> <img src="{{url('public/images/skil-care.webp')}}" alt="logo"/> </span> Hair Care</a></li>
                        <li><a href="#"> <span><img src="{{url('public/images/arthritis-icon.webp')}}" alt="logo"/></span> Arthritis</a></li>
                        <li><a href="#"> <span><img src="{{url('public/images/health-care.webp')}}" alt="logo"/> </span> Heart Health </a></li>
                        <li><a href="#"> <span><img src="{{url('public/images/weight-care.webp')}}" alt="logo"/></span> Weight Loss  </a></li>
                        <li><a href="#"> <span>  <img src="{{url('public/images/kidney-care.webp')}}" alt="logo"/> </span> Kidney Health  </a></li> -->
                  </ul>
            </div>


         </li>
         <li><a href="{{ url('/') }}#top-sell">Top Selling</a></li>
         <li><a href="javascript:void(0)"  data-toggle="modal" data-target="#bulkbuy">Bulk Order</a></li>
         <li><a href="{{ url('blog') }}">Blogs</a></li>
         <li><a href="{{ url('contact-us') }}" >Contact</a></li>
      </ul>
      </div>
   </div>
</div>