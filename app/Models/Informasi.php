<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Geosite;
class Informasi extends Model
{
    protected $table = 'informasi';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'link_referensi',
        'geosite_id',
        'status',
        
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($informasi) {
            $informasi->slug = static::generateUniqueSlug($informasi->judul);
        });
        
        static::updating(function ($informasi) {
            $informasi->slug = static::generateUniqueSlug($informasi->judul, $informasi->id);
        });
    }

    private static function generateUniqueSlug(string $judul, ?int $excludeId = null): string
    {
        $base  = \Illuminate\Support\Str::slug($judul);
        $slug  = $base;
        $count = 1;

        while (
            static::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
   

        public function geosite()
        {
            return $this->belongsTo(Geosite::class);
        }
}