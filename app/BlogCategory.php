<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
	protected $table = 'blog_category';

	protected $fillable = ['name'];

	protected $date = ['created_at', 'updated_at', 'deleted_at'];

	public function userBlog()
	{
		return $this->hasMany('App\UserBlog');
	}
}
