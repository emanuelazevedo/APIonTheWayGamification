<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    //
    protected $fillable = ['state', 'score' ,'user_id', 'mission_id'];
}
