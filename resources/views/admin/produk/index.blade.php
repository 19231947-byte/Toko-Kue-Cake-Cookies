@extends('admin.layouts.app')

@section('title', 'Kelola Produk')
@section('page_title', 'Produk')

@section('content')
@php use Illuminate\Support\Str; @endphp

@if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
@endif

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
    <h2 style="margin:0;font-size:1.1rem;">Daftar Produk</h2>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Varian</th>
            <th style="width:150px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($produks as $index => $produk)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" 
                         onerror="this.onerror=null;this.src='{{ asset('frontend/assets/img/' . $produk->gambar) }}';"
                         style="width:55px;height:55px;object-fit:cover;border-radius:8px;"
                         alt="{{ $produk->nama_produk }}">
                @else
                    <span style="font-size:12px;color:#999;">-</span>
                @endif
            </td>
            <td>
                <div style="font-weight:600;">{{ $produk->nama_produk }}</div>
                <div style="font-size:0.78rem;color:#6b7280;">{{ Str::limit($produk->deskripsi, 40) }}</div>
            </td>
            <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
            <td>{{ $produk->stok }}</td>
            <td>
                @if($produk->varians->count())
                    <span style="font-size:0.78rem;">
                        @foreach($produk->varians as $v)
                            <span style="display:inline-block;background:#f3f4f6;border-radius:4px;padding:2px 6px;margin:1px;font-size:0.75rem;">
                                {{ $v->nama_varian }}
                            </span>
                        @endforeach
                    </span>
                @else
                    <span style="color:#9ca3af;font-size:0.78rem;">-</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST"
                      style="display:inline;" onsubmit="return confirm('Hapus produk ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" style="text-align:center;color:#9ca3af;">Belum ada produk.</td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection
