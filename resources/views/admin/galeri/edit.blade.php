@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<style>
    .preview-image { max-width: 200px; border-radius: 8px; }
    .current-image { border: 2px solid #c6a43b; padding: 5px; display: inline-block; }
</style>

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit me-2"></i> Edit Galeri</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control"
                        value="{{ old('judul', $galeri->judul) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control">
                        <option value="tuktuk" {{ $galeri->kategori=='tuktuk'?'selected':'' }}>tuktuk</option>
                        <option value="Ambarita" {{ $galeri->kategori=='Ambarita'?'selected':'' }}>Ambarita</option>
                        <option value="Tomok" {{ $galeri->kategori=='Tomok'?'selected':'' }}>Tomok</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required>{{ $galeri->deskripsi }}</textarea>
                </div>

                 <div class="col-md-12 mb-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    @if($galeri->gambar)
                        <div class="mb-2">
                            @php $imgUrl = !str_starts_with($galeri->gambar, 'data:') ? asset('storage/' . $galeri->gambar) : ''; @endphp
                            <img src="{{ $imgUrl ?: $galeri->gambar }}" style="max-width: 150px; border-radius: 8px;">
                        </div>
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                    
                    <label class="form-label mt-2">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" 
                           accept="image/jpeg,image/png,image/jpg" id="inputGambar">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    <div class="preview-container mt-2" id="previewContainer" style="display: none;">
                        <label>Preview Gambar Baru:</label>
                        <img id="previewImage" class="preview-image" style="max-width: 200px; border-radius: 8px;">
                    </div>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                        value="{{ $galeri->lokasi }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_foto" class="form-control"
                        value="{{ $galeri->tanggal_foto }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Link Referensi</label>
                    <input type="url" name="link_referensi" class="form-control"
                           placeholder="https://sumber-gambar.com/..."
                           value="{{ old('link_referensi', $galeri->link_referensi) }}">
                    <small class="text-muted">Opsional — isi jika gambar diambil dari website lain</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Geosite <span class="text-danger">*</span></label>
                    <select name="geosite_id" class="form-control" required>
                        <option value="">-- Pilih Geosite --</option>
                        @foreach($geositeList as $g)
                            <option value="{{ $g->id }}" {{ old('geosite_id', $galeri->geosite_id) == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <input type="checkbox" name="status" value="1"
                        {{ $galeri->status ? 'checked' : '' }}> Aktif
                </div>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
document.getElementById('inputGambar').addEventListener('change', function(e){
    const reader = new FileReader();
    reader.onload = function(event){
        const img = document.getElementById('previewImage');
        img.src = event.target.result;
        img.style.display = 'block';
    }
    reader.readAsDataURL(e.target.files[0]);
});
</script>
@endsection