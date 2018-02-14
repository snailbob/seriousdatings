<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatNew extends Model
{

	  protected $table = 'chat_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['c_from', 'c_to', 'c_message','c_chatroom','c_status'];

}
