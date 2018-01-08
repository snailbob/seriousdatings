<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Slider;
use Input;

class NSlideManagementController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $slides = Slider::all();
        if ($slides === null) {
            $slides = null;
        }
        return \View::make('new_admin.slide.manage_slide')->withSlides($slides);
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return \View::make('new_admin.slide.add_slide');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //return 'form posted';
        $rules = array(
            'titlename' => 'required',
            'slidelink' => 'required',
            'description' => 'required',
            'uploadpicture' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails())
            return Redirect::to('new_admin/slide/create')
                            ->withInput()
                            ->witherrors($validator->messages());
        $filname = \Input::file('uploadpicture')->getClientOriginalName();
        $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
        \Input::file('uploadpicture')->move(base_path() . '/public/images/slider/', $filname);
        $slider = Slider::create(array(
                    'title' => \Input::get('titlename'),
                    'description' => \Input::get('description'),
                    'link' => \Input::get('slidelink'),
                    'image' => $filname
        ));
        return \Redirect::to('new_admin/slide');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_new($id) {
       
        $slide = Slider::find($id);
        return \View::make('new_admin.slide.edit_slide')->withSlide($slide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //return 'form posted';
        $rules = array(
            'titlename' => 'required',
            'slidelink' => 'required',
            'description' => 'required',
        );

        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails())
            return Redirect::to('new_admin/slide/' . $id . '/edit')
                            ->withInput()
                            ->witherrors($validator->messages());


        $slide = Slider::find($id);
        $slide->title = \Input::get('titlename');
        $slide->description = \Input::get('description');
        $slide->link = \Input::get('slidelink');

        if (Input::file('uploadpicture') != null) {
            $filname = \Input::file('uploadpicture')->getClientOriginalName();
            $imageName = \Input::file('uploadpicture')->getClientOriginalExtension();
            \Input::file('uploadpicture')->move(base_path() . '/public/images/slider/', $filname);
            $slide->image = $filname;
        }
        $slide->save();
        \Session::flash('message', 'Successfully updated slide!');
        return \Redirect::to('new_admin/slide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $slide = Slider::find($id);
        $slide->delete();
        // redirect
        \Session::flash('message', 'Successfully deleted the slide!');
        return \Redirect::to('new_admin/slide');
    }

}
