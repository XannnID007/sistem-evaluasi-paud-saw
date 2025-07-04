@extends('layouts.app')

@section('title', 'Input Penilaian')
@section('breadcrumb', 'Admin / Nilai Alternatif / Input')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Input Penilaian Siswa</h1>
        <p class="page-subtitle">Berikan nilai untuk setiap kriteria penilaian</p>
    </div>

    <form action="{{ route('admin.penilaian.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-clipboard-check me-2"></i>
                            Form Input Penilaian
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="alternatif_id" class="form-label">Pilih Siswa <span
                                    class="text-danger">*</span></label>
                            <select class="form-control @error('alternatif_id') is-invalid @enderror" id="alternatif_id"
                                name="alternatif_id" required>
                                <option value="">Pilih Siswa</option>
                                @foreach ($alternatif as $siswa)
                                    <option value="{{ $siswa->id }}"
                                        {{ old('alternatif_id', request('siswa')) == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->kode }} - {{ $siswa->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('alternatif_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                                        {{ old("nilai.{$k->id}") == $sub->skor ? 'checked' : '' }}>
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
                                Simpan Penilaian
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
                            <i class="fas fa-info-circle me-2"></i>
                            Panduan Penilaian
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h6 class="alert-heading">Skala Penilaian PAUD</h6>
                            <ul class="mb-0 ps-3">
                                <li><strong>Skor 1:</strong> Belum Berkembang (BB)</li>
                                <li><strong>Skor 2:</strong> Mulai Berkembang (MB)</li>
                                <li><strong>Skor 3:</strong> Berkembang Sesuai Harapan (BSH)</li>
                                <li><strong>Skor 4:</strong> Berkembang Sangat Baik (BSB)</li>
                            </ul>
                        </div>

                        <h6 class="mt-4 mb-3">Kriteria Penilaian:</h6>
                        <div class="list-group list-group-flush">
                            @foreach ($kriteria as $k)
                                <div class="list-group-item px-0 py-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold">{{ $k->kode }}</span>
                                        <span class="badge bg-primary">{{ number_format($k->bobot, 3) }}</span>
                                    </div>
                                    <small class="text-muted">{{ $k->nama }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
