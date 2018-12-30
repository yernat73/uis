<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function course(){
        return $this->belongsTo('App\Course');
    }
    public function marks() {
        return $this->hasMany('App\Mark');
    }
    public function attendances() {
        return $this->hasMany('App\Attendance');
    }
}
