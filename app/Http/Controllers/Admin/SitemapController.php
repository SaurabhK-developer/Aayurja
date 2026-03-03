<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sitemap; 

class SitemapController extends Controller
{
    public function index()
    {
        $sitemaps = Sitemap::get(); 
        return view('admin.sitemap.index', compact('sitemaps'));
    }

    public function create()
    {
        return view('admin.sitemap.create');
    }
    
    public function store(Request $request)
    {
        Sitemap::create($request->only('url'));
        return redirect()->route('admin.sitemap.index');
    }
    
    public function edit($id)
    {
        $sitemap = Sitemap::findOrFail($id);
        return view('admin.sitemap.edit', compact('sitemap'));
    }
    
    public function update(Request $request, $id)
    {
        $sitemap = Sitemap::findOrFail($id);
        $sitemap->update($request->only('url'));
        return redirect()->route('admin.sitemap.index');
    }

    
    
    public function destroy($id)
    {
        $sitemap = Sitemap::findOrFail($id);
        $sitemap->delete();
        return redirect()->route('admin.sitemap.index');
    }
    
    public function sitemapDestroy(Request $request)
    {
        $ids = $request->ids;
        Sitemap::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Sitemaps deleted successfully!']);
    }
}