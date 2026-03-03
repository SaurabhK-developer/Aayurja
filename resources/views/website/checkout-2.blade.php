@include('website.header')
@if($carts->count() <= 0)
    <script>
        window.location.href = "{{ url('shop') }}";
    </script>
@else
<!-- Event snippet for Add Payment Info conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-16756919325/wAz2CNfnjuMZEJ2YqbY-'});
</script>






<script>
  fbq('track', 'AddPaymentInfo');
</script>
<section class="checkout-wrapper payment-method-section">
   <div class="container">


    <div class="row">
      <div class="col-sm-12">
       <h1 class="category-title mobile-checkout-title">Choose Your Payment</h1>  
      </div>
      </div>
      <div class="row check-row checkouts-row">

         <div class="col-lg-12">
            <h1 class="category-title desktop-title ">Choose Your Payment</h1>
         </div>

         <div class="col-lg-7">
            <div class="checkout-left">
				   <div class="checkout-tabber">
               <div class="row">
                  <div class="col-md-6 col-lg-4">
                     <ul class="nav nav-tabs" role="tablist">
                         <li class="nav-item"> 
                           <a class="nav-link  active" data-toggle="tab" href="#tabs-1" role="tab"> <img src="{{url('public/images/razorpay-icon.webp')}}" alt="Razorpay" loading="lazy">Razor Pay</a>
                        </li>
                        {{-- <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"> <img src="{{url('public/images/payu-icon.png')}}" alt="payu" loading="lazy"> Payu Money</a>
                        </li>  --}}
                        <!-- <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"> <img src="{{url('public/images/upi.png')}}" > UPI</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">  <img src="{{url('public/images/netbanking.png')}}" > Net Banking</a>
                        </li> -->
                        <li class="nav-item">
                           <a class="nav-link " data-toggle="tab" href="#tabs-5" role="tab">  <img src="{{url('public/images/cash-icon.png')}}" alt="Cash" loading="lazy">  Cash on Delivery</a>
                        </li>
                     </ul>
                  </div>
                  <div class="col-md-6 col-lg-8">
                     <!-- Tab panes -->
                     <div class="tab-content">
                        <div class="tab-pane active " id="tabs-1" role="tabpanel">
                           <div class="card-section">
                              

                              <form class="check-form" action="{{url('pay_now/rozorpay')}}" method="post" id="addressform" name="payuForm">
                                 @csrf
                              <label class="radio-button-label">
                                 <input type="radio" name="radio-control" value="cashfree" />
                                 <img src="{{url('public/images/razorpay-img.webp')}}" alt="CashFree" loading="lazy">
                              </label>
         								<div class="form-btn-inner new-form-btn-inner">
                                    <button class="theme-button" type="submit">Pay ₹{{number_format(round($total),2)}}</button>
                                 </div>
                              </form>

                           </div>
                        </div>
                         <div class="tab-pane " id="tabs-2" role="tabpanel">
                           <!-- <div class="image_radio_button_control">
                              <label class="radio-button-label">
                                 <input type="radio" name="radio-control" value="cashfree" />
                                 <img src="{{url('public/images/cashfree.png')}}">
                              </label>

                              <label class="radio-button-label">
                                 <input type="radio" name="radio-control" value="payu"/>
                                 <img src="{{url('public/images/payu.png')}}">
                              </label>

                              <label class="radio-button-label">
                                 <input type="radio" name="radio-control" value="cod"/>
                                 <img src="{{url('public/images/cod.png')}}">
                              </label>
                           </div> -->


                             <form class="check-form" action="{{url('pay_now/payu')}}" method="post" id="addressform" name="payuForm">
                                 @csrf
                              <label class="radio-button-label">
                                 <input type="radio" name="radio-control" value="cashfree" />
                                 <img src="{{url('public/images/payu.png')}}" loading="lazy" alt="Payu">
                              </label>
         								<div class="form-btn-inner">
                                    <button class="theme-button" type="submit">Pay ₹{{number_format($total,2)}}</button>
                                 </div>
                              </form>

                        </div>

                      
                        
                        <div class="tab-pane  " id="tabs-5" role="tabpanel">
                              <form class="check-form" action="{{url('cod')}}" method="post" id="codForm" name="payuForm">
                                 @csrf
                              <label class="radio-button-label">
                                 <img src="{{url('public/images/cod.png')}}" alt="Code" loading="lazy">
                              </label>
         								<div class="form-btn-inner">
                                    <button class="theme-button" type="submit">Place Order</button>
                                 </div>
                              </form>
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
                        <a class="change-wrap" href="#">Change Address</a>
                     </div>
                     <div class="name-wrap">
                        {{ $userinfo->name.' '.$userinfo->last_name ?? '' }}
                     </div>
                     <div class="name-wrap">
                        {{ $userinfo->email ?? '' }}
                     </div>
                     <div class="address-text">
                        <span>{{ $userinfo->address ?? '' }},</span> <span>{{ $userinfo->city ?? '' }}, {{ $userinfo->state ?? '' }}, {{ $userinfo->country ?? '' }} {{ $userinfo->pin_code ?? '' }}
                     </div>
                  </div>
                  <!-- <p class="coupon-text error-text" id="cupon_success"></p> -->
                  <div class="mrp-wrap">
                     <ul>
                        <li>
                           <span> Sub Total </span>
                           <p id="item-total-price">₹{{number_format($subtotal,2)}}</p>
                        </li>
                        <li>
                           <span>Total Discount <img class="dis-icon" src="{{url('public/images/total-dic.png')}}" loading="lazy"> </span>
                           <span style="color:#24C13D" class="promo_discount">- ₹{{isset($discount_amount) ? number_format($discount_amount, 2) : 0.00}}</span>
                        </li>
                        <li>
                           <span>Round Off <img class="dis-icon" src="{{url('public/images/total-dic.png')}}" loading="lazy"> </span>
                           <span style="color:#24C13D" class="promo_discount">- ₹{{isset($discount_amount) ? number_format(($subtotal-$discount_amount)-($subtotal-$discount_amount), 2) : 0.00}}</span>
                        </li>
                     </ul>
                  </div>
                  <div class="mrp-wrap">
                     <ul>
                        <li>
                           <span>To Pay </span>
                           <span><strong id="totalvalue" class="last-total"> ₹{{number_format(round($total),2)}}</strong></span>
                        </li>
                     </ul>
                  </div>
                  <!-- <div class="offers-wrap">
                     <ul>
                        <li>
                           <img class="offer-icon offer2" src="{{url('public/images/offers.png')}}">
                           <p>Available Offers</p>
                        </li>
                        <li>
                           <img class="offer-icon" src="{{url('public/images/offer-wallet.png')}}">
                           <p><span>Mobikwik Wallet :</span> Get upto Rs.500 Cashback on Just Go Nutrition on payment via MobiKwik Wallet T&C</p>
                        </li>
                        <li>
                           <img class="offer-icon" src="{{url('public/images/offer-wallet.png')}}">
                           <p><span>CredPay :</span> Offer - Upto Rs 500 cashback on your CRED Pay UPI transaction on a min spend of Rs 99 on aayurja T&C</p>
                        </li>
                     </ul>
                     <div class="read-more-content moretext">
                        <ul>
                           <li>
                              <img class="offer-icon" src="{{url('public/images/offer-wallet.png')}}">
                              <p><span>Free Charge: </span> Get 10% cashback up to Rs 150 using Freecharge Pay Later T&C</p>
                           </li>
                        </ul>
                     </div>
                     <a href="javascript:void(0);" class="read-mores moreless-button">Read More</a>
                  </div> -->
               </div>
            </div>
         </div>

      </div>
   </div>
