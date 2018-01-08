<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Template;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();
        if ($templates === null) {
            $templates = null;
		}
		//return $templates;
        return \View::make('admin.template.manage_template')->withTemplates($templates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return \View::make('admin.template.add_template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //return 'form posted';
        $rules = array(
                'template_name' => 'required',
                'template_subject'    => 'required',
                'template_content' => 'required'
                );
        
                $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return Redirect::to('admin/templates/create')
                    ->withInput()
                    ->witherrors($validator->messages());
                 $template= Template::create(array(
                    'template_name'       => \Input::get('template_name'),
                    'template_subject'    => \Input::get('template_subject'),
                    'template_content'    => \Input::get('template_content')
                ));
                return \Redirect::to('admin/templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);
        return \View::make('admin.template.view_template')->withTemplate($template);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::find($id);
        return \View::make('admin.template.edit_template')->withTemplate($template);
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
        //return 'form posted';
        $rules = array(
                'template_name' => 'required',
                'template_subject'    => 'required',
                'template_content' => 'required'
                );
				$validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return Redirect::to('admin/templates/create')
                    ->withInput()
                    ->witherrors($validator->messages());
                $template = Template::find($id);
                $template->template_name 	= \Input::get('template_name');
                $template->template_subject = \Input::get('template_subject');
                $template->template_content = \Input::get('template_content');
                $template->save();
                \Session::flash('message', 'Successfully updated template!');
                return \Redirect::to('admin/templates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);
        $template->delete();
        // redirect
        \Session::flash('message', 'Successfully deleted the template!');
        return \Redirect::to('admin/templates');
    }
	
	public function showContent($id){
		
		$template = Template::find($id);
        return \View::make('admin.template.content_template')->withTemplate($template);
	}
}
