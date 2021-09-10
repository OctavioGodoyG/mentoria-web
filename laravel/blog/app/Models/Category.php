<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Evita pasar parametro en slug web
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //hasOne , hasMany, belongsTo, belongsToMany
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
