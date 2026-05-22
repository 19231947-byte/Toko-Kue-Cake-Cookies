@extends('frontend.layouts.app')

@section('title', 'Checkout - Ayasha Cake & Cookies')

@section('styles')
<style>
    .checkout-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(139,94,60,.10);
        padding: 32px;
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        color: #2C1A0E;
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f5ede6;
        /* hapus pseudo-element garis+bulat dari style.css global */
        position: static;
    }
    .section-title::before,
    .section-title::after {
        display: none !important;
    }
    .form-label {
        font-size: .85rem;
        font-weight: 600;
        color: #5a4a3a;
        margin-bottom: 6px;
    }
    .form-control, .form-select {
        border: 1.5px solid #d6c9be;
        border-radius: 10px;
        font-size: .9rem;
        color: #2C1A0E;
        padding: 10px 14px;
        transition: border-color .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #8B5E3C;
        box-shadow: 0 0 0 3px rgba(139,94,60,.12);
    }
    .form-control.is-invalid {
        border-color: #dc2626;
    }
    .invalid-feedback {
        font-size: .78rem;
        color: #dc2626;
    }
    #metode-error {
        font-size: .78rem;
        color: #dc2626;
        display: none;
        margin-top: 4px;
    }
    #metode-error.show-error {
        display: block;
    }
    /* Radio metode pengiriman */
    .metode-option {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        border: 1.5px solid #d6c9be;
        border-radius: 10px;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        margin-bottom: 10px;
    }
    .metode-option:hover {
        border-color: #8B5E3C;
        background: #fdf6f0;
    }
    .metode-option input[type="radio"] {
        accent-color: #8B5E3C;
        width: 18px;
        height: 18px;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .metode-option.selected {
        border-color: #8B5E3C;
        background: #fdf6f0;
    }
    .metode-label {
        font-weight: 600;
        font-size: .9rem;
        color: #2C1A0E;
    }
    .metode-desc {
        font-size: .78rem;
        color: #9ca3af;
        margin-top: 2px;
    }
    /* Summary box */
    .summary-box {
        background: #fdf6f0;
        border-radius: 12px;
        padding: 24px;
        position: sticky;
        top: 120px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: .88rem;
        color: #5a4a3a;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 1.05rem;
        color: #2C1A0E;
        border-top: 1.5px solid #d6c9be;
        padding-top: 12px;
        margin-top: 4px;
    }
    /* Tombol WA */
    .btn-wa {
        background: #25D366;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 13px 28px;
        font-size: .95rem;
        font-weight: 700;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: background .2s, transform .1s;
        margin-top: 20px;
        letter-spacing: .03em;
    }
    .btn-wa:hover {
        background: #1ebe5d;
        transform: translateY(-1px);
    }
    .btn-wa:active {
        transform: translateY(0);
    }
    .btn-wa i {
        font-size: 1.1rem;
    }
    /* Catatan alamat hint */
    .alamat-note {
        font-size: .75rem;
        color: #f59e0b;
        margin-top: 4px;
        display: none;
    }
    .alamat-note.show {
        display: block;
    }
    /* Produk item di summary */
    .summary-produk-img {
        width: 44px;
        height: 44px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }
    .summary-produk-nama {
        font-size: .82rem;
        font-weight: 600;
        color: #2C1A0E;
        line-height: 1.3;
    }
    .summary-produk-varian {
        font-size: .72rem;
        color: #9ca3af;
    }
</style>
@endsection

@section('content')

{{-- Page Header --}}
<div class="container-fluid page-header py-4 mb-5"
     style="background:linear-gradient(rgba(139,90,43,.5),rgba(139,90,43,.5)),url('{{ asset('frontend/assets/img/') }}') center/cover no-repeat;">
    <div class="container text-center py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#f0d9c8;">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('keranjang.index') }}" style="color:#f0d9c8;">Keranjang</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Checkout</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-xxl py-3 mb-5">
    <div class="container">

        <div class="row g-4">

            {{-- Form Checkout --}}
            <div class="col-lg-7">
                <div class="checkout-card">
                    <h5 class="section-title"><i class="fa fa-user me-2" style="color:#8B5E3C;"></i>Data Pemesan</h5>

                    <form id="formCheckout" novalidate>
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama Lengkap <span style="color:#dc2626;">*</span></label>
                            <input type="text" id="nama" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                            <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="mb-3">
                            <label class="form-label" for="notelepon">Nomor Telepon <span style="color:#dc2626;">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#f5ede6;border:1.5px solid #d6c9be;border-right:none;border-radius:10px 0 0 10px;color:#8B5E3C;font-size:.85rem;">+62</span>
                                <input type="tel" id="notelepon" class="form-control" placeholder="8xx xxxx xxxx"
                                       style="border-left:none;border-radius:0 10px 10px 0;" required
                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                            <div class="invalid-feedback" id="notelepon-error">Nomor Telepon wajib diisi dan hanya boleh angka.</div>
                        </div>

                        {{-- Metode Pengiriman --}}
                        <div class="mb-3">
                            <label class="form-label">Metode Pengiriman <span style="color:#dc2626;">*</span></label>

                            <label class="metode-option" id="opt-toko" onclick="pilihMetode('toko')">
                                <input type="radio" name="metode" value="toko" id="radio-toko">
                                <div>
                                    <div class="metode-label"><i class="fa fa-store me-2" style="color:#8B5E3C;"></i>Ambil di Tempat</div>
                                    <div class="metode-desc">Ambil langsung di Jl. Musyawarah, Kebon Jeruk, Jakarta Barat</div>
                                </div>
                            </label>

                            <label class="metode-option" id="opt-kirim" onclick="pilihMetode('kirim')">
                                <input type="radio" name="metode" value="kirim" id="radio-kirim">
                                <div>
                                    <div class="metode-label"><i class="fa fa-truck me-2" style="color:#8B5E3C;"></i>Kirim ke Rumah</div>
                                    <div class="metode-desc">Pengiriman ke alamat Anda (ongkir dikonfirmasi admin)</div>
                                </div>
                            </label>
                            <div id="metode-error"></div>
                        </div>

                        {{-- Alamat Lengkap --}}
                        <div class="mb-3" id="alamat-wrap">
                            <label class="form-label" for="alamat" id="alamat-label">
                                Alamat Lengkap <span style="color:#dc2626;">*</span>
                            </label>
                            <input type="text" id="alamat" class="form-control"
                                   placeholder="Jl. Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota" required>
                            <div class="invalid-feedback">Alamat lengkap wajib diisi.</div>
                            <div class="alamat-note" id="alamat-note">
                                <i class="fa fa-info-circle me-1"></i>Alamat tidak wajib diisi jika ambil di toko.
                            </div>
                        </div>

                        {{-- Catatan Alamat --}}
                        <div class="mb-4">
                            <label class="form-label" for="catatan">
                                Catatan Alamat <span style="color:#9ca3af;font-weight:400;">(opsional)</span>
                            </label>
                            <textarea id="catatan" class="form-control" rows="3"
                                      placeholder="Contoh: Rumah cat kuning, dekat minimarket, patokan..."></textarea>
                        </div>

                        {{-- Detail Custom Cake (hanya muncul jika ada Kue Ulang Tahun) --}}
                        @if($hasBirthdayCake)
                        <div id="custom-cake-section"
                             style="background:#fff8f0;border:1.5px solid #f5c97a;border-radius:12px;padding:20px 22px;margin-bottom:20px;">
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;">
                                <span style="font-size:1.3rem;">🎂</span>
                                <span style="font-family:'Playfair Display',serif;font-weight:700;color:#2C1A0E;font-size:1rem;">
                                    Detail Custom Cake
                                </span>
                                <span style="font-size:.72rem;background:#f5c97a;color:#7c4a00;padding:2px 8px;border-radius:20px;font-weight:600;">
                                    Birthday Cakes
                                </span>
                            </div>

                            {{-- Tulisan & Ucapan --}}
                            <div class="mb-3">
                                <label class="form-label" for="tulisan_kue">
                                    Tulisan & Ucapan di Kue <span style="color:#dc2626;">*</span>
                                </label>
                                <input type="text" id="tulisan_kue" class="form-control"
                                       placeholder="Contoh: Happy Birthday Budi! 🎉"
                                       maxlength="60">
                                <div class="invalid-feedback">Tulisan/ucapan di kue wajib diisi.</div>
                                <div style="font-size:.72rem;color:#9ca3af;margin-top:4px;">Maks. 60 karakter</div>
                            </div>

                            {{-- Catatan Custom --}}
                            <div class="mb-1">
                                <label class="form-label" for="catatan_custom">
                                    Catatan Custom <span style="color:#9ca3af;font-weight:400;">(opsional)</span>
                                </label>
                                <textarea id="catatan_custom" class="form-control" rows="3"
                                          placeholder="Contoh: Tema warna pink, topping strawberry, lilin angka 17..."></textarea>
                            </div>
                        </div>
                        @endif

                        {{-- Info WA --}}
                        <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:12px 16px;font-size:.82rem;color:#166534;margin-bottom:20px;">
                            <i class="fa fa-info-circle me-2"></i>
                            Pesanan akan dikirim via WhatsApp ke admin untuk konfirmasi. Pastikan data Anda sudah benar.
                        </div>
                    </form>
                </div>
            </div>

            {{-- Ringkasan Pesanan --}}
            <div class="col-lg-5">
                <div class="summary-box">
                    <h5 class="section-title"><i class="fa fa-receipt me-2" style="color:#8B5E3C;"></i>Ringkasan Pesanan</h5>

                    {{-- Daftar produk --}}
                    @foreach($keranjang as $item)
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if(!empty($item['gambar']))
                            <img src="{{ asset('storage/' . $item['gambar']) }}" class="summary-produk-img" alt="{{ $item['nama'] }}">
                        @else
                            <div class="summary-produk-img d-flex align-items-center justify-content-center"
                                 style="background:#f5ede6;">
                                <i class="fa fa-birthday-cake" style="color:#C9B8A8;font-size:.9rem;"></i>
                            </div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="summary-produk-nama">{{ $item['nama'] }}</div>
                            @if(!empty($item['nama_varian']))
                                <div class="summary-produk-varian">{{ $item['nama_varian'] }}</div>
                            @endif
                            <div style="font-size:.78rem;color:#8B5E3C;font-weight:600;">x{{ $item['qty'] }}</div>
                        </div>
                        <div style="font-size:.88rem;font-weight:700;color:#2C1A0E;white-space:nowrap;">
                            Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach

                    <div style="border-top:1.5px solid #d6c9be;margin:16px 0;"></div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    {{-- Tombol WA --}}
                    <button class="btn-wa" onclick="pesanViaWA()">
                        <i class="fab fa-whatsapp"></i>
                        Pesan via WhatsApp
                    </button>

                    <a href="{{ route('keranjang.index') }}"
                       style="display:block;text-align:center;margin-top:14px;font-size:.82rem;color:#8B5E3C;">
                        <i class="fa fa-arrow-left me-1"></i>Kembali ke Keranjang
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Konversi keranjang (associative array) ke array biasa
    const keranjangData  = Object.values(@json($keranjang));
    const totalHarga     = @json($total);
    const hasBirthdayCake = @json($hasBirthdayCake);

    function pilihMetode(val) {
        document.getElementById('radio-toko').checked  = (val === 'toko');
        document.getElementById('radio-kirim').checked = (val === 'kirim');
        document.getElementById('opt-toko').classList.toggle('selected',  val === 'toko');
        document.getElementById('opt-kirim').classList.toggle('selected', val === 'kirim');
        document.getElementById('metode-error').classList.remove('show-error');

        const alamatWrap = document.getElementById('alamat-wrap');
        const alamatInput = document.getElementById('alamat');
        const alamatLabel = document.getElementById('alamat-label');
        const alamatNote  = document.getElementById('alamat-note');

        if (val === 'toko') {
            // Alamat opsional
            alamatLabel.innerHTML = 'Alamat Lengkap <span style="color:#9ca3af;font-weight:400;">(opsional)</span>';
            alamatInput.removeAttribute('required');
            alamatInput.classList.remove('is-invalid');
            alamatNote.classList.add('show');
        } else {
            // Alamat wajib
            alamatLabel.innerHTML = 'Alamat Lengkap <span style="color:#dc2626;">*</span>';
            alamatInput.setAttribute('required', 'required');
            alamatNote.classList.remove('show');
        }
    }

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function setError(el, show) {
        if (show) {
            el.classList.add('is-invalid');
        } else {
            el.classList.remove('is-invalid');
        }
    }

    function pesanViaWA() {
        let valid = true;

        const nama  = document.getElementById('nama');
        const notelepon  = document.getElementById('notelepon');
        const alamat = document.getElementById('alamat');
        const metode = document.querySelector('input[name="metode"]:checked');
        const errMetode = document.getElementById('metode-error');

        // Validasi nama
        const namaOk = nama.value.trim() !== '';
        setError(nama, !namaOk);
        if (!namaOk) valid = false;

        // Validasi no TELEPON (angka saja, tidak kosong)
        const noteleponVal = notelepon.value.trim();
        const noteleponOk  = noteleponVal !== '' && /^\d+$/.test(noteleponVal);
        setError(notelepon, !noteleponOk);
        if (!noteleponOk) valid = false;

        // Validasi metode
        if (!metode) {
            errMetode.textContent = 'Pilih metode pengiriman.';
            errMetode.classList.add('show-error');
            valid = false;
        } else {
            errMetode.classList.remove('show-error');
        }

        // Validasi alamat — wajib hanya jika kirim ke rumah
        const isKirim  = metode && metode.value === 'kirim';
        const alamatOk = !isKirim || alamat.value.trim() !== '';
        setError(alamat, !alamatOk);
        if (!alamatOk) valid = false;

        // Validasi tulisan kue (hanya jika ada birthday cake)
        let tulisanVal = '';
        let catatanCustomVal = '';
        if (hasBirthdayCake) {
            const tulisan = document.getElementById('tulisan_kue');
            tulisanVal = tulisan ? tulisan.value.trim() : '';
            if (!tulisanVal) {
                setError(tulisan, true);
                valid = false;
            } else {
                setError(tulisan, false);
            }
            const catatanCustomEl = document.getElementById('catatan_custom');
            catatanCustomVal = catatanCustomEl ? catatanCustomEl.value.trim() : '';
        }

        if (!valid) {
            const firstInvalid = document.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        // Susun daftar produk
        let daftarProduk = '';
        keranjangData.forEach(function(item) {
            const namaProduk = item.nama + (item.nama_varian ? ' (' + item.nama_varian + ')' : '');
            daftarProduk += '\n• ' + namaProduk + ' x' + item.qty + ' = ' + formatRupiah(item.harga * item.qty);
        });

        const metodeLabel = metode.value === 'toko' ? 'Ambil di Toko' : 'Kirim ke Rumah';
        const catatan     = document.getElementById('catatan').value.trim();
        const alamatVal   = alamat.value.trim();
        const alamatInfo  = metode.value === 'toko' ? alamatVal + ' (ambil di toko)' : alamatVal;

        let pesan  = 'Halo Admin Ayasha Cake & Cookies, saya ingin memesan kue:\n';
        pesan += '\n*Nama:* '   + nama.value.trim();
        pesan += '\n*No Telepon:* +62' + noteleponVal;
        pesan += '\n*Metode:* ' + metodeLabel;
        pesan += '\n*Alamat:* ' + alamatInfo;
        if (catatan) pesan += '\n*Catatan:* ' + catatan;
        pesan += '\n\n*Pesanan:*' + daftarProduk;
        pesan += '\n\n*Total: ' + formatRupiah(totalHarga) + '*';
        if (hasBirthdayCake) {
            pesan += '\n\n🎂 *Detail Custom Cake:*';
            pesan += '\n*Tulisan/Ucapan:* ' + tulisanVal;
            if (catatanCustomVal) pesan += '\n*Catatan Custom:* ' + catatanCustomVal;
        }
        pesan += '\n\nMohon konfirmasi pesanan saya. Terima kasih 🙏';

        const url = 'https://wa.me/6285717628133?text=' + encodeURIComponent(pesan);

        // Simpan pesanan ke database, buka WA, lalu redirect ke halaman sukses
        const formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('nama',              nama.value.trim());
        formData.append('no_hp',             noteleponVal);
        formData.append('metode_pengiriman', metode.value);
        formData.append('alamat',            alamat.value.trim());
        formData.append('catatan_alamat',    document.getElementById('catatan').value.trim());
        if (hasBirthdayCake) {
            formData.append('tulisan_kue',    tulisanVal);
            formData.append('catatan_custom', catatanCustomVal);
        }

        fetch('{{ route("checkout.simpan") }}', { method: 'POST', body: formData })
            .then(function(res) { return res.json(); })
            .then(function() {
                window.open(url, '_blank');
                window.location.href = '{{ route("checkout.sukses") }}';
            })
            .catch(function() {
                // Tetap buka WA meski simpan gagal
                window.open(url, '_blank');
                window.location.href = '{{ route("checkout.sukses") }}';
            });
    }

    // Hapus is-invalid saat user mengetik
    ['nama', 'notelepon', 'alamat'].forEach(function(id) {
        document.getElementById(id).addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
    // Listener tulisan kue (jika ada)
    const tulisanEl = document.getElementById('tulisan_kue');
    if (tulisanEl) {
        tulisanEl.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    }
</script>
@endsection
