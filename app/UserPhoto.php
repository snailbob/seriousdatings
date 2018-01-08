<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_pictures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id', 'image'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
