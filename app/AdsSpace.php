<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsSpace extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_spaces';

    protected $fillable = ['user_id', 'days', 'paid', 'link', 'business_name', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
