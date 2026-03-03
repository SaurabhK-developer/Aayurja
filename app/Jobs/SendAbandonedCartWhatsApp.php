<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;



use GuzzleHttp\Client;
use App\AbandonedCart; // Model for abandoned carts
use Illuminate\Support\Facades\Log;

class SendAbandonedCartWhatsApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Fetch abandoned carts that need reminders
        $abandonedCarts = AbandonedCart::where('is_reminded', false)
            ->where('created_at', '<=', now()->subHours(2)) // Carts older than 2 hours
            ->get();

        // $watiApiUrl = 'https://api.wati.io/v1/sendTemplateMessage';
        $watiApiUrl = 'https://live-mt-server.wati.io/356491';
        
        $apiKey = env('WATI_API_KEY');

        $client = new Client();

        foreach ($abandonedCarts as $cart) {
            try {
                // Prepare data for WATI API
                $response = $client->post($watiApiUrl, [
                    'headers' => [
                        'Authorization' => "Bearer $apiKey",
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'template_name' => 'abandoned_cart_reminder',
                        'broadcast_name' => 'Abandoned Cart Campaign',
                        'parameters' => [
                            ['name' => '1', 'value' => $cart->user->name], // Name
                            ['name' => '2', 'value' => $cart->cart_summary], // Cart details
                            ['name' => '3', 'value' => $cart->coupon_code], // Coupon code
                        ],
                        'phone_number' => $cart->user->phone,
                    ],
                ]);

                // Mark the cart as reminded
                $cart->update(['is_reminded' => true]);

                Log::info("WhatsApp message sent successfully to: {$cart->user->phone}");
            } catch (\Exception $e) {
                Log::error("Failed to send WhatsApp message: " . $e->getMessage());
            }
        }
    }
}
