<?php



namespace App\Http\Controllers;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;

use App\Compatability;
use App\PaymentMethod;

use DB;

use Auth;

use Redirect;

use Input;



class DatingPlanController extends Controller

{

 

	

    public function getIndex()

    {

        if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
            

            $plans = DB::table('dating_plan')->get();

            foreach ($plans as $plan) {
                $total_cycle = $plan -> noOfDay;
                $discountPrice = ($plan -> discountPercentage / 100 ) * $plan -> price;
                $cycle_amount = round(($plan -> price - $discountPrice) / $total_cycle,2);
                $plan->discountPrice = $cycle_amount;
            }

            $username = Auth::user() -> username;

            $user_id = Auth::user() -> id;

            $check = DB::table('subscription')->where('user_id','=',$user_id)->pluck('id');
            $my_subscription = $this->check_subscription_validity(); //PaymentMethod::where('user_id', $user_id)->orderBy('id', 'desc')->first();
            
            if($check < 1){
                $subscribed = 0;
                $subscribe_details = "";
            }

            else{
                $subscribed = 1;
                $subscribe_details = DB::table('subscription')->where('id','=',$check)->first();
            }

            // return "Dating Plan";
            $result = array(
                'current_user'=> array( 'username'=> $username),
                'plans'=> $plans,
                'subscribed'=> $subscribed,
                'my_subscription'=> $my_subscription,
                'subscribe_details'=> $subscribe_details,
                'today_date'=> date("h:i:s M d, Y")
            );

            // return response()->json($my_subscription);

            //  dd($result);

            return \View::make('datingPlan')->with("data",$result);

        }

