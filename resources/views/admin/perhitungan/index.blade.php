@extends('admin.layouts.app')

@section('title', 'Data Perhitungan')
@section('page_title', 'Data Perhitungan')

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
    .section-body { padding: 0; }
    .spk-table { width: 100%; border-collapse: collapse; }
    .spk-table thead tr { background: #7a4f35 !important; }
    .spk-table thead th {
        color: #fff !important;
        background: #7a4f35 !important;
        padding: 9px 12px;
        font-size: .82rem;
        font-weight: 600;
        text-align: center;
        border: none;
    }
    .spk-table thead th:first-child { text-align: center; width: 50px; }
    .spk-table thead th:nth-child(2) { text-align: left; }
    .spk-table tbody tr:nth-child(even) { background: #fdf6f0; }
    .spk-table tbody tr:hover { background: #f5ede6; }
    .spk-table tbody td {
        padding: 8px 12px;
        font-size: .83rem;
        border-bottom: 1px solid #f0e6dc;
        text-align: center;
        color: #374151;
    }
    .spk-table tbody td:nth-child(2) { text-align: left; }
    .spk-table tbody tr:last-child td { border-bottom: none; }
    .alert-warn {
        background: #fff7ed; border: 1px solid #fed7aa; color: #9a3412;
        padding: 10px 14px; border-radius: 8px; font-size: .83rem; margin-bottom: 16px;
    }
    .empty-state { color: #9ca3af; font-size: .88rem; padding: 16px; }
    .page-header { display:flex; align-items:center; gap:10px; margin-bottom:18px; }
    .page-header h2 { margin:0; font-size:1.1rem; }
</style>

<div class="page-header">
    <i class="fa-solid fa-table-cells" style="font-size:1.2rem;color:#5a3825;"></i>
    <h2>Data Perhitungan</h2>
</div>

@if($kriterias->isEmpty())
    <p class="empty-state"><i class="fa-solid fa-triangle-exclamation"></i> Belum ada data kriteria. <a href="{{ route('admin.kriteria.create') }}">Tambah kriteria</a>.</p>
@elseif($alternatifs->isEmpty())
    <p class="empty-state"><i class="fa-solid fa-triangle-exclamation"></i> Belum ada data alternatif. <a href="{{ route('admin.alternatif.create') }}">Tambah alternatif</a>.</p>
@else

@if($tidakLengkap)
    <div class="alert-warn">
        <i class="fa-solid fa-triangle-exclamation"></i>
        Beberapa alternatif belum memiliki nilai lengkap.
        <a href="{{ route('admin.alternatif.index') }}">Lengkapi nilai</a> agar hasil akurat.
    </div>
@endif

{{-- TABEL 1: Nilai Kriteria Alternatif --}}
<div class="section-box">
    <div class="section-header"><i class="fa-solid fa-table-list"></i> Nilai Kriteria Alternatif</div>
    <div class="section-body" style="overflow-x:auto;">
        <table class="spk-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alternatif</th>
                    @foreach($kriterias as $k)
                        <th>{{ $k->kode }}<br><small style="font-weight:400;opacity:.8;">{{ $k->nama_kriteria }}</small></th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($alternatifs as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $a->nama_alternatif }}</td>
                    @foreach($kriterias as $k)
                        <td>
                            @if($matriksNilai[$a->id][$k->id] !== null)
                                {{ number_format($matriksNilai[$a->id][$k->id], 0) }}
                            @else
                                <span style="color:#f97316;">-</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- TABEL 2: Normalisasi Bobot --}}
<div class="section-box">
    <div class="section-header"><i class="fa-solid fa-scale-balanced"></i> Normalisasi Bobot Kriteria</div>
    <div class="section-body" style="overflow-x:auto;">
        <table class="spk-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kriteria</th>
                    <th>Tipe</th>
                    <th>Bobot Awal (%)</th>
                    <th>Normalisasi (W<sub>j</sub>)</th>
                </tr>
            </thead>
            <tbody>
            @foreach($normalisasi as $i => $n)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="text-align:left;">{{ $n['kode'] }} — {{ $n['nama'] }}</td>
                    <td>
                        <span style="padding:2px 8px;border-radius:999px;font-size:.75rem;font-weight:600;
                            background:{{ $n['tipe']==='Benefit'?'#dcfce7':'#fee2e2' }};
                            color:{{ $n['tipe']==='Benefit'?'#166534':'#b91c1c' }};">
                            {{ $n['tipe'] }}
                        </span>
                    </td>
                    <td>{{ number_format($n['bobot_awal'], 0) }}%</td>
                    <td><strong>{{ number_format($n['normalisasi'], 4) }}</strong></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- TABEL 3: Utility --}}
<div class="section-box">
    <div class="section-header"><i class="fa-solid fa-calculator"></i> Nilai Utility</div>
    <div class="section-body" style="overflow-x:auto;">
        <table class="spk-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alternatif</th>
                    @foreach($kriterias as $k)
                        <th>Utility {{ $k->kode }}<br><small style="font-weight:400;opacity:.8;">{{ $k->nama_kriteria }}</small></th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($alternatifs as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $a->nama_alternatif }}</td>
                    @foreach($kriterias as $k)
                        <td>
                            @if(isset($matriksUtility[$a->id][$k->id]) && $matriksUtility[$a->id][$k->id] !== null)
                                {{ number_format($matriksUtility[$a->id][$k->id], 4) }}
                            @else
                                <span style="color:#f97316;">-</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endif
@endsection
