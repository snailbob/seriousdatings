<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsPricing extends Model
{

    protected $table = 'ads_pricings';

    protected $fillable = ['days', 'price'];

    protected $date = ['created_at', 'updated_by'];
}
