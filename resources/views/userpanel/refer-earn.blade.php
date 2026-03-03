@include('userpanel.header')
<h3 class="heading">Referral Program</h3>
<div class="user-form ref-wrapper-area">

   <div class="row">
      <div class="col-lg-4 col-md-4">
         <div class="first-ref-box">
            <span>Total points</span>
            <div>
               <label>
                  

                  {{number_format($totalPoints, 2)}}
                

               </label>
               <p>Your total earn <br> referral points</p>
            </div>
            <img src="{{url('public/userpanel/images/ref-program-vec.png')}}" alt="refresh" />
         </div>
      </div>
      <div class="col-lg-4 col-md-4">
         <div class="second-ref-box">
            <span>points Utilized</span>
            <div>
               <label>
                  <?php
                     $totalRedeemedPoints = 0;
                  ?>
                  @if(count($referrerDetails) > 0)
                     <?php
                         
                        foreach($referrerDetails as $referrerDetail) {
                           $totalRedeemedPoints += floatval($referrerDetail->redemed_value);
                        }
                     ?>

                     {{ number_format($totalRedeemedPoints, 2) }}
                  @else
                     {{ number_format(0, 2) }}
                  @endif
               </label>
               <p>Your total Utilized <br> referral points</p>
            </div>
            <img src="{{url('public/userpanel/images/ref-program-vec.png')}}" alt="refresh" />
         </div>
      </div>
      <div class="col-lg-4 col-md-4">
         <div class="third-ref-box">
            <span>Balance points</span>
            <div>
               <label>
                  {{number_format($balancePoints, 2)}}
               </label>
               <p>Your balance <br> referral points</p>
            </div>
            <img src="{{url('public/userpanel/images/ref-program-vec.png')}}" alt="refresh" />
         </div>
      </div>
   </div>

   <div class="ref-program-area">
      <div class="row align-items-center">
         <div class="col-lg-4 col-md-4">
            <div class="ref-program-img">
               <img src="{{url('public/userpanel/images/ref-program-img.webp')}}" alt="program" />
            </div>
         </div>

         <div class="col-lg-8 col-md-8">
            <div class="ref-program-content">
               <h3>Aayurja Referral Program</h3>
               <span>Share the Power of Wellness with Aayurja! 🌿💰</span>
               <p>Refer friends, share Aayurja’s organic wellness, and earn exclusive rewards. It’s a win-win—spread
                  health, gain benefits!</p>
               <a href="https://www.aayurja.com/referal-with-login">Refer a Friend</a>
            </div>
         </div>
      </div>
   </div>
