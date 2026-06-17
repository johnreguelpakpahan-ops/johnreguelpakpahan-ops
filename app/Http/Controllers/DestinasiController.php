<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;

class DestinasiController extends Controller
{
    public function indexX()
    {
        return view('pages.home');
    }

    public function index()
    {
        return view('destinasi.index');
    }

    private function showKategori(string $kategoriNama, string $deskripsi)
    {
        $destinasi = Destinasi::where('kategori', $kategoriNama)
            ->where('status', true)
            ->get();

        return view('destinasi.kategori', compact('destinasi'))
            ->with('kategori', $kategoriNama)
            ->with('deskripsi', $deskripsi);
    }

    public function alam()
    {
        return $this->showKategori(
            'Alam',
            'Destinasi wisata alam yang menampilkan keindahan geologi, pegunungan, air terjun, dan keunikan alam Danau Toba.'
        );
    }

    public function buatan()
    {
        return $this->showKategori(
            'Buatan',
            'Destinasi wisata buatan manusia yang menjadi ikon dan daya tarik wisata di kawasan Danau Toba.'
        );
    }

    public function budaya()
    {
        return $this->showKategori(
            'Budaya',
            'Destinasi wisata budaya yang menampilkan kearifan lokal, adat istiadat, dan warisan leluhur Batak Toba.'
        );
    }

    public function detail(string $slug)
    {
        $destinasi = Destinasi::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('destinasi.detail', compact('destinasi'));
    }
}