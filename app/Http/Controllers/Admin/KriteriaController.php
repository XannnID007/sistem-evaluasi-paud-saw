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
            'kode' => 'required|max:10|unique:kriteria', // ✅ UPDATE: tambah max:10
            'nama' => 'required|max:150', // ✅ UPDATE: tambah max:150
            'bobot' => 'required|numeric|min:0|max:1',
        ]);

        try {
            Kriteria::create($request->all());
            return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kriteria: ' . $e->getMessage());
        }
    }

    public function edit($kriteria_id)
    {
        $kriteria = Kriteria::where('kriteria_id', $kriteria_id)->firstOrFail();
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $kriteria_id)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kriteria,kode,' . $kriteria_id . ',kriteria_id', // ✅ UPDATE: tambah max:10
            'nama' => 'required|max:150', // ✅ UPDATE: tambah max:150
            'bobot' => 'required|numeric|min:0|max:1',
        ]);

        try {
            $kriteria = Kriteria::where('kriteria_id', $kriteria_id)->firstOrFail();
            $kriteria->update($request->all());
            return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate kriteria: ' . $e->getMessage());
        }
    }

    public function destroy($kriteria_id)
    {
        try {
            $kriteria = Kriteria::where('kriteria_id', $kriteria_id)->firstOrFail();

            // Cek apakah kriteria memiliki penilaian
            $hasPenilaian = DB::table('penilaian')->where('kriteria_id', $kriteria_id)->exists();

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

    public function subkriteria($kriteria_id)
    {
        $kriteria = Kriteria::with('subkriteria')->where('kriteria_id', $kriteria_id)->firstOrFail();
        return view('admin.kriteria.subkriteria', compact('kriteria'));
    }

    public function storeSubkriteria(Request $request, $kriteria_id)
    {
        $request->validate([
            'nilai' => 'required|max:100', // ✅ UPDATE: tambah max:100
            'skor' => 'required|integer|min:1|max:4',
        ]);

        try {
            // Cek apakah skor sudah ada untuk kriteria ini
            $exists = Subkriteria::where('kriteria_id', $kriteria_id)
                ->where('skor', $request->skor)
                ->exists();

            if ($exists) {
                return redirect()->back()->with('error', 'Skor ' . $request->skor . ' sudah ada untuk kriteria ini');
            }

            Subkriteria::create([
                'kriteria_id' => $kriteria_id,
                'nilai' => $request->nilai,
                'skor' => $request->skor
            ]);

            return redirect()->route('admin.kriteria.subkriteria', $kriteria_id)
                ->with('success', 'Subkriteria berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan subkriteria: ' . $e->getMessage());
        }
    }

    public function destroySubkriteria($subdatakriteria_id)
    {
        try {
            $subkriteria = Subkriteria::where('subdatakriteria_id', $subdatakriteria_id)->firstOrFail();
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
