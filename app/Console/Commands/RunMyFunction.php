<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cart;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class RunMyFunction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'myfunction:run'; // Command name
    protected $description = 'Runs the custom function daily';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Group cart data by user_id
        $abandonedCarts = Cart::with('user') // Assuming a `user` relationship exists
        ->select('user_id', 'product_id', 'quantity', 'weight') // Add required columns
        ->get()
        ->groupBy('user_id');

        // dd($abandonedCarts->first()[1]);
        $client = new Client();

        foreach ($abandonedCarts as $userId => $carts) {
            $user = $carts->first()->user; // Assuming all carts belong to the same user

            // dd($user);
            if (!$user || !$user->mobile) {
                Log::warning("No phone number for user ID: $userId");
                continue;
            }

            // Prepare dynamic product details
            $productDetails = [];
            foreach ($carts as $cart) {
                $productDetails[] = "{$cart->product->product_name} (Qty: {$cart->quantity})";
            }
            $productsText = implode(", ", $productDetails);

            // Send message via WATI API
            try {
                $watiApiUrl = "https://live-mt-server.wati.io/444418/api/v1/sendTemplateMessage?whatsappNumber=91{$user->mobile}";
                $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJlOWIxMmMwZC03YWQ1LTRmMTQtOGRkYi1iOTYxZjkzNTk4MTciLCJ1bmlxdWVfbmFtZSI6Imt1bGRlZXBAODhncmF2aXR5LmNvbSIsIm5hbWVpZCI6Imt1bGRlZXBAODhncmF2aXR5LmNvbSIsImVtYWlsIjoia3VsZGVlcEA4OGdyYXZpdHkuY29tIiwiYXV0aF90aW1lIjoiMDUvMTkvMjAyNSAxMjoxOTowNiIsInRlbmFudF9pZCI6IjQ0NDQxOCIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.m_LvCzL8-W-Bsoo9ynEBynAQyYmqzEbUZ-B1Ko_HGIw';
            
                $response = $client->post($watiApiUrl, [
                    'headers' => [
                        'Authorization' => "Bearer $apiKey",
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'template_name' => 'abandoned_cart_new',
                        'broadcast_name' => 'abandoned_cart_new',
                        'parameters' => [
                            ['name' => 'name', 'value' => $user->name], // Dynamic user name
                            ['name' => 'product_name', 'value' => $productsText], // Dynamic cart details
                            ['name' => 'coupon', 'value' => 'AAYURJA20'], // Dynamic or static coupon code
                            ['name' => 'coupon_percentage', 'value' => '20'], // Dynamic or static coupon code
                            ['name' => 'checkout_url', 'value' => 'https://www.aayurja.com/add-to-cart'], // Dynamic or static coupon code  
                        ],
                        'phone_number' => '91'.$user->mobile, // Dynamic phone number
                    ],
                ]);

                // Extract response body as string
                $responseBody = $response->getBody()->getContents();
                $statusCode = $response->getStatusCode();


                // Log success
                Log::info("WhatsApp message sent successfully to: {$user->mobile}");

            } catch (\Exception $e) {
                Log::error("Failed to send WhatsApp message to {$user->mobile}: " . $e->getMessage());
            }
        }
    }
}
