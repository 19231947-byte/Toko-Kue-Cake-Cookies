<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode')->get();
        return view('admin.kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'          => ['required', 'string', 'max:10', 'unique:kriterias,kode'],
            'nama_kriteria' => ['required', 'string', 'max:255'],
            'tipe'          => ['required', 'in:Benefit,Cost'],
            'bobot'         => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        Kriteria::create($request->only('kode', 'nama_kriteria', 'tipe', 'bobot'));

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'kode'          => ['required', 'string', 'max:10', 'unique:kriterias,kode,' . $kriteria->id],
            'nama_kriteria' => ['required', 'string', 'max:255'],
            'tipe'          => ['required', 'in:Benefit,Cost'],
            'bobot'         => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $kriteria->update($request->only('kode', 'nama_kriteria', 'tipe', 'bobot'));

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus.');
    }
}
