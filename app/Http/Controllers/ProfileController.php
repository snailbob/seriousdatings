<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use \App\User;
use \App\Notification;
use Auth;
use DB;
class ProfileController extends Controller
{


    public function getIndex()
    {
        if (Auth::check()) {
            if(Auth::user()->verified == 0){
                // return redirect('/verifyPlease');
                return \Redirect::to('/verifyPlease');
            }
        }else{
            return \Redirect::to(url());
        }
        $current_user = Auth::user();
		//$all_users = User::all();
        // $all_users = DB::table('users')->get();
        $all_users = DB::table('users')->where('gender', '!=', $current_user->gender)->limit(14)->get();
        $logged_in = Auth::user()->id;

          
        // $profCtrl = new ProfileController;
        $friends = $this->getUserFriend();
        // dd($friends);
        // return response()->json($friends);

        $data = array(
            'current_user' 	=> $current_user,
            'all_users'		=> $all_users,
            'friends'       => $friends
        );

        $uname = Auth::user()->username;
        // dd($all_users);
        return View::make('profile')->with(array('data'=>$data,'username'=>$uname, 'currentUser'=>1));

    }

    //Jamen Added
    
    public function getUserProfile($username){

        if (Auth::check()) {
            if(Auth::user()->verified == 0){
                return \Redirect::to('/verifyPlease');
            }
        }else{
            return \Redirect::to(url());
        }
        // $current_user = Auth::user();
        $current_user = DB::table('users')->where('username', '=', $username)->get();
        $main_user = DB::table('users')->where('username', '=', Auth::user()->username)->get();
        
        // return response()->json($current_user);
        $current_user[0]->percent = $this->getPercentage($main_user, $current_user);
        // $current_user[0]->favorite = $this->getMatchFavorite($main_user, $current_user);

        // dd($current_user[0]);

        // $profCtrl = new ProfileController;
        $friends = $this->getUserFriend();

        $data = array(
            'current_user'  => $current_user[0],
            'friends'       => $friends
        );

        $data_new = $this->getMatchFavorite($main_user, $current_user);
        // dd($data_new['movies']);
        $uname = Auth::user()->username;


        //add to notifications
        $arr = array(
            'user_id'=>$current_user[0]->id,
            'from_id'=>Auth::user()->id,
            'type'=>'visit_profile'
        );
        Notification::create($arr);
        

        return View::make('profile')->with(array('data'=>$data, 'data_new'=>$data_new,'username'=>$uname, 'currentUser'=>0));

    }

    //End here

    public function getUserFriend(){

        $logged_in = Auth::user()->id;
        // $res_friend = DB::select('SELECT * FROM user_friendships WHERE user_id=:id', ['id' => $logged_in]); 
        $current_user_data = DB::table('users')->where('id', '=', $logged_in)->first();
        $top_friend = User::orderByRaw("RAND()")->where('gender', '!=', $current_user_data->gender)->get(); //orderByRaw("RAND()")->

        $random_friend = User::orderByRaw("RAND()")->where('gender', '!=', $current_user_data->gender)->limit(8)->get();
        
        // $res_friend = DB::table('users')->where('gender', '!=', $current_user_data[0]->gender)->limit(8)->get();
        // dd($res_friend);
        $friends = array();
        $inc = 0;

        foreach ($top_friend as $data) {
            $res_data = DB::table('users')->where('id', '=', $data->id)->get();
            $percent = $this->getPercentage(array($current_user_data), $res_data);

            if($percent >= 70){
                if(count($friends) < 9){
                    $friends[$inc] = $res_data[0];
                    $friends[$inc]->percent = $this->getPercentage(array($current_user_data), $res_data);
                    $friends[$inc]->favorite = $this->getMatchFavorite(array($current_user_data), $res_data);
                }
            }
            $inc++;
            
        }

        //get random user if top match is less 8 people
        if(count($friends) < 8){
            $friends = array();
            $inc = 0;
            
            foreach ($random_friend as $data) {
                $res_data = DB::table('users')->where('id', '=', $data->id)->get();

                $friends[$inc] = $res_data[0];
                $friends[$inc]->percent = $this->getPercentage(array($current_user_data), $res_data);
                $friends[$inc]->favorite = $this->getMatchFavorite(array($current_user_data), $res_data);

                $inc++;
                
            }
        }


        return $friends;
    }

