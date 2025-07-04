<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::latest()->get();
        return view('admin.alternatif.index', compact('alternatif'));
    }

    public function create()
    {
        return view('admin.alternatif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:alternatif',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
        ]);

        Alternatif::create($request->all());
        return redirect()->route('admin.alternatif.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('admin.alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'kode' => 'required|unique:alternatif,kode,' . $alternatif->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
        ]);

        $alternatif->update($request->all());
        return redirect()->route('admin.alternatif.index')->with('success', 'Data siswa berhasil diupdate');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('admin.alternatif.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
