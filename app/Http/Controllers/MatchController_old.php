<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
use Redirect;
use Input;
use View;
use App\User;

class MatchController extends Controller
{
	public function __construct(){
		if (Auth::check()) {

			if(Auth::user()->verified == 1){
				// dd(Auth::user()->verified);
				// dd(\Redirect::to('/verifyPlease'));
				// dd(url().'/verifyPlease');

				// return redirect()->route('verifyPlease');
				// return redirect()->action('VerifyController@getVarifyPlease');
				// return redirect(url().'/verifyPlease');
				// return \Redirect::to('/verifyPlease');
				// return \Redirect::to('users/'.(Auth::user()->id).'/verify/'.(Auth::user()->verify_key));
			}
		}
	}

	/**
	 * @return mixed
	 * TODO: Retouch Exeptions/Handler.php for not to show errors
	 */
	
    public function getIndex()
    {
    	if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }	
		//$just_registered = \DB::table('users')->get();
		$just_registered = User::orderBy('id', 'desc')->take(10)->get();
    	$online = \DB::table('user_online') ->leftJoin('users', 'users.id', '=', 'user_online.user_id')->get();
    	 
    	$count = 0;
	    foreach ($online as $on){
	    	$count = $count++;
	    	$on->online = 0;
	    	if($count ==  0){
	    		$on->count = 1;
	    	}
	    	else if($count < 6){
	    		$on->count = 0;
	    	}
	    	else if($count == 6){
	    		$on->count = 2;
	    		$count = 0;
	    	}
	    	if(strlen($on->time) > 0){
	    		$on->online = 1;
	    	}
	    		
	    	
	    }
	    
	    $video = DB::table('videos')->first();
		

	    $giftCards = DB::table('gift_cards')->get();


	    $slides = DB::table('slider')->get();
	    
	    //dd($giftCards);
	    $events = DB::table('events')->select(\DB::raw("*,DATE_FORMAT(start,'%d') AS single_date,DATE_FORMAT(endDate,'%b') AS single_month,DATE_FORMAT(start,'%d-%m-%Y') AS fromDate,DATE_FORMAT(endDate,'%d-%m-%Y') AS toDate"))
	    ->orderBy('start', 'desc')->take(2)->get();

		/**
		 * Search for the localization of the visiting user based in their IP
		 *
		 */
		$ip = $_SERVER['REMOTE_ADDR'];
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
		if($details != null ) {
			
			/*// check if postal code is there in the return object. If not, get it from fallback api
			if(!property_exists($details, "postal"))
				$details->postal = $this->get_postal_by_fallback($details->loc);
			// end fall back IP check 
			$zipcode = $details -> postal;
			$location = explode(",", $details -> loc);
			$lati = $location['0'];
			$longi = $location['1'];
			$city = $details -> city;
			$location = $details -> city.", ".$details -> region.", ".$details -> country.", ".$details -> postal;*/
			
			// Need to remove and enable above comment on live
			$zipcode = 0;
			$lati = 0;
			$longi = 0;
			$city = "";
			$location = "";

		}
		else{
			$zipcode = 0;
			$lati = 0;
			$longi = 0;
			$location = "";
		}

		$countAllUser = User::where("zipcode",$zipcode)->count();

		$countAllUser = ($countAllUser == 0)?1:$countAllUser;

		$countAllWomeninArea = User::whereRaw("zipcode = $zipcode AND gender = 'Female'")->count();

		$countAllMeninArea = User::whereRaw("zipcode = $zipcode AND gender = 'Male'")->count();

		$womenPercent = round(($countAllWomeninArea * 100)/$countAllUser);

		$menPercent = round(($countAllMeninArea * 100)/$countAllUser);


		
	   // / dd($video);
		return View::make('match')->with(array("just_registered" => $just_registered, "online" => $online, "events" => $events,"video" => $video,'giftCards' => $giftCards,'slides' => $slides, 'zipcode' => $zipcode, 'city' => $city, 'womenPercent' => $womenPercent, 'menPercent' => $menPercent));

	}
	public function get_postal_by_fallback($latlng)
	{
		$postal = '';
		$fallback = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$latlng."&sensor=false"));
		$result = $fallback->results[0]->address_components;
		foreach($result as $item)
		{
			$types = $item->types;
			foreach($types as $type)
			{
				if($type == 'postal_code')
				{
					$postal = $item->long_name;
				}
			}
		}
		return $postal;
	}

    public function getLogin(){
    	
    	if(Auth::check()){
			
			return Redirect::intended(url());
		}	
		else{
			return \View::make('login')->withData("");
		}
    }
    
    public function postLogin(){
    	
    	$remember = (Input::has('check')) ? true : false;
    	
    	$cred = array(
    			
    			'username' => Input::get('username'),
    			'password' => Input::get('password')
    	);
        //dd($cred);
		if(\Auth::attempt($cred,$remember)){
			 $user_id = Auth::user() -> id;
			 $date_time = date("Y-m-d h:i:sa");
			 $userOnline = DB::table('user_online')->where('user_id', '=', $user_id)->first();
			 if($userOnline == null){
    		 	DB::table('user_online')->insert(
				    ['user_id' => $user_id,'time' => $date_time]
				);
			 }
			$id = DB::table('role_user')->where('user_id','=',$user_id)->first();
//dd($id);
		 	if($id -> role_id == 2){
		  		return redirect(url().'/admin');
		  	}
		  	else{
				return redirect(url().'/profile');
				//return Redirect::intended('/');
			}

			 	
    	}
    	else{
    		return \View::make('login')->withData("Username or Password do not match");
    	}
		
    	//$creds = array('username' => 'hasan' , 'password' => 'abc');
    	//\Auth::attempt($creds);
    	//Redirect::to('users');
		
    	 
    }
    
    public function getLogout(){
    	if(Auth::check()){
    	$user_id = Auth::user() -> id;
    	Auth::logout();
    	DB::table('user_online')->where('user_id', '=', $user_id)->delete();
    	//dd("logged out");
        }
    	return Redirect::to('/');
    }

	public function paginateUser(){
		$allUsers = User::select('username','photo')->orderBy('id', 'desc')->simplePaginate(10);
		return Response::json(['status' => 'success','user' => $allUsers->toJson()]);

	}
    
   
    
}
