<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Event;
use App\UserVideo;
use App\UserPhoto;
// use Mail;
use DB;
use Illuminate\Support\Facades\View;

class AdminDashboardController extends Controller {

 

    public function getIndex()
    {
        $totalUser = User::all()->count();

        $userWomen = User::where('gender','Female')->count();

        $userMan = User::where('gender','Male')->count();

        $unverify = User::where('verified',0)->count();

        /* SELECT DATE_FORMAT(act_date, "%m-%Y") AS Month, COUNT(*)
FROM lead_activity2
WHERE <where-cond-here> AND act_name='sale'
GROUP BY DATE_FORMAT(act_date, "%m-%Y") */

        $registeredByMonth = DB::table('users')->select(DB::raw('DATE_FORMAT(created_at, "%m-%Y") as Month, COUNT(*) as count'))->groupby(DB::raw('DATE_FORMAT(created_at, "%m-%Y")'))->get();

        //return dd($registeredByMonth);

        $just_registered = User::orderBy('id', 'desc')->take(10)->get();

        $just_login = User::orderBy('updated_at', 'desc')->take(10)->get();

        $eventscreated = Event::all()->count();

        $videocreated = UserVideo::all()->count();

        $photocreated = UserPhoto::all()->count();

        $registeredByPlan = DB::table('subscription')->select(DB::raw('COUNT(*) as count, name'))->leftJoin('dating_plan', 'subscription.plan_id', '=', 'dating_plan.id')->groupby('plan_id')->get();

        $events = DB::table('events')
        ->leftJoin('eventtype', 'events.eventtype', '=', 'eventtype.id')
        ->get();

         $eventCategory = DB::table('eventtype')->get();

        $encodedEvents = json_encode($events);

        //return dd($registeredByPlan);

        // dd(['totalUser' => $totalUser, 'userWoman' => $userWomen, 'userMan' => $userMan, 'unverify'=>$unverify, 'registeredByMonths'=>$registeredByMonth, 'eventscreated'=>$eventscreated, 'videocreated'=>$videocreated, 'photocreated'=>$photocreated, 'registeredByPlan'=>$registeredByPlan, 'justregistered'=>$just_registered, 'justlogin'=>$just_login, 'events'=>$events, 'encodedEvents'=>$encodedEvents, 'eventCategory'=>$eventCategory]);

        return View::make('admin.index',['totalUser' => $totalUser, 'userWoman' => $userWomen, 'userMan' => $userMan, 'unverify'=>$unverify, 'registeredByMonths'=>$registeredByMonth, 'eventscreated'=>$eventscreated, 'videocreated'=>$videocreated, 'photocreated'=>$photocreated, 'registeredByPlan'=>$registeredByPlan, 'justregistered'=>$just_registered, 'justlogin'=>$just_login, 'events'=>$events, 'encodedEvents'=>$encodedEvents, 'eventCategory'=>$eventCategory]);


    }
    
    public function admin_new(){
        $totalUser = User::all()->count();

        $userWomen = User::where('gender','Female')->count();

        $userMan = User::where('gender','Male')->count();

        $unverify = User::where('verified',0)->count();

        /* SELECT DATE_FORMAT(act_date, "%m-%Y") AS Month, COUNT(*)
FROM lead_activity2
WHERE <where-cond-here> AND act_name='sale'
GROUP BY DATE_FORMAT(act_date, "%m-%Y") */

        $registeredByMonth = DB::table('users')->select(DB::raw('DATE_FORMAT(created_at, "%m-%Y") as Month, COUNT(*) as count'))->groupby(DB::raw('DATE_FORMAT(created_at, "%m-%Y")'))->get();

        //return dd($registeredByMonth);

        $just_registered = User::orderBy('id', 'desc')->take(10)->get();

        $just_login = User::orderBy('updated_at', 'desc')->take(10)->get();

        $eventscreated = Event::all()->count();

        $videocreated = UserVideo::all()->count();

        $photocreated = UserPhoto::all()->count();

        $registeredByPlan = DB::table('subscription')->select(DB::raw('COUNT(*) as count, name'))->leftJoin('dating_plan', 'subscription.plan_id', '=', 'dating_plan.id')->groupby('plan_id')->get();
    	//return \View::make('new_admin.index')->withData("");
        return View::make('new_admin.index',['totalUser' => $totalUser, 'userWoman' => $userWomen, 'userMan' => $userMan, 'unverify'=>$unverify, 'registeredByMonths'=>$registeredByMonth, 'eventscreated'=>$eventscreated, 'videocreated'=>$videocreated, 'photocreated'=>$photocreated, 'registeredByPlan'=>$registeredByPlan, 'justregistered'=>$just_registered, 'justlogin'=>$just_login]);
		
    }

