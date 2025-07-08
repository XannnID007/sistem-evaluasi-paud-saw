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
                                <div
                                    class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <span class="text-blue-600 font-bold">{{ $sub->skor }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $sub->nilai }}</h4>
                                            <p class="text-sm text-gray-600">Skor: {{ $sub->skor }}</p>
                                        </div>
                                    </div>
                                    <button type="button"
                                        onclick="confirmDeleteSubkriteria({{ $sub->id }}, '{{ $sub->nilai }}')"
                                        class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <!-- Hidden form for delete -->
                                    <form id="delete-subkriteria-form-{{ $sub->id }}"
                                        action="{{ route('admin.subkriteria.destroy', $sub->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
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
                                    @for ($i = 1; $i <= 4; $i++)
                                        @php
                                            $exists = $kriteria->subkriteria->where('skor', $i)->count() > 0;
                                        @endphp
                                        <option value="{{ $i }}" {{ old('skor') == $i ? 'selected' : '' }}
                                            {{ $exists ? 'disabled' : '' }}>
                                            {{ $i }} {{ $exists ? '(Sudah ada)' : '' }}
                                        </option>
                                    @endfor
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

                <!-- Guide -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Panduan Skala PAUD</h3>
                    <div class="space-y-3">
                        <div class="flex items-center p-3 bg-red-50 border border-red-200 rounded-lg">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-red-600 font-bold text-sm">1</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-red-800">Belum Berkembang (BB)</p>
                                <p class="text-xs text-red-600">Kemampuan belum nampak</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-yellow-600 font-bold text-sm">2</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-yellow-800">Mulai Berkembang (MB)</p>
                                <p class="text-xs text-yellow-600">Kemampuan mulai nampak dengan bantuan</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-600 font-bold text-sm">3</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Berkembang Sesuai Harapan (BSH)</p>
                                <p class="text-xs text-blue-600">Kemampuan berkembang sesuai usia</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-green-600 font-bold text-sm">4</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-green-800">Berkembang Sangat Baik (BSB)</p>
                                <p class="text-xs text-green-600">Kemampuan berkembang melampaui harapan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteSubkriteriaModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-4">Konfirmasi Hapus</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="deleteSubkriteriaMessage">
                        Apakah Anda yakin ingin menghapus subkriteria ini?
                    </p>
                </div>
                <div class="items-center px-4 py-3 flex justify-center space-x-4">
                    <button id="confirmDeleteSubkriteria"
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Hapus
                    </button>
                    <button onclick="closeDeleteSubkriteriaModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-900 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteSubkriteriaFormId = null;

        function confirmDeleteSubkriteria(id, nilai) {
            deleteSubkriteriaFormId = id;
            document.getElementById('deleteSubkriteriaMessage').innerHTML =
                `Apakah Anda yakin ingin menghapus subkriteria <strong>"${nilai}"</strong>?<br><br>
                <small class="text-red-500">Data yang sudah dihapus tidak dapat dikembalikan.</small>`;
            document.getElementById('deleteSubkriteriaModal').classList.remove('hidden');
        }

        function closeDeleteSubkriteriaModal() {
            document.getElementById('deleteSubkriteriaModal').classList.add('hidden');
            deleteSubkriteriaFormId = null;
        }

        document.getElementById('confirmDeleteSubkriteria').addEventListener('click', function() {
            if (deleteSubkriteriaFormId) {
                document.getElementById('delete-subkriteria-form-' + deleteSubkriteriaFormId).submit();
            }
        });

        // Close modal when clicking outside
        document.getElementById('deleteSubkriteriaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteSubkriteriaModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteSubkriteriaModal();
            }
        });
    </script>
@endsection
