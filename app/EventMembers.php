<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMembers extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_members';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'event_id', 'type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function event()
    {
        return $this->hasOne('App\Event', 'id', 'event_id');
    }

}
