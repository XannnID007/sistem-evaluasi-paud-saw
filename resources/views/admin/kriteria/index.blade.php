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
                                <a href="{{ route('admin.kriteria.edit', $item->kriteria_id) }}"
                                    class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                    title="Edit Kriteria">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                    onclick="confirmDelete({{ $item->kriteria_id }}, '{{ $item->nama }}')"
                                    class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Hapus Kriteria">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <!-- Hidden form for delete -->
                                <form id="delete-form-{{ $item->kriteria_id }}"
                                    action="{{ route('admin.kriteria.destroy', $item->kriteria_id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
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
                            <a href="{{ route('admin.kriteria.subkriteria', $item->kriteria_id) }}"
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
                            <p class="text-xs text-gray-600">{{ Str::limit($item->nama, 15) }}</p>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-4">Konfirmasi Hapus</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="deleteMessage">
                        Apakah Anda yakin ingin menghapus kriteria ini?
                    </p>
                </div>
                <div class="items-center px-4 py-3 flex justify-center space-x-4">
                    <button id="confirmDelete"
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Hapus
                    </button>
                    <button onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-900 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteFormId = null;

        function confirmDelete(id, nama) {
            deleteFormId = id;
            document.getElementById('deleteMessage').innerHTML =
                `Apakah Anda yakin ingin menghapus kriteria <strong>"${nama}"</strong>?<br><br>
                <small class="text-red-500">Data yang sudah dihapus tidak dapat dikembalikan.</small>`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteFormId = null;
        }

        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById('delete-form-' + deleteFormId).submit();
            }
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
@endsection
