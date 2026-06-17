<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sejarah extends Model
{
    protected $table = 'sejarah';

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

        static::creating(function ($sejarah) {
            $sejarah->slug = static::generateUniqueSlug($sejarah->judul);
        });

        static::updating(function ($sejarah) {
            $sejarah->slug = static::generateUniqueSlug($sejarah->judul, $sejarah->id);
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
