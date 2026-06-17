<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('geosite')->latest()->paginate(10);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.galeri.create', compact('geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'geosite_id' => 'required|exists:geosite,id',
        ]);

        $data = [
            'judul'          => $request->judul,
            'kategori'       => $request->kategori,
            'deskripsi'      => $request->deskripsi,
            'lokasi'         => $request->lokasi,
            'tanggal_foto'   => $request->tanggal_foto,
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Data berhasil ditambah!');
    }

    public function edit($id)
    {
        $galeri      = Galeri::findOrFail($id);
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.galeri.edit', compact('galeri', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'geosite_id' => 'required|exists:geosite,id',
        ]);

        $galeri = Galeri::findOrFail($id);

        $data = [
            'judul'          => $request->judul,
            'kategori'       => $request->kategori,
            'deskripsi'      => $request->deskripsi,
            'lokasi'         => $request->lokasi,
            'tanggal_foto'   => $request->tanggal_foto,
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && !str_starts_with($galeri->gambar, 'data:')) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && !str_starts_with($galeri->gambar, 'data:')) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Data dihapus!');
    }

    public function toggleStatus($id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->status = !$galeri->status;
        $galeri->save();

        return response()->json(['success' => true, 'status' => $galeri->status]);
    }
}