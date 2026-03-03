<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Redeem_referral;
use App\Referral;




class influencer_redeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateFrom = $_GET['dateFrom'] ?? null;
        $dateTo = $_GET['dateTo'] ?? null;

        if (!empty($dateFrom) && !empty($dateTo)) {
            $fromDate = date('c', strtotime($dateFrom));
            $toDate = date('c', strtotime($dateTo));
            
            $influencers = Redeem_referral::whereBetween('created_at', [$fromDate, $toDate])->orderBy('id', 'desc')->get();

        }
        else
        {
            $influencers = Redeem_referral::orderBy('id', 'desc')->get();
        }


        return view('admin.influencer_redeem.index', compact('influencers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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


    public function infuencerRedeemApproved(Request $request)
    {
        // dd($request->all());
        Redeem_referral::where('id', $request->influencer_redeem_id)->update(['status' => 'Approved']);

        $redeemDetails = Referral::where('referrer_id', $request->user_id)->orderBy('id', 'desc')->first();
        if($redeemDetails && $redeemDetails->referrer_id)
        {
            // $referrer_user = User::where('id', $redeemDetails->referrer_id)->first();

            $redeemDetails->redemed_value = $request->redeemed_points; // Assign the new value
            $redeemDetails->save(); // Save changes to the database
        }


        return redirect()->back();

    }

    public function infuencerRedeemRejected(Request $request)
    {
        // dd('rejected');
        Redeem_referral::where('id', $request->influencer_redeem_id)->update(['status' => 'Rejected']);
        
        return redirect()->back();
    }

    public function infuencerRedeemStatusChange(Request $request)
    {
        if($request->status == 'Approved')
        {
            Redeem_referral::where('id', $request->influencer_redeem_id)->update(['status' => 'Approved', 'remarks' => $request->remarks]);

            $redeemDetails = Referral::where('referrer_id', $request->user_id)->orderBy('id', 'desc')->first();
            if($redeemDetails && $redeemDetails->referrer_id)
            {
                // $referrer_user = User::where('id', $redeemDetails->referrer_id)->first();

                $redeemDetails->redemed_value = $request->redeemed_points; // Assign the new value
                $redeemDetails->save(); // Save changes to the database
            }
        }
        else
        {
            Redeem_referral::where('id', $request->influencer_redeem_id)->update(['status' => 'Rejected', 'remarks' => $request->remarks]);
        }

        return redirect()->back();
    }

    
}
