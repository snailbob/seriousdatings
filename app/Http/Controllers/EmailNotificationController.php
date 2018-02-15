<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

use Mail;

class EmailNotificationController extends Controller
{


    public function sendEmailNotification(Request $request){
        $data = $request->input(); //response()->json($request->input());   
        // $data['invited_by'] = Auth::user()->firstName;
        $data['link'] = url();
        $data['name'] = (isset($data['name'])) ? $data['name'] : '';
        $data['content_message'] = (isset($data['message'])) ? $data['message'] : '';
        $data['button_text'] = 'Visit SeriousDatings Now';

        $email_to_send = (isset($data['email'])) ? $data['email'] : 'test@test.com';

        // return View::make('email.notifications_to_user')->with($data);
        
        Mail::send('email.notifications_to_user', $data, function($message) use ($email_to_send) {
            $message->to($email_to_send, 'ID')->subject('Serious Datings - Notifications');
        });

        return $data;

    }

    public function sendEmailNotificationPassArray($arr){
        $data = $arr; //response()->json($request->input());   
        // $data['invited_by'] = Auth::user()->firstName;
        $data['link'] = url();
        $data['name'] = (isset($data['name'])) ? $data['name'] : '';
        $data['content_message'] = (isset($data['message'])) ? $data['message'] : '';
        $data['button_text'] = 'Visit SeriousDatings Now';

        $email_to_send = (isset($data['email'])) ? $data['email'] : 'test@test.com';

        // return View::make('email.invite_friend')->with($data);
        
        Mail::send('email.notifications_to_user', $data, function($message) use ($email_to_send) {
            $message->to($email_to_send, 'ID')->subject('Serious Datings - Notifications');
        });

        return $data;

    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
    }
}
