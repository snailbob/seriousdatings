<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupChatMessages extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group_chat_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'group_id', 'group_id', 'type', 'message', 'price', 'paid'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];
}
