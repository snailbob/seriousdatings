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
use App\Http\Controllers\EmailNotificationController;
use Illuminate\Support\Facades\View;
use App\AvailabilityApp;
use App\DefaultAvailTime;
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
    public function saveAppointmentNew(Request $request)
    {
        $user_id = Auth::user()->id;
        $to_notify = $request->input('appToid');
        NotiFierLogsController::createNotification($to_notify,'APPOINTMENT','Request an Appointment');

        $data = \DB::table('user_appointment')->insert([
            'app_from' => $user_id,
            'app_to' => $request->input('appToid'),
            'app_days' => $request->input('availDate'),
            'app_time' => $request->input('availTime'),
            'app_availID' => $request->input('availDid'),
        ]);
        $trans = false;
        $dataEmail = array();
        if ($data) {
            $trans = true;
            $sendEmail = new EmailNotificationController;
            $dataUser = User::find($to_notify);
            
            $dataEmail['name'] = $dataUser->firstName.' '.$dataUser->lastName;
            $dataEmail['message'] = 'Request an Appointment';
            $dataEmail['email'] = $dataUser->email;
         
            $sendEmail->sendEmailNotificationPassArray($dataEmail);
            

        }
        return  response()->json(['trans'=>$trans]);

    }

    public function saveTimeAvailabity(Request $request){

        $user_id = Auth::user()->id;
        $data = \DB::table('user_appointment_availability')->insert([
            'av_user_id' => $user_id,
            'av_user_date' => $request->input('dateAvp'),
            'av_user_times' =>  $request->input('timeAllp'),

        ]);
        $trans = false;
        if ($data) {
            $trans = true;
        }
        return  response()->json(['trans'=>$trans]);


    }

    public function saveAppResponse(Request $request){

        $notifyMessage = $request->input('actType');
       
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
        $data = AppointMent::where('app_to',NotiFierLogsController::getUserId())->orderBy('app_id','desc')->get();

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
                    return 'Pending';
                break;
            case 'R':
                    return 'Decline';
                break;
            case 'A':
                    return 'Accepted';
                break;
            default:
                return "";
        }

    }



    public function getTimeAvailability(Request $request){
        $data = AvailabilityApp::where('av_user_id',$request->input('ids'))->where('av_status','=',null)->get();
        $defaultTime = DefaultAvailTime::all();

         return  response()->json(['avail'=>self::AvailabilityAppFormat($data),
                                   'defaultTime' => self::getUserDefaultTime($defaultTime)]);
    }

    public static function getUserDefaultTime($data){
         
         $new_value = array();
         $format = array();
        foreach ($data as $key => $value) {

             $new_value['def_id'] = $value->def_id;
             $new_value['def_timeFrom'] = date('Y-m-d',strtotime($value->def_timeFrom));
             $new_value['def_timeTo'] = date('Y-m-d',strtotime($value->def_timeTo));
             $new_value['def_time'] = self::sliceUserTime($value->def_time);
             $format[] = $new_value;

        }
        return $format;
    }

    public static function AvailabilityAppFormat ($data){

         $new_value = array();
         $format = array();
        foreach ($data as $key => $value) {

             $new_value['avDid'] = $value->av_id;
             $new_value['avDate'] = date('d-M-Y',strtotime($value->av_user_date));
             $new_value['avDay'] = date('l',strtotime($value->av_user_date));
             $new_value['avTimes'] = self::sliceUserTime($value->av_user_times);
             $format[] = $new_value;

        }

        return $format;
    }
    public static function sliceUserTime ($times){
            $time = explode(",", $times);
            $timed = array();
            $timer = array();
            foreach ($time as  $value) {
                    $timer['Usertime'] = $value;
                    $timed[]  = $timer;               
            }
            return $timed;

    }


    public static function getUserResponseAppointment($appTo){
        $user_id = Auth::user()->id;
        $sql_view = "SELECT 
                      * 
                    FROM
                      user_appointment AS upa 
                      LEFT JOIN user_appoinment_actions AS upac 
                        ON upac.act_app_id = upa.app_id 
                    WHERE upa.app_from = '$user_id' 
                      AND upa.app_to = '$appTo'";
        $data = DB::select($sql_view);
        return $data;
    }



}
