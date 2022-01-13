<?php 
namespace App\Paypal;

use App\Models\User;
use App\Models\Order;
use App\Paypal\PaypalToken;
use Illuminate\Support\Facades\Auth;
use App\Models\PaypalPaymentCreation;
use App\Models\Wallet;

class CompanyPaymentExecution
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function processing()
    {
        
        $request = $this->request;                
        $user = User::where('user_type', 1)->first();
        $userId = $user->id;
        $token = $token = PaypalToken::generate($userId);

        $payloadData = '{
        "payer_id": "'.$request->PayerID.'"
        }';

        $paymentId = $request->paymentId;
        $ch = curl_init("https://api-m.sandbox.paypal.com/v1/payments/payment/{$paymentId}/execute");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Bearer {$token['access_token']}"
        ));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadData);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        $result = curl_exec($ch);
        $array = json_decode($result, true); 
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

            
            $companyFee = Order::find($request->order_id);

           Wallet::create([
               'order_id' => $request->order_id,
               'user_id'  => $userId,
                'amount'  => $companyFee->deduction
           ]);



            Order::find($request->order_id)->update(
                [
                    'order_status' => 1,
                    'is_company_payment' => 1,
                ]
            );

        

        
        return response()->json([
            'status' => 200,
            'message' => 'Company Payment Transaction has been succeed!'
        ]);
    }
}