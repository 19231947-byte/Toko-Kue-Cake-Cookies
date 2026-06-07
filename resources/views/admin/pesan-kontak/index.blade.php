@extends('admin.layouts.app')

@section('title', 'Pesan Masuk')

@section('page_title', 'Pesan Masuk')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
    <h2 style="margin:0; font-size:1.1rem;">Daftar Pesan Masuk</h2>
    <span style="background:#2563eb; color:#fff; padding:4px 12px; border-radius:20px; font-size:0.75rem; font-weight:700;">
        {{ $pesans->total() }} Pesan
    </span>
</div>

@if(session('success'))
    <div class="flash-success" style="background:#dcfce7; color:#166534; padding:10px 15px; border-radius:8px; margin-bottom:15px; font-weight:600;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<div class="card" style="padding:0; overflow:hidden;">
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th style="width:50px; text-align:center;">No</th>
                <th>Nama Pengirim</th>
                <th>No. Telepon</th>
                <th>Subjek</th>
                <th>Tanggal</th>
                <th style="text-align:center;">Status</th>
                <th style="width:160px; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesans as $pesan)
            <tr style="{{ $pesan->status === 'belum_dibaca' ? 'background: #fdf6f0;' : '' }}">
                <td style="text-align:center; color:#6b7280;">{{ ($pesans->currentPage()-1) * $pesans->perPage() + $loop->iteration }}</td>
                <td>
                    <div style="font-weight:600; color:#374151;">{{ $pesan->nama }}</div>
                    <div style="font-size:0.75rem; color:#9ca3af;">{{ $pesan->email ?? '-' }}</div>
                </td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->no_telepon) }}" target="_blank" style="text-decoration:none; color:#16a34a; font-weight:600;">
                        {{ $pesan->no_telepon }}
                    </a>
                </td>
                <td>
                    <div style="font-size:0.88rem; color:#4b5563;">{{ Str::limit($pesan->subjek, 35) }}</div>
                </td>
                <td style="color:#6b7280; font-size:0.82rem;">
                    {{ $pesan->created_at->format('d M Y') }}<br>
                    <small>{{ $pesan->created_at->format('H:i') }} WIB</small>
                </td>
                <td style="text-align:center;">
                    @if($pesan->status === 'belum_dibaca')
                        <span style="background:#fef9c3; color:#854d0e; padding:4px 10px; border-radius:20px; font-size:0.72rem; font-weight:700; text-transform:uppercase;">Belum Dibaca</span>
                    @else
                        <span style="background:#dcfce7; color:#166534; padding:4px 10px; border-radius:20px; font-size:0.72rem; font-weight:700; text-transform:uppercase;">Sudah Dibaca</span>
                    @endif
                </td>
                <td style="text-align:center;">
                    <a href="{{ route('admin.pesan-kontak.show', $pesan) }}" class="btn btn-secondary" style="padding:5px 12px; font-size:0.75rem; background:#fff; border:1px solid #e5e7eb;">
                        <i class="fa-solid fa-eye"></i> Lihat
                    </a>
                    <form action="{{ route('admin.pesan-kontak.destroy', $pesan) }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding:5px 12px; font-size:0.75rem;">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:40px; color:#9ca3af;">
                    <i class="fa-solid fa-envelope-open fa-3x" style="display:block; margin-bottom:10px; opacity:0.3;"></i>
                    Belum ada pesan masuk.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:15px;">
    {{ $pesans->links() }}
</div>
@endsection
