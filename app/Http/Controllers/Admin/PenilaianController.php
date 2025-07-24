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
    public function index(Request $request)
    {
        $query = Alternatif::with(['penilaian.kriteria']);
        $kriteria = Kriteria::all();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode', 'like', "%{$search}%");
            });
        }

        // Filter by assessment status
        if ($request->filled('status')) {
            $totalKriteria = $kriteria->count();

            switch ($request->status) {
                case 'lengkap':
                    $query->whereHas('penilaian', function ($q) use ($totalKriteria) {
                        $q->select('alternatif_id')
                            ->groupBy('alternatif_id')
                            ->havingRaw('COUNT(DISTINCT kriteria_id) = ?', [$totalKriteria]);
                    });
                    break;
                case 'belum':
                    $query->whereDoesntHave('penilaian');
                    break;
                case 'sebagian':
                    $query->whereHas('penilaian', function ($q) use ($totalKriteria) {
                        $q->select('alternatif_id')
                            ->groupBy('alternatif_id')
                            ->havingRaw('COUNT(DISTINCT kriteria_id) < ?', [$totalKriteria]);
                    });
                    break;
            }
        }

        // Sorting
        $sortBy = $request->get('sort', 'nama');
        $sortOrder = $request->get('order', 'asc');

        // Validate sort columns
        $allowedSorts = ['nama', 'kode', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'nama';
        }

        $query->orderBy($sortBy, $sortOrder);

        // Per page
        $perPage = $request->get('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $alternatif = $query->paginate($perPage)->withQueryString();

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
            'alternatif_id' => 'required|exists:alternatif,alternatif_id', // Sesuaikan dengan primary key baru
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

    public function edit($alternatif_id) // Parameter disesuaikan
    {
        $alternatif = Alternatif::where('alternatif_id', $alternatif_id)->firstOrFail();
        $kriteria = Kriteria::with('subkriteria')->get();
        $penilaian = Penilaian::where('alternatif_id', $alternatif_id)->pluck('nilai', 'kriteria_id');

        return view('admin.penilaian.edit', compact('alternatif', 'kriteria', 'penilaian'));
    }

    public function update(Request $request, $alternatif_id) // Parameter disesuaikan
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
