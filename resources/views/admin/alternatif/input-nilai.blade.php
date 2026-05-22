@extends('admin.layouts.app')

@section('title', 'Input Nilai')
@section('page_title', 'Data Alternatif')

@section('content')
<div class="card" style="max-width:560px;">
    <h2 style="margin:0 0 4px;font-size:1.1rem;">Input Nilai</h2>
    <p style="margin:0 0 18px;font-size:.85rem;color:#6b7280;">
        Alternatif: <strong>{{ $alternatif->kode }} - {{ $alternatif->nama_alternatif }}</strong>
    </p>

    @if($kriterias->isEmpty())
        <p style="color:#9ca3af;font-size:.85rem;">Belum ada kriteria. Tambahkan kriteria terlebih dahulu.</p>
    @else
        <form action="{{ route('admin.alternatif.simpan-nilai', $alternatif) }}" method="POST">
            @csrf
            @foreach($kriterias as $k)
                <div class="field">
                    <label>{{ $k->kode }} - {{ $k->nama_kriteria }} ({{ $k->tipe }}, bobot {{ number_format($k->bobot, 0) }}%)</label>
                    <input type="number" name="nilai[{{ $k->id }}]"
                           value="{{ old("nilai.{$k->id}", $penilaians[$k->id] ?? '') }}"
                           placeholder="Masukkan nilai" min="0" step="0.01" required>
                    @error("nilai.{$k->id}")<div class="error">{{ $message }}</div>@enderror
                </div>
            @endforeach
            <div style="display:flex;gap:8px;margin-top:4px;">
                <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                <a href="{{ route('admin.alternatif.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    @endif
</div>
@endsection
