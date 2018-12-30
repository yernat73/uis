<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // Students
    public function users() {
        return $this->belongsToMany('App\User');
    }

    // Group Courses
    public function courses() {
        return $this->belongsToMany('App\Course');
    
    }
}
