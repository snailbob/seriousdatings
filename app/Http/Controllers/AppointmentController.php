<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use DB;
use App\AppointMent;
use App\User;
use App\Http\Controllers\NotiFierLogsController;
use Illuminate\Support\Facades\View;
class AppointmentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveAppointment(Request $request){

        $days = implode(",",$request->input('day'));
        $time = implode(",",$request->input('time'));
        $specificDateTime = $request->input('specificDate').' '.$request->input('specificTime');
        $user_id = Auth::user()->id;
        $to_notify = $request->input('app_to_id');
        $notify_desc = $request->input('rdpField');

        NotiFierLogsController::createNotification($to_notify,'APPOINTMENT','Request an Appointment');

        $data = \DB::table('user_appointment')->insert([
            'app_from' => $user_id,
            'app_to' => $request->input('app_to_id'),
            'app_street' => $request->input('streetAdd'),
            'app_street_l2' => $request->input('streetAddLine'),
            'app_city' => $request->input('Appcity'),
            'app_state' => $request->input('stateProvince'),
            'app_zipcode' => $request->input('streetAddLine'),
            'app_country' => $request->input('AppCountry'),
            'app_days' => $request->input('specificDate'),
            'app_days' => $days,
            'app_time' => $time,
            'app_specdateTime' => $specificDateTime,
            'app_desc' => $request->input('rdpField'),

        ]);
        $trans = false;
        if ($data) {
            $trans = true;
        }
        return  response()->json(['trans'=>$trans]);
    }

    public function saveAppResponse(Request $request){

            $notifyMessage = 'Appointment rejected';
        if ($request->input('actType') ==='A'){
            $notifyMessage = 'Appointment Accepted';
        }

        NotiFierLogsController::createNotification($request->input('toID'),'APPOINTMENT',$notifyMessage);

        $data = \DB::table('user_appoinment_actions')->insert([
            'act_app_id' => $request->input('appID'),
            'act_reasons' => $request->input('msg'),
            'act_status'=>$request->input('actType')]);

        if ($data){
            $dataUpdate =AppointMent::where('app_id',$request->input('appID'))->update(['app_status'=>$request->input('actType')]);
        }

        return  response()->json(['trans'=>$dataUpdate]);
    }

    public function getAppointment(){

        return  response()->json(['appointment'=>self::formatAppointMent()]);
    }

    public static  function formatAppointMent(){
        $new_value = array();
        $format = array();
        $data = AppointMent::where('app_to',NotiFierLogsController::getUserId())->get();

        foreach ($data as $key => $value){
            $new_value['appID'] = $value->app_id;
            $new_value['fromInfo'] = User::find($value->app_from);
            $new_value['appDesc'] = $value->app_desc;
            $new_value['appCreated'] = NotiFierLogsController::time_elapsed_string($value->app_created);
            $new_value['appStatus'] = self::readUnread($value->app_status);

            /*Address and Time*/
            $new_value['appStreet'] = $value->app_street;
            $new_value['appStreetl2'] = $value->app_street_l2;
            $new_value['appCity'] = $value->app_city;
            $new_value['appState'] = $value->app_state;
            $new_value['appZipcode'] = $value->app_zipcode;
            $new_value['appCountry'] = $value->app_country;
            $new_value['appDays'] = $value->app_days;
            $new_value['appTime'] = $value->app_time;
            $new_value['appSpecdateTime'] = date('l jS \of F Y h:i:s A',strtotime($value->app_specdateTime));


            $format[] = $new_value;
        }
        return $format;
    }


    public  static function readUnread($status){
        switch ($status){
            case NULL:
                    return 'Unread';
                break;
            case 'R':
                return 'Read';
                break;
            default:
                return "";
        }

    }



}
