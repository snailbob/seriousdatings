<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GiftCard;
use Input;
use Redirect;


class GiftCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giftCards = GiftCard::all();
        if ($giftCards === null) {
            $giftCards = null;
		}
		//return $giftCards;
         return \View::make('admin.gift_card.manage_giftCard')->withCards($giftCards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.gift_card..add_giftCard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return 'form posted';
		$rules = array(
                'name' 				=> 'required',
                'uploadpicture'    	=> 'required',
                'price' 			=> 'required'
                );
        
                $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                 	return \Redirect::to('admin/gift_cards/create')
                    ->withInput()
                    ->witherrors($validator->messages());
                $filname = \Input::file('uploadpicture')->getClientOriginalName();
                $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
                \Input::file('uploadpicture')->move(base_path() . '/public/images/gift_cards/', $filname);
                 $giftCard= GiftCard::create(array(
                    'name'          => \Input::get('name'),
                    'image'         => $filname,
					'price'         => \Input::get('price')
                    
                ));
                return \Redirect::to('admin/gift_cards');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $rules = array(
                'name' 				=> 'required',
                'price' 			=> 'required'
                );
        
                $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return Redirect::to('admin/gift_cards/'.$id.'/edit')
                    ->withInput()
                    ->witherrors($validator->messages());

                $giftCard = GiftCard::find($id);
                $giftCard->name = \Input::get('name');
                $giftCard->price = \Input::get('price');
                
                if(Input::file('uploadpicture') != null)
                {
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
     * @param  int  $id
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
}
