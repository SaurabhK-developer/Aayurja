<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use Validator,Redirect,Response,File;
 use Socialite;
 use App\User;
 use Auth;
 class SocialController extends Controller
 {
 public function redirect($provider)
 {
     return Socialite::driver($provider)->redirect();
 }
 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user(); 
   $user = $this->createUser($getInfo,$provider); 
   auth()->login($user); 
   
   return redirect()->to('https://www.thearcadecollection.com');
   
   }
 function createUser($getInfo,$provider){
 $user = User::where('provider_id', $getInfo->id)->first();
 if (!$user) {
      $user = User::create([
         'name'     => $getInfo->name,
         'email'    => $getInfo->email,
         'provider' => $provider,
         'provider_id' => $getInfo->id,
         'isVerified'=>"1"
     ]);
   }
   return $user;
 }
 
 
 
 
 public function fb_login(Request $request){
    	    
    	  
    	  $email=$request->email;
    	  $name=$request->name;
    	  $last_name=$request->last_name;
    	  $provider_id=$request->provider_id;
    	  $provider="facebook";
    	 $verify = "1";
    	  $user = User::where('provider_id', $provider_id)->first();
          if (!$user) {
         $user = User::create([
         'name'     => $name,
          'last_name'     => $last_name,
         'email'    => $email,
         'provider' => $provider,
         'provider_id' => $provider_id,
         'isVerified'=>$verify
     ]);
     
   }
   Auth::login($user,true);	  
    	  
    	   if($user->mobile){
    	return response()->json(['success'=>"1"]); }
    	else{
    	  	return response()->json(['success'=>"0"]); }
    	}
	
 }