<?php


namespace App\Http\Services\SMSGateways;
use Nexmo;
use Twilio\Rest\Client;

// use GuzzleHttp\Client;
use Nexmo\Client\Credentials\Basic;

class NexmoLinkSms
{


    public function sendSms($phone, $message, $language = 'en', $model = null)
    {
        Nexmo::message()->send([
            'to'   => '447832915359',
            'from' => 'Yawy',
            'text' => $message
        ]);
    }


}
