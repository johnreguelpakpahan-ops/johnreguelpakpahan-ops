@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">📰 Daftar Berita</h5>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Berita
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Geosite</th>
                    <th>Penulis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($berita as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->gambar)
                            @php $imgUrl = !str_starts_with($item->gambar, 'data:') ? asset('storage/' . $item->gambar) : ''; @endphp
                            <div style="position:relative;display:inline-block;">
                                <img src="{{ $imgUrl ?: $item->gambar }}" width="50" height="50" style="object-fit: cover; display:block;">
                            </div>

                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->judul }}</td>
                    <td><span class="badge bg-info">{{ $item->geosite?->nama ?? '-' }}</span></td>
                    <td>{{ $item->penulis ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $item->status ? 'Aktif' : 'Tidak' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">Belum ada berita</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $berita->links() }}
    </div>
</div>
@endsection