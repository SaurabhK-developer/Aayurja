<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Occasion;
use Auth;
use Mail;
use Config;
use Response;
use DB;
use App\Slider;
use App\Deal;
use App\Coupon;

use App\Blog;
use App\NewsLetter;
use App\Order;
use App\Designer;
use App\User;
use App\Tag;
use App\Seo;
use App\Altimage;
use App\Product;
use App\Cart;
use App\ProductVariants;
use App\Product_Image;
use App\Product_category;
use App\flavourmappings;
use App\Type;
use App\Subcategory;
use App\recently_viewed;
use App\product_available_size;
use App\Season;
use App\Media;
use App\Rating;
use App\Occasioncategory;
use App\BillingAddress;
use App\Referral;
use App\Http\Controllers\Traits\MasterTrait;
use App\Redeem_referral;



class UserController extends Controller

{

    use MasterTrait;

    public function index()
    {
        $user_id = Auth::user()->id;
        $usersdata = \App\User::where("id", $user_id)->first();
        return view('userpanel.index', compact('usersdata'));
    }



   

    public function myorder()
    {
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $orders = Order::where('user_id',$user_id)->where('status', '1')->get()->groupBy('order_id');

         // dd($orders);
            
        }

        else
        {
            return redirect('/');
        }

        return view('userpanel.myorder', compact('orders'));
    }


//    public function recent_view()
//     {
//         return view('userpanel.recent-view');
//     }



    public function address()
    {
        $user_id = Auth::user()->id;
        $address = BillingAddress::where("user_id", $user_id)->get();
        return view('userpanel.addresses', compact('address'));
       
    }
	
	
	  public function blpl_cash()
    {
      
        return view('userpanel.blpl-cash');
    }







 //address _edit

    public function editaddress($addressid)
    {
        $address = BillingAddress::where("id", $addressid)->first();
        return view('userpanel.edit-address', compact('address'));
    }


    public function save_address(Request $request)
    {
        $user_id = Auth::user()->id;
        $email  = $request->email;
        $name  = $request->fname;
        $last_name  = $request->lname;
        $address_type = $request->address_type;
        $mobile = $request->mobile;
        $city = $request->city;
        $state = $request->state;
        $country = $request->country;
        $address = $request->address;
        $address2 = $request->address2;
        $pin_code = $request->pin_code;
        $data = ["name" => $name, "last_name" => $last_name, "mobile" => $mobile, "address_type" => $address_type, "city" => $city, "state" => $state, "country" => $country, "address" => $address, "address2" => $address2, "pin_code" => "$pin_code", "user_id" => $user_id, "email" => $email];
        $this->createTable("\App\BillingAddress", $data);
        return redirect('user/address');
    }



    public function recent_view()

    {
        $products = recently_viewed::latest()->select('productid', 'created_at','id')->whereHas('product_details', function ($recent_viewed)  {
            $recent_viewed->where('userid', Auth::user()->id);
        })->get();

        
        return view('userpanel.recently-view', compact('products'));
       
    }

    public function updateProfiles(Request $request)
    { 
        
            $user_id = Auth::user()->id;
       

        $fname = $request->fname;
        $lname = $request->lname;
        $name = $fname . " " . $lname;
        $mobile = $request->mobile;
        $email = $request->email;
        $gender = $request->gender;
        $dob = $request->dob;
        $anniversary_date = $request->anniversary_date;

        
        $data = ["name" => $name, "mobile" => $mobile, "email" => $email,"gender"=>$gender,"dob"=>$dob];
       // dd($data);
        $this->updateTable("\App\User", ["id" => $user_id], $data);
        return back()->with(['success' => 'Profile successfully updated.']);
    }

 //update profile image

    public function updateProfileImage(Request $request)
    {  
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'image' => 'required|file',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $user_id = Auth::user()->id;
      
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./public/uploads/profile/', $fileName);
            $form_data['profile'] = $fileName;
        }
        $this->updateTable("\App\User", ["id" => $user_id], $form_data);
        return back()->with(['success' => 'Profile Image Uploaded.']);
    }

//remove profile image
    
    public function removeProfileImage(Request $request)
    {
        $user_id = Auth::user()->id;
        $this->updateTable("\App\User", ["id" => $user_id], ["image"=> null]);

    }


    public function deleteaddress($addressid)
    {
        BillingAddress::find($addressid)->delete();
        return redirect('user/address');
    }




  

    public function updateaddress(Request $request , $id )
    
    {
        $user_id = Auth::user()->id;
        $address=BillingAddress::findOrFail($id);
        $form_data = array(
        'email'  => $request->email,
        'name'  => $request->fname,
        'last_name'  => $request->lname,
        'address_type' => $request->address_type,
        'mobile' => $request->mobile,
        'city' => $request->city,
        'state' => $request->state,
        'country' => $request->country,
        'address' => $request->address,
        'address2' => $request->address2,
        'pin_code' => $request->pin_code,
        );
        $address->update($form_data);
        return redirect('user/address');
    }



    public function referAndEarn(Request $request)
    {

        


        //TEST CALCULATIONS OF POINTS START
        if(Auth::check())
        {
            $checkTotalPoints = Referral::where('referrer_id', Auth::user()->id)->get();

            $totalPoints = 0;
            if(count($checkTotalPoints) > 0)
            {
                for($i=0;$i<count($checkTotalPoints);$i++)
                {
                    $totalPoints += floatval($checkTotalPoints[$i]->reward_value);
                }
            }
            // dd($totalPoints);




            $checkRedeemedPoints = Referral::where('referrer_id', Auth::user()->id)->get();

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
            $user_id = Auth::user()->id;

            $coupon = Coupon::where('user_id', $user_id)->first();
            $referrerDetails = Referral::where('referrer_id', $user_id)->get();

            $rewardPointsAfterReferral =  Referral::where('referred_id', $user_id)->get();

            $user =  User::where('id', $user_id)->first();

            $userInRedeemTable =  Redeem_referral::where('user_id', $user_id)->first();


        }



        
        return view('userpanel.refer-earn', compact('coupon','referrerDetails','rewardPointsAfterReferral','totalPoints','redeemedPoints','balancePoints','user','userInRedeemTable'));
    }





}