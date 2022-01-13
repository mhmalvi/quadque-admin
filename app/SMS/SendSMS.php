<?php 
namespace App\SMS;

use Twilio\Rest\Client;

class SendSMS
{
    public static function sendMsg($sms, $recipients_phone)
    {
        $account_sid   = getenv("TWILIO_SID");
        $auth_token    = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client        = new Client($account_sid, $auth_token);      

        $client->messages->create($recipients_phone, 
                ['from' => $twilio_number, 'body' => $sms] );
    }
}