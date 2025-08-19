<?php

// database/seeders/DatabaseSeeder.php - REVISI sesuai struktur database baru
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Alternatif;
use App\Models\Penilaian;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables dengan struktur baru
        User::truncate();
        Kriteria::truncate();
        Subkriteria::truncate();
        Alternatif::truncate();
        Penilaian::truncate();
        DB::table('hasil_saw')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Create Users
        $this->createUsers();

        // 2. Create Kriteria
        $this->createKriteria();

        // 3. Create Subkriteria
        $this->createSubkriteria();

        // 4. Create Alternatif (Siswa)
        $this->createAlternatif();

        // 5. Create Penilaian
        $this->createPenilaian();

        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('📋 REVISI STRUKTUR DATABASE:');
        $this->command->info('   • kode → kode_kriteria (tabel kriteria)');
        $this->command->info('   • kode → kode_alternatif (tabel alternatif)');
        $this->command->info('   • bigInt → int untuk semua ID');
        $this->command->info('👤 Admin: admin@paud.com / admin123');
        $this->command->info('👨‍🏫 Guru: guru@paud.com / guru123');
        $this->command->info('📊 Data lengkap: 6 kriteria, 17 siswa, semua penilaian');
    }

    private function createUsers()
    {
        $users = [
            [
                'nama' => 'Administrator',
                'email' => 'admin@paud.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ],
            [
                'nama' => 'Guru PAUD Flamboyan',
                'email' => 'guru@paud.com',
                'password' => Hash::make('guru123'),
                'role' => 'guru'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $this->command->info('👤 Users created: 2 users (1 admin, 1 guru)');
    }

    private function createKriteria()
    {
        // ✅ REVISI: Menggunakan kolom kode_kriteria
        $kriteriaData = [
            ['kode_kriteria' => 'C1', 'nama' => 'Nilai-nilai Agama dan Moral', 'bobot' => 0.22, 'keterangan' => 'Aspek pengembangan nilai-nilai agama dan moral anak'],
            ['kode_kriteria' => 'C2', 'nama' => 'Fisik Motorik', 'bobot' => 0.16, 'keterangan' => 'Aspek pengembangan fisik motorik kasar dan halus'],
            ['kode_kriteria' => 'C3', 'nama' => 'Kognitif', 'bobot' => 0.17, 'keterangan' => 'Aspek pengembangan kognitif dan daya pikir anak'],
            ['kode_kriteria' => 'C4', 'nama' => 'Bahasa', 'bobot' => 0.14, 'keterangan' => 'Aspek pengembangan kemampuan bahasa dan komunikasi'],
            ['kode_kriteria' => 'C5', 'nama' => 'Sosial Emosional', 'bobot' => 0.20, 'keterangan' => 'Aspek pengembangan sosial emosional anak'],
            ['kode_kriteria' => 'C6', 'nama' => 'Seni', 'bobot' => 0.11, 'keterangan' => 'Aspek pengembangan seni dan kreativitas anak']
        ];

        foreach ($kriteriaData as $data) {
            Kriteria::create($data);
        }

        $this->command->info('📋 Kriteria created: 6 kriteria dengan kolom kode_kriteria, total bobot = 1.00');
    }

    private function createSubkriteria()
    {
        $subkriteriaData = [
            'C1' => [
                ['nilai' => 'Perlu Perhatian', 'skor' => 1],
                ['nilai' => 'Cukup', 'skor' => 2],
                ['nilai' => 'Baik', 'skor' => 3],
                ['nilai' => 'Sangat Baik', 'skor' => 4]
            ],
            'C2' => [
                ['nilai' => 'Kurang Aktif', 'skor' => 1],
                ['nilai' => 'Cukup Aktif', 'skor' => 2],
                ['nilai' => 'Aktif', 'skor' => 3],
                ['nilai' => 'Sangat Aktif', 'skor' => 4]
            ],
            'C3' => [
                ['nilai' => 'Perlu Pendampingan', 'skor' => 1],
                ['nilai' => 'Mulai Memahami', 'skor' => 2],
                ['nilai' => 'Cepat Memahami', 'skor' => 3],
                ['nilai' => 'Sangat Memahami', 'skor' => 4]
            ],
            'C4' => [
                ['nilai' => 'Tidak Responsif', 'skor' => 1],
                ['nilai' => 'Kurang Komunikatif', 'skor' => 2],
                ['nilai' => 'Cukup Komunikatif', 'skor' => 3],
                ['nilai' => 'Komunikatif', 'skor' => 4]
            ],
            'C5' => [
                ['nilai' => 'Sangat Stabil Emosinya', 'skor' => 1],
                ['nilai' => 'Terkontrol', 'skor' => 2],
                ['nilai' => 'Mudah Tersinggung', 'skor' => 3],
                ['nilai' => 'Sangat Mudah Tersinggung', 'skor' => 4]
            ],
            'C6' => [
                ['nilai' => 'Kurang Minat', 'skor' => 1],
                ['nilai' => 'Mulai Menunjukkan Minat', 'skor' => 2],
                ['nilai' => 'Kreatif', 'skor' => 3],
                ['nilai' => 'Sangat Kreatif', 'skor' => 4]
            ]
        ];

        // ✅ REVISI: Menggunakan kolom kode_kriteria untuk pencarian
        foreach ($subkriteriaData as $kodeKriteria => $subs) {
            $kriteria = Kriteria::where('kode_kriteria', $kodeKriteria)->first();
            foreach ($subs as $sub) {
                Subkriteria::create([
                    'kriteria_id' => $kriteria->kriteria_id,
                    'nilai' => $sub['nilai'],
                    'skor' => $sub['skor']
                ]);
            }
        }

        $this->command->info('🏷️  Subkriteria created: 24 subkriteria (4 per kriteria)');
    }

    private function createAlternatif()
    {
        // Ambil user_id untuk admin
        $adminUser = User::where('email', 'admin@paud.com')->first();

        // ✅ REVISI: Menggunakan kolom kode_alternatif
        $siswaData = [
            ['kode_alternatif' => 'A1', 'nama' => 'Adiba Shakilla Utama', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-03-15', 'nama_orangtua' => 'Budi Santoso', 'alamat' => 'Jl. Melati No. 12, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A2', 'nama' => 'Aldi Sandika Nugraha', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2019-05-20', 'nama_orangtua' => 'Ahmad Rizki', 'alamat' => 'Jl. Mawar No. 8, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A3', 'nama' => 'Aldo Sandika Nugraha', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2019-02-10', 'nama_orangtua' => 'Sandi Permana', 'alamat' => 'Jl. Anggrek No. 15, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A4', 'nama' => 'Kelvin Septia Ramadan', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2019-07-08', 'nama_orangtua' => 'Dedi Kurnia', 'alamat' => 'Jl. Dahlia No. 3, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A5', 'nama' => 'Marwah Maulidan Nur Afifah', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-01-25', 'nama_orangtua' => 'Hendra Wijaya', 'alamat' => 'Jl. Tulip No. 22, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A6', 'nama' => 'Putri Ramadhani', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-04-12', 'nama_orangtua' => 'Eko Prasetyo', 'alamat' => 'Jl. Kenanga No. 7, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A7', 'nama' => 'Syahnaz Rahma Fitriyah', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-06-30', 'nama_orangtua' => 'Agus Setiawan', 'alamat' => 'Jl. Cempaka No. 18, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A8', 'nama' => 'Shafira', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-09-14', 'nama_orangtua' => 'Rahman Hakim', 'alamat' => 'Jl. Flamboyan No. 9, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A9', 'nama' => 'Yusna Nazwa Putri', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-11-05', 'nama_orangtua' => 'Surya Pratama', 'alamat' => 'Jl. Kamboja No. 14, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A10', 'nama' => 'Arsyila Syafia Putri', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-08-22', 'nama_orangtua' => 'Bayu Adi', 'alamat' => 'Jl. Seroja No. 5, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A11', 'nama' => 'Abizar', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2019-12-18', 'nama_orangtua' => 'Dewi Sartika', 'alamat' => 'Jl. Teratai No. 11, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A12', 'nama' => 'Anugrah Lasmana Putra', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2019-10-03', 'nama_orangtua' => 'Kurnia Putra', 'alamat' => 'Jl. Bougenvil No. 20, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A13', 'nama' => 'Dila Aprilia Lusyana', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-05-16', 'nama_orangtua' => 'Sari Indah', 'alamat' => 'Jl. Lavender No. 6, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A14', 'nama' => 'Putra Hasan Ruhiyat', 'jenis_kelamin' => 'L', 'tanggal_lahir' => '2019-03-28', 'nama_orangtua' => 'Hidayat Nur', 'alamat' => 'Jl. Sakura No. 13, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A15', 'nama' => 'Shakayla', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-07-11', 'nama_orangtua' => 'Permata Sari', 'alamat' => 'Jl. Gardenia No. 17, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A16', 'nama' => 'Shinidi', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-04-07', 'nama_orangtua' => 'Safitri Indah', 'alamat' => 'Jl. Azalea No. 4, Jakarta', 'user_id' => $adminUser->user_id],
            ['kode_alternatif' => 'A17', 'nama' => 'Rasyifa', 'jenis_kelamin' => 'P', 'tanggal_lahir' => '2019-01-13', 'nama_orangtua' => 'Maulana Ishak', 'alamat' => 'Jl. Edelweis No. 10, Jakarta', 'user_id' => $adminUser->user_id]
        ];

        foreach ($siswaData as $siswa) {
            Alternatif::create($siswa);
        }

        $this->command->info('👶 Alternatif created: 17 siswa dengan kolom kode_alternatif (9 perempuan, 8 laki-laki)');
    }

    private function createPenilaian()
    {
        // ✅ REVISI: Data penilaian menggunakan kode_kriteria dan kode_alternatif
        $penilaianData = [
            'A1' => ['C1' => 1, 'C2' => 2, 'C3' => 3, 'C4' => 3, 'C5' => 4, 'C6' => 2],
            'A2' => ['C1' => 4, 'C2' => 1, 'C3' => 3, 'C4' => 3, 'C5' => 1, 'C6' => 2],
            'A3' => ['C1' => 1, 'C2' => 2, 'C3' => 4, 'C4' => 2, 'C5' => 4, 'C6' => 2],
            'A4' => ['C1' => 2, 'C2' => 2, 'C3' => 2, 'C4' => 2, 'C5' => 1, 'C6' => 2],
            'A5' => ['C1' => 2, 'C2' => 3, 'C3' => 2, 'C4' => 2, 'C5' => 2, 'C6' => 3],
            'A6' => ['C1' => 3, 'C2' => 3, 'C3' => 3, 'C4' => 3, 'C5' => 2, 'C6' => 4],
            'A7' => ['C1' => 2, 'C2' => 2, 'C3' => 3, 'C4' => 2, 'C5' => 1, 'C6' => 2],
            'A8' => ['C1' => 2, 'C2' => 2, 'C3' => 2, 'C4' => 3, 'C5' => 1, 'C6' => 3],
            'A9' => ['C1' => 1, 'C2' => 2, 'C3' => 2, 'C4' => 4, 'C5' => 4, 'C6' => 2],
            'A10' => ['C1' => 2, 'C2' => 3, 'C3' => 3, 'C4' => 3, 'C5' => 1, 'C6' => 2],
            'A11' => ['C1' => 1, 'C2' => 1, 'C3' => 4, 'C4' => 3, 'C5' => 4, 'C6' => 2],
            'A12' => ['C1' => 1, 'C2' => 1, 'C3' => 3, 'C4' => 3, 'C5' => 4, 'C6' => 4],
            'A13' => ['C1' => 1, 'C2' => 4, 'C3' => 1, 'C4' => 4, 'C5' => 3, 'C6' => 2],
            'A14' => ['C1' => 4, 'C2' => 4, 'C3' => 4, 'C4' => 4, 'C5' => 4, 'C6' => 4],
            'A15' => ['C1' => 3, 'C2' => 3, 'C3' => 3, 'C4' => 4, 'C5' => 1, 'C6' => 3],
            'A16' => ['C1' => 4, 'C2' => 4, 'C3' => 3, 'C4' => 3, 'C5' => 4, 'C6' => 2],
            'A17' => ['C1' => 4, 'C2' => 3, 'C3' => 4, 'C4' => 4, 'C5' => 4, 'C6' => 3]
        ];

        $totalPenilaian = 0;

        foreach ($penilaianData as $kodeAlternatif => $nilaiKriteria) {
            // ✅ REVISI: Menggunakan kode_alternatif untuk pencarian
            $alternatif = Alternatif::where('kode_alternatif', $kodeAlternatif)->first();

            if ($alternatif) {
                foreach ($nilaiKriteria as $kodeKriteria => $nilai) {
                    // ✅ REVISI: Menggunakan kode_kriteria untuk pencarian
                    $kriteria = Kriteria::where('kode_kriteria', $kodeKriteria)->first();

                    if ($kriteria) {
                        Penilaian::create([
                            'alternatif_id' => $alternatif->alternatif_id,
                            'kriteria_id' => $kriteria->kriteria_id,
                            'nilai' => $nilai
                        ]);
                        $totalPenilaian++;
                    }
                }
            }
        }

        $this->command->info("📊 Penilaian created: {$totalPenilaian} penilaian (17 siswa × 6 kriteria)");

        // Statistik penilaian
        $this->command->info('📈 Statistik Penilaian:');
        $kriteria = Kriteria::all();
        foreach ($kriteria as $k) {
            $avg = Penilaian::where('kriteria_id', $k->kriteria_id)->avg('nilai');
            $this->command->info("   {$k->kode_kriteria} (bobot: {$k->bobot}): rata-rata " . number_format($avg, 2));
        }

        $this->command->info('');
        $this->command->info('✅ DATABASE SEEDER TELAH DIREVISI!');
        $this->command->info('🎯 STRUKTUR DATABASE BARU:');
        $this->command->info('   • Kolom kode → kode_kriteria (tabel kriteria)');
        $this->command->info('   • Kolom kode → kode_alternatif (tabel alternatif)');
        $this->command->info('   • Tipe data bigInt → int untuk semua ID');
        $this->command->info('   • Optimasi untuk data yang sedikit sesuai feedback dosen');
        $this->command->info('📋 17 siswa dengan 6 kriteria penilaian lengkap');
    }
}
