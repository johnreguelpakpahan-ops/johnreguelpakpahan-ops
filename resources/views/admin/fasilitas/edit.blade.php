@extends('layouts.admin')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Fasilitas & Layanan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Fasilitas</label>
                <input type="text" name="nama" class="form-control" value="{{ $fasilitas->nama }}" required>
            </div>

            <div class="mb-3">
                <label>Geosite <span class="text-danger">*</span></label>
                <select name="geosite_id" class="form-control" required>
                    <option value="">-- Pilih Geosite --</option>
                    @foreach($geositeList as $g)
                        <option value="{{ $g->id }}" {{ old('geosite_id', $fasilitas->geosite_id) == $g->id ? 'selected' : '' }}>
                            {{ $g->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ $fasilitas->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Harga / Keterangan</label>
                <input type="text" name="harga" class="form-control" value="{{ $fasilitas->harga }}">
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                @if($fasilitas->gambar)
                    @php $imgUrl = !str_starts_with($fasilitas->gambar, 'data:') ? asset('storage/' . $fasilitas->gambar) : ''; @endphp
                    <img src="{{ $imgUrl ?: $fasilitas->gambar }}" width="100">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
                <input type="file" name="gambar" class="form-control mt-2" accept="image/*">
            </div>

            <div class="mb-3">
                <label>Link Referensi <small class="text-muted">(opsional — isi jika gambar diambil dari website lain)</small></label>
                <input type="url" name="link_referensi" class="form-control"
                       placeholder="https://sumber-gambar.com/..."
                       value="{{ old('link_referensi', $fasilitas->link_referensi) }}">
            </div>

            <div class="mb-3">
                <input type="checkbox" name="status" value="1" {{ $fasilitas->status ? 'checked' : '' }}> Aktifkan
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
