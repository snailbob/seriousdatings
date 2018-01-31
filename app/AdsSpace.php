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

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'days', 'paid', 'link', 'fb_link', 'skype_link', 'twitter_link', 'business_name', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
