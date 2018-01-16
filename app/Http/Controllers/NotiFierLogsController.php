<?php
/*
 * Author Mark:
 * static class function
 * */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\NotificationLogs;
use DB;

class NotiFierLogsController extends Controller
{

    protected static  $user_id;

    public static function createNotification($notif_to = null,$notif_type = null,$notif_desc = null){
        return self::saveNotification([
                                'notif_from' =>  Auth::user()->id,
                                'notif_to' => $notif_to,
                                'notif_type' => $notif_type,
                                'notif_desc' => $notif_desc
                            ]);

    }
    public static function saveNotification($data){
       return  \DB::table('user_notification_logs')->insert($data);

    }

    public static function getMyNotification(){
     return  NotificationLogs::where('notif_to',self::getUserId())->get()->sortByDesc("notif_id");
    }


    public static function getCountNotification(){
        return NotificationLogs::where('notif_to',self::getUserId())->where('notif_status','=',null)->count();
    }

    /**
     * @return int
     */
    public static function getUserId()
    {
        return self::$user_id =(Auth::check()) ? Auth::user()->id : 0;
    }

    public static  function formattedNotification(){
        $new_value = array();
        $format = array();
        foreach (self::getMyNotification() as $key => $value){
            $status = $value->notif_status == null ? false : true;
            $new_value['from_info'] = User::find($value->notif_from);
            $new_value['to'] = $value->notif_to;
            $new_value['notif_type'] = $value->notif_type;
            $new_value['message'] = $value->notif_desc;
            $new_value['ago'] = self::time_elapsed_string($value->notif_date);
            $new_value['notif_id'] = $value->notif_id;
            $new_value['notif_status'] = $status;
            $format[] = $new_value;
        }
        return $format;
    }

    public function updateRead(Request $request){
        $id = $request->input('id');
        return NotificationLogs::where('notif_id',$id)->update(['notif_status'=>'R']);
    }


    public  static  function time_elapsed_string($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


}
