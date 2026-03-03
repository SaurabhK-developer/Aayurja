<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    public function index()
    {
        $trackingCodes = DB::table('tracking_codes')->get();

        return view('admin.tracking.trackindex', compact('trackingCodes'));
    }

    public function create()
    {
        return view('admin.tracking.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TrackingCode' => 'required|string',
        ]);

        DB::table('tracking_codes')->insert([
            'TrackingCode' => $request->TrackingCode,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.tracking.index')->with('success', 'Tracking code saved successfully.');
    }

    public function edit($id)
    {
        $trackingCode = DB::table('tracking_codes')->where('id', $id)->first();

        if (!$trackingCode) {
            return redirect()->route('admin.tracking.index')->with('error', 'Tracking code not found.');
        }

        return view('admin.tracking.edit', compact('trackingCode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TrackingCode' => 'required|string',
        ]);

        DB::table('tracking_codes')
            ->where('id', $id)
            ->update([
                'TrackingCode' => $request->TrackingCode,
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.tracking.index')->with('success', 'Tracking code updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('tracking_codes')->where('id', $id)->delete();

        return redirect()->route('admin.tracking.index')->with('success', 'Tracking code deleted successfully.');
    }

    public function trackingDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids) && count($ids) > 0) {
            DB::table('tracking_codes')->whereIn('id', $ids)->delete();
            return redirect()->route('admin.tracking.index');
        }

        return redirect()->route('admin.tracking.index');
    }
}
