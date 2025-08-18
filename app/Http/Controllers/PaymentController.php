<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function generateAccessToken(){
        $passkey=env('PASSKEY');
        $consumerKey=env('CONSUMER_KEY');
        $consumerSecret=env('CONSUMER_SECRET');
        $authorization= base64_encode($consumerKey.':'.$consumerSecret);
        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $authorization]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $data=json_decode($response);
        return $data->access_token;

    }
    public function stkPush(){
        $accessToken=$this->generateAccessToken();
        $phone_number=254790194570;
        $amount=1;
        $passkey=env('PASSKEY');
        $businessShortCode='174379';
        $timestamp='20250818145708';
        $password= base64_encode($businessShortCode .$passkey. $timestamp);

            $payload= json_encode([
                    "BusinessShortCode"=>174379,
                    "Password"=> $password,
                    "Timestamp"=> $timestamp,
                    "TransactionType"=> "CustomerPayBillOnline",
                    "Amount"=> $amount,
                    "PartyA"=> $phone_number,
                    "PartyB"=> 174379,
                    "PhoneNumber"=> $phone_number,
                    "CallBackURL"=> "https://e9d29b9cbac8.ngrok-free.app/api/mpesaCallback",
                    "AccountReference"=> "CompanyXLTD",
                    "TransactionDesc"=> "Payment of X" 
                ]);
            
            $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $accessToken",
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response     = curl_exec($ch);
            curl_close($ch);
            return $response;
    }
    public function mpesaCallback(Request $request){
        $data = json_decode($request->getContent());
        Log::info('M-Pesa Callback:', array($data));
        $result=$data->Body->stkCallback->CallbackMetadata;
        $amount=$result->Item[0]->Value;
        $mpesaReceiptno=$result->Item[1]->Value;
        $phoneNumber=$result->Item[4]->Value;
        $formattedPhone=str_replace('254','0',$phoneNumber);
            Payment::create([
                "Amount"=>$amount,
                "mpesa_receipt"=>$mpesaReceiptno,
                "phone_number"=>$formattedPhone,
            ]);
    
        return response()->json([
            'ResultCode' => 0,
             'ResultDesc' => 'Success'
            
        ]);
       
    
    }
}
