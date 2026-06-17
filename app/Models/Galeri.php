<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Geosite;
class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';
    protected $fillable = ['judul', 'kategori', 'deskripsi', 'gambar', 'link_referensi', 'lokasi', 'tanggal_foto', 'geosite_id', 'status'];
   

    public function geosite()
    {
        return $this->belongsTo(Geosite::class);
    }
}