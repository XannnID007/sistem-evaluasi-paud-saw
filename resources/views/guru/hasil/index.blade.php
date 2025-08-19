@extends('layouts.app')

@section('title', 'Hasil Penilaian')
@section('breadcrumb', 'Hasil Penilaian')

@section('content')
    @include('components.pagination-styles')

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Hasil Penilaian Siswa</h2>
                <p class="text-gray-600">Lihat hasil evaluasi perkembangan anak berdasarkan metode SAW</p>
            </div>
            <div class="flex space-x-3">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Export Laporan
                        <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">

                        <div class="px-4 py-2 border-b border-gray-100">
                            <div class="text-sm font-medium text-gray-900">Export Options</div>
                            <div class="text-xs text-gray-500">Pilih format laporan</div>
                        </div>

                        @if ($hasil->count() > 0)
                            <a href="{{ route('guru.hasil.export-pdf', request()->all()) }}"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-red-50 transition-colors">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-file-pdf text-red-600"></i>
                                </div>
                                <div>
                                    <div class="font-medium">PDF Report</div>
                                    <div class="text-xs text-gray-500">Laporan lengkap hasil evaluasi</div>
                                </div>
                            </a>

                            <button onclick="window.print()"
                                class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-print text-green-600"></i>
                                </div>
                                <div class="text-left">
                                    <div class="font-medium">Print Halaman</div>
                                    <div class="text-xs text-gray-500">Cetak halaman saat ini</div>
                                </div>
                            </button>

                            <button onclick="exportToExcel()"
                                class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-file-excel text-blue-600"></i>
                                </div>
                                <div class="text-left">
                                    <div class="font-medium">Export Excel</div>
                                    <div class="text-xs text-gray-500">Data dalam format Excel</div>
                                </div>
                            </button>
                        @else
                            <div class="px-4 py-3 text-sm text-gray-500 text-center">
                                Tidak ada data untuk di-export
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($hasil->count() > 0)
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @php
                    // Hitung total untuk seluruh data, bukan hanya halaman saat ini
                    $allResults = \App\Models\HasilSaw::all();
                    $categories = [
                        'Sangat Baik' => [
                            'count' => $allResults->where('kategori', 'Sangat Baik')->count(),
                            'color' => 'green',
                            'icon' => 'star',
                        ],
                        'Baik' => [
                            'count' => $allResults->where('kategori', 'Baik')->count(),
                            'color' => 'blue',
                            'icon' => 'thumbs-up',
                        ],
                        'Cukup' => [
                            'count' => $allResults->where('kategori', 'Cukup')->count(),
                            'color' => 'yellow',
                            'icon' => 'clock',
                        ],
                        'Kurang' => [
                            'count' => $allResults->where('kategori', 'Kurang')->count(),
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

            <!-- Search and Filter -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                <form method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama atau kode siswa..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <select name="kategori"
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kategori</option>
                            <option value="Sangat Baik" {{ request('kategori') == 'Sangat Baik' ? 'selected' : '' }}>Sangat
                                Baik</option>
                            <option value="Baik" {{ request('kategori') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Cukup" {{ request('kategori') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                            <option value="Kurang" {{ request('kategori') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                        <a href="{{ route('guru.hasil.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-refresh mr-2"></i>Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results Table -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Hasil Evaluasi</h3>
                    <x-per-page-selector />
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="hasilTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-sortable-header column="ranking" title="Ranking" />
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Kelamin</th>
                                <x-sortable-header column="skor_akhir" title="Skor Akhir" />
                                <x-sortable-header column="kategori" title="Kategori" />
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
                                        @elseif($item->ranking == 2)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-medal mr-1"></i>
                                                {{ $item->ranking }}
                                            </span>
                                        @elseif($item->ranking == 3)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                                <i class="fas fa-award mr-1"></i>
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
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
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
                                            <span class="text-green-600">
                                                <i class="fas fa-star mr-1"></i>
                                                Berkembang optimal, pertahankan
                                            </span>
                                        @elseif($item->kategori == 'Baik')
                                            <span class="text-blue-600">
                                                <i class="fas fa-thumbs-up mr-1"></i>
                                                Perkembangan sesuai harapan
                                            </span>
                                        @elseif($item->kategori == 'Cukup')
                                            <span class="text-yellow-600">
                                                <i class="fas fa-clock mr-1"></i>
                                                Perlu stimulasi tambahan
                                            </span>
                                        @else
                                            <span class="text-red-600">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Butuh perhatian khusus
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($hasil->hasPages())
                    <div class="border-t border-gray-200">
                        {{ $hasil->links('components.pagination') }}
                    </div>
                @endif
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

    <!-- Tambahan JavaScript untuk Export Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        function exportToExcel() {
            // Get table data
            const table = document.getElementById('hasilTable');
            if (!table) {
                alert('Tidak ada data untuk di-export');
                return;
            }

            const workbook = XLSX.utils.table_to_book(table, {
                sheet: "Hasil Evaluasi",
                display: false
            });

            // Set filename
            const filename = 'Hasil_Evaluasi_Siswa_' + new Date().toISOString().slice(0, 10) + '.xlsx';

            // Download
            XLSX.writeFile(workbook, filename);
        }

        // Print styles
        const printStyles = `
            <style>
                @media print {
                    .flex.space-x-3, button, .relative { display: none !important; }
                    .bg-gray-50 { background: white !important; }
                    .border-gray-200 { border-color: #dee2e6 !important; }
                    body { background: white !important; }
                    .rounded-xl { border: 1px solid #dee2e6 !important; }
                    table { page-break-inside: auto; }
                    tr { page-break-inside: avoid; page-break-after: auto; }
                    thead { display: table-header-group; }
                    .text-2xl { font-size: 1.25rem !important; }
                    .mb-8 { margin-bottom: 1rem !important; }
                    .px-6 { padding-left: 8px !important; padding-right: 8px !important; }
                    .py-4 { padding-top: 6px !important; padding-bottom: 6px !important; }
                }
            </style>
        `;

        document.head.insertAdjacentHTML('beforeend', printStyles);
    </script>
@endsection
