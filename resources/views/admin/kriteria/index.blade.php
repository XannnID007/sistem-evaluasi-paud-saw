@extends('layouts.app')

@section('title', 'Data Kriteria')
@section('breadcrumb', 'Data Kriteria')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Data Kriteria</h2>
                <p class="text-gray-600">Kelola kriteria penilaian perkembangan anak</p>
            </div>
            <a href="{{ route('admin.kriteria.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kriteria
            </a>
        </div>

        @if ($kriteria->count() > 0)
            <!-- Kriteria Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                @foreach ($kriteria as $item)
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover-scale">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                    <span class="text-blue-600 font-bold text-lg">{{ $item->kode }}</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $item->nama }}</h3>
                                    <p class="text-sm text-gray-600">Bobot: {{ number_format($item->bobot, 3) }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.kriteria.edit', $item) }}"
                                    class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kriteria.destroy', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                        class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if ($item->keterangan)
                            <p class="text-gray-600 text-sm mb-4">{{ $item->keterangan }}</p>
                        @endif

                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-list mr-2"></i>
                                {{ $item->subkriteria->count() }} subkriteria
                            </div>
                            <a href="{{ route('admin.kriteria.subkriteria', $item->id) }}"
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                                <i class="fas fa-cog mr-1"></i>
                                Kelola
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bobot Summary -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Bobot Kriteria</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                    @foreach ($kriteria as $item)
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <span class="text-blue-600 font-bold">{{ $item->kode }}</span>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ number_format($item->bobot, 3) }}</p>
                            <p class="text-xs text-gray-600">{{ $item->nama }}</p>
                        </div>
                    @endforeach
                </div>

                @php $totalBobot = $kriteria->sum('bobot'); @endphp
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Bobot:</span>
                        <div class="flex items-center">
                            <span
                                class="text-xl font-bold {{ abs($totalBobot - 1) < 0.001 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($totalBobot, 3) }}
                            </span>
                            @if (abs($totalBobot - 1) < 0.001)
                                <i class="fas fa-check-circle text-green-500 ml-2"></i>
                            @else
                                <i class="fas fa-exclamation-triangle text-red-500 ml-2"></i>
                            @endif
                        </div>
                    </div>
                    @if (abs($totalBobot - 1) >= 0.001)
                        <p class="text-sm text-red-600 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Total bobot harus sama dengan 1.000 untuk perhitungan yang akurat
                        </p>
                    @endif
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                <i class="fas fa-list-check text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada kriteria</h3>
                <p class="text-gray-600 mb-6">Tambahkan kriteria penilaian untuk memulai evaluasi</p>
                <a href="{{ route('admin.kriteria.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kriteria Pertama
                </a>
            </div>
        @endif
    </div>
@endsection
