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

        .info-left, .info-right {
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

        .statistik {
            margin-bottom: 20px;
        }

        .statistik h3 {
            color: #a16207;
            font-size: 13px;
            margin-bottom: 12px;
            border-bottom: 2px solid #a16207;
            padding-bottom: 4px;
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
            border-left: 3px solid #a16207;
            padding: 12px;
            text-align: center;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 16px;
            font-weight: bold;
            color: #a16207;
            display: block;
        }

        .stat-label {
            font-size: 9px;
            color: #666;
            margin-top: 4px;
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
            padding: 8px 3px;
            border: 1px solid #a16207;
            text-transform: uppercase;
        }

        table td {
            padding: 6px 3px;
            border: 1px solid #d1d5db;
            text-align: center;
        }

        .text-left {
            text-align: left !important;
        }

        .alternatif-col {
            text-align: left !important;
            font-weight: bold;
            background: #f9fafb;
            width: 20%;
        }

        .nilai-lengkap {
            background: #dcfce7;
            color: #166534;
            font-weight: bold;
        }

        .nilai-sebagian {
            background: #fef3c7;
            color: #a16207;
            font-weight: bold;
        }

        .nilai-kosong {
            background: #fee2e2;
            color: #dc2626;
            font-weight: bold;
        }

        .nilai-cell {
            min-width: 25px;
        }

        .progress-bar {
            width: 100%;
            height: 15px;
            background: #f3f4f6;
            border-radius: 8px;
            overflow: hidden;
            margin: 5px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #059669);
            transition: width 0.3s ease;
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

        .catatan {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-left: 4px solid #0ea5e9;
            padding: 12px;
            margin: 15px 0;
            border-radius: 6px;
        }

        .catatan h4 {
            color: #0369a1;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .catatan ul {
            list-style-type: disc;
            padding-left: 15px;
        }

        .catatan li {
            margin-bottom: 4px;
            font-size: 9px;
            color: #0369a1;
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
        <div class="logo">📝</div>
        <h1>PAUD FLAMBOYAN</h1>
        <h2>LAPORAN NILAI ALTERNATIF</h2>
        <p>Status Penilaian Siswa untuk Setiap Kriteria</p>
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

    <!-- Progress Statistik -->
    <div class="statistik">
        <h3>📊 Progress Penilaian</h3>
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['total_siswa'] }}</span>
                <div class="stat-label">Total Siswa</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['penilaian_lengkap'] }}</span>
                <div class="stat-label">Lengkap</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['penilaian_sebagian'] }}</span>
                <div class="stat-label">Sebagian</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $statistik['belum_dinilai'] }}</span>
                <div class="stat-label">Belum</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ number_format($statistik['persentase_lengkap'], 1) }}%</span>
                <div class="stat-label">Progress</div>
            </div>
        </div>

        <!-- Progress Bar Visual -->
        <div style="margin-top: 15px;">
            <div style="display: flex; justify-content: space-between; font-size: 10px; margin-bottom: 5px;">
                <span>Progress Penilaian</span>
                <span>{{ number_format($statistik['persentase_lengkap'], 1) }}% Lengkap</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $statistik['persentase_lengkap'] }}%"></div>
            </div>
        </div>
    </div>

    <!-- Tabel Nilai Per Kriteria -->
    <div class="section">
        <h3>📋 Matriks Nilai Siswa per Kriteria</h3>
        <table>
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%; vertical-align: middle;">No</th>
                    <th rowspan="2" style="width: 20%; vertical-align: middle;">Siswa</th>
                    <th colspan="{{ $kriteria->count() }}" style="background: #dbeafe; color: #1e40af;">Kriteria Penilaian</th>
                    <th rowspan="2" style="width: 12%; vertical-align: middle;">Status</th>
                </tr>
                <tr>
                    @foreach($kriteria as $k)
                        <th style="width: {{ 63 / $kriteria->count() }}%; background: #dbeafe; color: #1e40af;">
                            {{ $k->kode }}<br>
                            <small style="font-size: 7px;">{{ number_format($k->bobot, 2) }}</small>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($alternatif as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="alternatif-col">
                        <strong>{{ $siswa->kode }}</strong><br>
                        <small style="font-size: 8px;">{{ $siswa->nama }}</small>
                    </td>
                    @foreach($kriteria as $k)
                        @php
                            $nilai = $siswa->penilaian->where('kriteria_id', $k->kriteria_id)->first();
                        @endphp
                        <td class="nilai-cell">
                            @if($nilai)
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
                        @if($totalPenilaian == $totalKriteria)
                            <span class="nilai-lengkap">✓ {{ $totalPenilaian }}/{{ $totalKriteria }}</span>
                        @elseif($totalPenilaian > 0)
                            <span class="nilai-sebagian">⚠ {{ $totalPenilaian }}/{{ $totalKriteria }}</span>
                        @else
                            <span class="nilai-kosong">✗ 0/{{ $totalKriteria }}</span>
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
        <h3>📈 Ringkasan Penilaian per Kriteria</h3>
        
        @foreach($kriteria as $k)
        <div style="margin-bottom: 20px; background: #f9fafb; padding: 12px; border-radius: 6px; border-left: 3px solid #a16207;">
            <h4 style="color: #a16207; font-size: 12px; margin-bottom: 8px;">
                {{ $k->kode }} - {{ $k->nama }} (Bobot: {{ number_format($k->bobot, 3) }})
            </h4>
            
            <table style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th style="width: 15%">Nilai</th>
                        <th style="width: 15%">Jumlah</th>
                        <th style="width: 15%">Persentase</th>
                        <th style="width: 55%">Daftar Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    @for($nilai = 4; $nilai >= 1; $nilai--)
                        @php
                            $siswaDengantNilai = $alternatif->filter(function($siswa) use ($k, $nilai) {
                                $penilaian = $siswa->penilaian->where('kriteria_id', $k->kriteria_id)->first();
                                return $penilaian && $penilaian->nilai == $nilai;
                            });
                            $jumlah = $siswa DeangaNilai->count();
                            $persentase = $alternatif->count() > 0 ? ($jumlah / $alternatif->count()) * 100 : 0;
                        @endphp
                        <tr>
                            <td class="nilai-lengkap"><strong>{{ $nilai }}</strong></td>
                            <td>{{ $jumlah }} siswa</td>
                            <td>{{ number_format($persentase, 1) }}%</td>
                            <td class="text-left" style="font-size: 8px;">
                                {{ $siswaDeangaNilai->pluck('nama')->implode(', ') ?: '-' }}
                            </td>
                        </tr>
                    @endfor
                    
                    @php
                        $belumDinilai = $alternatif->filter(function($siswa) use ($k) {
                            return !$siswa->penilaian->where('kriteria_id', $k->kriteria_id)->first();
                        });
                        $jumlahBelum = $belumDinilai->count();
                        $persentaseBelum = $alternatif->count() > 0 ? ($jumlahBelum / $alternatif->count()) * 100 : 0;
                    @endphp
                    @if($jumlahBelum > 0)
                    <tr>
                        <td class="nilai-kosong"><strong>-</strong></td>
                        <td>{{ $jumlahBelum }} siswa</td>
                        <td>{{ number_format($persentaseBelum, 1) }}%</td>
                        <td class="text-left" style="font-size: 8px;">
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
        <h3>⚠️ Daftar Siswa yang Belum Dinilai Lengkap</h3>
        
        @php
            $siswaBelumLengkap = $alternatif->filter(function($siswa) use ($kriteria) {
                return $siswa->penilaian->count() < $kriteria->count();
            });
        @endphp

        @if($siswaBelumLengkap->count() > 0)
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
                @foreach($siswaBelumLengkap as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $siswa->kode }}</strong></td>
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
                    <td class="text-left" style="font-size: 8px;">
                        @php
                            $kriteriaDinilai = $siswa->penilaian->pluck('kriteria_id')->toArray();
                            $kriteriaBelum = $kriteria->whereNotIn('kriteria_id', $kriteriaDinilai)->pluck('kode')->toArray();
                        @endphp
                        {{ implode(', ', $kriteriaBelum) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div style="text-align: center; padding: 20px; background: #dcfce7; border: 1px solid #16a34a; border-radius: 6px;">
            <p style="color: #166534; font-size: 12px; font-weight: bold;">
                ✅ Semua siswa sudah dinilai lengkap untuk semua kriteria!
            </p>
        </div>
        @endif
    </div>

    <!-- Catatan dan Panduan -->
    <div class="catatan">
        <h4>📝 Keterangan Nilai dan Status:</h4>
        <ul>
            <li><strong>Nilai 4:</strong> Berkembang Sangat Baik (BSB) - Anak sudah dapat melakukan kegiatan sesuai indikator tanpa bantuan</li>
            <li><strong>Nilai 3:</strong> Berkembang Sesuai Harapan (BSH) - Anak sudah dapat melakukan kegiatan sesuai indikator dengan sedikit bantuan</li>
            <li><strong>Nilai 2:</strong> Mulai Berkembang (MB) - Anak sudah mulai dapat melakukan kegiatan sesuai indikator dengan bantuan</li>
            <li><strong>Nilai 1:</strong> Belum Berkembang (BB) - Anak belum dapat melakukan kegiatan sesuai indikator</li>
            <li><strong>Status Lengkap:</strong> Siswa sudah dinilai untuk semua kriteria</li>
            <li><strong>Status Sebagian:</strong> Siswa baru dinilai untuk beberapa kriteria saja</li>
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
        
        <div style="text-align: center; margin-top: 20px; font-size: 9px; color: #666;">
            <p>Laporan ini dibuat secara otomatis oleh Sistem Pendukung Keputusan PAUD Flamboyan</p>
        </div>
    </div>
</body>
</html>