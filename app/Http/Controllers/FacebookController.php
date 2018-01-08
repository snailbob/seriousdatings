<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Routing\Controller;
use App\User;
use DB;
use Auth;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try{
            $socialUser = Socialite::driver('facebook')->user();
        }catch (\Exception $e){
            return redirect('/');
        }

        $user = User::where('email',$socialUser->getEmail())->first();

        if(!$user){
            //echo "User Doesnt Exist";
            $fbName = $socialUser->getName();
            $fbEmail = $socialUser->getEmail();
            $fbGender = $socialUser->user["gender"];

            return redirect(url().'/users/create')->with('fbEmail', $fbEmail); //->with($fbName,$fbEmail,$fbGender);
        }else{
            //echo "User Exist";
            auth()->login($user);
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


        //$token = $socialUser->token;
        //dd($user);
//        echo $socialUser->getName();
//        echo "<br />";
//        echo $socialUser->getEmail();
//        echo "<br />";
//        echo '<img src="'.$socialUser->getAvatar().'">';
//        echo $socialUser->user["gender"];

        // $socialUser->token;
    }
}