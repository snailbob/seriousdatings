<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailabilityApp extends Model
{
   



    protected  $table = 'user_appointment_availability';

    protected  $fillable = [ 
						   	'av_id',
						  	'av_user_id',
						  	'av_user_date',
						  	'av_user_times',
						  	'av_status',
						  	'create_at',
						  	'updated_at',
						  	'deleted_at' ];

    protected $dates = ['deleted_at', 'create_at', 'updated_at'];
}