    //Added by Jamen
    public function userProfile($username){

        $users = DB::table('users')->where('username', '=', $username)->get();
        $users_id = $users[0]->id;
        $notify = DB::select('select COUNT(user_id) as count from notifications where user_id = ? and type = ?', [$users_id,'visit_profile']);
        
        $users[0]->notify_visit = $notify[0]->count;

        // dd($users);
        return response()->json($users);
        // return View::make('prrofile');

    }

    public function checkNotify($id){

        if($id){
            $notifyCount = DB::select('select COUNT(user_id) as count from notifications where user_id = ? and type = ?', [$id,'visit_profile']);
            $notify = DB::select('select * from notifications where user_id = ? and type = ? order by id desc limit 1', [$id,'visit_profile']);

            $user = DB::table('users')->where('id','=',$notify[0]->user_id)->get();
            $from = DB::table('users')->where('id','=',$notify[0]->from_id)->get();

            $data = array(
                'details'  => $notify[0],
                'users'   => $user[0],
                'from'    => $from[0],
                'count'   => $notifyCount[0]->count
            );

            // dd($data);
            return $data;
        }

    }

    public function getUserAge($birthdate){

        $age = 'NA';
        if(!empty($birthdate)){
            $then_ts = strtotime($birthdate);
            $then_year = date('Y', $then_ts);
            $age = date('Y') - $then_year;
            if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
        }

       return $age;

    }

    public function getMatchPercentage($username){

        $user = DB::table('users')->where('username', '=', Auth::user()->username)->get();
        $friend = DB::table('users')->where('username', '=', $username)->get();

        // $profCtrl = new ProfileController;
        $percent = $this->getPercentage($user, $friend);

        $res = array();
        $res[0]['detail']=$friend[0];
        $res[0]['percent']=$percent;

        return response()->json($res);
        // dd($res);

    }

    public function getUserMatch($username){

        // $profCtrl = new ProfileController;
        $new_user = array();

        $current_user = DB::table('users')->where('username', '=', $username)->get();
        $current_user_id = $current_user[0]->id;
        $current_user_date = DB::table('about_your_date')->where('user_id', '=', $current_user[0]->username)->get();
        $current_user_age = $this->getUserAge($current_user[0]->birthdate);
        $current_user_zodiac = $current_user_date[0]->zodicSign;

        // $all_users = DB::table('users')->where('gender', '!=', $current_user[0]->gender)->get();
        $all_users = User::orderByRaw("RAND()")->where('gender', '!=', $current_user[0]->gender)->get();

        $tes_res = array();
        $i = 0;
        foreach ($all_users as $user) {

            $user_data = DB::table('users')->where('username', '=', $user->username)->get();

            $res_friend = DB::select('SELECT * FROM user_friendships WHERE user_id = ? AND friend_id = ?', [$current_user_id,$user_data[0]->id]);

            if(!$res_friend){

                $user_data_age = $this->getUserAge($user_data[0]->birthdate);
                $new_user[$i] = $user_data[0]; 
                $new_user[$i]->percent = $this->getPercentage($current_user, $user_data);
                $new_user[$i]->favorite = $this->getMatchFavorite($current_user, $user_data);

                $i++;

            }
            // $new_user[$i]->friend = $res_friend;

            // $new_user[$i]['details'] = $user_data[0]; 
            // $new_user[$i]['percent'] = $profCtrl->getPercentage($current_user, $user_data);
            // $new_user[$i]['favorite'] = $profCtrl->getMatchFavorite($current_user, $user_data);


        }

        // Sort by Desc order
        // for( $a=0 ; $a<$i ; $a++ ){
        //     for( $b=1 ; $b<($i-$a) ; $b++ ){
        //         if($new_user[$b-1]->percent < $new_user[$b]->percent){
        //             //swap elements  
        //             $temp = $new_user[$b-1];  
        //             $new_user[$b-1] = $new_user[$b];  
        //             $new_user[$b] = $temp;  
        //         }  
        //     }
        // }

        // dd($new_user);
        
        return $new_user;
        // return response()->json($new_user);

    }

