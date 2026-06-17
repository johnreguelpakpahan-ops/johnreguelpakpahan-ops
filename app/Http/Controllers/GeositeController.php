<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Sejarah;
use App\Models\Penginapan;
use App\Models\Fasilitas;
use App\Models\Geosite;

class GeositeController extends Controller
{
    /**
     * Helper: ambil data berdasarkan nama geosite
     */
    private function geositeData(string $keyword): array
    {
        $geosite = Geosite::whereRaw(
            'LOWER(nama) LIKE ?',
            ['%' . strtolower($keyword) . '%']
        )->first();

        $geositeId = $geosite?->id;

        return [
             'sejarah' => $geositeId
                ? Sejarah::where('geosite_id', $geositeId)
                    ->where('status', true)
                    ->get()
                : collect(),
        
            'umkm' => $geositeId
                ? Umkm::where('geosite_id', $geositeId)
                    ->where('status', true)
                    ->get()
                : collect(),

            'penginapan' => $geositeId
                ? Penginapan::where('geosite_id', $geositeId)
                    ->where('status', true)
                    ->get()
                : collect(),

            'fasilitas' => $geositeId
                ? Fasilitas::where('geosite_id', $geositeId)
                    ->where('status', true)
                    ->get()
                : collect(),
        ];
    }



public function tuktuk()
{
    $data = $this->geositeData('tuktuk');

    return view('geosite.Tuktuk', $data);
}

public function ambarita()
{
    $data = $this->geositeData('ambarita');

    return view('geosite.Ambarita', $data);
}

public function tomok()
{
    $data = $this->geositeData('tomok');

    return view('geosite.Tomok', $data);
}
}