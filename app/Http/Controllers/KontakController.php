<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KontakMail;

class KontakController extends Controller
{
    public function index()
    {
        return view('pages.kontak');
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'telepon' => 'nullable|string|max:20',
            'subjek'  => 'required|string|max:100',
            'pesan'   => 'required|string|max:2000',
        ]);

        try {
            Mail::to(config('mail.from.address', 'tuktukambaritatomokgeosite@gmail.com'))->send(
                new KontakMail(
                    $request->nama,
                    $request->email,
                    $request->telepon ?? '-',
                    $request->subjek,
                    $request->pesan
                )
            );

            return back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan merespons segera.');
        } catch (\Exception $e) {
            return back()->withErrors(['pesan' => 'Gagal mengirim pesan: ' . $e->getMessage()])
                         ->withInput();
        }
    }
}