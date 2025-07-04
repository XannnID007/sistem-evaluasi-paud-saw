@extends('layouts.app')

@section('title', 'Edit Kriteria')
@section('breadcrumb', 'Data Kriteria / Edit')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit Kriteria</h2>
            <p class="text-gray-600">Ubah data kriteria {{ $kriteria->nama }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Edit Kriteria</h3>

                    <form action="{{ route('admin.kriteria.update', $kriteria) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <div>
                                <label for="kode" class="block text-sm font-medium text-gray-700 mb-2">Kode
                                    Kriteria</label>
                                <input type="text" id="kode" name="kode"
                                    value="{{ old('kode', $kriteria->kode) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kode') border-red-300 @enderror"
                                    required>
                                @error('kode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Kriteria</label>
                                <input type="text" id="nama" name="nama"
                                    value="{{ old('nama', $kriteria->nama) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-300 @enderror"
                                    required>
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="bobot" class="block text-sm font-medium text-gray-700 mb-2">Bobot
                                    Kriteria</label>
                                <input type="number" id="bobot" name="bobot"
                                    value="{{ old('bobot', $kriteria->bobot) }}" step="0.001" min="0"
                                    max="1"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('bobot') border-red-300 @enderror"
                                    required>
                                @error('bobot')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="keterangan"
                                    class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('keterangan') border-red-300 @enderror">{{ old('keterangan', $kriteria->keterangan) }}</textarea>
                                @error('keterangan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex space-x-3 mt-8">
                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Update Kriteria
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
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Info Kriteria</h3>
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <span class="text-blue-600 font-bold text-xl">{{ $kriteria->kode }}</span>
                        </div>
                        <h4 class="font-semibold text-gray-900">{{ $kriteria->nama }}</h4>
                        <p class="text-sm text-gray-600 mt-1">Bobot: {{ number_format($kriteria->bobot, 3) }}</p>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subkriteria:</span>
                            <span class="font-medium">{{ $kriteria->subkriteria->count() }} item</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="font-medium">{{ $kriteria->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                @if ($kriteria->subkriteria->count() > 0)
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Subkriteria</h3>
                        <div class="space-y-2">
                            @foreach ($kriteria->subkriteria->sortBy('skor') as $sub)
                                <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                    <span class="text-sm">{{ $sub->nilai }}</span>
                                    <span class="text-xs bg-gray-200 px-2 py-1 rounded">{{ $sub->skor }}</span>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('admin.kriteria.subkriteria', $kriteria->id) }}"
                            class="inline-flex items-center px-3 py-2 mt-4 w-full justify-center bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                            <i class="fas fa-cog mr-2"></i>
                            Kelola Subkriteria
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
