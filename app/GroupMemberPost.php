<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMemberPost extends Model
{
    protected $table = "group_member_post";
    protected $fillable = ['group_id', 'user_id', 'post'];
    protected $date = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