    public function getMatchFavorite($current_user, $user_data){

        $current_id = $current_user[0]->id;
        $user_id = $user_data[0]->id;

        $current_movies = DB::table('like_movies')->where('user_id', $current_id)->get();
        $user_movies = DB::table('like_movies')->where('user_id', $user_id)->get();

        $res_movies = array();
        $i = 0;
        foreach ($current_movies as $c_movie) {
            foreach ($user_movies as $u_movie) {
                if($c_movie->movies == $u_movie->movies){
                    $res_movies[$i]['name'] = $c_movie->movies;
                    if($c_movie->movies=='Action & Adventure'){
                        $res_movies[$i]['image'] = 'movie1.png';
                    }elseif ($c_movie->movies=='Comedy') {
                        $res_movies[$i]['image'] = 'movie2.png';
                    }elseif ($c_movie->movies=='Romance') {
                        $res_movies[$i]['image'] = 'movie3.png';
                    }elseif ($c_movie->movies=='Thriller') {
                        $res_movies[$i]['image'] = 'movie4.png';
                    }elseif ($c_movie->movies=='Drama') {
                        $res_movies[$i]['image'] = 'movie5.png';
                    }elseif ($c_movie->movies=='Science Fiction') {
                        $res_movies[$i]['image'] = 'movie6.png';
                    }
                    $i++;
                }
            }
        }

        $current_places = DB::table('user_destinations')->where('user_id', $current_id)->get();
        $user_places = DB::table('user_destinations')->where('user_id', $user_id)->get();

        $res_places = array();
        $i = 0;
        foreach ($current_places as $c_place) {
            foreach ($user_places as $u_place) {
                if($c_place->destination == $u_place->destination){
                    $res_places[$i]['name'] = $c_place->destination;
                    if($c_place->destination=='Beach'){
                        $res_places[$i]['image'] = 'destination-img1.png';
                    }elseif ($c_place->destination=='Egypt'){
                        $res_places[$i]['image'] = 'destination-img2.png';
                    }elseif ($c_place->destination=='Sermany'){
                        $res_places[$i]['image'] = 'destination-img3.png';
                    }elseif ($c_place->destination=='Greece'){
                        $res_places[$i]['image'] = 'destination-img4.png';
                    }elseif ($c_place->destination=='India'){
                        $res_places[$i]['image'] = 'destination-img5.png';
                    }elseif ($c_place->destination=='New York'){
                        $res_places[$i]['image'] = 'destination-img6.png';
                    }
                    $i++;
                }
            }
        }

        $result = array('movies' => $res_movies, 'places' => $res_places);

        return $result;

    }

