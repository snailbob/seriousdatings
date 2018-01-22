<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = ['name'];

	protected $date = ['created_at', 'updated_at', 'deleted_at'];

	// public function userBlog()
	// {
	// 	return $this->hasMany('App\UserBlog');
	// }
}
