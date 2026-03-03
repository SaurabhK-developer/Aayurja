<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Response;
use Illuminate\Support\Facades\Session;

class SignController extends Controller
{ 
    

 //registration
 public function register(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
           
           
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|same:reenterpwd',
            'reenterpwd' => 'required',
            'mobile' => 'required|min:10',
            'name' => 'required',
            //'password' => 'required|min:6',
            
            
              
        ],['password.same' => 'Password and confirm password field must be same.']);

        $input = $request->all();
        $name=$request->name;
        // $lname=$request->lname;
        // $name=$fname. ' ' . $lname;
        $email=$request->email;
        $mobile = $request->mobile;
         $password=$request->password;
        
         //$dob=$request->dob;
         //$gender=$request->gender;
        if ($validator->passes()) {
             $user= User::create([

            'email' => $email,
            'mobile' => $mobile,
            'name' =>$name,
            'password' => bcrypt($password),
            'role'  =>"2",
        ]);
        \Auth::login($user);
          return Response::json(['success' => '1']);
    
        }
        
        return Response::json(['errors' => $validator->errors()]);
    }
    

     public function personaldetails(Request $request)
    {
        $input = $request->all();
         
         $user= User::create([

            'email' => $request->session()->get('EMAIL'),
            'name' =>$request->session()->get('name'),
            'password' => bcrypt($request->session()->get('PASSWORD')),
            'name' => $request->fname,
            'last_name' => $request->lname,
            'dob' => $request->dob,
            
            'role_id'  =>"2",
        ]);
         Session::forget($request->all());
       \Auth::login($user);
        
        return Response::json(['success' => "1"]);
    }


}



    
    
    

