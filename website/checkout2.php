<?php include 'header.php'; ?>
<section class="checkout-wrapper payment-method-section">
   <div class="container">
   
   <h1 class="category-title">Choose Your Payment</h1>
      <div class="row  check-row">
         <div class="col-lg-7">
	
            <div class="checkout-left">
				   <div class="checkout-tabber">
               <div class="row">
                  <div class="col-md-6 col-lg-4">
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> 
                           <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">    <img src="images/card-icon.png" >Debit & Credit Card</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"> <img src="images/wallet.png" > Wallet</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"> <img src="images/upi.png" > UPI</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">  <img src="images/netbanking.png" > Net Banking</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">  <img src="images/cash-icon.png" >  Cash on Delivery</a>
                        </li>
                     </ul>
                  </div>
                  <div class="col-md-6 col-lg-8">
                     <!-- Tab panes -->
                     <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                           <div class="card-section">
                              <img src="images/visa-img.png">
                              <form class="check-form" action="#" method="post" id="addressform">
                                 <div class="row clearfix">
                                    <div class="col-lg-6">
                                       <label class="label1">Name on Card</label>
                                       <input type="text" class="form-control" name="name" placeholder="First name" value="Sachin">
                                    </div>
                                    <div class="col-lg-6">
											   <label class="label1"></label>
                                       <input type="text" class="form-control"  name="last_name" placeholder="Card Number" value="Card Number">
									   
									   <img class="iocns" src="images/card-icons.png">
                                    </div>
                                 </div>
                                 <div class="row clearfix">
                                    <div class="col-lg-6">
							
                                       <input type="text" class="form-control" name="name" placeholder="First name" value="Expiry MM/YY">
                                    </div>
                                    <div class="col-lg-6">
                                       <input type="text" class="form-control"  name="last_name" placeholder="Card Number" value="CVV">
									   
									   <div class="text-area">
									   <span>What is this </span>
									   		   <img class="iocns" src="images/notification-icon.png">
									   </div>
                                    </div>
                                 </div>
                                 <div class="row clearfix">
                                    <div class="col-sm-12">
                                       <div class="checkbox-icon">
                                          <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2" checked="">
                                          <label for="styled-checkbox-2">Save these card details as per the <a href="#"> RBI Guidelines </a> for future transactions.</label>
                                       </div>
                                    </div>
                                 </div>
								 
								 <div class="form-btn-inner">
                        <button class="theme-button" type="button">Pay ₹1869 </button>
                     </div>
								 
								 
                              </form>
                           </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                           <p>Second Panel</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                           <p>Third Panel</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		  </div>
         <div class="col-lg-5">
            <div class="checkout-right">
               <div class="method-inner-wrap">
                  <div class="order-summary-wrap">
                     <h5>My Order Summary</h5>
                     <div class="delivery-wrap">
                        <span>Deliver to :</span>
                        <a class="change-wrap" href="#">Change</a>
                     </div>
                     <div class="name-wrap">
                        Sachin Dhiman
                     </div>
                     <div class="address-text">
                        <span>H8RR+W45, Sector 21A, Noida, Uttar Pradesh 201301</span> 
                     </div>
                  </div>
                  <p style="display: block;" class="coupon-text error-text" id="cupon_success"></p>
                  <div class="mrp-wrap">
                     <ul>
                        <li>
                           <span>Total MRP</span>
                           <p id="item-total-price"><i class="fa-solid fa-indian-rupee-sign"></i> 46614</p>
                        </li>
                        <li>
                           <span>Total Discount <img class="dis-icon" src="images/total-dic.png"> </span>
                           <span style="color:#24C13D" class="promo_discount"><i class="fa-solid fa-indian-rupee-sign"></i>  330</span>
                        </li>
                     </ul>
                  </div>
                  <div class="mrp-wrap">
                     <ul>
                        <li>
                           <span>Total </span>
                           <span><strong id="totalvalue" style="color:rgba(0, 0, 0, 0.9);"><span> <i class="fa-solid fa-indian-rupee-sign"></i> </span> 46614</strong></span>
                        </li>
                     </ul>
                  </div>
                  <div class="offers-wrap">
                     <ul>
                        <li>
                           <div class="offers-image">
                              <img class="offer-icon offer2" src="images/offers.png">
                           </div>
                           <div class="offers-content">
                              <span>Available Offers</span>
                           </div>
                        </li>
                        <li>
                           <div class="offers-image">
                              <img class="offer-icon" src="images/offer-wallet.png">
                           </div>
                           <div class="offers-content">
                              <span>Mobikwik Wallet :</span> Get upto Rs.500 Cashback on Just Go Nutrition on payment via MobiKwik Wallet T&amp;C
                           </div>
                        </li>
                        <li>
                           <div class="offers-image">
                              <img class="offer-icon" src="images/offer-wallet.png">
                           </div>
                           <div class="offers-content">
                              <span>CredPay :</span> Offer - Upto Rs 500 cashback on your CRED Pay UPI transaction on a min spend of Rs 99 on JustGoNutrition. T&amp;C
                           </div>
                        </li>
                     </ul>
                     <div class="read-more-content moretext">
                        <ul>
                           <li>
                              <div class="offers-image">
                                 <img class="offer-icon" src="images/offer-wallet.png">
                              </div>
                              <div class="offers-content">
                                 <span>Free Charge: </span> Get 10% cashback up to Rs 150 using Freecharge Pay Later T&amp;C
                              </div>
                           </li>
                        </ul>
                     </div>
                     <a href="javascript:void(0);" class="read-mores moreless-button" title="Read More">Read More</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include 'footer.php'; ?>


