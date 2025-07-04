@extends('layouts.app')

@section('title', 'Kelola User')
@section('breadcrumb', 'Admin / Kelola User')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Kelola User</h1>
                <p class="page-subtitle">Manajemen akun admin dan guru</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Tambah User
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-users me-2"></i>
                Daftar User Sistem
            </h5>
        </div>
        <div class="card-body">
            @if ($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Terdaftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }} text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong>{{ $user->name }}</strong>
                                                @if ($user->id == auth()->id())
                                                    <br><small class="text-muted">(Anda)</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                                            <i
                                                class="fas fa-{{ $user->role == 'admin' ? 'shield-alt' : 'user-tie' }} me-1"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Aktif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if ($user->id != auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus user {{ $user->name }}?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
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
                    <h5 class="text-muted">Belum ada user lain</h5>
                    <p class="text-muted mb-4">Tambahkan user baru untuk mengakses sistem</p>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah User Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- User Statistics -->
    @if ($users->count() > 0)
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="bg-danger bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-shield-alt text-white fs-4"></i>
                        </div>
                        <h6 class="card-title">Total Admin</h6>
                        <h3 class="text-danger">{{ $users->where('role', 'admin')->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-user-tie text-white fs-4"></i>
                        </div>
                        <h6 class="card-title">Total Guru</h6>
                        <h3 class="text-primary">{{ $users->where('role', 'guru')->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-users text-white fs-4"></i>
                        </div>
                        <h6 class="card-title">Total User</h6>
                        <h3 class="text-success">{{ $users->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
