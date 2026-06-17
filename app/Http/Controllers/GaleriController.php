<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
//use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $allGaleri = Galeri::where('status', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $galeriByKategori = $allGaleri->groupBy('kategori');

        // Tambahkan ini
        $allPhotos = $allGaleri->map(function ($item) {
            return [
                'src' => asset('storage/' . $item->gambar),
                'judul' => $item->judul,
                'deskripsi' => $item->deskripsi,
                'kategori' => $item->kategori,
                'lokasi' => $item->lokasi ?? 'Danau Toba',
            ];
        });

        return view('pages.galeri', compact(
            'galeriByKategori',
            'allPhotos'
        ));
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->increment('views');

        return view('pages.galeri-detail', compact('galeri'));
    }
}