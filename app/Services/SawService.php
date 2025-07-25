<?php

// app/Services/SawService.php
namespace App\Services;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Penilaian;
use App\Models\HasilSaw;

class SawService
{
     public function hitungSAW()
     {
          $kriteria = Kriteria::all();
          $alternatif = Alternatif::all();

          // Ambil semua nilai penilaian
          $nilaiMatriks = [];
          foreach ($alternatif as $alt) {
               foreach ($kriteria as $krit) {
                    $penilaian = Penilaian::where('alternatif_id', $alt->alternatif_id)
                         ->where('kriteria_id', $krit->kriteria_id)
                         ->first();
                    $nilaiMatriks[$alt->alternatif_id][$krit->kriteria_id] = $penilaian ? $penilaian->nilai : 0;
               }
          }

          // Normalisasi matriks
          $matriksNormalisasi = $this->normalisasiMatriks($nilaiMatriks, $kriteria);

          // Hitung nilai preferensi
          $hasilAkhir = $this->hitungNilaiPreferensi($matriksNormalisasi, $kriteria, $alternatif);

          // Simpan hasil
          $this->simpanHasil($hasilAkhir);

          return $hasilAkhir;
     }

     private function normalisasiMatriks($nilaiMatriks, $kriteria)
     {
          $matriksNormalisasi = [];

          foreach ($kriteria as $krit) {
               $nilai = [];
               foreach ($nilaiMatriks as $altId => $nilaiAlt) {
                    $nilai[] = $nilaiAlt[$krit->kriteria_id];
               }

               // Untuk kriteria benefit (semua kriteria adalah benefit)
               $maxNilai = max($nilai);

               foreach ($nilaiMatriks as $altId => $nilaiAlt) {
                    $matriksNormalisasi[$altId][$krit->kriteria_id] = $maxNilai > 0 ? $nilaiAlt[$krit->kriteria_id] / $maxNilai : 0;
               }
          }

          return $matriksNormalisasi;
     }

     private function hitungNilaiPreferensi($matriksNormalisasi, $kriteria, $alternatif)
     {
          $hasilAkhir = [];

          foreach ($alternatif as $alt) {
               $nilaiPreferensi = 0;
               foreach ($kriteria as $krit) {
                    $nilaiPreferensi += $matriksNormalisasi[$alt->alternatif_id][$krit->kriteria_id] * $krit->bobot;
               }

               $hasilAkhir[] = [
                    'alternatif_id' => $alt->alternatif_id,
                    'alternatif' => $alt,
                    'skor_akhir' => $nilaiPreferensi,
                    'kategori' => $this->tentukanKategori($nilaiPreferensi)
               ];
          }

          // Urutkan berdasarkan skor tertinggi
          usort($hasilAkhir, function ($a, $b) {
               return $b['skor_akhir'] <=> $a['skor_akhir'];
          });

          // Tambahkan ranking
          foreach ($hasilAkhir as $index => &$hasil) {
               $hasil['ranking'] = $index + 1;
          }

          return $hasilAkhir;
     }

     private function tentukanKategori($skor)
     {
          if ($skor >= 0.8) return 'Sangat Baik';
          if ($skor >= 0.6) return 'Baik';
          if ($skor >= 0.4) return 'Cukup';
          return 'Kurang';
     }

     private function simpanHasil($hasilAkhir)
     {
          HasilSaw::truncate();

          foreach ($hasilAkhir as $hasil) {
               HasilSaw::create([
                    'alternatif_id' => $hasil['alternatif_id'],
                    'skor_akhir' => $hasil['skor_akhir'],
                    'ranking' => $hasil['ranking'],
                    'kategori' => $hasil['kategori']
               ]);
          }
     }

     public function getMatriksKeputusan()
     {
          $kriteria = Kriteria::all();
          $alternatif = Alternatif::all();

          $matriks = [];
          foreach ($alternatif as $alt) {
               $row = ['alternatif' => $alt];
               foreach ($kriteria as $krit) {
                    $penilaian = Penilaian::where('alternatif_id', $alt->alternatif_id)
                         ->where('kriteria_id', $krit->kriteria_id)
                         ->first();
                    $row[$krit->kode] = $penilaian ? $penilaian->nilai : 0;
               }
               $matriks[] = $row;
          }

          return $matriks;
     }

     public function getMatriksNormalisasi()
     {
          $kriteria = Kriteria::all();
          $alternatif = Alternatif::all();

          // Ambil nilai matriks keputusan
          $nilaiMatriks = [];
          foreach ($alternatif as $alt) {
               foreach ($kriteria as $krit) {
                    $penilaian = Penilaian::where('alternatif_id', $alt->alternatif_id)
                         ->where('kriteria_id', $krit->kriteria_id)
                         ->first();
                    $nilaiMatriks[$alt->alternatif_id][$krit->kriteria_id] = $penilaian ? $penilaian->nilai : 0;
               }
          }

          // Normalisasi
          $matriksNormalisasi = $this->normalisasiMatriks($nilaiMatriks, $kriteria);

          // Format untuk tampilan
          $hasil = [];
          foreach ($alternatif as $alt) {
               $row = ['alternatif' => $alt];
               foreach ($kriteria as $krit) {
                    $row[$krit->kode] = number_format($matriksNormalisasi[$alt->alternatif_id][$krit->kriteria_id], 4);
               }
               $hasil[] = $row;
          }

          return $hasil;
     }
}
