<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriendship extends Model
{
    protected $table = 'user_friendships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['email', 'password'];

    protected $fillable = ['user_id', 'friend_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


}
