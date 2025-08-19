<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
     public function cetakHasilEvaluasi(Request $request)
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

          $pdf = Pdf::loadView('guru.reports.hasil-evaluasi', compact('hasil', 'kriteria', 'statistik'))
               ->setPaper('a4', 'portrait')
               ->setOptions([
                    'dpi' => 150,
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
               ]);

          $filename = 'Laporan_Hasil_Evaluasi_Guru_' . date('Y-m-d_H-i-s') . '.pdf';

          return $pdf->download($filename);
     }
}
