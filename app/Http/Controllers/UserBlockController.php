<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\UserBlocks;

class UserBlockController extends Controller
{


    public function myUserBlocksGet(Request $request){
        $id = (!empty($request->input('id'))) ? $request->input('id') : Auth::id();

        $user_blocks = UserBlocks::where('user_id', $id)->get();
        $user_blocks->load('userBlocked');

        return response()->json($user_blocks);
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
        $logged_user = Auth::user()->id;
        $user_blocked_id = $request->input('id');

        UserBlocks::create([
            'user_id'=>$logged_user,
            'user_blocked_id'=>$user_blocked_id
        ]);

        return response()->json($request->input());
    }

    /*Block User from speedDating Return Bool*/
    public function speedBlock(Request $request)
    {
        $logged_user = Auth::user()->id;
        $user_blocked_id = $request->input('id');

          $data = UserBlocks::create([
                'user_id'=>$logged_user,
                'user_blocked_id'=>$user_blocked_id
            ]);
          
          $message = ['trans' => false,
                      'message'=>'Fail to block user'];
          if ($data) {
             $message = ['trans' => true,
                      'message'=>'Succesfully Block'];
          }
      return response()->json($message);
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
    public function destroy(Request $request)
    {
        $id = Auth::user()->id;
        $u = UserBlocks::where('user_id',$id)->where('user_blocked_id',$request->input('id'))->delete();
        return response()->json(['id'=>$id]);

    }
}