</section>

<div class="modal fade" id="codLimitModal" tabindex="-1" role="dialog" aria-labelledby="codLimitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="codLimitModalLabel">Order Limit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Cash on Delivery is available only for orders above ₹1000.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>


@endif
@include('website.footer')


<script type="text/javascript">
   //  document.payuForm.submit(); // Auto-submit the form to PayU
</script>


<script>
// document.getElementById('codForm').addEventListener('submit', function (e) {
//     const totalValueElement = document.getElementById('totalvalue');
    
//     // Extract numeric value from ₹ string
//     const totalValueText = totalValueElement.innerText.replace(/[₹,]/g, '');
//     const totalValue = parseFloat(totalValueText);

//     // Check if selected payment method is COD
//     const selectedPayment = document.querySelector('input[name="radio-control"]:checked');
    
//     if (selectedPayment && selectedPayment.value === 'cashfree') {
//         if (totalValue < 1000) {
//             e.preventDefault();
//             alert('For COD, you need to order at least ₹1000 worth of products.');
//         }
//     }
// });
</script>


<script>
    $('#codForm').on('submit', function(e) {
        e.preventDefault(); // Stop form from submitting

        // Get the total amount (₹1,000.00 → 1000.00)
        let totalText = $('#item-total-price').text().replace(/[^\d.]/g, ''); // Removes ₹ and commas
        let total = parseFloat(totalText);

        if (total < 1000) {
            // alert('Cash on Delivery is available only for orders above ₹1000.');
            $('#codLimitModal').modal('show');
        } else {
            this.submit(); // Proceed with form submission
        }
    });
</script>