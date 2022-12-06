<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function department() {
        return $this->belongsTo('App\Department', 'dept_id', 'id');
    }
}
