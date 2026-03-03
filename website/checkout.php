<?php include 'header.php'; ?>
<section class="checkout-wrapper">
   <div class="container-fluid">
      <div class="row  check-row">
         <div class="col-lg-6">
            <div class="checkout-left">
               <ul id="progressbar-wrap">
                  <div class="loading-dots--dot"></div>
                  <li class="active">
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> <i class="fa-solid fa-check"></i></span>
                        <span class="stepper-head-text"> Card </span>
                     </div>
                  </li>
                  <li>
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> 2 </span>
                        <span class="stepper-head-text"> Add Address </span>
                     </div>
                  </li>
                  <li>
                     <div class="stepper-head" tabindex="0">
                        <span class="stepper-head-icon"> 3 </span>
                        <span class="stepper-head-text"> Payment </span>
                     </div>
                  </li>
                  <div class="loading-dots-dot-right"></div>
               </ul>
               <form class="check-form" action="#" method="post" id="addressform">
                  <div class="form-checkbox">
                     <input type="email" class="form-control"  name="address" placeholder="Email Address" value="Email Address">
                     <div class="checkbox-wrap">
                        <input class="form-check-input" type="checkbox" name="newsletter" id="gridCheck">
                        <label class="form-check-label" for="gridCheck" id="emailLabel">Receive News and Exclusive
                        Promotions</label>
                     </div>
                  </div>
                  <h4>Ship To</h4>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <label>First name</label>
                        <input type="text" class="form-control" id="check-first-name" name="name"  placeholder="First name" value="Sachin">
                     </div>
                     <div class="col-sm-6">
                        <label>Last name</label>
                        <input type="text" class="form-control" id="check-last-name" name="last_name" placeholder="Last name"  value="Dhiman">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="check-address" name="address" placeholder="Address" value="Address">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="check-apartment" name="address2"  placeholder="Apartment, suite, etc.(Optional)" value="">
                     </div>
                     <div class="col-sm-6">
                        <select  class="form-control" >
                           <option value="Country/Region">Country/Region</option>
                           <option value="Country/Region1">Country/Region1</option>
                           <option value="Country/Region2">Country/Region2</option>
                        </select>
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <select  class="form-control" >
                           <option value="Country/Region">State</option>
                           <option value="Country/Region1">Country/Region1</option>
                           <option value="Country/Region2">Country/Region2</option>
                        </select>
                     </div>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="check-city"  name="city" placeholder="City" value="City">
                     </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <input type="text" class="form-control" autocomplete="nope" id="phone-number" placeholder="Phone Number" name="mobile" value="Phone Number" name="mobile" minlength="10" tabindex="4" maxlength="10" onkeydown="return ( event.ctrlKey || event.altKey
                           || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                           || (95<event.keyCode &amp;&amp; event.keyCode<106)
                           || (event.keyCode==8) || (event.keyCode==9)
                           || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                           || (event.keyCode==46) )" required="">
                     </div>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="pin_code" id="zip-code"  value="Zipcode" placeholder="ZIP Code">
                     </div>
                     <div class="col-sm-12">
                        <label>Comment</label>
                        <textarea class="form-control">
                        </textarea>
                     </div>
                  </div>
                  <div class="radio-button">
                     <div class="radio-text">
                        <input type="radio" id="test1" name="radio-group" checked>
                        <label for="test1">Use different address for billing</label>
                     </div>
                     <div class="radio-text">
                        <input type="radio" id="test2" name="radio-group">
                        <label for="test2">Save this for future orders</label>
                     </div>
                  </div>
                  <div class="form-wrapper">
                     <div class="form-btn-inner">
                        <a href="#"> Go Back Shopping</a>
                     </div>
                     <div class="form-btn-inner">
                        <button class="theme-button" type="button" value="">Continue to Shipping </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="checkout-right">
               <div class="method-inner-wrap ">
                  <div class="shipping-content-section">
				  
				  
				  <div class="checkout-img">
				  
				  <div class="left-img">
				  <img src="images/cake-img.png">
				  </div>
				  
				  
				  	  <div class="right-img">
				  <div class="content">
				  <h5>Heavenly Butterscotch Cream Cake 2 Kg</h5>
				  <p class="price">₹ 2199</p>
				  <div class="que">Quantity :  1</div>
				  </div>
				  </div>
				  </div>
				  
				  
				  
				    <div class="checkout-img checkout-img2">
				<div class="right-img">
				  <div class="content">
				  <p class="price">₹ 2199</p>
				  <div class="que">Quantity :  1</div>
				  </div>
				  </div>
				  </div>
				  
				  <hr/>
				  
                     <div class="shipping-box2">
                        <div class="left-box1">
                           <p>Subtotal</p>
                           <p id="item-total-price"> <i class="fa-solid fa-indian-rupee-sign"></i> INR 2199</p>
                        </div>
                        <div class="left-box1">
                           <p>Shipping</p>
                           <p style="text-align: right;"><span style="color:#FF4949">Free
                              Shipping</span><span>Shipping options will be <br> updated during
                              checkout.</span>
                           </p>
                        </div>
                        <div class="left-box1">
                           <p>Promo Discount</p>
                           <p class="promo_discount">INR 0</p>
                        </div>
                        <div class="discount-form">
                           <div class="row">
                              <div class="col-lg-8">
                                 <input type="text" class="form-control" id="check-first-name" name="name"  placeholder="Enter Coupon Code" value="Enter Coupon Code">
                              </div>
                              <div class="col-lg-4">
                                 <div class="btn-wrap">
                                    <button class="theme-button" type="button" value="">Apply </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="left-box1">
                           <p>Total</p>
                           <span><strong id="totalvalue" style="color:rgba(0, 0, 0, 0.9);"><span> <i class="fa-solid fa-indian-rupee-sign"></i> INR</span> 2199</strong></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include 'footer.php'; ?>