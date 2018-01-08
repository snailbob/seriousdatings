<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutYourDate extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'about_your_date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     
    protected $fillable = [
        'relationshipGoal',
        'haveChildren',
        'whatIsTheLongestRelationshipYouHaveBeenIn',
        'partnerDependability',
        'sexualCompatibility',
        'friendshipBetweenPartners',
        'drugs',
        'hairColor',
        'hairStyle',
        'eyeColor',
        'height',
        'bodyType',
        'zodicSign',
        'smoke',
        'drink',
        'excercise',
        'excerciseSchedule',
        'educationLevel',
        'language',
        'ethnicity',
        'religiousBeliefs',
        'income',
        'hairColor',
        'gender',
        'zipcode',
        'tatoos',
        'relationshipStatus',
        'wantKids',
        'rangeOfMiles',
        'age_from',
        'age_to',
        'user_id',
        'motherBorn',
        'fatherBorn',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
