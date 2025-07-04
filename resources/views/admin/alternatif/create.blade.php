@extends('layouts.app')

@section('title', 'Tambah Siswa')
@section('breadcrumb', 'Admin / Data Siswa / Tambah')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Data Siswa</h1>
        <p class="page-subtitle">Tambahkan data siswa baru untuk evaluasi perkembangan</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Form Tambah Siswa
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alternatif.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Siswa <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                        id="kode" name="kode" value="{{ old('kode') }}"
                                        placeholder="Contoh: A1, A2, A3" required>
                                    @error('kode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Kode unik untuk mengidentifikasi siswa</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Nama lengkap siswa" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nama_orangtua" class="form-label">Nama Orang Tua</label>
                            <input type="text" class="form-control @error('nama_orangtua') is-invalid @enderror"
                                id="nama_orangtua" name="nama_orangtua" value="{{ old('nama_orangtua') }}"
                                placeholder="Nama ayah/ibu">
                            @error('nama_orangtua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                placeholder="Alamat lengkap siswa">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Simpan Siswa
                            </button>
                            <a href="{{ route('admin.alternatif.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Panduan Input Data
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-lightbulb me-2"></i>
                            Tips Penting
                        </h6>
                        <ul class="mb-0 ps-3">
                            <li>Gunakan kode siswa yang unik dan mudah diingat</li>
                            <li>Pastikan nama siswa ditulis dengan benar</li>
                            <li>Tanggal lahir digunakan untuk menghitung umur</li>
                            <li>Data orang tua dan alamat bersifat opsional</li>
                        </ul>
                    </div>

                    <h6 class="mt-4 mb-3">Rentang Umur PAUD:</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 py-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Kelompok A</span>
                                <span class="badge bg-primary">4-5 tahun</span>
                            </div>
                        </div>
                        <div class="list-group-item px-0 py-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Kelompok B</span>
                                <span class="badge bg-primary">5-6 tahun</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
