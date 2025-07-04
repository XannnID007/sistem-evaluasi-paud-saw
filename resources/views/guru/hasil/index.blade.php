@extends('layouts.app')

@section('title', 'Hasil Penilaian')
@section('breadcrumb', 'Hasil Penilaian')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Hasil Penilaian Siswa</h2>
            <p class="text-gray-600">Lihat hasil evaluasi perkembangan anak berdasarkan metode SAW</p>
        </div>

        @if ($hasil->count() > 0)
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @php
                    $categories = [
                        'Sangat Baik' => [
                            'count' => $hasil->where('kategori', 'Sangat Baik')->count(),
                            'color' => 'green',
                            'icon' => 'star',
                        ],
                        'Baik' => [
                            'count' => $hasil->where('kategori', 'Baik')->count(),
                            'color' => 'blue',
                            'icon' => 'thumbs-up',
                        ],
                        'Cukup' => [
                            'count' => $hasil->where('kategori', 'Cukup')->count(),
                            'color' => 'yellow',
                            'icon' => 'clock',
                        ],
                        'Kurang' => [
                            'count' => $hasil->where('kategori', 'Kurang')->count(),
                            'color' => 'red',
                            'icon' => 'exclamation-triangle',
                        ],
                    ];
                @endphp

                @foreach ($categories as $category => $data)
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-{{ $data['color'] }}-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-{{ $data['icon'] }} text-{{ $data['color'] }}-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">{{ $category }}</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $data['count'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Results Table -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Hasil Evaluasi</h3>
                    <button onclick="window.print()"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-print mr-2"></i>
                        Cetak
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ranking</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Kelamin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Skor Akhir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($hasil as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->ranking == 1)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-trophy mr-1"></i>
                                                {{ $item->ranking }}
                                            </span>
                                        @elseif($item->ranking <= 5)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                {{ $item->ranking }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                {{ $item->ranking }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white text-sm font-medium">
                                                    {{ strtoupper(substr($item->alternatif->nama, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $item->alternatif->nama }}</div>
                                                <div class="text-sm text-gray-500">{{ $item->alternatif->kode }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->alternatif->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                            <i
                                                class="fas {{ $item->alternatif->jenis_kelamin == 'L' ? 'fa-mars' : 'fa-venus' }} mr-1"></i>
                                            {{ $item->alternatif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            {{ number_format($item->skor_akhir, 4) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $badgeClass = match ($item->kategori) {
                                                'Sangat Baik' => 'bg-green-100 text-green-800',
                                                'Baik' => 'bg-blue-100 text-blue-800',
                                                'Cukup' => 'bg-yellow-100 text-yellow-800',
                                                'Kurang' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
                                            {{ $item->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        @if ($item->kategori == 'Sangat Baik')
                                            <span class="text-green-600">Berkembang optimal, pertahankan</span>
                                        @elseif($item->kategori == 'Baik')
                                            <span class="text-blue-600">Perkembangan sesuai harapan</span>
                                        @elseif($item->kategori == 'Cukup')
                                            <span class="text-yellow-600">Perlu stimulasi tambahan</span>
                                        @else
                                            <span class="text-red-600">Butuh perhatian khusus</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                <i class="fas fa-chart-line text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Hasil Evaluasi</h3>
                <p class="text-gray-600 mb-6">Hasil evaluasi akan ditampilkan setelah admin memproses perhitungan SAW</p>
                <div class="inline-flex items-center px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    <span class="text-blue-800 font-medium">Hubungi admin untuk memproses evaluasi siswa</span>
                </div>
            </div>
        @endif
    </div>

    <style>
        @media print {

            .bg-gray-50,
            .border-gray-200 {
                background: white !important;
                border-color: #000 !important;
            }

            button,
            .hover\:bg-gray-50:hover {
                display: none !important;
            }

            .text-2xl {
                font-size: 1.25rem !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
@endsection