    public function getPercentage($current_user, $user_data, $return_percentage = true){

        // $profCtrl = new ProfileController;
        $percent = 0;
        $details = array();
        
        if(count($current_user) && count($user_data)){
            $current_user_date = DB::table('about_your_date')->where('user_id', '=', $current_user[0]->username)->get();

            $current_user_age = $this->getUserAge($current_user[0]->birthdate);
            $user_data_age = $this->getUserAge($user_data[0]->birthdate);

            $total_criterias = 22;
            $matching_count = 0;

            if( $user_data_age >= $current_user_date[0]->age_from && $user_data_age <= $current_user_date[0]->age_to ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Within age bracket',
                    'value'=>$current_user_date[0]->age_from.'-'.$current_user_date[0]->age_to.' y/o'
                );                
            }
            if( $current_user_date[0]->zodicSign == $user_data[0]->zodicSign ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Zodiac Sign',
                    'value'=>$current_user_date[0]->zodicSign
                );
            }
            if( $current_user_date[0]->relationshipGoal == $user_data[0]->relationshipGoal ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Relationship Goal',
                    'value'=>$current_user_date[0]->relationshipGoal
                );
            }
                
            if( $current_user_date[0]->haveChildren == $user_data[0]->haveChildren ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Have children',
                    'value'=>$current_user_date[0]->haveChildren
                );
            }
                
            if( $current_user_date[0]->partnerDependability == $user_data[0]->partnerDependability ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Partner\'s Dependability',
                    'value'=>$current_user_date[0]->partnerDependability
                );
            }
                
            if( $current_user_date[0]->sexualCompatibility == $user_data[0]->sexualCompatibility ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Sexual Compatibility',
                    'value'=>$current_user_date[0]->sexualCompatibility
                );
            }
                
            if( $current_user_date[0]->friendshipBetweenPartners == $user_data[0]->friendshipBetweenPartners ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Friendship Between Partners',
                    'value'=>$current_user_date[0]->friendshipBetweenPartners
                );
            }
                
            if( $current_user_date[0]->drugs == $user_data[0]->drugs ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Drugs',
                    'value'=>$current_user_date[0]->drugs
                );
            }
                
            if( $current_user_date[0]->smoke == $user_data[0]->smoke ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Smoke',
                    'value'=>$current_user_date[0]->smoke
                );
            }
                
            if( $current_user_date[0]->drink == $user_data[0]->drink ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Drink',
                    'value'=>$current_user_date[0]->drink
                );
            }
                
            if( $current_user_date[0]->bodyType == $user_data[0]->bodyType ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Body Type',
                    'value'=>$current_user_date[0]->bodyType
                );
            }
                
            if( $current_user_date[0]->height == $user_data[0]->height ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Height',
                    'value'=>$current_user_date[0]->height
                );
            }
                
            if( $current_user_date[0]->eyeColor == $user_data[0]->eyeColor ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Eye Color',
                    'value'=>$current_user_date[0]->eyeColor
                );
            }
                
            if( $current_user_date[0]->hairColor == $user_data[0]->hairColor ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Hair Color',
                    'value'=>$current_user_date[0]->hairColor
                );
            }
                
            if( $current_user_date[0]->educationLevel == $user_data[0]->educationLevel ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Education Level',
                    'value'=>$current_user_date[0]->educationLevel
                );
            }
                
            if( $current_user_date[0]->language == $user_data[0]->language ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Language',
                    'value'=>$current_user_date[0]->language
                );
            }
                
            if( $current_user_date[0]->ethnicity == $user_data[0]->ethnicity ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Ethnicity',
                    'value'=>$current_user_date[0]->ethnicity
                );
            }
                
            if( $current_user_date[0]->religiousBeliefs == $user_data[0]->religiousBeliefs ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Religious Beliefs',
                    'value'=>$current_user_date[0]->religiousBeliefs
                );
            }
                
            if( $current_user_date[0]->income == $user_data[0]->income ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Income',
                    'value'=>$current_user_date[0]->income
                );
            }
                
            if( $current_user_date[0]->tatoos == $user_data[0]->tatoos ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Tattoos',
                    'value'=>$current_user_date[0]->tatoos
                );
            }
                
            if( $current_user_date[0]->relationshipStatus == $user_data[0]->relationshipStatus ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Relationship Status',
                    'value'=>$current_user_date[0]->relationshipStatus
                );
            }
                
            if( $current_user_date[0]->wantKids == $user_data[0]->wantKids ){
                $matching_count += 1;
                $details[] = array(
                    'name'=>'Want Kids',
                    'value'=>$current_user_date[0]->wantKids
                );
            }
                

            $percent = round(($matching_count/$total_criterias) *100, 0);

            //adjust percentage
            if($percent < 50){
                $percent += $matching_count * 2.5;
            }
            else if($percent < 60 && $percent > 50){
                $percent += $matching_count * 2;
            }
            else if($percent < 70 && $percent > 60){
                $percent += $matching_count * 1;
            }
            else if($percent < 80 && $percent > 70){
                $percent += $matching_count * 0.4;
            }
            else if($percent < 90 && $percent > 80){
                $percent += $matching_count * 0.3;
            }

            $percent = round($percent, 0);
            $percent = ($percent > 100) ? 100 : $percent;
            
        }

        if($return_percentage){
            return $percent;
        }
        else{
            return $details;
        }
    }
    // Added by Jamen End


}
