<?php 
namespace App\Paypal;

use App\Models\PaypalCredential;

class PaypalToken
{

    public static function generate($user_id)
    {


      $credentials = PaypalCredential::where('user_id', $user_id)->first();

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.paypal.com/v1/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_USERPWD => $credentials->client_id.":".$credentials->secret_id,
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Language: en_US"
        ),
        ));
    
        $result= curl_exec($curl);
    
      return  $array=json_decode($result, true); 
        $token = $array['access_token'];
        return $token;
    }
    
}