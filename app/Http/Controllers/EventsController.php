<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Redirect;
use Auth;
use View;
use Input;
use Mail;

use App\EventMembers;
use App\User;

class EventsController extends Controller
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
        
        $events = DB::table('events')
        ->leftJoin('eventtype', 'events.eventtype', '=', 'eventtype.id')
        ->get();

         $eventCategory = DB::table('eventtype')->get();

        $encodedEvents = json_encode($events);

        $data = array(
            'events'           => $events,
            'encodedEvents'    => $encodedEvents,
            'eventCategory'    => $eventCategory
        );
       // dd($data);
       
        return \View::make('user.events')->withEvents($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd($_POST);
        $custom  = explode(",",Input::get('custom'));
        $payer_id = Input::get('payer_id');
        $payment_date = Input::get('payment_date');
        $payer_email = Input::get('payer_email');
        $verify_sign = Input::get('verify_sign');
        $txn_id = Input::get('txn_id');
        $auth = Input::get('auth');
        $eventId = (isset($custom[0])) ? $custom[0]  : '';
        $user_id = (isset($custom[1])) ? $custom[1] : '';
        //dd($custom);
        $eventTitle = DB::table('events')->where('id','=',$eventId)->pluck('title');

        if($eventId != null){
            $matchThese = ['user_id' => $user_id, 'eventId' => $eventId]; 
            $check = DB::table('me_events')->where($matchThese)->pluck('id');
            if($check < 1){
                DB::table('me_events')->insert(
                    ['payer_id' => $payer_id, 'payment_date' => $payment_date, 'payer_email' =>$payer_email, 'verify_sign' =>$verify_sign, 'txn_id' =>$txn_id, 'auth' =>$auth, 'eventId' =>$eventId, 'user_id' =>$user_id]
                );
            }
            return View::make('eventRegisterSuccess')->withTitle($eventTitle);
        }
        else{

            return "Form not submitted properly";
        }
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
        $logged_in = 0;
             if (Auth::check())
            {
                 $logged_in = Auth::user() -> id;
            }
        $singleEvent = DB::table('events')
                    ->select(DB::raw("*,events.id AS id"))
                    ->leftJoin('eventtype', function($join)
                         {
                             $join->on('events.eventtype', '=', 'eventtype.id');
                             
                         })
                     ->where('events.title', '=', $id)
                     ->get();
        if($singleEvent != null){
        $eventId = $singleEvent['0'] -> id;

        $user_age = DB::table('users')->where('id','=',$logged_in)->pluck('age');
        $gender = DB::table('users')->where('id','=',$logged_in)->pluck('gender');
        
        $eligible = 0;
        if($gender == "Male"){

            if($user_age >= $singleEvent['0'] -> ageFromMale && $user_age <= $singleEvent['0'] -> ageToMale)
            {
                $eligible = 1;
            }
            else
            {
                $eligible = 0;
            }
        }
        elseif ($gender == "Female") {
            if($user_age >= $singleEvent['0'] -> ageFromFemale && $user_age <= $singleEvent['0'] -> ageToFemale)
            {
                $eligible = 1;
            }
            else
            {
                $eligible = 0;
            }
        }
        else{

             $eligible = 0;
        }

                

          $eventPictures = DB::table('eventPictures')
                ->where('eventID',$eventId)
                ->get();


        $eventUsers = DB::table('me_events')
                     ->leftJoin('users', function($join)
                         {
                             $join->on('me_events.user_id', '=', 'users.id');
                             
                         })
                     ->where('me_events.eventId', '=', $eventId)
                     ->get();

        $matchThese = ['user_id' => $logged_in, 'eventId' => $eventId]; 
        //dd($matchThese);
        //dd($matchThese);       
         $eventCheck = DB::table('me_events')
            ->where( $matchThese)
            ->pluck('id');
        $eventRegisterStatus = 0;
        //dd($eventCheck);
        if($eventCheck != null){

                    $eventRegisterStatus = 1;
                }
                else{

                   $eventRegisterStatus = 0;

                }
                $role_user = DB::table('role_user')->where('user_id', $logged_in)->pluck('role_id');
                $role_user_status = 0;
                if($role_user != null){
                    if($role_user != 4){
                        $role_user_status = 1;
                    }
                    else{
                        $role_user_status = 2;
                    }
                }
                else{

                    $role_user_status = 0;
                }

               
                
                $singleEvent[0]->role_user_status = $role_user_status;
                $singleEvent[0]->eventRegisterStatus = $eventRegisterStatus;
                $singleEvent[0]->eventUsers = $eventUsers;
                $singleEvent[0]->eventPictures = $eventPictures;
                $singleEvent[0]->eligible = $eligible;
                
               // dd($singleEvent);
                
                //dd($singleEvent);
        }
         //dd($singleEvent);
         return View::make('eventsSingle')->withEvent($singleEvent);


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

    public function eventCategory($id)
    {

        if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }
        
        $events = DB::table('events')
        ->leftJoin('eventtype', 'events.eventtype', '=', 'eventtype.id')
        ->where('events.eventtype', '=', $id)
        ->get();

        $eventCategory = DB::table('eventtype')->get();
        
        $data = array(
            'eventCategory'    => $eventCategory
        );

        if($events != null){
            $eventtypeString=$events['0'] ->name." Women ".$events['0'] ->ageFromFemale." - ".$events['0'] ->ageToFemale." / Men ".$events['0'] ->ageFromMale." - ".$events['0'] ->ageToMale;

            $encodedEvents = json_encode($events);
            

            $data = array(
                'events'           => $events,
                'encodedEvents'    => $encodedEvents,
                'eventTypeString'  => $eventtypeString,
                'eventCategory'    => $eventCategory
            );
        }
        
        //dd($data);
        // return \View::make('eventsGroup')->withEvents($data);
        return \View::make('user.events')->withEvents($data);
    }

    //page
    public function getEventsDetails($id){
        $event = DB::table('events')
        ->where('id', $id)
        ->first();

        $format_event = $this->format_event($event);
        // return response()->json($event);

        $eventCategory = DB::table('eventtype')->get();
        
        $data = array(
            'event'=> $event,
            'eventCategory'=> $eventCategory
        );
        return \View::make('user.event_details')->withEvents($data);
        
    }

    public function apiPostJoinEvent(Request $request){
        EventMembers::create($request->input());

        return response()->json($request->input());
    }

    public function apiLeaveEvent(Request $request){
        $r = $request->input();
        EventMembers::where('user_id', $r['user_id'])->where('event_id',$r['event_id'])->delete();

        $members = EventMembers::where('event_id', $r['event_id'])->get();
        $mem_format = $this->format_members($members);

        return response()->json($mem_format);
    }
    
    public function apiGetEventsDetails($id){
        $event = DB::table('events')
        ->where('id', $id)
        ->first();

        $user = Auth::user();
        $format_event = $this->format_event($event);
        
        $arr = array(
            'user'=>$user,
            'event'=>$format_event
        );
        return response()->json($arr);
        
    }

    public function paying_user_group($type = 'paid'){
        $filter_user = [];
        $users = User::all();

        if(!empty($users)){
            foreach($users as $r=>$value){
                $hasPayment = User::find($value->id)->payment()->count();
                $value->photo = $hasPayment;
                if($type == 'paid'){
                    if(!empty($hasPayment)){
                        $filter_user[] = $value;
                    }
                }
                else{
                    if(empty($hasPayment)){
                        $filter_user[] = $value;
                    }
                }
            }
        }
        return $filter_user;
    }
    
    public function send_event_invite(Request $request){
        $data = $request->input(); //response()->json($request->input());   
        // $data['invited_by'] = Auth::user()->firstName;

        $data['event'] = DB::table('events')->where('id',$data['id'])->first();

        $data['link'] = url().'/events/details/'.$data['id'];
        $data['button_text'] = 'View Event Details';

        $filter_user = $this->paying_user_group($data['type']);
        $data['filter_user'] = count($filter_user);


        if(!empty($filter_user)){
            foreach($filter_user as $r=>$value){

                $email_to_send = $value->email; 
                // return View::make('email.admin_event_invite')->with($data);
                
                Mail::send('email.admin_event_invite', $data, function($message) use ($email_to_send) {
                    $message->to($email_to_send, 'ID')->subject('You are invited for a Serious Datings Event');
                });
                
            }
        }
        
        // return $data;

        return response()->json($data);



    }
    
    public function format_event($data){
        $user_id = (Auth::check()) ? Auth::user()->id : '0';
        $arr = null;
        if(isset($data->id)){
            $data->end = $data->endDate;
            $data->image = url().'/public/images/events/'.$data->image;
            $data->allDay = false;

            //check if joined
            $is_joined = EventMembers::where('user_id', $user_id)->where('event_id', $data->id)->count();
            $data->joined = (!empty($is_joined)) ? true : false;

            $members = EventMembers::where('event_id', $data->id)->get();
            $mem_format = $this->format_members($members);
            $data->members = $mem_format;
            $arr = $data;

        }
        return $arr;
    }

    public function format_members($data){
        $arr = array();

        if(!empty($data)){
            foreach($data as $r=>$value){
                $arr[] = EventMembers::find($value->id)->user()->first();
            }
        }
        return $arr;        
    }
    
    public function uploadForm($id){

         $singleEvent = DB::table('events')
                     ->leftJoin('eventtype', function($join)
                         {
                             $join->on('events.eventtype', '=', 'eventtype.id');
                             
                         })
                     ->where('events.title', '=', $id)
                     ->get();
        return View::make('eventsSingleForm')->withEvent($singleEvent);

    }

    public function upload($id){
        //dd($_FILES);
        $files = array();
        $files = Input::file('images');
        foreach(Input::file('images') as $file)
        {
            echo "<br/>File: $file";
            if($file != null){
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $file->move(base_path() . '/public/images/events/'.Input::get('eventId').'/', $filename);
                        $matchThese = ['eventID' => Input::get('eventId'), 'picture' => $filename]; 
                        $eventCheck = DB::table('eventPictures')
                            ->where( $matchThese)
                            ->pluck('id');
                        if($eventCheck == null)
                        {
                            DB::table('eventPictures')->insert(
                                ['eventID' => Input::get('eventId'), 'picture' => $filename]
                            );
                        }
                        
            }
        }
        $eventTitle = DB::table('events')
                ->where('id',Input::get('eventId'))
                ->pluck('title');
            $url = url().'/events/'.$eventTitle;
            return redirect($url);
    }
}
