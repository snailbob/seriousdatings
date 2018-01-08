<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
