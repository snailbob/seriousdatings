<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    protected $table = 'user_pictures';

    protected $fillable = ['id', 'user_id', 'image', 'status', 'privacy'];

    protected $date = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
