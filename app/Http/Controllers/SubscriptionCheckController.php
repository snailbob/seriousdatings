<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use \App\User;
use App\Compatability;
use DB;
use Redis;
use DateTime;
use Auth;

class SubscriptionCheckController extends Controller
{


    public function checkSubscription()
    {
        if(Auth::user()){

          $user_id = Auth::user() -> id;
          $plan_id = DB::table('subscription')->where('user_id','=',$user_id)->pluck('plan_id');
          if($plan_id != null){
              $plan =  DB::table('dating_plan')->where('id','=',$plan_id)->first();
              $noOfDay = $plan -> noOfDay;
              if($plan -> type == 'Daily'){
                    $total_days = $noOfDay;
              }
              else if($plan -> type == 'Monthly'){
                    $total_days = $noOfDay * 30;
              }
              else{
                    $total_days = $noOfDay * 360;
              }
              $subscription_date = DB::table('subscription')->where('user_id','=',$user_id)->pluck('subscr_date');
              $date1=date_create($subscription_date);
              $date2=date_create(date("Y-m-d h:i:sa"));
              $diff=date_diff($date1,$date2);
              //dd($diff);
              if($diff -> days > $total_days)
              {
                DB::table('subscription')->where('user_id','=',$user_id)->delete();
                DB::table('role_user')->where('user_id','=',$user_id)->update(['role_id' => 1]);
                 
              }
          }
        }
    }
}
