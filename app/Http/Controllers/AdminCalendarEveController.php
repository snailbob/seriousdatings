<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminCalendarEveController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showCalendar() { 
       
        $types = \DB::table('eventtype')->get();
        // dd($types);
        return \View::make('admin.calendar.calendar')->withTypes($types);
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showComposeMail() { 
       
        return \View::make('admin.sendmail.mail');
    }

    public function showCalendarByEvent($id){

        // $users = \DB::select('select * from users where active = ?', [1]);
        // dd($id);
        
        $types = \DB::table('eventtype')->get();

        return \View::make('admin.calendar.calendar_event')->with(array('types'=>$types,'id'=>$id));

        
    }

}
