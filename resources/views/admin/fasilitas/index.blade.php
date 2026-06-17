@extends('layouts.admin')

@section('title', 'Manajemen Fasilitas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">🏗️ Daftar Fasilitas & Layanan</h5>
    <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Fasilitas
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
                    <th>Nama</th>
                    <th>Geosite</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fasilitas as $item)
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
                    <td>{{ $item->nama }}</td>
                    <td><span class="badge bg-info">{{ $item->geosite?->nama ?? '-' }}</span></td>
                    <td>{{ $item->harga ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $item->status ? 'Aktif' : 'Tidak' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.fasilitas.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">Belum ada data Fasilitas</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $fasilitas->links() }}
    </div>
</div>
@endsection
