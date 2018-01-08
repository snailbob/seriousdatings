<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Controllers\HomeContoller;

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\View;

use Input;

use App\User;
use App\AboutYourDate;
use App\UserFriendship;
use App\Notification;
use App\UserBlocks;

use DB;

use Auth;

use Mail;

use App\Http\Controllers\DatingPlanController;
use App\Http\Controllers\AdsSpaceController;


class UsersController extends Controller {

    public function __construct() {
        $this->beforefilter('exists', array('only' => array('show', 'edit', 'update', 'destroy')));
    }

    //bob

    public function homepage(Request $request){
        $just_registered = User::where('photo', 'like', 'data%')->orderBy('id', 'desc')->limit(20)->get();

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

        $welcome = DB::table('admin_cms_tbl')->where('id', 6)->first();
        // dd($welcome);
        $video = DB::table('videos')->first();
        $video->video = '4580033';
        
        $giftCards = DB::table('gift_cards')->get();

        $events = DB::table('events')->select(\DB::raw("*,DATE_FORMAT(start,'%d') AS single_date,DATE_FORMAT(endDate,'%b') AS single_month,DATE_FORMAT(start,'%d-%m-%Y') AS fromDate,DATE_FORMAT(endDate,'%d-%m-%Y') AS toDate"))->orderBy('start', 'desc')->take(2)->get();
        
        $blogs = DB::table('user_blogs')->limit(2)->get();
        $format_blog_preview = $this->format_blog_preview($blogs);
    
        $zipcode = ($request->input('zip')) ? $request->input('zip') : 0;
        $lati = ($request->input('lat')) ? $request->input('lat') : 0;
        $longi = ($request->input('lon')) ? $request->input('lon') : 0;
        $location = ($request->input('country')) ? $request->input('country') : '';
        $city = ($request->input('city')) ? $request->input('city') : '';

        // if(!$request->input('zip')){
        //     $details = json_decode(file_get_contents("http://ip-api.com/json"));
        //     if(!empty($details)){
        //         if (!property_exists($details, "zip")){
        //             $zipcode = $details->zip;
        //             $lati = $details->lat;
        //             $longi = $details->lon;
        //             $location = $details->country;
        //             $city = $details->city;
        //         }
        //     }
        // }


        $countAllUser = User::where("zipcode", $zipcode)->count();
        
        $countAllUser = ($countAllUser == 0) ? 1 : $countAllUser;

        $countAllWomeninArea = User::whereRaw("zipcode = $zipcode AND gender = 'Female'")->count();

        $countAllMeninArea = User::whereRaw("zipcode = $zipcode AND gender = 'Male'")->count();

        $womenPercent = round(($countAllWomeninArea * 100) / $countAllUser);

        $menPercent = round(($countAllMeninArea * 100) / $countAllUser);

        $me = Auth::user();
        $arr = [
            "just_registered"=>$just_registered,
            "online"=>$online,
            "events"=>$events,
            "blogs"=>$format_blog_preview,
            "video"=>$video,
            'giftCards'=>$giftCards,
            'zipcode'=>$zipcode,
            'welcome'=>$welcome,
            'me'=>$me,
            'city'=>$city,
            'womenPercent'=>$womenPercent,
            'menPercent'=>$menPercent
        ];

        return response()->json($arr);
    }

    public function format_blog_preview($blogs){
        $arr = array();
        
        if(!empty($blogs)){
            foreach($blogs as $value){
                $value->content_preview = (strlen($value->blogContent)>150) ? substr($value->blogContent,0,150).'....' : $value->blogContent;
                $value->date_format = date("d/m/Y",strtotime($value->createdat));
                $arr[] = $value;
            }
        }
        return $arr;
    }

    public function login_facebook(Request $request){
        $data = $request->input();
        $user = User::where('fb_id', $data['id'])->first();
        
        //assign fb to user if logged in
        if(!empty($data['uri_1'])){
            $user_id = (Auth::check()) ? Auth::user()->id : '';
            $u = User::find($user_id);
            $u->fb_id = $data['id'];
            $u->save();
        }

        
        //login user if matching fb id
        if(isset($user->id)){
            //login the user using the user id
            Auth::loginUsingId($user->id); 
        }
            
        return response()->json($user);
        
    }
    

