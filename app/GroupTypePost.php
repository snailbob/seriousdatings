<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTypePost extends Model
{
    protected $table = "group_type_post";
    protected $fillabe = ["type"];
    public $timestamps = false;

    public function groupMemberPost()
    {
        return $this->hasMany('App\GroupMemberPost', 'type_post_id', 'id');
    }
}
