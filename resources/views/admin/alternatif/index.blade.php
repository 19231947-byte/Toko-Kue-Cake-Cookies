@extends('admin.layouts.app')

@section('title', 'Data Alternatif')
@section('page_title', 'Data Alternatif')

@section('content')
    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <h2 style="margin:0;font-size:1.1rem;">Daftar Alternatif (Data Kue)</h2>
        <a href="{{ route('admin.alternatif.create') }}" class="btn btn-primary">+ Tambah Alternatif</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Alternatif</th>
                <th style="width:260px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($alternatifs as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->kode }}</strong></td>
                <td>{{ $item->nama_alternatif }}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:4px;flex-wrap:nowrap;">
                        <a href="{{ route('admin.alternatif.input-nilai', $item) }}" class="btn btn-primary">Input Nilai</a>
                        <a href="{{ route('admin.alternatif.lihat-nilai', $item) }}" class="btn btn-secondary">Lihat Nilai</a>
                        <a href="{{ route('admin.alternatif.edit', $item) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('admin.alternatif.destroy', $item) }}" method="POST"
                              style="margin:0;" onsubmit="return confirm('Hapus alternatif ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada data alternatif.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
