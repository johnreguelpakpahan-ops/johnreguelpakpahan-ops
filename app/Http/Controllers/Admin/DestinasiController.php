<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Geosite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinasiController extends Controller
{
    private array $kategoriList = ['Alam', 'Buatan', 'Budaya'];

    public function index()
    {
        $destinasi = Destinasi::orderBy('kategori')->orderBy('nama')->paginate(10);
        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        $kategoriList = $this->kategoriList;
        $geositeList  = Geosite::orderBy('nama')->get();
        return view('admin.destinasi.create', compact('kategoriList', 'geositeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'lokasi'         => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'gambar_utama'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'tags'           => 'nullable|string',
            'kategori'       => 'required|in:Alam,Buatan,Budaya',
            'geosite_id'     => 'required|exists:geosite,id',
        ]);

        $slug = $this->generateUniqueSlug($request->nama);

        $data = [
            'nama'           => $request->nama,
            'slug'           => $slug,
            'lokasi'         => $request->lokasi,
            'deskripsi'      => $request->deskripsi,
            'tags'           => $this->parseTags($request->tags),
            'kategori'       => $request->kategori,
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar_utama')) {
            $data['gambar_utama'] = $request->file('gambar_utama')->store('destinasi', 'public');
        }

        Destinasi::create($data);

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $destinasi    = Destinasi::findOrFail($id);
        $kategoriList = $this->kategoriList;
        $geositeList  = Geosite::orderBy('nama')->get();
        return view('admin.destinasi.edit', compact('destinasi', 'kategoriList', 'geositeList'));
    }

    public function update(Request $request, $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $request->validate([
            'nama'         => 'required|string|max:255',
            'lokasi'       => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:6144',
            'tags'         => 'nullable|string',
            'kategori'     => 'required|in:Alam,Buatan,Budaya',
            'geosite_id'   => 'required|exists:geosite,id',
        ]);

        $slug = ($request->nama !== $destinasi->nama)
            ? $this->generateUniqueSlug($request->nama, $id)
            : $destinasi->slug;

        $data = [
            'nama'           => $request->nama,
            'slug'           => $slug,
            'lokasi'         => $request->lokasi,
            'deskripsi'      => $request->deskripsi,
            'tags'           => $this->parseTags($request->tags),
            'kategori'       => $request->kategori,
            'link_referensi' => $request->link_referensi,
            'geosite_id'     => $request->geosite_id,
            'status'         => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('gambar_utama')) {
            if ($destinasi->gambar_utama && !str_starts_with($destinasi->gambar_utama, 'data:')) {
                Storage::disk('public')->delete($destinasi->gambar_utama);
            }
            $data['gambar_utama'] = $request->file('gambar_utama')->store('destinasi', 'public');
        }

        $destinasi->update($data);

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        if ($destinasi->gambar_utama && !str_starts_with($destinasi->gambar_utama, 'data:')) {
            Storage::disk('public')->delete($destinasi->gambar_utama);
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')
            ->with('success', 'Destinasi berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $destinasi->status = !$destinasi->status;
        $destinasi->save();

        return response()->json(['success' => true, 'status' => $destinasi->status]);
    }

    private function parseTags(?string $tags): array
    {
        if (!$tags || trim($tags) === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $tags))));
    }

    private function generateUniqueSlug(string $nama, ?int $excludeId = null): string
    {
        $base  = Str::slug($nama);
        $slug  = $base;
        $count = 1;

        while (
            Destinasi::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
}
