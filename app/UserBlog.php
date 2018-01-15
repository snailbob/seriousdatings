<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBlog extends Model
{
	protected $table = 'user_blogs';

	protected $fillable = ['template_name', 'template_subject', 'template_content'];

	protected $date = ['created_at', 'updated_at', 'deleted_at'];
}
