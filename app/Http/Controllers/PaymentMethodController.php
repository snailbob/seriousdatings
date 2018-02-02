<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

use Netshell\Paypal\Facades\Paypal;
use Redirect;
use DB;
use Auth;

use App\PaymentMethod;

class PaymentMethodController extends Controller
{
    private $_apiContext;
    
    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));
        
        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function getCheckout($planID){

        $plan = DB::table('dating_plan')->where('id','=',$planID)->first();

        //dd($plan);


        $cycle = 'Y';

        $total_cycle = $plan -> noOfDay;
        $discountPrice = ($plan -> discountPercentage / 100 ) * $plan -> price;
        $cycle_amount = round(($plan -> price - $discountPrice),2);; //round(($plan -> price - $discountPrice) / $total_cycle,2);


        if($plan -> type == "Daily"){

            $cycle = 'D';
            $total_cycle = $plan -> noOfDay;
            $discountPrice = ($plan -> discountPercentage / 100 ) * $plan -> price;
            $cycle_amount = round(($plan -> price - $discountPrice),2); //round(($plan -> price - $discountPrice) / $total_cycle,2);
        }

        else if($plan -> type == "Monthly"){
            $cycle = 'M';
            $total_cycle = $plan -> noOfDay;
            $discountPrice = ($plan -> discountPercentage / 100 ) * $plan -> price;
            $cycle_amount = round(($plan -> price - $discountPrice),2); // round(($plan -> price - $discountPrice) / $total_cycle,2);
        }


        $product_name = $plan -> name;
        $product_currency = 'USD';
       


        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');
    
        $amount = PayPal::Amount();
        $amount->setCurrency($product_currency);
        $amount->setTotal($cycle_amount); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.
    
        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('SeriousDatings Dating Plan -'.$product_name);
    
        $redirectUrls = PayPal::RedirectUrls();
        $redirectUrls->setReturnUrl(url().'/getdone/'.$planID); //action('PaymentMethodController@getDone'));
        $redirectUrls->setCancelUrl(url().'/getcancel'); //action('PaymentMethodController@getCancel'));
    
        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));
    
        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;
        
        return Redirect::to( $redirectUrl );
    }
    
    public function getDone(Request $request, $plan_id)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');
        
        $payment = PayPal::getById($id, $this->_apiContext);
    
        $paymentExecution = PayPal::PaymentExecution();
    
        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $resp = json_decode($executePayment, true, 512);
        
        PaymentMethod::create([
            'user_id'=>Auth::user()->id,
            'plan_id'=>$plan_id,
            'gateway'=>'paypal',
            'details'=>serialize($request->all()),
            'payment_details'=>serialize($resp)
        ]);
        // dd($executePayment);
        
        // return response()->json($executePayment);
    
        // Clear the shopping cart, write to database, send notifications, etc.
    
        // Thank the user for the purchase
        return view('user.checkout_done');
    }
    
    public function getCancel()
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return view('user.checkout_cancel');
    }

    public function paymentGateway(){
        $user = Auth::user();
        return View::make('user.payment_gateway')->withUser($user);
        
    }


    public function squarePayment(Request $request){

        # Replace these values. You probably want to start with your Sandbox credentials
        # to start: https://docs.connect.squareup.com/articles/using-sandbox/

        # The access token to use in all Connect API requests. Use your *sandbox* access
        # token if you're just testing things out.
        $access_token = 'sandbox-sq0atb-WNUrsjmjr0KT3wbrCnqFZA';

        // # Helps ensure this code has been reached via form submission
        // if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        // error_log("Received a non-POST request");
        // echo "Request not allowed";
        // http_response_code(405);
        // return;
        // }

        // # Fail if the card form didn't send a value for `nonce` to the server
        $nonce = $request->input('nonce');
        $price = (int) $request->input('price');
        $id = $request->input('id');
        $type = $request->input('type');
        // return response()->json($request->input());

        if (empty($nonce)) {
            $arr = [
                'result'=> 'error',
                'message'=> "Invalid card data"
            ];
            // http_response_code(422);
            return response()->json($arr);
        }

        \SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
        $locations_api = new \SquareConnect\Api\LocationsApi();

        // $loc_arr = (array) $locations_api->listLocations();
        // return var_dump($locations_api);

        try {
            $locations = $locations_api->listLocations();
            # We look for a location that can process payments
            $location = current(array_filter($locations->getLocations(), function($location) {
                $capabilities = $location->getCapabilities();
                return is_array($capabilities) &&
                in_array('CREDIT_CARD_PROCESSING', $capabilities);
            }));

        } catch (\SquareConnect\ApiException $e) {
            $arr = [
                'result'=> 'error',
                'message'=> "Caught exception!",
                'details'=> json_encode($e->getResponseBody())
            ];
            return response()->json($arr);

            // echo "Caught exception!<br/>";
            // print_r("<strong>Response body:</strong><br/>");
            // echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
            // echo "<br/><strong>Response headers:</strong><br/>";
            // echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
            exit(1);
        }

        $transactions_api = new \SquareConnect\Api\TransactionsApi();

        # To learn more about splitting transactions with additional recipients,
        # see the Transactions API documentation on our [developer site]
        # (https://docs.connect.squareup.com/payments/transactions/overview#mpt-overview).
        $request_body = array (

            "card_nonce" => $nonce,

            # Monetary amounts are specified in the smallest unit of the applicable currency.
            # This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
            "amount_money" => array (
                "amount" => $price,
                "currency" => "USD"
            ),

            # Every payment you process with the SDK must have a unique idempotency key.
            # If you're unsure whether a particular payment succeeded, you can reattempt
            # it with the same idempotency key without worrying about double charging
            # the buyer.
            "idempotency_key" => uniqid()
        );

        # The SDK throws an exception if a Connect endpoint responds with anything besides
        # a 200-level HTTP code. This block catches any exceptions that occur from the request.
        try {
            $result = $transactions_api->charge($location->getId(), $request_body);
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            if($type == 'plan'){
                PaymentMethod::create([
                    'user_id'=>Auth::user()->id,
                    'plan_id'=>$id,
                    'gateway'=>'square',
                    'details'=>serialize($request->input()),
                    'payment_details'=>serialize([])
                ]);
            }


            

            $arr = [
                'result'=> 'success',
                'message'=> json_encode($result)
            ];



            return response()->json($arr);


        } catch (\SquareConnect\ApiException $e) {
            
            $arr = [
                'result'=> 'error',
                'message'=> "Caught exception!",
                'details'=> json_encode($e->getResponseBody())
            ];
            return response()->json($arr);

            // echo "Caught exception!<br/>";
            // print_r("<strong>Response body:</strong><br/>");
            // echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
            // echo "<br/><strong>Response headers:</strong><br/>";
            // echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
        }

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Paypal::getAll(array('count' => 1, 'start_index' => 0), $this->_apiContext);

        // PaymentMethod::create([
        //     'user_id'=>Auth::user()->id,
        //     'gateway'=>'paypal',
        //     'details'=>serialize(array('aw'=>'yeah'))
        // ]);
        
        return response()->json(json_decode($all, true, 512));
        // return response()->json($all);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
