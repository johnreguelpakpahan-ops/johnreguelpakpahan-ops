<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function informasi()
    {
        return $this->hasMany(Informasi::class);
    }

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class);
    }

    public function penginapan()
    {
        return $this->hasMany(Penginapan::class);
    }

    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }
}
