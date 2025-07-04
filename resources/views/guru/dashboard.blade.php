@extends('layouts.app')

@section('title', 'Dashboard Guru')
@section('breadcrumb', 'Dashboard Guru')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Dashboard Guru</h2>
            <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }}! Lihat hasil evaluasi perkembangan anak didik
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalSiswa }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Evaluasi Selesai</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $hasilTerbaru->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Update Terakhir</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $hasilTerbaru->first() ? $hasilTerbaru->first()->updated_at->format('d/m') : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div>
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-primary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ auth()->user()->email }}</p>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-user-tie mr-2"></i>
                            Guru PAUD
                        </span>
                    </div>
                </div>

                <!-- Quick Menu -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Menu Utama</h3>
                    <div class="space-y-3">
                        <a href="{{ route('guru.hasil.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-chart-bar w-5 h-5 mr-3 text-blue-600"></i>
                            <span class="font-medium">Lihat Hasil Evaluasi</span>
                        </a>

                        <a href="{{ route('guru.profile.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-user-edit w-5 h-5 mr-3 text-purple-600"></i>
                            <span class="font-medium">Kelola Profile</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Results Overview -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Hasil Evaluasi Terbaru</h3>
                        <a href="{{ route('guru.hasil.index') }}"
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Lihat Semua
                        </a>
                    </div>

                    @if ($hasilTerbaru->count() > 0)
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ranking</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Siswa</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Skor</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kategori</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($hasilTerbaru as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                @if ($item->ranking <= 3)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-trophy mr-1"></i>
                                                        {{ $item->ranking }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $item->ranking }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center mr-3">
                                                        <span class="text-white text-xs font-medium">
                                                            {{ strtoupper(substr($item->alternatif->nama, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="font-medium text-gray-900">{{ $item->alternatif->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ number_format($item->skor_akhir, 3) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
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
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                                    {{ $item->kategori }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-chart-line text-gray-400 text-4xl mb-4"></i>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Hasil Evaluasi</h4>
                            <p class="text-gray-600">Hasil evaluasi akan muncul setelah admin memproses perhitungan SAW</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Aspek Penilaian PAUD</h3>
                    <div class="space-y-2">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Nilai-nilai Agama dan Moral
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Fisik Motorik
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Kognitif
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Bahasa
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Sosial Emosional
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Seni
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Metode Evaluasi</h3>
                    <div class="bg-white rounded-lg p-4 border border-blue-200">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-calculator text-blue-600 mr-2"></i>
                            <span class="font-medium text-gray-900">Simple Additive Weighting (SAW)</span>
                        </div>
                        <p class="text-sm text-gray-600">
                            Metode yang digunakan untuk mengevaluasi perkembangan anak berdasarkan 6 aspek penilaian dengan
                            bobot yang telah ditentukan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