    public function videoRoomPage(){
        $gender  = Auth::user()->gender;
        $online = \DB::table('users')->where('gender', 'not like', $gender)->get();
        
        $data = array(
            'online'=>$online,
        );

        return view('user.video_room')->with($data);
    }

    public function videoChatPage(){
        return View::make('user.video_chat');
    }
    
    public function onlineChatPage(){
        $gender  = Auth::user()->gender;
        $online = \DB::table('users')->where('gender', 'not like', $gender)->get();
        
        $count = 0;
        // foreach ($online as $on) {
        //     $count = $count++;
        //     $on->online = 0;
        //     if ($count == 0) {
        //         $on->count = 1;
        //     } else if ($count < 6) {
        //         $on->count = 0;
        //     } else if ($count == 6) {
        //         $on->count = 2;
        //         $count = 0;
        //     }
        //     if (strlen($on->time) > 0) {
        //         $on->online = 1;
        //     }
        // }
        $arr = array(
            'online_users'=>$online,
            'count'=>$count
        );
        return View::make('user.online_chat')->with($arr);
        
        // return response()->json($online);
        
    }

    public function homepage_search_people(Request $request){
        $zip = $request->input('zip');
        $gender = $request->input('gender');
        $users = User::where('zipcode', $zip)->where('gender', $gender)->get();
        return response()->json($users);
    }

     
    public function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K') {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        $the_distance = 0;
        if ($unit == "K") {
            $the_distance = ($miles * 1.609344);
        } else if ($unit == "N") {
            $the_distance = ($miles * 0.8684);
        } else {
            $the_distance = $miles;
        }

