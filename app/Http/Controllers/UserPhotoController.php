<?php

namespace App\Http\Controllers;

use App\UserPhoto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

class UserPhotoController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->verified == 0) {
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }
        //
        $current_user = \Auth::user();
        $current_user_id = $current_user->id;
        //dd($current_user_id);
        $photos = UserPhoto::where('user_id', $current_user_id)->get();
        $data = array(
            'current_user' => $current_user,
            'photos' => $photos
        );
        //dd($current_user);
        return View::make('user_photo')->withData($data);
    }

    public function create()
    {
        $current_user = \Auth::user();
        $current_user_id = $current_user->id;
        //dd($current_user_id);
        $photos = UserPhoto::where('user_id', $current_user_id)->get();
        $data = array(
            'current_user' => $current_user,
            'photos' => $photos
        );
        return View::make('user_photo_create')->withData($data);
    }

    public function store(Request $request)
    {
        $current_user = \Auth::user();
        $current_user_id = $current_user->id;
        $username = $current_user->username;

        $files = Input::file('images');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = base_path() . '/public/images/users/' . $username . '/pictures';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $pictures = UserPhoto::create(array(
                    'user_id' => $current_user_id,
                    'image' => $filename
                ));
                $uploadcount++;
            }
        }
        if ($uploadcount == $file_count) {
            Session::flash('success', 'Upload successfully');
            return Redirect::to('profile/photo');
        } else {
            return Redirect::to('profile/photo')->withInput()->withErrors($validator);
        }

    }

    public function getPhotoList()
    {
        $pictures = UserPhoto::all();
        $pictures->load('user');
        return \View::make('admin.user_content_management.picture_list')->with('pictures', $pictures);
    }

    public function rejectUserPhoto(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:user_pictures,id',
            'status' => 'required'
        ]);

        UserPhoto::where('id', $request->id)
            ->update(['status' => $request->status]);

        $picture = UserPhoto::find($request->id);

        return response()->json($picture);
    }

    public function approveUserPhoto(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:user_pictures,id',
            'status' => 'required'
        ]);

        UserPhoto::where('id', $request->id)
            ->update(['status' => $request->status]);

        $picture = UserPhoto::find($request->id);

        return response()->json($picture);
    }

    public function deleteUserPhoto(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:user_pictures,id'
        ]);

        $request_photo = UserPhoto::find($request->id);
        $request_photo->delete();
        return response()->json($request_photo);
    }
}