        else{
            return redirect(url());
        }

    }

    public function check_subscription_validity($user_id = null){
        $my_subscription = null;
        $user_id = (!empty($user_id)) ? $user_id : 0;
        $user_id = (Auth::check() && empty($user_id)) ? Auth::user()->id : $user_id;
        
        if(!empty($user_id)){

            // $user_id = Auth::user()->id;
            $my_subscription = PaymentMethod::where('user_id', $user_id)->orderBy('id', 'desc')->first();


            if(isset($my_subscription->id)){
                $my_subscription->details = (@unserialize($my_subscription->details)) ? unserialize($my_subscription->details) : array();
                $my_subscription->payment_details = (@unserialize($my_subscription->payment_details)) ? unserialize($my_subscription->payment_details) : array();

                if($my_subscription->gateway == 'paypal'){
                    $create_time = $my_subscription->payment_details['create_time'];
                    $my_subscription->mode = 'subscribed';
        
                    //calculate remaining days
                    $now = time(); // or your date as well
                    $subscription_date = strtotime($create_time);
                    $datediff = $now - $subscription_date;

                    $passed_days = floor($datediff / (60 * 60 * 24));

                    $plan_no_of_days = $this->plan_no_of_days($my_subscription->plan_id);
                    $my_subscription->plan_details = DB::table('dating_plan')->where('id', $my_subscription->plan_id)->first();
                    $my_subscription->plan_no_of_days = $plan_no_of_days;
                    
                    $my_subscription->subscription_date = date('Y-m-d',$subscription_date);
                    $my_subscription->passed_days = $passed_days;
                    $my_subscription->remaining_days = max($plan_no_of_days - $passed_days, 0);
                    $my_subscription->is_expired = (empty($my_subscription->remaining_days)) ? true : false;
                    $my_subscription->status_text = ($my_subscription->is_expired) ? 'Expired' : 'Active';
                    
                }
            }
            else{
                $timeActivated = Auth::user()->timeActivated;
                $my_subscription['gateway'] = 'unknown';
                $my_subscription['mode'] = 'trial';

                //calculate remaining days
                $now = time(); // or your date as well
                $subscription_date = strtotime($timeActivated);
                $datediff = $now - $subscription_date;

                $passed_days = floor($datediff / (60 * 60 * 24));
                
                $plan_no_of_days = 1;
                $my_subscription['plan_no_of_days'] = $plan_no_of_days;
                
                $my_subscription['subscription_date'] = date('Y-m-d',$subscription_date);

                $my_subscription['passed_days'] = $passed_days;
                $my_subscription['remaining_days'] = max($plan_no_of_days - $passed_days, 0);
                $my_subscription['is_expired'] = (empty($my_subscription['remaining_days']) || $my_subscription['remaining_days'] <= 0) ? true : false;
                $my_subscription['status_text'] = ($my_subscription['is_expired']) ? 'Expired' : 'Active';
                

                // $my_subscription->user_id
            }

        }
        
        return $my_subscription;
    }

    public function plan_no_of_days($planID){

        $plan = DB::table('dating_plan')->where('id','=',$planID)->first();

        //dd($plan);

        $cycle = 'Y';
        $total_days = $plan->noOfDay * 365;

        if($plan -> type == "Daily"){
            $cycle = 'D';
            $total_days = $plan -> noOfDay;
        }

        else if($plan -> type == "Monthly"){
            $cycle = 'M';
            $total_days = $plan -> noOfDay * 30;
        }

        return $total_days;

    }

    public function remaining_days(){

    }



    public function subscribe($planID){

        $plan = DB::table('dating_plan')->where('id','=',$planID)->first();

        //dd($plan);



        if($plan -> type == "Daily"){

            $cycle = 'D';

            $total_cycle = $plan -> noOfDay;

            $discountPrice = ($plan -> discountPercentage / 100 ) * $plan -> price;

            $cycle_amount = round(($plan -> price - $discountPrice) / $total_cycle,2);

            
        }

        else if($plan -> type == "Monthly"){

            $cycle = 'M';

            $total_cycle = $plan -> noOfDay;

            $discountPrice = ($plan -> discountPercentage / 100 ) * $plan -> price;

            $cycle_amount = round(($plan -> price - $discountPrice) / $total_cycle,2);

        }

        else{

            $cycle = 'Y';

            $total_cycle = $plan -> noOfDay;

            $discountPrice = ($plan -> discountPercentage / 100 ) * $plan -> price;

            $cycle_amount = round(($plan -> price - $discountPrice) / $total_cycle,2);

        }

        $product_name = $plan -> name;

        $product_currency = 'USD';
       
		  
        //Here we can use paypal url or sanbox url.

        $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

        //Here we can used seller email id. 

        $merchant_email = 'zebe-facilitator@cartelera.org';

        //here we can put cancle url when payment is not completed.

        $cancel_return = url().'/datingPlan'.'/'.$planID.'/cancel';

        //here we can put cancle url when payment is Successful.

        $success_return = url().'/datingPlan'.'/'.$planID.'/succes';



        $date_now = date("Y-m-d");

        //dd($date_now);

        

        $result  = array(
            'url' => $paypal_url,	

            'merchant_email' => $merchant_email,

            'product_name' => $plan -> name,

            'total_cycle' => $total_cycle,

            'cycle_amount' => $cycle_amount,

            'cycle' => $cycle,

            'product_currency' => $product_currency,

            'cancel_return' => $cancel_return,

            'success_return' => $success_return,

            'planID' => $planID,

            'user_id' => Auth::user() -> id,

            'date_now' => $date_now
        );

        //dd($result);

        //dd($cycle_amount);

        if($cycle_amount == 0){
            return \View::make('paypalSubscribeFree')->with("data",$result);
        }

        return \View::make('paypalSubscribe')->with("data",$result);

    }

    

    public function cancel ($planID){



        return redirect(url().'/profile/datingPlan');

    }



    public function success (){



        //dd($_POST);

        $custom  = explode(",",$_REQUEST['custom']);

        $user_id = $custom[0];

        $plan_id = $custom[1];

        $subscr_id = $_REQUEST['subscr_id']; // Product ID

        $payer_email = $_REQUEST['payer_email']; // Paypal transaction ID

        $payer_id = $_REQUEST['payer_id']; // Paypal received amount value

        #$subscr_date = $_REQUEST['subscr_date']; // Paypal received currency type
		$subscr_date = date("Y-m-d h:i:s");
        
		$subscr_price = $_REQUEST['amount3'];

        
        $auth = $_REQUEST['auth']; // Paypal product status  
		
		if(strpos($_REQUEST['period3'],"D"))
		   {
		     $subs_end_date = date("Y-m-d h:i:s",strtotime($subscr_date.'+ 1 day'));
		   }
		elseif(strpos($_REQUEST['period3'],"M"))
		   {
		     $subs_end_date = date("Y-m-d h:i:s",strtotime('+ 1 month'));
		   }   
		#print_r($_REQUEST);
		#exit;

        if($plan_id > 0){



            $check = DB::table('subscription')->where('user_id','=',$user_id)->pluck('id');

            if($check < 1){

                DB::table('subscription')->insert([
                    'user_id'=>$user_id,
                    'plan_id'=>$plan_id,
                    'subscr_id'=>$subscr_id,
                    'payer_email'=>$payer_email,
                    'payer_id'=>$payer_id,
                    'subscr_date'=>$subscr_date,
                    'subscr_price'=>$subscr_price,
                    'auth'=>$auth,
                    'subs_end_date'=>$subs_end_date
                ]);

                  DB::table('role_user')
                    ->where('user_id', $user_id)
                    ->update(['role_id' => '4']);



            }

        }



        //dd($product_transaction);

        return redirect(url().'/profile/datingPlan');

    }



    public function succes(){        

        dd("succes");

    }

    

    	

 

}

