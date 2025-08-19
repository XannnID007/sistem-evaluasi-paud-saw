@extends('layouts.app')

@section('title', 'Tambah Siswa')
@section('breadcrumb', 'Admin / Data Siswa / Tambah')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Tambah Data Siswa</h2>
            <p class="text-gray-600">Tambahkan data siswa baru untuk evaluasi perkembangan</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Tambah Siswa</h3>

                    <form action="{{ route('admin.alternatif.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="kode_alternatif" class="block text-sm font-medium text-gray-700 mb-2">Kode
                                    Alternatif</label>
                                <input type="text" id="kode_alternatif" name="kode_alternatif"
                                    value="{{ old('kode_alternatif') }}" placeholder="Contoh: A1, A2, A3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kode_alternatif') border-red-300 @enderror"
                                    required>
                                @error('kode_alternatif')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Kode unik untuk mengidentifikasi siswa</p>
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Nama lengkap siswa"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-300 @enderror"
                                    required>
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                                    Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jenis_kelamin') border-red-300 @enderror"
                                    required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                    Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal_lahir') border-red-300 @enderror"
                                    required>
                                @error('tanggal_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="nama_orangtua" class="block text-sm font-medium text-gray-700 mb-2">Nama Orang
                                Tua</label>
                            <input type="text" id="nama_orangtua" name="nama_orangtua"
                                value="{{ old('nama_orangtua') }}" placeholder="Nama ayah/ibu"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_orangtua') border-red-300 @enderror">
                            @error('nama_orangtua')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap siswa"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('alamat') border-red-300 @enderror">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-3">
                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Siswa
                            </button>
                            <a href="{{ route('admin.alternatif.index') }}"
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
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Panduan Input Data</h3>
                    <div class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="font-medium text-blue-900 mb-2">Tips Penting</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• Gunakan kode siswa yang unik dan mudah diingat</li>
                                <li>• Pastikan nama siswa ditulis dengan benar</li>
                                <li>• Tanggal lahir digunakan untuk menghitung umur</li>
                                <li>• Data orang tua dan alamat bersifat opsional</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
