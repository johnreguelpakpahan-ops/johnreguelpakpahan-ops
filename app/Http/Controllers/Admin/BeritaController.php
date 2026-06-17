<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('geosite')->latest()->paginate(10);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.berita.create', compact('geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'penulis'        => 'nullable|string|max:100',
            'link_referensi' => 'nullable|url|max:500',
            'geosite_id'     => 'required|exists:geosite,id',
            'status'         => 'nullable|boolean'
        ]);

        $data = [
            'judul'          => $request->judul,
            'konten'         => $request->konten,
            'penulis'        => $request->penulis ?? 'Admin',
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita      = Berita::findOrFail($id);
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.berita.edit', compact('berita', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'penulis'        => 'nullable|string|max:100',
            'link_referensi' => 'nullable|url|max:500',
            'geosite_id'     => 'required|exists:geosite,id',
            'status'         => 'nullable|boolean'
        ]);

        $data = [
            'judul'          => $request->judul,
            'konten'         => $request->konten,
            'penulis'        => $request->penulis ?? 'Admin',
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0
        ];

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && !str_starts_with($berita->gambar, 'data:')) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && !str_starts_with($berita->gambar, 'data:')) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = !$berita->status;
        $berita->save();

        return response()->json(['success' => true, 'status' => $berita->status]);
    }
}