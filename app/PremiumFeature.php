<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumFeature extends Model
{
    protected $table = "premium_features";
    protected $fillable = ['feature'];
    protected $date = ['created_at', 'updated_at'];



}
