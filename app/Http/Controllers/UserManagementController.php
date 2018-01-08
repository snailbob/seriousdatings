<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Auth;

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

        // foreach($users as $key=>$val){
        //   foreach($val as $k=>$v){
        //     echo $k." , ";
        //   }
        // }
        
        if ($users === null) {
            $users = null;
        }
        //return $users;
        return \View::make('admin.user.manage_user')->withUsers($users);

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        //dd($user);
     
        DB::table('friends')
        ->where('friend_one','=',$id)
        ->orWhere('friend_two','=',$id)
        ->delete();        
        DB::table('role_user')->where('user_id','=',$id)->delete();
        $username = DB::table('users')->where('id','=',$id)->pluck('username');
        DB::table('about_your_date')->where('user_id','=',$username)->delete();
        DB::table('compatability')->where('user_id','=',$id)->delete();
        DB::table('user_online')->where('user_id','=',$id)->delete();
        DB::table('subscription')->where('user_id','=',$id)->delete();
        $user->delete();
        // redirect
        \Session::flash('message', 'Successfully deleted!!');
        return \Redirect::to('admin/users');

    }
}

