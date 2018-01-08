<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
use Redirect;
use Input;
use View;
use App\User;

class HomeController extends Controller {

    public function __construct() {
        if (Auth::check()) {

            if (Auth::user()->verified == 1) {
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
    public function getIndex(Request $request) {
        $video_id = $request->input('video');
        if(empty($video_id)){
            if (Auth::check()) {
                if (Auth::user()->verified == 0) {
                    // return redirect('/verifyPlease');
                    return \Redirect::to('/verifyPlease');
                }
                else{
                    return Redirect::to('/profile');
                }
            }
        }

        //$just_registered = \DB::table('users')->get();
        $just_registered = User::orderBy('id', 'desc')->take(10)->get();
        $online = \DB::table('user_online')->leftJoin('users', 'users.id', '=', 'user_online.user_id')->get();

        $count = 0;
        foreach ($online as $on) {
            $count = $count++;
            $on->online = 0;
            if ($count == 0) {
                $on->count = 1;
            } else if ($count < 6) {
                $on->count = 0;
            } else if ($count == 6) {
                $on->count = 2;
                $count = 0;
            }
            if (strlen($on->time) > 0) {
                $on->online = 1;
            }
        }

        if(!empty($video_id)){
            $video = DB::table('videos')->find($video_id);
        }

        if(empty($video)){
            $video = DB::table('videos')->where('featured','Y')->first();
        }
        

        $giftCards = DB::table('gift_cards')->get();

        $slides = DB::table('slider')->get();

        //dd($giftCards);
        $events = DB::table('events')->select(\DB::raw("*,DATE_FORMAT(start,'%d') AS single_date,DATE_FORMAT(endDate,'%b') AS single_month,DATE_FORMAT(start,'%d-%m-%Y') AS fromDate,DATE_FORMAT(endDate,'%d-%m-%Y') AS toDate"))
                        ->orderBy('start', 'desc')->take(2)->get();

        $coords = $this->getCoords();


        $lati = ($coords) ? $coords->location->lat : 0;
        $longi = ($coords) ? $coords->location->lng : 0;

        $latlng = $lati.','.$longi;
        $get_postal = $this->get_postal_by_fallback($latlng);

        $zipcode = (isset($get_postal['zipcode'])) ? $get_postal['zipcode'] : 0;
        $location = (isset($get_postal['location'])) ? $get_postal['location'] : '';
        $city = (isset($get_postal['city'])) ? $get_postal['city'] : '';
        
        $countAllUser = User::where("zipcode", $zipcode)->count();

        $countAllUser = ($countAllUser == 0) ? 1 : $countAllUser;

        $countAllWomeninArea = User::whereRaw("zipcode = $zipcode AND gender = 'Female'")->count();

        $countAllMeninArea = User::whereRaw("zipcode = $zipcode AND gender = 'Male'")->count();

        $womenPercent = round(($countAllWomeninArea * 100) / $countAllUser);

        $menPercent = round(($countAllMeninArea * 100) / $countAllUser);

        $arr = array(
            "just_registered"=>$just_registered,
            "online"=>$online,
            "events"=>$events,
            "video"=>$video,
            'giftCards'=>$giftCards,
            'slides'=>$slides,
            'zipcode'=>$zipcode,
            'lati'=>$lati,
            'longi'=>$longi,
            'location'=>$location,
            'city'=>$city,
            'womenPercent'=>$womenPercent,
            'menPercent'=>$menPercent
        );

        // return response()->json($arr);
        // dd($curl);
        return View::make('homepage')->with($arr);
    }

    public function getCoords(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyBf17ITcVaR6HzO5y1U9tqdggecnTKut6Y",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([]),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        $data = ($err) ? null : json_decode($response);

        return $data;
    }

    public function get_signup_location(){
        
        $coords = $this->getCoords();

        $lati = ($coords) ? $coords->location->lat : 0;
        $longi = ($coords) ? $coords->location->lng : 0;

        $latlng = $lati.','.$longi;
        $get_postal = $this->get_postal_by_fallback($latlng);

        $zipcode = (isset($get_postal['zipcode'])) ? $get_postal['zipcode'] : 0;
        $location = (isset($get_postal['location'])) ? $get_postal['location'] : '';
        $city = (isset($get_postal['city'])) ? $get_postal['city'] : '';

        $get_postal['latitude'] = $lati;
        $get_postal['longitude'] = $longi;

        return $get_postal;        
    }

    public function get_postal_by_fallback($latlng) {
        $postal = array();
        $fallback = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latlng . "&sensor=false"));

        if(count($fallback->results)){
            $result = $fallback->results[0]->address_components;
            foreach ($result as $item) {
                $types = $item->types;
                foreach ($types as $type) {
                    if ($type == 'postal_code') {
                        $postal['zipcode'] = intval($item->long_name);
                    }
                    if ($type == 'locality') {
                        $postal['city'] = $item->long_name;
                    }
                    if ($type == 'country') {
                        $postal['country'] = $item->long_name;
                    }

                }
                $postal['location'] = $fallback->results[0]->formatted_address;

            }
        }

        return $postal;
    }

    public function getLogin() {

        if (Auth::check()) {

            return Redirect::intended(url());
        } else {
            return \View::make('login')->withData("");
        }
    }

    public function postLogin() {
        $remember = (Input::has('check')) ? true : false;

        $cred = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        //dd($cred);
        if (\Auth::attempt($cred, $remember)) {
            $user_id = Auth::user()->id;
            $date_time = date("Y-m-d h:i:sa");
            $userOnline = DB::table('user_online')->where('user_id', '=', $user_id)->first();
            if ($userOnline == null) {
                DB::table('user_online')->insert(
                        ['user_id' => $user_id, 'time' => $date_time]
                );
            }
            $id = DB::table('role_user')->where('user_id', '=', $user_id)->first();
//dd($id);
            if ($id->role_id == 2) {
                //return url() . '/admin';
                //return redirect(url() . '/admin');

                return \View::make('login')->withData("Username or Password do not match");
            } else {
                // return url() . '/profile';
                return redirect(url() . '/profile');
                //return Redirect::intended('/');
            }
        } else {
            //return "0";
            return \View::make('login')->withData("Username or Password do not match");
            //$result = "Request Sent Successfully";
            //return $result;
        }

        //$creds = array('username' => 'hasan' , 'password' => 'abc');
        //\Auth::attempt($creds);
        //Redirect::to('users');
    }

    public function ajaxLogin() {
        $remember = (Input::has('check')) ? true : false;

        $cred = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        $data = "0";
        
        if (Auth::attempt($cred, $remember)) {
            $user_id = Auth::user()->id;
            $date_time = date("Y-m-d h:i:sa");
            $userOnline = DB::table('user_online')->where('user_id', '=', $user_id)->first();
            if ($userOnline == null) {
                DB::table('user_online')->insert(
                        ['user_id' => $user_id, 'time' => $date_time]
                );
            }

            $data = $user_id;

            // $id = DB::table('role_user')->where('user_id', '=', $user_id)->first();
            // if ($id->role_id != 2) {
            //     return url() . '/profile';
            // }
        }
        
        return $data;

    }

    public function getLogout() {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            Auth::logout();
            DB::table('user_online')->where('user_id', '=', $user_id)->delete();
            //dd("logged out");
        }
        return Redirect::to('/');
    }

    public function paginateUser() {
        $allUsers = User::select('username', 'photo')->orderBy('id', 'desc')->simplePaginate(10);
        return Response::json(['status' => 'success', 'user' => $allUsers->toJson()]);
    }
	
	public function ListBlog() {
        $data['blogdata'] = DB::table('user_blogs')->orderBy('id', 'DESC')->get();	
        return response()->json($data);
		#return view('bloglist',$data)	;	
	}

}
