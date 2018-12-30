<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
    //Admin news
    public function news(){
        return $this->hasMany('App\News');
    }


    //Teacher courses
    public function courses() {
        return $this->belongsToMany('App\Course');
    
    }


    //Student groups
    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function marks() {
        return $this->hasMany('App\Mark');
    }

    public function isAdmin()
    {
        if ($this->role->name == 'admin')
        {
            return true;
        } 
    }
    public function isTeacher()
    {
        if ($this->role->name == 'teacher')
        {
            return true;
        } 
    }
    public function isStudent()
    {
        if ($this->role->name == 'student')
        {
            return true;
        } 
    }
}
