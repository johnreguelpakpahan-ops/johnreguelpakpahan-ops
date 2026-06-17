<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function umkm()
    {
        return view('pages.umkm');
    }

    public function budaya()
    {
        return view('pages.budaya');
    }
}
