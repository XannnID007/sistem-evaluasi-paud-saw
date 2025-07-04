<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::with('subkriteria')->get();
        return view('admin.kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria',
            'nama' => 'required',
            'bobot' => 'required|numeric|min:0|max:1',
        ]);

        Kriteria::create($request->all());
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria,kode,' . $kriteria->id,
            'nama' => 'required',
            'bobot' => 'required|numeric|min:0|max:1',
        ]);

        $kriteria->update($request->all());
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diupdate');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }

    public function subkriteria($id)
    {
        $kriteria = Kriteria::with('subkriteria')->findOrFail($id);
        return view('admin.kriteria.subkriteria', compact('kriteria'));
    }

    public function storeSubkriteria(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required',
            'skor' => 'required|integer|min:1|max:4',
        ]);

        Subkriteria::create([
            'kriteria_id' => $id,
            'nilai' => $request->nilai,
            'skor' => $request->skor
        ]);

        return redirect()->route('admin.kriteria.subkriteria', $id)->with('success', 'Subkriteria berhasil ditambahkan');
    }

    public function destroySubkriteria(Subkriteria $subkriteria)
    {
        $kriteria_id = $subkriteria->kriteria_id;
        $subkriteria->delete();
        return redirect()->route('admin.kriteria.subkriteria', $kriteria_id)->with('success', 'Subkriteria berhasil dihapus');
    }
}
