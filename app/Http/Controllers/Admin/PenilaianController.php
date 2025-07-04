<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::with(['penilaian.kriteria'])->get();
        $kriteria = Kriteria::all();
        return view('admin.penilaian.index', compact('alternatif', 'kriteria'));
    }

    public function create()
    {
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::with('subkriteria')->get();
        return view('admin.penilaian.create', compact('alternatif', 'kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatif,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:4',
        ]);

        // Hapus penilaian lama jika ada
        Penilaian::where('alternatif_id', $request->alternatif_id)->delete();

        // Simpan penilaian baru
        foreach ($request->nilai as $kriteria_id => $nilai) {
            Penilaian::create([
                'alternatif_id' => $request->alternatif_id,
                'kriteria_id' => $kriteria_id,
                'nilai' => $nilai
            ]);
        }

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil disimpan');
    }

    public function edit($alternatif_id)
    {
        $alternatif = Alternatif::findOrFail($alternatif_id);
        $kriteria = Kriteria::with('subkriteria')->get();
        $penilaian = Penilaian::where('alternatif_id', $alternatif_id)->pluck('nilai', 'kriteria_id');

        return view('admin.penilaian.edit', compact('alternatif', 'kriteria', 'penilaian'));
    }

    public function update(Request $request, $alternatif_id)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:4',
        ]);

        // Hapus penilaian lama
        Penilaian::where('alternatif_id', $alternatif_id)->delete();

        // Simpan penilaian baru
        foreach ($request->nilai as $kriteria_id => $nilai) {
            Penilaian::create([
                'alternatif_id' => $alternatif_id,
                'kriteria_id' => $kriteria_id,
                'nilai' => $nilai
            ]);
        }

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil diupdate');
    }
}
