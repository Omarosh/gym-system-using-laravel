<?php
namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Session;
use Stripe;
    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function paymentGet($msg = null)
    {
        // dd($msg);
        if (!$msg) {
            return view('payment');
        }else{
            dd($msg);
            return view('payment');
        }
    }

    
    public function handlePost(Request $request)
    {
        error_log('Some message here.');
        //4000 0025 0000 3155
        \Stripe\Stripe::setApiKey('sk_test_51KvM1uKyzqgHTfADBaOGi0FtjuZ9vq9OH8e7paXnv2cyswX3u2XmbnMgjiKVxxBkmx15hgqFyb80eSFxc7mEohSr00DjK2ePO4');
        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
        
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                // Replace this constant with a calculation of the order's amount
        // Calculate the order total on the server to prevent
        // people from directly manipulating the amount on the client
                'amount' => 1400,
                
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
        
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
        
            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
   
}