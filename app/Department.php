<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'dept_name',
    ];

    public function courses() {
        return $this->hasMany('App\Course', 'dept_id', 'id');
    }

}
