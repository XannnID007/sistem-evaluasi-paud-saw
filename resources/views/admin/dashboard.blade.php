@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('breadcrumb', 'Dashboard Admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Dashboard Admin</h2>
            <p class="text-gray-600">Selamat datang di Sistem Pendukung Keputusan PAUD Flamboyan</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover-scale">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list-check text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Kriteria</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $data['totalKriteria'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 hover-scale">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $data['totalSiswa'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 hover-scale">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-tie text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Guru</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $data['totalGuru'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 hover-scale">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hasil Evaluasi</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $data['totalHasil'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- System Overview -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Sistem Evaluasi PAUD</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-calculator text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Metode SAW</p>
                                    <p class="text-sm text-gray-600">Simple Additive Weighting</p>
                                </div>
                            </div>
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Aktif</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-chart-bar text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Kriteria Penilaian</p>
                                    <p class="text-sm text-gray-600">6 Aspek Perkembangan</p>
                                </div>
                            </div>
                            <span
                                class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">{{ $data['totalKriteria'] }}
                                Kriteria</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-star text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Skala Penilaian</p>
                                    <p class="text-sm text-gray-600">1 - 4 (Belum Berkembang - Berkembang Sangat Baik)</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">4
                                Level</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation -->
            <div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Menu Utama</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.kriteria.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-list-check w-5 h-5 mr-3 text-blue-600"></i>
                            <span class="font-medium">Kelola Kriteria</span>
                        </a>

                        <a href="{{ route('admin.alternatif.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-users w-5 h-5 mr-3 text-green-600"></i>
                            <span class="font-medium">Data Siswa</span>
                        </a>

                        <a href="{{ route('admin.penilaian.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-clipboard-check w-5 h-5 mr-3 text-purple-600"></i>
                            <span class="font-medium">Input Penilaian</span>
                        </a>

                        <a href="{{ route('admin.saw.index') }}"
                            class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-calculator w-5 h-5 mr-3 text-orange-600"></i>
                            <span class="font-medium">Proses SAW</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-graduation-cap text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">PAUD Flamboyan</h3>
                    <p class="text-gray-600">"Mendidik dengan Cinta, Mengembangkan dengan Hati"</p>
                </div>
            </div>
        </div>
    </div>
@endsection
