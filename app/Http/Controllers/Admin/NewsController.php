<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'url' => 'required|',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . 'webp';

            $fileWidth = Image::make($file)->width();
            $fileHeight = Image::make($file)->height();

            $compressedImage = Image::make($file->getRealPath())
                ->orientate()
                ->resize($fileWidth, $fileHeight, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $compressedImage->save(public_path('uploads/media/' . $fileName));

            News::create([
                'url' => $request->url,
                'image' => 'uploads/media/' . $fileName,
               'slug' => Str::slug($request->url, "-"),
            ]);
        }

        return redirect()->route('admin.news.index');  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, News $news)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($news->image && File::exists(public_path($news->image))) {
                File::delete(public_path($news->image));
            }

            // Process the new image
            $file = $request->file('image');
            $fileName = time() . '.webp';

            $compressedImage = Image::make($file->getRealPath())
                ->orientate()
                ->resize(178, 139, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $compressedImage->save(public_path('uploads/media/' . $fileName));

            $imagePath = 'uploads/media/' . $fileName;
        } else {
            $imagePath = $news->image;
        }

        // Update the record
        $news->update([
            'url' => $request->url,
            'image' => $imagePath,
            'slug' => Str::slug($request->url, "-"),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
    if ($news->image && File::exists(public_path($news->image))) {
        File::delete(public_path($news->image));
    }
    
    $news->delete();

    return redirect()->route('admin.news.index');
    }

}
