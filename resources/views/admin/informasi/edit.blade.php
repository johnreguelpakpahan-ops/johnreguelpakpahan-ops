@extends('layouts.admin')

@section('title', 'Edit Sejarah Caldera Toba')

@section('content')
<div class="d-flex align-items-center mb-3">
    <a href="{{ route('admin.informasi.index') }}" class="btn btn-sm btn-secondary me-2">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h5 class="mb-0">Edit Data Sejarah</h5>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label required">Judul</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                           value="{{ old('judul', $informasi->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Urutan</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" 
                           value="{{ old('urutan', $informasi->urutan) }}" required>
                    <small class="text-muted">Semakin kecil angka, semakin atas tampilannya</small>
                    @error('urutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    @if($informasi->gambar)
                        <div class="mb-2">
                            @php $imgUrl = !str_starts_with($informasi->gambar, 'data:') ? asset('storage/' . $informasi->gambar) : ''; @endphp
                            <img src="{{ $imgUrl ?: $informasi->gambar }}" style="max-width: 150px; border-radius: 8px;">
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
                
                <div class="col-12 mb-3">
                    <label class="form-label required">Konten</label>
                    <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                              rows="10" required>{{ old('konten', $informasi->konten) }}</textarea>
                    @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">Link Referensi <small class="text-muted">(opsional — isi jika gambar/konten diambil dari website lain)</small></label>
                    <input type="url" name="link_referensi" class="form-control"
                           placeholder="https://sumber.com/..."
                           value="{{ old('link_referensi', $informasi->link_referensi) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Geosite <span class="text-danger">*</span></label>
                    <select name="geosite_id" class="form-control" required>
                        <option value="">-- Pilih Geosite --</option>
                        @foreach($geositeList as $g)
                            <option value="{{ $g->id }}" {{ old('geosite_id', $informasi->geosite_id) == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" value="1" 
                               id="statusCheck" {{ old('status', $informasi->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusCheck">
                            <i class="fas fa-check-circle text-success me-1"></i> Aktifkan
                        </label>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Update
                </button>
                <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('inputGambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImage.src = event.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endsection