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
use App\Http\Controllers\UsersController;

class liveCHatController extends Controller
{
  
	public function initializeData($id){
		// dd($this->getUserData($id));
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
	public function getAllUserLocation(){
		$user_id = Auth::user()->id;
		$user  = DB::table('users')->where('id','!=' ,$user_id)->get();
		return $user;
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



}
