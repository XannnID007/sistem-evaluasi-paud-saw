@extends('layouts.app')

@section('title', 'Edit Siswa')
@section('breadcrumb', 'Admin / Data Siswa / Edit')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit Data Siswa</h2>
            <p class="text-gray-600">Ubah data siswa {{ $alternatif->nama }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Edit Siswa</h3>

                    <form action="{{ route('admin.alternatif.update', $alternatif->alternatif_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="kode" class="block text-sm font-medium text-gray-700 mb-2">Kode
                                    Siswa</label>
                                <input type="text" id="kode" name="kode"
                                    value="{{ old('kode', $alternatif->kode) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kode') border-red-300 @enderror"
                                    required>
                                @error('kode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="nama" name="nama"
                                    value="{{ old('nama', $alternatif->nama) }}"
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
                                    <option value="L"
                                        {{ old('jenis_kelamin', $alternatif->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="P"
                                        {{ old('jenis_kelamin', $alternatif->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                    Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $alternatif->tanggal_lahir->format('Y-m-d')) }}"
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
                                value="{{ old('nama_orangtua', $alternatif->nama_orangtua) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_orangtua') border-red-300 @enderror">
                            @error('nama_orangtua')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('alamat') border-red-300 @enderror">{{ old('alamat', $alternatif->alamat) }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-3">
                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Update Siswa
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
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Info Siswa</h3>
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-primary-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-white font-bold text-xl">
                                {{ strtoupper(substr($alternatif->nama, 0, 1)) }}
                            </span>
                        </div>
                        <h4 class="font-semibold text-gray-900">{{ $alternatif->nama }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $alternatif->kode }}</p>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Jenis Kelamin</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $alternatif->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $alternatif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Umur</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $alternatif->umur }}
                                tahun</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Terdaftar</span>
                            <span class="text-gray-900">{{ $alternatif->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
