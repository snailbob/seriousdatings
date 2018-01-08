<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Video;
use Redirect;
use Input;

class VideoManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        if ($videos === null) {
            $videos = null;
		}
		//return $videos;
         return \View::make('admin.video.manage_videos')->withVideos($videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//phpinfo();
        return \View::make('admin.video.add_videos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//dd($_FILES);

        $rules = array(
                

               'title' 		=> 'required',
				'link' 			=> 'required',
                'uploadpicture' => 'required',
				'description' 	=> 'required'
                
                );
        
                $validator = \Validator::make(\Input::all(),$rules);
				
				if($validator->fails())
					//dd($_FILES);
					//return $validator->messages();
					return \Redirect::to('admin/videos/create')
                    ->withInput()
                    ->witherrors($validator->messages());
				//$filename = "abc.mp4";
				$filname = \Input::file('uploadpicture')->getClientOriginalName();
                $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
                //dd($filname);
                \Input::file('uploadpicture')->move(base_path() . '/public/videos/', $filname);
				
				$video= Video::create(array(
                    'title'          => \Input::get('title'),
                    'link'          => \Input::get('link'),
                    'video'         => $filname,
					'description'         => \Input::get('description')
                    
                ));
                return \Redirect::to('admin/videos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $video = Video::find($id);
        //return \View::make('admin.video.show_videos')->withVideo($video);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        return \View::make('admin.video.edit_video')->withVideo($video);
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
                'title' 		=> 'required',
				'link' 			=> 'required',
               'description' 	=> 'required'
                
                );
        
                $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())

                    return \Redirect::to('admin/videos/create')
                    ->withInput()
                    ->witherrors($validator->messages());
               

                $video = Video::find($id);
                $video->title = \Input::get('title');
                $video->link = \Input::get('link');
                $video->description = \Input::get('description');
                
                if(Input::file('uploadpicture') != null)
                {
    				$filname = \Input::file('uploadpicture')->getClientOriginalName();
                    $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
                    \Input::file('uploadpicture')->move(base_path() . '/public/videos/', $filname);
                    $video->video = $filname;
                }

               $video->save();
                \Session::flash('message', 'Successfully updated!');
                return \Redirect::to('admin/videos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        $video->delete();
        // redirect
        \Session::flash('message', 'Successfully deleted!!');
        return \Redirect::to('admin/videos');
    }

    public function change_primary_video(Request $request){

        $id = $request->input('id');

        Video::where('id', 'not like', $id)->update(['featured' => 'N']);
        Video::where('id', $id)->update(['featured' => 'Y']);

        \Session::flash('success', 'Homepage video successfully updated.');
        return response()->json($request->input());
    }
}
