<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBlocks extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_blocks';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'user_blocked_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

}
