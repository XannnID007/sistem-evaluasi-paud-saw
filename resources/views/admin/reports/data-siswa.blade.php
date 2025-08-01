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
            width: 19%;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #a16207;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 20px;
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
            padding: 10px 6px;
            border: 1px solid #a16207;
            font-size: 10px;
            text-transform: uppercase;
        }

        table td {
            padding: 8px 6px;
            border: 1px solid #d1d5db;
            text-align: center;
            font-size: 10px;
        }

        .text-left {
            text-align: left !important;
        }

        .laki-laki {
            background: #dbeafe;
            color: #1e40af;
        }

        .perempuan {
            background: #fce7f3;
            color: #be185d;
        }

        .sudah-dinilai {
            background: #dcfce7;
            color: #166534;
            font-weight: bold;
        }

        .belum-dinilai {
            background: #fee2e2;
            color: #dc2626;
            font-weight: bold;
        }

        .sebagian-dinilai {
            background: #fef3c7;
            color: #a16207;
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

        .page-break {
            page-break-before: always;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }

        .nilai-lengkap {
            background: #dcfce7;
            color: #166534;
        }

        .nilai-sebagian {
            background: #fef3c7;
            color: #a16207;
        }

        .nilai-kosong {
            background: #fee2e2;
            color: #dc2626;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="logo"></div>
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN DATA SISWA</h2>
        <p>Data Lengkap Siswa dan Status Penilaian</p>
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

    <!-- Tabel Data Siswa -->
    <div class="tabel-section">
        <h3>Daftar Lengkap Data Siswa</h3>
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
                        <td><strong>{{ $siswa->kode }}</strong></td>
                        <td class="text-left">{{ $siswa->nama }}</td>
                        <td class="{{ $siswa->jenis_kelamin == 'L' ? 'laki-laki' : 'perempuan' }}">
                            {{ $siswa->jenis_kelamin == 'L' ? 'L' : 'P' }}
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
                                <span class="nilai-lengkap">✓ Lengkap</span>
                            @elseif($totalPenilaian > 0)
                                <span class="nilai-sebagian">{{ $totalPenilaian }}/{{ $totalKriteria }}</span>
                            @else
                                <span class="nilai-kosong">✗ Belum</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Halaman Kedua: Detail Alamat -->
    <div class="page-break"></div>
    <div class="tabel-section">
        <h3>Data Alamat dan Kontak Siswa</h3>
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
                        <td><strong>{{ $siswa->kode }}</strong></td>
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
    <div class="tabel-section">
        <h3>Status Penilaian Per Kriteria</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 12%">Kode</th>
                    <th style="width: 20%">Nama Siswa</th>
                    @foreach ($kriteria as $k)
                        <th style="width: {{ 63 / $kriteria->count() }}%">{{ $k->kode }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatif as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $siswa->kode }}</strong></td>
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

    <!-- Ringkasan Kriteria -->
    <div class="tabel-section">
        <h3>Keterangan Kriteria Penilaian</h3>
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
                        <td><strong>{{ $k->kode }}</strong></td>
                        <td class="text-left">{{ $k->nama }}</td>
                        <td><strong>{{ number_format($k->bobot, 3) }}</strong></td>
                        <td class="text-left" style="font-size: 9px;">
                            {{ $k->keterangan ?? 'Aspek perkembangan anak usia dini' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer dengan Tanda Tangan -->
    <div class="footer">
        <div
            style="background: #f0f9ff; border: 1px solid #0ea5e9; border-left: 4px solid #0ea5e9; padding: 15px; margin: 20px 0; border-radius: 6px;">
            <h4 style="color: #0369a1; font-size: 12px; margin-bottom: 10px;">📌 Catatan:</h4>
            <ul style="list-style-type: disc; padding-left: 20px;">
                <li style="margin-bottom: 5px; font-size: 10px; color: #0369a1;"><strong>Lengkap:</strong> Siswa sudah
                    dinilai untuk semua kriteria</li>
                <li style="margin-bottom: 5px; font-size: 10px; color: #0369a1;"><strong>Angka:</strong> Jumlah kriteria
                    yang sudah dinilai dari total kriteria</li>
                <li style="margin-bottom: 5px; font-size: 10px; color: #0369a1;"><strong>Belum:</strong> Siswa belum
                    dinilai sama sekali</li>
            </ul>
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
                <p><strong>Yang Membuat Laporan</strong></p>
                <div class="signature-line"></div>
                <p><strong>{{ auth()->user()->nama }}</strong></p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; font-size: 10px; color: #666;">
            <p>Laporan ini dibuat secara otomatis oleh Sistem Pendukung Keputusan PAUD Flamboyan</p>
        </div>
    </div>
</body>

</html>
