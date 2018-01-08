<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadyDateQuestions extends Model
{

    protected $table = 'ready_date_questions';

    protected $fillable = [
        'type',
        'question',
        'continuetext',
        'lowest_text',
        'middle_text',
        'highest_text'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
