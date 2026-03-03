<?php

namespace App\Http\Controllers\Admin;

use App\Rating;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use DB;
use App\Product;
use Illuminate\Support\Facades\Session;

class RatingsController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      

        $option = $request->option;
        $selectedproduct = $request->selectedproduct;

        $date_search = false;

        if ($option) {
            $date_search = true;
            if ($option === 'date') {
                $from_date = $request->from_date;
                $to_date = $request->to_date;
            } else {
                $from_date = date('Y-m-d', strtotime('-' . $option . ' Days'));
                $to_date = date('Y-m-d');
            }
        } else {
            $date_search = false;
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d');
        }

        if ($option == '' && $selectedproduct == '') {
            $ratings = DB::table('rating')->orderBy('id', 'DESC')->get();
        }elseif($option != '' && $selectedproduct == ''){
            $ratings = DB::table('rating')->whereBetween(DB::raw('DATE(created_at)'), array($from_date, $to_date))->orderBy('id', 'DESC')->get();
        }elseif($option == '' && $selectedproduct != ''){
            $ratings = DB::table('rating')->where('product_id',$selectedproduct)->orderBy('id', 'DESC')->get();
        } else {
            $ratings = DB::table('rating')->whereBetween(DB::raw('DATE(created_at)'), array($from_date, $to_date))->where('product_id',$selectedproduct)->orderBy('id', 'DESC')->get();
        }

        $products = Product::get()->pluck('product_name', 'id');
        // $ratings = Rating::all();

        return view('admin.ratings.index', compact('ratings', 'from_date', 'to_date', 'option', 'products', 'selectedproduct'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     if (! Gate::allows('rating_manage')) {
    //         return abort(401);
    //     }
    //     return view('admin.ratings.create',compact('category'));
    // }

    // /**
    //  * Store a newly created User in storage.
    //  *
    //  * @param  \App\Http\Requests\StoreUsersRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreSubcategoriesRequest $request)
    // {
    //     if (! Gate::allows('categories_manage')) {
    //         return abort(401);
    //     }
    //     $request['slug'] = Str::slug($request->name,'-');
    //     $ratings = Brand::create($request->all());

    //     return redirect()->route('admin.ratings.index');
    // }


    // /**
    //  * Show the form for editing User.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
   

    public function edit($id)
    {
        if (!Gate::allows('rating_manage')) {
            return abort(401);
        }
        $rating = Rating::findOrFail($id);
        // Fetch all products to display in the product dropdown
        $products = Product::pluck('product_name', 'id');

        return view('admin.ratings.edit', compact('rating', 'products'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Rating $rating)
    // {
    //    if (! Gate::allows('rating_manage')) {
    //          return abort(401);
    //    }
    //     $rating->update($request->all());
        
    //     //FOR AVERAGE RATING SAVE IN PRODUCTS TABLE START
    //     $avg_rating = 'App\Rating'::where('product_id', $rating->product_id)->where('status', '1')->avg('rating');
        
        
    //     if(!empty($avg_rating))
    //     {
    //     	$avg_rating = number_format($avg_rating, 1);
    //     	Product::where('id', $rating->product_id)->update(['avg_rating' => $avg_rating]);
    //     }
    //     //FOR AVERAGE RATING SAVE IN PRODUCTS TABLE END
        
    //     return response()->json(['status' => '200']);

    //     //return redirect()->route('admin.ratings.index');
    // }

    public function update(Request $request, $id)
    {

        if (!Gate::allows('rating_manage')) {
            return abort(401);
        }
    
        $rating = Rating::findOrFail($id);
    
        // Decode existing images
        $imagePaths = json_decode($rating->product_image, true) ?? [];
        if ($request->hasFile('product_image')) {
            foreach ($imagePaths as $oldImage) {
                $oldImagePath = public_path($oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imagePaths = [];
            foreach ($request->file('product_image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/reviews'), $imageName);
                $imagePaths[] = 'uploads/reviews/' . $imageName;
            }
        }
        $rating->update([
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'title' => $request->title,
            'description' => $request->description, 
            'product_image' => json_encode($imagePaths),
            'status' => $request->status
        ]);
        
        $avg_rating = Rating::where('product_id', $rating->product_id)
                            ->where('status', '1')
                            ->avg('rating');
    
        if (!empty($avg_rating)) {
            $avg_rating = number_format($avg_rating, 1);
            Product::where('id', $rating->product_id)->update(['avg_rating' => $avg_rating]);
        }
    
        return redirect()->route('admin.ratings.index')->with('status', 'Rating updated successfully.');
    }
    

    // public function show(Brand $rating)
    // {
    //     if (! Gate::allows('rating_manage')) {
    //         return abort(401);
    //     }



    //     return view('admin.ratings.show', compact('brand'));
    // }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rating)
    {
        if (!Gate::allows('rating_manage')) {
            return abort(401);
        }
        // return $rating;
        $rating = 'App\Rating'::findOrFail($rating);
        $rating->delete();

        return redirect()->route('admin.ratings.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('rating_manage')) {
            return abort(401);
        }
        Rating::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
    
    public function create()
    {
        $products = Product::all();
        return view('admin.ratings.create',compact('products'));
    }

    public function store(Request $request){
        //dd($request->all());
        $rating = new Rating;
       

        $rating->product_id = $request['product_id'];
        
         $rating->more_suggestion = $request['more_suggestion'];
        $rating->rating = $request['rating'];
        $rating->user_name = $request['user_name'];
         $rating->status = $request['status'];


        //  if(!empty($request->file('image')))
        // {
        //      $image = $request->file('image');
        //     $path2 = $image->store('/images/reviews', ['disk' =>   'my_files']);
        //      $rating->image = $path2;    
        //  }
        
         $rating->save();
        
         Session::flash('status', 'Review submitted successfully...'); 
        
        return back();
    }
}
