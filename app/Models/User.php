<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'avatar',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi dengan role user(team)
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // Relasi dengan kategori writer
    public function kategoris(){
        return $this->belongsToMany(Kategori::class);
    }
    // Relas dengan artikel
    public function artikels(){
        return $this->hasMany(Artikel::class, 'writer_id');
    }

    // Cek Role User for middleware
    public function hasRole($role){
        return in_array($role ,$this->roles->pluck('nama')->toArray());
    }
}
