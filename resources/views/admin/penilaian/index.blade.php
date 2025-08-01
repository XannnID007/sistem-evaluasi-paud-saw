@extends('layouts.app')

@section('title', 'Nilai Alternatif')
@section('breadcrumb', 'Admin / Nilai Alternatif')

@section('content')
    @include('components.pagination-styles')

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Nilai Alternatif</h2>
                <p class="text-gray-600">Kelola penilaian siswa untuk setiap kriteria</p>
            </div>
            <div class="flex space-x-3">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-file-export mr-2"></i>
                        Export Laporan
                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">

                        <div class="px-4 py-2 border-b border-gray-100">
                            <div class="text-sm font-medium text-gray-900">Export Penilaian</div>
                            <div class="text-xs text-gray-500">Pilih format laporan</div>
                        </div>

                        <a href="{{ route('admin.reports.nilai-alternatif.pdf', request()->all()) }}"
                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-red-50 transition-colors">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-file-pdf text-red-600"></i>
                            </div>
                            <div>
                                <div class="font-medium">PDF Report</div>
                                <div class="text-xs text-gray-500">Laporan nilai lengkap</div>
                            </div>
                        </a>

                        <button onclick="window.print()"
                            class="w-full flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-print text-green-600"></i>
                            </div>
                            <div class="text-left">
                                <div class="font-medium">Print Halaman</div>
                                <div class="text-xs text-gray-500">Cetak tabel saat ini</div>
                            </div>
                        </button>
                    </div>
                </div>

                <a href="{{ route('admin.penilaian.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Input Penilaian
                </a>
            </div>
        </div>

        @if ($alternatif->count() > 0)
            <!-- Progress Penilaian -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @php
                    $lengkap = $alternatif
                        ->filter(function ($siswa) use ($kriteria) {
                            return $siswa->penilaian->count() == $kriteria->count();
                        })
                        ->count();
                    $belum = $alternatif
                        ->filter(function ($siswa) {
                            return $siswa->penilaian->count() == 0;
                        })
                        ->count();
                    $sebagian = $alternatif->count() - $lengkap - $belum;
                    $total = $alternatif->count();
                @endphp

                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Lengkap</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $lengkap }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $total > 0 ? number_format(($lengkap / $total) * 100, 1) : 0 }}%</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Sebagian</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $sebagian }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $total > 0 ? number_format(($sebagian / $total) * 100, 1) : 0 }}%</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-times-circle text-red-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Belum</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $belum }}</p>
                            <p class="text-xs text-gray-500">
                                {{ $total > 0 ? number_format(($belum / $total) * 100, 1) : 0 }}%</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $total }}</p>
                            <p class="text-xs text-gray-500">{{ $kriteria->count() }} kriteria</p>
                        </div>
                    </div>
                </div>
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
                        <select name="status"
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Status</option>
                            <option value="lengkap" {{ request('status') == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                            <option value="sebagian" {{ request('status') == 'sebagian' ? 'selected' : '' }}>Sebagian
                            </option>
                            <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                        <a href="{{ route('admin.penilaian.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-refresh mr-2"></i>Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Assessment Table -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Penilaian Siswa</h3>
                    <x-per-page-selector />
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-sortable-header column="nama" title="Siswa" />
                                @foreach ($kriteria as $k)
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $k->kode }}</th>
                                @endforeach
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($alternatif as $siswa)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white text-sm font-medium">
                                                    {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $siswa->nama }}</div>
                                                <div class="text-sm text-gray-500">{{ $siswa->kode }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach ($kriteria as $k)
                                        @php
                                            $nilai = $siswa->penilaian->where('kriteria_id', $k->kriteria_id)->first();
                                        @endphp
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if ($nilai)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ $nilai->nilai }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    -
                                                </span>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $totalPenilaian = $siswa->penilaian->count();
                                            $totalKriteria = $kriteria->count();
                                        @endphp
                                        @if ($totalPenilaian == $totalKriteria)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Lengkap
                                            </span>
                                        @elseif($totalPenilaian > 0)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $totalPenilaian }}/{{ $totalKriteria }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                Belum
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if ($totalPenilaian > 0)
                                            <a href="{{ route('admin.penilaian.edit', $siswa->alternatif_id) }}"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>
                                        @else
                                            <a href="{{ route('admin.penilaian.create') }}?siswa={{ $siswa->alternatif_id }}"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Input
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($alternatif->hasPages())
                    <div class="border-t border-gray-200">
                        {{ $alternatif->links('components.pagination') }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                <i class="fas fa-clipboard-check text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada data siswa</h3>
                <p class="text-gray-600 mb-6">Tambahkan data siswa terlebih dahulu</p>
                <a href="{{ route('admin.alternatif.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-users mr-2"></i>
                    Tambah Siswa
                </a>
            </div>
        @endif
    </div>
@endsection
