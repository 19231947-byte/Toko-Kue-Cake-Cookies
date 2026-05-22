@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')
@section('page_title', 'Detail Pesanan')

@section('content')
    @if(session('success'))
        <div class="flash-success" style="background: #dcfce7; color: #166534; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px; font-weight: 600;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; align-items: start;">
        <div style="display: flex; flex-direction: column; gap: 20px;">
            {{-- Info Pesanan --}}
            <div class="card">
                <div style="font-size:1.1rem; font-weight:800; margin-bottom:18px; color: #5a3825; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-file-invoice-dollar"></i> Info Pesanan {{ $pesanan->id }}
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px; font-size:.9rem;">
                    <div>
                        <span style="color:#9ca3af; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Akun Pelanggan</span><br>
                        <strong style="color: #374151;">{{ $pesanan->user->name ?? '-' }}</strong>
                        <div style="color:#6b7280; font-size: 0.85rem;">{{ $pesanan->user->email ?? '-' }}</div>
                    </div>
                    <div>
                        <span style="color:#9ca3af; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Tanggal Pesanan</span><br>
                        <strong style="color: #374151;">{{ $pesanan->created_at->format('d M Y, H:i') }}</strong>
                    </div>
                    <div>
                        <span style="color:#9ca3af; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Nama Pemesan</span><br>
                        <strong style="color: #374151;">{{ $pesanan->nama ?? '-' }}</strong>
                    </div>
                    <div>
                        <span style="color:#9ca3af; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">No HP</span><br>
                        <strong style="color: #374151;">{{ $pesanan->no_hp ? '+62'.$pesanan->no_hp : '-' }}</strong>
                    </div>
                    <div>
                        <span style="color:#9ca3af; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Metode Pengiriman</span><br>
                        @if($pesanan->metode_pengiriman === 'kirim')
                            <span style="background:#dbeafe;color:#1d4ed8;padding:4px 12px;border-radius:20px;font-size:.75rem;font-weight:700;display: inline-flex; align-items: center; gap: 5px; margin-top: 5px;">
                                <i class="fa-solid fa-truck-fast"></i> Kirim ke Rumah
                            </span>
                        @else
                            <span style="background:#dcfce7;color:#166534;padding:4px 12px;border-radius:20px;font-size:.75rem;font-weight:700;display: inline-flex; align-items: center; gap: 5px; margin-top: 5px;">
                                <i class="fa-solid fa-store"></i> Ambil di Toko
                            </span>
                        @endif
                    </div>
                    <div>
                        <span style="color:#9ca3af; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Total Harga</span><br>
                        <strong style="font-size:1.2rem; color: #8B5E3C;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
                    </div>
                    <div style="grid-column:span 2;">
                        <span style="color:#9ca3af; font-size: 0.8rem; text-transform: uppercase; font-weight: 700;">Alamat Lengkap</span><br>
                        <div style="color: #374151; margin-top: 3px; line-height: 1.5;">{{ $pesanan->alamat ?? '-' }}</div>
                    </div>
                    @if($pesanan->catatan_alamat)
                    <div style="grid-column:span 2; background: #f9fafb; padding: 10px; border-radius: 8px; border-left: 3px solid #d1d5db;">
                        <span style="color:#6b7280; font-size: 0.75rem; font-weight: 700;">CATATAN ALAMAT</span><br>
                        <div style="color: #4b5563; font-style: italic; margin-top: 2px;">"{{ $pesanan->catatan_alamat }}"</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Detail Item --}}
            <div class="card">
                <div style="font-size:1.1rem; font-weight:800; margin-bottom:18px; color: #5a3825; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-basket-shopping"></i> Item Pesanan
                </div>
                <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                    <thead>
                        <tr>
                            <th style="background: #f9fafb; border: none; padding: 12px; border-radius: 8px 0 0 8px;">Produk</th>
                            <th style="background: #f9fafb; border: none; padding: 12px;">Jumlah</th>
                            <th style="background: #f9fafb; border: none; padding: 12px;">Harga Satuan</th>
                            <th style="background: #f9fafb; border: none; padding: 12px; border-radius: 0 8px 8px 0; text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->detailPesanans as $detail)
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">
                                <strong style="color: #374151;">{{ $detail->produk->nama_produk ?? '-' }}</strong>
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">{{ $detail->jumlah }}x</td>
                            <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid #f3f4f6; text-align: right; font-weight: 700; color: #374151;">
                                Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align:right; padding: 15px; font-weight: 700; font-size: 1rem; color: #6b7280;">TOTAL AKHIR</td>
                            <td style="text-align:right; padding: 15px; font-weight: 800; font-size: 1.2rem; color: #8B5E3C;">
                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;">
            {{-- Update Status --}}
            <div class="card" style="border-top: 4px solid #c8a882;">
                <div style="font-size:1rem; font-weight:800; margin-bottom:15px; color: #5a3825; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-sliders"></i> Atur Status
                </div>
                <form action="{{ route('admin.pesanan.updateStatus', $pesanan) }}" method="POST">
                    @csrf @method('PUT')
                    <div style="margin-bottom: 15px;">
                        <label for="status_pembayaran" style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase;">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran" style="margin-top: 5px;">
                            @foreach(['Belum Bayar','Sudah Bayar'] as $sp)
                                <option value="{{ $sp }}" @selected($pesanan->status_pembayaran === $sp)>{{ $sp }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="status" style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase;">Status Pesanan</label>
                        <select name="status" id="status" style="margin-top: 5px;">
                            @foreach(['Pending','Diproses','Dikirim','Selesai'] as $s)
                                <option value="{{ $s }}" @selected($pesanan->status === $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; border-radius: 10px; font-weight: 700;">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- Custom Cake (jika ada) --}}
            @if($pesanan->tulisan_kue)
            <div class="card" style="background:#fff8f0; border: 1px solid #f5c97a;">
                <div style="font-size:1rem; font-weight:800; margin-bottom:12px; color: #854d0e; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-cake-candles"></i> Custom Cake
                </div>
                <div style="font-size:.88rem;">
                    <div style="margin-bottom: 10px;">
                        <span style="color:#b45309; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Tulisan / Ucapan</span><br>
                        <strong style="color: #451a03; font-size: 0.95rem;">"{{ $pesanan->tulisan_kue }}"</strong>
                    </div>
                    @if($pesanan->catatan_custom)
                    <div>
                        <span style="color:#b45309; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Catatan Tambahan</span><br>
                        <div style="color: #451a03; font-style: italic;">{{ $pesanan->catatan_custom }}</div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <div style="margin-top:10px;">
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary" style="width: 100%; text-align: center; padding: 10px; border-radius: 10px; font-weight: 600; background: #fff; border: 1px solid #e5e7eb;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
@endsection
