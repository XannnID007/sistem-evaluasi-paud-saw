@extends('layouts.app')

@section('title', 'Kelola Profile')
@section('breadcrumb', 'Kelola Profile')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Kelola Profile</h2>
            <p class="text-gray-600">Ubah informasi personal dan keamanan akun Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div>
                <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                    <div class="w-24 h-24 bg-primary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-3xl font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ auth()->user()->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ auth()->user()->email }}</p>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-user-tie mr-2"></i>
                        Guru PAUD
                    </span>
                </div>

                <!-- Account Info -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Akun</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Status</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Role</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Guru</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Bergabung</span>
                            <span class="text-gray-900">{{ auth()->user()->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Login Terakhir</span>
                            <span class="text-gray-900">Sekarang</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <!-- Update Profile -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Informasi Profile</h3>
                    <form action="{{ route('guru.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror"
                                    required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @if (auth()->user()->id == auth()->id())
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                <div class="flex">
                                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-2 mt-0.5"></i>
                                    <p class="text-sm text-yellow-800">
                                        <strong>Perhatian:</strong> Anda sedang mengedit akun Anda sendiri. Pastikan data
                                        sudah benar sebelum menyimpan.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>
                            Update Profile
                        </button>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ubah Password</h3>
                    <form action="{{ route('guru.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4 mb-6">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                    Lama</label>
                                <input type="password" id="current_password" name="current_password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-300 @enderror"
                                    required>
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                        Baru</label>
                                    <input type="password" id="password" name="password"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-300 @enderror"
                                        required>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mr-2 mt-0.5"></i>
                                <p class="text-sm text-yellow-800">
                                    <strong>Perhatian:</strong> Setelah mengubah password, Anda akan diminta untuk login
                                    ulang.
                                </p>
                            </div>
                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <i class="fas fa-key mr-2"></i>
                            Ubah Password
                        </button>
                    </form>
                </div>

                <!-- Security Tips -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tips Keamanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-green-600 mb-3">
                                <i class="fas fa-check-circle mr-2"></i>
                                Yang Harus Dilakukan:
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                    Gunakan password yang kuat (min. 8 karakter)
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                    Kombinasi huruf besar, kecil, angka, dan simbol
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                    Logout setelah selesai menggunakan sistem
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-medium text-red-600 mb-3">
                                <i class="fas fa-times-circle mr-2"></i>
                                Yang Harus Dihindari:
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                                    Menggunakan password yang mudah ditebak
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                                    Membagikan akun dengan orang lain
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                                    Mengakses dari komputer umum/tidak aman
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
