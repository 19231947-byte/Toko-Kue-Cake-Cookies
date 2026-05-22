<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pesanan::with('user')
            ->where(function($q) {
                $q->where('status', 'Selesai')
                  ->orWhere('status_pembayaran', 'Sudah Bayar');
            });

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $laporans = $query->orderByDesc('created_at')->get();
        $totalPendapatan = $laporans->sum('total_harga');

        return view('admin.laporan.index', compact('laporans', 'totalPendapatan', 'startDate', 'endDate'));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pesanan::with(['user', 'detailPesanans.produk'])
            ->where(function($q) {
                $q->where('status', 'Selesai')
                  ->orWhere('status_pembayaran', 'Sudah Bayar');
            });

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $laporans = $query->orderByDesc('created_at')->get();
        $totalPendapatan = $laporans->sum('total_harga');

        // Menggunakan view khusus untuk PDF
        return view('admin.laporan.pdf', compact('laporans', 'totalPendapatan', 'startDate', 'endDate'));
    }
}
