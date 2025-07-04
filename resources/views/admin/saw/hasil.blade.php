@extends('layouts.app')

@section('title', 'Hasil Perhitungan SAW')
@section('breadcrumb', 'Admin / Perhitungan SAW / Hasil')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Hasil Perhitungan SAW</h1>
                <p class="page-subtitle">Ranking evaluasi perkembangan anak berdasarkan metode SAW</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.saw.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali
                </a>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>
                    Cetak Laporan
                </button>
            </div>
        </div>
    </div>

    @if ($hasil->count() > 0)
        <!-- Ringkasan Hasil -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-trophy text-white fs-4"></i>
                        </div>
                        <h6 class="card-title">Peringkat 1</h6>
                        <p class="card-text">
                            <strong>{{ $hasil->first()->alternatif->nama }}</strong><br>
                            <span class="badge bg-success">{{ number_format($hasil->first()->skor_akhir, 4) }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-pie text-success mb-3" style="font-size: 2.5rem;"></i>
                        <h6 class="card-title">Sangat Baik</h6>
                        <p class="card-text">
                            <strong>{{ $hasil->where('kategori', 'Sangat Baik')->count() }}</strong> siswa<br>
                            <small class="text-muted">Skor ≥ 0.8</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line text-primary mb-3" style="font-size: 2.5rem;"></i>
                        <h6 class="card-title">Baik</h6>
                        <p class="card-text">
                            <strong>{{ $hasil->where('kategori', 'Baik')->count() }}</strong> siswa<br>
                            <small class="text-muted">Skor 0.6 - 0.79</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-users text-warning mb-3" style="font-size: 2.5rem;"></i>
                        <h6 class="card-title">Total Siswa</h6>
                        <p class="card-text">
                            <strong>{{ $hasil->count() }}</strong> siswa<br>
                            <small class="text-muted">telah dievaluasi</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Hasil Ranking -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list-ol me-2"></i>
                    Ranking Hasil Evaluasi
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Kode</th>
                                <th>Nama Siswa</th>
                                <th>Skor Akhir</th>
                                <th>Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $item)
                                <tr>
                                    <td>
                                        @if ($item->ranking == 1)
                                            <span class="badge bg-warning fs-6">
                                                <i class="fas fa-trophy me-1"></i>
                                                {{ $item->ranking }}
                                            </span>
                                        @elseif($item->ranking == 2)
                                            <span class="badge bg-secondary fs-6">
                                                <i class="fas fa-medal me-1"></i>
                                                {{ $item->ranking }}
                                            </span>
                                        @elseif($item->ranking == 3)
                                            <span class="badge bg-warning fs-6" style="background: #cd7f32 !important;">
                                                <i class="fas fa-award me-1"></i>
                                                {{ $item->ranking }}
                                            </span>
                                        @else
                                            <span class="badge bg-light text-dark fs-6">{{ $item->ranking }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->alternatif->kode }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($item->alternatif->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong>{{ $item->alternatif->nama }}</strong>
                                                <br><small
                                                    class="text-muted">{{ $item->alternatif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info fs-6">{{ number_format($item->skor_akhir, 4) }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = match ($item->kategori) {
                                                'Sangat Baik' => 'bg-success',
                                                'Baik' => 'bg-primary',
                                                'Cukup' => 'bg-warning',
                                                'Kurang' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $item->kategori }}</span>
                                    </td>
                                    <td>
                                        @if ($item->kategori == 'Sangat Baik')
                                            <i class="fas fa-star text-success me-1"></i>
                                            <span class="text-success">Berkembang Optimal</span>
                                        @elseif($item->kategori == 'Baik')
                                            <i class="fas fa-thumbs-up text-primary me-1"></i>
                                            <span class="text-primary">Berkembang Sesuai Harapan</span>
                                        @elseif($item->kategori == 'Cukup')
                                            <i class="fas fa-clock text-warning me-1"></i>
                                            <span class="text-warning">Mulai Berkembang</span>
                                        @else
                                            <i class="fas fa-exclamation-triangle text-danger me-1"></i>
                                            <span class="text-danger">Perlu Perhatian</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Grafik Distribusi -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Distribusi Kategori Perkembangan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $categories = [
                            'Sangat Baik' => [
                                'count' => $hasil->where('kategori', 'Sangat Baik')->count(),
                                'color' => 'success',
                            ],
                            'Baik' => ['count' => $hasil->where('kategori', 'Baik')->count(), 'color' => 'primary'],
                            'Cukup' => ['count' => $hasil->where('kategori', 'Cukup')->count(), 'color' => 'warning'],
                            'Kurang' => ['count' => $hasil->where('kategori', 'Kurang')->count(), 'color' => 'danger'],
                        ];
                        $total = $hasil->count();
                    @endphp

                    @foreach ($categories as $category => $data)
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <h3 class="text-{{ $data['color'] }}">{{ $data['count'] }}</h3>
                                <p class="mb-2">{{ $category }}</p>
                                @if ($total > 0)
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-{{ $data['color'] }}"
                                            style="width: {{ ($data['count'] / $total) * 100 }}%"></div>
                                    </div>
                                    <small
                                        class="text-muted">{{ number_format(($data['count'] / $total) * 100, 1) }}%</small>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Rekomendasi -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-lightbulb me-2"></i>
                    Rekomendasi Tindak Lanjut
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-success">
                            <i class="fas fa-star me-2"></i>
                            Siswa Berprestasi ({{ $hasil->where('kategori', 'Sangat Baik')->count() }} siswa)
                        </h6>
                        @if ($hasil->where('kategori', 'Sangat Baik')->count() > 0)
                            <ul class="list-unstyled">
                                @foreach ($hasil->where('kategori', 'Sangat Baik')->take(3) as $item)
                                    <li class="mb-1">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        {{ $item->alternatif->nama }}
                                    </li>
                                @endforeach
                            </ul>
                            <p class="text-muted small">Berikan apresiasi dan pertahankan pencapaian yang baik.</p>
                        @else
                            <p class="text-muted">Belum ada siswa dalam kategori ini.</p>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Perlu Perhatian Khusus ({{ $hasil->whereIn('kategori', ['Kurang', 'Cukup'])->count() }} siswa)
                        </h6>
                        @if ($hasil->whereIn('kategori', ['Kurang', 'Cukup'])->count() > 0)
                            <ul class="list-unstyled">
                                @foreach ($hasil->whereIn('kategori', ['Kurang', 'Cukup'])->take(3) as $item)
                                    <li class="mb-1">
                                        <i class="fas fa-exclamation-circle text-warning me-2"></i>
                                        {{ $item->alternatif->nama }}
                                    </li>
                                @endforeach
                            </ul>
                            <p class="text-muted small">Berikan pendampingan ekstra dan stimulasi yang sesuai.</p>
                        @else
                            <p class="text-success">Semua siswa dalam perkembangan yang baik!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Belum Ada Hasil -->
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-calculator text-muted mb-4" style="font-size: 4rem;"></i>
                <h3 class="text-muted mb-3">Belum Ada Hasil Perhitungan</h3>
                <p class="text-muted mb-4">Lakukan proses perhitungan SAW terlebih dahulu untuk melihat hasil evaluasi</p>
                <a href="{{ route('admin.saw.index') }}" class="btn btn-primary">
                    <i class="fas fa-calculator me-2"></i>
                    Mulai Perhitungan SAW
                </a>
            </div>
        </div>
    @endif

    <style>
        @media print {

            .page-header,
            .btn,
            .card-header {
                background: white !important;
                -webkit-print-color-adjust: exact;
            }

            .btn {
                display: none !important;
            }

            .card {
                border: 1px solid #dee2e6 !important;
                break-inside: avoid;
            }

            body {
                background: white !important;
            }
        }

        .avatar {
            font-weight: 600;
            font-size: 0.875rem;
        }

        .progress {
            border-radius: 10px;
        }

        .progress-bar {
            border-radius: 10px;
        }
    </style>
@endsection
