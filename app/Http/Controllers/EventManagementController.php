<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\EventMembers;
use View;
use DB;
use Redirect;
use Input;
use DateTime;
use App\Http\Controllers\EventsController;

class EventManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table('events')->select(\DB::raw("events.*,eventtype.*,events.id AS eventID"))
        ->leftJoin('eventtype', 'events.eventtype', '=', 'eventtype.id')
        ->get();

        $format_events = $this->format_events($events);

        //total earnings form events
        $earning_details = $this->earning_details();

        $data = [
            'events'=>$format_events,
            'earning_details'=>$earning_details,
        ];

        // return response()->json($earning_details);
        return \View::make('admin.event.manage_event')->with($data);
    }


    public function format_events($events){
        $data = [];

        if(!empty($events)){
            foreach($events as $r=>$value){

                //Our "then" date.
                $then = $value->endDate;
                
                //Convert it into a timestamp.
                $then = strtotime($then);
                
                //Get the current timestamp.
                $now = time();
                
                //Calculate the difference.
                $difference = $now - $then;
                
                //Convert seconds into days.
                $days = floor($difference / (60*60*24) );
                
                $status_text = 'Active';

                if($days > 0){
                    $status_text = 'Completed';
                }
                else if($days < 0){
                    $status_text = 'Upcoming';
                }

                $value->status_text = $status_text;
                $arr[] = $value;
            }
        }
        return $arr;
    }

    public function earning_details(){
        $events_joiner = EventMembers::all();

        $arr = array(
            'total_members'=>count($events_joiner)
        );
        $earnings = 0;

        if(!empty($events_joiner)){
            foreach($events_joiner as $r=>$value){
                $eventDetails = EventMembers::find($value['id'])->event;

                $earnings += $eventDetails->eventPrice;
            }
        }
        $arr['total_earnings'] = $earnings;

        return $arr;


 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = DB::table('eventtype')->get();
        if($event != null){
            return \View::make('admin.event.add_event')->withEvent($event);
        }
        else
        {
            return redirect(url().'/admin/events/addEventType');
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
        $rules = array(
            'eventCategory'=>'required',
            'title'=>'required',
            'location'=>'required',
            'fromDate'=>'required',
            'toDate'=>'required',
            'description'=>'required',
            'price'=>'required',
            'uploadpicture'=>'required'
        );

        $validator = \Validator::make(\Input::all(),$rules);
        if($validator->fails())
            //return ($validator->messages());
            return \Redirect::to('admin/events/create')
            ->withInput()
            ->witherrors($validator->messages());
        $filname = \Input::file('uploadpicture')->getClientOriginalName();
        $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
        Input::file('uploadpicture')->move(base_path() . '/public/images/events/', $filname);
        $eventCategory = Input::get('eventCategory');
        $title = Input::get('title');
        $location = Input::get('location');
        $lat = Input::get('lat');
        $lng = Input::get('lng');
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');

        $min_members = Input::get('min_members');
        $max_members = Input::get('max_members');
        $youtube_video = Input::get('youtube_video');

        $fromTime = Input::get('fromTime');
        $toTime = Input::get('toTime');

        $description = Input::get('description');
        $price = Input::get('price');

        $fromTime = date("H:i:s", strtotime($fromTime));
        $fromDate = $fromDate.' '.$fromTime;

        $toTime = date("H:i:s", strtotime($toTime));
        $toDate = $toDate.' '.$toTime;
        
        // return response()->json(array('d'=>$toDate));
        
        DB::table('events')->insert( [
            'eventtype'=>$eventCategory,
            'title'=>$title,
            'start'=>$fromDate,
            'endDate'=>$toDate,
            'eventLocation'=>$location,
            'lat'=>$lat,
            'lng'=>$lng,
            'description'=>$description,
            'min_members'=>$min_members,
            'max_members'=>$max_members,
            'youtube_video'=>$youtube_video,
            'eventPrice'=>$price,
            'image'=>$filname
        ]);

        return redirect(url().'/admin/events');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);

        
        $event_ctrl = new EventsController();
        $format_event = $event_ctrl->format_event($event);

        //  $events = DB::table('events')->select(\DB::raw("events.*,eventtype.*,events.id AS eventID"))
        // ->leftJoin('eventtype', 'events.eventtype', '=', 'eventtype.id')
        // ->where('events.id','=',$id)
        // ->first();

        // return response()->json($format_event);

         $eventCategory = DB::table('eventtype')->get();

         $format_event->eventCategory = $eventCategory;

         //dd($event);
        return \View::make('admin.event.edit_event')->withEvent($format_event);
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
    //return 'form posted';
        $rules = array(
            'eventCategory' => 'required',
            'title' => 'required',
            'location'    => 'required',
            'fromDate' => 'required',
            'toDate' => 'required',
            'description' => 'required',
            'price' => 'required',
        );
        $validator = \Validator::make(\Input::all(),$rules);

        if($validator->fails())
            //return ($validator->messages());
            return \Redirect::to('admin/events/create')
            ->withInput()
            ->witherrors($validator->messages());

        $eventCategory = Input::get('eventCategory');
        $title = Input::get('title');
        $location = Input::get('location');
        $lat = Input::get('lat');
        $lng = Input::get('lng');
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');
        $description = Input::get('description');
        $price = Input::get('price');

        $min_members = Input::get('min_members');
        $max_members = Input::get('max_members');
        $youtube_video = Input::get('youtube_video');

        $fromTime = Input::get('fromTime');
        $toTime = Input::get('toTime');

        $fromTime = date("H:i:s", strtotime($fromTime));
        $fromDate = $fromDate.' '.$fromTime;

        $toTime = date("H:i:s", strtotime($toTime));
        $toDate = $toDate.' '.$toTime;

        $toSave = [
            'eventtype'=>$eventCategory,
            'title'=>$title,
            'start'=>$fromDate,
            'endDate'=>$toDate,
            'eventLocation'=>$location,
            'lat'=>$lat,
            'lng'=>$lng,
            'description'=>$description,
            'min_members'=>$min_members,
            'max_members'=>$max_members,
            'youtube_video'=>$youtube_video,
            'eventPrice'=>$price
        ];


        if(Input::file('uploadpicture') != null)
        {
            $filname = \Input::file('uploadpicture')->getClientOriginalName();
            $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
            Input::file('uploadpicture')->move(base_path() . '/public/images/events/', $filname);

            $toSave['image'] = $filname;

        }
        
        DB::table('events')
            ->where('id', $id)
            ->update($toSave);

        return redirect(url().'/admin/events');
               
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      // dd($id);
       $event = Event::find($id);
       $event->delete();
        // redirect
        \Session::flash('success', 'Successfully deleted the event.');
        return \Redirect::to('admin/events');
    }


    public function manage_eventtypes()
    {
        $eventtype = DB::table('eventtype')->get();

        $data = array(
            'event_types'=>$eventtype
        );

         return \View::make('admin.event.manage_eventtypes')->with($data);
    }
    
    public function delete_eventtypes($id)
    {

        // dd($id);
        $event = DB::table('eventtype')->where('id', $id);
        $event->delete();

        \Session::flash('success', 'Successfully deleted the event type.');

        // return \Session::get('success');
        return \Redirect::to('admin/events/manage_eventtypes');
    }
    

    public function eventtypeForm(){

          //  dd("eege");
        return View::make('admin.event.add_event_type');

    }


    public function eventtypePost(Request $request){

        $categoryName = Input::get('categoryName');
        $ageFromMale = Input::get('ageFromMale');
        $ageToMale = Input::get('ageToMale');
        $ageFromFemale = Input::get('ageFromFemale');
        $ageToFemale = Input::get('ageToFemale');
        $id = Input::get('id');
        
        if(empty($id)){
            DB::table('eventtype')->insert([
                'name'=>$categoryName,
                'ageFromMale'=>$ageFromMale,
                'ageToMale'=>$ageToMale,
                'ageFromFemale'=>$ageFromFemale,
                'ageToFemale'=>$ageToFemale
            ]);
        }
        else{
            DB::table('eventtype')->where('id', $id)->update([
                'name'=>$categoryName,
                'ageFromMale'=>$ageFromMale,
                'ageToMale'=>$ageToMale,
                'ageFromFemale'=>$ageFromFemale,
                'ageToFemale'=>$ageToFemale
            ]);
        }

        return redirect(url().'/admin/events/manage_eventtypes');


        

    }

    //laravel api for events
    public function apiGetEvent(){
        $events = DB::table('events')->get();
        // dd($events);
        $format_event = $this->format_event($events);
        return response()->json($format_event);
    }

    public function apiGetEventType($id){
        $events = DB::select('select * from events where eventType = ?', [$id]);
        // dd($events);
        $format_event = $this->format_event($events);
        return response()->json($format_event);
    }

    public function format_event($data){
        $arr = array();
        if(!empty($data)){
            foreach($data as $r=>$value){
                $value->end = $value->endDate;
                $value->image = url().'/public/images/events/'.$value->image;
                $value->allDay = false;
                $arr[] = $value;
            }
        }
        return $arr;
    }

    public function update_eventtypes($id){
        $eventtype = DB::table('eventtype')->where('id', $id)->first();
        $arr = array(
            'eventtype'=>$eventtype
        );
        return \View::make('admin.event.edit_eventtype')->with($arr);
        // return response()->json($eventtype);
    }
}