    public function sendEmail(Request $request){
        // return response()->json($request->input());
        $data = $request->input();

        if(!empty($data['subject']) && $data['message']){
            $filter_user = DB::table('users')->get(); //$this->paying_user_group($data['type']);
            $data['filter_user'] = count($filter_user);
    
            if(!empty($filter_user)){
                foreach($filter_user as $r=>$value){
    
                    $email_to_send = $value->email; 
                    // return View::make('email.admindash_mass_email')->with($data);
                    
                    Mail::send('email.admindash_mass_email', $data, function($message) use ($email_to_send) {
                        $message->to($email_to_send, 'ID')->subject($data['subject']);
                    });
                    
                }
            }
            $request->session()->flash('success', 'Your mass email was successfully sent.');
        }
        else{
            $request->session()->flash('danger', 'Subject and message cannot be empty.');
        }
        return \Redirect::to('admin');


        // // dd(\Input::get());
        
        // $users = DB::table('users')->where('id', '=', 115)->get();

        // // $users = DB::table('users')->get();

        // foreach ($users as $user) {

        //     // echo $user->email . ' - ' . $user->firstName . ' ' . $user->lastName ;


        //     $data= array();
        //     $data = [
        //         'email' => $user->email,
        //         'name' => $user->firstName . ' ' . $user->lastName,
        //         'messages' => \Input::get('message'),
        //         'image_link' => 'http://seriousdatings.com/public/images/logo.jpg',
        //         'contact_address' => ''

        //     ];

        //     // dd($data);
        //     $email_to_send = $user->email;

        //     \Mail::send('quickmailtemplate', $data, function ($message) use ($email_to_send) {
        //         $message->to($email_to_send)->subject(\Input::get('subject'));
        //     });

        // }

        // return \Redirect::to('admin');
        // // return View::make('admin.index')->withData($data);

    }

    public function getTest(){

            return View::make('admin.test');

//         $totalUser = User::all()->count();

//         $userWomen = User::where('gender','Female')->count();

//         $userMan = User::where('gender','Male')->count();

//         $unverify = User::where('verified',0)->count();

//         /* SELECT DATE_FORMAT(act_date, "%m-%Y") AS Month, COUNT(*)
// FROM lead_activity2
// WHERE <where-cond-here> AND act_name='sale'
// GROUP BY DATE_FORMAT(act_date, "%m-%Y") */

//         $registeredByMonth = DB::table('users')->select(DB::raw('DATE_FORMAT(created_at, "%m-%Y") as Month, COUNT(*) as count'))->groupby(DB::raw('DATE_FORMAT(created_at, "%m-%Y")'))->get();

//         //return dd($registeredByMonth);

//         $just_registered = User::orderBy('id', 'desc')->take(10)->get();

//         $just_login = User::orderBy('updated_at', 'desc')->take(10)->get();

//         $eventscreated = Event::all()->count();

//         $videocreated = UserVideo::all()->count();

//         $photocreated = UserPhoto::all()->count();

//         $registeredByPlan = DB::table('subscription')->select(DB::raw('COUNT(*) as count, name'))->leftJoin('dating_plan', 'subscription.plan_id', '=', 'dating_plan.id')->groupby('plan_id')->get();

//         //return dd($registeredByPlan);

//         return View::make('admin.test',['totalUser' => $totalUser, 'userWoman' => $userWomen, 'userMan' => $userMan, 'unverify'=>$unverify, 'registeredByMonths'=>$registeredByMonth, 'eventscreated'=>$eventscreated, 'videocreated'=>$videocreated, 'photocreated'=>$photocreated, 'registeredByPlan'=>$registeredByPlan, 'justregistered'=>$just_registered, 'justlogin'=>$just_login]);
        // return View::make('admin.test',['email' => 'yhatotz19.ja@gmail.com','image' => 'images/users/khare0129/khare0129.jpeg','name' => 'Jamen Mama', 'messages' => '<p>Hello World!</p>', 'image_link' => 'http://seriousdatings.com/public/images/logo.jpg', 'contact_address'   =>  '']);
    }

}