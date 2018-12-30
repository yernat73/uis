<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->hasMany('App\User');
    }
    public static function roles() {
        return DB::table('roles')->get();
    }
    
}