<div class="reedem-btn">
   <button data-toggle="modal" data-target="#exampleModal" class="theme-button">Redeem Now</button>
 </div>

   <div class="ref-table-area">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th scope="col">S.no</th>
               <th scope="col">Date</th>
               <th scope="col">Name</th>
               <th scope="col">Status</th>
               <th scope="col">Transaction Amt</th>
               <th scope="col">Commission</th>
               @if(Auth::check() && Auth::user()->is_influencer == 1)
               <!-- <th scope="col"></th> -->
               @endif
            </tr>
         </thead>

         <tbody>


            @if(count($referrerDetails) > 0)
               @foreach($referrerDetails as $key => $referrerDetail)
                  <tr>
                     <th scope="row">{{$key+1}}</th>
                     <td>
                        <?php
                           $timestamp = strtotime($referrerDetail->created_at);
                           $formattedDate = date('d M, Y', $timestamp);
                        ?>
                        {{$formattedDate}}
                     </td>
                     <td>{{$referrerDetail->referred->name}}</td>
                     <td>{{$referrerDetail->status}}</td>
                     <td>
                        @if($referrerDetail->transaction_amount && $referrerDetail->transaction_amount != 0)
                           ₹{{number_format($referrerDetail->transaction_amount, 2)}}
                        @else
                           ₹{{ 0.00 }}
                        @endif
                     </td>
                     <td class="commission-green">
                        @if($referrerDetail->reward_value && $referrerDetail->reward_value != 0)
                           ₹{{number_format($referrerDetail->reward_value, 2)}}
                        @else
                           ₹{{ 0.00 }}
                        @endif
                     </td>
                     @if(Auth::check() && Auth::user()->is_influencer == 1)
                     <!-- <td> -->
                           <!-- <button data-toggle="modal" data-target="#exampleModal" class="ref-disable-btn">Redeemed</button> -->
                           <!-- <button data-toggle="modal" data-target="#exampleModal" class="ref-approved-btn">Redeemed</button> -->
                         

                           
                           <!-- <button data-toggle="modal" data-target="#exampleModal" class="ref-completed-btn">Redeemed</button> -->

                     <!-- </td> -->
                     @endif
                  </tr>
               @endforeach
            @endif

            <!-- <tr>
               <th scope="row">2</th>
               <td>04 Dec, 2024</td>
               <td>Geetanjali Sharma</td>
               <td>Approved</td>
               <td>₹ 5,340</td>
               <td  class="commission-green">₹ 53.40</td>
               <td><button data-toggle="modal" data-target="#exampleModal" class="ref-approved-btn">Redeemed</button></td>
            </tr>
            <tr>
               <th scope="row">3</th>
               <td>29 Nov, 2024</td>
               <td>Viraaj Singh</td>
               <td>Completed</td>
               <td>₹ 8,500</td>
               <td  class="commission-green">₹ 85.00</td>
               <td><button data-toggle="modal" data-target="#exampleModal" class="ref-completed-btn">Redeemed</button></td>
            </tr>
            <tr>
               <th scope="row">4</th>
               <td>16 Nov, 2024</td>
               <td>Rashika kapoor</td>
               <td>Completed</td>
               <td>₹ 4,440</td>
               <td  class="commission-green">₹ 44.40</td>
               <td><button data-toggle="modal" data-target="#exampleModal" class="ref-completed-btn">Redeemed</button></td>
            </tr> -->
           
         </tbody>
      </table>
   </div>
</div>


