@include('userpanel.header')
<h3 class="heading">Refer And Earn</h3>
<div class="user-form refer-wrap">
   <div class="refer-cols">
      <div class="row">
         <div class="col-md-6">
            <div class="refer-col">
               <h4>Referral Code</h4>
               <p>{{$coupon->title}} </p>
            </div>
         </div>
         <div class="col-md-6">
            <div class="refer-col">
               <h4>Total Points</h4>
               <p>




               <?php
                  $totalPoints = 0;
               ?>
               @if(count($referrerDetails) > 0)
                  
                  @foreach($referrerDetails as $key => $referrerDetail)
                  <?php
                     $totalPoints += floatval($referrerDetail->reward_value);

                  ?>
                  @endforeach
               @endif


               {{number_format($totalPoints, 2)}}




               </p>
            </div>
         </div>
         <div class="col-md-6">
            <div class="refer-col">
               <h4>Total Redeemed Points</h4>
               <p>

               @if(count($referrerDetails) > 0)
                  <?php
                     $totalRedeemedPoints = 0; 
                     foreach($referrerDetails as $referrerDetail) {
                        $totalRedeemedPoints += floatval($referrerDetail->redemed_value);
                     }
                  ?>

                  {{ number_format($totalRedeemedPoints, 2) }}
               @else
                  {{ number_format(0, 2) }}
               @endif
               </p>
            </div>
         </div>
         <div class="col-md-6">
            <div class="refer-col">
               <h4>Total Available Points</h4>
               <p>
                  @if($totalPoints)
                     {{number_format($totalPoints-$totalRedeemedPoints, 2)}}
                  @endif
               </p>
            </div>
         </div>
         <div class="col-md-6">
            <div class="refer-col">
               <h4>Reward Points Received</h4>
               <p>
               

               <?php
                  $totalPointsReceived = 0;
               ?>
               @if(count($rewardPointsAfterReferral) > 0)
                  
                  @foreach($rewardPointsAfterReferral as $key => $rewardPointAftrRef)
                  <?php
                     $totalPointsReceived += floatval($rewardPointAftrRef->reward_value);

                  ?>
                  @endforeach
               @endif


               {{number_format($totalPointsReceived*2, 2)}}
               </p>
            </div>
         </div>
         <div class="col-md-6">
            <div class="refer-col">
               <h4>Coupon Code</h4>
               <p>Lorem Ipsum </p>
            </div>
         </div>
      </div>

      <div class="row">
      <table class="table">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Referred By</th>
               <th scope="col">Referred To</th>
               <th scope="col">Referral Code</th>
               <th scope="col">Reward Type</th>
               <th scope="col">Reward Value</th>
               <th scope="col">Status</th>
               <th scope="col">Redeemed Points</th>

            </tr>
         </thead>
         <tbody>
            @if(count($referrerDetails) > 0)
               @foreach($referrerDetails as $key => $referrerDetail)
                  <tr>
                     <th scope="row">{{$key}}</th>
                     <td>{{$referrerDetail->referrer->name}}</td>
                     <td>{{$referrerDetail->referred->name}}</td>
                     <td>{{$referrerDetail->referral_code}}</td>
                     <td>{{$referrerDetail->reward_type}}</td>
                  
                     <td>{{number_format($referrerDetail->reward_value, 2)}}</td>
                     <td>{{$referrerDetail->status}}</td>
                     <td>
                        @if($referrerDetail->redemed_value == null)
                           {{number_format(0, 2)}}
                           
                        @else
                           {{number_format($referrerDetail->redemed_value, 2)}}
                        @endif
                     </td>

                  </tr>
               @endforeach
            @endif
         </tbody>
      </table>
      </div>
   </div>
</div>
</div>
</div>
</div>
</div>
</div>
@include('userpanel.footer')