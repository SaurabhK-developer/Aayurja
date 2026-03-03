<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DelhiveryService;

class PinCodeController extends Controller
{
    protected $delhiveryService;

    public function __construct(DelhiveryService $delhiveryService)
    {
        $this->delhiveryService = $delhiveryService;
    }

    public function checkServiceability(Request $request)
    {
        $request->validate([
            'pin_code' => 'required|digits:6'
        ]);

        $pinCode = $request->input('pin_code');

        try {
            $response = $this->delhiveryService->checkPinCodeServiceability($pinCode);

            if ($response['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => $response['delivery_date'],
                    'data' => $response['data']
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => $response['message']
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to check serviceability. Please try again later.'
            ], 500);
        }
    }
}
