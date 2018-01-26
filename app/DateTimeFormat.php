<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateTimeFormat extends Model
{
    protected $table = "date_time_format";

    protected  $fillable  = ['date', 'time'];

    public $timestamps = false;
}
