<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\HasilSaw;

class HasilController extends Controller
{
    public function index()
    {
        $hasil = HasilSaw::with('alternatif')->orderBy('ranking')->get();
        return view('guru.hasil.index', compact('hasil'));
    }
}
