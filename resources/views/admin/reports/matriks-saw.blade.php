<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Matriks SAW</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #000;
            background: #fff;
            padding: 15px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #555;
        }

        /* Info section */
        .info-section {
            background: #f5f5dc;
            border: 1px solid #000;
            padding: 12px;
            margin-bottom: 20px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-left,
        .info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .info-item {
            margin-bottom: 6px;
            font-size: 13px;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 130px;
        }

        /* Section */
        .section {
            margin-bottom: 25px;
        }

        .section-title {
            background: #000;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            padding: 8px 12px;
            margin-bottom: 12px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }

        table th {
            background: #000;
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 8px 4px;
            border: 1px solid #000;
        }

        table td {
            padding: 6px 4px;
            border: 1px solid #000;
            text-align: center;
        }

        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        /* Text alignment */
        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        /* Special styling */
        .alternatif-col {
            text-align: left !important;
            font-weight: bold;
            background: #f0f0f0;
        }

        .bobot-row {
            background: #f5f5dc !important;
            font-weight: bold;
        }

        .nilai-normalisasi {
            background: #e8f5e8;
            font-weight: 500;
        }

        /* Formula box */
        .formula-box {
            background: #f5f5dc;
            border: 1px solid #000;
            padding: 12px;
            margin: 15px 0;
        }

        .formula-box h4 {
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .formula {
            background: #fff;
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 12px;
            text-align: center;
            font-weight: bold;
            margin: 8px 0;
        }

        /* Step box */
        .step-box {
            background: #fff;
            border: 1px solid #000;
            padding: 12px;
            margin: 15px 0;
        }

        .step-box h4 {
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .step-box ol {
            margin-left: 20px;
        }

        .step-box li {
            margin-bottom: 5px;
            font-size: 13px;
        }

        /* Note box */
        .note-box {
            background: #f5f5dc;
            border: 1px solid #000;
            padding: 12px;
            margin: 15px 0;
        }

        .note-box h4 {
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .note-box ul {
            margin-left: 20px;
        }

        .note-box li {
            margin-bottom: 5px;
            font-size: 13px;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            border-top: 1px solid #000;
            padding-top: 15px;
        }

        .signature-section {
            display: table;
            width: 100%;
            margin-top: 20px;
        }

        .signature {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin: 40px 15px 8px 15px;
        }

        .footer-note {
            text-align: center;
            margin-top: 20px;
            font-size: 11px;
            color: #555;
        }

        /* Page break */
        .page-break {
            page-break-before: always;
        }

        /* Print optimizations */
        @media print {
            body {
                padding: 0;
            }

            table {
                font-size: 10px;
            }

            table th,
            table td {
                padding: 4px 2px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN DETAIL PERHITUNGAN SAW</h2>
        <p>Simple Additive Weighting - Matriks Keputusan dan Normalisasi</p>
    </div>

    <!-- Info Laporan -->
    <div class="info-section">
        <div class="info-grid">
            <div class="info-left">
                <div class="info-item">
                    <span class="info-label">Tanggal Cetak:</span>
                    {{ date('d F Y, H:i') }} WIB
                </div>
                <div class="info-item">
                    <span class="info-label">Metode:</span>
                    Simple Additive Weighting
                </div>
                <div class="info-item">
                    <span class="info-label">Total Kriteria:</span>
                    {{ $kriteria->count() }} kriteria
                </div>
            </div>
            <div class="info-right">
                <div class="info-item">
                    <span class="info-label">Total Alternatif:</span>
                    {{ $alternatif->count() }} siswa
                </div>
                <div class="info-item">
                    <span class="info-label">Total Bobot:</span>
                    {{ number_format($total_bobot, 2) }}
                </div>
                <div class="info-item">
                    <span class="info-label">Dicetak oleh:</span>
                    {{ auth()->user()->nama }}
                </div>
            </div>
        </div>
    </div>

    <!-- Metodologi SAW -->
    <div class="section">
        <h3 class="section-title">METODOLOGI SIMPLE ADDITIVE WEIGHTING (SAW)</h3>

        <div class="formula-box">
            <h4>Rumus Dasar SAW:</h4>
            <div class="formula">
                V(Ai) = Σ (Wj × Rij)
            </div>
            <p style="font-size: 12px; text-align: center; margin-top: 5px;">
                V(Ai) = Nilai preferensi alternatif Ai<br>
                Wj = Bobot kriteria j<br>
                Rij = Nilai normalisasi alternatif i pada kriteria j
            </p>
        </div>

        <div class="step-box">
            <h4>Langkah-langkah Perhitungan:</h4>
            <ol>
                <li>Membuat matriks keputusan berdasarkan nilai setiap alternatif untuk setiap kriteria</li>
                <li>Melakukan normalisasi matriks dengan rumus: Rij = Xij / Max(Xij) untuk kriteria benefit</li>
                <li>Mengalikan nilai normalisasi dengan bobot kriteria</li>
                <li>Menjumlahkan hasil perkalian untuk mendapatkan nilai preferensi akhir</li>
                <li>Mengurutkan alternatif berdasarkan nilai preferensi tertinggi</li>
            </ol>
        </div>
    </div>

    <!-- Bobot Kriteria -->
    <div class="section">
        <h3 class="section-title">BOBOT KRITERIA PENILAIAN</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%">Kode</th>
                    <th style="width: 50%">Nama Kriteria</th>
                    <th style="width: 15%">Bobot</th>
                    <th style="width: 20%">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria as $k)
                    <tr>
                        <td><strong>{{ $k->kode_kriteria }}</strong></td>
                        <td class="text-left">{{ $k->nama }}</td>
                        <td class="bobot-row">{{ number_format($k->bobot, 2) }}</td>
                        <td>{{ number_format($k->bobot * 100, 1) }}%</td>
                    </tr>
                @endforeach
                <tr style="background: #e0e0e0; font-weight: bold;">
                    <td colspan="2" class="text-right"><strong>TOTAL:</strong></td>
                    <td class="bobot-row">{{ number_format($total_bobot, 2) }}</td>
                    <td>{{ number_format($total_bobot * 100, 1) }}%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Matriks Keputusan -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">MATRIKS KEPUTUSAN (X)</h3>

        <div class="formula-box">
            <h4>Penjelasan:</h4>
            <p style="font-size: 13px;">
                Matriks keputusan berisi nilai asli setiap alternatif (siswa) untuk setiap kriteria berdasarkan hasil
                penilaian. Nilai berkisar dari 1-4 sesuai dengan skala penilaian PAUD (BB=1, MB=2, BSH=3, BSB=4).
            </p>
        </div>

        @if (count($matriks_keputusan) > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 25%">Alternatif</th>
                        @foreach ($kriteria as $k)
                            <th style="width: {{ 75 / $kriteria->count() }}%">
                                {{ $k->kode_kriteria }}<br>
                                <small>({{ number_format($k->bobot, 2) }})</small>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriks_keputusan as $row)
                        <tr>
                            <td class="alternatif-col">
                                <strong>{{ $row['alternatif']->kode_alternatif }}</strong><br>
                                {{ $row['alternatif']->nama }}
                            </td>
                            @foreach ($kriteria as $k)
                                <td>{{ $row[$k->kode_kriteria] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Matriks Normalisasi -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">MATRIKS NORMALISASI (R)</h3>

        <div class="formula-box">
            <h4>Rumus Normalisasi:</h4>
            <div class="formula">
                Rij = Xij / Max(Xij)
            </div>
            <p style="font-size: 12px; text-align: center; margin-top: 5px;">
                Rij = Nilai normalisasi<br>
                Xij = Nilai alternatif i pada kriteria j<br>
                Max(Xij) = Nilai maksimum pada kriteria j
            </p>
        </div>

        @if (count($matriks_normalisasi) > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 25%">Alternatif</th>
                        @foreach ($kriteria as $k)
                            <th style="width: {{ 75 / $kriteria->count() }}%">{{ $k->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriks_normalisasi as $row)
                        <tr>
                            <td class="alternatif-col">
                                <strong>{{ $row['alternatif']->kode_alternatif }}</strong><br>
                                {{ $row['alternatif']->nama }}
                            </td>
                            @foreach ($kriteria as $k)
                                <td class="nilai-normalisasi">{{ $row[$k->kode_kriteria] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="note-box">
            <h4>Catatan Normalisasi:</h4>
            <ul>
                <li>Semua kriteria diperlakukan sebagai kriteria benefit (semakin tinggi semakin baik)</li>
                <li>Nilai normalisasi berkisar antara 0 hingga 1</li>
                <li>Nilai 1.0000 menunjukkan nilai tertinggi pada kriteria tersebut</li>
                <li>Semakin mendekati 1, semakin baik performanya pada kriteria tersebut</li>
            </ul>
        </div>
    </div>

    <!-- Contoh Perhitungan -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">CONTOH PERHITUNGAN DETAIL</h3>

        @if (count($matriks_keputusan) > 0)
            @php $contoh = $matriks_keputusan[0] ?? null; @endphp

            @if ($contoh)
                <div class="step-box">
                    <h4>Contoh untuk {{ $contoh['alternatif']->nama }} ({{ $contoh['alternatif']->kode_alternatif }}):
                    </h4>

                    <p style="margin: 8px 0; font-weight: bold;">1. Nilai Asli:</p>
                    <div class="formula">
                        @foreach ($kriteria as $k)
                            {{ $k->kode_kriteria }} = {{ $contoh[$k->kode_kriteria] }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </div>

                    <p style="margin: 8px 0; font-weight: bold;">2. Normalisasi:</p>
                    @if (count($matriks_normalisasi) > 0)
                        @php $contohNorm = $matriks_normalisasi[0] ?? null; @endphp
                        @if ($contohNorm)
                            <div class="formula">
                                @foreach ($kriteria as $k)
                                    R{{ $contoh['alternatif']->kode }}{{ $k->kode_kriteria }} =
                                    {{ $contoh[$k->kode_kriteria] }} / Max =
                                    {{ $contohNorm[$k->kode_kriteria] }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </div>

                            <p style="margin: 8px 0; font-weight: bold;">3. Perhitungan Akhir:</p>
                            <div class="formula">
                                V({{ $contoh['alternatif']->kode_alternatif }}) =
                                @foreach ($kriteria as $k)
                                    ({{ $contohNorm[$k->kode_kriteria] }} × {{ number_format($k->bobot, 2) }})
                                    {{ !$loop->last ? ' + ' : '' }}
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        @endif
    </div>

    <!-- Interpretasi Hasil -->
    <div class="section">
        <h3 class="section-title">INTERPRETASI HASIL</h3>

        <div class="step-box">
            <h4>Kategori Hasil Berdasarkan Skor Preferensi:</h4>
            <ul style="list-style: disc; margin-left: 20px;">
                <li><strong>Skor ≥ 0.8:</strong> Sangat Baik - Perkembangan anak sangat optimal</li>
                <li><strong>Skor 0.6-0.79:</strong> Baik - Perkembangan anak sesuai harapan</li>
                <li><strong>Skor 0.4-0.59:</strong> Cukup - Perkembangan anak cukup, perlu stimulasi tambahan</li>
                <li><strong>Skor < 0.4:</strong> Kurang - Memerlukan perhatian khusus dan stimulasi intensif</li>
            </ul>
        </div>

        <div class="note-box">
            <h4>Keunggulan Metode SAW:</h4>
            <ul>
                <li>Sederhana dan mudah dipahami oleh pengambil keputusan</li>
                <li>Perhitungan relatif cepat dan tidak memerlukan komputasi yang kompleks</li>
                <li>Dapat menangani kriteria yang bersifat benefit (semakin tinggi semakin baik)</li>
                <li>Memberikan hasil yang konsisten dan dapat dipertanggungjawabkan</li>
                <li>Sesuai untuk evaluasi perkembangan anak dengan multiple criteria</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="signature-section">
            <div class="signature">
                <p>Mengetahui,</p>
                <p><strong>Kepala PAUD Flamboyan</strong></p>
                <div class="signature-line"></div>
                <p>(_______________________)</p>
            </div>
            <div class="signature">
                <p>{{ date('d F Y') }}</p>
                <p><strong>Yang Membuat Laporan</strong></p>
                <div class="signature-line"></div>
                <p><strong>{{ auth()->user()->nama }}</strong></p>
            </div>
        </div>

        <div class="footer-note">
            <p>Laporan ini dibuat secara otomatis oleh Sistem Pendukung Keputusan PAUD Flamboyan</p>
        </div>
    </div>
</body>

</html>
