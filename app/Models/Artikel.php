<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    public function writer(){
        return $this->belongsTo(User::class,'writer_id');
    }
    public function supervisor(){
        return $this->belongsTo(User::class,'supervisor_id');
    }
    public function komentars(){
        return $this->hasMany(Komentar::class);
    }
}
