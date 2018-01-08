<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Mail;
class ServerController extends Controller
{
 
	
	public function getIndex()
    {
    	\SSH::into('production')->run(array(
	    'cd /home/seriousdatings/seriousdatings_app/',
		'git pull origin master'
	    
		), function($line){
	
				echo $line.PHP_EOL; // outputs server feedback
			});
    	//return "Mail Sent !!";
	
    }
    
   	
    
 }
 