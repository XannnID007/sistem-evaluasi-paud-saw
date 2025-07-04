<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function hasil()
    {
        $hasil = HasilSaw::with('alternatif')->orderBy('ranking')->get();
        return view('admin.saw.hasil', compact('hasil'));
    }
}
