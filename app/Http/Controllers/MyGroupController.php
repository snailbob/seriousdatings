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
use App\GroupMemberPost;
use App\UserBlog;

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
        $created_by = User::find($group_details->created_by_id);

        $posts = array();
        $data = GroupMemberPost::where('group_id', $id)->orderBy('id', 'desc')->get();
        $data->load('user', 'postType', 'group');

        foreach ($data->toArray() as $key => $value)
        {
            $posts[$key] = $value;
            $posts[$key]['created_at'] = UserBlog::time_elapsed_string($value['created_at']);
        }

        $request_users = array();
        $members_id = array();
        foreach ($group as $group_mem) {
            if (!$group_mem->isJoin) {
                $request_users[] = $group_mem->user_id;
                continue;
            }
            $members_id[] = $group_mem->user_id;
        }
        return View::make('groupMembers')->with(['group' => $group, 'created' => $created_by, 'group_details' => $group_details, 'members' => $members_id, 'request' => $request_users, 'posts' => $posts]);
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

    public function userGroupRequest($id)
    {
        $requests = GroupUser::where(['group_id' => $id, 'isJoin' => 0])->get();
        $requests->load('user', 'group');
        $group = Group::find($id);

        if ($group->created_by_id == Auth::id()) {
            if (count($requests)) {
                return View::make('group_user_request')->with(['requests' => $requests, 'group' => $group]);
            }
        }
        return redirect('groups/' . $id);
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

    public function userJoinRequest(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:groups_users,group_id',
        ]);

        $requested = GroupUser::create([
            'user_id' => Auth::id(),
            'group_id' => $request->id,
            'role_id' => 3,
            'block' => 0,
            'isJoin' => 0
        ]);

        return \response()->json($requested);
    }

    public function cancelJoinRequest(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:groups_users,group_id',
        ]);

        $requested = GroupUser::where(['user_id' => Auth::id(), 'group_id' => $request->id])->first();
        $requested->delete();

        return \response()->json($requested);
    }

    public function userLeaveGroup(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:groups_users,group_id',
        ]);

        $requested = GroupUser::where(['user_id' => Auth::id(), 'group_id' => $request->id])->first();
        $requested->delete();

        return \response()->json($requested);
    }

    public function rejectUserRequest(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|unique:groups_users,id',
        ]);

        $requested = GroupUser::find($request->id);
        $requested->delete();
        return \response()->json($requested);
    }

    public function acceptUserRequest(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|unique:groups_users,id',
            'group_id' => 'required|exists:group_users,group_id',
            'email' => 'required|exists:users,email',
        ]);

        $user = User::where(['email' => $request->email])->first();

        GroupUser::where('id', $request->id)
            ->update([
                'user_id' => $user->id,
                'group_id' => $request->group_id,
                'role_id' => 3,
                'block' => 0,
                'isJoin' => 1
            ]);

        $requested = GroupUser::find($request->id);

        return \response()->json($requested);
    }

    public function groupMemberPostImg(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => 'required',
        ]);

        $group = Group::where('name', $request->groupName)->first();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filname = $file->getClientOriginalName();
            $file->move(base_path() . '/public/images/group_post/' . $group->id . '/', $filname);

            $post = GroupMemberPost::create([
                'group_id' => $group->id,
                'user_id' => Auth::id(),
                'type_post_id' => $request->type_id,
                'post' => $filname
            ]);

            return response()->json($filname);
        }
    }

    public function groupMemberPostTxt(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'post' => 'required|max:1000',
            'type_id' => 'required|exists:group_type_post,id',
            'group_name' => 'required|exists:groups,name'
        ]);

        $group = Group::where('name', $request->group_name)->first();

        $post = GroupMemberPost::create([
            'group_id' => $group->id,
            'user_id' => Auth::id(),
            'type_post_id' => $request->type_id,
            'post' => $request->post
        ]);

        return response()->json($post);
    }

    public function groupMemberPostVideo(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'link' => 'required|url',
            'type_id' => 'required|exists:group_type_post,id',
            'group_name' => 'required|exists:groups,name'
        ]);
        if (strpos($request->link, 'youtube.com') ) {
            $link=  preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                "//www.youtube.com/embed/$1", $request->link);
            $group = Group::where('name', $request->group_name)->first();

            $post = GroupMemberPost::create([
                'group_id' => $group->id,
                'user_id' => Auth::id(),
                'type_post_id' => $request->type_id,
                'post' => $link
            ]);
            return response()->json($post);
        } else {
            $data['status'] = 'invalid';
            $data['message'] = ['It\'s not a youtube link'];
            return response()->json($data);
        }
    }

}
