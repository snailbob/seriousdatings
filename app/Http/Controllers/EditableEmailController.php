<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Template;

class EditableEmailController extends Controller
{
    public function showAddForm()
    {
        return \View::make('admin.email_template.add_email_template')->withStatus("");
    }

    public function showTemplateLists()
    {
        $templates = Template::all();
        foreach ($templates as $key => $value) 
        {
            $templates[$key]['ellipse'] = self::setContentToEllipse($value->template_content);
        }

        return \View::make('admin.email_template.template_lists')->with('templates', $templates );
    }

    public function saveTemplate(Request $request)
    {
        $errors = $this->validate($request, [
            'Name' => 'required|max:255|unique:templates,template_name,NULL,id,deleted_at,NULL',
            'Subject' => 'required|max:255',
            'Content' => 'required'
        ]);

        $template = Template::create([
            'template_name' => $request->Name,
            'template_subject' => $request->Subject,
            'template_content' => $request->Content
        ]);       
        return response()->json($template);
    }

    public function getTemplateById(Request $request)
    {
        $template = Template::find($request->id);
        return response()->json($template);
    }

    public function updateTemplate(Request $request)
    {
        /* Validation Process Befor Updating */ 
        $errors = $this->validate($request, [
            'Name' => 'required|max:255',
            'Subject' => 'required|max:255',
            'Content' => 'required'
        ]);

        $template = Template::find($request->id);

        if(strtolower($template->template_name) != trim(strtolower($request->Name)))
        {
            $this->validate($request, [
                'Name' => 'unique:templates,template_name'
            ]);
        }
        /* End of Validation Process Befor Updating */

        Template::where('id', $request->id)
        ->update([
            'template_name' => trim($request->Name),
            'template_subject' => trim($request->Subject),
            'template_content' => $request->Content
        ]);

        /* returning the updated data */ 
        $template = Template::find($request->id);
        $template['ellipse'] = self::setContentToEllipse($template->template_content);


        return response()->json($template);
    }

    public function deleteTemplate(Request $request)
    {
        $template = Template::find($request->id);

        $template->delete();

        return response()->json($template);
    }

    static function setContentToEllipse($text)
    {
        $partialEndTag = strpos($text, "</");
        $offsetEndTag = strpos($text, ">", $partialEndTag);
        $ellipseMessage = substr($text, 0, $offsetEndTag);
        return $ellipseMessage;
    }  

    public function send(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('me@gmail.com', 'Christian Nwamba');

            $message->to('chrisn@scotch.io');

        });

        return response()->json(['message' => 'Request completed']);
    }

}
