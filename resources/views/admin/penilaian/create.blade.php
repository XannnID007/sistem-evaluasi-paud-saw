@extends('layouts.app')

@section('title', 'Input Penilaian')
@section('breadcrumb', 'Admin / Nilai Alternatif / Input')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Input Penilaian Siswa</h2>
            <p class="text-gray-600">Berikan nilai untuk setiap kriteria penilaian</p>
        </div>

        <form action="{{ route('admin.penilaian.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Input Penilaian</h3>

                        <!-- Student Selection -->
                        <div class="mb-6">
                            <label for="alternatif_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Siswa</label>
                            <select id="alternatif_id" name="alternatif_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('alternatif_id') border-red-300 @enderror"
                                required>
                                <option value="">Pilih Siswa</option>
                                @foreach ($alternatif as $siswa)
                                    {{-- ✅ UPDATE: pakai alternatif_id --}}
                                    <option value="{{ $siswa->alternatif_id }}"
                                        {{ old('alternatif_id', request('siswa')) == $siswa->alternatif_id ? 'selected' : '' }}>
                                        {{ $siswa->kode }} - {{ $siswa->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('alternatif_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Criteria Assessment -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($kriteria as $k)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="mb-4">
                                        <h4 class="font-medium text-gray-900 mb-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                                {{ $k->kode }}
                                            </span>
                                            {{ $k->nama }}
                                        </h4>
                                        <p class="text-sm text-gray-600">Bobot: {{ number_format($k->bobot, 3) }}</p>
                                    </div>

                                    <div class="space-y-2">
                                        @foreach ($k->subkriteria->sortBy('skor') as $sub)
                                            <label class="flex items-center p-2 border border-gray-200 rounded-lg hover:bg-white transition-colors cursor-pointer">
                                                {{-- ✅ UPDATE: pakai kriteria_id --}}
                                                <input type="radio" name="nilai[{{ $k->kriteria_id }}]"
                                                    value="{{ $sub->skor }}"
                                                    {{ old("nilai.{$k->kriteria_id}") == $sub->skor ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                <div class="ml-3 flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-sm font-medium text-gray-900">{{ $sub->nilai }}</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-200 text-gray-800">
                                                            {{ $sub->skor }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    {{-- ✅ UPDATE: pakai kriteria_id --}}
                                    @error("nilai.{$k->kriteria_id}")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <div class="flex space-x-3 mt-8">
                            <button type="submit"
                                class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Penilaian
                            </button>
                            <a href="{{ route('admin.penilaian.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Sidebar content sama seperti sebelumnya -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Panduan Penilaian</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <h4 class="font-medium text-blue-900 mb-2">Skala Penilaian PAUD</h4>
                            <div class="space-y-2 text-sm text-blue-800">
                                <div class="flex justify-between">
                                    <span>Skor 1:</span>
                                    <span class="font-medium">Belum Berkembang (BB)</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Skor 2:</span>
                                    <span class="font-medium">Mulai Berkembang (MB)</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Skor 3:</span>
                                    <span class="font-medium">Berkembang Sesuai Harapan (BSH)</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Skor 4:</span>
                                    <span class="font-medium">Berkembang Sangat Baik (BSB)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Kriteria Penilaian</h3>
                        <div class="space-y-3">
                            @foreach ($kriteria as $k)
                                <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                    <div>
                                        <span class="font-medium text-gray-900">{{ $k->kode }}</span>
                                        <p class="text-xs text-gray-600">{{ $k->nama }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ number_format($k->bobot, 3) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection