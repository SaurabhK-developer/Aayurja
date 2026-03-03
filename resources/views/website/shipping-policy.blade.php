@include('website.header')
<section class="privacy-area">
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-4">
            <div class="privacy-tab-wrap " id="exTab1">
               <h2 class="heading">quick links</h2>
               <ul class="nav nav-tabs" role="tablist">
               <li class="nav-item">
                     <a class="nav-link "  href="{{url('/privacy-policy')}}" >Privacy Policy</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link"  href="{{url('/terms-and-conditions')}}">Terms & Conditions</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link "  href="{{url('/refund-policy')}}">Return/Refund & Cancellation Policy</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link active" href="{{url('/shipping-policy')}}">Shipping Policy</a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-9 col-md-8">
            <div class="tab-content">
  
               <div class="tab-pane" id="tabs-4" role="tabpanel" >
                  <div class="privacy-content">
                     <h1 class="heading policy-page-mainhead">Shipping & Return Policy</h1>
                     <p>At Aayurja, we are committed to ensuring that your experience with our products is nothing short of exceptional and extremely reliable. Below is our comprehensive Shipping and Return policy to keep you informed every step of the way.</p>
                     <h3 class="privacy-heading">Shipping Policy</h3>
                     <p>We take utmost care in packaging and delivering your orders in a timely manner. Our delivery and shipping timeframe is typically 7-10 business days from the date of order confirmation. However, due to unforeseen circumstances, there might be slight delays. We appreciate your patience and understanding in such cases, and assure you that we will do our best to minimize any inconvenience.</p>
                     <p>Order Updates: Once your order is placed and dispatched, you will receive email and SMS notifications to keep you updated on its status.
                        Shipping Locations: Currently, we ship to locations within India.
                     </p>
                 
				 
                     <p>If you have any questions or concerns, feel free to reach out to us at info@aayurja.com. We’re here to help!</p>
                     <p><strong>Thank you for choosing Aayurja.</strong></p>
					 
					 
					 
					 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>




@include('website.footer')