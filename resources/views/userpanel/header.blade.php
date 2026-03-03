<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aayurja</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.css" />
    <link rel="stylesheet" href="{{url('public/userpanel/css/custom.css')}}" />
</head>

<body>
    <div class="userpanel-section">
        <div class="userpanel-main">
            <div class="userpanel-left">
                <div class="user-nav">
                    <div class="logo-top">
                        <div class="hamburger-icon" id="hamburger-icon">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                        <div class="header-log">
                            <a href="/">
                                <img src="{{url('public/userpanel/images/logo-panel.webp')}}" alt="Header Logo" />
                            </a>
                        </div>
                    </div>
                    <hr />
                    <div class="mobile-link">
                        <span class="aside-trigger"><span>Close</span> </span>
                        <ul>
                            <li class="active">
                                <a href="{{url('user/profile')}}">
                                    <img src="{{url('public/userpanel/images/admin-icon.webp')}}" alt="Admin Icon" /> My
                                    Profile
                                </a>

                            </li>
                            <li>
                                <a href="{{url('user/myorder')}}">
                                    <img src="{{url('public/userpanel/images/my-order.webp')}}" alt="My Order Icon" />
                                    My
                                    Order
                                </a>
                            </li>
                            <li>
                                <a href="{{url('user/address')}}">
                                    <img src="{{url('public/userpanel/images/my-adrress.webp')}}"
                                        alt="My Address Icon" />
                                    My Addresses
                                </a>
                            </li>
                            <li>
                                <a href="{{url('user/recent-view')}}">
                                    <img src="{{url('public/userpanel/images/recently-icon.webp')}}"
                                        alt="Recently Viewed Icon" />
                                    Recently Viewed
                                </a>
                            </li>


                            <li>
                                <a href="{{url('user/refer-and-earn')}}">
                                    <img src="{{url('public/userpanel/images/recently-icon.webp')}}"
                                        alt="Recently Viewed Icon" />
                                        Refer & Earn
                                </a>
                            </li>


                            <!-- <li>
                                <a href="{{url('user/blpl-cash')}}">
                                    <img src="{{url('public/userpanel/images/cash.webp')}}" alt="BLPN Cash Icon" /> BLPN
                                    Cash
                                </a>
                            </li> -->
                        </ul>
                        <div class="bottom-section">
                            <hr />
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="{{url('public/userpanel/images/admin-icon.webp')}}"
                                            alt="Logout Icon" />
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="userpanel-right">
    <div class="userpanel-vector">
        <img src="{{url('public/userpanel/images/user-vector1.webp')}}" class="vector1" alt="Logout Icon" />
        <img src="{{url('public/userpanel/images/user-vector2.webp')}}" class="vector2" alt="Logout Icon" />
        <img src="{{url('public/userpanel/images/user-vector3.webp')}}" class="vector3" alt="Logout Icon" />
        <div class="panel-main">
            <div class="user-dropdown">
                <div class="left-wrap">
                    <div class="left-icon">
                    <div class="left-icons">
                    @if(Auth::user()->profile != '')
                  <img src="{{ URL::to('/') }}/public/uploads/profile/{{ Auth::user()->profile }}" alt="Profile Photo" >
                  @else
                  <img src="{{url('public/userpanel/images/shradha-icon.png')}}" alt="User Icon">
                  @endif
                  </div>
                    </div>
                </div>
                
                
                <div class="right-wraps">
                    <ul>
                        <li class="dropdown">
                            <a class="link-btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ucwords(Auth::user()->name) }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Log out</a>
                               
                            </div>
                        </li>
                    </ul>
                </div>
            </div>