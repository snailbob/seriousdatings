<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use SoftDeletes;
    use Authenticatable;
    use CanResetPassword;
    use EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['email', 'password'];

    protected $fillable=[
        'username',
        'password',
        'email',
        'firstName',
        'lastName',
        'verified',
        'admin_blocked',
        'admin_pause',
        'profileType',
        'photo',
        'photoType',
        'role',
        'active',
        'online',
        'timeActivated',
        'unsubscribe',
        'relationshipGoal',
        'jobAndJobSchedule',
        'yourSocialSituation',
        'haveChildren',
        'howMany',
        'doYouOwnACar',
        'areYouOnAnyMedication',
        'howAmbitiousAreYou',
        'whatIsTheLongestRelationshipYouHaveBeenIn',
        'yourBirthFatherAndMotherAre',
        'fatherBirthPlace',
        'motherBirthPlace',
        'partnerDependability',
        'sexualCompatibility',
        'friendshipBetweenPartners',
        'drugs',
        'hairColor',
        'hairStyle',
        'eyeColor',
        'height',
        'bodyType',
        'zodicSign',
        'smoke',
        'drink',
        'excercise',
        'excerciseSchedule',
        'educationLevel',
        'language',
        'ethnicity',
        'religiousBeliefs',
        'occupation',
        'income',
        'movie',
        'travel',
        'gender',
        'age',
        'zipcode',
        'tatoos',
        'wantKids',
        'relationshipStatus',
        'motherBorn',
        'fatherBorn',
        'remember_token',
        'verify_key',
        'latitude',
        'longitude',
        'location',
        'city',
        'country',
        'country_code',
        'phone',
        'admin_pause',
        'birthdate',
        'wouldBirthFatherAndMotherAre'
    ];

    protected $dates = ['deleted_at', 'create_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function payment(){
        return $this->hasMany('App\PaymentMethod');
    }
    
    public function aboutdate(){
        return $this->hasOne('App\AboutYourDate', 'user_id', 'username');
    }

    public function friends(){
        return $this->hasManyThrough('App\User', 'App\UserFriendship', 'user_id', 'id');
        // return $this->belongsToMany('App\User', 'friends', 'friend_one', 'friend_two');
        // ->wherePivot('accepted', '=', 1);
    }

    public function friends2(){
        return $this->belongsToMany('App\User', 'user_friendships', 'user_id');
        // ->wherePivot('accepted', '=', 1);
    }
    // friendship that I started
    function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'user_friendships', 'user_id', 'friend_id');
            // ->wherePivot('accepted', '=', 1) // to filter only accepted
            // ->withPivot('accepted'); // or to fetch accepted value
    }

    // friendship that I was invited to 
    public function friendOf()
    {
        return $this->belongsToMany('App\User', 'user_friendships', 'friend_id', 'user_id')
        ->wherePivot('accepted', '=', 1)
        ->withPivot('accepted');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('user_friendships', $this->relations)) $this->loadFriends();

        return $this->getRelation('user_friendships');
    }

    protected function loadFriends()
    {
        if ( ! array_key_exists('user_friendships', $this->relations))
        {
            $friends = $this->mergeFriends();

            $this->setRelation('user_friendships', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }

    public function group()
    {
        return $this->belongsToMany('App\Group', 'groups_users', 'group_id', 'user_id')->withPivot('id');
    }

    public function adsSpace()
    {
        return $this->hasMany('App\AdsSpace', 'user_id');
    }

    public function userMusic()
    {
        return $this->hasMany('App\UserMusic', 'user_id');
    }

    public function userPhoto()
    {
        return $this->hasMany('App\UserPhoto', 'user_id');
    }

    public function userVideo()
    {
        return $this->hasMany('App\UserVideo', 'user_id');
    }

}
