<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\View;

use \App\User;
use \App\Notification;

use App\Compatability;

use App\Http\Controllers\UsersController;

use DB;

use Auth;



class SearchController extends Controller

{

    public function index(Request $request){
        return View::make('search');
    }

    public function getSearchUser(Request $request){
        $user_ctrl = new UsersController();
        
        $user_id = (Auth::check()) ? Auth::user()->id : '';
        $zip = $request->input('zip');
        $gender = $request->input('gender');
        $age_from = $request->input('age_from');
        $age_to = $request->input('age_to');
        $search_type = $request->input('search_type');
        $offset = $request->input('offset');

        $time = strtotime("-".$age_from." years", time());
        $min_date = date("Y-m-d", $time);

        $time = strtotime("-".$age_to." years", time());
        $max_date = date("Y-m-d", $time);
        
        $users = User::where('id','not like', $user_id)
            ->orderBy('id', 'desc');
        
        if($request->has('zip')){
            $users->where('zipcode', $zip)
            ->where('gender', $gender)
            ->where('photo', 'like', 'data%')
            ->whereDate('birthdate', '<=', $min_date)
            ->whereDate('birthdate', '>=', $max_date);
        }


        //set offset if added
        if ($request->has('offset')) {
            $users->skip($offset);            
        }
            

        $req = $request->input();
        unset($req['myGender']);
        unset($req['gender']);
        unset($req['age_from']);
        unset($req['age_to']);
        unset($req['zip']);
        unset($req['range']);
        unset($req['search_type']);
        unset($req['offset']);
        
        //advance search filter
        if(!empty($search_type)){
            foreach($req as $r=>$value){
                if(!empty($value)){
                    $users->where($r, $value);
                }
            }
        }

        //limit to 3 if not logged in
        $usersToDisplay = (empty($user_id)) ? 3 : 6; 
        $users->take($usersToDisplay);
        
        
        

        $format_users = $user_ctrl->format_friends($users->get());

        $empty_params = array(
            'myGender'=>'',
            'gender'=>'',
            'age_from'=>'',
            'age_to'=>'',
            'zip'=>'',
            'range'=>'',
        );
        
        $arr = array(
            'user_id'=>$user_id,
            'min_date'=>$min_date,
            'max_date'=>$max_date,
            'users'=>$format_users,
            'requests'=>(!$request->input('zip')) ? $empty_params : $request->input()
        );
        return response()->json($arr); 
    }

    

    public function searchProfile($id){
        $logged_id = (Auth::check()) ? Auth::user()->id : '';
        
        $user_ctrl = new UsersController();
        $user = User::find($id);
        $calc_age = $user_ctrl->calc_age($user->birthdate);
        // return response()->json($calc_age);

        if(!empty($logged_id)){
            //add to notifications
            $arr = array(
                'user_id'=>$id,
                'from_id'=>$logged_id,
                'type'=>'visit_profile'
            );
            Notification::create($arr);
        }
        
        return View::make('user.search_profile');    
        
    }

    public function getRandomCompatible(Request $request){
        $user_ctrl = new UsersController();

        $dummy_user = array(
            'photo'=>url().'/public/images/placeholder.png'
        );

        $logged_id = (Auth::check()) ? Auth::user()->id : '';
        $logged_user = (Auth::check()) ? Auth::user() : $dummy_user;
        
        $users = User::where('gender', 'NOT LIKE', $logged_user->gender)->get();
        
        $random_index = rand(0, (count($users) - 1));
        $user = $users[$random_index];
        $details = $user_ctrl->format_user($user);

        $arr = array(
            'logged_id'=>$logged_id,
            'logged_user'=>$logged_user,
            'user'=>$details
        );

        return response()->json($arr);
    }

    public function getSearchProfile(Request $request){
        $user_ctrl = new UsersController();
        $user_id = $request->input('id');
        $user = User::find($user_id);
        $logged_id = (Auth::check()) ? Auth::user()->id : '';

        $dummy_user = array(
            'photo'=>url().'/public/images/placeholder.png'
        );
        $logged_user = (Auth::check()) ? Auth::user() : $dummy_user;
        
        $details = $user_ctrl->format_user($user);

        $arr = array(
            'logged_id'=>$logged_id,
            'logged_user'=>$logged_user,
            'user'=>$details
        );

        return response()->json($arr);
        
    }

