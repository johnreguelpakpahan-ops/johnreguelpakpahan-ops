@extends('layouts.admin')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Fasilitas & Layanan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Nama Fasilitas</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Geosite <span class="text-danger">*</span></label>
                <select name="geosite_id" class="form-control" required>
                    <option value="">-- Pilih Geosite --</option>
                    @foreach($geositeList as $g)
                        <option value="{{ $g->id }}" {{ old('geosite_id') == $g->id ? 'selected' : '' }}>
                            {{ $g->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label>Harga / Keterangan (contoh: Gratis untuk pengunjung)</label>
                <input type="text" name="harga" class="form-control">
            </div>

            <div class="mb-3">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label>Link Referensi <small class="text-muted">(opsional — isi jika gambar diambil dari website lain)</small></label>
                <input type="url" name="link_referensi" class="form-control"
                       placeholder="https://sumber-gambar.com/..." value="{{ old('link_referensi') }}">
            </div>

            <div class="mb-3">
                <input type="checkbox" name="status" value="1" checked> Aktifkan
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
