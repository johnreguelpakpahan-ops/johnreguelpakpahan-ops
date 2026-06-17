<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Geosite;
class Penginapan extends Model
{
    use HasFactory;

    protected $table = 'penginapan';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'link_referensi',
        'harga',
        'kontak',
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
