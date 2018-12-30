<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Course Teachers
    public function users() {
        return $this->belongsToMany('App\User');
    }

    // Course Groups
    public function groups(){
        return $this->belongsToMany('App\Group');
    }

    // Course Lessons
    public function lessons() {
        return $this->hasMany('App\Lesson');
    }




    public static function getCourses(){
        $courses = array();
        if(auth()->user()->isAdmin()){
            $courses = Course::all();
        }
        else if(auth()->user()->isTeacher()){
            $courses = auth()->user()->courses;
        }
        else{
            $groups = auth()->user()->groups;
            foreach($groups as $g){
                foreach($g->courses as $c){
                    array_push($courses, $c);
                }
            }
             
        }
        return $courses;
    }

    
}
