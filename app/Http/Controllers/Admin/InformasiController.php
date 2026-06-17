<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::orderBy('updated_at', 'asc')->paginate(10);
        return view('admin.informasi.index', compact('informasi'));
    }

    public function create()
    {
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.informasi.create', compact('geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'konten'     => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
           
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean'
        ]);

        $data = [
            'judul'          => $request->judul,
            'konten'         => $request->konten,
           
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('informasi', 'public');
        }

        Informasi::create($data);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $informasi   = Informasi::findOrFail($id);
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.informasi.edit', compact('informasi', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $request->validate([
            'judul'      => 'required|string|max:255',
            'konten'     => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean'
        ]);

        $data = [
            'judul'          => $request->judul,
            'konten'         => $request->konten,
            
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0
        ];

        if ($request->hasFile('gambar')) {
            if ($informasi->gambar && !str_starts_with($informasi->gambar, 'data:')) {
                Storage::disk('public')->delete($informasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('informasi', 'public');
        }

        $informasi->update($data);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

        if ($informasi->gambar && !str_starts_with($informasi->gambar, 'data:')) {
            Storage::disk('public')->delete($informasi->gambar);
        }

        $informasi->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Data berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->status = !$informasi->status;
        $informasi->save();

        return response()->json(['success' => true, 'status' => $informasi->status]);
    }
}