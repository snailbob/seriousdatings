<?php 

namespace App;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = ['name'];

	protected $dates = ['created_at', 'updated_at'];

	public function role()
	{
		return $this->belongsTo('App\GroupUser');
	}

	public function user()
	{
		return $this->hasMany('App\User', 'role', 'id');
	}
}