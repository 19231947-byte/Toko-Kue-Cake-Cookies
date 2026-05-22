@extends('admin.layouts.app')

@section('title', 'Edit Alternatif')
@section('page_title', 'Data Alternatif')

@section('content')
<div class="card" style="max-width:480px;">
    <h2 style="margin:0 0 16px;font-size:1.1rem;">Edit Alternatif</h2>
    <form action="{{ route('admin.alternatif.update', $alternatif) }}" method="POST">
        @csrf @method('PUT')
        <div class="field">
            <label>Kode</label>
            <input type="text" name="kode" value="{{ old('kode', $alternatif->kode) }}" required>
            @error('kode')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Nama Alternatif</label>
            <input type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $alternatif->nama_alternatif) }}" required>
            @error('nama_alternatif')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div style="display:flex;gap:8px;margin-top:4px;">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.alternatif.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
