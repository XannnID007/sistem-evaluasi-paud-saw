@extends('layouts.app')

@section('title', 'Edit User')
@section('breadcrumb', 'Admin / Kelola User / Edit')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit User</h2>
            <p class="text-gray-600">Ubah informasi user {{ $user->name }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Edit User</h3>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror"
                                    required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                    Baru</label>
                                <input type="password" id="password" name="password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-300 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah password</p>
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <select id="role" name="role"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('role') border-red-300 @enderror"
                                    required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>
                                        Guru</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @if ($user->id == auth()->id())
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                <div class="flex">
                                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-2 mt-0.5"></i>
                                    <p class="text-sm text-yellow-800">
                                        <strong>Perhatian:</strong> Anda sedang mengedit akun Anda sendiri. Pastikan data
                                        sudah
                                        benar sebelum menyimpan.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="flex space-x-3">
                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Update User
                            </button>
                            <a href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Info User</h3>
                    <div class="text-center mb-4">
                        <div
                            class="w-16 h-16 {{ $user->role == 'admin' ? 'bg-red-500' : 'bg-blue-500' }} rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-white font-bold text-xl">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <h4 class="font-semibold text-gray-900">{{ $user->name }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $user->email }}</p>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Role</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role == 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Status</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Terdaftar</span>
                            <span class="text-gray-900">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Update Terakhir</span>
                            <span class="text-gray-900">{{ $user->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                @if ($user->role == 'guru')
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Akses Guru</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="font-medium text-blue-900 mb-2">Hak Akses:</h4>
                            <ul class="space-y-1 text-sm text-blue-800">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-blue-600 mr-2"></i>
                                    Dashboard informasi
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-blue-600 mr-2"></i>
                                    Lihat hasil evaluasi siswa
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-blue-600 mr-2"></i>
                                    Kelola profile sendiri
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-times text-red-600 mr-2"></i>
                                    Tidak dapat mengubah data sistem
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Akses Admin</h3>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <h4 class="font-medium text-red-900 mb-2">Hak Akses Penuh:</h4>
                            <ul class="space-y-1 text-sm text-red-800">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-600 mr-2"></i>
                                    Kelola semua data sistem
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-600 mr-2"></i>
                                    Input dan edit penilaian
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-600 mr-2"></i>
                                    Proses perhitungan SAW
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-600 mr-2"></i>
                                    Manajemen user
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
