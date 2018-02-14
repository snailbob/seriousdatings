<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Mail;
use DB;
use Auth;
use App\RoleUser;

use App\Http\Controllers\UsersController;

class UserManagementController extends Controller
{
    /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }
        
        $users = User::all();
        foreach ($users as $user) {

            $user_id = $user -> id;
            $role = DB::table('role_user')->where('user_id','=',$user_id)->pluck('role_id');
            $user->role = $role;
        }
        if ($users === null) {
            $users = null;
        }
        //return $users;
        return \View::make('admin.user.manage_user')->withUsers($users);
    }

    public function demographic(){
        return \View::make('admin.user.demographic');
    }

    public function monthlypayment(){
        return \View::make('admin.user.monthlypayment');
    }


    /**
     * Display a listing of user by subgroup.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserbyCat($cat)
    {

        switch($cat){
            case "men":
            $field = 'gender';
            $val = 'Male';
            break;
            case "women":
            $field = 'gender';
            $val = 'Female';
            break;
            case "notverified":
            $field = 'verified';
            $val = 0;
            break;
            case "verified":
            $field = 'verified';
            $val = 1;
            break;
        }
        $users = User::where($field,$val)->get();
        foreach ($users as $user) {

            $user_id = $user -> id;
            $role = DB::table('role_user')->where('user_id','=',$user_id)->pluck('role_id');
            $user->role = $role;
        }
        if ($users === null) {
            $users = null;
        }
        //return $users;
        return \View::make('admin.user.manage_user')->withUsers($users);
    }

    public function non_member_user()
    {   
        $non_users = RoleUser::where('role_id', 5)->get();
        $data = array();
        foreach ($non_users as $non_user) {
            $data[] = $non_user->user_id;
        }

        $users = User::find($data);
        foreach ($users as $user) {
            $user->role = 5;
        }
        return \View::make('admin.user.manage_user')->withUsers($users);
    }

    public function setToNonUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $count = RoleUser::where('user_id', $user->id)->count();
        if($count)
        {
            RoleUser::where('user_id', $user->id)
            ->update(['role_id' => 5]);
        }else
        {
            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 5
            ]);            
        }
        return "Success";
    }

    public function approveUser(Request $request)
    {
        User::where('email', $request->email)
        ->update(['isApproved' => 1]);

        $user = User::where('email', $request->email)->get();        
        return response()->json($user);
    }

    public function disapproveUser(Request $request)
    {
        User::where('email', $request->email)
        ->update(['isApproved' => 0]);


        // Mail::send('email.disapproved_user', $user, function($message) use ($user) {
        //     $message->to($user->email);
        //     $message->subject('Reject User');
        // });
        $user = User::where('email', $request->email)->first();
        // var_dump($user->email);
        $email = $user->email;
        // var_dump($email);
        Mail::send('email.disapproved_user', ['content' => $request->content, 'user' => $user], function ($message) use ($email) {
            $message->to($email, 'ID')->subject('Request Rejected');
        });
        
        return response()->json($user);
    }

    public function userbyCat($cat){

        switch($cat){
            case "men":
            $sql = 'select * from users where gender = ?';
            $field = 'gender';
            $val = 'Male';
            break;
            case "women":
            $sql = 'select * from users where gender = ?';
            $field = 'gender';
            $val = 'Female';
            break;
            case "notverified":
            $sql = 'select * from users where verified = ?';
            $field = 'verified';
            $val = 0;
            break;
            case "verified":
            $sql = 'select * from users where verified = ?';
            $field = 'verified';
            $val = 1;
            break;  
        }

        // $users = User::where($field,$val)->get();
        $users = DB::select($sql, [$val]);

        foreach ($users as $user) {
            $user_id = $user -> id;
            $role = DB::table('role_user')->where('user_id','=',$user_id)->pluck('role_id');
            $user->role = $role;
        }

        if ($users === null) {
            $users = null;
        }
        //return $users;
        return \View::make('admin.user.manage_user')->withUsers($users);

    }

    public function show($id)
    {

        $user_ctrl = new UsersController();
        
        $user = User::find($id);
        // $user_id = $user -> id;

        $details = $user_ctrl->format_user_withsub($user);

        // return response()->json($details);
        
        $role = DB::table('role_user')->where('user_id','=',$id)->pluck('role_id');
        $user->role = $role;
        return \View::make('admin.user.view_user')->withUser($user);
    }

}

