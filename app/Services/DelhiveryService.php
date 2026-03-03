<?php

namespace App\Services;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class DelhiveryService
{
    protected $client;
    protected $apiUrl = 'https://track.delhivery.com/c/api/pin-codes/json/';
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        // $this->apiKey = 'bba43ccf186e6fc1caaf97e11bbb358e10547306' ;  // Store your API key in the .env file
        $this->apiKey = '17edd76fd13e2395f48a48d62e55f99378417857' ;  // FOR TESTING

        
        $this->trackingUrl = 'https://staging-express.delhivery.com/api/v1/packages/json/?waybill=';     //FOR STAGING SHIPMENT TRACKING URL
        // $this->trackingUrl = 'https://track.delhivery.com/api/v1/packages/json/?waybill=';     //FOR LIVE

    }

    public function checkPinCodeServiceability($pinCode)
    {
        $response = $this->client->get($this->apiUrl, [
            'query' => [
                'token' => $this->apiKey,
                'filter_codes' => $pinCode
            ]
        ]);
    
        $data = json_decode($response->getBody()->getContents(), true);
    
        // Log the entire response for debugging
        \Log::info('Delhivery API Response: ', $data);  // Logs to Laravel log
    
        // Or use dd() to output the response directly (only use this for testing)
        // dd($data);
    
        // Assuming the delivery_codes array contains serviceability information
        if (isset($data['delivery_codes']) && !empty($data['delivery_codes'])) {
            $deliveryDetails = $data['delivery_codes'][0];
            $deliveryDays = $deliveryDetails['estimated_delivery_days'] ?? 5; // Default to 5 days if not present
    
            // Calculate the delivery date
            $deliveryDate = Carbon::now()->addDays($deliveryDays);
    
            // Format the delivery date as '22 Oct, Tuesday'
            $formattedDeliveryDate = $deliveryDate->format('d M, l');
    
            return [
                'status' => 'success',
                'delivery_date' => 'Delivery by ' . $formattedDeliveryDate,
                'data' => $data
            ];
        }
    
        return ['status' => 'error', 'message' => 'Service not available for this pin code'];
    }



    public function trackShipment($waybill)
    {
        try {
            $response = $this->client->get($this->trackingUrl . $waybill, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Token ' . $this->apiKey
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return [
                'error' => false,
                'data' => $data
            ];

        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}