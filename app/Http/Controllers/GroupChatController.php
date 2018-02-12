<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\GroupChat;
use App\GroupChatParticipants;
use App\GroupChatMessages;
use App\GiftCard;

class GroupChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = GroupChat::all();
        $format_group_chat = $this->format_group_chat($rooms);

        return response()->json($format_group_chat);
    }

    public function format_participants($group_id){
        $participants = GroupChat::find($group_id)->participants()->get();

        $format_data = [];
        if(!empty($participants)){
            foreach($participants as $r=>$value){
                $value->user_info = User::select('firstName','lastName', 'photo', 'username')->find($value->user_id);
                $format_data[] = $value;
            }
        }
        return $format_data;
    }

    public function format_messages($group_id){
        $messages = GroupChat::find($group_id)->messages()->orderBy('id', 'DESC')->take(15)->get();

        $format_data = [];
        if(!empty($messages)){
            foreach($messages as $r=>$value){
                $value->user_info = User::select('firstName','lastName', 'photo', 'username')->find($value->user_id);

                //format_message for virtual_gift
                if($value->type == 'virtual_gift'){
                    $gifts = explode(',', $value->message);
                    $value->gifts = $this->format_gift_cards($gifts);
                }
                //format_message for emoji
                if($value->type == 'emoji'){
                    $gifts = explode(',', $value->message);
                    $value->emoji = $this->format_emoji($gifts);
                }

                $format_data[] = $value;
            }
        }
        return $format_data;
    }


    public function format_emoji($cards){
        $format_data = [];

        if(!empty($cards)){
            foreach($cards as $r=>$value){
                $format_data[] = url().'/public/images/emoji/'.$value;
            }
        }
        return $format_data;
    }
    public function format_gift_cards($cards){
        $format_data = [];

        if(!empty($cards)){
            foreach($cards as $r=>$value){
                $format_data[] = GiftCard::find($value);
            }
        }
        return $format_data;
    }

    public function format_group_chat($rooms){

        $format_data = [];
        if(!empty($rooms)){
            foreach($rooms as $r=>$value){
                $value->participants = $this->format_participants($value->id);
                $value->messages = $this->format_messages($value->id);
                $format_data[] = $value;
            }
        }
        return $format_data;

    }

    public function get_private_chat_id(Request $request){
        $room = GroupChat::where('private_id', $request->input('private_id'))->first();
        $input = $request->input();

        if(!isset($room->id)){
            $room = GroupChat::create($input);
            GroupChatParticipants::create(['user_id'=>$input['user_id'], 'group_id'=>$room->id]);
            GroupChatParticipants::create(['user_id'=>$input['logged_id'], 'group_id'=>$room->id]);
            $room->new = true;
        }

        return response()->json($room);
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
        $input = $request->input();
        $data = GroupChat::create($input);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = GroupChat::where('id', $id)->get();
        $format_group_chat = $this->format_group_chat($room);
        $data = (!empty($format_group_chat)) ? $format_group_chat[0] : null;
        return response()->json($data);

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
