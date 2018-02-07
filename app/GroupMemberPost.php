<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMemberPost extends Model
{
    protected $table = "group_member_post";
    protected $fillable = ['group_id', 'user_id', 'post', 'type_post_id'];
    protected $date = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function postType()
    {
        return $this->belongsTo('App\GroupTypePost', 'type_post_id', 'id');
    }


}
