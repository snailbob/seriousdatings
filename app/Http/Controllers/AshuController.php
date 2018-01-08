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
class AshuController extends Controller
{


    public function showForm()
    {
      if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }
       $result = "Data error";
       return \View::make('ashu_test')->with("data",$result);
    }


    
}
