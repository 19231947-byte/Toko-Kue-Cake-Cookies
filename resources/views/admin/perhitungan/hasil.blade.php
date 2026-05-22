@extends('admin.layouts.app')

@section('title', 'Data Hasil Akhir')
@section('page_title', 'Data Hasil Akhir')

@section('content')
<style>
    .section-box {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 12px rgba(15,23,42,.07);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .section-header {
        background: #5a3825;
        color: #fff;
        padding: 10px 16px;
        font-size: .85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .hasil-table { width: 100%; border-collapse: collapse; }
    .hasil-table thead tr { background: #7a4f35 !important; }
    .hasil-table thead th {
        color: #fff !important;
        background: #7a4f35 !important;
        padding: 10px 16px;
        font-size: .85rem;
        font-weight: 600;
        text-align: left;
        border: none;
    }
    .hasil-table thead th:last-child,
    .hasil-table thead th:nth-child(2) { text-align: center; }
    .hasil-table tbody tr:nth-child(even) { background: #fdf6f0; }
    .hasil-table tbody tr:hover { background: #f5ede6; }
    .hasil-table tbody td {
        padding: 9px 16px;
        font-size: .84rem;
        border-bottom: 1px solid #f0e6dc;
        color: #374151;
    }
    .hasil-table tbody td:nth-child(2),
    .hasil-table tbody td:nth-child(3) { text-align: center; }
    .hasil-table tbody tr:last-child td { border-bottom: none; }
    .rank-1 td { background: #fef9c3 !important; font-weight: 700; }
    .rank-2 td { background: #f3f4f6 !important; }
    .rank-3 td { background: #fff7ed !important; }
    .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; }
    .page-header h2 { margin:0; font-size:1.1rem; display:flex; align-items:center; gap:8px; }
    .btn-cetak {
        background: #5a3825; color: #fff; border: none;
        padding: 8px 18px; border-radius: 8px; font-size: .85rem;
        font-weight: 600; cursor: pointer; display:flex; align-items:center; gap:6px;
        text-decoration: none;
    }
    .btn-cetak:hover { background: #7a4f35; }
    .empty-state { color: #9ca3af; font-size: .88rem; padding: 16px; }

    @media print {
        .sidebar, .topbar, .btn-cetak, .page-header .btn-cetak { display: none !important; }
        .layout { display: block !important; }
        .content { width: 100% !important; }
        .main { padding: 0 !important; }
        body { background: #fff !important; }
        .section-box { box-shadow: none !important; border: 1px solid #ddd; }
        .print-header { display: block !important; }
    }
</style>

<div class="page-header">
    <h2><i class="fa-solid fa-ranking-star" style="color:#5a3825;"></i> Data Hasil Akhir</h2>
    @if(!empty($nilaiAkhir))
        <button class="btn-cetak" onclick="cetakPDF()"><i class="fa-solid fa-print"></i> Cetak PDF</button>
    @endif
</div>

{{-- Print header (hanya muncul saat print) --}}
<div class="print-header" style="display:none; text-align:center; margin-bottom:20px;">
    <h3 style="margin:0;">Hasil Akhir Perankingan Metode SMART</h3>
    <p style="margin:4px 0 0; font-size:.85rem; color:#555;">Ayasha Cake & Cookies — {{ now()->format('d F Y') }}</p>
    <hr style="margin:10px 0;">
</div>

@if(empty($nilaiAkhir))
    <p class="empty-state"><i class="fa-solid fa-triangle-exclamation"></i> Belum ada data untuk dihitung. Pastikan kriteria, alternatif, dan nilai sudah diisi.</p>
@else
<div class="section-box">
    <div class="section-header"><i class="fa-solid fa-trophy"></i> Hasil Akhir Perankingan</div>
    <table class="hasil-table">
        <thead>
            <tr>
                <th>Nama Alternatif</th>
                <th>Nilai Akhir</th>
                <th>Rank</th>
            </tr>
        </thead>
        <tbody>
        @php $rank = 1; @endphp
        @foreach($nilaiAkhir as $altId => $nilai)
            @php
                $alt      = $alternatifs->firstWhere('id', $altId);
                $rowClass = $rank === 1 ? 'rank-1' : ($rank === 2 ? 'rank-2' : ($rank === 3 ? 'rank-3' : ''));
            @endphp
            @if($alt)
            <tr class="{{ $rowClass }}">
                <td>{{ $alt->nama_alternatif }}</td>
                <td>{{ number_format($nilai, 4) }}</td>
                <td>{{ $rank }}</td>
            </tr>
            @php $rank++; @endphp
            @endif
        @endforeach
        </tbody>
    </table>
</div>
@endif

<script>
function cetakPDF() {
    window.print();
}
</script>
@endsection
