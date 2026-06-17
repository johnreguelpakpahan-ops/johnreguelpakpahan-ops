@extends('layouts.admin')

@section('title', 'Manajemen Destinasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">🗺️ Manajemen Destinasi</h5>
    <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Destinasi
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="40">No</th>
                        <th width="80">Gambar</th>
                        <th>Nama</th>
                        <th width="100">Kategori</th>
                        <th width="100">Geosite</th>
                        <th>Lokasi</th>
                        <th width="80">Status</th>
                        <th width="110">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinasi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($item->gambar_utama)
                                @php $imgUrl = !str_starts_with($item->gambar_utama, 'data:') ? asset('storage/' . $item->gambar_utama) : ''; @endphp
                                <div style="position:relative;display:inline-block;">
                                    <img src="{{ $imgUrl ?: $item->gambar_utama }}" width="60" height="60"
                                         style="object-fit: cover; border-radius: 8px; display:block;">
                                  
                                </div>

                            @else
                                <div class="bg-secondary text-white text-center"
                                     style="width:60px;height:60px;line-height:60px;border-radius:8px;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->nama }}</strong><br>
                            <small class="text-muted">{{ Str::limit($item->deskripsi, 70) }}</small>
                        </td>
                        <td>
                            @php
                                $badgeColor = match($item->kategori) {
                                    'Alam'   => 'success',
                                    'Buatan' => 'primary',
                                    'Budaya' => 'warning',
                                    default  => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }}">{{ $item->kategori }}</span>
                        </td>
                        <td><span class="badge bg-info">{{ $item->geosite?->nama ?? '-' }}</span></td>
                        <td><small>{{ $item->lokasi }}</small></td>
                        <td>
                            <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.destinasi.edit', $item->id) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.destinasi.destroy', $item->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus destinasi ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-map-marked-alt fa-2x text-muted mb-2 d-block"></i>
                            Belum ada destinasi. Silakan tambah data baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $destinasi->links() }}
        </div>
    </div>
</div>
@endsection
