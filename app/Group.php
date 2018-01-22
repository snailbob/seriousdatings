<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'created_by_id', 'role_id'];

	protected $date = ['created_at', 'updated_at', 'deleted_at'];

	public function role()
	{
		return $this->belongsTo('App\Role');
	}

	public function users()
	{
		return $this->belongsToMany('App\User', 'groups_users', 'group_id', 'user_id' );
	}

}
