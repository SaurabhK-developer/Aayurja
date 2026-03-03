<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\GupshupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\MSG91;
use App\User;
use Illuminate\Support\Facades\Session;
use Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Coupon;
use Illuminate\Support\Str;


class LoginController extends Controller
{

    public function login(Request $request)
    {
        $email = $request->get('email');
        $pass = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            
            $user = User::where('email', $email)->first();
            session(['loggedinusername' => $user->name]);
            session(['loggedinuseracctype' => 'email']);
            session(['loggedinuserid' => Auth::user()->id]);
            // dd($request->get('redirectto'));
            if ($request->get('redirectto') != '0') {
                $url = url('') . '/checkout1';
                
                $ssid = Session::get('ssid');
                DB::table('buy_products')
                            ->where('ssid', $ssid)
                            ->update(['user_id' => Auth::user()->id]);

                return redirect($url);
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withErrors(['message' => 'Wrong email or password.']);
    }

    public function login_vendor(Request $request)
    {
        //return $request;
        $id = $request->get('id');
        $pass = $request->get('pass');

        if (Auth::attempt(['vendor_id' => $id, 'password' => $pass])) {
            return redirect('admin/home');
        }
        return redirect()->back()->with('message', 'Enter wrong credentials');
    }

    public function loginotp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
        ]);
        if ($validator->passes()) {

            $input = request()->mobile;

            Session::put('PPHONE', $input);

            if (User::where('mobile', $input)->value('id')) {
                $otp = rand(1000, 9999);
                $MSG91 = new MSG91();
                $msg91Response = $MSG91->sendSMS($otp, $input);
                if ($msg91Response['error']) {
                    $response = $msg91Response['message'];
                } else {
                    Session::put('LOTP', $otp);
                    Session::put('PHONEs', $input);
                    $response = 'Your OTP is Send.';
                }
                return response()->json(['success' => $response]);
            } else {

                $otp = rand(1000, 9999);
                $MSG91 = new MSG91();
                $msg91Response = $MSG91->sendSMS($otp, $input);

                if ($msg91Response['error']) {
                    $response = $msg91Response['message'];
                } else {
                    Session::put('LOTP', $otp);
                    Session::put('PHONEs', $input);
                }

                return response()->json(['success' => "0"]);
            }
        }

        return Response::json(['errors' => $validator->errors()]);
    }
    public function send_loginotp(Request $request)
    {
        $input = $request->session()->get('PHONEs');
        $otp = rand(1000, 9999);
        $MSG91 = new MSG91();
        //   dd('sajid');
        $msg91Response = $MSG91->sendSMS($otp, $input);
        if ($msg91Response['error']) {
            $response = $msg91Response['message'];
        } else {
            Session::put('LOTP', $otp);
            $response = 'Your OTP is Send.';
        }
        return response()->json(['success' => $response]);
    }

    public function verifyOtp(Request $request)
    {
        $name1 = request()->name1;
        $name2 = request()->name2;
        $name3 = request()->name3;
        $name4 = request()->name4;
        $enteredOtp = $name1 . $name2 . $name3 . $name4;
        //dd($enteredOtp);
        $OTP = $request->session()->get('LOTP');

        if ($OTP == $enteredOtp) {
            //   if(1){
            Session::forget('LOTP');
            $mobile = Session::get('PHONEs');
            $user = User::where('mobile', $mobile)->first();
            //dd($user);

            if (isset($user)) {
                \Auth::login($user);
            }

            Session::put('guest_mobile', $mobile);
            Session::forget('PHONEs');
            $response = "Your Number is Verified.";
        } else {

            $response = "OTP does not match.";
        }

        //echo json_encode($response);
        return response()->json(['success' => $response]);
    }

    public function gmaillogin(Request $request)
    {
        $fullname = $request->get('fullname');
        $email = $request->get('email');

        if (DB::table('users')->where('email', $email)->count() == 0) {
            $data = array();
            $data[] = array('name' => $fullname, 'email' => $email, 'provider' => 'google');
            DB::table('users')->insert($data);
        }

        $user = User::where('email', $email)->first();
        if (isset($user)) {
            \Auth::login($user);
        }


        session(['loggedinusername' => $fullname]);
        session(['loggedinuseracctype' => 'google']);
        session(['loggedinuserid' => Auth::user()->id]);

        return Response::json(['success' => 'Gmail login']);
    }

    public function facebooklogin(Request $request)
    {
        $fullname = $request->get('fullname');
        $email = $request->get('email');
        $fb_id = $request->get('id');
        $refer = $request->get('refer');
        $refer_id = 0;
        if($refer != null){
            $refer_id = "App\Offer"::where(['title'=> $refer, 'type'=>6])->pluck('added_by')->first();
        }

        if (DB::table('users')->where('provider_id', $fb_id)->count() == 0) {
            $data = array();
            $data[] = array('name' => $fullname, 'email' => $email,'provider_id'=>$fb_id, 'provider' => 'fb','referred_by'=>$refer_id);
            DB::table('users')->insert($data);
        }

        $user = User::where('provider_id', $fb_id)->first();
        if (isset($user)) {
            \Auth::login($user);
        }

        session(['loggedinusername' => $fullname]);
        session(['loggedinuseracctype' => 'facebook']);
        session(['loggedinuserid' => Auth::user()->id]);

        return Response::json(['success' => 'FB login']);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function checkmobilelogin(Request $request)
    {

        $mobile = $request->get('mobile');
        $otp = $request->get('otp');

        if ($otp != 1111) {
            return Response::json(['code' => 2]);
        }

        if (DB::table('users')->where('mobile', $mobile)->count() == 0) {
            return Response::json(['code' => 3]);
        }

        $user = User::where('mobile', $mobile)->first();
        if (isset($user)) {
            \Auth::login($user);
        }

        session(['loggedinusername' => 'Guest']);
        session(['loggedinuseracctype' => 'mobilelogin']);
        session(['loggedinuserid' => Auth::user()->id]);

        return Response::json(['code' => 1]);
    }

    public function checkmobilesignup(Request $request)
    {

        $mobile = $request->get('mobile');
        $otp = $request->get('otp');

        if ($otp != 1111) {
            return Response::json(['code' => 2]);
        }

        if (DB::table('users')->where('mobile', $mobile)->count() == 0) {
            $data = array();
            $data[] = array('mobile' => $mobile);
            DB::table('users')->insert($data);
        } else {
            return Response::json(['code' => 3]);
        }

        $user = User::where('mobile', $mobile)->first();
        if (isset($user)) {
            \Auth::login($user);
        }

        session(['loggedinusername' => 'Guest']);
        session(['loggedinuseracctype' => 'mobilelogin']);
        session(['loggedinuserid' => Auth::user()->id]);

        return Response::json(['code' => 1]);
    }

    public function signupuser(Request $request)
    {
        
        $email = $request->email;
        if ($request->first_name == '') {
            return back()->withErrors(['message' => 'Please fill the first name.']);
        } elseif ($request->last_name == '') {
            return back()->withErrors(['message' => 'Please fill the last name.']);
        } elseif ($request->email == '') {
            return back()->withErrors(['message' => 'Please fill the email.']);
           
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         return back()->withErrors(['message' => 'Please fill the  valid email Id.']);
   
        } elseif ($request->password == '') {
            return back()->withErrors(['message' => 'Please fill the password.']);
        } elseif ($request->consent == null) {
            return back()->withErrors(['message' => 'Please agree to the privacy policy.']);
        }
        if (DB::table('users')->where('email', $request->email)->count() > 0) {
            return back()->withErrors(['message' => 'Email already exists.']);
        }
        if (\Request::has('refer_code')) {
            $refer_code = \Request::get('refer_code');
            $refer_id = "App\Offer"::where(['title'=> $refer_code, 'type'=>6])->pluck('added_by')->first();
            $request->request->add(['referred_by' => $refer_id]);
        }

        $request['name'] = $request->first_name . ' ' . $request->last_name;
        User::create($request->except('_token'));

        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            \Auth::login($user);
        }

        session(['loggedinusername' => $request->first_name . ' ' . $request->last_name]);
        session(['loggedinuseracctype' => 'email']);
        session(['loggedinuserid' => Auth::user()->id]);

        return redirect('/');
    }


    
    public function generateOtp(Request $request)
    {
        $validator = Validator::make($request->all(),[   
            'mobile' => 'required|min:10|max:15',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'error' => $validator->messages(),
                'message'=> "Validation Error"
            ]);
        }
        $user = User::where('mobile', $request->mobile)->first(); 
        $now = now();
        $otp= rand(123456, 999999);
        if($user){
            User::where('mobile', $request->mobile)->update([
                'otp' => $otp,
                'expire_at' => $now->addMinutes(5)
            ]);
            $ddd = GupshupController::sendOtp($request->mobile,$otp);
            $data = [
                'otp'=> 'OTP has been sent on Your Mobile Number',
            ];




           

            // REFERRAL CODE SAVE START
            $checkReferralCodeExists = Coupon::where('user_id', $user->id)->first();

            if (!$checkReferralCodeExists) {
                $referralCodePercentOrFlat = 10;

                $coupon = new Coupon;
                $coupon->title = strtoupper(Str::slug($user->name, "-")) . '-' . date('Y') . $user->id;
                $coupon->discription = 'Referral code for user ' . $user->name;

                // Assign discount percentage
                $coupon->discount_percentage = isset($checkReferralCodeExists->discount_percentage) && 
                                                $checkReferralCodeExists->discount_percentage >= 0 
                                                ? $checkReferralCodeExists->discount_percentage 
                                                : $referralCodePercentOrFlat;

                $coupon->discount_type = 'discount_percentage';
                $coupon->valid_from = date('Y-m-d');
                $coupon->valid_upto = date('Y-m-d', strtotime('+1 year'));
                $coupon->limit_upto = 100;
                $coupon->active = 1;
                $coupon->is_referral_code = 1;
                $coupon->user_id = $user->id;

                $coupon->save();
            }
            // REFERRAL CODE SAVE END

            


            return response()->json([
                'status' => true,
                'error' => $data,
                'message'=> "Otp Sent"
            ]);
        }
        $otp= rand(123456, 999999);
  
        /* Create a New OTP */
        $newUser = User::create([
            'name' => 'User',
            'mobile' => $request->mobile,
            'otp' => $otp,
            'expire_at' => $now->addMinutes(5)
        ]);
        $ddd = GupshupController::sendOtp($request->mobile,$otp);
        $data = [
            'otp'=> 'OTP has been sent on Your Mobile Number',
        ];



        //REFERRAL CODE SAVE START
        $checkReferralCodeExists = Coupon::where('user_id', $newUser->id)->first();
        // dd($checkReferralCodeExists);
        if(!$checkReferralCodeExists)
        {
            $referralCodePercentOrFlat = 10;

            $coupon = new Coupon;
            $coupon->title = strtoupper(Str::slug($newUser->name,"-")).'-'.date('Y').$newUser->id;
            $coupon->discription  = 'Referral code for user '. $newUser->name;
            $coupon->discount_percentage = $referralCodePercentOrFlat;
            $coupon->discount_type = 'discount_percentage';
            $coupon->valid_from = date('Y-m-d');
            $coupon->valid_upto = date('Y-m-d', strtotime('+1 year'));
            $coupon->limit_upto = 100;
            $coupon->active = 1;
            $coupon->is_referral_code = 1;
            $coupon->user_id = $newUser->id;
            $coupon->save();
        }
        
        //REFERRAL CODE SAVE END





        return response()->json([
            'status' => true,
            'error' => $data,
            'message'=> "Otp Sent"
        ]);
    }

    public function generateOtpRedirect(Request $request)
    {
        $validator = Validator::make($request->all(),[   
            'mobile' => 'required|min:10|max:15',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput(); 
        }
        $user = User::where('mobile', $request->mobile)->first(); 
        $now = now();
        $otp = rand(123456, 999999);
        if($user){
            User::where('mobile', $request->mobile)->update([
                'otp' => $otp,
                'expire_at' => $now->addMinutes(5)
            ]);
            $ddd = GupshupController::sendOtp($request->mobile,$otp);
            
        return redirect('/otp-verification?mobile='.$request->mobile);

        $otp = rand(123456, 999999);
  
        /* Create a New OTP */
        User::create([
            'name' => 'User',
            'mobile' => $request->mobile,
            'otp' => $otp,
            'expire_at' => $now->addMinutes(5)
        ]);
        $ddd = GupshupController::sendOtp($request->mobile,$otp);
        
        return redirect('/otp-verification?mobile='.$request->mobile);
    }
}

    public function register_login_otp(Request $request)
    {
        // DB::beginTransaction();
        // try{
            $validator = Validator::make($request->all(),[   
                'mobile' => 'required|min:10|max:15',     
                'password' => 'required|max:255',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'error' => $validator->messages(),
                    'message'=> "Validation Error"
                ]);
            }
            $userOtp   = User::where('mobile', $request->mobile)->where('otp', $request->password)->first();
            $now = now();
            if (!$userOtp) {
                $data = [
                    'otp'=> 'Your OTP is not correct',
                ];
                return response()->json([
                    'status' => false,
                    'error' => $data,
                    'message'=> "Validation Error"
                ]);
            }else if($userOtp && $now->isAfter($userOtp->expire_at)){
                $data = [
                    'otp'=> 'Your OTP has been expired',
                ];
                return response()->json([
                    'status' => false,
                    'error' => $data,
                    'message'=> "Validation Error"
                ]);
            }
        
            $user = User::where('mobile', $request->mobile)->first();
    
            if($user){
                
                $userOtp->update([
                    'expire_at' => now()
                ]);
    
                Auth::login($user);
                session(['loggedinusername' => $user->name]);
                session(['loggedinuseracctype' => 'email']);
                session(['loggedinuserid' => Auth::user()->id]);
                return response()->json([
                    'status' => true,
                    'data' => null,
                    'message' => 'Register Successfully!!'
                ]);
            }
    
            $data = [
                'otp'=> 'Your Otp is not correct',
            ];
            return response()->json([
                'status' => false,
                'error' => $data,
                'message'=> "Validation Error"
            ]);

        
    }

    public function register_login_otp_redirect(Request $request)
    {
        // DB::beginTransaction();
        // try{
            $validator = Validator::make($request->all(),[   
                'mobile' => 'required|min:10|max:15',     
                'password' => 'required|max:255',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
                
            }
            $userOtp   = User::where('mobile', $request->mobile)->where('otp', $request->password)->first();
            $now = now();
            if (!$userOtp) {
                
                return redirect()->back()->with('error','Your OTP is not correct');
                
            }else if($userOtp && $now->isAfter($userOtp->expire_at)){
                
                return redirect()->back()->with('error','Your OTP has been expired');
                
            }
        
            $user = User::where('mobile', $request->mobile)->first();
    
            if($user){
                
                $userOtp->update([
                    'expire_at' => now()
                ]);
    
                Auth::login($user);
                session(['loggedinusername' => $user->name]);
                session(['loggedinuseracctype' => 'email']);
                session(['loggedinuserid' => Auth::user()->id]);
                 return redirect('/');
            }
    
            $data = [
                'otp'=> 'Your Otp is not correct',
            ];
         return redirect()->back()->with('error','Your Otp is not correct');

        
    }

    

    public function loginWithOtp(Request $request)
    {
        try{
            // dd($request->all());
            $otp = '123456';
            $match = $request->otp === $otp;
            if(!$match){
                return response()->json([
                    'status' => false,
                    'error' => 'OTP didn\'t match.',
                    'message'=> "Validation Error"
                ]);
            }else{
                $phone = $request->phone;
                $user = User::where('phone', $phone)->first();
                if($user){
                    Auth::login($user);

                    
                    return response()->json([
                        'status' => true,
                        'data' => null,
                        'message' => 'Login Successfully!!'
                    ]);
                }else {
                    return response()->json([
                        'status' => false,
                        'error' => 'User not found',
                        'message'=> "Not Found"
                    ]); 
                }               
            } 
        }catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => $e->getMessage()
            ]);  
        }
    }

public  function update_user(Request $request)
{    
    $validator = Validator::make($request->all(),[   
        'name' => 'required|min:5',
        'mobile' => 'required|min:10|max:10',
    ]);
    if($validator->fails()){
        return response()->json([
            'status' => false,
            'error' => $validator->messages(),
            'message'=> "Validation Error"
        ]);
    }
    $user = User::where('id', Auth::check()->id)->where('isVerified',0)->first();
    if($user){
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'dob' => $request->input('dob'),
            'isVerified' => 1,
        ]);
    return response()->json(["status" => 200, "message" => "Registration Successfully"]);   
    }
    else
    {
    return response()->json(["message" => "Registration Error"]);
    }  
}



}




