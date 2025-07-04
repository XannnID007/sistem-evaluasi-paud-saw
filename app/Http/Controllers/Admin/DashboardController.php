<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\User;
use App\Models\HasilSaw;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalKriteria' => Kriteria::count(),
            'totalSiswa' => Alternatif::count(),
            'totalGuru' => User::where('role', 'guru')->count(),
            'totalHasil' => HasilSaw::count(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}
