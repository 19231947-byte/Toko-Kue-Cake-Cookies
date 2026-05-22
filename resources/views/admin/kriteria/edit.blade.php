@extends('admin.layouts.app')

@section('title', 'Edit Kriteria')
@section('page_title', 'Kriteria')

@section('content')
<div class="card" style="max-width:520px;">
    <h2 style="margin:0 0 16px;font-size:1.1rem;">Edit Kriteria</h2>
    <form action="{{ route('admin.kriteria.update', $kriteria) }}" method="POST">
        @csrf @method('PUT')
        <div class="field">
            <label>Kode</label>
            <input type="text" name="kode" value="{{ old('kode', $kriteria->kode) }}" required>
            @error('kode')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Nama Kriteria</label>
            <input type="text" name="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}" required>
            @error('nama_kriteria')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Tipe</label>
            <select name="tipe" required>
                <option value="Benefit" {{ old('tipe', $kriteria->tipe) === 'Benefit' ? 'selected' : '' }}>Benefit</option>
                <option value="Cost"    {{ old('tipe', $kriteria->tipe) === 'Cost'    ? 'selected' : '' }}>Cost</option>
            </select>
            @error('tipe')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Bobot (%)</label>
            <input type="number" name="bobot" value="{{ old('bobot', $kriteria->bobot) }}" min="0" max="100" step="0.01" required>
            @error('bobot')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div style="display:flex;gap:8px;margin-top:4px;">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.kriteria.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
