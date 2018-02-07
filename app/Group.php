<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'created_by_id', 'description', 'image', 'block', 'isPrivate'];

    protected $date = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'groups_users', 'group_id', 'user_id');
    }

    public function groupMemberPost()
    {
        return $this->hasMany('App\GroupMemberPost', 'group_id');
    }
}
