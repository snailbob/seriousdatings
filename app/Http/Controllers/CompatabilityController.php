<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Compatability;
use Auth;
use Redirect;

class CompatabilityController extends Controller
{
 
	
    public function getCompatibles($id)
    {
        // if (Auth::check()) {
        //     if(Auth::user()->verified == 0){
        //         // return redirect('/verifyPlease');
        //         return \Redirect::to('/verifyPlease');
        //     }
        // }
        if(Auth::check()){
    	// First Generating List
    	$compat = new Compatability();
    	$result = $compat->generateCompatibles($id);
        if($result == 0){

            return redirect(url().'/users/'.$id.'/about_your_date');
        }
    	// Getting List Of Compatibles From Model Class and Passing To View
    	$result = $compat->showCompatability($id);
    	 
    	//dd($result);
    	
    
         
        return \View::make('compatability_slider')->with("data",$result);
        }
        else{
            return redirect(url());
        }

        
    }
    
    
    	
 }
 