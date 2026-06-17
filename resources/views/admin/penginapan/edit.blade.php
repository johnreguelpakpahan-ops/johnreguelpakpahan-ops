@extends('layouts.admin')

@section('title', 'Edit Penginapan')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Penginapan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.penginapan.update', $penginapan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Penginapan</label>
                <input type="text" name="nama" class="form-control" value="{{ $penginapan->nama }}" required>
            </div>

            <div class="mb-3">
                <label>Geosite <span class="text-danger">*</span></label>
                <select name="geosite_id" class="form-control" required>
                    <option value="">-- Pilih Geosite --</option>
                    @foreach($geositeList as $g)
                        <option value="{{ $g->id }}" {{ old('geosite_id', $penginapan->geosite_id) == $g->id ? 'selected' : '' }}>
                            {{ $g->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ $penginapan->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" value="{{ $penginapan->harga }}">
            </div>

            <div class="mb-3">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" value="{{ $penginapan->kontak }}">
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                @if($penginapan->gambar)
                    @php $imgUrl = !str_starts_with($penginapan->gambar, 'data:') ? asset('storage/' . $penginapan->gambar) : ''; @endphp
                    <img src="{{ $imgUrl ?: $penginapan->gambar }}" width="100">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
                <input type="file" name="gambar" class="form-control mt-2" accept="image/*">
            </div>

            <div class="mb-3">
                <label>Link Referensi <small class="text-muted">(opsional — isi jika gambar diambil dari website lain)</small></label>
                <input type="url" name="link_referensi" class="form-control"
                       placeholder="https://sumber-gambar.com/..."
                       value="{{ old('link_referensi', $penginapan->link_referensi) }}">
            </div>

            <div class="mb-3">
                <input type="checkbox" name="status" value="1" {{ $penginapan->status ? 'checked' : '' }}> Aktifkan
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.penginapan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
