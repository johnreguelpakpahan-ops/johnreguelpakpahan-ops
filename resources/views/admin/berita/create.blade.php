@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" value="Admin">
            </div>
            
            <div class="mb-3">
                <label>Konten</label>
                <textarea name="konten" class="form-control" rows="10" required></textarea>
            </div>
            
            <div class="mb-3">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label>Link Referensi <small class="text-muted">(opsional — isi jika gambar/konten diambil dari website lain)</small></label>
                <input type="url" name="link_referensi" class="form-control"
                       placeholder="https://contoh.com/artikel/..." value="{{ old('link_referensi') }}">
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
                <input type="checkbox" name="status" value="1" checked> Aktifkan
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection