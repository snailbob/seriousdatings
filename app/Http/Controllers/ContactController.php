<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use \App\User;
use App\Compatability;
use DB;
use DateTime;
use Request;
use Mail;
use Auth;
class ContactController extends Controller
{


    public function showForm()
    {
      if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }
       $result = "";
       return \View::make('contact')->with("data",$result);
    }


    public function postForm()
    {

      if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }
      $data= array();
                $data = [
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'desc' => Input::get('desc'),
                    'image_link'        => 'http://seriousdatings.com/images/logo.jpg',
                    'contact_address'   =>  ''
                ];
              //dd($data);
               $email_to_send = DB::table('users')->where('username','=','admin')->pluck('email');
               //dd($email_to_send);
               $email_to_send = "softechsgd@gmail.com";
                Mail::send('contact_email_template', $data, function($message) use ($email_to_send) {
                    $message->to($email_to_send,'ID')->subject('Contact US');
                });

      $result = "Request Sent Successfully";
      return \View::make('contact')->with("data",$result);
    }
}
