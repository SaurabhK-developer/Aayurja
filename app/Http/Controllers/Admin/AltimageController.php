<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Brand;
use App\Seo;
use App\Altimage;
use App\Offer;
use App\Subcategory;
use App\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubcategoriesRequest;
use App\Http\Requests\Admin\UpdateSubcategoriesRequest;
use Validator;
class AltimageController extends Controller
{
    
   public function index()
    { 
        $routes = Altimage::all();
        
        return view('admin.altimage.index',compact('routes'));
    }
    public function create()
    { 
        
        
        return view('admin.altimage.create');
    }
    public function store(Request $request)
    { 
        $routes = Altimage::create($request->all());
        
       return redirect('admin/altimage');
    }
    public function edit($id)
    {
       
		
        $altimage = Altimage::findOrFail($id);

        return view('admin.altimage.edit', compact('altimage'));
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
        //dd($id);
        $amenitie = Altimage::findOrFail($id);
      
        
        
        $amenitie->update($request->all());



        return redirect()->route('admin.altimage.index');
    }


    /**
     * Display State.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   


    /**
     * Remove State from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $amenitie = Altimage::findOrFail($id);
        $amenitie->delete();

        return redirect()->route('admin.altimage.index');
    }

    /**
     * Delete all selected State at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
       
        if ($request->input('ids')) {
            $entries = Altimage::whereIn('id', $request->input('ids'))->get();

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
        $state = Altimage::onlyTrashed()->findOrFail($id);
        $state->restore();

        return redirect()->route('admin.altimage.index');
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
        $state = Altimage::onlyTrashed()->findOrFail($id);
        $state->forceDelete();

        return redirect()->route('admin.altimage.index');
    }
}
