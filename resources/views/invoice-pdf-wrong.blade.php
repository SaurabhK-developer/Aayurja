<!DOCTYPE html>
<html>
   <head>
      <title>Aayurja</title>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap"
         rel="stylesheet" />
   </head>
   <style>
      ::selection {
      background: #52080c;
      color: #fff;
      }
      ::moz-selection {
      background: #52080c;
      color: #fff;
      }
      body {
    padding: 0px;
    margin: 0px;
    font-family: 'Plus Jakarta Sans' !important;
    overflow-x: hidden;
      }
      h1 {
      font-family: 'Plus Jakarta Sans' !important;
      font-size: 18px;
      margin: 0px;
      font-weight: 600;
      color: #000;
      }
      p {
      margin-top: 3px;
      font-family: 'Plus Jakarta Sans' !important;
      line-height: 1.4;
      font-size: 14px;
      color: rgb(0 0 0 / 61%);
      font-weight: 500;
      }
      .wrapper {
      width: 100%;
      /* border: 1px solid #000;
      margin: 10px 0; */
      }
      .wrapper .row .border-right {
      border-right: 1px solid #000;
      }
      .wrapper .col-sm-7 {
      width: 58.333333%;
      float: left;
      }
      .wrapper .col-sm-5 {
      width: 41.666667%;
      float: left;
      }
      .wrapper .col-sm-6 {
      width: 50%;
      float: left;
      }
      .wrapper .col-sm-6 {
      width: 50%;
      float: left;
      }
      .table>tbody>tr span {
      line-height: 1.4;
      font-size: 14px;
      color: rgb(0 0 0 / 61%);
      font-weight: 400;
      }
      /* .wrapper .row {
      border-bottom: 1px solid #000;
      } */
      .wrapper .table>tbody>tr b {
      display: block;
      color: #000;
      font-size: 14px;
      font-family: 'Plus Jakarta Sans';
      font-weight: 600;
      }
      .wrapper .table>tbody>tr .first {
      border-top: 0;
      }
      .wrapper .table>tbody>tr>td {
      border: 1px solid rgb(0 0 0 / 20%);
      padding: 5px 0 5px 10px;
      width: 50%;
      border-top: 0px solid rgb(0 0 0 / 20%);
      border-right: 0px;
      }
      .wrapper .table>tbody>tr:last-of-type>td {
      border-bottom: 0px solid #000;
      }
      .right-text {
      text-align: right;
      }
      .chart-amount p:first-of-type {
      margin-bottom: 0px;
      }
      .main-invoice-box {
      max-width: 900px;
      margin: auto;
      }
      .invoice-box {
      font-size: 14px;
      line-height: 24px;
      font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
      color: #555;
      border: 1px solid rgb(0 0 0 / 20%);
      border-radius: 15px;
      }
      .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
      border-bottom: solid 1px rgb(0 0 0 / 20%);
      }
      .invoice-box table td {
      /* padding: 5px; */
      vertical-align: middle;
      padding-bottom: 0px;
      color: #000;
      padding-top: 0px;
      }
      .invoice-box table tr td:nth-child(2) {
      text-align: left;
      }
      .invoice-box table tr.top table td.title {
      font-size: 45px;
      line-height: 45px;
      color: #333;
      }
      /* .invoice-box table tr.information table td {
      padding-bottom: 40px;
      } */
      .invoice-box table tr.heading td {
      background: #fff;
      border-bottom: 1px solid rgb(0 0 0 / 20%);
      font-weight: 600;
      font-size: 14px;
      text-align: center;
      padding: 10px 5px;
      border-right: 1px solid rgb(0 0 0 / 20%);
      font-family: 'Plus Jakarta Sans';
      }
      .invoice-box table tr.heading td:last-child {
      border-right: 0px solid #000;
      }
      .invoice-box table tr.details td {
      padding-bottom: 20px;
      }
      .invoice-box table tr.item td {
      border-bottom: 1px solid rgb(0 0 0 / 20%);
      padding: 10px 10px;
      border-right: 1px solid rgb(0 0 0 / 20%);
      line-height: 1.3;
      font-family: 'Plus Jakarta Sans';
      font-weight: 500;
      font-size: 13px;
      }
      .invoice-box table tr.item td:last-child {
      border-right: 0px solid #000;
      }
      .invoice-box table tr.item:last-child td {
      border-bottom: 0px solid #000;
      }
      .invoice-box table tr.item:last-child td b{
      text-align: left;
      display: block;
      }
      .invoice-box table tr.item.last td {
      border-bottom: none;
      }
      .invoice-box table tr.total td:nth-child(2) {
      border-top: 2px solid #eee;
      font-weight: bold;
      }
      .invoice-box .left-content strong{
      color:#000;
      }
      .invoice-box table tr td b{
      font-weight: 700;
      display: block;
      }
      .item td {
      text-align: center;
      }
      .left-content {
      padding: 15px 15px;
      }
      .information .left-content {
      border-right: 1px solid rgb(0 0 0 / 20%);
      }
      .invoice-box .chart-amount table {
      border-bottom: solid 0px #000;
      }
      td.Signature-top {
      border-top: 1px solid #000;
      border-left: 1px solid #000;
      }
      .Signature-text {
      height: 100%;
      width: 100%;
      min-height: 133px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      }
      .Signature-text b {
      padding-right: 9px;
      display: block;
      width: 100%;
      text-align: right;
      }
      .Signature-text p {
      width: 100%;
      margin: 0px;
      text-align: right;
      font-weight: 500;
      padding-right: 9px;
      }
      .invoice-box .bottom-row table {
      border-bottom: 0px solid #000;
      }
      .footer-text {
      text-align: center;
      padding: 10px 0px;
      }
      @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
      width: 100%;
      display: block;
      text-align: center;
      }
      .invoice-box table tr.information table td {
      width: 100%;
      display: block;
      text-align: center;
      }
      }
      /** RTL **/
      .rtl {
      direction: rtl;
      font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
      sans-serif;
      }
      .rtl table {
      text-align: right;
      }
      .rtl table tr td:nth-child(2) {
      text-align: left;
      }
      .main-invoice-box .left {
      width: 100%;
      text-align: center;
      margin-bottom: 0px;
      position: relative;
      }
      .top-text b {
      font-family: 'El Messiri', sans-serif;
    font-size: 40px;
    display: block;
    line-height: 1;
    margin-bottom: -11px;
      }
      .main-invoice-box .right span {
      display: block;
      text-align: right;
      text-transform: uppercase;
      }
      .top-text {
      padding: 20px 0px;
      }
      .invoice-box .main-table{
      border-bottom:0px;
      }
      .main-in-box {
      margin: auto;
      }
      .logo-area {
      text-align: center;
      padding: 4px 0px;
      }
      .logo-area img{
      width: 172px;
      }
      .service-col {
      width: 20%;
      float: left;
      }
      .service-section .service-inner {
      text-align: center;
      }
      .service-section .icon {
      width: 30px;
      margin: 0 auto;
      margin-bottom: 15px;
      }
      .service-section h2 {
    font-size: 18px;
    font-family: 'Plus Jakarta Sans';
    margin-bottom: 8px;
    font-weight: 500;
      }
      .service-inner p {
      margin: 0px;
      font-size: 13px;
      color: rgb(0 0 0 / 90%);
      }
      .service-section .container{
      max-width: 1140px;
      width: 100%;
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
      }
      .service-section .icon img{
      display: block;
      max-width: 100%;
      width: 100%;
      height: auto;
      }
      .clearfix::after {
      content: "";
      clear: both;
      display: table;
      }
      .service-section {
      padding: 40px 0px;
      background-image:url("public/images/invoice-bg.png");
      margin-top: 50px;
      background-size: cover;
      }
      .main-voice-box {
      position: relative;
      }	
      .invoice-vector1 {
      position: absolute;
      width: 50px;
      top: 8%;
      }
      .wrapper .left-content p{
      font-size: 13px;
      }
      .invoice-vector3 {
      position: absolute;
      width: 80px;
      right: 0px;
      bottom: -76px;
      }
      .invoice-vector2 {
     position: absolute;
    width: 150px;
    left: -57px;
    bottom: -76px;
      }
      .bottom-lefts p{
      color: rgb(0 0 0 / 90%);
      }
      .left-content.bottom-lefts {
      padding-bottom: 0px;
      }
      .service-inner.second-inner .icon{
		  
		      width: 36px;
	  }
	  
      .bottom-sign {
      height: 126px;
      border-top: solid 1px rgb(0 0 0 / 20%);
      border-left: solid 1px rgb(0 0 0 / 20%);
      }
   </style>
   <body>
      <div class="main-in-box">
         <div class="header-section">
            <div class="logo-area">
               <a href="/">
               <img src="{{url('public/images/invoice-logo.png')}}" alt="Banner">
               </a>
            </div>
         </div>
         <div class="main-voice-box">
            <img src="{{url('public/images/invoice-vector1.png')}}" class="invoice-vector1"  alt="Banner">
            <div class="main-invoice-box">
               <div class="top-text clearfix">
                  <div class="left">
                     <b>Tax Invoice</b>
                     <img src="{{url('public/images/invoice-bg3.png')}}" class="invoice-border"  alt="Banner">
                  </div>
               </div>
               <div class="invoice-box">
                  <table class="main-table" cellpadding="0" cellspacing="0">
                     <tr class="top">
                        <td colspan="3">
                           <div class="wrapper">
                              <div class="row clearfix">
                                 <div class="col-sm-5">
                                    <div class="left-content">
                                       <h1>M/S Ritesh Mishra</h1>
                                       <p>
                                          Sarafa Chowk Ramnagar Distt Nainital </br> GSTIN/UIN:
                                          05AHHPG0854G1Z0 </br> State Name:Uttrakhand, Code:05 </br>CIN:
                                          MRTS10447D
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-sm-7 padding-0">
                                    <table class="table" cellspacing="0" cellpadding="10">
                                       <tbody>
                                          <tr>
                                             <td class="first">
                                                <span>Invoice No</span>
                                                <b></b>
                                             </td>
                                             <td class="first">
                                                <span>Dated</span>
                                                <b>{{@$orders->created_at}}</b>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <span>Refrences No & Date</span>
                                                <b>915 dt. 3-jul-24 </b>
                                             </td>
                                             <td>
                                                <span>Other Refrences</span>
                                                
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="last">
                                                <span> Order No</span>
                                               <b> {{@$orders->order_id}}</b>
                                             </td>
                                             <td class="last">
                                                <span>Dated</span>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr class="information">
                        <td colspan="3">
                           <table>
                              <tr>
                                 <td width="41.2%">
                                    <div class="left-content">
                                       <h1>{{@$orders->customer_name}}</h1>
                                       <p>
                                          Shipping Address: <b>{{@$orders->shipping_address}}</b>
                                          {{@$orders->customer_phone}} {{@$orders->customer_email}}
                                       </p>
                                    </div>
                                 </td>
                                 <td width="57%"></td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                     <tr></tr>
                     <tr>
                        <td colspan="3">
                           <table cellspacing="0px" cellpadding="2px">
                              <tr class="heading">
                                 <td style="width: 7%">S.No</td>
                                 <td style="width: 25%">Description Of Goods</td>
                                 <td style="width: 10%">Size</td>
                                 <td style="width: 10%">GST </br> Rate</td>
                                 <td style="width: 10%">Quantity</td>
                                 <td style="width: 15%">Rate</td>
                                 <td style="width: 15%">Rate</td>
                                 <td style="width: 15%">Per</td>
                                 <td style="width: 15%">Amount</td>
                              </tr>
                              @foreach($allOrderDetails as $key => $allOrderDetail)
                              <tr class="item">
                                 <td style="width: 2%">{{$key+1}}</td>
                                 <td style="width: 25%; text-align: left">
                                 {{@$allOrderDetail->product_name}}
                                 </td>
                                 <td style="width: 10%">{{$allOrderDetail->product_size}}</td>
                                 <td style="width: 10%">322.03</td>
                                 <td style="width: 10%">
                                    <b>{{@$allOrderDetail->product_quantity}}Pcs</b>
                                 </td>
                                 <td style="width: 10%">PCS</td>
                                 <td style="width: 15%">{{@$allOrderDetail->per_product_price}}</td>
                                 <td style="width: 15%">0</td>
                                 <td style="width: 15%">
                                 <b>
                              <?php
                                 $total = ($allOrderDetail->per_product_price*$allOrderDetail->product_quantity)
                                 ?>
                              {{$total}}
                              </b>
                                 </td>
                              </tr>
                              @endforeach
                              <tr class="item">
                                 <td style="width: 2%">2</td>
                                 <td style="width: 25%; text-align: left">
                                    <b>SGST</b>
                                    <b>CGST</b>
                                 </td>
                                 <td style="width: 10%"></td>
                                 <td style="width: 10%"></td>
                                 <td style="width: 10%"><b></b></td>
                                 <td style="width: 10%"></td>
                                 <td style="width: 15%"></td>
                                 <td style="width: 15%"></td>
                                 <td style="width: 15%">
                                    <b>0.00</b>
                                    <b>0.00</b>
                                 </td>
                              </tr>
                              <tr class="item">
                                 <td style="width: 2%">3</td>
                                 <td style="width: 25%"><b> Grand Total </b></td>
                                 <td  colspan="6"  style="width: 25%"></td>
                                 <td style="width: 15%"><b>{{@$orders->total}}</b></td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                     <tr class="top">
                        <td colspan="3">
                           <div class="wrapper">
                              <div class="row clearfix">
                                 <div class="col-sm-7">
                                    <div class="left-content  bottom-lefts">
                                       <p>Amount Charge table (in words)</p>
                                       <b>INR Three Thoushand Nine Hundred Ninty Nine only</b>
                                       <p>Company's PAN :<strong> RYGFV764GHHYT</strong></p>
                                       <p style="margin-bottom: 0px"><b>Declaration:</b></p>
                                       <p>
                                          We declare that this invoice shows the actual price of
                                          the goods described and all particulars are true and
                                          correct.
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-sm-5 padding-0">
                                    <div class="bottom-lefts" style="padding: 15px;    padding-right:0px;  padding-bottom: 0px;    height: 160px;">
                                       <p style="text-align: right;  padding-right:10px;">E &amp; O. E</p>
                                       <div class="bottom-sign">
                                          <div class="" style="text-align: right;    padding-right:15px;  margin-top: 60px;">
                                             <b>For Aayurja</b>
                                             <p>Authorized Signature</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                  </table>
               </div>
               <div class="footer-text">
               </div>
            </div>
            <img src="{{url('public/images/invoice-vector2.png')}}" class="invoice-vector2"  alt="Banner">
            <img src="{{url('public/images/invoice-vector3.png')}}" class="invoice-vector3"  alt="Banner">
         </div>
         <div class="service-section">
            <div class="container">
               <div class="service-row clearfix">
                  <div class="service-col">
                     <div class="service-inner">
                        <div class="icon">
                       
						    <img src="{{url('public/images/in-service-img1.png')}}"   alt="Seller">
                        </div>
                        <div class="content">
                           <h2>Real organic herbal</h2>
                           <p>
                              Natural ingredients without the use of synthetic chemicals,
                              pesticides.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="service-col">
                     <div class="service-inner second-inner">
                        <div class="icon">
						 <img src="{{url('public/images/in-service-img2.png')}}"   alt="Seller">
                          
                        </div>
                        <div class="content">
                           <h2>Original Product</h2>
                           <p>
                              100% Original product that covered warranty by the vendor.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="service-col">
                     <div class="service-inner">
                        <div class="icon">
                      		 <img src="{{url('public/images/in-service-img3.png')}}"   alt="Seller">
                        </div>
                        <div class="content">
                           <h2>30 Days Warranty</h2>
                           <p>You have the right to return your orders within 30 days.</p>
                        </div>
                     </div>
                  </div>
                  <div class="service-col">
                     <div class="service-inner">
                        <div class="icon">
                    		 <img src="{{url('public/images/in-service-img4.png')}}"   alt="Seller">
                        </div>
                        <div class="content">
                           <h2>Global Shipping</h2>
                           <p>Your orders are shipped seamlessly between countries.</p>
                        </div>
                     </div>
                  </div>
                  <div class="service-col">
                     <div class="service-inner">
                        <div class="icon">
                       		 <img src="{{url('public/images/in-service-img5.png')}}"   alt="Seller">
                        </div>
                        <div class="content">
                           <h2>100% Secure</h2>
                           <p>
                              Your payments are secure with our private security network.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>

