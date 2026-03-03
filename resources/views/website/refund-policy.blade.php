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
                     <a class="nav-link active" href="{{url('/refund-policy')}}">Return/Refund & Cancellation Policy</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{url('/shipping-policy')}}">Shipping Policy</a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-9 col-md-8">
            <div class="tab-content">
              <div class="tab-pane" id="tabs-3" role="tabpanel" >
                  <div class="privacy-content">
                     <h1 class="heading policy-page-mainhead">Return/Refund & Cancellation Policy</h1>
                     <p>At Aayurja, we are committed to ensuring customer satisfaction. Please review our policy regarding returns and refunds.</p>
                     <h3 class="privacy-heading">Eligibility for Returns</h3>
                     <p>You may request a return if:</p>
                     <ul class="privacy-doc-list">
                        <li>You receive a defective or damaged product.</li>
                        <li>The product delivered is different from what you ordered.</li>
                        <li>Products are eligible for returns within 7 days from the delivery date. Ensure the item is in its original condition and that all packaging is intact.</li>
                     </ul>
                     <h4 class="privacy-heading">Non-Returnable Items</h4>
                     <p>Certain items are ineligible for return. This includes:</p>
                     <ul class="privacy-doc-list">
                        <li>Perishable goods such as food, herbs, and health supplements.</li>
                        <li>Products marked as “non-returnable” on the website.</li>
                     </ul>
                     <h4 class="privacy-heading">Return Process</h4>
                     <p>To initiate a return, follow these steps:</p>
                     <ul class="privacy-doc-list">
                        <li>Contact us via our support email within 48 hours of receiving the product.</li>
                        <li>Provide details, including the order number, product description, issue, and images of the product in question.</li>
                        <li>Our team will review your request and, upon validation, provide further instructions.</li>
                     </ul>
                     <h4 class="privacy-heading">Refund Policy</h4>
                     <p>Once a return request is approved, refunds will be processed within 24 hours. It may take 7-10 working days for the amount to reflect in your original mode of payment.</p>
                     <p>Refunds are issued only after our team receives and inspects the product.</p>
                     <h4 class="privacy-heading">Conditions for Exchange</h4>
                     <p>Exchanges are permitted if the product is defective or if a wrong item was shipped. Exchanges will be handled in a similar manner to returns.</p>
                     <h4 class="privacy-heading">Cancellations</h4>
                     <p>Orders can be cancelled before they are dispatched. If the cancellation request is approved, the refund will be processed within 24 hours.</p>
                     <h4 class="privacy-heading">Contact Us</h4>
                     <p>For any queries related to returns, refunds, or cancellations, please contact our customer service team at <a href="mailto:support@aayurja.com">support@aayurja.com.</a></p>
                  </div>
               </div>
           
            </div>
         </div>
      </div>
   </div>
</section>




@include('website.footer')