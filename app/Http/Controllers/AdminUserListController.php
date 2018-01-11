<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;


class AdminUserListController extends Controller
{
    public function blockUser(Request $request)
    { 
        $user = User::where('email', $request->email)->first();
        $user->admin_blocked = ($user->admin_blocked) ? 0 : 1 ;
        $user->save();
        $user['anchorClass'] = "blockTxt";
        $user['listClass'] = "blockBtn";
        $user['icon'] = "fa-user-times";
        $user['text'] = ($user->admin_blocked) ? "Unblock" : "Block";
        $user['message'] = "{$user->firstName} {$user->lastName} was ";
        $user['message'] .= ($user->admin_blocked) ? "blocked." : "unblocked.";
        
        return response()->json($user);
    }

    public function pauseUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->admin_pause = ($user->admin_pause) ? 0 : 1 ;
        $user->save();
        $user['anchorClass'] = "pauseTxt";
        $user['listClass'] = "pauseBtn";
        $user['icon'] = "fa-pause-circle";
        $user['text'] = ($user->admin_pause) ? "Unpause" : "Pause";
        $user['message'] = "{$user->firstName} {$user->lastName} was ";
        $user['message'] .= ($user->admin_pause) ? "paused." : "unpaused.";
        return response()->json($user);
    }

    public function deleteUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->delete();
        $user['message'] = "{$user->firstName} {$user->lastName} was deleted.";
        return response()->json($user);
    }


}