    public function getSearchByName(Request $request){
        $user_ctrl = new UsersController();
        
        $user_id = (Auth::check()) ? Auth::user()->id : '';
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        

        $users = User::where('id','not like', $user_id);
        
        if(!empty($firstName)){
            $users->where('firstName', 'like', $firstName); // '%'.$firstName.'%');
            
        }
        if(!empty($lastName)){
            $users->where('lastName', 'like', $lastName); // '%'.$lastName.'%');
        }
        
        $format_users = array();       
        if(!empty($firstName) || !empty($lastName)){
            $format_users = $user_ctrl->format_friends($users->get());
        }
        return response()->json($format_users);
        
    }


    public function browseUsers(){
        return View::make('user.browse_users');    
    }

    public function getBrowseMembers(Request $request){
        $logged_id = (Auth::check()) ? Auth::user()->id : '';
        $user_ctrl = new UsersController();

        $offset = $request->input('offset');

        $users = User::where('id', 'NOT LIKE', $logged_id)
            ->orderBy('id', 'desc')
            ->skip($offset)
            ->take(6)
            ->get();
        
        $format_user = array();

        if(!empty($users)){
            foreach($users as $r=>$value){
                $format_user[] = $user_ctrl->format_user($value);
            }
        }

        $data = array(
            'logged_id'=>$logged_id,
            'users'=>$format_user
        );
        return response()->json($data);

    }

    public function getLnt($zip){

        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false";

        $result_string = file_get_contents($url);

        $result = json_decode($result_string, true);		
		
        $result1[]=$result['results'][0];

        $result2[]=$result1[0]['geometry'];

        $result3[]=$result2[0]['location'];

        return $result3[0];

    }


    public function xpostIndex(){

        $myGender = Input::get("myGender");

        $gender = Input::get("gender");

        $ageFrom = Input::get("age_from");

        $ageTo = Input::get("age_to");

        $zipCode = Input::get("zipcode");

        $range = Input::get("range");



        $getLocation = new SearchController();

        $val = $getLocation -> getLnt($zipCode);

        $lati = $val['lat'];

        $longi = $val['lng'];

        $geocodeFromLatLong2 = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lati).','.trim($longi).'&sensor=false'); 

        $output2 = json_decode($geocodeFromLatLong2);

        $status2 = $output2->status;	
		

        $searchLocation = ($status2=="OK")?$output2->results[1]->formatted_address:'';

        //dd($searchLocation);

        $distance = new Compatability();

        

        $users =  $users = DB::table('users')->get();

        

        $result = array();

        $i=0;

        //echo "Required <br/>Gender: ".$gender." AgeFrom: ".$ageFrom." AgeTo: ".$ageTo." Range: ".$range."<br/>";

        foreach ($users as $user) {

            $newDistance = $distance -> haversineGreatCircleDistance($lati,$longi,$user -> latitude,$user -> longitude);

            //echo "Gender: ".$user -> gender." Age: ".$user -> age." Distance: ".$newDistance."<br/>";

            if($newDistance <= $range && $user -> age >= $ageFrom && $user -> age <= $ageTo && $user -> gender == $gender){

                $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($user -> latitude).','.trim($user -> longitude).'&sensor=false'); 

                $output = json_decode($geocodeFromLatLong);

                $status = $output->status;

                $userLocation = ($status=="OK")?$output->results[1]->formatted_address:'';

                $result[$i]  = array('username' => $user -> username,'age' => $user -> age,'firstName' => $user -> firstName,'lastName' => $user -> lastName,'photo' => $user -> photo,'userLocation' => $userLocation,'searchLocation' => $searchLocation,'gender' => $gender,'ageFrom' => $ageFrom,'ageTo' => $ageTo,'range' => $range,'lati' => $lati, 'longi' => $longi,'gendr' => $gender);

                $i++;

            }

        }



        //dd($result);        

        // if(Auth::check()){

            return View::make('search')->withusers($result);    

        // }else{

            // return View::make('signup');           

        // }

        

       // dd($_POST);



        //return 'search';

    }










}

