<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SawService;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\HasilSaw;

class SawController extends Controller
{
    protected $sawService;

    public function __construct(SawService $sawService)
    {
        $this->sawService = $sawService;
    }

    public function index()
    {
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();

        // Matriks Keputusan
        $matriksKeputusan = $this->sawService->getMatriksKeputusan();

        // Matriks Normalisasi
        $matriksNormalisasi = $this->sawService->getMatriksNormalisasi();

        return view('admin.saw.index', compact('kriteria', 'alternatif', 'matriksKeputusan', 'matriksNormalisasi'));
    }

    public function proses()
    {
        $hasil = $this->sawService->hitungSAW();
        return redirect()->route('admin.saw.hasil')->with('success', 'Perhitungan SAW berhasil diproses');
    }

    public function hasil(Request $request)
    {
        $query = HasilSaw::with('alternatif');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('alternatif', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by ranking range
        if ($request->filled('ranking_from') && $request->filled('ranking_to')) {
            $query->whereBetween('ranking', [$request->ranking_from, $request->ranking_to]);
        }

        // Sorting
        $sortBy = $request->get('sort', 'ranking');
        $sortOrder = $request->get('order', 'asc');

        // Validate sort columns
        $allowedSorts = ['ranking', 'skor_akhir', 'kategori'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'ranking';
        }

        $query->orderBy($sortBy, $sortOrder);

        // Per page
        $perPage = $request->get('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $hasil = $query->paginate($perPage)->withQueryString();

        return view('admin.saw.hasil', compact('hasil'));
    }
}
