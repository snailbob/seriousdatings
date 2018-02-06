<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GroupUser;
use App\Group;
use App\User;
use Auth;
use DB;
use Redirect;
use Input;
use View;


class GroupManagementController extends Controller
{
    public function showGroupList()
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

        return \View::make('admin.group_management.group_list')->with(['groups' => $groups, 'data' => $data, 'created' => $creator]);
    }

    public function createGroup()
    {
            $user_id = Auth::user()->id;
            return \View::make('admin.group_management.admin_create_group')->withData($user_id);
    }

    public function showGroupMembers($id)
    {
        // check first if the group has already members
        $check = DB::table('groups_users')
            ->where('group_id', $id)
            ->count();
        $group = Group::find($id);

        $members = DB::table('groups_users')
            ->join('users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups_users.group_id', '=', 'groups.id')
            ->select('groups_users.block', 'groups.name', 'groups.id as groupId', 'users.id', 'users.firstName', 'users.lastName', 'users.email', 'users.verified', 'users.username', 'users.photo')
            ->where('users.deleted_at', NULL)
            ->where('groups_users.group_id', $id)
            ->get();

        return \View::make('admin.group_management.view_group')->with(['members' => $members, 'group' => $group]);
    }

    public function nonMemberLists($id)
    {
        $group = Group::find($id);
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

        return \View::make('admin.group_management.add_members')->with(['members' => $members, 'non_members' => $non_members_id, 'users' => $users, 'group' => $group]);
    }

    public function addGroupName(Request $request)
    {

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

            return redirect('admin/group_management/group_lists');

    }

    public function editGroupName(Request $request)
    {
        $errors = $this->validate($request, [
            'name' => 'required|max:255|unique:groups,name',
        ]);

        Group::where('id', $request->id)
            ->update(['name' => $request->name]);

        $group = Group::find($request->id);
        return response()->json($group);
    }

    public function deleteGroupName(Request $request)
    {
        $group = Group::find($request->id);

        $group->delete();

        return response()->json($group);
    }

    public function blockGroupName(Request $request)
    {
        $group = Group::find($request->id);
        $group->block = ($group->block) ? 0 : 1;
        $group->save();
        $group['text'] = ($group->block) ? "Unblock" : "Block";
        $group['message'] = ($group->block) ? "blocked." : "unblocked.";
        return response()->json($group);
    }

    public function blockMemberInGroup(Request $request)
    {
        $errors = $this->validate($request, [
            'groupName' => 'required|max:255|exists:groups,name',
        ]);

        $group = Group::where('name', $request->groupName)->first();

        DB::table('groups_users')
            ->where('group_id', $group->id)
            ->where('user_id', $request->userId)
            ->update(['block' => $request->action]);

        $users = DB::table('groups_users')
            ->join('users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups_users.group_id', '=', 'groups.id')
            ->select('groups_users.block', 'groups.name', 'groups.id as groupId', 'users.id', 'users.firstName', 'users.lastName', 'users.email', 'users.verified', 'users.username', 'users.photo')
            ->where('groups_users.group_id', $group->id)
            ->where('groups_users.user_id', $request->userId)
            ->first();

        $data['users'] = $users;
        $data['attr']['classname'] = ($users->block) ? 'unBlockBtn' : 'blockBtn';
        $data['attr']['notif'] = ($users->block) ? 'blocked.' : 'unblocked.';
        $data['attr']['text'] = ($users->block) ? 'Unblock' : 'Block';
        $data['attr']['table'] = ($users->block) ? 'user_block_list_tbl' : 'user_list_tbl';

        return response()->json($data);
    }

    public function addMembersInGroup(Request $request)
    {
        $errors = $this->validate($request, [
            'groupName' => 'required|max:255|exists:groups,name',
        ]);

        $group = Group::where('name', $request->groupName)->first();

        GroupUser::create([
            'user_id' => $request->id,
            'group_id' => $group->id,
            'role_id' => 3,
            'block' => 0,
            'isJoin' => 1
        ]);

        $member = User::find($request->id);
        $data['users'] = $member;
        $data['attr']['classname'] = 'blockBtn';
        $data['attr']['notif'] = "";
        $data['attr']['text'] = 'Block';
        $data['attr']['table'] = 'user_list_tbl';
        return response()->json($data);
    }
}
