<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Siswa</title>
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

        /* Gender styling */
        .laki-laki {
            background: #007bff;
            color: #fff;
            font-weight: bold;
            padding: 3px 6px;
        }

        .perempuan {
            background: #e91e63;
            color: #fff;
            font-weight: bold;
            padding: 3px 6px;
        }

        /* Status penilaian styling */
        .nilai-lengkap {
            background: #28a745;
            color: #fff;
            font-weight: bold;
            padding: 3px 6px;
        }

        .nilai-sebagian {
            background: #ffc107;
            color: #000;
            font-weight: bold;
            padding: 3px 6px;
        }

        .nilai-kosong {
            background: #dc3545;
            color: #fff;
            font-weight: bold;
            padding: 3px 6px;
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

        /* Statistics */
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .stat-item {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 10px;
            border: 1px solid #000;
        }

        .stat-number {
            font-size: 20px;
            font-weight: bold;
            display: block;
        }

        .stat-label {
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN DATA SISWA</h2>
        <p>Data Lengkap Siswa dan Status Penilaian</p>
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
                    <span class="info-label">Total Siswa:</span>
                    {{ $statistik['total_siswa'] }} siswa
                </div>
            </div>
            <div class="info-right">
                <div class="info-item">
                    <span class="info-label">Laki-laki:</span>
                    {{ $statistik['laki_laki'] }} siswa
                </div>
                <div class="info-item">
                    <span class="info-label">Perempuan:</span>
                    {{ $statistik['perempuan'] }} siswa
                </div>
                <div class="info-item">
                    <span class="info-label">Dicetak oleh:</span>
                    {{ auth()->user()->nama }}
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="stats-grid">
        <div class="stat-item">
            <span class="stat-number">{{ $statistik['total_siswa'] }}</span>
            <span class="stat-label">Total Siswa</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $statistik['laki_laki'] }}</span>
            <span class="stat-label">Laki-laki</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $statistik['perempuan'] }}</span>
            <span class="stat-label">Perempuan</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ number_format($statistik['rata_rata_umur'], 1) }}</span>
            <span class="stat-label">Rata-rata Umur</span>
        </div>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="section">
        <h3 class="section-title">DAFTAR LENGKAP DATA SISWA</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 10%">Kode</th>
                    <th style="width: 22%">Nama Siswa</th>
                    <th style="width: 12%">Jenis Kelamin</th>
                    <th style="width: 12%">Tanggal Lahir</th>
                    <th style="width: 8%">Umur</th>
                    <th style="width: 20%">Nama Orang Tua</th>
                    <th style="width: 11%">Status Penilaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatif as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $siswa->kode_alternatif }}</strong></td>
                        <td class="text-left">{{ $siswa->nama }}</td>
                        <td>
                            <span class="{{ $siswa->jenis_kelamin == 'L' ? 'laki-laki' : 'perempuan' }}">
                                {{ $siswa->jenis_kelamin == 'L' ? 'L' : 'P' }}
                            </span>
                        </td>
                        <td>{{ $siswa->tanggal_lahir->format('d/m/Y') }}</td>
                        <td>{{ $siswa->umur }} th</td>
                        <td class="text-left">{{ $siswa->nama_orangtua ?? '-' }}</td>
                        <td>
                            @php
                                $totalPenilaian = $siswa->penilaian->count();
                                $totalKriteria = $kriteria->count();
                            @endphp
                            @if ($totalPenilaian == $totalKriteria)
                                <span class="nilai-lengkap">Lengkap</span>
                            @elseif($totalPenilaian > 0)
                                <span class="nilai-sebagian">{{ $totalPenilaian }}/{{ $totalKriteria }}</span>
                            @else
                                <span class="nilai-kosong">Belum</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Halaman Kedua: Detail Alamat -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">DATA ALAMAT DAN KONTAK SISWA</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 12%">Kode</th>
                    <th style="width: 25%">Nama Siswa</th>
                    <th style="width: 25%">Nama Orang Tua</th>
                    <th style="width: 33%">Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatif as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $siswa->kode_alternatif }}</strong></td>
                        <td class="text-left">{{ $siswa->nama }}</td>
                        <td class="text-left">{{ $siswa->nama_orangtua ?? '-' }}</td>
                        <td class="text-left">{{ $siswa->alamat ?? 'Alamat tidak tersedia' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Halaman Ketiga: Status Penilaian Detail -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">STATUS PENILAIAN PER KRITERIA</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 12%">Kode</th>
                    <th style="width: 20%">Nama Siswa</th>
                    @foreach ($kriteria as $k)
                        <th style="width: {{ 63 / $kriteria->count() }}%">{{ $k->kode_kriteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatif as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ _alternatif_alternatif }}</strong></td>
                        <td class="text-left">{{ $siswa->nama }}</td>
                        @foreach ($kriteria as $k)
                            @php
                                $nilai = $siswa->penilaian->where('kriteria_id', $k->kriteria_id)->first();
                            @endphp
                            <td>
                                @if ($nilai)
                                    <span class="nilai-lengkap">{{ $nilai->nilai }}</span>
                                @else
                                    <span class="nilai-kosong">-</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Catatan -->
    <div class="note-box">
        <h4>KETERANGAN:</h4>
        <ul>
            <li><strong>Lengkap:</strong> Siswa sudah dinilai untuk semua kriteria</li>
            <li><strong>Angka:</strong> Jumlah kriteria yang sudah dinilai dari total kriteria</li>
            <li><strong>Belum:</strong> Siswa belum dinilai sama sekali</li>
            <li><strong>Nilai 1-4:</strong> Skor penilaian (1=BB, 2=MB, 3=BSH, 4=BSB)</li>
        </ul>
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
