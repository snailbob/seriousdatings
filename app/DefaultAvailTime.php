<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultAvailTime extends Model
{


	protected $table = 'user_default_availability_appoinmenttime';
	protected $fillable = ['def_id',
						  'def_timeFrom',
						  'def_timeTo',
						  'def_time',
						  'def_created'];

}
