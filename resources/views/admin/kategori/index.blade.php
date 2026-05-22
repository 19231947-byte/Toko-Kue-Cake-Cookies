@extends('admin.layouts.app')

@section('title', 'Kelola Kategori')
@section('page_title', 'Kategori')

@section('content')
    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <h2 style="margin:0;font-size:1.1rem;">Daftar Kategori</h2>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>
    <table>
        <thead><tr><th>No</th><th>Nama Kategori</th><th style="width:160px;">Aksi</th></tr></thead>
        <tbody>
        @forelse($kategoris as $index => $kategori)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>
                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kategori ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">Belum ada kategori.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection

