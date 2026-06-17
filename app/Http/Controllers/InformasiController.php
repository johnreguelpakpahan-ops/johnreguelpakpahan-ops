<?php

namespace App\Http\Controllers;

use App\Models\Informasi;

class InformasiController extends Controller
{
    public function index()
    {
        $sejarahList = Informasi::where('status', 1)
            ->orderBy('id', 'asc')
            ->get();
        
        return view('pages.informasi', compact('sejarahList'));
    }
}