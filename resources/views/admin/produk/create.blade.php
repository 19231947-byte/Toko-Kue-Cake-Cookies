@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk')

@section('content')
<div class="card" style="max-width:800px;">
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Info Dasar --}}
        <div class="field">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required>
            @error('nama_produk') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label>Kategori</label>
            <select name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" @selected(old('kategori_id') == $kat->id)>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div class="field">
                <label>Harga Default (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga', 0) }}" min="0" required>
                @error('harga') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Stok Default <span style="font-weight:400;color:#999;font-size:.85em;">(opsional)</span></label>
                <input type="number" name="stok" value="{{ old('stok') }}" min="0" placeholder="Kosongkan jika tidak ada stok tetap">
                @error('stok') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="field">
            <label>Deskripsi</label>
            <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label>Gambar Produk</label>
            <input type="file" id="gambar" name="gambar" accept="image/*">
            @error('gambar') <div class="error">{{ $message }}</div> @enderror
            <img id="preview" style="display:none;margin-top:10px;max-width:150px;border-radius:8px;">
        </div>

        {{-- Varian --}}
        <div style="margin-top:20px;margin-bottom:8px;border-top:1px solid #e5e7eb;padding-top:16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                <label style="font-weight:700;font-size:0.9rem;">Varian Produk <span style="font-weight:400;color:#6b7280;">(opsional)</span></label>
                <button type="button" onclick="tambahVarian()" class="btn btn-secondary" style="font-size:0.8rem;">+ Tambah Varian</button>
            </div>
            <div id="varian-container"></div>
        </div>

        <div style="margin-top:16px;">
            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<style>
.varian-row { background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px;margin-bottom:10px;position:relative; }
.varian-grid { display:grid;grid-template-columns:2fr 1fr 1fr 1fr auto;gap:8px;align-items:end; }
.varian-grid label { font-size:0.78rem;color:#6b7280;margin-bottom:3px;display:block; }
.varian-grid input { padding:6px 8px;font-size:0.85rem; }
.btn-remove { background:#fee2e2;color:#dc2626;border:none;border-radius:6px;padding:6px 10px;cursor:pointer;font-size:0.8rem; }
</style>

<script>
let varianIndex = 0;

document.getElementById('gambar').addEventListener('change', function() {
    const preview = document.getElementById('preview');
    if (this.files[0]) {
        preview.src = URL.createObjectURL(this.files[0]);
        preview.style.display = 'block';
    }
});

function tambahVarian() {
    const i = varianIndex++;
    const html = `
    <div class="varian-row" id="varian-${i}">
        <div class="varian-grid">
            <div>
                <label>Nama Varian *</label>
                <input type="text" name="varians[${i}][nama_varian]" placeholder="cth: Kecil, Sedang" required>
            </div>
            <div>
                <label>Harga (Rp) *</label>
                <input type="number" name="varians[${i}][harga]" min="0" placeholder="0" required>
            </div>
            <div>
                <label>Berat (gram)</label>
                <input type="number" name="varians[${i}][berat]" min="0" placeholder="opsional" step="0.01">
            </div>
            <div>
                <label>Ukuran</label>
                <input type="text" name="varians[${i}][ukuran]" placeholder="cth: 20x20cm (opsional)">
            </div>
            <div>
                <label>&nbsp;</label>
                <button type="button" class="btn-remove" onclick="hapusVarian(${i})">✕</button>
            </div>
        </div>
    </div>`;
    document.getElementById('varian-container').insertAdjacentHTML('beforeend', html);
}

function hapusVarian(i) {
    document.getElementById('varian-' + i).remove();
}
</script>
@endsection
