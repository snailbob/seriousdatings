<?php
/*
	Author MARK:
	Statistical Report Data


*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\MapCodeController;
use App\Http\Controllers\Controller;
use App\GroupChatMessages;
use App\PaymentMethod;
use App\DatingPlan;
use App\EventMembers;
use App\Event;
use DB;
use Auth;


class StatisticsDataController extends Controller
{
   

	
	public function populateStatisticsReport(){
        return response()->json(['demoGraph'=>self::UserLatLngFormat(),
                                'datingSales'=>self::SalesGraph(),
                            	'eventsSales'=>self::SalesGraphEvents(),
                            	'virtualSales'=>self::SalesVirtual()]);
    }

    public static function UserLatLngFormat(){
        $state = array();
        $format = array();
        $users = DB::table('users')->select('country_shortname', DB::raw('count(country_shortname) as total_count'))->groupBy('country_shortname')->get();
        foreach ($users as $key => $value) {
              
            if (array_key_exists($value->country_shortname,MapCodeController::CodeMapper())) {
                
                $state['state'] = $value->country_shortname;
                $state['counts'] = $value->total_count;
                $format[] = $state;
            }
        }
        return $format;
    }

     public static function SalesGraph(){
        $sales = array();
        $format = array();
        $allPayment = PaymentMethod::all();
        
        foreach ($allPayment as $key => $value) {
        	
        	$sales['gateWayMethod'] = $value->gateway;
        	$sales['payDate'] = date("Y-m-d", strtotime($value->created_at));
        	$sales['price'] = DatingPlan::find($value->plan_id)->price;
        	$format[] = $sales;

        }

         return $format;    
    }

     public static function SalesGraphEvents(){
        $sales = array();
        $format = array();
        $allPayment = EventMembers::where('paid','=',1)->get();
        
        foreach ($allPayment as $key => $value) {
        	
        	$sales['payDate'] = date("Y-m-d", strtotime($value->created_at));
        	$sales['price'] = Event::where('id','=',$value->event_id)->first(['eventPrice']);
        	$format[] = $sales;

        }

         return $format;    
    }



    public static function SalesVirtual(){
        $sales = array();
        $format = array();
        $allPayment = GroupChatMessages::where('paid','=',1)->where('type','=','virtual_gift')->get();
        
        foreach ($allPayment as $key => $value) {
        	
        	$sales['payDate'] = date("Y-m-d", strtotime($value->created_at));
        	$sales['price'] =  $value->price;
        	$format[] = $sales;

        }

         return $format;    
    }
    

    public static function unserializeData($trans = array()){
    		switch ($trans['gateWayMethod']) {
    			case 'paypal':

    			$details = unserialize($trans['detals']);
    			$payDetails = unserialize($trans['payDetails']);

    				break;
    			
    			default:
    				# code...
    				break;
    		}
    	return array('details'=>$details,'payDetails'=>$payDetails);
    }


}
