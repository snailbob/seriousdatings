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
use App\UserBlog;
use App\User;
use Mail;

class EditableEmailController extends Controller
{
    public function showAddForm()
    {
        return \View::make('admin.email_template.add_email_template')->withStatus("");
    }

    public function showTemplateLists()
    {
        $templates = Template::all();
        $users = User::all();
        foreach ($templates as $key => $value) {
            $templates[$key]['ellipse'] = self::setContentToEllipse($value->template_content);
        }

        return \View::make('admin.email_template.template_lists')->with(['templates' => $templates, 'users' => $users]);
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

        if (strtolower($template->template_name) != trim(strtolower($request->Name))) {
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

    public static function setContentToEllipse($text)
    {
        $text = str_replace("\r\n", '', UserBlog::convertApostrophe(strip_tags($text)));
        $intro_str = substr($text, 0, 150) . "...";
        return $intro_str;
    }

    public function userListForTemplate($id)
    {
        $users = User::all();
        $template = Template::find($id);
        return \View::make('admin.email_template.send_template')->with(['template' => $template, 'users' => $users]);
    }

    public function sendTemplateToUsers(Request $request)
    {
        $errors = $this->validate($request, [
            'template' => 'required',
            'users' => 'required'
        ]);


        $template = Template::where('template_name', $request->template)->first();

        foreach ($request->users as $key => $value) {
            $user = User::find($value);
            Mail::send('email.email_blast_template', ['user' => $user, 'title' => $template['template_subject'], 'content' => $template['template_content']], function ($message) use ($user, $template) {
                $message->to($user->email, 'ID')->subject($template['template_subject']);
            });
        }

        return response()->json(['message' => 'Template sent.']);
    }

    public function extractEmails()
    {
        $users = User::all();
        return \View::make('email.extract_email')->with(['users' => $users]);
    }
}
