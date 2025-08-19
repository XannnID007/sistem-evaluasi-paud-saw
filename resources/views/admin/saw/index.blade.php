@extends('layouts.app')

@section('title', 'Perhitungan SAW')
@section('breadcrumb', 'Admin / Perhitungan SAW')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Perhitungan SAW</h2>
                <p class="text-gray-600">Simple Additive Weighting untuk evaluasi perkembangan anak</p>
            </div>
            <div class="flex space-x-3">
                <form action="{{ route('admin.saw.proses') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Proses perhitungan SAW?')"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-calculator mr-2"></i>
                        Proses SAW
                    </button>
                </form>
                <a href="{{ route('admin.saw.hasil') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-chart-line mr-2"></i>
                    Lihat Hasil
                </a>
            </div>
        </div>

        <!-- SAW Process Steps -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-table text-blue-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">1. Matriks Keputusan</h3>
                <p class="text-sm text-gray-600">Tabel nilai setiap alternatif untuk setiap kriteria</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-arrows-alt text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">2. Normalisasi</h3>
                <p class="text-sm text-gray-600">Mengubah nilai menjadi skala 0-1</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-weight-hanging text-purple-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">3. Perkalian Bobot</h3>
                <p class="text-sm text-gray-600">Nilai normalisasi × bobot kriteria</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-green-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">4. Ranking</h3>
                <p class="text-sm text-gray-600">Urutkan berdasarkan skor tertinggi</p>
            </div>
        </div>

        <!-- Decision Matrix -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Matriks Keputusan</h3>
            </div>
            <div class="p-6">
                @if (count($matriksKeputusan) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Alternatif</th>
                                    @foreach ($kriteria as $k)
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{-- ✅ REVISI: kode → kode_kriteria --}}
                                            {{ $k->kode_kriteria }}
                                            <div class="text-xs text-gray-400 font-normal">
                                                ({{ number_format($k->bobot, 2) }})
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($matriksKeputusan as $row)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-white text-xs font-medium">
                                                        {{ strtoupper(substr($row['alternatif']->nama, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    {{-- ✅ REVISI: kode → kode_alternatif --}}
                                                    <div class="font-medium text-gray-900">
                                                        {{ $row['alternatif']->kode_alternatif }}</div>
                                                    <div class="text-sm text-gray-500">{{ $row['alternatif']->nama }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($kriteria as $k)
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{-- ✅ REVISI: kode → kode_kriteria --}}
                                                    {{ $row[$k->kode_kriteria] }}
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-6xl mb-4"></i>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Data Belum Lengkap</h4>
                        <p class="text-gray-600 mb-6">Pastikan semua siswa sudah dinilai untuk semua kriteria</p>
                        <a href="{{ route('admin.penilaian.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-clipboard-check mr-2"></i>
                            Input Penilaian
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Normalization Matrix -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Matriks Normalisasi</h3>
            </div>
            <div class="p-6">
                @if (count($matriksNormalisasi) > 0)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                            <span class="text-sm text-blue-800">
                                <strong>Rumus Normalisasi:</strong> R<sub>ij</sub> = X<sub>ij</sub> / Max(X<sub>ij</sub>)
                                untuk kriteria benefit
                            </span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-yellow-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Alternatif</th>
                                    @foreach ($kriteria as $k)
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ $k->kode_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($matriksNormalisasi as $row)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-white text-xs font-medium">
                                                        {{ strtoupper(substr($row['alternatif']->nama, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">
                                                        {{ $row['alternatif']->kode_alternatif }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">{{ $row['alternatif']->nama }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($kriteria as $k)
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    {{ $row[$k->kode_kriteria] }}
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-calculator text-gray-400 text-4xl mb-3"></i>
                        <p class="text-gray-600">Matriks normalisasi akan muncul setelah data penilaian lengkap</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Criteria Information -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Kriteria dan Bobot</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @foreach ($kriteria as $k)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-medium text-gray-900">{{ $k->kode_kriteria }}</h4>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ number_format($k->bobot, 2) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $k->nama }}</p>
                    </div>
                @endforeach
            </div>

            @php $totalBobot = $kriteria->sum('bobot'); @endphp
            <div class="border-t border-gray-200 pt-4">
                <div
                    class="flex items-center justify-between p-4 {{ abs($totalBobot - 1) < 0.01 ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }} rounded-lg">
                    <div class="flex items-center">
                        <i
                            class="fas {{ abs($totalBobot - 1) < 0.01 ? 'fa-check-circle text-green-600' : 'fa-exclamation-triangle text-yellow-600' }} mr-2"></i>
                        <span class="font-medium text-gray-900">
                            Total Bobot: {{ number_format($totalBobot, 2) }}
                        </span>
                    </div>
                    @if (abs($totalBobot - 1) >= 0.01)
                        <a href="{{ route('admin.kriteria.index') }}"
                            class="inline-flex items-center px-3 py-1 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors text-sm">
                            <i class="fas fa-edit mr-1"></i>
                            Sesuaikan Bobot
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
