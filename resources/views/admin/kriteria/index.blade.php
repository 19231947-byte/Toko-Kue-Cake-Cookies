@extends('admin.layouts.app')

@section('title', 'Kelola Kriteria')
@section('page_title', 'Kriteria')

@section('content')
    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <h2 style="margin:0;font-size:1.1rem;">Daftar Kriteria</h2>
        <a href="{{ route('admin.kriteria.create') }}" class="btn btn-primary">+ Tambah Kriteria</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Kriteria</th>
                <th>Tipe</th>
                <th>Bobot (%)</th>
                <th style="width:160px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($kriterias as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->kode }}</strong></td>
                <td>{{ $item->nama_kriteria }}</td>
                <td>
                    <span style="padding:2px 10px;border-radius:999px;font-size:.78rem;font-weight:600;
                        background:{{ $item->tipe === 'Benefit' ? '#dcfce7' : '#fee2e2' }};
                        color:{{ $item->tipe === 'Benefit' ? '#166534' : '#b91c1c' }};">
                        {{ $item->tipe }}
                    </span>
                </td>
                <td>{{ number_format($item->bobot, 0) }}%</td>
                <td>
                    <a href="{{ route('admin.kriteria.edit', $item) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('admin.kriteria.destroy', $item) }}" method="POST"
                          style="display:inline;" onsubmit="return confirm('Hapus kriteria ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada kriteria.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
