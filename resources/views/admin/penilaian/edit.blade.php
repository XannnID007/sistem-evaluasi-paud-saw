@extends('layouts.app')

@section('title', 'Edit Penilaian')
@section('breadcrumb', 'Admin / Nilai Alternatif / Edit')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Penilaian Siswa</h1>
        <p class="page-subtitle">Ubah nilai penilaian untuk {{ $alternatif->nama }}</p>
    </div>

    <form action="{{ route('admin.penilaian.update', $alternatif->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Form Edit Penilaian
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px;">
                                    {{ strtoupper(substr($alternatif->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ $alternatif->nama }}</h6>
                                    <p class="mb-0">{{ $alternatif->kode }} -
                                        {{ $alternatif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($kriteria as $k)
                                <div class="col-md-6 mb-4">
                                    <div class="card border">
                                        <div class="card-header py-2">
                                            <h6 class="mb-0">
                                                <span class="badge bg-primary me-2">{{ $k->kode }}</span>
                                                {{ $k->nama }}
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($k->subkriteria->sortBy('skor') as $sub)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio"
                                                        name="nilai[{{ $k->id }}]"
                                                        id="nilai_{{ $k->id }}_{{ $sub->skor }}"
                                                        value="{{ $sub->skor }}"
                                                        {{ old("nilai.{$k->id}", $penilaian->get($k->id)) == $sub->skor ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="nilai_{{ $k->id }}_{{ $sub->skor }}">
                                                        <span class="badge bg-secondary me-2">{{ $sub->skor }}</span>
                                                        {{ $sub->nilai }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            @error("nilai.{$k->id}")
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Penilaian
                            </button>
                            <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-history me-2"></i>
                            Nilai Saat Ini
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach ($kriteria as $k)
                                <div class="list-group-item px-0 py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">{{ $k->kode }}</span>
                                        @if ($penilaian->has($k->id))
                                            <span class="badge bg-success">{{ $penilaian->get($k->id) }}</span>
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $k->nama }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Panduan Penilaian
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <h6 class="alert-heading">Perhatian!</h6>
                            <p class="mb-0">Perubahan nilai akan mempengaruhi hasil perhitungan SAW. Pastikan penilaian
                                sudah tepat sebelum menyimpan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
