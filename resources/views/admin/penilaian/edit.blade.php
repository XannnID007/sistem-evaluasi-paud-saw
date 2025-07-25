@extends('layouts.app')

@section('title', 'Edit Penilaian')
@section('breadcrumb', 'Admin / Nilai Alternatif / Edit')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit Penilaian Siswa</h2>
            <p class="text-gray-600">Ubah nilai penilaian untuk {{ $alternatif->nama }}</p>
        </div>

        <form action="{{ route('admin.penilaian.update', $alternatif->alternatif_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Edit Penilaian</h3>

                        <!-- Student Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-primary-500 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-bold text-lg">
                                        {{ strtoupper(substr($alternatif->nama, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $alternatif->nama }}</h4>
                                    <p class="text-sm text-gray-600">
                                        {{ $alternatif->kode }} -
                                        {{ $alternatif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }} -
                                        {{ $alternatif->umur }} tahun
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Criteria Assessment -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($kriteria as $k)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="mb-4">
                                        <h4 class="font-medium text-gray-900 mb-1">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                                {{ $k->kode }}
                                            </span>
                                            {{ $k->nama }}
                                        </h4>
                                        <p class="text-sm text-gray-600">
                                            Bobot: {{ number_format($k->bobot, 3) }} |
                                            Nilai Saat Ini:
                                            @if ($penilaian->has($k->kriteria_id))
                                                <span
                                                    class="font-medium text-green-600">{{ $penilaian->get($k->kriteria_id) }}</span>
                                            @else
                                                <span class="text-gray-400">Belum dinilai</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="space-y-2">
                                        @foreach ($k->subkriteria->sortBy('skor') as $sub)
                                            <label
                                                class="flex items-center p-2 border border-gray-200 rounded-lg hover:bg-white transition-colors cursor-pointer {{ old("nilai.{$k->kriteria_id}", $penilaian->get($k->kriteria_id)) == $sub->skor ? 'bg-blue-50 border-blue-300' : '' }}">
                                                <input type="radio" name="nilai[{{ $k->kriteria_id }}]"
                                                    value="{{ $sub->skor }}"
                                                    {{ old("nilai.{$k->kriteria_id}", $penilaian->get($k->kriteria_id)) == $sub->skor ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                <div class="ml-3 flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <span
                                                            class="text-sm font-medium text-gray-900">{{ $sub->nilai }}</span>
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ old("nilai.{$k->kriteria_id}", $penilaian->get($k->kriteria_id)) == $sub->skor ? 'bg-blue-100 text-blue-800' : 'bg-gray-200 text-gray-800' }}">
                                                            {{ $sub->skor }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
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
                                Update Penilaian
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
                    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Nilai Saat Ini</h3>
                        <div class="space-y-3">
                            @foreach ($kriteria as $k)
                                <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                    <div>
                                        <span class="font-medium text-gray-900">{{ $k->kode }}</span>
                                        <p class="text-xs text-gray-600">{{ $k->nama }}</p>
                                    </div>
                                    @if ($penilaian->has($k->kriteria_id))
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                            {{ $penilaian->get($k->kriteria_id) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            -
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Panduan Penilaian</h3>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h4 class="font-medium text-yellow-900 mb-2">Perhatian!</h4>
                            <p class="text-sm text-yellow-800">
                                Perubahan nilai akan mempengaruhi hasil perhitungan SAW. Pastikan penilaian sudah tepat
                                sebelum menyimpan.
                            </p>
                        </div>

                        <div class="mt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Skor 1:</span>
                                <span class="font-medium">Belum Berkembang</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Skor 2:</span>
                                <span class="font-medium">Mulai Berkembang</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Skor 3:</span>
                                <span class="font-medium">Berkembang Sesuai Harapan</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Skor 4:</span>
                                <span class="font-medium">Berkembang Sangat Baik</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
