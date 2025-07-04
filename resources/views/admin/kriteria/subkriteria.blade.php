@extends('layouts.app')

@section('title', 'Subkriteria')
@section('breadcrumb', 'Data Kriteria / Subkriteria')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Subkriteria {{ $kriteria->kode }}</h2>
                <p class="text-gray-600">Kelola tingkat penilaian untuk {{ $kriteria->nama }}</p>
            </div>
            <a href="{{ route('admin.kriteria.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Subkriteria List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Daftar Subkriteria</h3>

                    @if ($kriteria->subkriteria->count() > 0)
                        <div class="space-y-3">
                            @foreach ($kriteria->subkriteria->sortBy('skor') as $sub)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <span class="text-blue-600 font-bold">{{ $sub->skor }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $sub->nilai }}</h4>
                                            <p class="text-sm text-gray-600">Skor: {{ $sub->skor }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.subkriteria.destroy', $sub) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                            class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-list text-gray-400 text-5xl mb-4"></i>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada subkriteria</h4>
                            <p class="text-gray-600">Tambahkan tingkat penilaian untuk kriteria ini</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Add Form & Guide -->
            <div class="space-y-6">
                <!-- Add Form -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Subkriteria</h3>

                    <form action="{{ route('admin.kriteria.subkriteria.store', $kriteria->id) }}" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label for="skor" class="block text-sm font-medium text-gray-700 mb-2">Skor</label>
                                <select id="skor" name="skor"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('skor') border-red-300 @enderror"
                                    required>
                                    <option value="">Pilih Skor</option>
                                    <option value="1" {{ old('skor') == '1' ? 'selected' : '' }}>1 - Kurang</option>
                                    <option value="2" {{ old('skor') == '2' ? 'selected' : '' }}>2 - Cukup</option>
                                    <option value="3" {{ old('skor') == '3' ? 'selected' : '' }}>3 - Baik</option>
                                    <option value="4" {{ old('skor') == '4' ? 'selected' : '' }}>4 - Sangat Baik
                                    </option>
                                </select>
                                @error('skor')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nilai"
                                    class="block text-sm font-medium text-gray-700 mb-2">Nilai/Tingkat</label>
                                <input type="text" id="nilai" name="nilai" value="{{ old('nilai') }}"
                                    placeholder="Contoh: Sangat Baik"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nilai') border-red-300 @enderror"
                                    required>
                                @error('nilai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full mt-6 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Subkriteria
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
