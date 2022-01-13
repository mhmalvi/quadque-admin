<?php 
namespace App\Paypal;

use App\Paypal\PaypalToken;
use Illuminate\Support\Facades\Auth;
use App\Models\PaypalPaymentCreation;
use Illuminate\Support\Facades\Config;

class ServiceProviderPaymentMechanism
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function generatePayment()
    {
        // $config = Config::get('app');
      // return $request->all();

      $request = $this->request;

      $token = PaypalToken::generate(Auth::user()->id);

      // $check = PaypalPaymentCreation::where('order_id', $request->order_id)->where('customer_id', $request->customer_id)->exists();
      
      // if($check == false){
        
      
      
      $ch = curl_init('https://api.sandbox.paypal.com/v1/payments/payment');
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Bearer {$token['access_token']}"
      ));
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      $url =  env('APP_URL');

    //   $service_provider_id = Auth::user()->id;

      $return_url = $url.'/success/'.$request->order_id; 
      $cancel_url = $url.'/cancel'; 

        $payloadData = '{
          "intent":"sale",
          "redirect_urls":{
            "return_url":"'.$return_url.'",
            "cancel_url":"'.$cancel_url.'"
          },
          "payer":{
            "payment_method":"paypal"
          },
          "transactions":[
            {
              "amount":{
                "total":"'.$request->amount.'",
                "currency":"USD"
              },
              "description":"This is the payment transaction description."
            }
          ]
        }';
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadData);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        $result = curl_exec($ch);
        $array = json_decode($result, true); 
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $payInfo['order_id'] = $request->order_id;
        $payInfo['service_id'] = $request->service_id;
        $payInfo['provider_id'] = Auth::user()->id;
        $payInfo['customer_id'] = $request->customer_id;
        $payInfo['payment_id'] = $array['id'];

        foreach($array['links'] as $key => $linkInfo){
          
          if($linkInfo['rel'] == "approval_url"){

            $payInfo['checkout_url'] = $linkInfo['href'];

          }
          
          
          if($linkInfo['rel'] == "execute"){

            $payInfo['execute_url'] = $linkInfo['href'];

          }

        }

        

          PaypalPaymentCreation::where('order_id', $request->order_id)->update($payInfo);

          return response()->json([
            'status' => 200,
            'message' => 'Payment has been created successfully!'
          ]);

        // } else {

        //   return response()->json([
        //     'status' => 403,
        //     'message' => 'Payment has already been generated!'
        //   ]);

        // }
    }
}