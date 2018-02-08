<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_methods';
    
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable=[
            'user_id',
            'plan_id',
            'customer_id',
            'admin_paused',
            'gateway',
            'details',
            'payment_details'
        ];
    
        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        //protected $hidden = ['password', 'remember_token'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function datingPlan()
    {
        return $this->belongsTo('App\DatingPlan', 'plan_id', 'id');
    }


    public function getDetailsAttribute($value)
    {
        return unserialize($value);
    }

}
