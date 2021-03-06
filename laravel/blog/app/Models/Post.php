<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // public $fillable = ['title', 'resumen','body'];

    public $guarded = ['id'];

    //Evita pasar parametro en slug web
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //hasOne , hasMany, belongsTo, belongsToMany

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
