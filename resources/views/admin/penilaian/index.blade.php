@extends('layouts.app')

@section('title', 'Nilai Alternatif')
@section('breadcrumb', 'Admin / Nilai Alternatif')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Nilai Alternatif</h1>
                <p class="page-subtitle">Kelola penilaian siswa untuk setiap kriteria</p>
            </div>
            <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Input Penilaian
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-clipboard-check me-2"></i>
                Daftar Penilaian Siswa
            </h5>
        </div>
        <div class="card-body">
            @if ($alternatif->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Siswa</th>
                                @foreach ($kriteria as $k)
                                    <th class="text-center">{{ $k->kode }}</th>
                                @endforeach
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $index => $siswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $siswa->kode }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 35px; height: 35px; font-size: 0.8rem;">
                                                {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                            </div>
                                            <strong>{{ $siswa->nama }}</strong>
                                        </div>
                                    </td>
                                    @foreach ($kriteria as $k)
                                        @php
                                            $nilai = $siswa->penilaian->where('kriteria_id', $k->id)->first();
                                        @endphp
                                        <td class="text-center">
                                            @if ($nilai)
                                                <span class="badge bg-success">{{ $nilai->nilai }}</span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td>
                                        @php
                                            $totalPenilaian = $siswa->penilaian->count();
                                            $totalKriteria = $kriteria->count();
                                        @endphp
                                        @if ($totalPenilaian == $totalKriteria)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Lengkap
                                            </span>
                                        @elseif($totalPenilaian > 0)
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $totalPenilaian }}/{{ $totalKriteria }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>
                                                Belum
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($totalPenilaian > 0)
                                            <a href="{{ route('admin.penilaian.edit', $siswa->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit me-1"></i>
                                                Edit
                                            </a>
                                        @else
                                            <a href="{{ route('admin.penilaian.create') }}?siswa={{ $siswa->id }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus me-1"></i>
                                                Input
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-check text-muted mb-3" style="font-size: 4rem;"></i>
                    <h5 class="text-muted">Belum ada data siswa</h5>
                    <p class="text-muted mb-4">Tambahkan data siswa terlebih dahulu</p>
                    <a href="{{ route('admin.alternatif.create') }}" class="btn btn-primary">
                        <i class="fas fa-users me-2"></i>
                        Tambah Siswa
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if ($alternatif->count() > 0)
        <!-- Progress Penilaian -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie me-2"></i>
                    Progress Penilaian
                </h5>
            </div>
            <div class="card-body">
                @php
                    $lengkap = $alternatif
                        ->filter(function ($siswa) use ($kriteria) {
                            return $siswa->penilaian->count() == $kriteria->count();
                        })
                        ->count();
                    $belum = $alternatif
                        ->filter(function ($siswa) {
                            return $siswa->penilaian->count() == 0;
                        })
                        ->count();
                    $sebagian = $alternatif->count() - $lengkap - $belum;
                    $total = $alternatif->count();
                @endphp

                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            <h3 class="text-success">{{ $lengkap }}</h3>
                            <p class="mb-2">Lengkap</p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success"
                                    style="width: {{ $total > 0 ? ($lengkap / $total) * 100 : 0 }}%"></div>
                            </div>
                            <small
                                class="text-muted">{{ $total > 0 ? number_format(($lengkap / $total) * 100, 1) : 0 }}%</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h3 class="text-warning">{{ $sebagian }}</h3>
                            <p class="mb-2">Sebagian</p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning"
                                    style="width: {{ $total > 0 ? ($sebagian / $total) * 100 : 0 }}%"></div>
                            </div>
                            <small
                                class="text-muted">{{ $total > 0 ? number_format(($sebagian / $total) * 100, 1) : 0 }}%</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h3 class="text-danger">{{ $belum }}</h3>
                            <p class="mb-2">Belum</p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-danger"
                                    style="width: {{ $total > 0 ? ($belum / $total) * 100 : 0 }}%"></div>
                            </div>
                            <small
                                class="text-muted">{{ $total > 0 ? number_format(($belum / $total) * 100, 1) : 0 }}%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
