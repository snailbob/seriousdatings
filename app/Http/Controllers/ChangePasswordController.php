<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showForm()
    {
		return \View::make('admin.change_password.change_password')->withStatus("");
	}
	
	
	public function updatePassword()
    {
		$status = "";
		
		$rules = array(
                'oldPassword' 			=> 'required',
				'newPassword' 			=> 'required',
                'confirmPassword'    		=> 'required|same:newPassword'
                );
        $validator = \Validator::make(\Input::all(),$rules);
                if($validator->fails())
                    return \Redirect::to('admin/change_password')->withErrors($validator);
                if (Auth::check())
				{
					$id = Auth::user()->id;
					$currentuser = User::find($id);
					if(Hash::check(\Input::get('oldPassword'),$currentuser->password))
						{
								$currentuser->password = \Hash::make(\Input::get('newPassword'));
								$currentuser->save();
								$status = "Password changed successfully";
								
						}
						else
						{
								$status = "Please enter your correct current password";
						}
					
				}
				//$user = User::find($id);
                
				
                \Session::flash('message', 'Successfully updated!');
                return \View::make('admin.change_password.change_password')->withStatus($status);
    }
    
    public function showCalendar() { 
        echo 'fsdfd';
        die;
        return \View::make('admin.calendar.calendar');
    }


}