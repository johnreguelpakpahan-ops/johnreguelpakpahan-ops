<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::with('geosite')->paginate(10);
        return view('admin.sejarah.index', compact('sejarah'));
    }

    public function create()
    {
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.sejarah.create', compact('geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'konten'     => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'judul'          => $request->judul,
            'konten'         => $request->konten,
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sejarah', 'public');
        }

        Sejarah::create($data);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Data sejarah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sejarah     = Sejarah::findOrFail($id);
        $geositeList = Geosite::orderBy('nama')->get();
        return view('admin.sejarah.edit', compact('sejarah', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $sejarah = Sejarah::findOrFail($id);

        $request->validate([
            'judul'      => 'required|string|max:255',
            'konten'     => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'geosite_id' => 'required|exists:geosite,id',
            'status'     => 'nullable|boolean',
        ]);

        $data = [
            'judul'          => $request->judul,
            'konten'         => $request->konten,
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar')) {
            if ($sejarah->gambar && !str_starts_with($sejarah->gambar, 'data:')) {
                Storage::disk('public')->delete($sejarah->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sejarah', 'public');
        }

        $sejarah->update($data);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Data sejarah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $sejarah = Sejarah::findOrFail($id);

        if ($sejarah->gambar && !str_starts_with($sejarah->gambar, 'data:')) {
            Storage::disk('public')->delete($sejarah->gambar);
        }

        $sejarah->delete();

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Data sejarah berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        $sejarah->status = !$sejarah->status;
        $sejarah->save();

        return response()->json(['success' => true, 'status' => $sejarah->status]);
    }
}
