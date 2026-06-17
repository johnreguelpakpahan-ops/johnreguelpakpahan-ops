<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGaleri     = DB::table('galeri')->count();
        $totalBerita     = DB::table('berita')->count();
        $totalInformasi  = DB::table('informasi')->count();
        $totalDestinasi  = DB::table('destinasis')->count();
        $totalUmkm       = DB::table('umkm')->count();
        $totalPenginapan = DB::table('penginapan')->count();
        $totalFasilitas  = DB::table('fasilitas')->count();
        $totalSejarah    = DB::table('sejarah')->count();

       

        return view('admin.dashboard', compact(
            'totalGaleri', 'totalBerita', 'totalInformasi', 'totalDestinasi',
            'totalUmkm', 'totalPenginapan', 'totalFasilitas', 'totalSejarah',
        ));
    }
}
