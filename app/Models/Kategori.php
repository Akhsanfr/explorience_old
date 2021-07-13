<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    public $guarded = [];
    public function artikels(){
        return $this->hasMany(Artikel::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }

}
