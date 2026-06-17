@extends('layouts.admin')

@section('title', 'Edit Destinasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">✏️ Edit Destinasi</h5>
    <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.destinasi.update', $destinasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                {{-- Nama --}}
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nama Destinasi <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $destinasi->nama) }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Kategori --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat }}"
                                {{ old('kategori', $destinasi->kategori) == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Lokasi --}}
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                           value="{{ old('lokasi', $destinasi->lokasi) }}" required>
                    @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- URL --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">URL Detail</label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                           value="{{ old('url', $destinasi->url) }}">
                    @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" rows="4"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              required>{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Tags --}}
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Tags</label>
                    <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror"
                           value="{{ old('tags', is_array($destinasi->tags) ? implode(', ', $destinasi->tags) : '') }}"
                           placeholder="Pisahkan dengan koma, misal: Goa Alami, Caving, Geologi">
                    <div class="form-text">Pisahkan setiap tag dengan tanda koma (,)</div>
                    @error('tags') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="status" id="status"
                               {{ old('status', $destinasi->status) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="status">Aktif / Tampilkan</label>
                    </div>
                </div>

                {{-- Gambar --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Gambar Utama</label>
                    {{-- Preview gambar lama --}}
                    @if($destinasi->gambar_utama)
                        <div class="mb-2">
                            <p class="text-muted small mb-1">Gambar saat ini:</p>
                            @php $imgUrl = !str_starts_with($destinasi->gambar_utama, 'data:') ? asset('storage/' . $destinasi->gambar_utama) : ''; @endphp
                            <img src="{{ $imgUrl ?: $destinasi->gambar_utama }}" alt="{{ $destinasi->nama }}"
                                 style="max-height:150px; border-radius:8px; border:1px solid #dee2e6;">
                        </div>
                    @endif
                    <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*"
                           class="form-control @error('gambar_utama') is-invalid @enderror"
                           onchange="previewImage(this)">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar. Format: JPG, PNG, WEBP. Maks 5 MB.</div>
                    @error('gambar_utama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div id="imagePreview" class="mt-2" style="display:none;">
                        <p class="text-muted small mb-1">Gambar baru:</p>
                        <img id="previewImg" src="" alt="Preview"
                             style="max-height:200px; border-radius:8px; border:1px solid #dee2e6;">
                    </div>
                </div>

                {{-- Link Referensi --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Link Referensi <small class="text-muted fw-normal">(opsional — isi jika gambar diambil dari website lain)</small></label>
                    <input type="url" name="link_referensi" class="form-control"
                           placeholder="https://sumber-gambar.com/..."
                           value="{{ old('link_referensi', $destinasi->link_referensi) }}">
                </div>

                {{-- Geosite --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Geosite <span class="text-danger">*</span></label>
                    <select name="geosite_id" class="form-select" required>
                        <option value="">-- Pilih Geosite --</option>
                        @foreach($geositeList as $g)
                            <option value="{{ $g->id }}" {{ old('geosite_id', $destinasi->geosite_id) == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.destinasi.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const img     = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            img.src    = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
