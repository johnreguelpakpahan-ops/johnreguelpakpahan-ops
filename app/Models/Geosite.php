<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geosite extends Model
{
    use HasFactory;

    protected $table = 'geosite';

    protected $fillable = ['nama', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Relasi ke semua tabel konten
    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function informasi()
    {
        return $this->hasMany(Informasi::class);
    }

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class);
    }

    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }

    public function penginapan()
    {
        return $this->hasMany(Penginapan::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function sejarah()
    {
        return $this->hasMany(Sejarah::class);
    }
}
