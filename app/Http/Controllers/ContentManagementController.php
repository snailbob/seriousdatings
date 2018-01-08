<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pages;
class ContentManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::all();
        if ($pages === null) {
            $pages = null;
		}
		//return $pages;
        return \View::make('admin.pages.manage_pages')->withPages($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('admin.pages.add_pages');
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
                'title' 			=> 'required',
				'meta_tag' 			=> 'required',
                'description'    	=> 'required'
                );
        $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return Redirect::to('admin/pages/create')
                    ->withInput()
                    ->witherrors($validator->messages());
                 $page= Pages::create(array(
                    'title'          => \Input::get('title'),
                    'meta_tag'         => \Input::get('meta_tag'),
                    'description'   => \Input::get('description')
                ));
                return \Redirect::to('admin/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $page = Pages::find($id);
        //return \View::make('admin.view_page')->withPage($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Pages::find($id);
        return \View::make('admin.pages.edit_pages')->withPage($page);
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
                'title' 			=> 'required',
				'meta_tag' 			=> 'required',
                'description'    	=> 'required'
                );
        $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return Redirect::to('admin/pages/create')
                    ->withInput()
                    ->witherrors($validator->messages());
					
				$page = Pages::find($id);
                $page->title = \Input::get('title');
				$page->meta_tag = \Input::get('meta_tag');
				$page->description = \Input::get('description');
                $page->save();
                \Session::flash('message', 'Successfully updated!');
                return \Redirect::to('admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Pages::find($id);
        $page->delete();
        // redirect
        \Session::flash('message', 'Successfully deleted!!');
        return \Redirect::to('admin/pages');
    }
}
