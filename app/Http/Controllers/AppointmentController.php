<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use DB;

use App\Http\Controllers\NotiFierLogsController;
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
        NotiFierLogsController::createNotification($to_notify,'APPOINTMENT',$notify_desc);

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
}
