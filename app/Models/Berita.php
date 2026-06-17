<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Geosite;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'sumber_gambar',
        'link_referensi',
        'geosite_id',
        'penulis',
        'views',
        'status',
        
    ];

    protected $casts = [
        'status' => 'boolean',
        'views'  => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            $berita->slug = static::generateUniqueSlug($berita->judul);
        });

        static::updating(function ($berita) {
            $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
        });
    }

    private static function generateUniqueSlug(string $judul, ?int $excludeId = null): string
    {
        $base  = Str::slug($judul);
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