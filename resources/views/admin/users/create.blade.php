@extends('layouts.app')

@section('title', 'Tambah User')
@section('breadcrumb', 'Admin / Kelola User / Tambah')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Tambah User Baru</h2>
            <p class="text-gray-600">Buat akun baru untuk admin atau guru</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Tambah User</h3>

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror"
                                    required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <input type="password" id="password" name="password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-300 @enderror"
                                    required>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Minimal 6 karakter</p>
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <select id="role" name="role"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('role') border-red-300 @enderror"
                                    required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex space-x-3">
                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Simpan User
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
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Role</h3>
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-medium text-red-600 mb-3">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Admin
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Kelola semua data
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Input penilaian
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Proses SAW
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Kelola user
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-medium text-blue-600 mb-3">
                                <i class="fas fa-user-tie mr-2"></i>
                                Guru
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Lihat hasil evaluasi
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Kelola profile
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-times text-red-500 mr-2"></i>
                                    Tidak bisa edit data
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-6">
                        <div class="flex">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mr-2 mt-0.5"></i>
                            <p class="text-sm text-yellow-800">
                                <strong>Perhatian:</strong> Role yang dipilih akan menentukan hak akses user dalam sistem.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tips Keamanan</h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-blue-500 mr-2 mt-0.5"></i>
                            <span>Gunakan password yang kuat minimal 6 karakter</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-key text-blue-500 mr-2 mt-0.5"></i>
                            <span>Kombinasi huruf besar, kecil, angka dan simbol</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-user-check text-blue-500 mr-2 mt-0.5"></i>
                            <span>Pastikan email yang digunakan aktif dan valid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
