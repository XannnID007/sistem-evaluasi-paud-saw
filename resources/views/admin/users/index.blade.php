@extends('layouts.app')

@section('title', 'Kelola User')
@section('breadcrumb', 'Admin / Kelola User')

@section('content')
    @include('components.pagination-styles')

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Kelola User</h2>
                <p class="text-gray-600">Manajemen akun admin dan guru</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Tambah User
            </a>
        </div>

        <!-- User Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-red-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Admin</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $users->where('role', 'admin')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-tie text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Guru</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $users->where('role', 'guru')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total User</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $users->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <form method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <select name="role"
                        class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        @if ($users->count() > 0)
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar User Sistem</h3>
                    <x-per-page-selector />
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-sortable-header column="name" title="User" />
                                <x-sortable-header column="email" title="Email" />
                                <x-sortable-header column="role" title="Role" />
                                <x-sortable-header column="created_at" title="Terdaftar" />
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 {{ $user->role == 'admin' ? 'bg-red-500' : 'bg-blue-500' }} rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white text-sm font-medium">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">
                                                    {{ $user->name }}
                                                    @if ($user->id == auth()->id())
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                                            Anda
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role == 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                            <i
                                                class="fas {{ $user->role == 'admin' ? 'fa-shield-alt' : 'fa-user-tie' }} mr-1"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>
                                            @if ($user->id != auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus user {{ $user->name }}?')"
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition-colors">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 text-xs leading-4 font-medium text-gray-500 bg-gray-100 rounded-md">
                                                    <i class="fas fa-lock mr-1"></i>
                                                    Tidak dapat dihapus
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($users->hasPages())
                    <div class="border-t border-gray-200">
                        {{ $users->links('components.pagination') }}
                    </div>
                @endif
            </div>

            <!-- Access Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hak Akses Admin</h3>
                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Kelola semua data sistem
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Input dan edit penilaian siswa
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Proses perhitungan SAW
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Manajemen user dan hak akses
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Akses semua laporan dan analisis
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hak Akses Guru</h3>
                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Lihat hasil evaluasi siswa
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Akses dashboard informasi
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Kelola profile pribadi
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-times-circle text-red-500 mr-3"></i>
                            Tidak dapat mengubah data sistem
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-times-circle text-red-500 mr-3"></i>
                            Tidak dapat mengelola user lain
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                <i class="fas fa-users text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada user lain</h3>
                <p class="text-gray-600 mb-6">Tambahkan user baru untuk mengakses sistem</p>
                <a href="{{ route('admin.users.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah User Pertama
                </a>
            </div>
        @endif
    </div>
@endsection
