<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Urllist; 

class UrllistController extends Controller
{
    public function index()
    {
        $urls = Urllist::all();
        return view('admin.urllist.index', compact('urls'));
    }

    public function create()
    {
        return view('admin.urllist.create');
    }

    public function store(Request $request)
    {
        Urllist::create($request->only('url'));
        return redirect()->route('admin.urllist.index');
    }

    public function edit($id)
    {
        $url = Urllist::findOrFail($id);
        return view('admin.urllist.edit', compact('url'));
    }

    public function update(Request $request, $id)
    {
        $url = Urllist::findOrFail($id);
        $url->update($request->only('url'));
        return redirect()->route('admin.urllist.index');
    }

    public function destroy($id)
    {
        $url = Urllist::findOrFail($id);
        $url->delete();
        return redirect()->route('admin.urllist.index');
    }

    public function urllistDestroy(Request $request)
    {
        $ids = $request->ids;
        Urllist::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'URLs deleted successfully!']);
    }
}
