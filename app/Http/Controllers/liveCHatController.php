<?php
  /*-------------------------------------------- FOR LOCATION AND USER INFO AND DESTINATION MOVIES CONTROLLER -----
         |  Function initializeData, getUserLocation
         |	  Author: Mark Gocela
         |  Purpose:  Locating User, Get User info, User Favorite movies, User Destinations
         |
         |  Parameters:
	 |	$id
         |
         |  Returns:  $user info's - data array
         *-------------------------------------------------------------------*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Auth;
use DB;
use Redirect;
use Input;
use App\User;
use App\ChatNew;
use App\Http\Controllers\UsersController;
use App\UserBlocks;

class liveCHatController extends Controller
{
  
	public function initializeData($id){
		// return response()->json($this->getUserData($id));
		return View::make('livechat',['userInfo' => $this->getUserData($id)]);
	}
	public function getUserLocation($id){
		return View::make('map.location',['userInfo' => $this->getUserData($id),'isSpeed'=>0]);

	}
	public function getUserLocationSpeed($id){
		return View::make('map.location',['userInfo' => $this->getUserData($id),'isSpeed'=>1]);

	}
	public function speeddatingInitialize(){
		$user_id = Auth::user()->id;
		return View::make('speed-dating.speedview',['userInfo' =>$this->getUserData($user_id)]);

	}
	public function getUserData($id){
		$user_ctrl = new UsersController();
		$user = User::find($id);
		$format_users = $user_ctrl->format_user($user);
		return $user;
	}

	public function messageChatnew(Request $request){
		$chatRoomID1 = $request->input('chatRoomID1');/*segment ID*/
		$chatRoomID2 = $request->input('chatRoomID2');/*segment ID*/
		$myID = Auth::user()->id;
		$toID = $request->input('toID');/*segment ID*/ 
		/*formatter date : %W %M %e, %Y  %r*/
       	$sql_view = "SELECT 
					  * ,
       				  DATE_FORMAT(c_send_dt, '%M %e, %Y  %r') AS formattedDate,	
					  (SELECT photo FROM users WHERE id = cll.c_from) AS pixtures,
					  (SELECT CONCAT(firstName,' ',lastName) FROM users WHERE id = cll.c_from) AS fullName
					FROM
					  chat_logs AS cll 
					WHERE `c_chatroom` IN ('$chatRoomID1', '$chatRoomID2')";
		$chatDatas = DB::select($sql_view);
		
		return  response()->json(['chatDatas'=>$chatDatas]);
	}



	public static function removeBlockedUser($UserId){
     return  UserBlocks::where('user_id',$UserId)->get();
    }


	public function getAllUserLocation(){
		$user_id = Auth::user()->id;
		
		$user_ctrl = new UsersController();
		// $user = User::find($id);
		$notIn  = array($user_id);
		$blockedUser = self::removeBlockedUser($user_id);
		foreach ($blockedUser as $key => $value) {
			$notIn[] = $value->user_blocked_id;
		}
			
		$users = User::whereNotIn('id', $notIn)->get();
		
        $format_user = array();

        if(!empty($users)){
            foreach($users as $r=>$value){
                $format_user[] = $user_ctrl->format_user($value);
            }
        }


		return $format_user;
	}

	public function validateUserMoreThanOneDay(){
		$user_id = (Auth::check()) ? Auth::user()->id : 0;
		$sql_view = "SELECT firstName,
				  IF(
				    verified = '1',
				    DATEDIFF(
				      DATE_FORMAT(NOW(), '%Y-%m-%d'),
				      DATE_FORMAT(verified_date, '%Y-%m-%d')
				    ),
				    'NOT_VERIFIED'
				  ) AS count_days 
				FROM
				  users 
				WHERE id = '$user_id'";
		$count = DB::select($sql_view);
		return  response()->json($count);
	}
	public function saveChatLogsNew(Request $request){
		
		$c_from = $request->input('c_from');
		$c_to = $request->input('c_to');
		$c_message = $request->input('c_message');
		$c_chatroom = $request->input('c_chatroom');


		$sender_id = (Auth::check()) ? Auth::user()->id : '';
		$update = DB::table('chat_logs')->insert([
				    [
				        'c_from' =>$c_from ,
				        'c_to' => $c_to,
				        'c_message' => $c_message,
				        'c_chatroom' => $c_chatroom
				     ]
				]);

		
		if ($update) {
			$message_response['message'] = true;
		}else{
			$message_response['message'] =false;
		}

		return  response()->json($message_response);
	}



}
