<?php

function createShipment($shipmentData, $authToken)
{
    $url = "https://staging-express.delhivery.com/api/cmu/create.json";
    $headers = [
        "Content-Type: application/json",
        "Accept: application/json",
        "Authorization: Token $authToken"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Wrap the shipment data in a 'data' key and include the format key
    $payload = [
        'format' => 'json', // Add the format key here
        'data' => $shipmentData // Include the shipment data under the 'data' key
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload)); // Pass the payload as JSON

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return "cURL Error: " . $curlError;
    }

    if ($httpCode == 200) {
        return json_decode($response, true);
    } else {
        return "Error: " . $httpCode . " - " . $response;
    }
}

// Example shipment data
$shipmentData = [
    'pickup_location' => [
        'name' => 'VARDHAN HOLIDAYS PVT LTD',
        'pin' => '244715',
        'address' => 'SHIVLALPUR PANDEY, NEAR RELIANCE PETROL PUMP',
        'phone' => '9548380831',
        'city' => 'Ramnagar',
        'country' => 'India',
    ],
    'shipments' => [
        [
            'return_address' => 'Return Address, Return City, PIN-400001',
            'order' => 'ORDER12345',
            'products_desc' => 'Books',
            'waybill' => '1234567890',
            'total_amount' => '1000',
            'cod_amount' => '0',
            'customer_address' => 'Customer Address, Customer City',
            'customer_city' => 'Mumbai',
            'customer_pincode' => '400001',
            'payment_mode' => 'Prepaid', // Corrected to use a string instead of a colon
            'customer_phone' => '8888888888'
        ]
    ]
];

$authToken = 'bba43ccf186e6fc1caaf97e11bbb358e10547306';  // Replace with your actual API token

// Call the createShipment function
$shipmentResponse = createShipment($shipmentData, $authToken);
print_r($shipmentResponse);

?>