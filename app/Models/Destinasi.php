<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Geosite;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasis';

    protected $fillable = [
        'nama',
        'slug',
        'lokasi',
        'deskripsi',
        'gambar_utama',
        'tags',
        'kategori',
        'link_referensi',
        'geosite_id',
        'status',
        
    ];

    protected $casts = [
        'tags'   => 'array',
        'status' => 'boolean',
    ];

  
    public function geosite()
    {
        return $this->belongsTo(Geosite::class);
    }
}