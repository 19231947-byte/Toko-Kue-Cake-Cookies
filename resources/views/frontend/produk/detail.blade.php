@extends('frontend.layouts.app')

@section('title', $produk->nama_produk . ' - Ayasha Cake & Cookies')

@section('styles')
<style>
    .detail-img {
        width: 100%;
        max-height: 460px;
        object-fit: cover;
        border-radius: 12px;
    }
    .img-placeholder {
        width: 100%;
        height: 360px;
        background: #f5ede6;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .badge-kategori {
        display: inline-block;
        background: #f5ede6;
        color: #8B5E3C;
        font-size: .78rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 999px;
        margin-bottom: 10px;
        letter-spacing: .05em;
    }
    .produk-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: #2C1A0E;
        margin-bottom: 6px;
    }
    .harga-default {
        font-size: 1.6rem;
        font-weight: 700;
        color: #8B5E3C;
        margin-bottom: 16px;
    }
    /* Varian pills */
    .varian-list { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
    .varian-btn {
        border: 1.5px solid #d6c9be;
        background: #fff;
        border-radius: 8px;
        padding: 8px 20px;
        cursor: pointer;
        transition: all .2s;
        font-weight: 600;
        font-size: .88rem;
        color: #2C1A0E;
    }
    .varian-btn:hover, .varian-btn.active {
        border-color: #8B5E3C;
        background: #f5ede6;
        color: #8B5E3C;
    }
    .varian-btn .v-nama { font-weight: 600; font-size: .88rem; }
    .varian-btn .v-harga { display: none; }
    .varian-btn .v-stok  { display: none; }
    /* Qty */
    .qty-wrap { display: flex; align-items: center; gap: 0; border: 1.5px solid #d6c9be; border-radius: 8px; overflow: hidden; width: fit-content; margin-bottom: 20px; }
    .qty-btn { background: #f5ede6; border: none; width: 38px; height: 38px; font-size: 1.1rem; cursor: pointer; color: #8B5E3C; font-weight: 700; }
    .qty-btn:hover { background: #e8d5c4; }
    .qty-input { width: 50px; text-align: center; border: none; border-left: 1.5px solid #d6c9be; border-right: 1.5px solid #d6c9be; height: 38px; font-size: .95rem; color: #2C1A0E; }
</style>
@endsection

@section('content')

{{-- Page Header --}}
<div class="container-fluid page-header py-4 mb-5"
     style="background: linear-gradient(rgba(139,90,43,.5), rgba(139,90,43,.5)), url('{{ asset('frontend/assets/img/banner1.jpg') }}') center center / cover no-repeat;">
    <div class="container text-center py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produk.index') }}" style="color:#f0d9c8;">Produk</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">{{ $produk->nama_produk }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-xxl py-3 mb-5">
    <div class="container">

        {{-- Detail Produk --}}
        <div class="row g-5 mb-5">

            {{-- Gambar --}}
            <div class="col-lg-5">
                @if($produk->gambar)
                    <img class="detail-img" src="{{ asset('storage/' . $produk->gambar) }}" 
                         onerror="this.onerror=null;this.src='{{ asset('frontend/assets/img/' . str_replace(' ', '', $produk->gambar)) }}';"
                         alt="{{ $produk->nama_produk }}">
                @else
                    <div class="img-placeholder">
                        <i class="fa fa-birthday-cake fa-4x" style="color:#C9B8A8;"></i>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="col-lg-7">
                @if($produk->kategori)
                    <span class="badge-kategori">{{ $produk->kategori->nama_kategori }}</span>
                @endif

                <h1 class="produk-title">{{ $produk->nama_produk }}</h1>

                {{-- Harga --}}
                <div class="harga-default" id="harga-display">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </div>

                {{-- Deskripsi --}}
                @if($produk->deskripsi)
                    <p style="color:#5a4a3a;line-height:1.7;margin-bottom:20px;">{{ $produk->deskripsi }}</p>
                @endif

                {{-- Stok dari produk default --}}
                @if($produk->stok !== null)
                <p style="font-size:.85rem;color:#9ca3af;margin-bottom:16px;">
                    Stok: {{ $produk->stok }}
                </p>
                @endif
                
                {{-- Varian --}}
                @if($produk->varians->count())
                    <div style="margin-bottom:16px;">
                        <div class="varian-list">
                            @foreach($produk->varians as $varian)
                                <button type="button"
                                        class="varian-btn {{ $loop->first ? 'active' : '' }}"
                                        data-harga="{{ $varian->harga }}"
                                        data-id="{{ $varian->id }}"
                                        data-berat="{{ $varian->berat }}"
                                        data-ukuran="{{ $varian->ukuran }}"
                                        onclick="pilihVarian(this)">
                                    <div class="v-nama">{{ $varian->nama_varian }}</div>
                                </button>
                            @endforeach
                        </div>

                        {{-- Info varian terpilih --}}
                        @php $first = $produk->varians->first(); @endphp
                        <div id="varian-info" style="margin-top:8px;font-size:.82rem;color:#9ca3af;display:flex;gap:16px;flex-wrap:wrap;">
                            @if($first->berat)
                                <span id="info-berat"><i class="fa fa-weight me-1"></i>{{ $first->berat }} gram</span>
                            @else
                                <span id="info-berat" style="display:none;"></span>
                            @endif
                            @if($first->ukuran)
                                <span id="info-ukuran"><i class="fa fa-ruler me-1"></i>{{ $first->ukuran }}</span>
                            @else
                                <span id="info-ukuran" style="display:none;"></span>
                            @endif
                        </div>

                        <input type="hidden" id="selected-varian-id" value="{{ $first->id }}">
                    </div>
                @endif

                {{-- Qty --}}
                <label style="font-weight:600;font-size:.88rem;color:#2C1A0E;margin-bottom:8px;display:block;">Jumlah:</label>
                <div class="qty-wrap mb-2">
                    <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                    <input type="number" id="qty" class="qty-input" 
                           value="{{ ($produk->kategori && $produk->kategori->nama_kategori === 'Snack Box') ? 20 : 1 }}" 
                           min="{{ ($produk->kategori && $produk->kategori->nama_kategori === 'Snack Box') ? 20 : 1 }}" 
                           max="999">
                    <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                </div>

                @if($produk->kategori && $produk->kategori->nama_kategori === 'Snack Box')
                    <p id="min-order-info" style="font-size: .82rem; color: #dc3545; font-weight: 600; margin-bottom: 20px;">
                        <i class="fa fa-info-circle me-1"></i> Minimal pemesanan 20 pcs (Pre Order)
                    </p>
                @endif

                {{-- Total Harga --}}
                <div style="margin-bottom:16px;">
                    <span style="font-size:.85rem;color:#9ca3af;">Total: </span>
                    <span id="total-harga" style="font-size:1.1rem;font-weight:700;color:#8B5E3C;">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>
                </div>

                {{-- Tombol Aksi --}}
                @auth
                    <form id="form-keranjang">
                        @csrf
                        <input type="hidden" name="qty" id="input-qty" value="1">
                        @if($produk->varians->count())
                            <input type="hidden" name="varian_id" id="input-varian-id"
                                   value="{{ $produk->varians->first()->id }}">
                        @endif
                        <div class="d-flex gap-3 flex-wrap">
                            <button type="button" onclick="tambahKeKeranjang()"
                                    class="btn btn-primary rounded-pill px-5 py-2">
                                <i class="fa fa-cart-plus me-2"></i>Tambah ke Keranjang
                            </button>
                            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                Kembali
                            </a>
                        </div>
                    </form>
                @else
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('frontend.login') }}" class="btn btn-primary rounded-pill px-5 py-2">
                            <i class="fa fa-sign-in-alt me-2"></i>Login untuk Beli
                        </a>
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                            Kembali
                        </a>
                    </div>
                @endauth

                {{-- Info tambahan --}}
                @if($produk->varians->count())
                    @php $v = $produk->varians->first(); @endphp
                    @if($v->berat)
                        <div style="margin-top:16px;font-size:.82rem;color:#9ca3af;">
                            <i class="fa fa-weight me-1"></i>Berat: <span id="info-berat">{{ $v->berat }} gram</span>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Produk Lainnya --}}

    </div>
</div>

@endsection

@section('scripts')
<script>
    let currentHarga = {{ $produk->varians->count() ? $produk->varians->first()->harga : $produk->harga }};
    const urlTambah  = "{{ route('keranjang.tambah', $produk->id) }}";
    const csrfToken  = "{{ csrf_token() }}";
    const namaProduk = "{{ addslashes($produk->nama_produk) }}";
    const urlKeranjang = "{{ route('keranjang.index') }}";
    const urlCheckout  = "{{ route('checkout.index') }}";
    const isSnackBox   = "{{ ($produk->kategori && $produk->kategori->nama_kategori === 'Snack Box') ? '1' : '0' }}" === '1';
    const minQty       = isSnackBox ? 20 : 1;

    function updateTotal() {
        const qtyInput = document.getElementById('qty');
        let qty = parseInt(qtyInput.value) || 0;
        
        // Validasi input manual agar tidak kurang dari minimum
        if (qty < minQty) {
            qty = minQty;
            qtyInput.value = minQty;
        }

        const total = currentHarga * qty;
        document.getElementById('total-harga').textContent =
            'Rp ' + total.toLocaleString('id-ID');
        
        // Update hidden input qty
        const hidden = document.getElementById('input-qty');
        if (hidden) hidden.value = qty;
    }

    // Pilih varian
    function pilihVarian(el) {
        document.querySelectorAll('.varian-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');

        currentHarga     = parseInt(el.dataset.harga);
        const id         = el.dataset.id;
        const berat      = el.dataset.berat;
        const ukuran     = el.dataset.ukuran;

        // Update harga display
        document.getElementById('harga-display').textContent =
            'Rp ' + currentHarga.toLocaleString('id-ID');

        // Update hidden input
        const inputVarian = document.getElementById('input-varian-id');
        if (inputVarian) inputVarian.value = id;
        const selectedId = document.getElementById('selected-varian-id');
        if (selectedId) selectedId.value = id;

        // Update info berat & ukuran
        const infoBerat = document.getElementById('info-berat');
        if (infoBerat) {
            if (berat) { infoBerat.innerHTML = '<i class="fa fa-weight me-1"></i>' + berat + ' gram'; infoBerat.style.display = ''; }
            else infoBerat.style.display = 'none';
        }
        const infoUkuran = document.getElementById('info-ukuran');
        if (infoUkuran) {
            if (ukuran) { infoUkuran.innerHTML = '<i class="fa fa-ruler me-1"></i>' + ukuran; infoUkuran.style.display = ''; }
            else infoUkuran.style.display = 'none';
        }

        updateTotal();
    }

    // Qty
    function changeQty(delta) {
        const input = document.getElementById('qty');
        let val = parseInt(input.value || 0) + delta;
        
        // Minimal pembelian
        if (val < minQty) {
            val = minQty;
            if (isSnackBox) {
                alert('Minimal pemesanan Snack Box adalah 20 pcs.');
            }
        }
        
        input.value = Math.min(999, val);
        updateTotal();
    }

    document.getElementById('qty').addEventListener('change', function() {
        updateTotal();
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateTotal();
    });

    // Tambah ke keranjang via AJAX
    function tambahKeKeranjang() {
        const qty = parseInt(document.getElementById('qty').value) || 0;
        
        // Validasi lagi sebelum kirim
        if (isSnackBox && qty < 20) {
            alert('Minimal pemesanan Snack Box adalah 20 pcs.');
            return;
        }

        const varianEl = document.getElementById('input-varian-id');
        const varianId = varianEl ? varianEl.value : null;

        const formData = new FormData();
        formData.append('_token', csrfToken);
        formData.append('qty', qty);
        if (varianId) formData.append('varian_id', varianId);

        fetch(urlTambah, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    tampilPopupKeranjang(data);
                    // Update badge keranjang di navbar
                    const badges = document.querySelectorAll('.badge.rounded-pill');
                    badges.forEach(b => b.textContent = data.totalItem);
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(() => {
                // Handle error
            });
    }

    function tampilPopupKeranjang(data) {
        // Hapus popup lama jika ada
        const lama = document.getElementById('popup-keranjang');
        if (lama) lama.remove();

        const qty        = document.getElementById('qty').value;
        const namaVarian = document.querySelector('.varian-btn.active')?.querySelector('.v-nama')?.textContent?.trim() || '';
        const hargaText  = 'Rp ' + (currentHarga * parseInt(qty)).toLocaleString('id-ID');

        // Gambar produk
        const gambarEl  = document.querySelector('.detail-img');
        const gambarSrc = gambarEl ? gambarEl.src : '';

        const popup = document.createElement('div');
        popup.id = 'popup-keranjang';
        popup.innerHTML = `
            <div id="popup-overlay" onclick="tutupPopup()" style="position:fixed;inset:0;background:rgba(0,0,0,.35);z-index:9998;"></div>
            <div id="popup-box" style="
                position:fixed;top:0;left:50%;transform:translateX(-50%);
                width:100%;max-width:520px;background:#fff;z-index:9999;
                border-radius:0 0 16px 16px;box-shadow:0 8px 32px rgba(0,0,0,.18);
                padding:0;overflow:hidden;
                animation:slideDown .25s ease;
            ">
                <style>
                    @keyframes slideDown { from{transform:translateX(-50%) translateY(-100%)} to{transform:translateX(-50%) translateY(0)} }
                </style>
                <!-- Header -->
                <div style="background:#2C1A0E;color:#fff;padding:14px 20px;display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:8px;font-size:.9rem;font-weight:600;">
                        <i class="fa fa-check-circle" style="color:#25D366;font-size:1.1rem;"></i>
                        Produk ditambahkan ke keranjang
                    </div>
                    <button onclick="tutupPopup()" style="background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer;line-height:1;">×</button>
                </div>
                <!-- Produk info -->
                <div style="padding:18px 20px;display:flex;align-items:center;gap:14px;border-bottom:1px solid #f0e4d8;">
                    ${gambarSrc
                        ? `<img src="${gambarSrc}" style="width:64px;height:64px;object-fit:cover;border-radius:8px;flex-shrink:0;">`
                        : `<div style="width:64px;height:64px;background:#f5ede6;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fa fa-birthday-cake" style="color:#C9B8A8;font-size:1.4rem;"></i></div>`
                    }
                    <div style="flex:1;">
                        <div style="font-weight:700;color:#2C1A0E;font-size:.95rem;">${namaProduk}</div>
                        ${namaVarian ? `<div style="font-size:.78rem;color:#9ca3af;margin-top:2px;">${namaVarian}</div>` : ''}
                        <div style="display:flex;align-items:center;gap:12px;margin-top:6px;">
                            <span style="font-size:.82rem;color:#6b7280;">Jumlah: ${qty}</span>
                            <span style="font-weight:700;color:#8B5E3C;font-size:.9rem;">${hargaText}</span>
                        </div>
                    </div>
                </div>
                <!-- Tombol aksi -->
                <div style="padding:16px 20px;display:flex;flex-direction:column;gap:10px;">
                    <a href="${urlKeranjang}" style="display:block;text-align:center;padding:11px;border:1.5px solid #2C1A0E;border-radius:8px;color:#2C1A0E;font-weight:600;font-size:.9rem;text-decoration:none;">
                        Lihat Keranjang
                    </a>
                    <a href="${urlCheckout}" style="display:block;text-align:center;padding:11px;background:#2C1A0E;border-radius:8px;color:#fff;font-weight:600;font-size:.9rem;text-decoration:none;">
                        Checkout
                    </a>
                    <button onclick="tutupPopup()" style="background:none;border:none;color:#8B5E3C;font-size:.85rem;cursor:pointer;padding:4px;text-decoration:underline;">
                        Lanjut Belanja
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(popup);
    }

    function tutupPopup() {
        const popup = document.getElementById('popup-keranjang');
        if (popup) popup.remove();
    }
</script>
@endsection
