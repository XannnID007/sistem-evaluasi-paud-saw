<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        try {
            Kriteria::create($request->all());
            return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kriteria: ' . $e->getMessage());
        }
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

        try {
            $kriteria->update($request->all());
            return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate kriteria: ' . $e->getMessage());
        }
    }

    public function destroy(Kriteria $kriteria)
    {
        try {
            // Cek apakah kriteria memiliki penilaian
            $hasPenilaian = DB::table('penilaian')->where('kriteria_id', $kriteria->id)->exists();

            if ($hasPenilaian) {
                return redirect()->route('admin.kriteria.index')
                    ->with('error', 'Kriteria tidak dapat dihapus karena sudah digunakan dalam penilaian');
            }

            // Hapus subkriteria terlebih dahulu
            $kriteria->subkriteria()->delete();

            // Hapus kriteria
            $kriteria->delete();

            return redirect()->route('admin.kriteria.index')
                ->with('success', 'Kriteria berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.kriteria.index')
                ->with('error', 'Gagal menghapus kriteria: ' . $e->getMessage());
        }
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

        try {
            // Cek apakah skor sudah ada untuk kriteria ini
            $exists = Subkriteria::where('kriteria_id', $id)
                ->where('skor', $request->skor)
                ->exists();

            if ($exists) {
                return redirect()->back()->with('error', 'Skor ' . $request->skor . ' sudah ada untuk kriteria ini');
            }

            Subkriteria::create([
                'kriteria_id' => $id,
                'nilai' => $request->nilai,
                'skor' => $request->skor
            ]);

            return redirect()->route('admin.kriteria.subkriteria', $id)
                ->with('success', 'Subkriteria berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan subkriteria: ' . $e->getMessage());
        }
    }

    public function destroySubkriteria(Subkriteria $subkriteria)
    {
        try {
            $kriteria_id = $subkriteria->kriteria_id;

            // Cek apakah subkriteria digunakan dalam penilaian
            $hasPenilaian = DB::table('penilaian')
                ->where('kriteria_id', $subkriteria->kriteria_id)
                ->where('nilai', $subkriteria->skor)
                ->exists();

            if ($hasPenilaian) {
                return redirect()->route('admin.kriteria.subkriteria', $kriteria_id)
                    ->with('error', 'Subkriteria tidak dapat dihapus karena sudah digunakan dalam penilaian');
            }

            $subkriteria->delete();

            return redirect()->route('admin.kriteria.subkriteria', $kriteria_id)
                ->with('success', 'Subkriteria berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus subkriteria: ' . $e->getMessage());
        }
    }
}
