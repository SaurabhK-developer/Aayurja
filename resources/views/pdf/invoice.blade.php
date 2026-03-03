<!DOCTYPE html>
<html>

<head>
    <title>JUST GO NUTRITION </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id"
        content="141028751110-2at5qr1kpp86fefao4lde0vd8f762de7.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" href="{{ url('in-en/website/bootstrap/4.1.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">
    <link href="{{ url('in-en/website/fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('in-en/website/css/slick.css') }}">
    <link rel="stylesheet" href="{{ url('in-en/website/css/slick-theme.css') }}">
    <!-- <link rel="stylesheet" href="css/header.css"> -->
    <link rel="stylesheet" href="{{ url('in-en/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('in-en/website/css/about.css') }}">
    <link rel="stylesheet" type="{{ url('in-en/website/text/css') }}" href="css/thanku.css">
    <link rel="stylesheet" href="{{ url('in-en/website/css/product-detail.css') }}">
    <link rel="stylesheet" href="{{ url('in-en/website/css/product-list.css') }}">
    <link rel="stylesheet" href="{{ url('in-en/website/assets/responsive.css') }}">
    <link rel="stylesheet" href="{{ url('in-en/website/css/blog.css') }}">
    <link rel="stylesheet" href="{{ url('in-en/website/css/trending.css') }}">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300&amp;display=swap" rel="stylesheet">
     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@100;300;400&display=swap"
        rel="stylesheet">

        <style type="text/css">
            .bill-section {
              width: 100%;
              height: auto;
              position: relative;
            }
      
            .bill-maindiv {
              width: 100%;
              height: auto;
              padding: 1rem 0px;
            }
      
            .bill-logo {
              width: 100%;
              height: auto;
              display: flex;
              justify-content: space-between;
            }
      
            .bill-logo1 {
              width: 70%;
              height: auto;
              text-align: left;
            }
      
            .bill-logo2 {
              width: 30%;
              height: auto;
              text-align: right;
            }
      
            .billed-logo .logo img {
              width: 100px;
              height: auto;
            }
      
            .bill-logo2 a {
              text-decoration: underline;
              color: #666;
              font-size: 15px;
              font-family: "Open Sans", sans-serif;
            }
      
            .bill-logo2 a:hover {
              text-decoration: underline;
              color: #666;
              font-size: 15px;
            }
      
            .border-div {
              margin-top: 4px;
              border-bottom: 2px solid #666;
            }
      
            .bill-list1 {
              width: 83% !important;
              height: auto;
            }
      
            .bill-list1-1 {
              width: 50%;
              height: auto;
            }
      
            .bill-list1-2 {
              width: 50%;
              height: auto;
            }
      
            .bill-list1 p {
              font-size: 16px;
              line-height: 24px;
              font-family: "Open Sans", sans-serif;
              color: #000;
              font-weight: 400;
              opacity: 75%;
            }
      
            .bill-list1 a {
              font-size: 16px;
              line-height: 24px;
              font-family: "Open Sans", sans-serif;
              color: #000;
              font-weight: 400;
            }
      
            .bill-ship {
              width: 100%;
              height: auto;
              margin-top: 8px;
              margin-bottom: 12px;
            }
      
            .bill-list1 .table th {
              padding: 0rem;
            }
      
            .bill-ship-1 {
              width: 50%;
              height: auto;
            }
      
            .bill-ship-1 {
              width: 50%;
              height: auto;
            }
      
            .bill-ship-2 {
              width: 50%;
              height: auto;
            }
      
            .bill-ship h2 {
              font-size: 15px;
              line-height: 23px;
              font-family: "Open Sans", sans-serif;
              color: #000;
              font-weight: 400;
              text-decoration: none;
            }
      
            .bill-ship p {
              font-size: 14px;
              line-height: 14px !important;
              font-family: "Open Sans", sans-serif;
              color: #000;
              font-weight: 400;
              opacity: 75%;
              margin-bottom: 0px;
            }
      
            .order-table h2 {
              font-size: 18px;
              font-family: "Open Sans", sans-serif;
              color: #000;
              font-weight: 400;
            }
      
            .order-table p {
              font-size: 16px;
              font-family: "Open Sans", sans-serif;
              color: #000;
              font-weight: 400;
              opacity: 75%;
            }
      
            .bill-ship-1-inner2 {
              width: 350px;
              height: auto;
            }
      
            .bill-ship-1-inner2,
            .bill-ship-2-inner2 {
              margin-top: 22px;
            }
      
            .bill-ship-1-inner2 h2,
            .bill-ship-2-inner3 h2,
            .bill-ship-2-inner2 h2 {
              line-height: 20px;
            }
      
            .bill-ship-1-inner2-row {
              width: 100%;
              height: auto;
              display: flex;
              justify-content: space-between;
            }
      
            .bill-ship-1-inner2-col1 {
              width: 50%;
              height: auto;
            }
      
            .bill-ship-1-inner2-col2 {
              width: 50%;
              height: auto;
            }
      
            .disclaimer {
              width: 100%;
              height: auto;
              margin-top: 2px;
            }
      
            .disclaimer h2 {
              font-size: 25px;
              line-height: 25px;
              color: #181818;
              font-weight: 600;
              font-family: "Open Sans", sans-serif;
            }
      
            .disclaimer h2 span {
              font-size: 16px;
              color: #000;
              font-weight: 500;
              font-family: "Open Sans", sans-serif;
            }
      
            .disclaimer h2 span a {
              font-size: 16px;
              color: #000;
              font-weight: 300;
              text-decoration: none;
              font-family: "Open Sans", sans-serif;
            }
      
            .disclaimerh2 span a:hover {
              font-size: 16px;
              color: #000;
              font-weight: 300;
              text-decoration: none;
            }
      
            .disclaimer p {
              font-size: 16px;
              color: #000;
              font-weight: 400;
              font-family: "Open Sans", sans-serif;
            }
      
            div .table.table-bordered td,
            .table-bordered th {
              border: 2px solid #403f3f;
              font-size: 16px;
              line-height: 26px;
              color: #000;
              font-family: "Open Sans", sans-serif;
              font-weight: 400;
            }
      
            .order-num {
              padding-left: 45px !important;
            }
      
            .inner-table .table {
              width: 66%;
              height: 0;
              padding: 0px 0px;
            }
      
            .bill-table2 {
              width: 86.5%;
              height: auto;
            }
      
            .bill-table2 .table th {
              padding: 0rem;
            }
      
            .order-table {
              width: 1168px;
              height: auto;
              margin-top: 22px;
            }
      
            .inner-table .table th {
              padding: 0rem;
            }
      
            .order-table .table th {
              padding: 0rem;
            }
      
            .order-table1 {
              width: 57.3% !important;
              height: auto !important;
            }
      
            .order-table2 {
              width: 43.7% !important;
              height: auto !important;
            }
      
            #order-table1-ul {
              width: 100% !important;
            }
      
            .ship-tab {
              line-height: 5px !important;
            }
      
            .order-table2 p {
              line-height: 5px !important;
              margin-bottom: 0px !important;
            }
      
            .order-table2 ul {
              margin-top: -2px !important;
            }
      
            .ca-price {
              padding-left: 106px !important;
            }
      
            .ca-price2 {
              padding-left: 102px !important;
            }
      
            .ca-price3 {
              padding-left: 61px !important;
            }
      
            .ca-price4 {
              padding-left: 44px !important;
            }
      
            .ca-price5 {
              padding-left: 60px !important;
            }
      
            #list-table {
              width: 100% !important;
            }
      
            @media (min-width: 1500px) and (max-width: 1680px) {
              .bill-shiplist {
                width: 62.9%;
              }
      
              .bill-shiplis2-li1 {
                width: 18%;
              }
      
              .bill-shiplis2-li2 {
                width: 50.5%;
              }
      
              .order-table {
                width: 1250px;
                height: auto;
              }
      
              .bill-table2 {
                width: 86.5%;
                height: auto;
              }
      
              #order-table1-ul {
                width: 78% !important;
              }
            }
      
            @media screen and (min-width: 1920px) and (max-height: 1200px) and (orientation: landscape) {
              .bill-shiplist {
                width: 63%;
              }
      
              .bill-shiplis2-li1 {
                width: 18%;
              }
      
              .bill-shiplis2-li2 {
                width: 50%;
              }
      
              .order-table {
                width: 1250px;
                height: auto;
                margin-top: 22px;
              }
      
              .bill-table2 {
                width: 86.5%;
                height: auto;
              }
      
              #order-table1-ul {
                width: 60% !important;
              }
            }
      
            @media screen and (min-width: 1900px) and (max-height: 1080px) and (orientation: landscape) {
              .bill-shiplist {
                width: 63%;
              }
      
              .bill-shiplis2-li1 {
                width: 18%;
              }
      
              .bill-shiplis2-li2 {
                width: 50%;
              }
      
              .order-table {
                width: 1250px;
                height: auto;
                margin-top: 22px;
              }
      
              .bill-table2 {
                width: 88%;
                height: auto;
              }
            }
      
            @media screen and (min-width: 2560px) and (max-height: 1600px) and (orientation: landscape) {
              .bill-shiplist {
                width: 63%;
              }
      
              .bill-shiplis2-li1 {
                width: 18%;
              }
      
              .bill-shiplis2-li2 {
                width: 50%;
              }
      
              .order-table {
                width: 1250px;
                height: auto;
                margin-top: 22px;
              }
      
              .bill-table2 {
                width: 86.5%;
                height: auto;
              }
      
              #order-table1-ul {
                width: 55% !important;
              }
            }
      
            @media (min-width: 1023px) and (max-width: 1024px) {
              .bill-shiplist {
                width: 61%;
              }
      
              .bill-shiplis2-li2 {
                width: 56%;
              }
      
              .order-table {
                width: 974px;
                height: auto;
                margin-top: 22px;
              }
            }
      
            @media (min-width: 767px) and (max-width: 768px) {
              .bill-logo1 {
                width: 80%;
              }
      
              .bill-logo2 {
                width: 20%;
                height: auto;
              }
      
              .bill-shiplist {
                width: 67%;
              }
      
              .bill-shiplis2-li1 {
                width: 30%;
              }
      
              .bill-shiplis2-li2 {
                width: 56%;
              }
      
              .bill-ship-1-inner2 {
                width: 325px;
                height: auto;
              }
      
              .order-table {
                width: 725px;
                height: auto;
                margin-top: 22px;
              }
      
              .inner-table .table {
                width: 85%;
                height: 0;
                padding: 0px 0px;
              }
      
              .order-table1 {
                width: 68.3% !important;
                height: auto !important;
              }
            }
      
            @media (max-width: 575px) {
              .bill-list1 {
                width: 100%;
                display: block;
                margin-top: 25px;
              }
      
              .bill-ship {
                width: 100%;
                height: auto;
                margin-top: 22px;
                display: block;
                margin-bottom: 22px;
              }
      
              .bill-ship-1 {
                width: 100%;
                height: auto;
              }
      
              .bill-ship-1-inner2 {
                width: 100%;
                height: auto;
              }
      
              .bill-ship-2 {
                width: 100%;
                height: auto;
              }
      
              .bill-list1-2 {
                width: 100%;
                height: auto;
                margin-bottom: 18px;
              }
      
              .bill-list1-1 {
                width: 100%;
                height: auto;
                margin-bottom: 13px;
              }
      
              .bill-list1-2 p,
              .bill-list1-1 p {
                margin-bottom: 0px;
              }
      
              .order-table {
                width: 100%;
                height: auto;
                margin-top: 22px;
              }
      
              .order-table p {
                font-size: 13px;
                font-family: "Open Sans", sans-serif;
                color: #000;
                font-weight: 400;
                opacity: 75%;
              }
      
              .order-table h2 {
                font-size: 15px;
                font-family: "Open Sans", sans-serif;
                color: #000;
                font-weight: 400;
              }
      
              .order-table1 {
                width: 87.3% !important;
                height: auto !important;
              }
      
              .order-table2 {
                width: 95.7% !important;
                height: auto !important;
              }
      
              .ship-tab {
                line-height: 22px !important;
              }
            }
      
            @media only screen and (-webkit-min-device-pixel-ratio: 3) {
              .bill-list1 {
                width: 100%;
                display: block;
                margin-top: 25px;
              }
      
              .bill-shiplist {
                width: 100%;
              }
      
              .bill-shiplis2 {
                width: 100%;
                display: block;
              }
      
              .bill-logo1 {
                width: 80%;
                padding-bottom: 10px;
              }
      
              .bill-logo2 {
                width: 20%;
                height: auto;
              }
      
              .bill-list1-2 {
                width: 100%;
                height: auto;
                margin-bottom: 18px;
              }
      
              .bill-list1-1 {
                width: 100%;
                height: auto;
                margin-bottom: 13px;
              }
      
              .bill-list1-2 p,
              .bill-list1-1 p {
                margin-bottom: 0px;
              }
      
              .bill-ship-1 {
                width: 100%;
                height: auto;
              }
      
              .bill-ship-1-inner2 {
                width: 100%;
                height: auto;
              }
      
              .bill-ship-2 {
                width: 100%;
                height: auto;
              }
      
              .order-table {
                width: 100%;
                height: auto;
                margin-top: 22px;
              }
      
              .order-table p {
                font-size: 13px;
                font-family: "Open Sans", sans-serif;
                color: #000;
                font-weight: 400;
                opacity: 75%;
              }
      
              .order-table h2 {
                font-size: 15px;
                font-family: "Open Sans", sans-serif;
                color: #000;
                font-weight: 400;
              }
      
              .order-table1 {
                width: 87.3% !important;
                height: auto !important;
              }
      
              .order-table2 {
                width: 95.7% !important;
                height: auto !important;
              }
      
              .ship-tab {
                line-height: 22px !important;
              }
            }
      
            @media only screen and (max-width: 420px) {
              .bill-list1 {
                width: 100%;
                display: block;
                margin-top: 25px;
              }
      
              .bill-shiplist {
                width: 100%;
              }
      
              .bill-shiplis2 {
                width: 100%;
                display: block;
              }
      
              .bill-shiplis2-li1 {
                width: 68%;
              }
      
              .bill-logo1 {
                width: 80%;
                padding-bottom: 10px;
              }
      
              .bill-logo2 {
                width: 20%;
                height: auto;
              }
      
              .bill-list1-2 {
                width: 100%;
                height: auto;
                margin-bottom: 18px;
              }
      
              .bill-list1-1 {
                width: 100%;
                height: auto;
                margin-bottom: 13px;
              }
      
              .bill-list1-2 p,
              .bill-list1-1 p {
                margin-bottom: 0px;
              }
      
              .bill-ship-1 {
                width: 100%;
                height: auto;
              }
      
              .bill-ship-1-inner2 {
                width: 100%;
                height: auto;
              }
      
              .bill-ship-2 {
                width: 100%;
                height: auto;
              }
      
              .order-table {
                width: 100%;
                height: auto;
                margin-top: 22px;
              }
            }
          </style>
