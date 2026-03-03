<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use App\Services\DelhiveryOrderService;
use Carbon\Carbon;
use App\Services\DelhiveryService;
use App\Http\Controllers\delhiveryController;


class DelhiveryController extends Controller
{
    protected $delhiveryService;

    public function __construct(DelhiveryOrderService $delhiveryService)
    {
        $this->delhiveryService = $delhiveryService;
    }

   
    public function forwardOrder($order_id)
    {
        $orders = Order::where('order_id', $order_id)->get();
      // dd($orders);
        if ($orders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No orders found with the given order ID'
            ], 404);
        }
    
        $firstOrder = $orders->first();
        $productDescriptions = [];
    
        foreach ($orders as $order) {
            $productDescriptions[] = $order->product_name;
        }
    
        $productsDesc = implode(', ', $productDescriptions);
        $paymentMode = ($firstOrder->payment_source == 'cashfree' || $firstOrder->payment_source == 'payU') ? 'Prepaid' : 'COD';
    
        $orderData = [
            "shipments" => [
                [
                    'order' => $firstOrder->order_id,
                    'products_desc' => $productsDesc,
                    'total_amount' => $firstOrder->grand_total,
                    'cod_amount' => $firstOrder->grand_total,
                    'name' => $firstOrder->customer_name,
                    'country' => 'India',
                    'phone' => $firstOrder->customer_phone,
                    'add' => $firstOrder->shipping_address,
                    'pin' => $firstOrder->shipping_pincode,
                    'payment_mode' => $paymentMode,
                    'shipping_mode' => 'Surface',
                ]
            ],
            "pickup_location" => [
                'name' => 'VARDHAN HOLIDAYS PVT LTD',
                'pin' => '244715',
                'address' => 'SHIVLALPUR PANDEY, NEAR RELIANCE PETROL PUMP',
                'phone' => '9548380831',
                'city' => 'Ramnagar',
                'email' => 'FC@TIARAAHOTELS.COM',
                'country' => 'India',
            ]
        ];
    
        $result = $this->delhiveryService->forwardOrder($orderData);
    
        
        if ($result['status'] === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => 'Order forwarded successfully',
                'data' => $result['data']
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => $result['message']
        ], 400);
    }




    public function track(Request $request, DelhiveryService $delhivery)
    {
        // dd('aa');
        $waybill = $request->input('waybill');
        $result = $delhivery->trackShipment($waybill);

        return response()->json($result);
    }
    
}
