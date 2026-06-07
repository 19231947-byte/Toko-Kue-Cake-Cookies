@extends('admin.layouts.app')

@section('title', 'Detail Pesan')

@section('page_title', 'Detail Pesan')

@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.pesan-kontak.index') }}" class="btn btn-secondary" style="background:#fff; border:1px solid #e5e7eb; padding:8px 16px; font-weight:600; color:#4b5563;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div style="display:grid; grid-template-columns: 1fr; gap:20px; max-width:800px;">
    <div class="card" style="padding:25px;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:25px; border-bottom:1px solid #f3f4f6; padding-bottom:15px;">
            <div>
                <h3 style="margin:0 0 5px; color:#111827; font-size:1.25rem;">{{ $pesanKontak->subjek }}</h3>
                <div style="color:#6b7280; font-size:0.88rem;">
                    <i class="fa-solid fa-calendar-day"></i> {{ $pesanKontak->created_at->format('d F Y, H:i') }} WIB
                </div>
            </div>
            <div>
                @if($pesanKontak->status === 'sudah_dibaca')
                    <span style="background:#dcfce7; color:#166534; padding:5px 15px; border-radius:20px; font-size:0.75rem; font-weight:700; text-transform:uppercase;">Sudah Dibaca</span>
                @else
                    <span style="background:#fef9c3; color:#854d0e; padding:5px 15px; border-radius:20px; font-size:0.75rem; font-weight:700; text-transform:uppercase;">Belum Dibaca</span>
                @endif
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px; margin-bottom:30px; background:#f9fafb; padding:20px; border-radius:12px;">
            <div>
                <label style="color:#9ca3af; font-size:0.75rem; font-weight:700; text-transform:uppercase; margin-bottom:5px;">Nama Pengirim</label>
                <div style="font-weight:600; color:#374151;">{{ $pesanKontak->nama }}</div>
            </div>
            <div>
                <label style="color:#9ca3af; font-size:0.75rem; font-weight:700; text-transform:uppercase; margin-bottom:5px;">Email</label>
                <div style="color:#374151;">{{ $pesanKontak->email ?? '-' }}</div>
            </div>
            <div>
                <label style="color:#9ca3af; font-size:0.75rem; font-weight:700; text-transform:uppercase; margin-bottom:5px;">No. Telepon / WhatsApp</label>
                <div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesanKontak->no_telepon) }}" target="_blank" style="text-decoration:none; color:#16a34a; font-weight:700; display:inline-flex; align-items:center; gap:5px;">
                        {{ $pesanKontak->no_telepon }}
                    </a>
                </div>
            </div>
        </div>

        <div style="margin-bottom:30px;">
            <label style="color:#9ca3af; font-size:0.75rem; font-weight:700; text-transform:uppercase; margin-bottom:10px; display:block;">Isi Pesan</label>
            <div style="background:#fff; border:1px solid #f3f4f6; padding:20px; border-radius:12px; line-height:1.7; color:#4b5563; white-space:pre-line; font-size:0.95rem;">
                {{ $pesanKontak->pesan }}
            </div>
        </div>

        <div style="border-top:1px solid #f3f4f6; padding-top:20px; display:flex; justify-content:flex-end;">
            <form action="{{ route('admin.pesan-kontak.destroy', $pesanKontak) }}" method="POST"
                  onsubmit="return confirm('Hapus pesan ini secara permanen?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger" style="padding:10px 20px; font-weight:600; display:inline-flex; align-items:center; gap:8px;">
                    <i class="fa-solid fa-trash-can"></i> Hapus Pesan Ini
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
