<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai Alternatif</title>
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
            padding: 12px 6px;
            border: 1px solid #000;
            font-size: 12px;
        }

        table td {
            padding: 8px 6px;
            border: 1px solid #000;
            text-align: center;
            font-size: 12px;
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

        /* Status nilai styling */
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

        /* Kriteria summary */
        .criteria-summary {
            background: #f5f5dc;
            border: 1px solid #000;
            padding: 15px;
            margin-bottom: 20px;
        }

        .criteria-summary h4 {
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN NILAI ALTERNATIF</h2>
        <p>Status Penilaian Siswa untuk Setiap Kriteria</p>
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
                    <span class="info-label">Penilaian Lengkap:</span>
                    {{ $statistik['penilaian_lengkap'] }} siswa
                </div>
                <div class="info-item">
                    <span class="info-label">Persentase Lengkap:</span>
                    {{ number_format($statistik['persentase_lengkap'], 1) }}%
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
            <span class="stat-number">{{ $statistik['penilaian_lengkap'] }}</span>
            <span class="stat-label">Penilaian Lengkap</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $statistik['penilaian_sebagian'] }}</span>
            <span class="stat-label">Penilaian Sebagian</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $statistik['belum_dinilai'] }}</span>
            <span class="stat-label">Belum Dinilai</span>
        </div>
    </div>

    <!-- Tabel Nilai Per Kriteria -->
    <div class="section">
        <h3 class="section-title">MATRIKS NILAI SISWA PER KRITERIA</h3>
        <table>
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%; vertical-align: middle;">No</th>
                    <th rowspan="2" style="width: 20%; vertical-align: middle;">Siswa</th>
                    <th colspan="{{ $kriteria->count() }}">Kriteria Penilaian</th>
                    <th rowspan="2" style="width: 12%; vertical-align: middle;">Status</th>
                </tr>
                <tr>
                    @foreach ($kriteria as $k)
                        <th style="width: {{ 63 / $kriteria->count() }}%;">
                            {{ $k->kode_kriteria }}<br>
                            <small style="font-size: 10px;">({{ number_format($k->bobot, 2) }})</small>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatif as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-left">
                            <strong>{{ $siswa->kode_alternatif }}</strong><br>
                            <small>{{ $siswa->nama }}</small>
                        </td>
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
                        <td>
                            @php
                                $totalPenilaian = $siswa->penilaian->count();
                                $totalKriteria = $kriteria->count();
                            @endphp
                            @if ($totalPenilaian == $totalKriteria)
                                <span class="nilai-lengkap">{{ $totalPenilaian }}/{{ $totalKriteria }}</span>
                            @elseif($totalPenilaian > 0)
                                <span class="nilai-sebagian">{{ $totalPenilaian }}/{{ $totalKriteria }}</span>
                            @else
                                <span class="nilai-kosong">0/{{ $totalKriteria }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Halaman Kedua: Summary per Kriteria -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">RINGKASAN PENILAIAN PER KRITERIA</h3>

        @foreach ($kriteria as $k)
            <div class="criteria-summary">
                <h4>{{ $k->kode_kriteria }} - {{ $k->nama }} (Bobot: {{ number_format($k->bobot, 2) }})</h4>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 15%">Nilai</th>
                            <th style="width: 15%">Jumlah</th>
                            <th style="width: 15%">Persentase</th>
                            <th style="width: 55%">Daftar Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($nilai = 4; $nilai >= 1; $nilai--)
                            @php
                                $siswaDenganNilai = $alternatif->filter(function ($siswa) use ($k, $nilai) {
                                    $penilaian = $siswa->penilaian->where('kriteria_id', $k->kriteria_id)->first();
                                    return $penilaian && $penilaian->nilai == $nilai;
                                });
                                $jumlah = $siswaDenganNilai->count();
                                $persentase = $alternatif->count() > 0 ? ($jumlah / $alternatif->count()) * 100 : 0;
                            @endphp
                            <tr>
                                <td><span class="nilai-lengkap">{{ $nilai }}</span></td>
                                <td>{{ $jumlah }} siswa</td>
                                <td>{{ number_format($persentase, 1) }}%</td>
                                <td class="text-left">
                                    {{ $siswaDenganNilai->pluck('nama')->implode(', ') ?: '-' }}
                                </td>
                            </tr>
                        @endfor

                        @php
                            $belumDinilai = $alternatif->filter(function ($siswa) use ($k) {
                                return !$siswa->penilaian->where('kriteria_id', $k->kriteria_id)->first();
                            });
                            $jumlahBelum = $belumDinilai->count();
                            $persentaseBelum =
                                $alternatif->count() > 0 ? ($jumlahBelum / $alternatif->count()) * 100 : 0;
                        @endphp
                        @if ($jumlahBelum > 0)
                            <tr>
                                <td><span class="nilai-kosong">-</span></td>
                                <td>{{ $jumlahBelum }} siswa</td>
                                <td>{{ number_format($persentaseBelum, 1) }}%</td>
                                <td class="text-left">
                                    {{ $belumDinilai->pluck('nama')->implode(', ') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>

    <!-- Daftar Siswa Belum Lengkap -->
    <div class="page-break"></div>
    <div class="section">
        <h3 class="section-title">DAFTAR SISWA YANG BELUM DINILAI LENGKAP</h3>

        @php
            $siswaBelumLengkap = $alternatif->filter(function ($siswa) use ($kriteria) {
                return $siswa->penilaian->count() < $kriteria->count();
            });
        @endphp

        @if ($siswaBelumLengkap->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 15%">Kode</th>
                        <th style="width: 25%">Nama Siswa</th>
                        <th style="width: 15%">Progress</th>
                        <th style="width: 40%">Kriteria yang Belum Dinilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaBelumLengkap as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $siswa->kode_alternatif }}</strong></td>
                            <td class="text-left">{{ $siswa->nama }}</td>
                            <td>
                                @php
                                    $progress = $siswa->penilaian->count();
                                    $total = $kriteria->count();
                                @endphp
                                <span class="{{ $progress == 0 ? 'nilai-kosong' : 'nilai-sebagian' }}">
                                    {{ $progress }}/{{ $total }}
                                </span>
                            </td>
                            <td class="text-left">
                                @php
                                    $kriteriaDinilai = $siswa->penilaian->pluck('kriteria_id')->toArray();
                                    $kriteriaBelum = $kriteria
                                        ->whereNotIn('kriteria_id', $kriteriaDinilai)
                                        ->pluck('kode')
                                        ->toArray();
                                @endphp
                                {{ implode(', ', $kriteriaBelum) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="note-box" style="text-align: center;">
                <h4>SEMUA SISWA SUDAH DINILAI LENGKAP!</h4>
                <p>Selamat! Semua siswa sudah memiliki penilaian lengkap untuk semua kriteria.</p>
            </div>
        @endif
    </div>

    <!-- Catatan -->
    <div class="note-box">
        <h4>KETERANGAN NILAI DAN STATUS:</h4>
        <ul>
            <li><strong>Nilai 4 (BSB):</strong> Berkembang Sangat Baik</li>
            <li><strong>Nilai 3 (BSH):</strong> Berkembang Sesuai Harapan</li>
            <li><strong>Nilai 2 (MB):</strong> Mulai Berkembang</li>
            <li><strong>Nilai 1 (BB):</strong> Belum Berkembang</li>
            <li><strong>Status Lengkap:</strong> Siswa sudah dinilai untuk semua kriteria</li>
            <li><strong>Status Sebagian:</strong> Siswa baru dinilai untuk beberapa kriteria</li>
            <li><strong>Status Belum:</strong> Siswa belum dinilai sama sekali</li>
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
