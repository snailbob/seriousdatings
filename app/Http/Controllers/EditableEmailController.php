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
    public function showForm()
    {
        return \View::make('admin.email_template.editable_email_template')->withStatus("");
    }

    public function saveTemplate(Request $request)
    {
        $errors = $this->validate($request, [
            'Name' => 'required|max:255',
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
}
