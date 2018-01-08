<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDestination extends Model
{
    protected $table = 'user_destinations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['email', 'password'];

    protected $fillable = ['user_id', 'destination'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
