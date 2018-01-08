<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
use Redirect;
use Input;
use View;
use App\User;

class AdminLoginController extends Controller {

    public function __construct() {
        if (Auth::check()) {

            if (Auth::user()->verified == 1) {
                // dd(Auth::user()->verified);
                // dd(\Redirect::to('/verifyPlease'));
                // dd(url().'/verifyPlease');
                // return redirect()->route('verifyPlease');
                // return redirect()->action('VerifyController@getVarifyPlease');
                // return redirect(url().'/verifyPlease');
                // return \Redirect::to('/verifyPlease');
                // return \Redirect::to('users/'.(Auth::user()->id).'/verify/'.(Auth::user()->verify_key));
            }
        }
    }

    /**
     * @return mixed
     * TODO: Retouch Exeptions/Handler.php for not to show errors
     */
    public function getIndex() {
        return redirect(url().'#login');
        // if (Auth::check()) {

        //     return redirect(url() . '/admin');
        //     // return Redirect::intended(url());
        // } else {
        //     return \View::make('admin')->withData("");
        // }
    }

    public function get_postal_by_fallback($latlng) {
        $postal = '';
        $fallback = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latlng . "&sensor=false"));
        $result = $fallback->results[0]->address_components;
        foreach ($result as $item) {
            $types = $item->types;
            foreach ($types as $type) {
                if ($type == 'postal_code') {
                    $postal = $item->long_name;
                }
            }
        }
        return $postal;
    }

    public function getLogin() {

        if (Auth::check()) {

            return Redirect::intended(url());
        } else {
            return \View::make('admin')->withData("");
        }
    }

    public function postLogin() {
        //echo 'ddds';die;
        $remember = (Input::has('check')) ? true : false;

        $cred = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        //dd($cred);
        if (\Auth::attempt($cred, $remember)) {
            $user_id = Auth::user()->id;
            $date_time = date("Y-m-d h:i:sa");
            $userOnline = DB::table('user_online')->where('user_id', '=', $user_id)->first();
            if ($userOnline == null) {
                DB::table('user_online')->insert(
                        ['user_id' => $user_id, 'time' => $date_time]
                );
            }
            $id = DB::table('role_user')->where('user_id', '=', $user_id)->first();
          //  dd('fd--');
        //dd($id);die;
            if ($id->role_id == 2) {
                //return url() . '/admin';
                // echo "admin login";
                return redirect(url() . '/admin');
                // return \View::make('admin.test');
            } else {
                 // return url() . '/profile';
                // echo "admin not";
                return redirect(url() . '/profile');
                //return Redirect::intended('/');
            }
        } else {
            //return "0";
            return \View::make('admin')->withData("Username or Password do not match");
            //$result = "Request Sent Successfully";
            //return $result;
        }

        //$creds = array('username' => 'hasan' , 'password' => 'abc');
        //\Auth::attempt($creds);
        //Redirect::to('users');
    }
    public function ajaxLogin() {
        $remember = (Input::has('check')) ? true : false;

        $cred = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        //dd($cred);
        if (\Auth::attempt($cred, $remember)) {
            $user_id = Auth::user()->id;
            $date_time = date("Y-m-d h:i:sa");
            $userOnline = DB::table('user_online')->where('user_id', '=', $user_id)->first();
            if ($userOnline == null) {
                DB::table('user_online')->insert(
                        ['user_id' => $user_id, 'time' => $date_time]
                );
            }
            $id = DB::table('role_user')->where('user_id', '=', $user_id)->first();
//dd($id);
            if ($id->role_id == 2) {
             // return url() . '/admin';
                return "0";
               //return url() . '/admin_new';
                //return redirect(url() . '/admin');
            } else {
                 return url() . '/profile';
                //return redirect(url() . '/profile');
                //return Redirect::intended('/');
            }
        } else {
            return "0";
            //return \View::make('login')->withData("Username or Password do not match");
            //$result = "Request Sent Successfully";
            //return $result;
        }

        //$creds = array('username' => 'hasan' , 'password' => 'abc');
        //\Auth::attempt($creds);
        //Redirect::to('users');
    }

    public function getLogout() {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            Auth::logout();
            DB::table('user_online')->where('user_id', '=', $user_id)->delete();
            //dd("logged out");
        }
        return Redirect::to('/');
    }

    public function paginateUser() {
        $allUsers = User::select('username', 'photo')->orderBy('id', 'desc')->simplePaginate(10);
        return Response::json(['status' => 'success', 'user' => $allUsers->toJson()]);
    }

}
