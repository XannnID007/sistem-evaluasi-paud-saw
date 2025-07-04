@extends('layouts.app')

@section('title', 'Tambah Kriteria')
@section('breadcrumb', 'Data Kriteria / Tambah')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Tambah Kriteria</h2>
            <p class="text-gray-600">Tambahkan kriteria baru untuk penilaian perkembangan anak</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Tambah Kriteria</h3>

                    <form action="{{ route('admin.kriteria.store') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label for="kode" class="block text-sm font-medium text-gray-700 mb-2">Kode
                                    Kriteria</label>
                                <input type="text" id="kode" name="kode" value="{{ old('kode') }}"
                                    placeholder="Contoh: C1, C2, C3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kode') border-red-300 @enderror"
                                    required>
                                @error('kode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Kode unik untuk mengidentifikasi kriteria</p>
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Kriteria</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Contoh: Nilai-nilai Agama dan Moral"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-300 @enderror"
                                    required>
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="bobot" class="block text-sm font-medium text-gray-700 mb-2">Bobot
                                    Kriteria</label>
                                <input type="number" id="bobot" name="bobot" value="{{ old('bobot') }}"
                                    step="0.001" min="0" max="1" placeholder="0.167"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('bobot') border-red-300 @enderror"
                                    required>
                                @error('bobot')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Nilai antara 0-1. Total semua bobot harus = 1</p>
                            </div>

                            <div>
                                <label for="keterangan"
                                    class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" rows="3" placeholder="Deskripsi singkat tentang kriteria ini"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('keterangan') border-red-300 @enderror">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex space-x-3 mt-8">
                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Kriteria
                            </button>
                            <a href="{{ route('admin.kriteria.index') }}"
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
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Panduan</h3>
                    <div class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="font-medium text-blue-900 mb-2">Tips Penting</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• Gunakan kode yang mudah diingat</li>
                                <li>• Nama kriteria harus jelas dan spesifik</li>
                                <li>• Total bobot semua kriteria harus = 1.000</li>
                                <li>• Bobot menunjukkan tingkat kepentingan</li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Contoh Kriteria PAUD</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                    <span class="font-medium">C1</span>
                                    <span class="text-sm text-gray-600">0.166</span>
                                </div>
                                <p class="text-xs text-gray-600 px-2">Nilai-nilai Agama dan Moral</p>

                                <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                    <span class="font-medium">C2</span>
                                    <span class="text-sm text-gray-600">0.167</span>
                                </div>
                                <p class="text-xs text-gray-600 px-2">Fisik Motorik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
