@extends('admin.layouts.app')

@section('title', 'Daftar Pesanan')
@section('page_title', 'Pesanan')

@section('content')
    <h2 style="margin:0 0 10px;font-size:1.1rem;">Daftar Pesanan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>No HP</th>
                <th>Metode</th>
                <th>Total Harga</th>
                <th>Pembayaran</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanans as $index => $pesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pesanan->nama ?? '-' }}</td>
                    <td>{{ $pesanan->no_hp ? '+62'.$pesanan->no_hp : '-' }}</td>
                    <td>
                        @if($pesanan->metode_pengiriman === 'kirim')
                            <span style="background:#dbeafe;color:#1d4ed8;padding:2px 8px;border-radius:20px;font-size:.78rem;font-weight:600;">Kirim ke Rumah</span>
                        @else
                            <span style="background:#dcfce7;color:#166534;padding:2px 8px;border-radius:20px;font-size:.78rem;font-weight:600;">Ambil di Toko</span>
                        @endif
                    </td>
                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @php
                            $pembayaranColor = match($pesanan->status_pembayaran) {
                                'Sudah Bayar' => 'background:#dcfce7;color:#166534;',
                                default       => 'background:#fee2e2;color:#991b1b;',
                            };
                        @endphp
                        <span style="{{ $pembayaranColor }}padding:2px 8px;border-radius:20px;font-size:.78rem;font-weight:600;">
                            {{ $pesanan->status_pembayaran }}
                        </span>
                    </td>
                    <td>
                        @php
                            $statusColor = match($pesanan->status) {
                                'Pending'  => 'background:#fef9c3;color:#854d0e;',
                                'Diproses' => 'background:#dbeafe;color:#1d4ed8;',
                                'Dikirim'  => 'background:#e0f2fe;color:#0369a1;',
                                'Selesai'  => 'background:#dcfce7;color:#166534;',
                                default    => 'background:#f3f4f6;color:#4b5563;',
                            };
                        @endphp
                        <span style="{{ $statusColor }}padding:2px 8px;border-radius:20px;font-size:.78rem;font-weight:600;">
                            {{ $pesanan->status }}
                        </span>
                    </td>
                    <td>{{ $pesanan->created_at->format('d/m/Y H:i') }}</td>
                    <td><a href="{{ route('admin.pesanan.show', $pesanan) }}" class="btn btn-secondary">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="8">Belum ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
