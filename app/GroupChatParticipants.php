<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupChatParticipants extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group_chat_participants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'group_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

}
