<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class UserBlog extends Model
{
	use SoftDeletes;
	protected $fillable = [
		'admin_id', 
		'user_id',
		'blog_type_id', 
		'blog_status_id',
		'blog_category_id', 
		'blogTitle',
		'blogContent', 
		'blogImage', 
		'blogby',
	];

	protected $date = ['created_at', 'updated_at', 'deleted_at'];

	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString();
	}


	public function blogStatus()
	{
		return $this->belongsTo('App\BlogStatus');
	}

	public function blogCategory()
	{
		return $this->belongsTo('App\BlogCategory');
	}

	public function blogType()
	{
		return $this->belongsTo('App\BlogType');
	}
}
