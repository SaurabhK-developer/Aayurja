<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Concern;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ShopbyConcernController extends Controller
{
    public function index()
    {
        $concerns = Concern::get();
        return view('admin.shop-by-concern.index', compact('concerns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shop-by-concern.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
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

            $compressedImage->save(public_path('uploads/concerns/' . $fileName));

            Concern::create([
                'title' => $request->title,
                'shop_page_title' => $request->shop_page_title,
                'shop_page_desc' => $request->shop_page_desc,
                'image' => 'uploads/concerns/' . $fileName,
               'slug' => Str::slug($request->title, "-"),
            ]);
        }

        return redirect()->route('admin.shop-by-concern.index');  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Concern $shop_by_concern)
    {
        return view('admin.shop-by-concern.edit', compact('shop_by_concern'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Concern $shop_by_concern)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($shop_by_concern->image);

            $file = $request->file('image');
            $fileName = time() . '.' . 'webp'; 

            $fileWidth = Image::make($file)->width();
            $fileHeight = Image::make($file)->height();

            $compressedImage = Image::make($file->getRealPath())
                ->orientate()
                ->resize($fileWidth, $fileHeight, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $compressedImage->save(public_path('uploads/concerns/' . $fileName));

            $imagePath = 'uploads/concerns/' . $fileName;
        } else {
            $imagePath = $shop_by_concern->image;
        }

        $shop_by_concern->update([
            'title' => $request->title,
            'shop_page_title' => $request->shop_page_title,
            'shop_page_desc' => $request->shop_page_desc,
            'image' => $imagePath,
            'slug' => Str::slug($request->title, "-"),
        ]);

        return redirect()->route('admin.shop-by-concern.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concern $shop_by_concern)
    {
        Storage::disk('public')->delete($shop_by_concern->image);
        
        $shop_by_concern->delete();

        return redirect()->route('admin.shop-by-concern.index');
    }
}