</head>

<body>

    <section class="bill-section">
        <div class="container">
            <div class="bill-maindiv">
                <div class="bill-logo">
                    <div class="bill-logo1">
                        <div class="billed-logo">
                            <a href="{{ url('/') }}" class="logo" tabindex="1">
                                <img src="{{asset('/public/justgoblack_logo.png')}}"><br>

                            </a>
                        </div>


                    </div>
                    <!--  bill-logo1 end -->
                    <div class="bill-logo2">
                        <!--<a href="javascript:void(0)" class="print-btn" onclick="export2Pdf()">Download PDF</a>-->
                    </div>
                    <!-- bill-logo2 end -->

                </div>
                <!--  bill-logo end -->
                <div class="border-div">
                    <div class="bill-list1" style="text-align: left!important;">

                        <table class="table table-borderless" style="margin-bottom: 0rem; width:92%;">
                            <thead>
                                <tr>
                                    <th>
                                        <p style="text-align:left!important; margin-bottom: 0px;">Order Number: <a
                                                href="#"
                                                style="text-decoration: none;"><b>{{ $orders[0]->order_id }}</b></a>
                                        </p>
                                    </th>
                                    <th>
                                        <p style="text-align:left!important; margin-bottom: 0px;">Date of Order:
                                            {!! date('d/m/Y', strtotime($orders[0]->created_at)) !!}</p>
                                    </th>

                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
                <!-- bill-list1 end   -->


                <div class="bill-ship justify-content-center">
                    <div class="bill-table2">
                        <table class="table" style="margin-bottom: 0rem; width: 98%!important;">

                            <tr>
                                <td>
                                    <h2 style="line-height:18px!important"><b>Shipping Address:</b></h2>
                                    <p style="line-height: 22px!important;">{{ $billinAdd->name ?? '' }}
                                        {{ $billinAdd->last_name ?? '' }}<br>
                                        Email: {{ $billinAdd->email ?? '' }} <br>
                                        Phone: {{ $billinAdd->mobile ?? '' }} <br>
                                        Address: {{ $billinAdd->address ?? '' }} {{ $billinAdd->address2 ?? '' }}<br>
                                        {{ $billinAdd->city ?? '' }}, {{ $billinAdd->state ?? '' }}
                                        {{ $billinAdd->pin_code ?? '' }}<br>
                                        ({{ $billinAdd->country ?? '' }})</p>


                                </td>
                                <td>
                                    <h2 style="line-height:8px!important"><b>Billing Address:</b></h2>
                                    <p style="line-height: 22px!important;">{{ $billinAdd->name ?? '' }}
                                        {{ $billinAdd->last_name ?? '' }}<br>
                                        Email: {{ $billinAdd->email ?? '' }} <br>
                                        Phone: {{ $billinAdd->mobile ?? '' }} <br>
                                        Address: {{ $billinAdd->address ?? '' }} {{ $billinAdd->address2 ?? '' }}<br>
                                        {{ $billinAdd->city ?? '' }}, {{ $billinAdd->state ?? '' }}
                                        {{ $billinAdd->pin_code ?? '' }}<br>
                                        ({{ $billinAdd->country ?? '' }})</p>
                                </td>

                            </tr>


                        </table>

                        <table class="table" style="margin-bottom: 0rem;" id="list-table">
                            <?php
                            $subtotal = 0;
                            ?>
                            @foreach ($all_product as $cart)
                            <?php
                            $subtotal += $cart->item_price_by_weight * $cart->quantity;
                            ?>
                            @endforeach
                            <tr>
                                <td style="width:50%;">
                                    <h2 style="    font-size: 15px;
                                    line-height: 23px;"><b>Order Totals:</b></h2>
                                    <p style="line-height: 20px!important;">Subtotal <span id="subtotal"
                                            class="ca-price">INR {{ (int) $subtotal }}</span></p>
                                    <p style="line-height: 20px!important;">Shipping <span id="shipping"
                                            class="ca-price2">INR
                                             0.00</span></p>
                                    <p style="line-height: 20px!important;">Duties & Taxes <span id="tax"
                                            class="ca-price3">INR 0.00</span></p>
                                    <p style="line-height: 20px!important;">Coupon Discount <span id="discount"
                                            class="ca-price4">INR 0.00</span></p>
                                    <p style="font-size:15px; opacity: 100%; line-height: 22px!important;"><b>Order
                                            Totals:<span id="grandtotal" class="ca-price5">INR
                                                {{ $subtotal }}</span></b></p>

                                </td>
                                <td style="width:50%;">
                                    <h2 style="font-size: 15px;
                                    line-height: 23px;"><b>Payment:</b></h2>
                                    <p style="line-height: 20px!important;">{{ $card_type }}</p>
                                    <p style="font-size:15px; opacity: 100%; line-height: 23px!important;"><b>Shipping
                                            Method/Tracking Info</b></p>
                                    <p style=" font-size:15px; opacity: 100%; line-height: 23px!important;">Standard Shipping</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                                <div class="table-div table-responsive" style="width:100%!important;margin-top: 11rem;">
                                    <h2>PRODUCTS</h2>
                                    <table class="table table-bordered" style="width:100%!important">
                                        <thead>
                                            <tr style="background: #e5e5e5;">

                                                <td scope="col" colspan="7" class="order-num"
                                                    style="font-size:20px; font-weight: 600;">Order Number:
                                                    {{ $orders[0]->order_id }}</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">#</th>

                                                <td scope="col" style="font-weight: 600;">Item</td>
                                                <td scope="col" style="font-weight: 600;">Flavour</td>
                                                <td scope="col" style="font-weight: 600;">Weight</td>
                                                <td scope="col" style="font-weight: 600; text-align: center;">Price</td>
                                                <td scope="col" style="font-weight: 600; text-align: center;">Qty</td>
                                                <td scope="col" style="font-weight: 600; text-align: center;">Subtotal</td>
                                            </tr>

                                        </thead>
                                        <tbody>
                                          @if (count($all_product))
                                              @foreach ($all_product as $key => $rows)
                                                  <tr>
                                                      <th scope="row">{{ $key+1 }}</th>
                                                      <td>{{ $rows->product->product_name ?? '' }}</td>
                                                      <td>{{ $rows->flavour ?? '' }}</td>
                                                      <td>{{ $rows->product_weight->size ?? '' }}</td>
                                                      <td style="text-align: center;">INR {{ $rows->item_price_by_weight ?? '' }}</td>
                                                      <td style="text-align: center;">{{ $rows->quantity ?? '' }} </td>
                                                      <td style="text-align: center;">INR {{ $rows->item_price_by_weight * $rows->quantity ?? '' }}</td>
                                                  </tr>
                                              @endforeach
                                          @endif
                                        </tbody>
                                    </table>
                                </div>

                <div class="disclaimer">

                    <p class="disc-p" style="text-align: center;"> Thank you for shopping with us!</p>

                    <p class="disc-r" style="text-align:center;"><b>Mango Nutraceuticals Pvt Ltd </b><br>
                    Plot No : GR - 166B-167A, GDIA, Bahadurgarh, Distt. Jhajjar, Haryana - 124507<br>
                        <a href="mailto:Contact@justgo.com"
                            style="text-decoration: none; color:#000;">Contact@justgo.com</a><br>
                    </p>

                </div>
            </div>
            <!-- bill-maindiv end -->
        </div>
    </section>
    <!-- bill-section end -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $('.header').addClass('sticky');
            } else {
                $('.header').removeClass('sticky');
            }
        });
    </script>
    <script>
        $(".customer_review_detail").slice(0, 1).show()
        $("#loadMore").on("click", function() {
            $(".customer_review_detail:hidden").slice(0, 1).slideDown()
            if ($(".customer_review_detail:hidden").length == 0) {
                $("#loadMore").fadeOut('slow')
            }
        })
    </script>
    <script src="{{ url('in-en/website/js/slick.min.js') }}"></script>
    <script src="{{ url('in-en/website/js/slider.js') }}"></script>
    <script src="{{ url('in-en/website/js/main.js') }}"></script>
    <script src="{{ url('in-en/website/bootstrap/4.1.3/js/bootstrap.min.js') }}"></script>

    <script>
        function onSignIn(googleUser) {
            // Useful data for your client-side scripts:
            var profile = googleUser.getBasicProfile();
            console.log("ID: " + profile.getId()); // Don't send this directly to your server!
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());
            window.location = "/";
            console.log('Check1');
            // The ID token you need to pass to your backend:
            var id_token = googleUser.getAuthResponse().id_token;
            // console.log("ID Token: " + id_token);
            console.log('Check2');
        }

        $(document).ready(function() {

            $('#subtotal').text('INR' + $('#subtotalstore').val());
            $('#tax').text('INR' + parseFloat($('#taxstore').val()).toFixed(2));
            var discount = $('#discountstore').val();
            $('#discount').text('INR' + parseFloat(discount).toFixed(2));
            $('#grandtotal').text('INR' + $('#grandtotalstore').val());
            var shippingcharge = $('#shippingchargestore').val();
            $('#shipping').text('INR' + parseFloat(shippingcharge).toFixed(2));
        });

        const export2Pdf = async () => {

            let printHideClass = document.querySelectorAll('.print-hide');
            let orderid = $('#orderid').val();

            printHideClass.forEach(item => item.style.display = 'none');
            await fetch('https://www.muscletrail.com/in-en/vendor_admin/export-pdf?order_id=' + orderid, {
                method: 'GET'
            }).then(response => {
                if (response.ok) {
                    response.json().then(response => {
                        var link = document.createElement('a');
                        link.href = response;
                        link.click();
                        printHideClass.forEach(item => item.style.display = '');
                    });
                }
            }).catch(error => console.log(error));
        }
    </script>
</body>

</html>
