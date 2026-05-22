<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\PenilaianAlternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::orderBy('kode')->get();
        return view('admin.alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('admin.alternatif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'            => ['required', 'string', 'max:10', 'unique:alternatifs,kode'],
            'nama_alternatif' => ['required', 'string', 'max:255'],
        ]);

        Alternatif::create($request->only('kode', 'nama_alternatif'));

        return redirect()->route('admin.alternatif.index')
            ->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('admin.alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'kode'            => ['required', 'string', 'max:10', 'unique:alternatifs,kode,' . $alternatif->id],
            'nama_alternatif' => ['required', 'string', 'max:255'],
        ]);

        $alternatif->update($request->only('kode', 'nama_alternatif'));

        return redirect()->route('admin.alternatif.index')
            ->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('admin.alternatif.index')
            ->with('success', 'Alternatif berhasil dihapus.');
    }

    // Tampilkan form input nilai per kriteria
    public function inputNilai(Alternatif $alternatif)
    {
        $kriterias   = Kriteria::orderBy('kode')->get();
        $penilaians  = PenilaianAlternatif::where('alternatif_id', $alternatif->id)
                        ->pluck('nilai', 'kriteria_id');

        return view('admin.alternatif.input-nilai', compact('alternatif', 'kriterias', 'penilaians'));
    }

    // Simpan / update nilai
    public function simpanNilai(Request $request, Alternatif $alternatif)
    {
        $kriterias = Kriteria::orderBy('kode')->get();

        $rules = [];
        foreach ($kriterias as $k) {
            $rules["nilai.{$k->id}"] = ['required', 'numeric', 'min:0'];
        }
        $request->validate($rules);

        foreach ($kriterias as $k) {
            PenilaianAlternatif::updateOrCreate(
                ['alternatif_id' => $alternatif->id, 'kriteria_id' => $k->id],
                ['nilai' => $request->input("nilai.{$k->id}")]
            );
        }

        return redirect()->route('admin.alternatif.index')
            ->with('success', "Nilai untuk {$alternatif->nama_alternatif} berhasil disimpan.");
    }

    // Lihat nilai
    public function lihatNilai(Alternatif $alternatif)
    {
        $penilaians = PenilaianAlternatif::with('kriteria')
                        ->where('alternatif_id', $alternatif->id)
                        ->get()
                        ->sortBy('kriteria.kode');

        return view('admin.alternatif.lihat-nilai', compact('alternatif', 'penilaians'));
    }
}
