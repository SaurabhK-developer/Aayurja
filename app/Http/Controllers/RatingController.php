<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Crypt;
use Response;
use DB;
use App\Blog;
use App\Category;
use App\Comment;
use App\Rating;
use App\Product;
use App\Http\Controllers\Traits\MasterTrait;



class RatingController extends Controller
{


    public function save_review(Request $request)
    {
        $existingReview = 'App\Rating'::where('product_id', $request->product_id)->where('user_email', $request->user_email) ->first();

        if ($existingReview) {
           
            return redirect()->route('thankyou', ['type' => 'againreview']);
        }    

        $imagePaths = []; // Array to store paths of uploaded images

    if ($request->hasFile('product_image')) {
        foreach ($request->file('product_image') as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/reviews'), $imageName);
            $imagePaths[] = 'uploads/reviews/' . $imageName;
        }
 }
        $imagePathsJson = json_encode($imagePaths);
        $data = 'App\Rating'::create([
            'rating' => $request->rating,
            'product_id' => $request->product_id,
            'user_id' =>  $request->user_id,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'description' => $request->description,
            'product_image' => $imagePathsJson, // Store JSON string in the database
            'title' => $request->title,
            'likes' => $request->likes,
        ]);

        return redirect()->route('thankyou',['type' => 'review']);

        // return response()->json(["status" => 200, "message" => "Review Submit"]);
    }






    public function getTitleWiseReviews(Request $request)
    {

        try {

            if($request->title == 'All'){
                $reviews = Rating::where('status', '1')
                ->orderBy('id', 'desc')
                ->get();
            }
            else{
                $reviews = Rating::where('title', $request->title)
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->get();
            }
        
    
            return response()->json($reviews);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching the reviews.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function likeReview(Request $request)
   {
    $ratingId = $request->input('rating_id'); // Get the rating ID from the request

    // Debugging: Log the rating ID to check if it's received correctly
    \Log::info('Received rating ID: ' . $ratingId);

    // Find the rating by ID
    $rating = Rating::find($ratingId);

    if ($rating) {
        $rating->likes = $rating->likes + 1; // Increment likes
        $rating->save();

        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Review not found']);
}
}

}
