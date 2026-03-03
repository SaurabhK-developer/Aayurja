<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Media;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index()
    {

        $medias = 'App\Media'::get();

        return view('admin.media.index', compact('medias'));
    }
    
    public function create()
    {
        
        $medias= 'App\Media'::get();
        
        
       return view('admin.media.create', compact('medias'));
    }
    
    public function store(request $request)
    {
         $fileName=null;
       // $fileName1=null;
       // $fileName2=null;
        
        if (request()->hasFile('logo')) {
            $file = request()->file('logo');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/media/logo', $fileName);    
        }
       // if (request()->hasFile('image1')) {
       //     $file1 = request()->file('image1');
       //     $fileName1 = md5($file1->getClientOriginalName() . time()) . "." . $file1->getClientOriginalExtension();
       //     $file1->move('/uploads/media', $fileName1);    
       // }
       // if (request()->hasFile('image2')) {
       //     $file2 = request()->file('image2');
       //     $fileName2 = md5($file2->getClientOriginalName() . time()) . "." . $file2->getClientOriginalExtension();
       //     $file2->move('/uploads/media', $fileName2);    
       // }
    
             $medias = Media::create([
                'title'=> $request->title,
                'brief'=>$request->brief,
                'slug'=> Str::slug($request->title,"-"),
                //'description'=> $request->description,
                'logo' =>$fileName,
                'url' =>$request->url,
    		//'image1' =>$fileName1,
    		//'image2' =>$fileName2
        	]);

       
        return redirect()->route('admin.media.index');
    }
    
    public function edit(Media $media, $id)
    {
        $media = Media::where('id', $id)->first();
        return view('admin.media.edit', compact('media'));
    }
    
    public function update(Request $request, $id)
    {
    	$media = Media::where('id', $id)->first();
    	
        $form_data = array(
            'title'=> $request->title,
            'brief'=>$request->brief,
            'slug'=> Str::slug($request->title,"-"),
            'url' =>$request->url,
            //'description'=> $request->description,
        );
        
      
       
        
        if (request()->hasFile('logo')) {
		$file = request()->file('logo');
		$fileName1 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
		$file->move('public/uploads/media/logo', $fileName1);
		
		$form_data['logo'] = "$fileName1";
        }
        
        //if (request()->hasFile('image1')) {
        //$file = request()->file('image1');
        //$fileName2 = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        //$file->move('./uploads/', $fileName2);
        //$form_data['image1'] = "$fileName2";
        //}
        
        $media->update($form_data);
      	//dd($media->all());
        return redirect()->route('admin.media.index');
    }
    
    public function show(Media $media)
    {
        return view('admin.media.show');
    }
    
    public function destroy($id)
    {
	$media = Media::where('id', $id)->first();
        $media->delete();

        return redirect()->route('admin.media.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        Media::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
    
    
    
    
}