<div class="modal fade refer-redeem-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered refer-redeem-popup">
    <div class="modal-content">
      
      <div class="modal-body">
         <div class="reedeem-modal-body">
            <form action="{{url('redeem-referral-save')}}" method="post">
               @csrf
                  <?php
                     // $totalPoints = 0;
                  ?>
                 
                  <input type="hidden" value="{{$totalPoints}}" name="total_points" id="total_points" >

                     <?php
                        // $balancePoints = 0;

                        // $balancePoints = $totalPoints-$totalRedeemedPoints;
                     ?>

                  <input type="hidden" value="{{$balancePoints}}" name="balance_points" id="balance_points" >

                  <div class="container-fluid">
                  
                     <div class="row">
                        <div class="col-lg-12">
                           <h3>bank Details</h3>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>your name</label>
                           @php
                              $name = '';

                              if (!empty($userInRedeemTable) && !empty($userInRedeemTable->name)) {
                                 $name = $userInRedeemTable->name;
                              } elseif (!empty($user) && $user->name !== 'User' && !is_null($user->name)) {
                                 $name = $user->name;
                              }
                           @endphp
                           <input class="form-control" type="text" placeholder="Enter Name" name="name" value="{{$name}}" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>Mobile Number</label>
                           @php
                              $mobile = '';

                              if (!empty($userInRedeemTable) && !empty($userInRedeemTable->mobile)) {
                                 $mobile = $userInRedeemTable->mobile;
                              } elseif (!empty($user) && $user->mobile !== 'User' && !is_null($user->mobile)) {
                                 $mobile = $user->mobile;
                              }
                           @endphp
                           <input class="form-control" type="text" placeholder="Enter Mobile Number" name="mobile" value="{{$mobile}}" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>Your Email Address</label>
                           @php
                              $email = '';

                              if (!empty($userInRedeemTable) && !empty($userInRedeemTable->email)) {
                                 $email = $userInRedeemTable->email;
                              } elseif (!empty($user) && $user->email !== 'User' && !is_null($user->email)) {
                                 $email = $user->email;
                              }
                           @endphp
                           <input class="form-control" type="text" placeholder="Enter Email Address" name="email" value="{{$email}}" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>IFSC Code</label>
                           @php
                              $ifsc = '';

                              if (!empty($userInRedeemTable) && !empty($userInRedeemTable->ifsc)) {
                                 $ifsc = $userInRedeemTable->ifsc;
                              }
                           @endphp
                           <input class="form-control" type="text" placeholder="Enter IFSC Code" name="ifsc" value="{{$ifsc}}" required>
                        </div>
                        <div class="col-lg-12">
                           <label>Account Number</label>
                           @php
                              $account = '';

                              if (!empty($userInRedeemTable) && !empty($userInRedeemTable->account)) {
                                 $account = $userInRedeemTable->account;
                              }
                           @endphp
                           <input class="form-control" type="text" placeholder="Enter Account Number" name="account" value="{{$account}}" required>
                        </div>
                        <div class="col-lg-12">
                           <h4>Referral Points</h4>
                        </div>
                        <div class="col-lg-12">
                           <label>How Much Point Your Want to redeem</label>
                           <input class="form-control" type="text" placeholder="Enter Redeem Points" name="redeemed_points" id="redeemed_points" required>
                        </div>

                        <small id="redeem-message" class="text-danger"></small>

                        <div class="col-lg-12 text-center">
                           <button type="submit" id="redeem-btn" disabled>redeem point</button>
                           <p>Verification typically takes a few days, after which approved rewards are credited to your account. Thanks for your patience—your referral rewards are on the way!</p>
                        </div>
                     </div>         
                  </div>
            </form>

            <img src="{{url('public/userpanel/images/redeem-modal-1.png')}}" alt="modal" class="redeem-modal-vec1"/>
            <img src="{{url('public/userpanel/images/redeem-modal-2.png')}}" alt="modal" class="redeem-modal-vec2"/>
        </div>
      </div>
      
    </div>
  </div>
</div>




<div class="modal fade refer-redeem-popup" id="redeemForUserModel" tabindex="-1" aria-labelledby="redeemForUserModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered refer-redeem-popup">
    <div class="modal-content">
      
      <div class="modal-body">
         <div class="reedeem-modal-body">

            <span>COUPON CODE: </span> 


            <!-- <form action="{{url('redeem-referral-user-save')}}" method="post">
               @csrf
                  <?php
                    // $totalPoints = 0;
                  ?>
                  @if(count($referrerDetails) > 0)
                     @foreach($referrerDetails as $key => $referrerDetail)
                     <?php
                        //$totalPoints += floatval($referrerDetail->reward_value);
                     ?>
                     @endforeach
                  @endif
                  <input type="hidden" value="{{$totalPoints}}" name="total_points" id="total_points" >

                     <?php
                        // $balancePoints = 0;

                        // $balancePoints = $totalPoints-$totalRedeemedPoints;
                     ?>

                  <input type="hidden" value="{{$balancePoints}}" name="balance_points" id="balance_points" >

                  <div class="container-fluid">
                  
                     <div class="row">
                        <div class="col-lg-12">
                           <h3>bank Details</h3>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>your name</label>
                           <input class="form-control" type="text" placeholder="Enter Name" name="name" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>Mobile Number</label>
                           <input class="form-control" type="text" placeholder="Enter Mobile Number" name="mobile" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>Your Email Address</label>
                           <input class="form-control" type="text" placeholder="Enter Email Address" name="email" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <label>IFSC Code</label>
                           <input class="form-control" type="text" placeholder="Enter IFSC Code" name="ifsc" required>
                        </div>
                        <div class="col-lg-12">
                           <label>Account Number</label>
                           <input class="form-control" type="text" placeholder="Enter Account Number" name="account" required>
                        </div>
                        <div class="col-lg-12">
                           <h4>Referral Points</h4>
                        </div>
                        <div class="col-lg-12">
                           <label>How Much Point Your Want to redeem</label>
                           <input class="form-control" type="text" placeholder="Enter Redeem Points" name="redeemed_points" id="redeemed_points" required>
                        </div>

                        <small id="redeem-message" class="text-danger"></small>

                        <div class="col-lg-12 text-center">
                           <button type="submit" id="redeem-btn" disabled>redeem point</button>
                           <p>Verification typically takes a few days, after which approved rewards are credited to your account. Thanks for your patience—your referral rewards are on the way!</p>
                        </div>
                     </div>         
                  </div>
            </form> -->

            <img src="{{url('public/userpanel/images/redeem-modal-1.png')}}" alt="modal" class="redeem-modal-vec1"/>
            <img src="{{url('public/userpanel/images/redeem-modal-2.png')}}" alt="modal" class="redeem-modal-vec2"/>
        </div>
      </div>
      
    </div>
  </div>
