<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ror;

class RorController extends Controller
{
    public function index()
    {
        $rors = Ror::get();
        return view('admin.ror.index', compact('rors'));
    }

    public function create()
    {
        return view('admin.ror.create');
    }

    public function store(Request $request)
    {
        Ror::create($request->only('content'));
        return redirect()->route('admin.ror.index');
    }

    public function edit($id)
    {
        $ror = Ror::findOrFail($id);
        return view('admin.ror.edit', compact('ror'));
    }

    public function update(Request $request, $id)
    {
        $ror = Ror::findOrFail($id);
        $ror->update($request->only('content'));
        return redirect()->route('admin.ror.index');
    }

    public function destroy($id)
    {
        $ror = Ror::findOrFail($id);
        $ror->delete();
        return redirect()->route('admin.ror.index');
    }

    public function robotsDestroy(Request $request)
    {
        $ids = $request->ids;
        Ror::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Rors deleted successfully!']);
    }
}
