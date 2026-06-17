@extends('layouts.admin')

@section('title', 'Edit UMKM')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit UMKM</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama UMKM</label>
                <input type="text" name="nama" class="form-control" value="{{ $umkm->nama }}" required>
            </div>

            <div class="mb-3">
                <label>Geosite <span class="text-danger">*</span></label>
                <select name="geosite_id" class="form-control" required>
                    <option value="">-- Pilih Geosite --</option>
                    @foreach($geositeList as $g)
                        <option value="{{ $g->id }}" {{ old('geosite_id', $umkm->geosite_id) == $g->id ? 'selected' : '' }}>
                            {{ $g->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ $umkm->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="{{ $umkm->lokasi }}">
            </div>

            <div class="mb-3">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" value="{{ $umkm->kontak }}">
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                @if($umkm->gambar)
                    @php $imgUrl = !str_starts_with($umkm->gambar, 'data:') ? asset('storage/' . $umkm->gambar) : ''; @endphp
                    <img src="{{ $imgUrl ?: $umkm->gambar }}" width="100">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
                <input type="file" name="gambar" class="form-control mt-2" accept="image/*">
            </div>

            <div class="mb-3">
                <label>Link Referensi <small class="text-muted">(opsional — isi jika gambar diambil dari website lain)</small></label>
                <input type="url" name="link_referensi" class="form-control"
                       placeholder="https://sumber-gambar.com/..."
                       value="{{ old('link_referensi', $umkm->link_referensi) }}">
            </div>

            <div class="mb-3">
                <input type="checkbox" name="status" value="1" {{ $umkm->status ? 'checked' : '' }}> Aktifkan
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
