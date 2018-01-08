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

class AjaxRequestController extends Controller
{


    public function getSearchType()
    {
        $dataReceived = Input::get("data");
       
        $data_arr = $dataReceived['data'][0];
       
       $action = $data_arr['action'];
       $type = $data_arr['type'];
       $gender = $data_arr['gender'];
       $ageFrom = intval($data_arr['ageFrom']);
       $ageTo = intval($data_arr['ageTo']);
       $range = intval($data_arr['range']);
       $lati = doubleval($data_arr['lati']) ;
       $longi = doubleval($data_arr['longi']);
    
        $distance = new Compatability();
        
        $users =  $users = DB::table('users')->orderBy($type, 'desc')->get();
        
        $result = array();
        $i=0;
        foreach ($users as $user) {
            $newDistance = $distance -> haversineGreatCircleDistance($lati,$longi,$user -> latitude,$user -> longitude);
            if($newDistance <= $range && $user -> age >= $ageFrom && $user -> age <= $ageTo && $user -> gender == $gender){
                $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($user -> latitude).','.trim($user -> longitude).'&sensor=false'); 
                $output = json_decode($geocodeFromLatLong);
                $status = $output->status;
                $location = ($status=="OK")?$output->results[1]->formatted_address:'';


                $geocodeFromLatLong2 = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lati).','.trim($longi).'&sensor=false'); 
                $output2 = json_decode($geocodeFromLatLong);
                $status2 = $output->status;
                $location2 = ($status=="OK")?$output->results[1]->formatted_address:'';
                $result[$i]  = array('username' => $user -> username,'age' => $user -> age,'firstName' => $user -> firstName,'lastName' => $user -> lastName,'photo' => $user -> photo,'locations' => $location,'location2' => $location2,'gender' => $gender,'ageFrom' => $ageFrom,'ageTo' => $ageTo,'range' => $range,'lati' => $lati, 'longi' => $longi,'gendr' => $gender,'distance' => $newDistance);
                $i++;
            }
        }

      
       // dd($result);
        return json_encode($result);
    }


    public function getIndex()
    {

        //dd($id);
      //  return 'Form Not Submitted Properly';
    }


    public function profileData(){


      $dataReceived = Input::get("data");
      $data_arr = $dataReceived['data'][0];
      $action = $data_arr['action'];
      if($action == "sendRequest"){
        $user_id = $data_arr['user_id'];
        $friend_id = $data_arr['friend_id'];
        $matchTheseCheck = ['friend_one' => $user_id, 'friend_two' => $friend_id];

        
        $check = DB::table('friends')->where($matchTheseCheck)->first();
        //dd($check);
        if(sizeof($check) < 1){
          DB::table('friends')->insert(
              ['friend_one' => $user_id, 'friend_two' => $friend_id,'status' => '0']
          );
        }
        
         $user = DB::table('users')->where('id','=',$user_id)->first();
         $name = $user -> firstName. " ".$user -> lastName;
         $photo = url()."/public/images/users/".$user -> username."/".$user -> photo;
          $username = $user -> username;
         $notify_id = $friend_id;
         $matchTheseCheckNotification = ['notify_id' => $notify_id, 'action' => 'sendRequest'];
         $check_two= DB::table('notification')->where($matchTheseCheckNotification)->first();
        //dd(sizeof($check_two));
        if(sizeof($check_two) < 1){
          $created_at = new DateTime();
          DB::table('notification')->insert(
              ['username' => $username, 'action' => $action ,'friend_one' => $user_id, 'friend_two' => $friend_id,'name' => $name, 'photo' => $photo, 'notify_id' => $notify_id, 'created_at' => $created_at]
          );
        }
         //$redis = Redis::connection();
         $data = ['username' => $username ,'actions' => 'sent' , 'notify_id' => $notify_id , 'nam_e' => $name , 'photo' => $photo , 'friend_two' => $user_id, 'friend_one' => $friend_id];
        //dd($data);
        //$redis->publish('message', json_encode($data));
        return response()->json($data);



      }
      else if($action == "acceptRequest"){
        $user_id = $data_arr['user_id'];
        $friend_id = $data_arr['friend_id'];
        $matchThese_accept = ['friend_two' => $user_id, 'friend_one' => $friend_id];
        //dd($user_id);
         DB::table('friends')->where($matchThese_accept)->update(['status' => '1']);
        $user = DB::table('users')->where('id','=',$user_id)->first();
         $name = $user -> firstName. " ".$user -> lastName;
         $photo = url()."/public/images/users/".$user -> username."/".$user -> photo;
         $username = $user -> username;
         $notify_id = $friend_id;
          
          $matchTheseCheckNotification = ['notify_id' => $notify_id, 'action' => 'acceptRequest'];
         $check_three= DB::table('notification')->where($matchTheseCheckNotification)->first();
        //dd(sizeof($check_three));
        if(sizeof($check_three) < 1){
          $created_at = new DateTime();
          DB::table('notification')->insert(
              ['username' => $username, 'action' => $action ,'friend_one' => $user_id, 'friend_two' => $friend_id,'name' => $name, 'photo' => $photo, 'notify_id' => $notify_id, 'created_at' => $created_at]
          );
        }
        
         //$redis = Redis::connection();
        $data = ['username' => $username ,'actions' => 'accept' , 'notify_id' => $notify_id , 'nam_e' => $name , 'photo' => $photo , 'friend_two' => $user_id, 'friend_one' => $friend_id];
        //dd($data);
        //$redis->publish('message', json_encode($data));
        return response()->json($data);
      }
      else if($action == "removeFriend"){
        $user_id = $data_arr['user_id'];
        $friend_id = $data_arr['friend_id'];
        $user = DB::table('users')->where('id','=',$user_id)->first();
         $name = $user -> firstName. " ".$user -> lastName;
         $photo = url()."/public/images/users/".$user -> username."/".$user -> photo;
         $username = $user -> username;
         $notify_id = $friend_id;
        $matchThese_remove_1 = ['friend_two' => $user_id, 'friend_one' => $friend_id];
        $matchThese_remove_2= ['friend_one' => $user_id, 'friend_two' => $friend_id];
        
        //dd("FriendTwo: ".$user_id." FriendOne: ".$friend_id);
        DB::table('friends')
        ->where($matchThese_remove_1)
        ->orWhere($matchThese_remove_2)
        ->delete();
        
        $matchTheseCheckNotification = ['notify_id' => $notify_id, 'action' => 'removeFriend'];
         $check_four= DB::table('notification')->where($matchTheseCheckNotification)->first();
        //dd(sizeof($check_three));
        if(sizeof($check_four) < 1){
          $created_at = new DateTime();
          DB::table('notification')->insert(
              ['username' => $username, 'action' => $action ,'friend_one' => $user_id, 'friend_two' => $friend_id,'name' => $name, 'photo' => $photo, 'notify_id' => $notify_id, 'created_at' => $created_at]
          );
        }
        
        //$redis = Redis::connection();
        $data = ['username' => $username ,'actions' => 'remove' , 'notify_id' => $notify_id , 'nam_e' => $name , 'photo' => $photo , 'friend_two' => $user_id, 'friend_one' => $friend_id];
        //dd($data);
        //$redis->publish('message', json_encode($data));
        //return response()->json([]);
        return response()->json($data);
      }
      else{

        return 0;
      }
    }

    public function updateGroupMember(){

      $dataReceived = Input::get("data");
      $data_arr = $dataReceived['data'][0];
      $action = $data_arr['action'];
      $groupID = $data_arr['groupID'];
      $userID = $data_arr['userID'];
      if($action == "join"){
        DB::table('group_member')->insert(
          ['group_id' => $groupID, 'user_id' => $userID]
        );
      }
      else{
        $matchThese = ['group_id' => $groupID, 'user_id' => $userID]; 
        DB::table('group_member')->where($matchThese)->delete();
      }
      return "1";
    }

}
