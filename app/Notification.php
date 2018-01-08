<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'from_id',
        'type',
        'is_read',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function userInfo()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    public function fromInfo()
    {
        return $this->hasOne('App\User', 'id', 'from_id');
    }

}
