@extends('admin.layouts.app')

@section('title', 'Lihat Nilai')
@section('page_title', 'Data Alternatif')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <div>
            <h2 style="margin:0 0 2px;font-size:1.1rem;">Nilai Alternatif</h2>
            <p style="margin:0;font-size:.85rem;color:#6b7280;">
                {{ $alternatif->kode }} - {{ $alternatif->nama_alternatif }}
            </p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.alternatif.input-nilai', $alternatif) }}" class="btn btn-primary">Edit Nilai</a>
            <a href="{{ route('admin.alternatif.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Tipe</th>
                <th>Bobot (%)</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
        @forelse($penilaians as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->kriteria->kode }}</strong></td>
                <td>{{ $item->kriteria->nama_kriteria }}</td>
                <td>
                    <span style="padding:2px 10px;border-radius:999px;font-size:.78rem;font-weight:600;
                        background:{{ $item->kriteria->tipe === 'Benefit' ? '#dcfce7' : '#fee2e2' }};
                        color:{{ $item->kriteria->tipe === 'Benefit' ? '#166534' : '#b91c1c' }};">
                        {{ $item->kriteria->tipe }}
                    </span>
                </td>
                <td>{{ number_format($item->kriteria->bobot, 0) }}%</td>
                <td><strong>{{ number_format($item->nilai, 2) }}</strong></td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada nilai untuk alternatif ini. <a href="{{ route('admin.alternatif.input-nilai', $alternatif) }}">Input sekarang</a>.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
