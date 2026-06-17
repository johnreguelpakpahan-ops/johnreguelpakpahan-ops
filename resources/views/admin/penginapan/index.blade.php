@extends('layouts.admin')

@section('title', 'Manajemen Penginapan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">🏨 Daftar Penginapan</h5>
    <a href="{{ route('admin.penginapan.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Penginapan
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
                @forelse($penginapan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->gambar)
                            @php $imgUrl = !str_starts_with($item->gambar, 'data:') ? asset('storage/' . $item->gambar) : ''; @endphp
                            <div style="position:relative;display:inline-block;">
                                <img src="{{ $imgUrl ?: $item->gambar }}" width="50" height="50" style="object-fit: cover; display:block;">
                                @if($item->link_referensi)
                                    <a href="{{ $item->link_referensi }}" target="_blank"
                                       style="position:absolute;bottom:0;left:0;background:rgba(0,0,0,0.55);color:#fff;font-size:9px;padding:1px 4px;text-decoration:none;line-height:1.4;max-width:50px;overflow:hidden;white-space:nowrap;display:block;"
                                       title="{{ $item->link_referensi }}">🔗 src</a>
                                @endif
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
                        <a href="{{ route('admin.penginapan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.penginapan.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">Belum ada data Penginapan</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $penginapan->links() }}
    </div>
</div>
@endsection
