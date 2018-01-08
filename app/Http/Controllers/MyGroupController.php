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

class MyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $logged_in = 0;
             if (Auth::check())
            {
                 $logged_in = Auth::user() -> id;
            }
          $groups = DB::table('user_groups')
                    ->where('user_id', '=', $logged_in)
                    ->get();
           foreach ($groups as $group) {
            
                $group->logged_in = $logged_in;

            }
        return View::make('groups')->withGroups($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $user_id = 0;
             if (Auth::check())
            {
                 $user_id = Auth::user() -> id;
                 return View::make('createGroup')->withData($user_id);
            }
            else{

                return \View::make('login');
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
        
        if(Input::file('photo') != null){
        
        $filname = Input::file('photo')->getClientOriginalName();
        
        $imageName = Input::file('photo')->getClientOriginalExtension();

        $id = DB::table('user_groups')->insertGetId(
            ['user_id' => Input::get('userId'), 'group_name' => Input::get('groupName'), 'description' => Input::get('description'),'groupType' =>Input::get('groupType'), 'groupAdmin' => Input::get('userId'),'image' => $filname]   
        );
        Input::file('photo')->move(base_path() . '/public/images/groups/'.$id.'/', $filname);

        return redirect('groups/'.$id);
    }
    else{

        return redirect('profile/groups/create');
    }
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
            $groups = DB::table('user_groups')
                     ->leftJoin('group_member', function($join)
                         {
                             $join->on('user_groups.id', '=', 'group_member.group_id');
                         })
                     ->where('user_groups.id', '=', $id)
                     ->get();
          $matchThese = ['group_id' => $id, 'user_id' => $logged_in]; 
          $checkJoined = DB::table('group_member')
                     ->where($matchThese)
                     ->get();
            $joined = 0;
            if($checkJoined != null){
                $joined = 1;
            }
            else{

                $joined = 0;
            }

        foreach ($groups as $group) {
            
            $member_id = $group -> user_id;
            $user_info = DB::table('users')
                     ->where('id', '=', $member_id)
                     ->first();
            $group->user_info = $user_info;
            $group->logged_in = $logged_in;
            $group->joined = $joined;
            $group->groupID = $id;
            if($group -> groupAdmin == $logged_in){
                $group->admin= 1;
            }
            else{
              $group->admin= 0;
            }
            
        }
        //dd($groups);
        return View::make('groupMembers')->withGroups($groups);
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

    public function addFriend()
    {
        //
    }

    public function removeFriend()
    {
        //
    }

    
    public function showGroups()
    {
        
         $logged_in = 0;
        if (Auth::check()){
            $logged_in = Auth::user() -> id;
        }

        $groups = DB::table('user_groups')->get();

        foreach ($groups as $group) {
            $group->logged_in = $logged_in;

        }
        
        return View::make('groups')->withGroups($groups);
    }


    public function addMemberForm($id){


        $logged_in = (Auth::check()) ? Auth::user()->id : 0;

        $friends  = DB::table('user_friendships')
                    ->leftJoin('users', function($join)
                        {
                            $join->on('user_friendships.friend_id', '=', 'users.id');
                        })
                    ->where('user_friendships.user_id', '=', $logged_in)
                    ->get();

        $membersToAddCount = 0;

        foreach ($friends as $friend) {
            $matchThese = ['group_id' => $id, 'user_id' => $friend -> friend_id]; 
            $checkJoined = DB::table('group_member')
                    ->where($matchThese)
                    ->get();
                    
            $joined = 0;
            if($checkJoined != null){
                $joined = 1;
            }
            else{
                $joined = 0;
                $membersToAddCount = $membersToAddCount+1;
            }
            $friend->alreadyMember = $joined;

        }

        $groups = DB::table('user_groups')
                    ->leftJoin('group_member', function($join)
                        {
                            $join->on('user_groups.id', '=', 'group_member.group_id');
                        })
                    ->where('user_groups.id', '=', $id)
                    ->get();
        
          
        foreach ($groups as $group) {
            
            $member_id = $group -> user_id;
            $user_info = DB::table('users')
                     ->where('id', '=', $member_id)
                     ->first();
            $group->user_info = $user_info;
            $group->logged_in = $logged_in;
            $group->groupID = $id;
            $group->membersToAdd = $friends;
            $group->membersToAddCount = $membersToAddCount;
            
            
        }
        
        if($groups != null){
            return View::make('addMember')->withGroups($groups);
        }
        else{

            return redirect(url().'/groups');
        }


    }
    public function addMemberPost(Request $request){


        foreach (Input::get('members') as $member_id) {
           
           $id = DB::table('group_member')->insertGetId(
            ['group_id' => Input::get('groupID'), 'user_id' => $member_id]   
            );

        }
        
        return redirect('groups/'. Input::get('groupID'));

    }
    

public function removeMemberForm($id){


            $logged_in = 0;
             if (Auth::check())
            {
                 $logged_in = Auth::user() -> id;
            }



            $members  = DB::table('group_member')
                     ->leftJoin('users', function($join)
                         {
                             $join->on('group_member.user_id', '=', 'users.id');
                         })
                     ->where('group_member.group_id', '=', $id)
                     ->get();

            
            $group = DB::table('user_groups')
                     ->where('user_groups.id', '=', $id)
                     ->first();
          
          
            if($group != null){
                $group->membersToRemove = $members;
                $group->logged_in = $logged_in;
            }
        
        
         //dd($group);
            if($group != null){
                return View::make('removeMember')->withGroup($group);
            }
            else{

                return redirect(url().'/groups');
            }

    }
    public function removeMemberPost(Request $request){

        //dd("Posted");
        foreach (Input::get('members') as $member_id) {
           
            $matchThese = ['group_id' => Input::get('groupID'), 'user_id' => $member_id]; 
            DB::table('group_member')->where($matchThese)->delete();
            }
        
        return redirect('groups/'. Input::get('groupID'));

    }










}
