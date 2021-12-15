<?php

namespace App;
use App\Timeslot;

use Illuminate\Database\Eloquent\Model;

class Approvedappointment extends Model
{
    protected $fillable = [
        'timeslot_id' ,
        'councilour_name' ,
         ];
}
