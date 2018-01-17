<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointMent extends Model
{

    protected  $table = 'user_appointment';

    protected  $fillable = [ 'app_id',
                            'app_from',
                            'app_to',
                            'app_street',
                            'app_street_l2',
                            'app_city',
                            'app_state',
                            'app_zipcode',
                            'app_country',
                            'app_days',
                            'app_time',
                            'app_specdateTime',
                            'app_desc',
                            'app_status',
                            'app_created' ];

    protected $dates = ['deleted_at', 'create_at', 'updated_at'];


}
