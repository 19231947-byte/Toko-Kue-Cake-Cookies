@extends('admin.layouts.app')

@section('title', 'Pesan Masuk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Pesan Masuk</h4>
    <span class="badge bg-primary">{{ $pesans->total() }} pesan</span>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Subjek</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesans as $pesan)
                <tr class="{{ $pesan->status === 'belum_dibaca' ? 'fw-semibold' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesan->nama }}</td>
                    <td>{{ $pesan->no_telepon }}</td>
                    <td>{{ Str::limit($pesan->subjek, 40) }}</td>
                    <td>{{ $pesan->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        @if($pesan->status === 'belum_dibaca')
                            <span class="badge bg-warning text-dark">Belum Dibaca</span>
                        @else
                            <span class="badge bg-success">Sudah Dibaca</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.pesan-kontak.show', $pesan) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                        <form action="{{ route('admin.pesan-kontak.destroy', $pesan) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada pesan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $pesans->links() }}</div>
@endsection
