<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogType extends Model
{
	protected $table = 'blog_type';
	
	protected $fillable = [
		'name', 
	];

	public $timestamps = false;

	public function userBlog()
	{
		return $this->hasMany('App\UserBlog');
	}
}
