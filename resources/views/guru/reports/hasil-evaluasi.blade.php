{{-- resources/views/guru/reports/hasil-evaluasi.blade.php --}}
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

        .ranking-top10 {
            background: #dbeafe !important;
            color: #1e40af;
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

        .alternatif-name {
            text-align: left !important;
            font-weight: bold;
        }

        .top-performers {
            background: #fffbeb;
            border: 1px solid #f59e0b;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .top-performers h4 {
            color: #92400e;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .performer-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .performer-item:last-child {
            border-bottom: none;
        }

        .performer-rank {
            width: 20px;
            height: 20px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            margin-right: 10px;
        }

        .performer-name {
            font-weight: bold;
            font-size: 11px;
        }

        .performer-score {
            font-weight: bold;
            color: #059669;
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
        <h2>LAPORAN HASIL EVALUASI SISWA</h2>
        <p>Laporan Perkembangan Anak Usia Dini - Periode {{ date('Y') }}</p>
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
        <h3>Distribusi Kategori Perkembangan</h3>
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['sangat_baik'] }}</span>
                <div class="stat-label">Sangat Baik</div>
                <div class="stat-label">
                    ({{ $statistik['total_siswa'] > 0 ? number_format(($statistik['sangat_baik'] / $statistik['total_siswa']) * 100, 1) : 0 }}%)
                </div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['baik'] }}</span>
                <div class="stat-label">Baik</div>
                <div class="stat-label">
                    ({{ $statistik['total_siswa'] > 0 ? number_format(($statistik['baik'] / $statistik['total_siswa']) * 100, 1) : 0 }}%)
                </div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['cukup'] }}</span>
                <div class="stat-label">Cukup</div>
                <div class="stat-label">
                    ({{ $statistik['total_siswa'] > 0 ? number_format(($statistik['cukup'] / $statistik['total_siswa']) * 100, 1) : 0 }}%)
                </div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['kurang'] }}</span>
                <div class="stat-label">Kurang</div>
                <div class="stat-label">
                    ({{ $statistik['total_siswa'] > 0 ? number_format(($statistik['kurang'] / $statistik['total_siswa']) * 100, 1) : 0 }}%)
                </div>
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
                    <th style="width: 12%">L/P</th>
                    <th style="width: 8%">Umur</th>
                    <th style="width: 12%">Skor</th>
                    <th style="width: 15%">Kategori</th>
                    <th style="width: 8%">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $item)
                    <tr
                        class="{{ $item->ranking <= 3 ? 'ranking-' . $item->ranking : ($item->ranking <= 10 ? 'ranking-top10' : '') }}">
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
                        <td class="alternatif-name">{{ $item->alternatif->nama }}</td>
                        <td>{{ $item->alternatif->jenis_kelamin }}</td>
                        <td>{{ $item->alternatif->umur }}th</td>
                        <td><strong>{{ number_format($item->skor_akhir, 4) }}</strong></td>
                        <td class="kategori-{{ strtolower(str_replace(' ', '-', $item->kategori)) }}">
                            {{ $item->kategori }}
                        </td>
                        <td>{{ number_format(($item->skor_akhir / ($statistik['skor_tertinggi'] ?: 1)) * 100, 1) }}%
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Top Performers Analysis -->
    <div class="top-performers">
        <h4>🌟 Top 10 Siswa Berprestasi</h4>
        @foreach ($hasil->take(10) as $index => $item)
            <div class="performer-item">
                <div>
                    <span class="performer-rank">{{ $index + 1 }}</span>
                    <span class="performer-name">{{ $item->alternatif->nama }}</span>
                    <span style="font-size: 10px; color: #666;">({{ $item->alternatif->kode }})</span>
                </div>
                <div>
                    <span class="performer-score">{{ number_format($item->skor_akhir, 4) }}</span>
                    <span style="font-size: 10px; color: #666; margin-left: 5px;">{{ $item->kategori }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Catatan dan Rekomendasi -->
    <div class="catatan">
        <h4>📋 Catatan Evaluasi dan Rekomendasi:</h4>
        <ul>
            <li><strong>Sangat Baik ({{ $statistik['sangat_baik'] }} siswa):</strong> Perkembangan sangat optimal.
                Pertahankan stimulasi yang sudah diberikan dan berikan tantangan lebih untuk mengembangkan potensi.</li>
            <li><strong>Baik ({{ $statistik['baik'] }} siswa):</strong> Perkembangan sesuai harapan. Lanjutkan dengan
                variasi kegiatan dan metode pembelajaran yang beragam.</li>
            <li><strong>Cukup ({{ $statistik['cukup'] }} siswa):</strong> Perkembangan cukup baik namun perlu stimulasi
                tambahan pada beberapa aspek yang masih kurang.</li>
            <li><strong>Kurang ({{ $statistik['kurang'] }} siswa):</strong> Memerlukan perhatian khusus dan stimulasi
                intensif. Disarankan konsultasi dengan ahli perkembangan anak.</li>
        </ul>
    </div>

    <!-- Halaman Kedua: Detail Rekomendasi per Kategori -->
    <div class="page-break"></div>
    <div class="tabel-section">
        <h3>Detail Rekomendasi Berdasarkan Kategori</h3>

        @if ($statistik['sangat_baik'] > 0)
            <div
                style="margin-bottom: 20px; background: #dcfce7; padding: 12px; border-radius: 6px; border-left: 4px solid #16a34a;">
                <h4 style="color: #166534; margin-bottom: 8px;">🌟 Siswa Kategori Sangat Baik
                    ({{ $statistik['sangat_baik'] }} siswa)</h4>
                <div style="font-size: 10px;">
                    @foreach ($hasil->where('kategori', 'Sangat Baik') as $item)
                        <span style="margin-right: 10px;">{{ $item->alternatif->nama }}</span>
                    @endforeach
                </div>
                <p style="margin-top: 8px; font-size: 11px; color: #166534;">
                    <strong>Rekomendasi:</strong> Berikan program pengayaan dan tantangan lebih tinggi. Pertimbangkan
                    sebagai tutor sebaya.
                    Kembangkan bakat khusus yang dimiliki masing-masing anak.
                </p>
            </div>
        @endif

        @if ($statistik['baik'] > 0)
            <div
                style="margin-bottom: 20px; background: #dbeafe; padding: 12px; border-radius: 6px; border-left: 4px solid #3b82f6;">
                <h4 style="color: #1e40af; margin-bottom: 8px;">👍 Siswa Kategori Baik ({{ $statistik['baik'] }} siswa)
                </h4>
                <div style="font-size: 10px;">
                    @foreach ($hasil->where('kategori', 'Baik') as $item)
                        <span style="margin-right: 10px;">{{ $item->alternatif->nama }}</span>
                    @endforeach
                </div>
                <p style="margin-top: 8px; font-size: 11px; color: #1e40af;">
                    <strong>Rekomendasi:</strong> Pertahankan kegiatan pembelajaran yang ada. Berikan variasi metode dan
                    aktivitas yang lebih menarik untuk mencapai kategori sangat baik.
                </p>
            </div>
        @endif

        @if ($statistik['cukup'] > 0)
            <div
                style="margin-bottom: 20px; background: #fef3c7; padding: 12px; border-radius: 6px; border-left: 4px solid #f59e0b;">
                <h4 style="color: #a16207; margin-bottom: 8px;">⚠️ Siswa Kategori Cukup ({{ $statistik['cukup'] }}
                    siswa)</h4>
                <div style="font-size: 10px;">
                    @foreach ($hasil->where('kategori', 'Cukup') as $item)
                        <span style="margin-right: 10px;">{{ $item->alternatif->nama }}</span>
                    @endforeach
                </div>
                <p style="margin-top: 8px; font-size: 11px; color: #a16207;">
                    <strong>Rekomendasi:</strong> Identifikasi aspek yang masih kurang. Berikan stimulasi tambahan dan
                    pendampingan lebih intensif. Libatkan orang tua dalam program pembelajaran di rumah.
                </p>
            </div>
        @endif

        @if ($statistik['kurang'] > 0)
            <div
                style="margin-bottom: 20px; background: #fee2e2; padding: 12px; border-radius: 6px; border-left: 4px solid #ef4444;">
                <h4 style="color: #dc2626; margin-bottom: 8px;">🚨 Siswa Kategori Kurang ({{ $statistik['kurang'] }}
                    siswa)</h4>
                <div style="font-size: 10px;">
                    @foreach ($hasil->where('kategori', 'Kurang') as $item)
                        <span style="margin-right: 10px;">{{ $item->alternatif->nama }}</span>
                    @endforeach
                </div>
                <p style="margin-top: 8px; font-size: 11px; color: #dc2626;">
                    <strong>Rekomendasi:</strong> Perlu perhatian khusus dan program individual. Konsultasi dengan
                    psikolog anak atau ahli perkembangan. Koordinasi intensif dengan orang tua.
                </p>
            </div>
        @endif
    </div>

    <!-- Footer dengan Tanda Tangan -->
    <div class="footer">
        <div
            style="background: #f0f9ff; border: 1px solid #0ea5e9; border-left: 4px solid #0ea5e9; padding: 12px; margin: 15px 0; border-radius: 6px;">
            <h4 style="color: #0369a1; font-size: 11px; margin-bottom: 8px;">📝 Metodologi Penilaian:</h4>
            <p style="font-size: 10px; color: #0369a1; margin-bottom: 5px;">
                Evaluasi menggunakan metode Simple Additive Weighting (SAW) dengan {{ $kriteria->count() }} aspek
                perkembangan anak usia dini.
            </p>
            <p style="font-size: 10px; color: #0369a1;">
                Skala penilaian: 1 (Belum Berkembang), 2 (Mulai Berkembang), 3 (Berkembang Sesuai Harapan), 4
                (Berkembang Sangat Baik).
            </p>
        </div>

        <div class="signature-section">
            <div class="signature">
                <p>Mengetahui,</p>
                <p><strong>Kepala PAUD Flamboyan</strong></p>
                <div class="signature-line"></div>
                <p>(_______________________)</p>
            </div>
            <div class="signature">
                <p>{{ date('d F Y') }}</p>
                <p><strong>Guru Pembuat Laporan</strong></p>
                <div class="signature-line"></div>
                <p><strong>{{ auth()->user()->nama }}</strong></p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-size: 10px; color: #666;">
            <p>Laporan ini dibuat secara otomatis oleh Sistem Pendukung Keputusan PAUD Flamboyan</p>
            <p>Dicetak pada: {{ date('d F Y, H:i:s') }} WIB</p>
        </div>
    </div>
</body>

</html>
