<?php

namespace App\Services;

use GuzzleHttp\Client;
use Carbon\Carbon;

class DelhiveryOrderService
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
         $this->apiUrl = 'https://track.delhivery.com/api/cmu/create.json';
         // $this->apiUrl = 'https://staging-express.delhivery.com/api/cmu/create.json';
        $this->apiKey = '5b2ed2326ffab192726a1c65b9ef4a2d291ac05a';
    }

    public function forwardOrder($orderData)
    {
        // Prepare the data as a JSON string
        $data = json_encode($orderData);
    
        // Create the payload with the mandatory format and data parameters
        $payload = "format=json&data={$data}";
    
        try {
            $response = $this->client->post($this->apiUrl, [
                'headers' => [
                    'Authorization' => 'Token ' . $this->apiKey,
                    'Content-Type' => 'application/x-www-form-urlencoded', // Change to application/x-www-form-urlencoded
                ],
                'body' => $payload, // Send the payload as a URL-encoded string
            ]);
    
            $responseBody = json_decode($response->getBody()->getContents(), true);
            
            if ($response->getStatusCode() == 200) {
                return ['status' => 'success', 'data' => $responseBody];
            }
    
            return ['status' => 'error', 'message' => $responseBody['message'] ?? 'Failed to forward order'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
