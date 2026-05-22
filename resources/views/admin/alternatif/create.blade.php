@extends('admin.layouts.app')

@section('title', 'Tambah Alternatif')
@section('page_title', 'Data Alternatif')

@section('content')
<div class="card" style="max-width:480px;">
    <h2 style="margin:0 0 16px;font-size:1.1rem;">Tambah Alternatif</h2>
    <form action="{{ route('admin.alternatif.store') }}" method="POST">
        @csrf
        <div class="field">
            <label>Kode</label>
            <input type="text" name="kode" value="{{ old('kode') }}" placeholder="cth: A1" required>
            @error('kode')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Nama Alternatif</label>
            <input type="text" name="nama_alternatif" value="{{ old('nama_alternatif') }}" placeholder="cth: Nastar" required>
            @error('nama_alternatif')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div style="display:flex;gap:8px;margin-top:4px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.alternatif.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
