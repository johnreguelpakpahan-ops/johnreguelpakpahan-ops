@extends('layouts.admin')

@section('title', 'Manajemen Sejarah Caldera Toba')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">📜 Sejarah Caldera Toba</h5>
    <a href="{{ route('admin.informasi.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Data
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
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th width="100">Gambar</th>
                        <th>Judul</th>
                        <th width="100">Geosite</th>
                        <th width="80">Urutan</th>
                        <th width="80">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($informasi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($item->gambar)
                                @php $imgUrl = !str_starts_with($item->gambar, 'data:') ? asset('storage/' . $item->gambar) : ''; @endphp
                                <div style="position:relative;display:inline-block;">
                                    <img src="{{ $imgUrl ?: $item->gambar }}" width="60" height="60" style="object-fit: cover; border-radius: 8px; display:block;">
                                </div>

                            @else
                                <div class="bg-secondary text-white text-center" style="width: 60px; height: 60px; line-height: 60px; border-radius: 8px;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->judul }}</strong>
                            <br>
                            <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                        </td>
                        <td><span class="badge bg-info">{{ $item->geosite?->nama ?? '-' }}</span></td>
                        <td>{{ $item->urutan }}</td>
                        <td>
                            <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.informasi.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.informasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-database fa-2x text-muted mb-2 d-block"></i>
                            Belum ada data. Silakan tambah data baru.
                        </span>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $informasi->links() }}
        </div>
    </div>
</div>
@endsection