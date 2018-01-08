<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use Auth;
use Redirect;
use View;
use Input;
class ForgotPasswordController extends Controller
{
 
    
    public function showForgetForm()
    {

           $data = "";
           return View::make('forgotPassword')->withData($data);
    
    }

    public function forgetFormPost()
    {
    
        
        $email =  Input::get("email");
        $users = DB::table('users')
                     ->where('email', '=', $email)
                     ->first();
        if($users != null){
            $rest_key = str_random(40);
            $username = $users -> username;
            $id = $users -> id;
            $user_id = DB::table('users')->where('username',$username)->pluck('id');
            $email = DB::table('users')->where('username',$username)->pluck('email');
            $image = "images/users/".$username."/".DB::table('users')->where('username',$username)->pluck('photo');
            $name =  DB::table('users')->where('username',$username)->pluck('firstName')." ".DB::table('users')->where('username',$username)->pluck('lastName');
            $verification_link = url()."/forgotPassword/".$email."/".$rest_key;
            $data= array();
            $data = [
                'email' => $email,
                'image' => $image,
                'name' => $name,
                'username' => $username,
                'verification_link' => $verification_link,
                'image_link'        => 'http://seriousdatings.com/images/logo.jpg',
                'contact_address'   =>  ''

            ];
            //dd(\Config::get("mail"));
                
            $email_to_send = $email;
                
                Mail::send('mailtemplatereset', $data, function($message) use ($email_to_send) {
                    $message->to($email_to_send,'ID')->subject('Reset Your Seriousdatings Account Password');
                });

           
            DB::table('users')
            ->where('id', $id)
            ->update(['reset_key' => $rest_key]);
            //Session::flush();
             $data = "Please check your email for verification link";
            return View::make('forgotPassword')->withData($data);
        }
        else{

            $data = "Provided Email is not registered with seriousdatings";
            return View::make('forgotPassword')->withData($data);
        }

    }

    
    public function showForgetFormWithKey($username,$key)
    {
    


        $users = DB::table('users')
                     ->where('email', '=', $username)
                     ->first();
        $reset_key = $users -> reset_key;
        if($reset_key == $key){


            $data = array(
                        'status' => '',
                        'email'  => $username
                     );
            return View::make('updatePassword')->withData($data);

        }
        else{

            $data = "Reset Key doesnot match.";
            return View::make('forgotPassword')->withData($data);
        }
    }

    
    public function forgetFormWithKeyPost()
    {
        //dd($_POST);
        $email = Input::get('email');
        $password = Input::get('password');
        $newPassword =  \Hash::make($password);
         DB::table('users')
            ->where('email', $email)
            ->update(['reset_key' => '']);

         DB::table('users')
            ->where('email', $email)
            ->update(['password' => $newPassword]);

         $data = array(
                        'status' => 'Password updated successfully',
                        'email'  => $email
                     );
            return View::make('updatePassword')->withData($data);  

           
    }
    

 }
 