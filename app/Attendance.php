<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function lesson()
    {
        $this->belongsTo('App\Lesson');
    }
    public function user(){
        $this->belongsTo('App\User');
    }
}
