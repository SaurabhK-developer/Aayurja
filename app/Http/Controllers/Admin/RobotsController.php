<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Robots;

class RobotsController extends Controller
{
    public function index()
    {
        $robots = Robots::get();
        return view('admin.robots.index', compact('robots'));
    }

    public function create()
    {
        return view('admin.robots.create');
    }

    public function store(Request $request)
    {
        Robots::create($request->only('content'));
        return redirect()->route('admin.robots.index');
    }

    public function edit($id)
    {
        $robot = Robots::findOrFail($id);
        return view('admin.robots.edit', compact('robot'));
    }

    public function update(Request $request, $id)
    {
        $robot = Robots::findOrFail($id);
        $robot->update($request->only('content'));
        return redirect()->route('admin.robots.index');
    }

    public function destroy($id)
    {
        $robot = Robots::findOrFail($id);
        $robot->delete();
        return redirect()->route('admin.robots.index');
    }

    public function robotsDestroy(Request $request)
    {
        $ids = $request->ids;
        Robots::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Robots deleted successfully!']);
    }
}
