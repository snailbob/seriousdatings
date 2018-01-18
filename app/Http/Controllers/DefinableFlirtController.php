<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EditableEmailController as EditEmail;
use App\DefinableFlirt;

class DefinableFlirtController extends Controller
{

    public function showFlirtMessageLists()
    {
        $messages = DefinableFlirt::all();
        foreach ($messages as $key => $value) 
        {
            $messages[$key]['ellipse'] = EditEmail::setContentToEllipse($value->content);
        }
        return \View::make('admin.definable_flirt.flirt_message_list')->with('messages', $messages );
    }

    public function showFlirtMessageForm()
    {
        return \View::make('admin.definable_flirt.add_flirt_message')->withStatus("");   
    }

    public function saveFlirtMessage(Request $request)
    {
        $errors = $this->validate($request, [
            'flirtName' => 'required|max:255',
            'Content' => 'required'
        ]);

        $message = DefinableFlirt::create([
            'name' => $request->flirtName,
            'content' => $request->Content,
        ]);       
        return response()->json($message);
    }

    public function getFlirtMessage(Request $request)
    {
        $message = DefinableFlirt::find($request->id);
        return response()->json($message);
    }

    public function updateFlirtMessage(Request $request)
    {
        $errors = $this->validate($request, [
            'Name' => 'required|max:255',
            'Content' => 'required'
        ]);      

        DefinableFlirt::where('id', $request->id)
        ->update([
            'name' => trim($request->Name),
            'content' => $request->Content
        ]);

        /* returning the updated data */ 
        $message = DefinableFlirt::find($request->id);
        $message['ellipse'] = EditEmail::setContentToEllipse($message->content);


        return response()->json($message);
    }

    public function deleteFlirtMessage(Request $request)
    {
        $message = DefinableFlirt::find($request->id);

        $message->delete();

        return response()->json($message);
    }
}
