<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\AboutYourDate;
use App\Http\Controllers\VerifyController;

use Input;

use Redirect;

use Illuminate\Support\Facades\View;
use Auth;
use DB;


class AboutYourDateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Auth::user()){
            $id = Auth::user()->id;
            $user = User::find($id);
            // $aboutdate = AboutYourDate::where('user_id',$user->username)->first();
            $countries = DB::table('countries')->get();
            // return json_encode($aboutdate);

            $data = [
                'user'=>$user,
                'countries'=>$countries,
                // 'aboutdate'=>$aboutdate
            ];

            $send_email = (new VerifyController)->send_verification_mail();

            // return response()->json($data);
            return View::make('user.about_your_date')->with($data);
        }
        else{
            return redirect(url());
        }
    	
    }   

    public function userSession(){
        if(Auth::user()){
            $id = Auth::user()->id;
            $user = User::find($id);
            
            return json_encode($user);
        }
    }


    public function selectMates($username){
        if(Auth::user()){
            // $id = Auth::user()->id;
            // $user = User::find($id);
            // $aboutdate = AboutYourDate::where('user_id', $user->username)->first();
            
            // $users = User::where('gender', $aboutdate->gender)->orderBy('id', 'desc')->get();
            // $top_users = User::where('gender', 'NOT LIKE',$user->gender)->orderBy('id', 'desc')->take(3)->get();
            // $online_users = User::where('gender', 'NOT LIKE',$user->gender)->orderBy('firstName', 'desc')->take(3)->get();
            // $featured_users = User::where('gender', 'NOT LIKE',$user->gender)->orderBy('username', 'desc')->take(3)->get();
            // // return json_encode($users);

            // $data = [
            //     'user'=>$user,
            //     'top_users'=>$top_users,
            //     'online_users'=>$online_users,
            //     'featured_users'=>$featured_users,
            //     'users'=>$users
            // ];
            return View::make('user.select_mates')->with("username", $username); //->with($data);
        }
        else{
            return redirect(url().'/login');
        }
    }

    public function likeMovies(){
        $id = Auth::user()->id;
        $user = User::find($id);
        $countries = DB::table('countries')->get();

        $data = [
            'user'=>$user,
            'countries'=>$countries,
        ];
        return View::make('user.like_movies'); //->with($data);
    }

    public function create()
    {
    //return Redirect::to('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {


    	$rules = array(
    			'ageFrom' => 'required',
    			'ageTo'	   => 'required',
    			'rangeOfMiles' => 'required',
    			'gender' => 'required',
                'user_id' => ' unique:about_your_date'
                

    	);
    	$validator = \Validator::make(Input::all(),$rules);
    	if($validator->fails())
    		return Redirect::to('users/'.Input::get('user_id').'/about_your_date')
    		->withInput()
    		->witherrors($validator->messages());
    	
    			\DB::table('about_your_date')->insert([
    					'relationshipGoal' => Input::get('relationshipGoal'),
    					'haveChildren' => Input::get('haveChildren'),
    					'whatIsTheLongestRelationshipYouHaveBeenIn' => Input::get('whatIsTheLongestRelationshipYouHaveBeenIn'),
    					'partnerDependability' => Input::get('partnerDependability'),
    					'sexualCompatibility' => Input::get('sexualCompatibility'),
    					'friendshipBetweenPartners' => Input::get('friendshipBetweenPartners'),
    					'drugs' => Input::get('drugs'),
    					'hairColor' => Input::get('hairColor'),
    					'hairStyle' => Input::get('hairStyle'),
    					'eyeColor' => Input::get('eyeColor'),
    					'height' => Input::get('height'),
    					'bodyType' => Input::get('bodyType'),
    					'zodicSign' => Input::get('zodicSign'),
    					'smoke' => Input::get('smoke'),
    					'drink' => Input::get('drink'),
    					'excercise' => Input::get('excercise'),
    					'excerciseSchedule' => Input::get('excerciseSchedule'),
    					'educationLevel' => Input::get('educationLevel'),
    					'language' => Input::get('language'),
    					'ethnicity' => Input::get('ethnicity'),
    					'religiousBeliefs' => Input::get('religiousBeliefs'),
    					'income' => Input::get('income'),
    					'gender' => Input::get('gender'),
    					'zipcode' => Input::get('zipcode'),
    					'tatoos' => Input::get('tatoos'),
    					'relationshipStatus' => Input::get('relationshipStatus'),
    					'wantKids' => Input::get('wantKids'),
    					'rangeOfMiles' => Input::get('rangeOfMiles'),
    					'age_from' => Input::get('ageFrom'),
    					'age_to' => Input::get('ageTo'),
    					'user_id' =>  Input::get('user_id'),
    					'motherBorn' => Input::get('motherBorn'),
    					'fatherBorn' => Input::get('fatherBorn'),
                        'latitude' => Input::get('lati'),
                        'longitude' => Input::get('longi')
                        

    			]);
    			return Redirect::to('users/'.Input::get("user_id").'/compatability');
    			
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
