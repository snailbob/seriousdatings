<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pagination\LengthAwarePaginator;
use Mail;
use DB;
use Auth;
use Redirect;
use Input;
use View;
class SuccessStoryController extends Controller
{
 
    
    public function successPost()
    {

        $description = Input::get('description');
        $user_id = Input::get('user_id');
        #$check = DB::table('success_story')->where('user_id','=',$user_id)->pluck('id');
		$check = DB::table('success_story')->where('user_id','=',$user_id)->pluck('id');
        $username = DB::table('users')->where('id','=',$user_id)->pluck('username');
        
        if($check < 1){
            DB::table('success_story')->insert(
                ['user_id' => $user_id, 'description' => $description]
            );
        }
        return redirect(url()."/users/".$username);
    }
    
    public function showSucsces(){

        $success_story = DB::table('success_story')
        #->leftJoin('users', 'users.id', '=', 'success_story.user_id')
        ->get();

        $arr = array(
            'stories'=>$success_story,
            'currentUser'=>1
        );
        return View::make('successStory')->with($arr);
        //dd($success_story);
    }
    
 }
 