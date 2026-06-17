<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\Geosite;
class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'link_referensi',
        'harga',
        'geosite_id',
        'status',
       
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
    

    public function geosite()
    {
        return $this->belongsTo(Geosite::class);
    }
}
