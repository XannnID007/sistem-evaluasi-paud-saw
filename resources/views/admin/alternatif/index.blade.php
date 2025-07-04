@extends('layouts.app')

@section('title', 'Data Siswa')
@section('breadcrumb', 'Admin / Data Siswa')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Data Siswa</h1>
                <p class="page-subtitle">Kelola data siswa yang akan dievaluasi</p>
            </div>
            <a href="{{ route('admin.alternatif.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Tambah Siswa
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-users me-2"></i>
                Daftar Siswa PAUD Flamboyan
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
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Umur</th>
                                <th>Orang Tua</th>
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
                                                style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                            </div>
                                            <strong>{{ $siswa->nama }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $siswa->jenis_kelamin == 'L' ? 'bg-info' : 'bg-pink' }}">
                                            <i
                                                class="fas {{ $siswa->jenis_kelamin == 'L' ? 'fa-mars' : 'fa-venus' }} me-1"></i>
                                            {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td>{{ $siswa->tanggal_lahir->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $siswa->umur }} tahun</span>
                                    </td>
                                    <td>{{ $siswa->nama_orangtua ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.alternatif.edit', $siswa) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.alternatif.destroy', $siswa) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data {{ $siswa->nama }}?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users text-muted mb-3" style="font-size: 4rem;"></i>
                    <h5 class="text-muted">Belum ada data siswa</h5>
                    <p class="text-muted mb-4">Tambahkan data siswa untuk memulai evaluasi</p>
                    <a href="{{ route('admin.alternatif.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Siswa Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        .bg-pink {
            background-color: #e91e63 !important;
        }
    </style>
@endsection
