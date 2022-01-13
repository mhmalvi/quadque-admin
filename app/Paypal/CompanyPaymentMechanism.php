<?php 
namespace App\Paypal;

use Auth;
use App\Models\User;
use App\Models\PaypalPaymentCreation;

class CompanyPaymentMechanism
{
   public $request;

   public function __construct($request)
   {
        $this->request = $request;
   }
   
    public function companyPaymentCreation()
    {
        $paymentData = $this->request;
        $user = User::where('user_type', 1)->first();

        $token = PaypalToken::generate($user->id);

        $check = PaypalPaymentCreation::where('order_id', $paymentData['order_id'])->where('admin_id', $user->id)->exists();
        
        if($check == false){              
        
        $ch = curl_init('https://api.sandbox.paypal.com/v1/payments/payment');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer {$token['access_token']}"
        ));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $url =  env('APP_URL');

        $service_provider_id = Auth::user()->id;

        $return_url = $url.'/admin/payment-success/'.$paymentData['order_id']; 
        $cancel_url = $url.'/admin/payment-cancel'; 

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
                    "total":"'.$paymentData['deduction'].'",
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

            $payInfo['order_id']    = $paymentData['order_id'];
            $payInfo['service_id']  = $paymentData['service_id'];
            $payInfo['provider_id'] = $paymentData['provider_id'];
            $payInfo['admin_id']    = $user->id;
            $payInfo['customer_id'] = $paymentData['customer_id'];
            $payInfo['payment_id']  = $array['id'];

            foreach($array['links'] as $key => $linkInfo){
            
            if($linkInfo['rel'] == "approval_url"){

                $payInfo['checkout_url'] = $linkInfo['href'];

            }
            
            
            if($linkInfo['rel'] == "execute"){

                $payInfo['execute_url'] = $linkInfo['href'];

            }

            }

        

          PaypalPaymentCreation::create($payInfo);

          return response()->json([
            'status' => 200,
            'message' => 'Payment has been created successfully!'
          ]);

        } else {

          return response()->json([
            'status' => 403,
            'message' => 'Payment has already been generated!'
          ]);

        }   
    }
}