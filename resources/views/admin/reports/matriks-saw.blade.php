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
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            background: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #a16207;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #a16207, #92400e);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            color: white;
            font-size: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            color: #a16207;
            margin-bottom: 4px;
        }

        .header h2 {
            font-size: 14px;
            color: #92400e;
            margin-bottom: 4px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            border-left: 3px solid #a16207;
        }

        .info-left,
        .info-right {
            width: 48%;
        }

        .info-item {
            margin-bottom: 6px;
            font-size: 10px;
        }

        .info-label {
            font-weight: bold;
            color: #a16207;
            display: inline-block;
            width: 100px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section h3 {
            color: #a16207;
            font-size: 13px;
            margin-bottom: 12px;
            border-bottom: 2px solid #a16207;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            background: white;
            font-size: 9px;
        }

        table th {
            background: linear-gradient(135deg, #eaddd7, #d2bab0);
            color: #78350f;
            font-weight: bold;
            text-align: center;
            padding: 8px 4px;
            border: 1px solid #a16207;
            text-transform: uppercase;
        }

        table td {
            padding: 6px 4px;
            border: 1px solid #d1d5db;
            text-align: center;
        }

        .alternatif-col {
            text-align: left !important;
            font-weight: bold;
            background: #f9fafb;
        }

        .kriteria-header {
            background: #dbeafe !important;
            color: #1e40af !important;
        }

        .bobot-row {
            background: #fef3c7 !important;
            font-weight: bold;
            color: #a16207;
        }

        .nilai-normalisasi {
            background: #f0fdf4;
            color: #166534;
        }

        .rumus-section {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-left: 4px solid #0ea5e9;
            padding: 12px;
            margin: 15px 0;
            border-radius: 6px;
        }

        .rumus-section h4 {
            color: #0369a1;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .rumus {
            font-family: 'Courier New', monospace;
            background: #f8fafc;
            padding: 8px;
            border-radius: 4px;
            font-size: 10px;
            color: #374151;
            margin: 8px 0;
        }

        .langkah {
            background: #f9fafb;
            border-left: 3px solid #6b7280;
            padding: 10px;
            margin: 10px 0;
        }

        .langkah h4 {
            color: #374151;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .page-break {
            page-break-before: always;
        }

        .footer {
            margin-top: 30px;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature {
            text-align: center;
            width: 180px;
        }

        .signature-line {
            border-bottom: 1px solid #333;
            margin: 40px 0 8px 0;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }

        .landscape-table {
            font-size: 8px;
        }

        .landscape-table th,
        .landscape-table td {
            padding: 4px 2px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="logo"></div>
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN DETAIL PERHITUNGAN SAW</h2>
        <p>Simple Additive Weighting - Matriks Keputusan dan Normalisasi</p>
    </div>

    <!-- Info Laporan -->
    <div class="info-section">
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
                {{ number_format($total_bobot, 3) }}
            </div>
            <div class="info-item">
                <span class="info-label">Dicetak oleh:</span>
                {{ auth()->user()->nama }}
            </div>
        </div>
    </div>

    <!-- Metodologi SAW -->
    <div class="section">
        <h3>Metodologi Simple Additive Weighting (SAW)</h3>

        <div class="rumus-section">
            <h4>Rumus Dasar SAW:</h4>
            <div class="rumus">
                V(Ai) = Σ (Wj × Rij)
            </div>
            <p style="font-size: 9px; color: #6b7280; margin-top: 5px;">
                Dimana: V(Ai) = Nilai preferensi alternatif Ai, Wj = Bobot kriteria j, Rij = Nilai normalisasi
                alternatif i pada kriteria j
            </p>
        </div>

        <div class="langkah">
            <h4>Langkah-langkah Perhitungan:</h4>
            <ol style="font-size: 10px; color: #374151; padding-left: 15px;">
                <li>Membuat matriks keputusan berdasarkan nilai setiap alternatif untuk setiap kriteria</li>
                <li>Melakukan normalisasi matriks dengan rumus: Rij = Xij / Max(Xij) untuk kriteria benefit</li>
                <li>Mengalikan nilai normalisasi dengan bobot kriteria</li>
                <li>Menjumlahkan hasil perkalian untuk mendapatkan nilai preferensi akhir</li>
            </ol>
        </div>
    </div>

    <!-- Bobot Kriteria -->
    <div class="section">
        <h3>Bobot Kriteria</h3>
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
                        <td><strong>{{ $k->kode }}</strong></td>
                        <td style="text-align: left;">{{ $k->nama }}</td>
                        <td class="bobot-row">{{ number_format($k->bobot, 3) }}</td>
                        <td>{{ number_format($k->bobot * 100, 1) }}%</td>
                    </tr>
                @endforeach
                <tr style="background: #f3f4f6; font-weight: bold;">
                    <td colspan="2" style="text-align: right;"><strong>TOTAL:</strong></td>
                    <td class="bobot-row">{{ number_format($total_bobot, 3) }}</td>
                    <td>{{ number_format($total_bobot * 100, 1) }}%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Matriks Keputusan -->
    <div class="page-break"></div>
    <div class="section">
        <h3>Matriks Keputusan (X)</h3>

        <div class="rumus-section">
            <h4>Penjelasan:</h4>
            <p style="font-size: 10px; color: #374151;">
                Matriks keputusan berisi nilai asli setiap alternatif (siswa) untuk setiap kriteria berdasarkan hasil
                penilaian.
                Nilai berkisar dari 1-4 sesuai dengan skala penilaian PAUD.
            </p>
        </div>

        @if (count($matriks_keputusan) > 0)
            <table class="landscape-table">
                <thead>
                    <tr>
                        <th style="width: 25%">Alternatif</th>
                        @foreach ($kriteria as $k)
                            <th class="kriteria-header" style="width: {{ 75 / $kriteria->count() }}%">
                                {{ $k->kode }}<br>
                                <small>({{ number_format($k->bobot, 2) }})</small>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriks_keputusan as $row)
                        <tr>
                            <td class="alternatif-col">
                                <strong>{{ $row['alternatif']->kode }}</strong><br>
                                <small>{{ $row['alternatif']->nama }}</small>
                            </td>
                            @foreach ($kriteria as $k)
                                <td>{{ $row[$k->kode] }}</td>
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
        <h3>Matriks Normalisasi (R)</h3>

        <div class="rumus-section">
            <h4>Rumus Normalisasi:</h4>
            <div class="rumus">
                Rij = Xij / Max(Xij)
            </div>
            <p style="font-size: 9px; color: #6b7280; margin-top: 5px;">
                Dimana: Rij = Nilai normalisasi, Xij = Nilai alternatif i pada kriteria j, Max(Xij) = Nilai maksimum
                pada kriteria j
            </p>
        </div>

        @if (count($matriks_normalisasi) > 0)
            <table class="landscape-table">
                <thead>
                    <tr>
                        <th style="width: 25%">Alternatif</th>
                        @foreach ($kriteria as $k)
                            <th class="kriteria-header" style="width: {{ 75 / $kriteria->count() }}%">
                                {{ $k->kode }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matriks_normalisasi as $row)
                        <tr>
                            <td class="alternatif-col">
                                <strong>{{ $row['alternatif']->kode }}</strong><br>
                                <small>{{ $row['alternatif']->nama }}</small>
                            </td>
                            @foreach ($kriteria as $k)
                                <td class="nilai-normalisasi">{{ $row[$k->kode] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div
            style="margin-top: 15px; background: #fef3c7; border: 1px solid #f59e0b; border-left: 4px solid #f59e0b; padding: 10px; border-radius: 6px;">
            <h4 style="color: #92400e; font-size: 11px; margin-bottom: 6px;">📌 Catatan Normalisasi:</h4>
            <ul style="list-style-type: disc; padding-left: 15px; font-size: 9px; color: #92400e;">
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
        <h3>Contoh Perhitungan Detail</h3>

        @if (count($matriks_keputusan) > 0)
            @php $contoh = $matriks_keputusan[0] ?? null; @endphp

            @if ($contoh)
                <div class="langkah">
                    <h4>Contoh untuk {{ $contoh['alternatif']->nama }} ({{ $contoh['alternatif']->kode }}):</h4>

                    <p style="margin: 8px 0; font-size: 10px;"><strong>1. Nilai Asli:</strong></p>
                    <div class="rumus">
                        @foreach ($kriteria as $k)
                            {{ $k->kode }} = {{ $contoh[$k->kode] }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </div>

                    <p style="margin: 8px 0; font-size: 10px;"><strong>2. Normalisasi:</strong></p>
                    @if (count($matriks_normalisasi) > 0)
                        @php $contohNorm = $matriks_normalisasi[0] ?? null; @endphp
                        @if ($contohNorm)
                            <div class="rumus">
                                @foreach ($kriteria as $k)
                                    R{{ $contoh['alternatif']->kode }}{{ $k->kode }} = {{ $contoh[$k->kode] }} /
                                    Max = {{ $contohNorm[$k->kode] }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </div>

                            <p style="margin: 8px 0; font-size: 10px;"><strong>3. Perhitungan Akhir:</strong></p>
                            <div class="rumus">
                                V({{ $contoh['alternatif']->kode }}) =
                                @foreach ($kriteria as $k)
                                    ({{ $contohNorm[$k->kode] }} × {{ number_format($k->bobot, 3) }})
                                    {{ !$loop->last ? ' + ' : '' }}
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        @endif
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
        </div>

        <div style="text-align: center; margin-top: 20px; font-size: 9px; color: #666;">
            <p>Laporan ini dibuat secara otomatis oleh Sistem Pendukung Keputusan PAUD Flamboyan</p>
        </div>
    </div>
</body>

</html>
