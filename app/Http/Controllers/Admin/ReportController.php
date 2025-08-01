<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class ReportController extends Controller
{
    public function cetakHasilSaw(Request $request)
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

        $pdf = PDF::loadView('reports.hasil-saw', compact('hasil', 'kriteria', 'statistik'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $filename = 'Laporan_Hasil_SAW_' . date('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($filename);
    }

    public function cetakDataSiswa(Request $request)
    {
        $query = Alternatif::with(['penilaian.kriteria']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode', 'like', "%{$search}%")
                    ->orWhere('nama_orangtua', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        $alternatif = $query->orderBy('nama')->get();
        $kriteria = Kriteria::with('subkriteria')->get();

        $statistik = [
            'total_siswa' => $alternatif->count(),
            'laki_laki' => $alternatif->where('jenis_kelamin', 'L')->count(),
            'perempuan' => $alternatif->where('jenis_kelamin', 'P')->count(),
            'rata_rata_umur' => $alternatif->avg('umur'),
            'sudah_dinilai' => $alternatif->filter(function ($siswa) use ($kriteria) {
                return $siswa->penilaian->count() == $kriteria->count();
            })->count(),
        ];

        $pdf = PDF::loadView('reports.data-siswa', compact('alternatif', 'kriteria', 'statistik'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $filename = 'Laporan_Data_Siswa_' . date('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($filename);
    }

    public function cetakNilaiAlternatif(Request $request)
    {
        $alternatif = Alternatif::with(['penilaian.kriteria'])->get();
        $kriteria = Kriteria::all();

        // Hitung progress penilaian
        $lengkap = $alternatif->filter(function ($siswa) use ($kriteria) {
            return $siswa->penilaian->count() == $kriteria->count();
        })->count();

        $belum = $alternatif->filter(function ($siswa) {
            return $siswa->penilaian->count() == 0;
        })->count();

        $sebagian = $alternatif->count() - $lengkap - $belum;

        $statistik = [
            'total_siswa' => $alternatif->count(),
            'penilaian_lengkap' => $lengkap,
            'penilaian_sebagian' => $sebagian,
            'belum_dinilai' => $belum,
            'persentase_lengkap' => $alternatif->count() > 0 ? ($lengkap / $alternatif->count()) * 100 : 0,
        ];

        $pdf = PDF::loadView('reports.nilai-alternatif', compact('alternatif', 'kriteria', 'statistik'))
            ->setPaper('a4', 'landscape') // Landscape untuk tabel yang lebar
            ->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $filename = 'Laporan_Nilai_Alternatif_' . date('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($filename);
    }

    public function cetakMatriksSaw(Request $request)
    {
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();

        // Ambil service SAW untuk mendapatkan matriks
        $sawService = app(\App\Services\SawService::class);
        $matriksKeputusan = $sawService->getMatriksKeputusan();
        $matriksNormalisasi = $sawService->getMatriksNormalisasi();

        $data = [
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'matriks_keputusan' => $matriksKeputusan,
            'matriks_normalisasi' => $matriksNormalisasi,
            'total_bobot' => $kriteria->sum('bobot'),
        ];

        $pdf = PDF::loadView('reports.matriks-saw', $data)
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $filename = 'Laporan_Matriks_SAW_' . date('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($filename);
    }
}
