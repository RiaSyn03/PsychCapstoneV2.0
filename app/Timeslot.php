<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $fillable = [
        'id' ,
        'user_fname', 
        'user_idnum',
        'time',
        'date',
         ];
}
