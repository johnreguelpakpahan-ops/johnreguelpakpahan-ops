@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #3b82f6;">
            <div class="stat-number">{{ $totalGaleri ?? 0 }}</div>
            <div class="stat-label">Total Galeri</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #10b981;">
            <div class="stat-number">{{ $totalBerita ?? 0 }}</div>
            <div class="stat-label">Total Berita</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #f59e0b;">
            <div class="stat-number">{{ $totalInformasi ?? 0 }}</div>
            <div class="stat-label">Total Informasi</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #ef4444;">
            <div class="stat-number">{{ $totalViews ?? 0 }}</div>
            <div class="stat-label">Total Views</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card-table">
            <h5>Berita Terbaru</h5>
            <table class="table">
                <thead>
                    <tr><th>Judul</th><th>Tanggal</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Berita::latest()->limit(5)->get() as $item)
                    <tr>
                        <td>{{ Str::limit($item->judul, 40) }}</td>
                        <td>{{ $item->tanggal_terbit->format('d/m/Y') }}</td>
                        <td>@if($item->status)<span class="badge bg-success">Publish</span>@else<span class="badge bg-danger">Draft</span>@endif</td>
                        <td><a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card-table">
            <h5>Aksi Cepat</h5>
            <div class="row g-2">
                <div class="col-6"><a href="{{ route('admin.galeri.create') }}" class="btn btn-primary w-100"><i class="fas fa-plus"></i> Galeri</a></div>
                <div class="col-6"><a href="{{ route('admin.berita.create') }}" class="btn btn-primary w-100"><i class="fas fa-plus"></i> Berita</a></div>
                <div class="col-6"><a href="{{ route('admin.informasi.create') }}" class="btn btn-primary w-100"><i class="fas fa-plus"></i> Informasi</a></div>
                <div class="col-6"><a href="{{ url('/') }}" target="_blank" class="btn btn-secondary w-100"><i class="fas fa-globe"></i> Website</a></div>
            </div>
        </div>
    </div>
</div>
@endsection