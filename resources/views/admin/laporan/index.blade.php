@extends('admin.layouts.app')

@section('title', 'Laporan Penjualan')
@section('page_title', 'Laporan Penjualan')

@section('content')
<div class="card" style="margin-bottom: 25px; border-top: 4px solid #c8a882;">
    <div style="font-size: 1.1rem; font-weight: 800; margin-bottom: 20px; color: #5a3825; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-magnifying-glass"></i> Filter Laporan
    </div>
    <form action="{{ route('admin.laporan.index') }}" method="GET" style="display: flex; align-items: flex-end; gap: 20px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 200px;">
            <label for="start_date" style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 5px; display: block;">Tanggal Awal</label>
            <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="form-control" style="border-radius: 10px; border: 1px solid #e5e7eb; padding: 10px;">
        </div>
        <div style="flex: 1; min-width: 200px;">
            <label for="end_date" style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 5px; display: block;">Tanggal Akhir</label>
            <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="form-control" style="border-radius: 10px; border: 1px solid #e5e7eb; padding: 10px;">
        </div>
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 10px; font-weight: 700;">
                <i class="fa-solid fa-filter"></i> Filter
            </button>
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 10px; font-weight: 700; background: #fff; border: 1px solid #e5e7eb; color: #4b5563;">
                <i class="fa-solid fa-rotate-right"></i> Reset
            </a>
        </div>
    </form>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
        <div style="font-size: 1.1rem; font-weight: 800; color: #5a3825; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-chart-line"></i> Data Penjualan
        </div>
        
        <div style="display: flex; align-items: center; gap: 15px;">
            @if(count($laporans) > 0)
                <a href="{{ route('admin.laporan.export-pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="btn btn-danger" style="padding: 10px 20px; border-radius: 10px; font-weight: 700; background: #dc2626; color: #fff;">
                    <i class="fa-solid fa-file-pdf"></i> Export PDF
                </a>
            @else
                <button class="btn btn-secondary" disabled style="padding: 10px 20px; border-radius: 10px; font-weight: 700; cursor: not-allowed; opacity: 0.6;">
                    <i class="fa-solid fa-file-pdf"></i> Export PDF
                </button>
            @endif

            <div style="background: #fdf6f0; padding: 10px 20px; border-radius: 12px; border: 1px solid #f5ede6; display: flex; flex-direction: column; align-items: flex-end;">
                <span style="font-size: 0.7rem; color: #8B5E3C; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Total Pendapatan</span>
                <span style="font-size: 1.3rem; font-weight: 900; color: #2C1A0E;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
        <thead>
            <tr>
                <th style="background: #f9fafb; border: none; padding: 15px; border-radius: 10px 0 0 10px; color: #6b7280; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">No</th>
                <th style="background: #f9fafb; border: none; padding: 15px; color: #6b7280; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">Tanggal</th>
                <th style="background: #f9fafb; border: none; padding: 15px; color: #6b7280; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">Pelanggan</th>
                <th style="background: #f9fafb; border: none; padding: 15px; color: #6b7280; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">Pembayaran</th>
                <th style="background: #f9fafb; border: none; padding: 15px; color: #6b7280; font-weight: 700; text-transform: uppercase; font-size: 0.75rem;">Status</th>
                <th style="background: #f9fafb; border: none; padding: 15px; border-radius: 0 10px 10px 0; color: #6b7280; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $index => $laporan)
                <tr>
                    <td style="padding: 15px; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-weight: 600;">{{ $index + 1 }}</td>
                    <td style="padding: 15px; border-bottom: 1px solid #f3f4f6; color: #374151; font-weight: 600;">{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding: 15px; border-bottom: 1px solid #f3f4f6;">
                        <strong style="color: #111827;">{{ $laporan->nama ?? ($laporan->user->name ?? '-') }}</strong>
                    </td>
                    <td style="padding: 15px; border-bottom: 1px solid #f3f4f6;">
                        @php
                            $pembayaranColor = $laporan->status_pembayaran === 'Sudah Bayar' ? 'background:#dcfce7;color:#166534;' : 'background:#fee2e2;color:#991b1b;';
                        @endphp
                        <span style="{{ $pembayaranColor }}padding:4px 12px;border-radius:20px;font-size:.72rem;font-weight:700;display: inline-flex; align-items: center; gap: 5px;">
                            <i class="fa-solid {{ $laporan->status_pembayaran === 'Sudah Bayar' ? 'fa-check-circle' : 'fa-clock' }}"></i> {{ $laporan->status_pembayaran }}
                        </span>
                    </td>
                    <td style="padding: 15px; border-bottom: 1px solid #f3f4f6;">
                        @php
                            $statusColor = match($laporan->status) {
                                'Pending'  => 'background:#fef9c3;color:#854d0e;',
                                'Diproses' => 'background:#dbeafe;color:#1d4ed8;',
                                'Dikirim'  => 'background:#e0f2fe;color:#0369a1;',
                                'Selesai'  => 'background:#dcfce7;color:#166534;',
                                default    => 'background:#f3f4f6;color:#4b5563;',
                            };
                            $statusIcon = match($laporan->status) {
                                'Pending'  => 'fa-pause-circle',
                                'Diproses' => 'fa-spinner fa-spin',
                                'Dikirim'  => 'fa-truck-fast',
                                'Selesai'  => 'fa-circle-check',
                                default    => 'fa-circle-question',
                            };
                        @endphp
                        <span style="{{ $statusColor }}padding:4px 12px;border-radius:20px;font-size:.72rem;font-weight:700;display: inline-flex; align-items: center; gap: 5px;">
                            <i class="fa-solid {{ $statusIcon }}"></i> {{ $laporan->status }}
                        </span>
                    </td>
                    <td style="padding: 15px; border-bottom: 1px solid #f3f4f6; text-align: right; font-weight: 800; color: #8B5E3C; font-size: 1rem;">
                        Rp {{ number_format($laporan->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
                        <i class="fa-solid fa-folder-open" style="font-size: 2rem; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                        Tidak ada data laporan untuk periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    .form-control:focus {
        border-color: #c8a882;
        outline: none;
        box-shadow: 0 0 0 3px rgba(200, 168, 130, 0.2);
    }
    .btn i { margin-right: 5px; }
    tr:hover td { background: #f9fafb; }
</style>
@endsection
