<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;

use App\User;

use Mail;

use DB;

use Auth;

use Redirect;

class VerifyController extends Controller

{

 

    public function getVerify($id, $key){

        $results = User::where('id',$id)->first();
        

        // return json_encode($results);
        // return View::make('verify_email')->withData($results);
        
        
        // $username_new = DB::table('users')->where('id', $username)->pluck('username');
        // $db_key = \DB::table('users')->where('id', $username)->pluck('verify_key');

        if ($results->verify_key == $key) {
            $user = User::find($results->id);
            
            $user->verified = 1;
            $user->verified_date = date("Y-m-d");
            $user->save();

            DB::table('role_user')
                    ->where('user_id', $id)
                    ->update(['role_id' => 1]);

            //login the user using the user id
            Auth::loginUsingId($results->id); 

            return View::make('verify_email_success')->withData($user);
            
            // return Redirect::to(url() . '/profile');

        } else {
            $data = [
                'message'=>'Invalid Verification Key'
            ];
            return View::make('verify_email_failed')->withData($data);
        }
        

    }

    public function getIndex($id)

    {

          //dd(\Config::get('mail'));

        

        if(Auth::check()){

             $users_id = Auth::user() -> id;

             $email_to_send = Auth::user() -> email;

             

             $role = DB::table('role_user')->where('user_id','=',$users_id)->first();

             $role_id = $role -> role_id;

             //dd($role_id);

             if($role_id == 1 || $role_id == 2 || $role_id == 4)

             {

                     return redirect(url());

             }else{

                //dd(\Config::get("mail"));

                #$username = $id;
				
				$username = DB::table('users')->where('id',$id)->pluck('username');

                $user_id = DB::table('users')->where('id',$id)->pluck('id');

                $email = DB::table('users')->where('id',$id)->pluck('email');

                $image = "images/users/".$username."/".DB::table('users')->where('id',$id)->pluck('photo');

                $name =  DB::table('users')->where('id',$id)->pluck('firstName')." ".DB::table('users')->where('id',$id)->pluck('lastName');

                $verify = DB::table('users')->where('id',$id)->pluck('verify_key');

                $verification_link = "http://seriousdatings.com/users/".$user_id."/verify/".$verify;

                $data= array();

                $data = [

                    'email' => $email,

                    'image' => $image,

                    'name' => $name,

                    'username' => $id,

                    'verification_link' => $verification_link,

                    'image_link'        => 'http://seriousdatings.com/images/logo.jpg',

                    'contact_address'   =>  ''

                ];

                //dd($email);

               $email_to_send = DB::table('users')->where('username',$id)->pluck('email');

                

                // Mail::send('mailtemplate', $data, function($message) use ($email_to_send) {

                //     $message->to($email_to_send,'ID')->subject('Verify your seriousdatings account');

                // });

                

                //Session::flush();
                
                
                $send_email = $this->send_verification_mail();


                return View::make('verify_email')->withData($data);

            }

        }

        else{

            return redirect(url());

        }

    

    }

    

    public function getVarifyPlease(){

        if(Auth::check()){

            $cUser = Auth::user();

            if($cUser['verified']!=0){
                return redirect(url().'/profile');
            }

            $users_id = Auth::user() -> id;
            
            $email_to_send = Auth::user() -> email;


             

            $role = DB::table('role_user')->where('user_id','=',$users_id)->first();

            $role_id = $role -> role_id;

            //dd($role_id);

            if($role_id == 1 || $role_id == 2 || $role_id == 4){

                return redirect(url());

            }
            else{

                //dd(\Config::get("mail"));

                $id=Auth::user() -> id;

                #$username = Auth::user() -> id;

                $user_id = DB::table('users')->where('id',$id)->pluck('id');
                
                $username = DB::table('users')->where('id',$id)->pluck('username');

                $email = DB::table('users')->where('id',$id)->pluck('email');

                $image = "images/users/".$username."/".DB::table('users')->where('id',$id)->pluck('photo');

                $name =  DB::table('users')->where('id',$id)->pluck('firstName')." ".DB::table('users')->where('id',$id)->pluck('lastName');

                $verify = DB::table('users')->where('id',$id)->pluck('verify_key');

                $verification_link = "http://seriousdatings.com/users/".$user_id."/verify/".$verify;

                $data= array();

                $data = [

                    'email' => $email,

                    'image' => DB::table('users')->where('id',$id)->pluck('photo'),//$image,

                    'name' => $name,

                    'username' => $username,

                    'verification_link' => $verification_link,

                    'image_link'        => 'http://seriousdatings.com/images/logo.jpg',

                    'contact_address'   =>  ''

                ];


                //Session::flush();
                // $send_email = $this->send_verification_mail(); 
                
                $userdata = Auth::user();

                return View::make('verify_email')->withData($userdata);

            }

        }

        else{

            return redirect(url());

        }

    }

    public function send_verification_mail(){

        $user = Auth::user();

        $data = [
            'email' => $user['email'],
            'image' => $user['photo'],
            'name' => $user['firstName'] . ' ' . $user['lastName'],
            'username' => $user['username'],
            'verification_link' => url().'/users/' . $user['id'] . '/verify/' . $user['verify_key'],
            'link' => url().'/users/' . $user['id'] . '/verify/' . $user['verify_key'],
            'image_link' => url().'/images/logo.jpg',
            'contact_address' => '',
            'button_text' => 'Verify your email address',
            'contact_address' => ''
        ];

        $email_to_send = $user['email'];
        // return View::make('email.verification')->with($data);

        Mail::send('mailtemplate', $data, function($message) use ($email_to_send) {
            $message->to($email_to_send, 'ID')->subject('Verify your seriousdatings account');
        });

        return 'true';

    }

    

 }

 