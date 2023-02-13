<?php


namespace App\Http\Services\SMSGateways;

use Twilio\Rest\Client;


// use GuzzleHttp\Client;

class VictoryLinkSms
{
    // public $client;

    // public function __construct()
    // {
    //     if (! $this->client) {
    //         $this->client = new Client();
    //     }
    // }

    // public function sendSms($message, $recipients)
    // {
    //     $account_sid = getenv("TWILIO_SID");
    //     $auth_token = getenv("TWILIO_AUTH_TOKEN");
    //     $twilio_number = getenv("TWILIO_NUMBER");
    //     $client = new Client($account_sid, $auth_token);
    //     $client->messages->create($recipients, 
    //             ['from' => $twilio_number, 'body' => $message] );
    // }


    public function sendSms()
    {

            $sid    =  "ACd4c02d05c18d2fd92227b4ab0bd5d39e"; 
            $token  = "e897b13962ab1b639404f939279f003e"; 
            $client = new Client($sid, $token); 
            $from =  "+12173354778";
            $twilio_number = '+447832915359';
            $message="jii";

            $message= $client->messages->create($twilio_number, 
            ['from' => $from, 'body' => $message] );
            // $message = $twilio->messages->create( "+447832915359", // to 
            //         array(
            //             // Change the 'From' number below to be a valid Twilio number 
            //             // that you've purchased
            //             'from' =>  $from, 
            //             // the sms body
            //             'body' => "the sms body here "
            //         )
            //       ); 

                //   $twilio->messages->create({
                //     from : $twilio_number,body : "Your message",to :'+447832915359'
                //   });
                //   $to, 
                //   ['from' => $twilio_number, 'body' => "Your message"] );
       return  $message;
           // protected function messageSendToMobile($details, $message, $user, $imageUrl = null){
        // $accountSid = env('TWILIO_SID');
        // $authToken = env('TWILIO_AUTH_TOKEN');
        // $twilioNumber = env('TWILIO_NUMBER');
        // $lineBreak = "\n\n";
        // $to = "00447832915359";
        // $client = new Client($accountSid, $authToken);
        //     try {
        //         $client->messages->create(
        //             $to,
        //             [
        //                 "body" => $message,
        //                 "from" => $twilioNumber
        //             ]
        //         );
        //         Log::info('Message sent to ' . $twilioNumber);
        //     } catch (TwilioException $e) {
        //         Log::error(
        //             'Could not send SMS notification.' .
        //             ' Twilio replied with: ' . $e
        //         );
        //     }
        // }
    }

    // public function sendSms($phone, $message, $language = 'en', $model = null)
    // {
    //     $params = [
    //         'UserName' => config('TWILIO_SID'),
    //         'Password' => config('TWILIO_AUTH_TOKEN'),
    //         'SMSText' => $message,
    //         'SMSLang' => $language == 'ar' ? 'A' : 'E',
    //         'SMSSender' => config('TWILIO_NUMBER'),
    //         'SMSReceiver' => $phone,
    //     ];

    //     try {
    //         $smsURL = "https://smsvas.vlserv.com/KannelSending/service.asmx/SendSMS";

    //         $response = $this->client->post($smsURL, ['form_params' => $params ]);
    //         $content = $response->getBody();

    //         $xml = (array) simplexml_load_string($content);

    //         if ($xml[0] == '0') {
    //             return true;
    //         } else {

    //             info("VictoryLink error status!");  // log
    //             return false;
    //         }
    //     } catch (\Exception $e) {
    //         info("VictoryLink has been trying to send sms to $phone but operation failed !");
    //         return false;
    //     }
    // }

    /**
     * SET YOUR CLIENT TO MOVE FORWARD TO SEND A NEW SMS.
     *
     * @param Client $client
     *
     * @return $this
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
