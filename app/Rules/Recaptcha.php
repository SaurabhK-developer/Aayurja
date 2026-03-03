<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $secret = config('services.recaptcha.secretKey');

       $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$value");

    $responseData = json_decode($response);

        return isset($responseData->success) && $responseData->success;
    }

    public function message()
    {
        return 'Google reCAPTCHA verification failed. Please try again.';
    }
}
