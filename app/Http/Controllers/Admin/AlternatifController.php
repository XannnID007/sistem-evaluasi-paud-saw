<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.alternatif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:alternatif', // ✅ UPDATE: tambah max:10
            'nama' => 'required|string|max:100', // ✅ UPDATE: max:255 → max:100
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'nama_orangtua' => 'nullable|string|max:100', // ✅ UPDATE: max:255 → max:100
            'alamat' => 'nullable|string'
        ]);

        try {
            $data = $request->all();
            $data['user_id'] = auth()->user()->user_id;

            Alternatif::create($data);

            return redirect()->route('admin.alternatif.index')
                ->with('success', 'Data siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data siswa: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($alternatif_id)
    {
        $alternatif = Alternatif::where('alternatif_id', $alternatif_id)->firstOrFail();
        return view('admin.alternatif.show', compact('alternatif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($alternatif_id)
    {
        $alternatif = Alternatif::where('alternatif_id', $alternatif_id)->firstOrFail();
        return view('admin.alternatif.edit', compact('alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $alternatif_id)
    {
        $alternatif = Alternatif::where('alternatif_id', $alternatif_id)->firstOrFail();

        $request->validate([
            'kode' => 'required|max:10|unique:alternatif,kode,' . $alternatif_id . ',alternatif_id', // ✅ UPDATE: tambah max:10
            'nama' => 'required|string|max:100', // ✅ UPDATE: max:255 → max:100
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'nama_orangtua' => 'nullable|string|max:100', // ✅ UPDATE: max:255 → max:100
            'alamat' => 'nullable|string'
        ]);

        try {
            $alternatif->update($request->all());

            return redirect()->route('admin.alternatif.index')
                ->with('success', 'Data siswa berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate data siswa: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($alternatif_id)
    {
        try {
            $alternatif = Alternatif::where('alternatif_id', $alternatif_id)->firstOrFail();

            // Cek apakah alternatif memiliki penilaian
            if ($alternatif->penilaian()->exists()) {
                return redirect()->route('admin.alternatif.index')
                    ->with('error', 'Data siswa tidak dapat dihapus karena sudah memiliki penilaian');
            }

            $nama = $alternatif->nama;
            $alternatif->delete();

            return redirect()->route('admin.alternatif.index')
                ->with('success', "Data siswa {$nama} berhasil dihapus");
        } catch (\Exception $e) {
            return redirect()->route('admin.alternatif.index')
                ->with('error', 'Gagal menghapus data siswa: ' . $e->getMessage());
        }
    }

    /**
     * Get alternatif data for AJAX requests
     */
    public function getAlternatifData($alternatif_id)
    {
        try {
            $alternatif = Alternatif::where('alternatif_id', $alternatif_id)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $alternatif
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Export alternatif data
     */
    public function export(Request $request)
    {
        $query = Alternatif::query();

        // Apply same filters as index
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

        // Return CSV download
        $filename = 'data_siswa_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($alternatif) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, [
                'No',
                'Kode',
                'Nama',
                'Jenis Kelamin',
                'Tanggal Lahir',
                'Umur',
                'Nama Orang Tua',
                'Alamat',
                'Terdaftar'
            ]);

            // Data CSV
            $no = 1;
            foreach ($alternatif as $siswa) {
                fputcsv($file, [
                    $no++,
                    $siswa->kode,
                    $siswa->nama,
                    $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                    $siswa->tanggal_lahir->format('d/m/Y'),
                    $siswa->umur . ' tahun',
                    $siswa->nama_orangtua ?? '-',
                    $siswa->alamat ?? '-',
                    $siswa->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Bulk delete alternatif
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:alternatif,alternatif_id'
        ]);

        try {
            $count = 0;
            $errors = [];

            foreach ($request->ids as $alternatif_id) {
                $alternatif = Alternatif::where('alternatif_id', $alternatif_id)->first();

                if ($alternatif) {
                    // Cek apakah memiliki penilaian
                    if ($alternatif->penilaian()->exists()) {
                        $errors[] = "Siswa {$alternatif->nama} tidak dapat dihapus karena sudah memiliki penilaian";
                        continue;
                    }

                    $alternatif->delete();
                    $count++;
                }
            }

            $message = "Berhasil menghapus {$count} data siswa";
            if (!empty($errors)) {
                $message .= ". Beberapa data tidak dapat dihapus: " . implode(', ', $errors);
            }

            return redirect()->route('admin.alternatif.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('admin.alternatif.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
