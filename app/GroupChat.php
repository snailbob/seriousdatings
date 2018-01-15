<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group_chats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'private_id', 'type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function participants()
    {
        return $this->hasMany('App\GroupChatParticipants', 'group_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\GroupChatMessages', 'group_id', 'id');
    }

}
