<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index(Request $request)
    {
        $query = Alternatif::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode', 'like', "%{$search}%")
                    ->orWhere('nama_orangtua', 'like', "%{$search}%");
            });
        }

        // Filter by gender
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        // Validate sort columns
        $allowedSorts = ['nama', 'kode', 'jenis_kelamin', 'tanggal_lahir', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $query->orderBy($sortBy, $sortOrder);

        // Per page
        $perPage = $request->get('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $alternatif = $query->paginate($perPage)->withQueryString();

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
