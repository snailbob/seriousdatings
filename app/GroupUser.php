<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = "groups_users";
    protected $fillable = ['user_id', 'group_id', 'role_id', 'block', 'isJoin'];
    protected $date = ['created_at', 'updated_at'];

    public function role()
    {
        return $this->hasMany('App\Role');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
