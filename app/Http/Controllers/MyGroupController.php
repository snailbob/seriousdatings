<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Redirect;
use Input;
use View;
use App\Group;
use App\GroupUser;
use App\User;

class MyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $groups = Group::all();
        $data = array();
        $created_by = array();
        foreach ($groups as $key) {
            $data[$key->id]['population'] = DB::table('groups_users')
                ->where('group_id', $key->id)
                ->count();
            $created_by[] = User::find($key->created_by_id);
        }
        $creator = array();

        foreach ($groups->toArray() as $key => $value) {
            $creator[] = $value;
            $creator[$key]['created_by_id'] = $created_by[$key]->firstName . " " . $created_by[$key]->lastName;
        }

        return View::make('groups')->with(['groups' => $groups, 'data' => $data, 'created' => $creator]);
    }

    public function create()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            return View::make('createGroup')->withData($user_id);
        } else {
            return \View::make('login');
        }

    }

    public function show($id)
    {
        $group = GroupUser::where('group_id', $id)->get();
        $group->load('user', 'group');
        $group_details = Group::find($id);
        $members_id = array();
        $created_by = User::find($group_details->created_by_id);
        foreach ($group as $group_mem) {
            $members_id[] = $group_mem->user_id;
        }
        return View::make('groupMembers')->with(['group' => $group, 'created' => $created_by, 'group_details' => $group_details, 'members' => $members_id]);
    }

    public function createGroup(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'groupType' => 'required',
            'groupName' => 'required|max:200',
            'description' => 'max:1000',
            'userId' => 'required'
        ]);

        if (!$validate->fails()) {
            $filname = Input::file('photo')->getClientOriginalName();
            $group = Group::create([
                'name' => Input::get('groupName'),
                'created_by_id' => Input::get('userId'),
                'description' => Input::get('description'),
                'image' => $filname,
                'block' => 0,
                'isPrivate' => Input::get('groupType')
            ]);

            GroupUser::create([
                'user_id' => Auth::id(),
                'group_id' => $group->id,
                'role_id' => 2,
                'block' => 0,
                'isJoin' => 1
            ]);


            Input::file('photo')->move(base_path() . '/public/images/groups/' . $group->id . '/', $filname);

            return redirect('groups/' . $group->id);
        } else {
            return redirect('profile/groups/create');
        }
    }

    public function showGroups()
    {

        $logged_in = 0;
        if (Auth::check()) {
            $logged_in = Auth::user()->id;
        }

        $groups = DB::table('user_groups')->get();

        foreach ($groups as $group) {
            $group->logged_in = $logged_in;

        }

        return View::make('groups')->withGroups($groups);
    }


    public function addMemberForm($id)
    {
        $group = Group::find($id);
        $created_by = User::find($group->created_by_id);
        $users = User::all();
        $members = DB::table('groups_users')
            ->join('users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups_users.group_id', '=', 'groups.id')
            ->select('groups_users.block', 'groups.name', 'groups.id as groupId', 'users.id', 'users.firstName', 'users.lastName', 'users.email', 'users.verified', 'users.username', 'users.photo')
            ->where('users.deleted_at', NULL)
            ->where('groups_users.group_id', $id)
            ->get();

        $non_members = DB::table('groups_users')
            ->rightJoin('users', 'groups_users.user_id', '=', 'users.id')
            ->select('groups_users.group_id as groupId', 'users.id', 'users.firstName', 'users.lastName', 'users.email', 'users.verified', 'users.username', 'users.photo')
            ->where('users.deleted_at', NULL)
            ->where('groups_users.group_id', '!=', $id)
            ->orWhere('groups_users.group_id', NULL)
            ->get();

        $members_id = array();
        foreach ($members as $member) {
            $members_id[] = $member->id;
        }

        foreach ($non_members as $non_member) {
            $non_unique_members[] = $non_member->id;
        }

        $non_members = array_unique($non_unique_members);

        foreach ($non_members as $key => $value) {
            if (!in_array($value, $members_id)) {
                $non_members_id[] = $value;
            }
        }

        return View::make('addMember')->with(['members' => $members, 'non_members' => $non_members_id, 'users' => $users, 'created' => $created_by, 'group' => $group]);
    }

    public function addMemberPost(Request $request)
    {
        foreach (Input::get('members') as $member_id) {
            $id = DB::table('groups_users')->insertGetId(
                ['group_id' => Input::get('groupID'), 'user_id' => $member_id]
            );
        }
        return redirect('groups/' . Input::get('groupID'));
    }


    public function removeMemberForm($id)
    {
        $group = GroupUser::where('group_id', $id)->get();
        $group->load('user', 'group');
        $group_details = Group::find($id);
        $members_id = array();
        $created_by = User::find($group_details->created_by_id);
        foreach ($group as $group_mem) {
            $members_id[] = $group_mem->user_id;
        }
        return View::make('removeMember')->with(['groups' => $group, 'created' => $created_by, 'group_details' => $group_details, 'members' => $members_id]);
    }

    public function removeMemberPost(Request $request)
    {
        foreach (Input::get('members') as $member_id) {
            $matchThese = ['group_id' => Input::get('groupID'), 'user_id' => $member_id];
            DB::table('groups_users')->where($matchThese)->delete();
        }
        return redirect('groups/' . Input::get('groupID'));
    }

    public function deleteMembersInGroup(Request $request)
    {
        $group_member = GroupUser::find($request->id);
        $group_member->delete();
        return response()->json($group_member);
    }
}
