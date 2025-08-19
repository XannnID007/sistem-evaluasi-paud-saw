<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Evaluasi SAW</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #000;
            background: #fff;
            padding: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 16px;
            color: #555;
        }

        /* Info section */
        .info-section {
            background: #f5f5dc;
            border: 1px solid #000;
            padding: 15px;
            margin-bottom: 25px;
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
            margin-bottom: 8px;
            font-size: 14px;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }

        /* Section */
        .section {
            margin-bottom: 30px;
        }

        .section-title {
            background: #000;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th {
            background: #000;
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 12px 8px;
            border: 1px solid #000;
            font-size: 14px;
        }

        table td {
            padding: 10px 8px;
            border: 1px solid #000;
            text-align: center;
            font-size: 13px;
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

        /* Ranking styling */
        .ranking-1 {
            background: #ffd700 !important;
            font-weight: bold;
        }

        .ranking-2 {
            background: #c0c0c0 !important;
            font-weight: bold;
        }

        .ranking-3 {
            background: #cd7f32 !important;
            font-weight: bold;
            color: #fff;
        }

        /* Kategori styling */
        .kategori-sangat-baik {
            background: #28a745;
            color: #fff;
            font-weight: bold;
            padding: 5px 8px;
        }

        .kategori-baik {
            background: #007bff;
            color: #fff;
            font-weight: bold;
            padding: 5px 8px;
        }

        .kategori-cukup {
            background: #ffc107;
            color: #000;
            font-weight: bold;
            padding: 5px 8px;
        }

        .kategori-kurang {
            background: #dc3545;
            color: #fff;
            font-weight: bold;
            padding: 5px 8px;
        }

        /* Note box */
        .note-box {
            background: #f5f5dc;
            border: 1px solid #000;
            padding: 15px;
            margin: 20px 0;
        }

        .note-box h4 {
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .note-box ul {
            margin-left: 20px;
        }

        .note-box li {
            margin-bottom: 5px;
            font-size: 14px;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            border-top: 1px solid #000;
            padding-top: 20px;
        }

        .signature-section {
            display: table;
            width: 100%;
            margin-top: 30px;
        }

        .signature {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin: 50px 20px 10px 20px;
        }

        .footer-note {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
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
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN HASIL EVALUASI PERKEMBANGAN ANAK</h2>
        <p>Menggunakan Metode Simple Additive Weighting (SAW)</p>
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
                    <span class="info-label">Periode:</span>
                    Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
                </div>
                <div class="info-item">
                    <span class="info-label">Metode:</span>
                    Simple Additive Weighting (SAW)
                </div>
            </div>
            <div class="info-right">
                <div class="info-item">
                    <span class="info-label">Total Siswa:</span>
                    {{ $statistik['total_siswa'] }} siswa
                </div>
                <div class="info-item">
                    <span class="info-label">Rata-rata Skor:</span>
                    {{ number_format($statistik['rata_rata_skor'], 4) }}
                </div>
                <div class="info-item">
                    <span class="info-label">Dicetak oleh:</span>
                    {{ auth()->user()->nama }}
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Hasil -->
    <div class="section">
        <h3 class="section-title">RANKING HASIL EVALUASI SISWA</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 8%">Rank</th>
                    <th style="width: 12%">Kode</th>
                    <th style="width: 25%">Nama Siswa</th>
                    <th style="width: 15%">Jenis Kelamin</th>
                    <th style="width: 12%">Skor Akhir</th>
                    <th style="width: 15%">Kategori</th>
                    <th style="width: 13%">Umur</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $item)
                    <tr class="{{ $item->ranking <= 3 ? 'ranking-' . $item->ranking : '' }}">
                        <td>{{ $item->ranking }}</td>
                        <td><strong>{{ $item->alternatif->kode_alternatif }}</strong></td>
                        <td class="text-left">{{ $item->alternatif->nama }}</td>
                        <td>{{ $item->alternatif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td><strong>{{ number_format($item->skor_akhir, 4) }}</strong></td>
                        <td>
                            <span class="kategori-{{ strtolower(str_replace(' ', '-', $item->kategori)) }}">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td>{{ $item->alternatif->umur }} tahun</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Catatan -->
    <div class="note-box">
        <h4>CATATAN EVALUASI:</h4>
        <ul>
            <li><strong>Sangat Baik (Skor ≥ 0.8):</strong> Perkembangan anak sangat baik, pertahankan stimulasi yang
                sudah diberikan</li>
            <li><strong>Baik (Skor 0.6-0.79):</strong> Perkembangan anak sesuai harapan, lanjutkan dengan variasi
                kegiatan</li>
            <li><strong>Cukup (Skor 0.4-0.59):</strong> Perkembangan anak cukup, perlu stimulasi tambahan pada beberapa
                aspek</li>
            <li><strong>Kurang (Skor < 0.4):</strong> Perkembangan anak memerlukan perhatian khusus dan stimulasi
                        intensif</li>
        </ul>
    </div>

    <!-- Kriteria yang Dinilai -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">KRITERIA PENILAIAN YANG DIGUNAKAN</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%">Kode</th>
                    <th style="width: 35%">Nama Kriteria</th>
                    <th style="width: 15%">Bobot</th>
                    <th style="width: 35%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria as $k)
                    <tr>
                        <td><strong>{{ $k->kode_kriteria }}</strong></td>
                        <td class="text-left">{{ $k->nama }}</td>
                        <td><strong>{{ number_format($k->bobot, 2) }}</strong></td>
                        <td class="text-left">{{ $k->keterangan ?? 'Aspek penilaian perkembangan anak usia dini' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