</div>

@include('userpanel.footer')



<script>
//   document.addEventListener('DOMContentLoaded', function () {
//   const redeemedPointsInput = document.getElementById('redeemed_points');
//   const totalPointsInput = document.getElementById('total_points');
//   const balancePointsInput = document.getElementById('balance_points');
//   const redeemMessage = document.getElementById('redeem-message');
//   const redeemBtn = document.getElementById('redeem-btn');

//   redeemedPointsInput.addEventListener('input', function () {
//     const redeemedPoints = parseFloat(redeemedPointsInput.value) || 0;
//     const totalPoints = parseFloat(totalPointsInput.value) || 0;
    
//     if (redeemedPoints < 100) {
//       redeemMessage.textContent = 'You must redeem at least 100 points.';
//       balancePointsInput.value = totalPoints.toFixed(2);
//       redeemBtn.disabled = true;
//       return;
//     }

//     if (redeemedPoints > totalPoints) {
//       redeemMessage.textContent = "You don't have sufficient points to redeem.";
//       balancePointsInput.value = totalPoints.toFixed(2);
//       redeemBtn.disabled = true;
//       return;
//     }

//     redeemMessage.textContent = '';
//     const balancePoints = totalPoints - redeemedPoints;
//     balancePointsInput.value = balancePoints.toFixed(2);
//     redeemBtn.disabled = false;
//   });

//   console.log({ redeemedPoints, totalPoints, balancePoints });
  
// });

document.addEventListener('DOMContentLoaded', function () {
  const redeemedPointsInput = document.getElementById('redeemed_points');
  const balancePointsInput = document.getElementById('balance_points'); // Readonly field
  const redeemMessage = document.getElementById('redeem-message');
  const redeemBtn = document.getElementById('redeem-btn');

  const initialBalance = parseFloat(balancePointsInput.value) || 0; // Store the original balance

  redeemedPointsInput.addEventListener('input', function () {
    const redeemedPoints = parseFloat(redeemedPointsInput.value) || 0;

    if (redeemedPoints < 100) {
      redeemMessage.textContent = 'You must redeem at least 100 points.';
      balancePointsInput.value = initialBalance.toFixed(2); // Reset to original balance
      redeemBtn.disabled = true;
      return;
    }

    if (redeemedPoints > initialBalance) {
      redeemMessage.textContent = "You don't have sufficient points to redeem.";
      balancePointsInput.value = initialBalance.toFixed(2); // Reset to original balance
      redeemBtn.disabled = true;
      return;
    }

    redeemMessage.textContent = '';
    const balancePoints = initialBalance - redeemedPoints; // Calculate based on the original balance
    balancePointsInput.value = balancePoints.toFixed(2);
    redeemBtn.disabled = false;
  });
});



</script>