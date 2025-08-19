<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index(Request $request)
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

        return view('guru.hasil.index', compact('hasil'));
    }

    /**
     * Export hasil evaluasi untuk guru
     */
    public function exportHasilPdf(Request $request)
    {
        $query = HasilSaw::with('alternatif');

        // Apply filters jika ada
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('alternatif', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('ranking_from') && $request->filled('ranking_to')) {
            $query->whereBetween('ranking', [$request->ranking_from, $request->ranking_to]);
        }

        $hasil = $query->orderBy('ranking', 'asc')->get();
        $kriteria = Kriteria::all();

        // Data statistik
        $statistik = [
            'total_siswa' => $hasil->count(),
            'sangat_baik' => $hasil->where('kategori', 'Sangat Baik')->count(),
            'baik' => $hasil->where('kategori', 'Baik')->count(),
            'cukup' => $hasil->where('kategori', 'Cukup')->count(),
            'kurang' => $hasil->where('kategori', 'Kurang')->count(),
            'rata_rata_skor' => $hasil->avg('skor_akhir'),
            'skor_tertinggi' => $hasil->max('skor_akhir'),
            'skor_terendah' => $hasil->min('skor_akhir'),
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('guru.reports.hasil-evaluasi', compact('hasil', 'kriteria', 'statistik'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $filename = 'Hasil_Evaluasi_Siswa_' . date('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($filename);
    }
}
