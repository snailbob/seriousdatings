<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefinableFlirt extends Model
{
	use SoftDeletes;
	
	protected $table = 'definable_flirt';

	protected $fillable = ['name', 'content'];

	protected $date = ['created_at', 'updated_at', 'deleted_at'];
}
