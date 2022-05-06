<?php
namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\PurchaseOperation;
    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGet2()
    {
        return view('payment2');
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost2(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51KvM1uKyzqgHTfADBaOGi0FtjuZ9vq9OH8e7paXnv2cyswX3u2XmbnMgjiKVxxBkmx15hgqFyb80eSFxc7mEohSr00DjK2ePO4');
        try {
            \Stripe\Charge::create([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
        ]);
            error_log(json_encode($request->all()));
            $input = $request->all();

            try {
                $operation= PurchaseOperation::create([
                    'trainee_id'=>$input['trainee_id'],
                    'package_id'=>$input['package_id'],
                    'gym_id'=>$input['gym_id'],
                    'created_by_id'=>$input['created_by_id'],
                    'price'=>$input['price'],
                  ])->id;
            } catch (\Throwable $th) {
                Session::flash('fail', 'Invalid Trainee Data');
                return back();
            }
            

            Session::flash('success', 'Payment has been successfully processed.');
        } catch (\Throwable $th) {
            Session::flash('fail', 'Payment Failed!');
        }
        
          
        return back();
    }
    public function paymentGet($msg = null)
    {
        // dd($msg);
        if (!$msg) {
            return view('payment');
        } else {
            dd($msg);
            return view('payment');
        }
    }

    
    public function handlePost(Request $request)
    {
        error_log("=======!!!!!!!!!!!!==========");
        error_log(json_encode($request->all()));
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
            // PurchaseOperationController::store();
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            
            
            Session::flash("client_secret", $paymentIntent->client_secret);
            error_log(Session::get("client_secret"));
            echo json_encode($output);
        } catch (Error $e) {
            error_log("===========FAILED PAYMENT=======");
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
