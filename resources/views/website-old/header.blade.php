<!DOCTYPE html>
<html>
   <head>
      @if (isset($seo))
      @foreach ($seo as $s)
      @if (Request::url() == $s->url)
      <title>{{ @$s->meta_title }}</title>
      <meta name="keywords" content="{{ @$s->keywords }}">
      <meta name="description" content="{{ @$s->description }}">
      <link rel="canonical" href="{{ @$s->canonical_tag }}">
      @if(@$s->product_schema!='')
      <script type="application/ld+json" defer async>
         <?php
            $str=@$s->product_schema;
            echo $str ?>
         
         
      </script>
      @endif
      @if(@$s->Faq_schema!='')
      <script type="application/ld+json" defer async>
         <?php
            $str=@$s->Faq_schema;
            echo $str 
            ?>
      </script>
      @endif
      @endif
      @endforeach
      @endif
      <META NAME="robots" CONTENT="noindex,nofollow">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/x-icon" href="{{url('website/images/favicon.png')}}" />
      <link rel="stylesheet" href="{{url('website/css/style.css')}}">
      <link rel="stylesheet" href="{{url('website/css/about.css')}}">
      <link rel="stylesheet" href="{{url('website/css/checkout.css')}}">
      <link rel="stylesheet" href="{{url('website/css/payment-failed.css')}}">
      <link rel="stylesheet" href="{{url('website/css/slick.css')}}">
      <link rel="stylesheet" href="{{url('website/css/slick-theme.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <link rel="stylesheet" href=
         "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      
      <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>

  </style>
   </head>
   <header class="header">
      <div class="header-top floating-text">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="ship marquee-section">
                     <marquee class="marquee" id="marquee" behavior="scroll" scrollamount="5">New Arrivals | Premium Quality | A Nutrition Value | Easy Returns | Extra Benefits</marquee>
                     <span class="pause_btn" id="btnStop"><i class="fa fa-pause" aria-hidden="true"></i></span>
                     <span class="play_btn" id="btnStart"><i class="fa fa-play" aria-hidden="true"></i></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- <div class="header-top">
         <div class="container">
            <div class="row">
               <div class="col-md-10">
                  <div class="ship">
                     <img src="{{url('website/images/arrow.png')}}" class="arrow-icon" alt="Arrow"> 
              <span>We've extended our return period to 60 days.	</span>
                  </div>
               </div>
               <div class="col-md-2  text-right">
                  <div class="email">
                     <img src="{{url('website/images/mail-p.png')}}" alt="Email" class="arrow-icon">
                     <a href="mailto:sayhello@justgo.com">sayhello@justgo.com</a>
                  </div>
               </div>
            </div>
         </div>
         </div>-->
      <div class="header-desktop">
         <div class="header-wrapper">
            <div class="container">
               <div class="row">
                  <div class="col-xl-7 col-lg-7 col-md-4 col-sm-4  header-left content-header">
                     <div class="header-logo">
                        <a href="{{url('/')}}">
                        <img src="{{url('website/images/header-logo.png')}}">
                        </a>
                     </div>
                     <div class=" header-menu">
                        <nav class="main-navigation">
                           <ul class="desktop-menu">
                        <li class="mega-drop-down has-submenu">
                                 <a href="{{url('/product')}}">Shop</a>
                              <div class="animated fadeIn mega-menu">
                                <div class="mega-menu-wrap">
                                     <div class="row">
                                      @foreach ($header_cat as $cat)
                                          @if (isset($cat->products))
                                          @if ($cat->products->count() > 0)
                                                      <div class="col-md-3">
                                                      <?php  $str =  strval($cat->id);
                                                         $id = base64_encode($str); ?>
                                                              <h4 class="mega-title"><a href="{{ url('product') }}?category={{ $id }}"> {{ $cat->name }}</a></h4>
                                                           <ul class="stander">
                                                               @foreach ($cat->products as $cat_product)
                                                                <li>
                                                                  <a href="{{ url('product') }}/{{ $cat_product->slug }}">{{ $cat_product->product_name }}</a>
                                                                </li>
                                                                @endforeach
                                                               
                                                            </ul>
                                                       </div>
                                                    @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                       </li>
                              <li><a href="{{url('/about')}}">About</a></li>
                              <li><a href="{{url('/what-fuels-you')}}">Fitness Goals</a> </li>
                              <li><a href="{{url('/blog')}}">Blogs</a></li>
                              <li><a href="{{url('/contact-us')}}">Contact</a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-5 col-lg-5 col-md-8 col-sm-8  header-right">
                     <div class="header-page-link">
                        <!--<div class="login-header">
                           <a id="modalOpen" class="active-login"  data-toggle="modal" data-target="#mobile_num_Popup" href="javascript:void(0)" >
                           <i class="fa fa-user-o" aria-hidden="true"></i></a>
                           </div>-->
                        <?php
                           $loggedinusername = '';
                           $loggedinuseracctype = '';
                           if (!empty(session('loggedinusername'))) {
                               $loggedinusername = session('loggedinusername');
                               $loggedinuseracctype = session('loggedinuseracctype');
                           }
                           // dd($loggedinusername);
                           ?>
                        <li class="dropdown menu_icon">
                           @if (empty($loggedinusername))
                           <a id="profile_icon" href="#">
                              <i class="fa fa-user" aria-hidden="true"></i>
                              <!-- <img src="{{ url('./website/images/mobile/icons/user.png') }}" class="menu_png_icon"> -->
                              {{ $loggedinusername ?? '' }}
                           </a>
                           <div class="dropdown-content">
                              <a onclick="loginprompt()" href="javascript:void(0)">Login</a>
                           </div>
                           @else
                           <?php
                              $userimage = Auth::user()->image;
                              ?>
                           <!-- <a id="profile_icon" href="#"><img src="{{ url('public/uploads') }}/{{ $userimage }}" style="height:47px;width:47px"> {{ $loggedinusername ?? '' }}</a> -->
                           <a id="profile_icon" href="#"><i class="fa fa-user"
                              aria-hidden="true"></i>@php $new_data = explode(" ",$loggedinusername) @endphp {{ $new_data[0] ?? '' }}</a>
                           <div class="dropdown-content">
                              @if (Auth::user()->role == '1')
                              <a href="{{ url('admin/home') }}">Dashboard</a>
                              @else
                              <a href="{{ url('./userdashboard') }}">
                                 <!-- <span class="bar"></span> -->Profile
                              </a>
                              <a href="{{ url('./my-order') }}">My Orders</a>
                              @endif
                              <a href="#" onclick="signOut('{{ $loggedinuseracctype }}');">
                                 <!-- <span class="bar"></span> -->Logout
                              </a>
                           </div>
                           @endif
                        </li>
                        <div class="wishlist-box">
                           @if(Auth::check())
                           <a href="{{url('/wishlist')}}">
                           <i class="fa fa-heart-o"></i></a>
                          <!-- <span class="wish-count">1</span>-->
                           <span class="wish-count" id="wish-count">@if($wish_count != null) {{$wish_count}} @else 0 @endif</span>
                           @else
                           <a data-toggle="modal" data-target="#mobilenumPopup" href="javascript:void(0)"><i class="fa fa-heart-o"></i></a>
                           @endif
                        </div>
                        <div class="search-box header-search">
                           <a href="#" class="search-toggle">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </a>
                        </div>
						
						
						
                        <div class="cart-box">
                           <a href="{{url('/add-to-cart')}}">
                              <div class="search-toggle">
                                 <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                 <span class="cart-count">@if($cart_count != null) {{$cart_count}} @else 0 @endif</span>
                              </div>
                           </a>
                        </div>
                        <div id="mobile-trigger"><span></span></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="mobile_menu">
         <div class=" mobile-header-menu">
            <div class="blank-space"></div>
            <nav class="main-navigation">
               <ul>
                  <li><a href="{{url('/product')}}">Shop</a></li>
                  <li><a href="{{url('/about')}}">About</a></li>
                  <li><a href="{{url('/what-fuels-you')}}">Fitness Goals</a> </li>
                  <li><a href="{{url('/blog')}}">Blogs</a></li>
                  <li><a href="{{url('/contact-us')}}">Contact</a></li>
               </ul>
            </nav>
            <div class="nav-close">
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
      </div>
      <div class="aside-overlay "></div>
   </header>
   
   
   <!---header search---->
						<div class="search_main_container">
						 <div class="button_container">
                                            <i class="fa fa-close" ></i>
                                        </div>
                            <div class="search-inner">
                                    <nav class="search-menu">
                                       
                                        <div class="container">
                                            <div class="row">
                                                <div class="search_main_div">
                                                    <form action="#">
                                                        <div class="ui-front form-group">
                                                            <input type="search" class="form-control search_data" id="search" placeholder="Search...." name="search" autocomplete="off">
                                                        
														</div>
                                                     
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </nav>
                                </div>
                            </div>
							
							 <!---header search---->
   <body>