<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index()
    {
        $umkm = Umkm::with('geosite')->orderBy('geosite_id')->orderBy('nama')->paginate(10);
        return view('admin.umkm.index', compact('umkm'));
    }

    public function create()
    {
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.umkm.create', compact('geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'lokasi'     => 'nullable|string|max:255',
            'kontak'     => 'nullable|string|max:255',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'nama'           => $request->nama,
            'deskripsi'      => $request->deskripsi,
            'lokasi'         => $request->lokasi,
            'kontak'         => $request->kontak,
            'geosite_id'     => $request->geosite_id,
            'link_referensi' => $request->link_referensi,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('umkm', 'public');
        }

        Umkm::create($data);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $umkm        = Umkm::findOrFail($id);
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.umkm.edit', compact('umkm', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'lokasi'     => 'nullable|string|max:255',
            'kontak'     => 'nullable|string|max:255',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'nama'           => $request->nama,
            'deskripsi'      => $request->deskripsi,
            'lokasi'         => $request->lokasi,
            'kontak'         => $request->kontak,
            'geosite_id'     => $request->geosite_id,
            'link_referensi' => $request->link_referensi,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            if ($umkm->gambar && !str_starts_with($umkm->gambar, 'data:')) {
                Storage::disk('public')->delete($umkm->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('umkm', 'public');
        }

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil diupdate!');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);

        if ($umkm->gambar && !str_starts_with($umkm->gambar, 'data:')) {
            Storage::disk('public')->delete($umkm->gambar);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $umkm         = Umkm::findOrFail($id);
        $umkm->status = !$umkm->status;
        $umkm->save();

        return response()->json(['success' => true, 'status' => $umkm->status]);
    }
}
