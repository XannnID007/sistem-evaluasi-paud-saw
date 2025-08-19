<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Evaluasi Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #a16207;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #a16207, #92400e);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            color: white;
            font-size: 24px;
        }

        .header h1 {
            font-size: 20px;
            font-weight: bold;
            color: #a16207;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 16px;
            color: #92400e;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 11px;
            color: #666;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #a16207;
        }

        .info-left,
        .info-right {
            width: 48%;
        }

        .info-item {
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #a16207;
            display: inline-block;
            width: 120px;
        }

        .statistik {
            margin-bottom: 25px;
        }

        .statistik h3 {
            color: #a16207;
            font-size: 14px;
            margin-bottom: 15px;
            border-bottom: 2px solid #a16207;
            padding-bottom: 5px;
        }

        .stats-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .stat-card {
            width: 23%;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #a16207;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #a16207;
            display: block;
        }

        .stat-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }

        .tabel-section {
            margin-bottom: 25px;
        }

        .tabel-section h3 {
            color: #a16207;
            font-size: 14px;
            margin-bottom: 15px;
            border-bottom: 2px solid #a16207;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: white;
        }

        table th {
            background: linear-gradient(135deg, #eaddd7, #d2bab0);
            color: #78350f;
            font-weight: bold;
            text-align: center;
            padding: 12px 8px;
            border: 1px solid #a16207;
            font-size: 11px;
            text-transform: uppercase;
        }

        table td {
            padding: 10px 8px;
            border: 1px solid #d1d5db;
            text-align: center;
            font-size: 11px;
        }

        .ranking-1 {
            background: #fef3c7 !important;
            font-weight: bold;
            color: #92400e;
        }

        .ranking-2 {
            background: #f3f4f6 !important;
            font-weight: bold;
        }

        .ranking-3 {
            background: #fed7aa !important;
            font-weight: bold;
        }

        .kategori-sangat-baik {
            background: #dcfce7;
            color: #166534;
            font-weight: bold;
        }

        .kategori-baik {
            background: #dbeafe;
            color: #1e40af;
            font-weight: bold;
        }

        .kategori-cukup {
            background: #fef3c7;
            color: #a16207;
            font-weight: bold;
        }

        .kategori-kurang {
            background: #fee2e2;
            color: #dc2626;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .signature {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #333;
            margin: 60px 0 10px 0;
        }

        .catatan {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-left: 4px solid #0ea5e9;
            padding: 15px;
            margin: 20px 0;
            border-radius: 6px;
        }

        .catatan h4 {
            color: #0369a1;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .catatan ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .catatan li {
            margin-bottom: 5px;
            font-size: 11px;
            color: #0369a1;
        }

        .page-break {
            page-break-before: always;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">🎓</div>
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN HASIL EVALUASI PERKEMBANGAN ANAK</h2>
        <p>Menggunakan Metode Simple Additive Weighting (SAW)</p>
    </div>

    <!-- Info Laporan -->
    <div class="info-section">
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
                {{ auth()->user()->nama }} (Guru)
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="statistik">
        <h3>Statistik Hasil Evaluasi</h3>
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['sangat_baik'] }}</span>
                <div class="stat-label">Sangat Baik</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['baik'] }}</span>
                <div class="stat-label">Baik</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['cukup'] }}</span>
                <div class="stat-label">Cukup</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['kurang'] }}</span>
                <div class="stat-label">Kurang</div>
            </div>
        </div>
    </div>

    <!-- Tabel Hasil -->
    <div class="tabel-section">
        <h3>Ranking Hasil Evaluasi Siswa</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 8%">Rank</th>
                    <th style="width: 12%">Kode</th>
                    <th style="width: 25%">Nama Siswa</th>
                    <th style="width: 15%">Jenis Kelamin</th>
                    <th style="width: 12%">Skor Akhir</th>
                    <th style="width: 15%">Kategori</th>
                    <th style="width: 13%">Rekomendasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $item)
                    <tr class="{{ $item->ranking <= 3 ? 'ranking-' . $item->ranking : '' }}">
                        <td>
                            @if ($item->ranking == 1)
                                🏆 {{ $item->ranking }}
                            @elseif($item->ranking == 2)
                                🥈 {{ $item->ranking }}
                            @elseif($item->ranking == 3)
                                🥉 {{ $item->ranking }}
                            @else
                                {{ $item->ranking }}
                            @endif
                        </td>
                        <td><strong>{{ $item->alternatif->kode }}</strong></td>
                        <td style="text-align: left;">{{ $item->alternatif->nama }}</td>
                        <td>
                            {{ $item->alternatif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>
                        <td><strong>{{ number_format($item->skor_akhir, 4) }}</strong></td>
                        <td class="kategori-{{ strtolower(str_replace(' ', '-', $item->kategori)) }}">
                            {{ $item->kategori }}
                        </td>
                        <td style="text-align: left; font-size: 10px;">
                            @if ($item->kategori == 'Sangat Baik')
                                Pertahankan perkembangan
                            @elseif($item->kategori == 'Baik')
                                Lanjutkan stimulasi
                            @elseif($item->kategori == 'Cukup')
                                Perlukan stimulasi tambahan
                            @else
                                Perhatian khusus diperlukan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Catatan -->
    <div class="catatan">
        <h4>📋 Catatan Evaluasi untuk Guru:</h4>
        <ul>
            <li><strong>Sangat Baik (Skor ≥ 0.8):</strong> Anak menunjukkan perkembangan yang sangat baik. Pertahankan
                stimulasi dan berikan tantangan yang sesuai.</li>
            <li><strong>Baik (Skor 0.6-0.79):</strong> Perkembangan anak sesuai harapan. Lanjutkan dengan variasi
                kegiatan pembelajaran.</li>
            <li><strong>Cukup (Skor 0.4-0.59):</strong> Anak memerlukan stimulasi tambahan pada beberapa aspek
                perkembangan.</li>
            <li><strong>Kurang (Skor < 0.4):</strong> Anak memerlukan perhatian khusus dan program stimulasi yang
                        intensif.</li>
        </ul>
    </div>

    <!-- Informasi Kriteria -->
    <div class="page-break"></div>
    <div class="tabel-section">
        <h3>Kriteria Penilaian yang Digunakan</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%">Kode</th>
                    <th style="width: 40%">Nama Kriteria</th>
                    <th style="width: 15%">Bobot</th>
                    <th style="width: 30%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria as $k)
                    <tr>
                        <td><strong>{{ $k->kode }}</strong></td>
                        <td style="text-align: left;">{{ $k->nama }}</td>
                        <td><strong>{{ number_format($k->bobot, 3) }}</strong></td>
                        <td style="text-align: left; font-size: 10px;">
                            {{ $k->keterangan ?? 'Aspek perkembangan anak usia dini' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Rekomendasi untuk Guru -->
    <div class="catatan">
        <h4>🎯 Rekomendasi Tindak Lanjut untuk Guru:</h4>
        <ul>
            <li><strong>Untuk anak kategori "Sangat Baik":</strong> Berikan tantangan yang lebih kompleks dan jadikan
                sebagai tutor sebaya.</li>
            <li><strong>Untuk anak kategori "Baik":</strong> Lanjutkan program pembelajaran dengan sedikit variasi
                aktivitas.</li>
            <li><strong>Untuk anak kategori "Cukup":</strong> Berikan stimulasi tambahan dan perhatian lebih pada aspek
                yang kurang.</li>
            <li><strong>Untuk anak kategori "Kurang":</strong> Lakukan konsultasi dengan orangtua dan buat program
                khusus.</li>
            <li><strong>Pemantauan:</strong> Lakukan evaluasi berkala setiap 3 bulan untuk melihat perkembangan.</li>
        </ul>
    </div>

    <!-- Footer dengan Tanda Tangan -->
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
                <p><strong>Guru Kelas</strong></p>
                <div class="signature-line"></div>
                <p><strong>{{ auth()->user()->nama }}</strong></p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-size: 10px; color: #666;">
            <p>Laporan ini dibuat secara otomatis oleh Sistem Pendukung Keputusan PAUD Flamboyan</p>
            <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
        </div>
    </div>
</body>

</html>
