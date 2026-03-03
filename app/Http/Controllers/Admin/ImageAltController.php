<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ImageAlt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ImageAltController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    if (optional(Auth::user())->role !== 1) {
        return abort(403, 'Unauthorized action.');
    }

    $directory = resource_path('views/website');

    $files = File::files($directory);

    if (empty($files)) {
        return redirect()->back()->with('error', 'No Blade files found in the directory.');
    }

    ImageAlt::truncate();

    foreach ($files as $file) {
        if ($file->getExtension() !== 'php' || !str_contains($file->getFilename(), '.blade.php')) {
            continue;
        }

        $filePath = $file->getRealPath();
        $fileContents = File::get($filePath);

        preg_match_all('/<img\b[^>]*>/i', $fileContents, $imgMatches);
        $imgTags = $imgMatches[0] ?? [];

        $imgTagCount = count($imgTags);
        $imgWithAltCount = 0;
        $imgAltNullCount = 0;
        $imgSrcsWithoutAlt = [];
        $imgSrcsWithNullAlt = []; 

        foreach ($imgTags as $imgTag) {
            if (preg_match('/\balt=["\']([^"\']*)["\']/', $imgTag, $altMatch)) {
                $altValue = $altMatch[1];
        
                if (empty(trim($altValue))) {
                    $imgAltNullCount++;
        
                    // Capture source for null/empty alt images
                    if (preg_match('/\bsrc=["\']{{\s*url\((.*?)\)\s*}}["\']/', $imgTag, $srcMatch)) {
                        $srcValue = trim($srcMatch[1], '\'"');
                        $cleanedSrc = url($srcValue);
                        $imgSrcsWithNullAlt[] = $cleanedSrc;
                    } elseif (preg_match('/\bsrc=["\']([^"\']+)["\']/', $imgTag, $srcMatch)) {
                        $srcValue = $srcMatch[1];
                        $cleanedSrc = str_replace('admin/', '', $srcValue);
                        $cleanedSrc = url('public/' . $cleanedSrc);
                        $imgSrcsWithNullAlt[] = $cleanedSrc;
                    }
                } else {
                    $imgWithAltCount++;
                }
            } else {
                if (preg_match('/\bsrc=["\']{{\s*url\((.*?)\)\s*}}["\']/', $imgTag, $srcMatch)) {
                    $srcValue = trim($srcMatch[1], '\'"');
                    $cleanedSrc = url($srcValue);
                    $imgSrcsWithoutAlt[] = $cleanedSrc;
                } elseif (preg_match('/\bsrc=["\']([^"\']+)["\']/', $imgTag, $srcMatch)) {
                    $srcValue = $srcMatch[1];
                    $cleanedSrc = str_replace('admin/', '', $srcValue);
                    $cleanedSrc = url('public/' . $cleanedSrc);
                    $imgSrcsWithoutAlt[] = $cleanedSrc;
                }
            }
        }
        

        $imgWithoutAltCount = $imgTagCount - $imgWithAltCount - $imgAltNullCount;

        ImageAlt::updateOrCreate(
            ['file_name' => $file->getFilename()],
            [
                'total_images' => $imgTagCount,
                'images_with_null_alt' => $imgAltNullCount,
                'images_without_alt' => $imgWithoutAltCount,
                'image_sources' => json_encode($imgSrcsWithoutAlt),
                'image_sources_with_null_alt' => json_encode($imgSrcsWithNullAlt), // New column
            ]
        );
    }

    $imagealts = ImageAlt::get();

    return view('admin.imagealt.index', compact('imagealts'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        return redirect()->route('admin.imagealt.index');
    }
        
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate input data
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find and delete the record
        
    }
}
