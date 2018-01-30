<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogSubscription extends Model
{
    protected $table = 'blog_subscription';

    protected $fillable = [
        'email',
    ];

    public $timestamps = false;

}
