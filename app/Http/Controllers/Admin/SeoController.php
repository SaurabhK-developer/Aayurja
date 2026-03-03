<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Brand;
use App\Seo;
use Auth;
use App\Blog;
use App\Offer;
use App\Subcategory;
use App\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image; 
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Validator;
class SeoController extends Controller
{
    
   public function index()
    { 

        if(Auth::user()->role != 1 || Auth::user()->role == null)
        {
            return abort(401);
        }

        $routes = Seo::all();
        
        return view('admin.seos.index',compact('routes'));
    }
    public function create()
    { 
        
        return view('admin.seos.create');
    }

    public function store(Request $request)
    {
    $seo = new Seo();
    
    $seo->url = $request->url;
    $seo->meta_title = $request->meta_title;
    $seo->keywords = $request->keywords;
    $seo->alt_tag = $request->alt_tag;
    $seo->description = $request->description;
    $seo->canonical_tag = $request->canonical_tag;
    $seo->robots_tag = $request->robots_tag;
    $seo->og_title = $request->og_title;
    $seo->meta_twitter = $request->meta_twitter;
    $seo->meta_twitter_card = $request->meta_twitter_card;
    $seo->meta_twitter_site = $request->meta_twitter_site;
    $seo->meta_twitter_title = $request->meta_twitter_title;
    $seo->meta_twitter_description = $request->meta_twitter_description;
    $seo->og_site_name = $request->og_site_name;
    $seo->og_description = $request->og_description;
    $seo->og_image_url = $request->og_image_url;
    $seo->og_url = $request->og_url;
    $seo->og_type = $request->og_type;
    $seo->og_tags = $request->og_tags;
    $seo->product_schema = $request->product_schema;
    $seo->faq_schema = $request->faq_schema;
    $seo->review_schema = $request->review_schema;
    $seo->article_schema = $request->article_schema;
    $seo->local_schema = $request->local_schema;
    $seo->video_schema = $request->video_schema;

    $seo->save();

    return redirect()->route('admin.seos.index');
    }



    public function edit($id)
    {
       
		
        $seo = Seo::findOrFail($id);

        return view('admin.seos.edit', compact('seo'));
    }

    /**
     * Update State in storage.
     *
     * @param  \App\Http\Requests\UpdateCountriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
     
    public function update(Request $request, $id)
    {
    $seo = Seo::findOrFail($id);

    $seo->url = $request->url;
    $seo->meta_title = $request->meta_title;
    $seo->keywords = $request->keywords;
    $seo->alt_tag = $request->alt_tag;
    $seo->description = $request->description;
    $seo->canonical_tag = $request->canonical_tag;
    $seo->robots_tag = $request->robots_tag;
    $seo->og_title = $request->og_title;
    $seo->meta_twitter = $request->meta_twitter;
    $seo->meta_twitter_card = $request->meta_twitter_card;
    $seo->meta_twitter_site = $request->meta_twitter_site;
    $seo->meta_twitter_title = $request->meta_twitter_title;
    $seo->meta_twitter_description = $request->meta_twitter_description;
    $seo->og_site_name = $request->og_site_name;
    $seo->og_description = $request->og_description;
    $seo->og_image_url = $request->og_image_url;
    $seo->og_url = $request->og_url;
    $seo->og_type = $request->og_type;
    $seo->og_tags = $request->og_tags;
    $seo->product_schema = $request->product_schema;
    $seo->faq_schema = $request->faq_schema;
    $seo->review_schema = $request->review_schema;
    $seo->article_schema = $request->article_schema;
    $seo->local_schema = $request->local_schema;
    $seo->video_schema = $request->video_schema;

    $seo->save();

    return redirect()->route('admin.seos.index');
    }

    


    /**
     * Display State.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('amenitie_view')) {
            return abort(401);
        }

        $amenitie = Seo::findOrFail($id);

        $currentUrl = Request::url();
        $seo = Seo::where('url', $currentUrl)->first(); 

        return view('admin.amenities.show', compact('amenitie','seo'));
    }


    /**
     * Remove State from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $amenitie = Seo::findOrFail($id);
        $amenitie->delete();

        return redirect()->route('admin.seos.index');
    }

    /**
     * Delete all selected State at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
       
        if ($request->input('ids')) {
            $entries = Seo::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore State from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('amenitie_delete')) {
            return abort(401);
        }
        $state = Seo::onlyTrashed()->findOrFail($id);
        $state->restore();

        return redirect()->route('admin.seos.index');
    }

    /**
     * Permanently delete State from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('amenitie_delete')) {
            return abort(401);
        }
        $state = Seo::onlyTrashed()->findOrFail($id);
        $state->forceDelete();

        return redirect()->route('admin.seos.index');
    }

           
    
    
}
