<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Referral;
use App\Redeem_referral;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role != 1 || Auth::user()->role == null)
        {
            return abort(401);
         }
        // return view('home');


        //TEST CALCULATIONS OF POINTS START
        if(Auth::check())
        {

            $dateFrom = $_GET['dateFrom'] ?? null;
            $dateTo = $_GET['dateTo'] ?? null;

            if (!empty($dateFrom) && !empty($dateTo)) {
                $fromDate = date('c', strtotime($dateFrom));
                $toDate = date('c', strtotime($dateTo));

                $checkTotalPoints = Referral::whereBetween('created_at', [$fromDate, $toDate])->get();

                $totalPoints = 0;
                if(count($checkTotalPoints) > 0)
                {
                    for($i=0;$i<count($checkTotalPoints);$i++)
                    {
                        $totalPoints += floatval($checkTotalPoints[$i]->reward_value);
                    }
                }
    
    
                $checkRedeemedPoints = Referral::whereBetween('created_at', [$fromDate, $toDate])->get();
    
                $redeemedPoints = 0;
                if(count($checkRedeemedPoints) > 0)
                {
                    for($i=0;$i<count($checkRedeemedPoints);$i++)
                    {
                        $redeemedPoints += floatval($checkRedeemedPoints[$i]->redemed_value);
                    }
                }
    
    
    
    
    
                $balancePoints = $totalPoints - $redeemedPoints;
            
            }
            else
            {
                $checkTotalPoints = Referral::get();

                $totalPoints = 0;
                if(count($checkTotalPoints) > 0)
                {
                    for($i=0;$i<count($checkTotalPoints);$i++)
                    {
                        $totalPoints += floatval($checkTotalPoints[$i]->reward_value);
                    }
                }


                $checkRedeemedPoints = Referral::get();

                $redeemedPoints = 0;
                if(count($checkRedeemedPoints) > 0)
                {
                    for($i=0;$i<count($checkRedeemedPoints);$i++)
                    {
                        $redeemedPoints += floatval($checkRedeemedPoints[$i]->redemed_value);
                    }
                }





                $balancePoints = $totalPoints - $redeemedPoints;
            }

            
        }
        //TEST CALCULATIONS OF POINTS END

        








        $coupon = null;
        $referrerDetails = null;

        //TEST CALCULATIONS OF POINTS

        if(Auth::check())
        {
            // $user_id = Auth::user()->id;
            
            $dateFrom = $_GET['dateFrom'] ?? null;
            $dateTo = $_GET['dateTo'] ?? null;

            if (!empty($dateFrom) && !empty($dateTo)) {
                // Optional: Validate date format
                $fromDate = date('c', strtotime($dateFrom));
                $toDate = date('c', strtotime($dateTo));

                // Get filtered data
                $referrerDetails = Referral::whereBetween('created_at', [$fromDate, $toDate])->get();

                // Common stats (same in both conditions)
                $referrerCount = Referral::whereBetween('created_at', [$fromDate, $toDate])->distinct('referrer_id')->count('referrer_id');
                $referredCount = Referral::whereBetween('created_at', [$fromDate, $toDate])->count();
                $sumTransactionAmount = Referral::whereBetween('created_at', [$fromDate, $toDate])->sum('transaction_amount');
                $rewardPointsAfterReferral = Referral::whereBetween('created_at', [$fromDate, $toDate])->get();

            } else {
                // Get all data if no dates provided
                $referrerDetails = Referral::get();

                // Common stats (same in both conditions)
                $referrerCount = Referral::distinct('referrer_id')->count('referrer_id');
                $referredCount = Referral::count();
                $sumTransactionAmount = Referral::sum('transaction_amount');
                $rewardPointsAfterReferral = Referral::get();
            }

            // // Common stats (same in both conditions)
            // $referrerCount = Referral::distinct('referrer_id')->count('referrer_id');
            // $referredCount = Referral::count();
            // $sumTransactionAmount = Referral::sum('transaction_amount');
            // $rewardPointsAfterReferral = Referral::get();

            
            

            


        }

        return view('home', compact('referrerDetails','rewardPointsAfterReferral','totalPoints','redeemedPoints','balancePoints','referrerCount','referredCount','sumTransactionAmount'));


    }


 
}
