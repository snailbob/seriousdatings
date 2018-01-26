<?php

namespace App\Http\Controllers;

use App\UserVideo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
class UserVideoController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }
        $current_user = \Auth::user();
        $current_user_id = $current_user->id;
        //dd($current_user_id);
        $videos = UserVideo::where('user_id', $current_user_id)->get();
        $data = array(
            'current_user' 	=> $current_user,
            'videos'		=> $videos
        );
        //dd($current_user);
        return View::make('user_video')->withData($data);
    }

    public function create()
    {

        $current_user = \Auth::user();
        $current_user_id = $current_user->id;
        $data = array(
            'current_user' 	=> $current_user
        );
        //dd($current_user);
        return View::make('user_video_create')->withData($data);
    }

    public function store(Request $request)
    {
        $current_user = \Auth::user();
        $current_user_id = $current_user->id;
        $username = $current_user->username;
        $type = Input::get('video_type');
        if($type == 1){


            $video= UserVideo::create(array(
                'user_id'          =>   $current_user_id,
                'link'            =>    Input::get('link'),
                'type'             =>   $type
            ));
            Session::flash('success', 'Upload successfully');
            return Redirect::to('profile/video');

        }
        else if($type ==0){


             $files = Input::file('images');
            // Making counting of uploaded images
            $file_count = count($files);
            // start count how many uploaded
            $uploadcount = 0;
            foreach($files as $file) {
                $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                $validator = Validator::make(array('file'=> $file), $rules);
                if($validator->passes()){
                    $destinationPath = base_path() . '/public/images/users/'.$username.'/videos';
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);
                    $video= UserVideo::create(array(
                        'user_id'          =>   $current_user_id,
                        'video'            =>   $filename,
                        'type'             =>   $type
                    ));
                    $uploadcount ++;
                }
            }
            if($uploadcount == $file_count){
                Session::flash('success', 'Upload successfully');
                return Redirect::to('profile/video');
            }
            else {
                return Redirect::to('profile/video')->withInput()->withErrors($validator);
            }
        }
        else{

        }
    }

    public function getVideoList()
    {
        $videos = UserVideo::all();
        $videos->load('user');
        return \View::make('admin.user_content_management.video_list')->with('videos', $videos);
    }

    public function rejectUserVideo(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:user_videos,id',
            'status' => 'required'
        ]);

        UserVideo::where('id', $request->id)
            ->update(['status' => $request->status]);

        $video = UserVideo::find($request->id);

        return response()->json($video);
    }

    public function approveUserVideo(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:user_videos,id',
            'status' => 'required'
        ]);

        UserVideo::where('id', $request->id)
            ->update(['status' => $request->status]);

        $video = UserVideo::find($request->id);

        return response()->json($video);
    }

    public function deleteUserVideo(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:user_videos,id'
        ]);

        $request_video = UserVideo::find($request->id);
        $request_video->delete();
        return response()->json($request_video);
    }

}
