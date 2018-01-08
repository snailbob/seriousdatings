<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Banner;
class BannerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $banners = Banner::all();
        if ($banners === null) {
            $banners = null;
		}
		return $banners;
        // return \View::make('admin.manage_banners')->withBanners($banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //return \View::make('admin.add_banners');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules = array(
                'title' 		=> 'required',
				'sub_title' 	=> 'required',
				'link' 			=> 'required',
                'uploadpicture' => 'required'
				);
        
                $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return Redirect::to('admin/banners/create')
                    ->withInput()
                    ->witherrors($validator->messages());
                $filname = \Input::file('uploadpicture')->getClientOriginalName();
                $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
                \Input::file('uploadpicture')->move(base_path() . '/public/images/banners/', $filname);
                 $banner= Banner::create(array(
                    'title'       => \Input::get('title'),
					'sub_title'   => \Input::get('sub_title'),
                    'link'        => \Input::get('link'),
                    'image'       => $filname
				));
                return \Redirect::to('admin/banners');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $banner = Banner::find($id);
        //return \View::make('admin.view_banner')->withBanner($banner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $banner = Banner::find($id);
        //return \View::make('admin.edit_banner')->withBanner($banner);
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
				'sub_title' 	=> 'required',
				'link' 			=> 'required',
                'uploadpicture' => 'required'
				);
        
                $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return Redirect::to('admin/banners/create')
                    ->withInput()
                    ->witherrors($validator->messages());
                $filname = \Input::file('uploadpicture')->getClientOriginalName();
                $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
                \Input::file('uploadpicture')->move(base_path() . '/public/images/banners/', $filname);
        $banner = Banner::find($id);
                $banner->title = \Input::get('title');
				$banner->sub_title = \Input::get('sub_title');
				$banner->link = \Input::get('link');
				$banner->image = $filname;
				$banner->save();
                \Session::flash('message', 'Successfully updated!');
                return \Redirect::to('admin/banners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        // redirect
        \Session::flash('message', 'Successfully deleted!!');
        return \Redirect::to('admin/banners');
    }
}