        // $the_distance = round($the_distance, 2);
        return number_format($the_distance, 2);
    }
        


    public function signup(Request $request){
        $user_details = $request->input(); //Input::all();
        // $user_details['password'] = \Hash::make($user_details['password']);
        $user_details['password'] = \Hash::make($user_details['password']);
        
        unset($user_details['password2']);
        unset($user_details['birthdateObj']);
        
        $verify_key = str_random(40);
        $user_details['verify_key'] = str_random(40);
        
        //get locations if empty
        if(empty($user_details['location'])){
            $get_coords_from_zip = $this->get_coords_from_zip($user_details['zipcode']);
        }

        $emailExist = User::where('email', $user_details['email'])->count();
        $usernameExist = User::where('username', $user_details['username'])->count();

        //recheck email/username in use
        if(!$emailExist && !$usernameExist){
            if(isset($get_coords_from_zip)){
                $user_details = array_merge($user_details, $get_coords_from_zip);
            }
    
            $new_user = User::create($user_details);

            //insert role
            DB::table('role_user')->insert(
                ['user_id' => $new_user['id'], 'role_id' => '3']
            );            

            // $send_verification_mail = $this->send_verification_mail($new_user);
            $insert_about_date = $this->insert_about_date($new_user);

            $new_user['result'] = 'ok';
            $new_user['message'] = 'Profile successfully created. We need more details for your date on the next page.';
            
            //login the user using the user id
            Auth::loginUsingId($new_user['id']); 

            return response()->json($new_user);
            
        }
        else{
            return response()->json([
                'result'=>'duplicate',
                'message'=>'Email or username already in use.'
            ]);
        }
        

    }

    public function insert_about_date($user){
        $about_your_date = [
            'user_id' => $user->username,
            // 'gender' => $user->gender,
            'zipcode' => $user->zipcode,
            // 'rangeOfMiles' => $user->{'%date_rangeOfMiles'},
            'latitude' => $user->latitude,
            'longitude' => $user->longitude
        ];
        $new_user = AboutYourDate::create($about_your_date);
        
        return $new_user;
    }


    public function send_invite(Request $request){
        $data = $request->input(); //response()->json($request->input());   
        $data['invited_by'] = Auth::user()->firstName;
        $data['link'] = url();
        $data['button_text'] = 'Join Now';

        $email_to_send = $data['email'];

        // return View::make('email.invite_friend')->with($data);
        
        Mail::send('email.invite_friend', $data, function($message) use ($email_to_send) {
            $message->to($email_to_send, 'ID')->subject('Serious Datings - Join Now');
        });

        return $data;

    }

    public function send_verification_mail($user){

        $data = [
            'email' => $user['email'],
            'image' => $user['photo'],
            'name' => $user['firstName'] . ' ' . $user['lastName'],
            'username' => $user['username'],
            'verification_link' => url().'/users/' . $user['id'] . '/verify/' . $user['verify_key'],
            'link' => url().'/users/' . $user['id'] . '/verify/' . $user['verify_key'],
            'image_link' => url().'/images/logo.jpg',
            'contact_address' => ''
        ];

        $email_to_send = $user['email'];
        

        Mail::send('email.verification', $data, function($message) use ($email_to_send) {
            $message->to($email_to_send, 'ID')->subject('Verify your seriousdatings account');
        });

        return true;

    }

    public function get_coords_from_zip($zip){

        $details = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$zip));
        
        $arr = [];
        if(count($details->results)){
            $arr['latitude'] = $details->results[0]->geometry->location->lat;
            $arr['longitude'] = $details->results[0]->geometry->location->lng;
            $arr['location'] = $details->results[0]->formatted_address;
        };

        return $arr;
    }

    public function validate_email(Request $request){
        $count = User::where('email', $request->input('email'))->count();
        return response()->json(['count'=>$count]);
    }

    public function validate_username(Request $request){
        $count = User::where('username', $request->input('username'))->count();
        return response()->json(['count'=>$count]);
    }
    public function getAboutdate(Request $request){
        $id = ($request->input('id')) ? $request->input('id') : Auth::user()->id;
        $user = User::find($id);
        $aboutdate = AboutYourDate::where('user_id',$user->username)->first();

        return response()->json($aboutdate);
    }
    public function postAboutdate(Request $request){
        $data = $request->input();
        $about = AboutYourDate::where('user_id', $data['user_id'])->update($data);
        return $data;

    }

    public function selectmates($username){

        $id = Auth::user()->id;
        $user = User::find($id);

        if($username){

            // $profCtrl = new ProfileController;
            $users = (new ProfileController)->getUserMatch($username);
            // dd($users);
            $format_friends = $this->format_friends($users);
            // return $users;
            // dd($users);
            $data = [
                'user'=>$user,
                // 'top_users'=>$top_users,
                // 'online_users'=>$online_users,
                // 'featured_users'=>$featured_users,
                'users'=>$users
            ];
            // return $data;
            return response()->json($data);

        }else{
            $aboutdate = AboutYourDate::where('user_id', $user->username)->first();
            
            $users = User::where('gender', $aboutdate->gender)->where('id', 'NOT LIKE', $id)->where('photo', 'like', 'data%')->orderBy('id', 'desc')->get();
            // dd($users);
            $format_friends = $this->format_friends($users);
            // dd($format_friends);
            // $top_users = User::where('gender', $aboutdate->gender)->orderBy('id', 'desc')->take(3)->get();
            // $online_users = User::where('gender', $aboutdate->gender)->orderBy('firstName', 'desc')->take(3)->get();
            // $featured_users = User::where('gender', $aboutdate->gender)->orderBy('username', 'desc')->take(3)->get();
            // return json_encode($users);
            
            $data = [
                'user'=>$user,
                // 'top_users'=>$top_users,
                // 'online_users'=>$online_users,
                // 'featured_users'=>$featured_users,
                'users'=>$users
            ];
            return $data;
        }
        
    }

    public function format_friends($users){
        $user_id = (Auth::check()) ? Auth::user()->id : '';
        $arr = array();
        // $arr = $users;
        if(!empty($users)){
            foreach($users as $r=>$value){
                $is_blocked = UserBlocks::where('user_id', $user_id)->where('user_blocked_id', $value->id)->count();

                if(empty($is_blocked)){
                    $relation = UserFriendship::where('user_id',$user_id)->where('friend_id',$value->id)->count();
                    $relation2 = UserFriendship::where('friend_id',$user_id)->where('user_id',$value->id)->count();
                    $relationship = $relation + $relation2;
                    // $aboutdate = User::find($value['id'])->aboutdate()->first();
                    // $value['aboutdate'] = $aboutdate;
                    // $value['is_friend'] = ($relation + $relation2) ? true : false;
                    $aboutdate = User::find($value->id)->aboutdate()->first();
                    $value->aboutdate = $aboutdate;
                    $value->is_friend = ($relation + $relation2) ? true : false;
                    $value->myage = $this->calc_age($value->birthdate);

                    //get percentage
                    $current_user_data = DB::table('users')->where('id', '=', $user_id)->get();
                    $res_data = DB::table('users')->where('id', '=', $value->id)->get();
                    $profCtrl = new ProfileController;
                    $value->percent = $profCtrl->getPercentage($current_user_data, $res_data);
                    $value->name = $value->firstName.' '.$value->lastName;

                    $value->distance = 'N/A';
                    if(!empty($user_id)){
                        $user_info = Auth::user();
                        $value->distance = $this->distance($user_info->latitude,$user_info->longitude,$value->latitude,$value->longitude);
                    }
                    
                    $arr[] = $value;
                }
            
            }
        }
        return $arr;
    }


    public function format_user_withsub($user){
        $format_user = $this->format_user($user);
        
        //get validation of subscription
        $dating_ctrl = new DatingPlanController();
        $format_user->subscription_validity = $dating_ctrl->check_subscription_validity($format_user->id);
        return $format_user;
        
    }

    public function format_user($user){
        
        $user_id = (Auth::check()) ? Auth::user()->id : '';

        $relation = UserFriendship::where('user_id',$user_id)->where('friend_id',$user->id)->count();
        $relation2 = UserFriendship::where('friend_id',$user_id)->where('user_id',$user->id)->count();

        // $aboutdate = User::find($user->id)->aboutdate()->first();
        // $value['aboutdate'] = $aboutdate;
        $user['is_friend'] = ($relation + $relation2) ? true : false;

        //get percentage
        $current_user_data = DB::table('users')->where('id', '=', $user_id)->get();
        $res_data = DB::table('users')->where('id', '=', $user->id)->get();
        $profCtrl = new ProfileController;
        $user['percent'] = $profCtrl->getPercentage($current_user_data, $res_data);
        $user['matching_details'] = $profCtrl->getPercentage($current_user_data, $res_data, false);
        
        $user['myage'] = $this->calc_age($user['birthdate']);
        $user['name'] = $user->firstName.' '.$user->lastName;
        $user['my_movies'] = $this->my_movies($user->id);
        $user['my_places'] = $this->my_places($user->id);
        
        return $user;
    }


    public function my_movies($user_id){
        $current_movies = DB::table('like_movies')->where('user_id', $user_id)->get();
        
        $arr = array();

        if(!empty($current_movies)){
            foreach ($current_movies as $r=>$value) {
                if ($value->movies == 'Action & Adventure') {
                    $value->image = url().'/public/images/movie1.png';
                }
                elseif($value->movies == 'Comedy') {
                    $value->image = url().'/public/images/movie2.png';
                }
                elseif($value->movies == 'Romance') {
                    $value->image = url().'/public/images/movie3.png';
                }
                elseif($value->movies == 'Thriller') {
                    $value->image = url().'/public/images/movie4.png';
                }
                elseif($value->movies == 'Drama') {
                    $value->image = url().'/public/images/movie5.png';
                }
                elseif($value->movies == 'Science Fiction') {
                    $value->image = url().'/public/images/movie6.png';
                }

                $arr[] = $value;
            }                
        }
        return $arr;
    }
    
    public function my_places($user_id){
        $user_places = DB::table('user_destinations')->where('user_id', $user_id)->get();
        
        $arr = array();

        if(!empty($user_places)){
            foreach ($user_places as $r=>$value) {
                if ($value->destination == 'Beach') {
                    $value->image = url().'/public/images/destination-img1.png';
                }
                elseif($value->destination == 'Egypt') {
                    $value->image = url().'/public/images/destination-img2.png';
                }
                elseif($value->destination == 'Sermany') {
                    $value->image = url().'/public/images/destination-img3.png';
                }
                elseif($value->destination == 'Greece') {
                    $value->image = url().'/public/images/destination-img4.png';
                }
                elseif($value->destination == 'India') {
                    $value->image = url().'/public/images/destination-img5.png';
                }
                elseif($value->destination == 'New York') {
                    $value->image = url().'/public/images/destination-img6.png';
                }

                $value->destination = ($value->destination=='Sermany') ? 'Germany' : $value->destination;
                $arr[] = $value;
            }                
        }
        return $arr;
    }

    public function format_unrelated_user($user){
        
        // $user_id = (Auth::check()) ? Auth::user()->id : '';

        // $relation = UserFriendship::where('user_id',$user_id)->where('friend_id',$user->id)->count();
        // $relation2 = UserFriendship::where('friend_id',$user_id)->where('user_id',$user->id)->count();

        // $aboutdate = User::find($user->id)->aboutdate()->first();
        // $value['aboutdate'] = $aboutdate;
        // $user['is_friend'] = ($relation + $relation2) ? true : false;

        // $current_user_data = DB::table('users')->where('id', '=', $user_id)->get();
        // $res_data = DB::table('users')->where('id', '=', $user->id)->get();
        // $profCtrl = new ProfileController;
        // $user['percent'] = $profCtrl->getPercentage($current_user_data, $res_data);
        
        $user['myage'] = $this->calc_age($user['birthdate']);
        $user['name'] = $user->firstName.' '.$user->lastName;
        
        return $user;
    }

    public function calc_age($birthdate){
        $age = 'NA';

        // $user['birthdate'] = '1999-11-04 00:00:00';
        // return $user['birthdate'];
        if(!empty($birthdate)){
            $then_ts = strtotime($birthdate);
            $then_year = date('Y', $then_ts);
            $age = date('Y') - $then_year;
            // if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
        }

        return $age;
    }

    public function likeMovies(){
        $countries = DB::table('countries')->get();
        $movies = []; //DB::table('movies')->get();

        $arr = array(
            'countries'=>$countries,
            'movies'=>$movies
        );
        return response()->json($arr);
        
    }

    public function testfriends(){
        $user = User::find(159);

        $u = $user->friends()->get();
        return response()->json($u);
    }

    public function getVideoShuffle(){
        // $users = DB::table('users')->where('id','181')
        // ->leftJoin('user_online', 'users.id', '=', 'user_online.user_id')
        // // ->join('orders', 'users.id', '=', 'orders.user_id')
        // ->select('users.*', 'user_online.*')
        // ->get();
        $user_id = Auth::user()->id;
        $zipcode = Auth::user()->zipcode;
        $online = \DB::table('user_online')->leftJoin('users', 'users.id', '=', 'user_online.user_id')->where('id', 'not like', $user_id)->get();
        $nearby = \DB::table('users')->where('zipcode',$zipcode)->where('id', 'not like', $user_id)->get();
        $logged_info = \DB::table('users')->find($user_id);
        
        $data = array(
            'logged_info'=>$logged_info,
            'online'=>$online,
            'nearby'=>$nearby
        );

        return response()->json($data);

    }

    public function getBodyContents(){
        $logged_id = (Auth::check()) ? Auth::user()->id : '';
        $notifications = Notification::where('user_id', $logged_id)->orderBy('id', 'DESC')->limit(20)->get();
        $unread_noti_count = Notification::where('user_id', $logged_id)->where('is_read', '0')->count();
        $format_noti = $this->format_noti($notifications);

        $logged_user_info = (Auth::check()) ? Auth::user() : null;
        
        //get validation of subscription
        $dating_ctrl = new DatingPlanController();
        $subscription_validity = $dating_ctrl->check_subscription_validity();
        
        //get advertisements
        $ads_ctrl = new AdsSpaceController();
        $active_ads = $ads_ctrl->active_ads();
        

        $arr = array(
            'active_ads'=>$active_ads,
            'subscription_validity'=>$subscription_validity,
            'notifications'=>$format_noti,
            'logged_id'=>$logged_id,
            'logged_user_info'=>$logged_user_info,
            'unread_noti_count'=>$unread_noti_count
        );
        return response()->json($arr);
    }

    public function format_noti($noti){
        $arr = array();
        if(count($noti)){
            foreach($noti as $r=>$value){
                $message = ' added you as friend. Click to visit their profile.';
                if($value['type'] == 'visit_profile'){
                    $message = ' visited your profile. Click to visit their profile.';
                }
                $value['message'] = $message;

                $from_info = User::find($value['from_id']);
                $value['from_info'] = $from_info;

                $value['message'] = $from_info->firstName.' '.$message;
                $value['ago'] = $this->time_elapsed_string($value['created_at']);
                $arr[] = $value;
            }
        }
        return $arr;
    }
    public function time_elapsed_string($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function profileSettings(){
        $countries = DB::table('countries')->get();
        $user = Auth::user();
        $data = array(
            'user'=>$user,
            'countries'=>$countries
        );
        return View::make('user.profile_settings')->with($data);
        
    }
    public function privacySettings(){
        $user = Auth::user();
        return View::make('user.privacy_settings')->withUser($user);
        
    }

    //bob




    public function index() {

        if (isset($_GET['email'])) {

            $email = $_GET['email'];

            $result = \DB::table('users')->where('email', $email)->get();

            if ($result == null) {

                return '1';

            } else {
                return '0';

            }

        }

        // $user = \DB::table('users')->where('id', Auth::user()->id)->get();
        $user = \DB::table('role_user')->where('id', Auth::user()->id)->get();

        // dd($user);

        // return redirect(url());
        return View::make('user_profile')->withUser($user);

    }



    public function get_postal_by_fallback($latlng) {

        $postal = '';

        $fallback = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latlng . "&sensor=false"));

        $result = $fallback->results[0]->address_components;

        foreach ($result as $item) {

            $types = $item->types;

            foreach ($types as $type) {

                if ($type == 'postal_code') {

                    $postal = $item->long_name;

                }

            }

        }

        return $postal;

    }



    public function create() {

        $zipcode = 0;

        $lati = 0;

        $longi = 0;

        $query = @unserialize(file_get_contents('http://ip-api.com/php/'));

        // $ip = $_SERVER['REMOTE_ADDR'];
        $ip = '122.53.60.61';

        // dd($ip);

        // $ip = '101.100.106.50';

        // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        $details = array(); //json_decode(file_get_contents("http://ipinfo.io/{$ip}"));

        if ($details != null) {

            // check if postal code is there in the return object. If not, get it from fallback api

            if (!property_exists($details, "postal"))

                $details->postal = $this->get_postal_by_fallback($details->loc);

            // end fall back IP check

            $zipcode = $details->postal;

            $location = explode(",", $details->loc);

            $lati = $location['0'];

            $longi = $location['1'];

            $location = $details->city . ", " . $details->region . ", " . $details->country . ", " . $details->postal;

        }

        else {

            $zipcode = 0;
            $lati = 0;
            $longi = 0;
            $city = "";
            $location = "";

        }



        if (Auth::user()) {

            return redirect(url() . '/profile');

        } else {

            $countries = DB::table('countries')->get();

            return View::make('signup_form')->with(array('zipcode'=>$zipcode, 'countries'=>$countries));
            // return View::make('signup')->with("zipcode", $zipcode);

        }

    }



    public function store() {

        $rules1 = array(
            'date_ageFrom' => 'required',
            'date_ageTo' => 'required',
            'date_rangeOfMiles' => 'required',
            'date_gender' => 'required',
            'country_user' => 'required',
            'fullName' => 'required',
            'username' => 'required | unique:users',
            'email' => 'required | unique:users',
            'date_zipcode' => 'required',
            'user_gender' => 'required',
            'password' => 'required | min:6'
        );



        $validator = \Validator::make(Input::all(), $rules1);

        if ($validator->fails()) {
            return \Redirect::to('users/create')
                            ->withInput()
                            ->witherrors($validator->messages());

        }

        $filname = "";

        if (Input::file('userProfilePicture') != null) {

            $filname = Input::file('userProfilePicture')->getClientOriginalName();

            $imageName = Input::file('userProfilePicture')->getClientOriginalExtension();

            $imageExt = Input::file('userProfilePicture')->guessExtension();

            $newName = Input::get('username') . '.' . $imageExt;

            Input::file('userProfilePicture')->move(base_path() . '/public/images/users/' . Input::get('username') . '/', $newName);

        }


        $zipcode = Input::get('date_zipcode');
        // $ip = $_SERVER['REMOTE_ADDR'];
        $ip = '122.53.60.61';
        $lati = 0;
        $longi = 0;
        $location = "";
        $city = "";
        $email_key = str_random(40);
        $age = Input::get('date_myage');
        $date_ageFrom = Input::get('date_ageFrom');
        $date_ageTo = Input::get('date_ageTo');
        $date_rangeOfMiles = Input::get('date_rangeOfMiles');
        $user_gender = Input::get('user_gender');
        $date_gender = Input::get('date_gender');
        
        $details = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=23423"));

        if(count($details->results)){
            $lati = $details->results[0]->geometry->location->lat;
            $longi = $details->results[0]->geometry->location->lng;
            $location = $details->results[0]->formatted_address;
        }

        $user = User::create(array(
            'username' => Input::get('username'),
            'password' => \Hash::make(Input::get('password')),
            'email' => Input::get('email'),
            'firstName' => Input::get('fullName'),
            'verified' => '0',
            'profileType' => '0',
            'photo' => $newName,
            'photoType' => Input::get('photoType'),
            'gender' => $user_gender,
            'date_gender' => $date_gender,
            'age' => $age,
            'date_ageFrom' => $date_ageFrom,
            'date_ageTo' => $date_ageTo,
            'date_rangeOfMiles' => $date_rangeOfMiles,
            'zipcode' => $zipcode,
            'verify_key' => $email_key,
            'latitude' => $lati,
            'longitude' => $longi,
            'location' => $location
        ));

        $lastInsertedId = $user->id;

        \Session::set('verify_key', $email_key);

        $id = \DB::table('role_user')->insertGetId(
            ['user_id' => $lastInsertedId, 'role_id' => 3]
        );

        \DB::table('friends')->insert(['friend_one' => $lastInsertedId, 'friend_two' => $lastInsertedId, 'status' => '1']);

        $cred = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );


        $rules = array(
            'date_ageFrom' => 'required',
            'date_ageTo' => 'required',
            'date_rangeOfMiles' => 'required',
            'date_gender' => 'required',

        );

        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->fails())

            return \Redirect::to('users/create')

                            ->withInput()

                            ->witherrors($validator->messages());


        $about_your_date = [
            'age_from' => Input::get('date_ageFrom'),
            'age_to' => Input::get('date_ageTo'),
            'user_id' => Input::get('username'),
            'gender' => Input::get('date_gender'),
            'zipcode' => Input::get('date_zipcode'),
            'rangeOfMiles' => Input::get('date_rangeOfMiles'),
            'latitude' => $lati,
            'longitude' => $longi
        ];

        \DB::table('about_your_date')->insert($about_your_date);



        if (\Auth::attempt($cred)) {


            //email on register
            $data = [
                'email' => Input::get('email'),
                'image' => "images/users/" . Input::get('username') . "/" . $newName,
                'name' => Input::get('firstName') . ' ' . Input::get('firstName'),
                'username' => Input::get('username'),
                'verification_link' => "http://seriousdatings.com/users/" . $lastInsertedId . "/verify/" . $email_key,
                'image_link' => 'http://seriousdatings.com/images/logo.jpg',
                'contact_address' => ''
            ];

            //dd($data);

            $email_to_send = Input::get('email');


            Mail::send('mailtemplate', $data, function($message) use ($email_to_send) {
                $message->to($email_to_send, 'ID')->subject('Verify your seriousdatings account');
            });

            $username = Input::get("username");
            $date_ageFrom = Input::get("date_ageFrom");
            $date_ageTo = Input::get("date_ageTo");
            
            return \Redirect::to('users/'.$username.'/about_your_date');

        }

    }


    public function submitAboutDate(){
        $request = Input::all();
        // $user = User::where($request['user_id']);
        
        unset($request['_token']);
        unset($request['lati']);
        unset($request['longi']);
        // $data = array(
        //     'relationshipGoal'=>'asdfsdf', //$request['relationshipGoal'],
        //     'haveChildren'=>$request['haveChildren'],
        //     'whatIsTheLongestRelationshipYouHaveBeenIn'=>$request['whatIsTheLongestRelationshipYouHaveBeenIn'],
        // );
        // $about = \DB::table('about_your_date')->where('user_id', $user->username)->update($request);
        $about = AboutYourDate::where('user_id', $request['user_id'])->update($request);
        return $request;
    }
    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id) {

        //dd($id);

        //$user = User::whereUsername($id)->first();

        $results = User::all();

        //$results = array();

        //dd($results);

        //return \View::make('search')->withResults($results);

        //return \View::make('search')->withUser($user);

        $logged_in = 0;

        if (Auth::check()) {

            $logged_in = Auth::user()->id;



            $current_user = User::where('id', $id)->orwhere('username', $id)->first();

            // dd($current_user );

            $user_id = $current_user->id;

            $role_user = DB::table('role_user')->where('user_id', $logged_in)->pluck('role_id');

            // dd($role_user);

            if ($role_user == 3) {

                //dd("In If loop");

                $url = url() . '/users/' . Auth::user()->username . '/verify';



                return redirect($url);

            } else {

                if ($role_user == 2) {

                    $role_user_status = 1;

                } else {

                    if ($role_user != 4) {

                        $role_user_status = 0;

                    } else {

                        $role_user_status = 1;

                    }

                }



                $success_story = DB::table('success_story')

                        #->where('user_id', '=', $logged_in)

                        ->pluck('id');

                if ($success_story < 1) {

                    $success_story_status = 0;

                } else {

                    $success_story_status = 1;

                }



                $sql = 'SELECT * FROM friends WHERE (friend_one="' . $logged_in . '" OR friend_two="' . $logged_in . '") AND (friend_one="' . $user_id . '" OR friend_two="' . $user_id . '")';

                //dd($sql);

                $friend_check = DB::select($sql);

                //dd($result);

                $current_user->role_user_status = $role_user_status;

                $current_user->user_id = $logged_in;

                $current_user->friend_id = $user_id;

                $current_user->success_story_status = $success_story_status;

                $current_user->friend_check = $friend_check;

                //dd($current_user);

                return View::make('user_profile')->withUser($current_user);

            }

        } else {

            return redirect(url());

        }

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id) {



        $path = "users/" . $id . "/edit";

        return View::make('about_your_date')->withusername($path);

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id) {

        return 'form db operation will perform here for username: ' . $id;

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id) {

        //

    }



    public function getVerify() {



    }



    public function checkEmail() {

        $data = [

            'email' => "tejasamandaliya@gmail.com",

            'image' => "images/users/arp690/arp690.jpg",

            'name' => "Alberto Romero",

            'username' => "arp690",

            'verification_link' => "http://seriousdatings.com/users/40/arp690",

            'image_link' => 'http://seriousdatings.com/images/logo.jpg',

            'contact_address' => ''

        ];

        //dd($data);

        $email_to_send = "ashu.khare1988@gmail.com";



        Mail::send('mailtemplate', $data, function($message) use ($email_to_send) {

            $message->to($email_to_send, 'ID')->subject('Verify your seriousdatings account');

        });

    }


    public function userProfile(){

        return View::make('profile');

    }


    public function getCurrentUser(){

        $current_user = Auth::user();

        // $user = DB::table('users')->where('id', $current_user['id'])->get();

        return response()->json($current_user);

    }


}

