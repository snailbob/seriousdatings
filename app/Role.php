<?php 

namespace App;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = ['name'];

	protected $date = ['created_at', 'updated_at', 'deleted_at'];

	public function role()
	{
		return $this->hasMany('App\Group');
	}
}