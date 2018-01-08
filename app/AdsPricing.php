<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsPricing extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_pricings';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['days', 'price'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];


}
