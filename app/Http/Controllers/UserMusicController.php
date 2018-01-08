<?php

namespace App\Http\Controllers;

use App\UserMusic;
use App\UserVideo;
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

class UserMusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $music = UserMusic::where('user_id', $current_user_id)->get();
        $data = array(
            'current_user' 	=> $current_user,
            'music'		=> $music
        );
        //dd($data);
        return View::make('user_music')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user = \Auth::user();
        $current_user_id = $current_user->id;
        $data = array(
            'current_user' 	=> $current_user
        );
        //dd($current_user);
        return View::make('user_music_create')->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        foreach($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file'=> $file), $rules);
            if($validator->passes()){
                $destinationPath = base_path() . '/public/images/users/'.$username.'/music';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $music= UserMusic::create(array(
                    'user_id'          =>   $current_user_id,
                    'music'            =>   $filename,
                    'title'             =>   Input::get('title')
                ));
                $uploadcount ++;
            }
        }
        if($uploadcount == $file_count){
            Session::flash('success', 'Upload successfully');
            return Redirect::to('profile/music');
        }
        else {
            return Redirect::to('profile/music')->withInput()->withErrors($validator);
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
    public function destroy($id)
    {
        //
    }
}
