<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;

class compatability extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable;
    use CanResetPassword;
    use EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'compatability';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =  ['user_id', 'match_id', 'percentage'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden =  ->password', 'remember_token;


     public function  haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 3959)
        {
          // convert from degrees to radians
          $latFrom = deg2rad($latitudeFrom);
          $lonFrom = deg2rad($longitudeFrom);
          $latTo = deg2rad($latitudeTo);
          $lonTo = deg2rad($longitudeTo);

          $latDelta = $latTo - $latFrom;
          $lonDelta = $lonTo - $lonFrom;

          $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
          return $angle * $earthRadius;
        }   

     public function generateCompatibles($id){

       
       $users = DB::table('users')->get();
       $about_your_dates = DB::table('about_your_date')->where('user_id', $id)->first();
       if($about_your_dates == null){

        return 0;
       }
       $about_your_date = (object) $about_your_dates;
      // dd($about_your_date);
       
       
       foreach ($users as $user) {
             $count = 0;
             $matchThese = ['user_id' => $about_your_date -> user_id, 'match_id' => $user -> id]; 
                $check = DB::table('compatability')->where($matchThese)->get();
                //dd(sizeof($check));
                if(sizeof($check) < 1){
                    DB::table('compatability')->insert(
                        ['user_id' => $id, 'match_id' => $user->id, 'percentage' => '0', 'factors' => '']
                    );
                }
                else{

                    $percentage = ($count*100) / 30;
                    DB::table('compatability')
                        ->where($matchThese)
                        ->update(['user_id' => $id, 'match_id' => $user->id, 'percentage' => '0','factors' => '']);

                }
              
              $factors = '';
if($user -> relationshipGoal== $about_your_date -> relationshipGoal || $about_your_date -> relationshipGoal == "na") {$count++; $factors.= "relationshipGoal: ".$user -> relationshipGoal.",";}
if($user -> haveChildren== $about_your_date -> haveChildren || $about_your_date -> haveChildren == "na") {$count++; $factors.= "haveChildren: ".$user -> haveChildren.",";}
if($user -> whatIsTheLongestRelationshipYouHaveBeenIn== $about_your_date -> whatIsTheLongestRelationshipYouHaveBeenIn || $about_your_date -> whatIsTheLongestRelationshipYouHaveBeenIn == "na") {$count++; $factors.= "whatIsTheLongestRelationshipYouHaveBeenIn: ".$user -> whatIsTheLongestRelationshipYouHaveBeenIn.",";}
if($user -> partnerDependability== $about_your_date -> partnerDependability || $about_your_date -> partnerDependability == "na") {$count++; $factors.= "partnerDependability: ".$user -> partnerDependability.",";}
if($user -> sexualCompatibility== $about_your_date -> sexualCompatibility || $about_your_date -> sexualCompatibility == "na") {$count++; $factors.= "sexualCompatibility: ".$user -> sexualCompatibility.",";}
if($user -> friendshipBetweenPartners== $about_your_date -> friendshipBetweenPartners || $about_your_date -> friendshipBetweenPartners == "na") {$count++; $factors.= "friendshipBetweenPartners: ".$user -> friendshipBetweenPartners.",";}
if($user -> drugs== $about_your_date -> drugs || $about_your_date -> drugs == "na") {$count++; $factors.= "drugs: ".$user -> drugs.",";}
if($user -> hairColor== $about_your_date -> hairColor || $about_your_date -> hairColor == "na") {$count++; $factors.= "hairColor: ".$user -> hairColor.",";}
if($user -> hairStyle== $about_your_date -> hairStyle || $about_your_date -> hairStyle == "na") {$count++; $factors.= "hairStyle: ".$user -> hairStyle.",";}
if($user -> eyeColor== $about_your_date -> eyeColor || $about_your_date -> eyeColor == "na") {$count++; $factors.= "eyeColor: ".$user -> eyeColor.",";}
if($user -> height== $about_your_date -> height || $about_your_date -> height == "na") {$count++; $factors.= "height: ".$user -> height.",";}
if($user -> bodyType== $about_your_date -> bodyType || $about_your_date -> bodyType == "na") {$count++; $factors.= "bodyType: ".$user -> bodyType.",";}
if($user -> zodicSign== $about_your_date -> zodicSign || $about_your_date -> zodicSign == "na") {$count++; $factors.= "zodicSign: ".$user -> zodicSign.",";}
if($user -> smoke== $about_your_date -> smoke || $about_your_date -> smoke == "na") {$count++; $factors.= "smoke: ".$user -> smoke.",";}
if($user -> drink== $about_your_date -> drink || $about_your_date -> drink == "na") {$count++; $factors.= "drink: ".$user -> drink.",";}
if($user -> excercise== $about_your_date -> excercise || $about_your_date -> excercise == "na") {$count++; $factors.= "excercise: ".$user -> excercise.",";}
if($user -> excerciseSchedule== $about_your_date -> excerciseSchedule || $about_your_date -> excerciseSchedule == "na") {$count++; $factors.= "excerciseSchedule: ".$user -> excerciseSchedule.",";}
if($user -> educationLevel== $about_your_date -> educationLevel || $about_your_date -> educationLevel == "na") {$count++; $factors.= "educationLevel: ".$user -> educationLevel.",";}
if($user -> language== $about_your_date -> language || $about_your_date -> language == "na") {$count++; $factors.= "language: ".$user -> language.",";}
if($user -> ethnicity== $about_your_date -> ethnicity || $about_your_date -> ethnicity == "na") {$count++; $factors.= "ethnicity: ".$user -> ethnicity.",";}
if($user -> religiousBeliefs== $about_your_date -> religiousBeliefs || $about_your_date -> religiousBeliefs == "na") {$count++; $factors.= "religiousBeliefs: ".$user -> religiousBeliefs.",";}
if($user -> income== $about_your_date -> income || $about_your_date -> income == "na") {$count++; $factors.= "income: ".$user -> income.",";}
if($user -> gender== $about_your_date -> gender || $about_your_date -> gender == "na") {$count++; $factors.= "gender: ".$user -> gender.",";}
if($user -> tatoos== $about_your_date -> tatoos || $about_your_date -> tatoos == "na") {$count++; $factors.= "tatoos: ".$user -> tatoos.",";}
if($user -> relationshipStatus== $about_your_date -> relationshipStatus || $about_your_date -> relationshipStatus == "na") {$count++; $factors.= "relationshipStatus: ".$user -> relationshipStatus.",";}
if($user -> wantKids== $about_your_date -> wantKids || $about_your_date -> wantKids == "na") {$count++; $factors.= "wantKids: ".$user -> wantKids.",";}if($user -> motherBorn== $about_your_date -> motherBorn || $about_your_date -> motherBorn == "na") {$count++; $factors.= "motherBorn: ".$user -> motherBorn;}
if($user -> motherBorn== $about_your_date -> motherBorn || $about_your_date -> motherBorn == "na") {$count++; $factors.= "motherBorn: ".$user -> motherBorn.",";}
if($user -> fatherBorn== $about_your_date -> fatherBorn || $about_your_date -> fatherBorn == "na") {$count++; $factors.= "fatherBorn: ".$user -> fatherBorn.",";}
                $compatability = new compatability();
                $distance = $compatability -> haversineGreatCircleDistance($about_your_date ->latitude, $about_your_date ->longitude, $user -> latitude, $user -> longitude);

                if($distance <= $about_your_date ->rangeOfMiles){$count++;}
                //if($user -> rangeOfMiles == $about_your_date ->rangeOfMiles){ $count++;}
                if($user -> age >= $about_your_date ->age_from && $user -> age <= $about_your_date ->age_to || $about_your_date){ $count++;}
                    
                $matchThese = ['user_id' => $about_your_date -> user_id, 'match_id' => $user -> id]; 
                $check = DB::table('compatability')->where($matchThese)->get();
                //dd(sizeof($check));
                if(sizeof($check) < 1){
                    $percentage = ($count*100) / 30;
                    DB::table('compatability')->insert(
                        ['user_id' => $id, 'match_id' => $user->id, 'percentage' => $percentage,'factors' => $factors]
                    );
                }
                else{

                    $percentage = ($count*100) / 30;
                    DB::table('compatability')
                        ->where($matchThese)
                        ->update(['user_id' => $id, 'match_id' => $user->id, 'percentage' => $percentage, 'factors' => $factors]);

                }
     }
     //dd($factors);
     return 1;

     

    }

    
    public function  showCompatability($id){

        $compatibles = DB::table('compatability')
                     ->leftJoin('users', function($join)
                         {
                             $join->on('compatability.match_id', '=', 'users.id');
                             
                         })
                     ->where('compatability.user_id', '=', $id)
                     ->orderBy('percentage', 'desc')
                     ->get();
        
        $slider  = array();
        $i=0;
        foreach ($compatibles as $c ) {
            $i++;
            $c->i = $i;
            
        }

        $justRegistered = DB::table('users')->orderBy('created_at', 'desc')->get();

         $just  = array();
         $i=0;
        foreach ($justRegistered as $j ) {
            
            $just[$i]  = array(
                'i' =>  ++$i,
                'username' => $j -> username,
                'firstName' => $j -> firstName,
                'lastName' => $j -> lastName,
                'image' => $j -> photo
                );
            
        }

        $verifyKey = DB::table('users')->where('username', '=', $id)->pluck('verify_key');
        $result  = array(
                             'slider'        =>  $compatibles,
                             
                             'newsFeed'      =>  $just,
                             

                            'justRegistered' =>  $just,

                            'verifyKey'     =>  $verifyKey
                            
        );


        //dd($result);
       return $result;
       

    }

}
