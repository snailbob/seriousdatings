<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCategory extends Model
{
    protected $table = "gift_category";
    protected $fillable = [
        'name',
        'deletable'
        ];
    protected $date = ['created_at', 'updated_at'];



    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    public function giftCard(){
        return $this->hasMany('App\GiftCard', 'gift_category_id');
    }
}
