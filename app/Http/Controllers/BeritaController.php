<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::where('status', true)->latest()->paginate(9);
        return view('pages.berita', compact('berita'));
    }

    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $berita->increment('views');

        return view('pages.berita-detail', compact('berita'));
    }
}