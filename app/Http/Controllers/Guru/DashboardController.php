<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;
use App\Models\Alternatif;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Alternatif::count();
        $hasilTerbaru = HasilSaw::with('alternatif')->orderBy('updated_at', 'desc')->limit(5)->get();

        return view('guru.dashboard', compact('totalSiswa', 'hasilTerbaru'));
    }
}
