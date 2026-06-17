<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penginapan;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    public function index()
    {
        $penginapan = Penginapan::with('geosite')->orderBy('geosite_id')->orderBy('nama')->paginate(10);
        return view('admin.penginapan.index', compact('penginapan'));
    }

    public function create()
    {
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.penginapan.create', compact('geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'harga'      => 'nullable|string|max:100',
            'kontak'     => 'nullable|string|max:255',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'nama'           => $request->nama,
            'deskripsi'      => $request->deskripsi,
            'harga'          => $request->harga,
            'kontak'         => $request->kontak,
            'geosite_id'     => $request->geosite_id,
            'link_referensi' => $request->link_referensi,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('penginapan', 'public');
        }

        Penginapan::create($data);

        return redirect()->route('admin.penginapan.index')
            ->with('success', 'Penginapan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penginapan  = Penginapan::findOrFail($id);
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.penginapan.edit', compact('penginapan', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $penginapan = Penginapan::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'harga'      => 'nullable|string|max:100',
            'kontak'     => 'nullable|string|max:255',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'nama'           => $request->nama,
            'deskripsi'      => $request->deskripsi,
            'harga'          => $request->harga,
            'kontak'         => $request->kontak,
            'geosite_id'     => $request->geosite_id,
            'link_referensi' => $request->link_referensi,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            if ($penginapan->gambar && !str_starts_with($penginapan->gambar, 'data:')) {
                Storage::disk('public')->delete($penginapan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('penginapan', 'public');
        }

        $penginapan->update($data);

        return redirect()->route('admin.penginapan.index')
            ->with('success', 'Penginapan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $penginapan = Penginapan::findOrFail($id);

        if ($penginapan->gambar && !str_starts_with($penginapan->gambar, 'data:')) {
            Storage::disk('public')->delete($penginapan->gambar);
        }

        $penginapan->delete();

        return redirect()->route('admin.penginapan.index')
            ->with('success', 'Penginapan berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $penginapan         = Penginapan::findOrFail($id);
        $penginapan->status = !$penginapan->status;
        $penginapan->save();

        return response()->json(['success' => true, 'status' => $penginapan->status]);
    }
}
