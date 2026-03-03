<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Coupon;
use Illuminate\Support\Str;
use Auth;
use App\Referral;
use App\Redeem_referral;


class ReferInfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('subcategories_manage')) {
        //     return abort(401);
        // }

        $influencers = 'App\User'::where('is_influencer', 1)->get();

        return view('admin.referinfluencer.index', compact('influencers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maxID = 'App\User'::max('id');
        return view('admin.referinfluencer.create', compact('maxID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // User::create([
        //     'name' => $request->fname.' '.$request->lname,
        //     'mobile' => $request->mobile,
        // ]);

        $userExists = User::where('mobile', $request->mobile)->first();

        if($userExists)
        {
            $userExists->name = $request->fname.' '.$request->lname;
            $userExists->is_influencer = 1;
            $userExists->save();



            //REFERRAL CODE SAVE START
            $referralCodePercentOrFlat = 0;

            if($request->discount)
            {
                $referralCodePercentOrFlat = $request->discount;
            }


            $coupon = new Coupon;
            $coupon->title = strtoupper(Str::slug($request->fname.' '.date('Y').$userExists->id,'-'));
            $coupon->discription  = 'Referral code for '. $request->fname.' '.$request->lname;

            if($request->discount_type == 'discount_percentage')
            {
                $coupon->discount_percentage = $referralCodePercentOrFlat;
            }
            else
            {
                $coupon->discount_flat = $referralCodePercentOrFlat;
            }

            $coupon->discount_type = $request->discount_type;
            $coupon->valid_from = $request->valid_from;
            $coupon->valid_upto = $request->valid_upto;
            $coupon->limit_upto = 1000;
            $coupon->active = 1;
            $coupon->is_referral_code = 1;
            $coupon->user_id = $userExists->id;
            $coupon->save();
            //REFERRAL CODE SAVE END


            

        }
        else
        {
            $user = new User();
            $user->name = $request->fname.' '.$request->lname;
            $user->mobile = $request->mobile;
            $user->is_influencer = 1;
            $user->save();

            //REFERRAL CODE SAVE START
            $referralCodePercentOrFlat = 0;

            if($request->discount)
            {
                $referralCodePercentOrFlat = $request->discount;
            }


            $coupon = new Coupon;
            $coupon->title = strtoupper(Str::slug($request->fname.' '.date('Y').$user->id,'-'));
            $coupon->discription  = 'Referral code for '. $request->fname.' '.$request->lname;

            if($request->discount_type == 'discount_percentage')
            {
                $coupon->discount_percentage = $referralCodePercentOrFlat;
            }
            else
            {
                $coupon->discount_flat = $referralCodePercentOrFlat;
            }

            $coupon->discount_type = $request->discount_type;
            $coupon->valid_from = $request->valid_from;
            $coupon->valid_upto = $request->valid_upto;
            $coupon->limit_upto = 1000;
            $coupon->active = 1;
            $coupon->is_referral_code = 1;
            $coupon->user_id = $user->id;
            $coupon->save();
            //REFERRAL CODE SAVE END
        }

        return redirect()->route('admin.referinfluencer.index');
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function influencerHistory($influencer_id)
    {
        // dd($influencer_id);

        //TEST CALCULATIONS OF POINTS START
        if(Auth::check())
        {
            $checkTotalPoints = Referral::where('referrer_id', $influencer_id)->get();

            $totalPoints = 0;
            if(count($checkTotalPoints) > 0)
            {
                for($i=0;$i<count($checkTotalPoints);$i++)
                {
                    $totalPoints += floatval($checkTotalPoints[$i]->reward_value);
                }
            }
            // dd($totalPoints);




            $checkRedeemedPoints = Referral::where('referrer_id', $influencer_id)->get();

            $redeemedPoints = 0;
            if(count($checkRedeemedPoints) > 0)
            {
                for($i=0;$i<count($checkRedeemedPoints);$i++)
                {
                    $redeemedPoints += floatval($checkRedeemedPoints[$i]->redemed_value);
                }
            }
            // dd($redeemedPoints);





            $balancePoints = $totalPoints - $redeemedPoints;
            // dd($balancePoints);

        }
        //TEST CALCULATIONS OF POINTS END

        








        $coupon = null;
        $referrerDetails = null;

        //TEST CALCULATIONS OF POINTS

        if(Auth::check())
        {
            // $user_id = Auth::user()->id;

            $coupon = Coupon::where('user_id', $influencer_id)->first();
            $referrerDetails = Referral::where('referrer_id', $influencer_id)->get();

            $rewardPointsAfterReferral =  Referral::where('referred_id', $influencer_id)->get();

            $user =  User::where('id', $influencer_id)->first();

            $userInRedeemTable =  Redeem_referral::where('user_id', $influencer_id)->first();


        }

// dd($referrerDetails);
        return view('admin.referinfluencer.history', compact('coupon','referrerDetails','rewardPointsAfterReferral','totalPoints','redeemedPoints','balancePoints','user','userInRedeemTable'));
        
    }

    
}
