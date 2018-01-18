<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogStatus extends Model
{
	protected $table = 'blog_status';

	protected $fillable = [
		'name', 
	];

	public $timestamps = false;

	public function userBlog()
	{
		return $this->hasMany('App\UserBlog', 'blog_status_id');
	}
}
