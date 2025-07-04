@extends('layouts.app')

@section('title', 'Perhitungan SAW')
@section('breadcrumb', 'Admin / Perhitungan SAW')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Perhitungan SAW</h1>
                <p class="page-subtitle">Simple Additive Weighting untuk evaluasi perkembangan anak</p>
            </div>
            <div class="d-flex gap-2">
                <form action="{{ route('admin.saw.proses') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Proses perhitungan SAW?')">
                        <i class="fas fa-calculator me-2"></i>
                        Proses SAW
                    </button>
                </form>
                <a href="{{ route('admin.saw.hasil') }}" class="btn btn-success">
                    <i class="fas fa-chart-line me-2"></i>
                    Lihat Hasil
                </a>
            </div>
        </div>
    </div>

    <!-- Langkah Perhitungan SAW -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="fas fa-table text-white fs-4"></i>
                    </div>
                    <h6 class="card-title">1. Matriks Keputusan</h6>
                    <p class="card-text text-muted small">Tabel nilai setiap alternatif untuk setiap kriteria</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="bg-warning bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="fas fa-arrows-alt text-white fs-4"></i>
                    </div>
                    <h6 class="card-title">2. Normalisasi</h6>
                    <p class="card-text text-muted small">Mengubah nilai menjadi skala 0-1</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="fas fa-weight-hanging text-white fs-4"></i>
                    </div>
                    <h6 class="card-title">3. Perkalian Bobot</h6>
                    <p class="card-text text-muted small">Nilai normalisasi × bobot kriteria</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="fas fa-trophy text-white fs-4"></i>
                    </div>
                    <h6 class="card-title">4. Ranking</h6>
                    <p class="card-text text-muted small">Urutkan berdasarkan skor tertinggi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Matriks Keputusan -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-table me-2"></i>
                Matriks Keputusan
            </h5>
        </div>
        <div class="card-body">
            @if (count($matriksKeputusan) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Alternatif</th>
                                @foreach ($kriteria as $k)
                                    <th class="text-center">{{ $k->kode }}<br><small
                                            class="fw-normal">({{ $k->bobot }})</small></th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matriksKeputusan as $row)
                                <tr>
                                    <td class="fw-bold">{{ $row['alternatif']->kode }} - {{ $row['alternatif']->nama }}</td>
                                    @foreach ($kriteria as $k)
                                        <td class="text-center">
                                            <span class="badge bg-primary">{{ $row[$k->kode] }}</span>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size: 3rem;"></i>
                    <h5 class="text-muted">Data Belum Lengkap</h5>
                    <p class="text-muted">Pastikan semua siswa sudah dinilai untuk semua kriteria</p>
                    <a href="{{ route('admin.penilaian.index') }}" class="btn btn-primary">
                        <i class="fas fa-clipboard-check me-2"></i>
                        Input Penilaian
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Matriks Normalisasi -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-arrows-alt me-2"></i>
                Matriks Normalisasi
            </h5>
        </div>
        <div class="card-body">
            @if (count($matriksNormalisasi) > 0)
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Rumus Normalisasi:</strong> R<sub>ij</sub> = X<sub>ij</sub> / Max(X<sub>ij</sub>) untuk kriteria
                    benefit
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th>Alternatif</th>
                                @foreach ($kriteria as $k)
                                    <th class="text-center">{{ $k->kode }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matriksNormalisasi as $row)
                                <tr>
                                    <td class="fw-bold">{{ $row['alternatif']->kode }} - {{ $row['alternatif']->nama }}
                                    </td>
                                    @foreach ($kriteria as $k)
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark">{{ $row[$k->kode] }}</span>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-calculator mb-3" style="font-size: 2rem;"></i>
                    <p>Matriks normalisasi akan muncul setelah data penilaian lengkap</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Informasi Kriteria dan Bobot -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-weight-hanging me-2"></i>
                Informasi Kriteria dan Bobot
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($kriteria as $k)
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">{{ $k->kode }}</h6>
                                <span class="badge bg-primary">{{ number_format($k->bobot, 3) }}</span>
                            </div>
                            <p class="mb-0 small text-muted">{{ $k->nama }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @php $totalBobot = $kriteria->sum('bobot'); @endphp
            <div class="alert {{ abs($totalBobot - 1) < 0.001 ? 'alert-success' : 'alert-warning' }} mb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <i
                            class="fas {{ abs($totalBobot - 1) < 0.001 ? 'fa-check-circle' : 'fa-exclamation-triangle' }} me-2"></i>
                        Total Bobot: <strong>{{ number_format($totalBobot, 3) }}</strong>
                    </span>
                    @if (abs($totalBobot - 1) >= 0.001)
                        <a href="{{ route('admin.kriteria.index') }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit me-1"></i>
                            Sesuaikan Bobot
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
