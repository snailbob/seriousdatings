<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadDateAnswers extends Model
{

    protected $table = 'read_date_answers';
    
        protected $fillable = [
            'user_id',
            'question_id',
            'answer',
        ];
    
        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = [];

}
