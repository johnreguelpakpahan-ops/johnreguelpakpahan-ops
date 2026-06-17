<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::with('geosite')->orderBy('geosite_id')->orderBy('nama')->paginate(10);
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.fasilitas.create', compact('geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'harga'      => 'nullable|string|max:100',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'nama'           => $request->nama,
            'deskripsi'      => $request->deskripsi,
            'harga'          => $request->harga,
            'geosite_id'     => $request->geosite_id,
            'link_referensi' => $request->link_referensi,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        Fasilitas::create($data);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $fasilitas   = Fasilitas::findOrFail($id);
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.fasilitas.edit', compact('fasilitas', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'harga'      => 'nullable|string|max:100',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'nama'           => $request->nama,
            'deskripsi'      => $request->deskripsi,
            'harga'          => $request->harga,
            'geosite_id'     => $request->geosite_id,
            'link_referensi' => $request->link_referensi,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar && !str_starts_with($fasilitas->gambar, 'data:')) {
                Storage::disk('public')->delete($fasilitas->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $fasilitas->update($data);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diupdate!');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        if ($fasilitas->gambar && !str_starts_with($fasilitas->gambar, 'data:')) {
            Storage::disk('public')->delete($fasilitas->gambar);
        }

        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $fasilitas         = Fasilitas::findOrFail($id);
        $fasilitas->status = !$fasilitas->status;
        $fasilitas->save();

        return response()->json(['success' => true, 'status' => $fasilitas->status]);
    }
}
