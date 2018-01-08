<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeMovies extends Model
{
    protected $table = 'like_movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['email', 'password'];

    protected $fillable = ['user_id', 'movies'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
