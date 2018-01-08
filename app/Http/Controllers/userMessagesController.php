<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\User;
use \App\Notification;
use Auth;
use DB;

class userMessagesController extends Controller
{
	public function messages(){

		$id = $_GET['id'];
		$sql = "SELECT 
			um.*,
			DATE_FORMAT(um.m_datetime, '%M %d, %Y %r') AS 'message_time',
			uus.*
			FROM 
			user_messages AS um
			LEFT JOIN 
			users AS uus
			ON um.m_from_id = uus.id WHERE  um.m_to_id ='$id'
			ORDER BY um.m_id DESC ";

		$messages = DB::select($sql);
		return  response()->json($messages);
	}
	public function messagesview(){

		$id = $_GET['id'];
		$sql_view = "SELECT 
			um.*,
			DATE_FORMAT(um.m_datetime, '%M %d, %Y %r') AS 'message_time',
			uus.*
			FROM 
			user_messages AS um
			LEFT JOIN 
			users AS uus
			ON um.m_from_id = uus.id WHERE  um.m_id ='$id'";
			DB::table('user_messages')
			            ->where('m_id', $id)
			            ->update(['m_status' => 1]);

		$messages_view = DB::select($sql_view);
		return  response()->json($messages_view);
	}
	public function messagescount(Request $request){
		// $user_id = $request->id;
		$user_id = (Auth::check()) ? Auth::user()->id : '';
		$sql_view = "SELECT COUNT(*) AS 'total_count'
			FROM 
			user_messages 
			WHERE  m_to_id ='$user_id' AND m_status ='0'";
		$count = DB::select($sql_view);
		return  response()->json($count);
	}
	public function sendmessage(Request $request){
		$subject = $request->input('subject');
		$message = $request->input('message');
		$recipient_id = $request->input('recipient_id');
		$sender_id = (Auth::check()) ? Auth::user()->id : '';
		$update = DB::table('user_messages')->insert([
			    [
			        'm_from_id' =>$sender_id ,
			        'm_to_id' => $recipient_id,
			        'm_subject' => $subject,
			        'm_message' => $message
			     ]
			]);
		if ($update) {
			$message_response['message_r'] = true;
		}else{
			$message_response['message'] =false;
		}

		return  response()->json($message_response);
	}
	public function getImage(Request $request){
		$user_id = $request->id;
		$sql_view = "SELECT photo
			FROM 
			users 
			WHERE  id ='$user_id'";
			
		$count = DB::select($sql_view);
		return  response()->json($count);
	}
	public function saveChat(Request $request){
		$data = \DB::table('chat_logs')->insert([
		            'c_from' => $request->input('from_id'),
		            'c_to' => $request->input('to_id'),
		            'c_message' => $request->input('messsage')]);
		$trans = false;
		if ($data) {
			$trans = true;
		}
		return  response()->json(['trans'=>$data]);
	}

	public function getChatHistoryExist(Request $request){
		$from_id = $request->input('from_id');
		$my_id = $request->input('my_id');
		$sql = "SELECT 
			  COUNT(c_id) AS 'total' 
			FROM
			  chat_logs 
			WHERE c_from = '$from_id' 
			  AND c_to = '$my_id' ";

		$chatHIstory = DB::select($sql);
		return  response()->json($chatHIstory);
	}
	public function getChatHistory(Request $request){
		$offset = $request->input('offset');
		$from_id = $request->input('from_id');
		$my_id = $request->input('my_id');
		$sql = "SELECT 
			  cl.c_id,
			  usrs.firstName,
			  usrs.lastName,
			  cl.c_from,
			  cl.c_to,
			  cl.c_message,
			  DATE_FORMAT(cl.c_send_dt, '%M %d,%Y %r') AS 'date_send',  
			  usrs.photo AS 'PHOTO'
			  FROM
			  users AS usrs 
			  INNER JOIN chat_logs AS cl 
			    ON usrs.id IN ('$from_id','$my_id') 
			GROUP BY cl.c_id
			ORDER BY cl.c_id ASC ";


		$chatHIstory = DB::select($sql);
		return  response()->json($chatHIstory);
	}
}
