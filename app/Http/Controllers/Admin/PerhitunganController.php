<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\PenilaianAlternatif;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriterias   = Kriteria::orderBy('kode')->get();
        $alternatifs = Alternatif::orderBy('kode')->get();

        if ($kriterias->isEmpty() || $alternatifs->isEmpty()) {
            return view('admin.perhitungan.index', [
                'kriterias'      => $kriterias,
                'alternatifs'    => $alternatifs,
                'normalisasi'    => collect(),
                'matriksNilai'   => [],
                'matriksUtility' => [],
                'nilaiAkhir'     => [],
                'tidakLengkap'   => false,
            ]);
        }

        // 1. Normalisasi bobot
        $totalBobot  = $kriterias->sum('bobot');
        $normalisasi = $kriterias->map(fn($k) => [
            'id'           => $k->id,
            'kode'         => $k->kode,
            'nama'         => $k->nama_kriteria,
            'tipe'         => $k->tipe,
            'bobot_awal'   => (float) $k->bobot,
            'normalisasi'  => $totalBobot > 0 ? round($k->bobot / $totalBobot, 4) : 0,
        ]);

        // 2. Matriks nilai mentah [alternatif_id][kriteria_id]
        $semuaNilai  = PenilaianAlternatif::whereIn('alternatif_id', $alternatifs->pluck('id'))
                        ->whereIn('kriteria_id', $kriterias->pluck('id'))
                        ->get();

        $matriksNilai  = [];
        $tidakLengkap  = false;

        foreach ($alternatifs as $a) {
            foreach ($kriterias as $k) {
                $row = $semuaNilai->first(fn($p) => $p->alternatif_id == $a->id && $p->kriteria_id == $k->id);
                $matriksNilai[$a->id][$k->id] = $row ? (float) $row->nilai : null;
                if ($row === null) $tidakLengkap = true;
            }
        }

        // 3. Utility per kriteria
        $matriksUtility = [];

        foreach ($kriterias as $k) {
            $vals = collect($alternatifs)
                ->map(fn($a) => $matriksNilai[$a->id][$k->id])
                ->filter(fn($v) => $v !== null);

            $cmax = $vals->max();
            $cmin = $vals->min();
            $diff = $cmax - $cmin;

            foreach ($alternatifs as $a) {
                $val = $matriksNilai[$a->id][$k->id];

                if ($val === null) {
                    $matriksUtility[$a->id][$k->id] = null;
                } elseif ($diff == 0) {
                    $matriksUtility[$a->id][$k->id] = 1;
                } elseif ($k->tipe === 'Benefit') {
                    $matriksUtility[$a->id][$k->id] = round(($val - $cmin) / $diff, 4);
                } else {
                    $matriksUtility[$a->id][$k->id] = round(($cmax - $val) / $diff, 4);
                }
            }
        }

        // 4. Nilai akhir SMART
        $nilaiAkhir = [];
        foreach ($alternatifs as $a) {
            $total = 0;
            foreach ($kriterias as $k) {
                $w      = $totalBobot > 0 ? $k->bobot / $totalBobot : 0;
                $u      = $matriksUtility[$a->id][$k->id] ?? 0;
                $total += $w * $u;
            }
            $nilaiAkhir[$a->id] = round($total, 4);
        }

        arsort($nilaiAkhir);

        return view('admin.perhitungan.index', compact(
            'kriterias', 'alternatifs', 'normalisasi',
            'matriksNilai', 'matriksUtility', 'nilaiAkhir', 'tidakLengkap'
        ));
    }

    public function hasil()
    {
        $kriterias   = Kriteria::orderBy('kode')->get();
        $alternatifs = Alternatif::orderBy('kode')->get();

        if ($kriterias->isEmpty() || $alternatifs->isEmpty()) {
            return view('admin.perhitungan.hasil', [
                'alternatifs' => $alternatifs,
                'nilaiAkhir'  => [],
            ]);
        }

        $totalBobot = $kriterias->sum('bobot');
        $semuaNilai = PenilaianAlternatif::whereIn('alternatif_id', $alternatifs->pluck('id'))
                        ->whereIn('kriteria_id', $kriterias->pluck('id'))
                        ->get();

        $matriksNilai = [];
        foreach ($alternatifs as $a) {
            foreach ($kriterias as $k) {
                $row = $semuaNilai->first(fn($p) => $p->alternatif_id == $a->id && $p->kriteria_id == $k->id);
                $matriksNilai[$a->id][$k->id] = $row ? (float) $row->nilai : null;
            }
        }

        $matriksUtility = [];
        foreach ($kriterias as $k) {
            $vals = collect($alternatifs)->map(fn($a) => $matriksNilai[$a->id][$k->id])->filter(fn($v) => $v !== null);
            $cmax = $vals->max();
            $cmin = $vals->min();
            $diff = $cmax - $cmin;

            foreach ($alternatifs as $a) {
                $val = $matriksNilai[$a->id][$k->id];
                if ($val === null) {
                    $matriksUtility[$a->id][$k->id] = null;
                } elseif ($diff == 0) {
                    $matriksUtility[$a->id][$k->id] = 1;
                } elseif ($k->tipe === 'Benefit') {
                    $matriksUtility[$a->id][$k->id] = round(($val - $cmin) / $diff, 4);
                } else {
                    $matriksUtility[$a->id][$k->id] = round(($cmax - $val) / $diff, 4);
                }
            }
        }

        $nilaiAkhir = [];
        foreach ($alternatifs as $a) {
            $total = 0;
            foreach ($kriterias as $k) {
                $w      = $totalBobot > 0 ? $k->bobot / $totalBobot : 0;
                $u      = $matriksUtility[$a->id][$k->id] ?? 0;
                $total += $w * $u;
            }
            $nilaiAkhir[$a->id] = round($total, 4);
        }

        arsort($nilaiAkhir);

        return view('admin.perhitungan.hasil', compact('alternatifs', 'nilaiAkhir'));
    }
}
