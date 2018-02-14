<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GiftCard;
use Input;
use Redirect;
use App\GiftCategory;
use App\GroupChat;
use App\GroupChatParticipants;
use App\GroupChatMessages;


class GiftCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giftCards = GiftCard::where('gift_category_id', '>' ,1)->get();
        $giftCards->load('giftCategory');
        return \View::make('admin.gift_card.manage_giftCard')->with('giftCards', $giftCards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = GiftCategory::where('id', '>', 1)->get();
        return \View::make('admin.gift_card.add_giftCard')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return 'form posted';
        $rules = array(
            'name' => 'required',
            'uploadpicture' => 'required',
            'price' => 'required'
        );

//        dd(\Input::get('category'));
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails())
            return \Redirect::to('admin/gift_cards/create')
                ->withInput()
                ->witherrors($validator->messages());


        $filname = \Input::file('uploadpicture')->getClientOriginalName();
        $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();

        \Input::file('uploadpicture')->move(base_path() . '/public/images/gift_cards/', $filname);
        $giftCard = GiftCard::create(array(
            'gift_category_id' => \Input::get('category'),
            'name' => \Input::get('name'),
            'image' => $filname,
            'price' => \Input::get('price')

        ));

        return \Redirect::to('admin/gift_cards');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \Redirect::to('admin/gift_cards');
        $giftCard = GiftCard::find($id);
        return \View::make('admin.gift_card.view_giftCard')->withCard($giftCard);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giftCard = GiftCard::find($id);
        return \View::make('admin.gift_card.edit_giftCard')->withCard($giftCard);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'price' => 'required'
        );

        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails())
            return Redirect::to('admin/gift_cards/' . $id . '/edit')
                ->withInput()
                ->witherrors($validator->messages());

        $giftCard = GiftCard::find($id);
        $giftCard->name = \Input::get('name');
        $giftCard->price = \Input::get('price');

        if (Input::file('uploadpicture') != null) {
            $filname = \Input::file('uploadpicture')->getClientOriginalName();
            $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
            \Input::file('uploadpicture')->move(base_path() . '/public/images/gift_cards/', $filname);
            $giftCard->image = $filname;
        }
        $giftCard->save();
        \Session::flash('message', 'Successfully updated!');
        return \Redirect::to('admin/gift_cards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giftCard = GiftCard::find($id);
        $giftCard->delete();
        // redirect
        \Session::flash('message', 'Successfully deleted!!');
        return \Redirect::to('admin/gift_cards');
    }

    public function getCategoryList()
    {
        $categories = GiftCategory::all();

        return \View::make('admin.gift_card.manage_category_gift')->with('categories', $categories);
    }

    public function addGiftCardCategory(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:gift_category,name',
        ]);

        $category = GiftCategory::create(['name' => $request->name]);

        return response()->json($category);
    }

    public function editGiftCardCategory(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:gift_category,name',
        ]);

        GiftCategory::where('id', $request->id)
            ->update(['name' => ucfirst(strtolower($request->name))]);

        $category = GiftCategory::find($request->id);

        return response()->json($category);
    }

    public function deleteGiftCardCategory(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|exists:gift_category,name',
        ]);

        $category = GiftCategory::find($request->id);

        if ($category->deletable) {
            $data['message'] = 'This categeroy name is used.';
            return response()->json($data);
        } else {
            return response()->json($category);
        }
    }

    public function getGiftCards(){
        $categories = GiftCategory::all();
        $data = [];

        if(!empty($categories)){
            foreach($categories as $r=>$value){
                $value['cards'] = GiftCategory::find($value->id)->giftCard()->get();
                $data[] = $value;
            }
        }

        return response()->json($data);
    }

    public function sendGiftCards(Request $request){
        $cards = $request->input('cards');
        $from_id = (int) $request->input('from_id');
        $to_id = (int) $request->input('to_id');
        $price = $request->input('price');

        $private_id = $from_id * $to_id;
        $room_id = $this->get_private_chat_id($private_id, $from_id, $to_id);

        $newChat = [
            'group_id'=>$room_id,
            'user_id'=>$from_id,
            'message'=>$cards,
            'type'=>'virtual_gift',
            'price'=>$price,
        ];

        $data = GroupChatMessages::create($newChat);

        return response()->json($data);
    }

    
    public function get_private_chat_id($private_id, $from_id, $to_id){
        $room = GroupChat::where('private_id', $private_id)->first();
        $input = [
            'private_id'=>$private_id
        ];

        if(!isset($room->id)){
            $room = GroupChat::create($input);
            GroupChatParticipants::create(['user_id'=>$from_id, 'group_id'=>$room->id]);
            GroupChatParticipants::create(['user_id'=>$to_id, 'group_id'=>$room->id]);
            $room->new = true;
        }

        return $room->id;
    }

    public function sendEmoji(Request $request){
        $cards = $request->input('cards');
        $from_id = (int) $request->input('from_id');
        $to_id = (int) $request->input('to_id');
        $price = $request->input('price');

        $private_id = $from_id * $to_id;
        $room_id = $this->get_private_chat_id($private_id, $from_id, $to_id);

        $newChat = [
            'group_id'=>$room_id,
            'user_id'=>$from_id,
            'message'=>$cards,
            'type'=>'emoji',
            'price'=>$price,
        ];

        $data = GroupChatMessages::create($newChat);
        $url = url().'/public/images/emoji/';
        $notifInfo = [
                'toId'=>$to_id,
                'from_id'=>$from_id,
                'cards'=>$cards,
                'url'=>$url
        ];
        return response()->json(['dataS'=>$data,'notifInfo'=>$notifInfo]);
    }

}