@extends('admin.layouts.app')

@section('title', 'Detail Pesan')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.pesan-kontak.index') }}" class="btn btn-sm btn-outline-secondary">
        &larr; Kembali
    </a>
    <h4 class="mb-0">Detail Pesan</h4>
</div>

<div class="card" style="max-width:700px;">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr>
                <td style="width:140px;color:#888;font-size:.88rem;">Nama</td>
                <td><strong>{{ $pesanKontak->nama }}</strong></td>
            </tr>
            <tr>
                <td style="color:#888;font-size:.88rem;">No. Telepon</td>
                <td>{{ $pesanKontak->no_telepon }}</td>
            </tr>
            <tr>
                <td style="color:#888;font-size:.88rem;">Email</td>
                <td>{{ $pesanKontak->email ?? '-' }}</td>
            </tr>
            <tr>
                <td style="color:#888;font-size:.88rem;">Subjek</td>
                <td>{{ $pesanKontak->subjek }}</td>
            </tr>
            <tr>
                <td style="color:#888;font-size:.88rem;">Tanggal</td>
                <td>{{ $pesanKontak->created_at->format('d M Y, H:i') }}</td>
            </tr>
            <tr>
                <td style="color:#888;font-size:.88rem;">Status</td>
                <td>
                    @if($pesanKontak->status === 'sudah_dibaca')
                        <span class="badge bg-success">Sudah Dibaca</span>
                    @else
                        <span class="badge bg-warning text-dark">Belum Dibaca</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="color:#888;font-size:.88rem;vertical-align:top;">Pesan</td>
                <td style="white-space:pre-line;">{{ $pesanKontak->pesan }}</td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex gap-2">
        <form action="{{ route('admin.pesan-kontak.destroy', $pesanKontak) }}" method="POST"
              onsubmit="return confirm('Hapus pesan ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus Pesan</button>
        </form>
    </div>
</div>
@endsection
