<?php





return [

    /*
    |--------------------------------------------------------------------------
    | Indipay Service Config
    |--------------------------------------------------------------------------
    |   gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Paytm / Mocker
    */

    'gateway' => 'PayUMoney',                // Replace with the name of default gateway you want to use

    'testMode'  => false,                   // True for Testing the Gateway [For production false]

    'ccavenue' => [                         // CCAvenue Parameters
        'merchantId'  => env('INDIPAY_MERCHANT_ID', '2711910'),
        'accessCode'  => env('INDIPAY_ACCESS_CODE', 'AVDH94KH49AB89HDBA'),
        'workingKey' => env('INDIPAY_WORKING_KEY', '7246E6922F36C8EE1C8EE5CE8D34E707'),
        // Should be route address for url() function
        'redirectUrl' => env('INDIPAY_REDIRECT_URL', 'indipay-successful-response'),
        'cancelUrl' => env('INDIPAY_CANCEL_URL', 'indipay-cancle-response'),
        'currency' => env('INDIPAY_CURRENCY', 'INR'),
        'language' => env('INDIPAY_LANGUAGE', 'EN'),
    ],
    // PayUMoney Parameters
    'payumoney' => [ 
        'merchant_id' => '12570671',
        'merchantKey'  => env('PAYU_MERCHANT_KEY', '2dskrc'),
        'salt'  => env('PAYU_MERCHANT_SALT', 'RYYflR7mHMKtiUxYsCQiwyS3HQAqBOpO'),
        'workingKey' => env('INDIPAY_WORKING_KEY', ''),
        'successUrl' => env('PAYU_SUCCESS_URL', '/confirm'),
        'failureUrl' => env('PAYU_FAILURE_URL', '/confirm'),
    ],

    'payu' => [
        'merchant_id' => '12570671',
        'merchant_key' => '2dskrc',
        'salt' => 'RYYflR7mHMKtiUxYsCQiwyS3HQAqBOpO',
        'test_mode' => env('PAYU_TEST_MODE', false),
    ],






    'ebs' => [                         // EBS Parameters
        'account_id'  => env('INDIPAY_MERCHANT_ID', ''),
        'secretKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
        'return_url' => env('INDIPAY_SUCCESS_URL', 'indipay/response'),
    ],

    'citrus' => [                         // Citrus Parameters
        'vanityUrl'  => env('INDIPAY_CITRUS_VANITY_URL', ''),
        'secretKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
        'returnUrl' => env('INDIPAY_SUCCESS_URL', 'indipay/response'),
        'notifyUrl' => env('INDIPAY_SUCCESS_URL', 'indipay/response'),
    ],

    'instamojo' =>  [
        'api_key' => env('INSTAMOJO_API_KEY',''),
        'auth_token' => env('INSTAMOJO_AUTH_TOKEN',''),
        'redirectUrl' => env('INDIPAY_REDIRECT_URL', 'indipay/response'),
    ],

    'mocker' =>  [
        'service' => env('MOCKER_SERVICE','default'),
        'redirect_url' => env('MOCKER_REDIRECT_URL', 'indipay/response'),
    ],

    'zapakpay' =>  [
        'merchantIdentifier' => env('ZAPAKPAY_MERCHANT_ID',''),
        'secret' => env('ZAPAKPAY_SECRET', ''),
        'returnUrl' => env('ZAPAKPAY_RETURN_URL', 'indipay/response'),
    ],

    'paytm' =>  [
        'MERCHANT_KEY' => env('PAYTM_MERCHANT_KEY',''),
        'MID' => env('PAYTM_MID', ''),
        'CHANNEL_ID' => env('PAYTM_CHANNEL_ID', 'WEB'),
        'WEBSITE' => env('PAYTM_WEBSITE', 'WEBSTAGING'),
        'INDUSTRY_TYPE_ID' => env('PAYTM_INDUSTRY_TYPE_ID', 'Retail'),
        'REDIRECT_URL' => env('PAYTM_REDIRECT_URL', 'indipay/response'),
    ],

    // Add your response link here. In Laravel 5.2+ you may use the VerifyCsrf Middleware.
    'remove_csrf_check' => [
        'payumoney/response'
    ],





];
