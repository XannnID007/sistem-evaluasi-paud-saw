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
