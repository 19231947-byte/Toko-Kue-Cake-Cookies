<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan - Ayasha Cake & Cookies</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #5a3825; }
        .header p { margin: 5px 0; color: #666; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; text-align: right; }
        .total-row { font-weight: bold; background-color: #f9f9f9; }
        .badge { padding: 2px 6px; border-radius: 10px; font-size: 10px; font-weight: bold; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>AYASHA CAKE & COOKIES</h2>
        <p>Laporan Penjualan Terverifikasi</p>
        <p>Periode: {{ $startDate ? date('d/m/Y', strtotime($startDate)) : '-' }} s/d {{ $endDate ? date('d/m/Y', strtotime($endDate)) : '-' }}</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>Dicetak pada: {{ date('d/m/Y H:i') }}</td>
                <td class="text-right">Total Data: {{ count($laporans) }} Pesanan</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Status Bayar</th>
                <th>Status Pesanan</th>
                <th class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $index => $laporan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $laporan->nama ?? ($laporan->user->name ?? '-') }}</td>
                    <td>{{ $laporan->status_pembayaran }}</td>
                    <td>{{ $laporan->status }}</td>
                    <td class="text-right">Rp {{ number_format($laporan->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5" class="text-right">TOTAL PENDAPATAN</td>
                <td class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Tanda Tangan,</p>
        <br><br><br>
        <p><strong>Admin Ayasha Cake</strong></p>
    </div>
</body>
</html>
