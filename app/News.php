<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function scopeSearch($query, $s){
        return $query->where('title', 'like', '%'.$s.'%')->orWhere('content', 'like', '%'.$s.'%');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
    
}
