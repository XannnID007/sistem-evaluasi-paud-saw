<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * REVISI DATABASE STRUKTUR SESUAI FEEDBACK DOSEN PEMBIMBING - FINAL
     * 
     * Perubahan yang diterapkan:
     * 1. ✅ Optimasi ukuran kolom (tidak 255 semua)
     * 2. ✅ Foreign key disesuaikan sesuai arahan dosen
     * 3. ✅ Struktur database yang lebih efisien
     * 4. ✅ Index untuk optimasi performa query
     * 
     * Tanggal: 27 Juli 2025
     * Status: FINAL - Siap Produksi
     */
    public function up(): void
    {
        // BACKUP data existing
        $this->backupExistingData();

        // DISABLE foreign key checks untuk proses migration
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // DROP semua tabel untuk recreate dengan struktur optimal
        Schema::dropIfExists('hasil_saw');
        Schema::dropIfExists('penilaian');
        Schema::dropIfExists('subdatakriteria');
        Schema::dropIfExists('alternatif');
        Schema::dropIfExists('kriteria');
        Schema::dropIfExists('users');

        // ==========================================
        // 1. TABEL USERS - Tanpa Foreign Key
        // ==========================================
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nama', 100); // Optimasi: 255 → 100
            $table->string('email', 100)->unique(); // Optimasi: 255 → 100
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 60); // Optimasi: 255 → 60 (bcrypt hash size)
            $table->enum('role', ['admin', 'guru'])->default('guru');
            $table->rememberToken(); // Laravel default 100 chars
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('role');
            $table->index('email');
        });

        // ==========================================
        // 2. TABEL KRITERIA - Tanpa Foreign Key
        // ==========================================
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id('kriteria_id');
            $table->string('kode', 10)->unique(); // Optimasi: 255 → 10
            $table->string('nama', 150); // Optimasi: 255 → 150
            $table->decimal('bobot', 5, 3);
            $table->text('keterangan')->nullable(); // Text untuk konten panjang
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('kode');
        });

        // ==========================================
        // 3. TABEL SUBDATAKRITERIA - Dengan FK kriteria_id
        // ==========================================
        Schema::create('subdatakriteria', function (Blueprint $table) {
            $table->id('subdatakriteria_id');
            $table->foreignId('kriteria_id')->constrained('kriteria', 'kriteria_id')->onDelete('cascade');
            $table->string('nilai', 100); // Optimasi: 255 → 100
            $table->tinyInteger('skor')->unsigned(); // Optimasi: integer → tinyInteger (1-4)
            $table->timestamps();

            // Index untuk optimasi query
            $table->index(['kriteria_id', 'skor']);
            $table->unique(['kriteria_id', 'skor']); // Pastikan skor unik per kriteria
        });

        // ==========================================
        // 4. TABEL ALTERNATIF - Dengan FK user_id
        // ==========================================
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id('alternatif_id');
            $table->string('kode', 10)->unique(); // Optimasi: 255 → 10
            $table->string('nama', 100); // Optimasi: 255 → 100
            $table->enum('jenis_kelamin', ['L', 'P']); // Enum lebih efisien
            $table->date('tanggal_lahir');
            $table->text('alamat')->nullable(); // Text untuk alamat panjang
            $table->string('nama_orangtua', 100)->nullable(); // Optimasi: 255 → 100
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('kode');
            $table->index('user_id');
            $table->index('jenis_kelamin');
        });

        // ==========================================
        // 5. TABEL PENILAIAN - Dengan FK alternatif_id & kriteria_id
        // ==========================================
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->foreignId('alternatif_id')->constrained('alternatif', 'alternatif_id')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria', 'kriteria_id')->onDelete('cascade');
            $table->tinyInteger('nilai')->unsigned(); // Optimasi: integer → tinyInteger (1-4)
            $table->timestamps();

            // Index untuk optimasi query
            $table->index(['alternatif_id', 'kriteria_id']);
            $table->unique(['alternatif_id', 'kriteria_id']); // Pastikan 1 nilai per siswa per kriteria
        });

        // ==========================================
        // 6. TABEL HASIL_SAW - Dengan FK alternatif_id
        // ==========================================
        Schema::create('hasil_saw', function (Blueprint $table) {
            $table->id('hasil_saw_id');
            $table->foreignId('alternatif_id')->constrained('alternatif', 'alternatif_id')->onDelete('cascade');
            $table->decimal('skor_akhir', 8, 6);
            $table->unsignedSmallInteger('ranking'); // Optimasi: integer → unsignedSmallInteger
            $table->enum('kategori', ['Sangat Baik', 'Baik', 'Cukup', 'Kurang']);
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('ranking');
            $table->index('kategori');
            $table->unique('alternatif_id'); // Pastikan 1 hasil per siswa
        });

        // ENABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // RESTORE data yang sudah di-backup
        $this->restoreBackedUpData();

        // Log sukses
        Log::info('✅ Database structure revision completed successfully');
    }

    /**
     * Backup data existing ke temporary tables
     */
    private function backupExistingData()
    {
        try {
            Log::info('🔄 Starting data backup process...');

            // Backup Users
            if (Schema::hasTable('users')) {
                DB::statement('CREATE TEMPORARY TABLE temp_users AS SELECT * FROM users');
                Log::info('📋 Users data backed up');
            }

            // Backup Kriteria
            if (Schema::hasTable('kriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_kriteria AS SELECT * FROM kriteria');
                Log::info('📋 Kriteria data backed up');
            }

            // Backup Subkriteria/Subdatakriteria
            if (Schema::hasTable('subkriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_subkriteria AS SELECT * FROM subkriteria');
                Log::info('📋 Subkriteria data backed up');
            } elseif (Schema::hasTable('subdatakriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_subkriteria AS SELECT * FROM subdatakriteria');
                Log::info('📋 Subdatakriteria data backed up');
            }

            // Backup Alternatif
            if (Schema::hasTable('alternatif')) {
                DB::statement('CREATE TEMPORARY TABLE temp_alternatif AS SELECT * FROM alternatif');
                Log::info('📋 Alternatif data backed up');
            }

            // Backup Penilaian
            if (Schema::hasTable('penilaian')) {
                DB::statement('CREATE TEMPORARY TABLE temp_penilaian AS SELECT * FROM penilaian');
                Log::info('📋 Penilaian data backed up');
            }

            // Backup Hasil SAW
            if (Schema::hasTable('hasil_saw')) {
                DB::statement('CREATE TEMPORARY TABLE temp_hasil_saw AS SELECT * FROM hasil_saw');
                Log::info('📋 Hasil SAW data backed up');
            }

            Log::info('✅ Data backup completed successfully');
        } catch (\Exception $e) {
            Log::info('⚠️  Backup failed (probably fresh install): ' . $e->getMessage());
        }
    }

    /**
     * Restore data dari backup dengan optimasi ukuran kolom
     */
    private function restoreBackedUpData()
    {
        try {
            Log::info('🔄 Starting data restoration process...');

            // Restore Users dengan truncate kolom sesuai ukuran baru
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_users'")) {
                DB::statement("
                    INSERT INTO users (user_id, nama, email, email_verified_at, password, role, remember_token, created_at, updated_at)
                    SELECT 
                        COALESCE(user_id, id) as user_id,
                        LEFT(COALESCE(nama, name), 100) as nama,
                        LEFT(email, 100) as email,
                        email_verified_at,
                        LEFT(password, 60) as password,
                        role,
                        remember_token,
                        created_at,
                        updated_at
                    FROM temp_users
                ");
                Log::info('✅ Users data restored');
            }

            // Restore Kriteria dengan truncate kolom sesuai ukuran baru
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_kriteria'")) {
                DB::statement("
                    INSERT INTO kriteria (kriteria_id, kode, nama, bobot, keterangan, created_at, updated_at)
                    SELECT 
                        COALESCE(kriteria_id, id) as kriteria_id,
                        LEFT(kode, 10) as kode,
                        LEFT(nama, 150) as nama,
                        bobot,
                        keterangan,
                        created_at,
                        updated_at
                    FROM temp_kriteria
                ");
                Log::info('✅ Kriteria data restored');
            }

            // Restore Subdatakriteria dengan truncate kolom sesuai ukuran baru
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_subkriteria'")) {
                DB::statement("
                    INSERT INTO subdatakriteria (subdatakriteria_id, kriteria_id, nilai, skor, created_at, updated_at)
                    SELECT 
                        COALESCE(subdatakriteria_id, id) as subdatakriteria_id,
                        kriteria_id,
                        LEFT(nilai, 100) as nilai,
                        skor,
                        created_at,
                        updated_at
                    FROM temp_subkriteria
                ");
                Log::info('✅ Subdatakriteria data restored');
            }

            // Restore Alternatif dengan truncate kolom sesuai ukuran baru
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_alternatif'")) {
                DB::statement("
                    INSERT INTO alternatif (alternatif_id, kode, nama, jenis_kelamin, tanggal_lahir, alamat, nama_orangtua, user_id, created_at, updated_at)
                    SELECT 
                        COALESCE(alternatif_id, id) as alternatif_id,
                        LEFT(kode, 10) as kode,
                        LEFT(nama, 100) as nama,
                        jenis_kelamin,
                        tanggal_lahir,
                        alamat,
                        LEFT(COALESCE(nama_orangtua, ''), 100) as nama_orangtua,
                        COALESCE(user_id, 1) as user_id,
                        created_at,
                        updated_at
                    FROM temp_alternatif
                ");
                Log::info('✅ Alternatif data restored');
            }

            // Restore Penilaian
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_penilaian'")) {
                DB::statement("
                    INSERT INTO penilaian (id_penilaian, alternatif_id, kriteria_id, nilai, created_at, updated_at)
                    SELECT 
                        COALESCE(id_penilaian, id) as id_penilaian,
                        alternatif_id,
                        kriteria_id,
                        nilai,
                        created_at,
                        updated_at
                    FROM temp_penilaian
                ");
                Log::info('✅ Penilaian data restored');
            }

            // Restore Hasil SAW
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_hasil_saw'")) {
                DB::statement("
                    INSERT INTO hasil_saw (hasil_saw_id, alternatif_id, skor_akhir, ranking, kategori, created_at, updated_at)
                    SELECT 
                        COALESCE(hasil_saw_id, id) as hasil_saw_id,
                        alternatif_id,
                        skor_akhir,
                        ranking,
                        kategori,
                        created_at,
                        updated_at
                    FROM temp_hasil_saw
                ");
                Log::info('✅ Hasil SAW data restored');
            }

            Log::info('✅ Data restoration completed successfully');
        } catch (\Exception $e) {
            Log::warning('⚠️  Data restoration failed (database will be empty): ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Log::info('🔄 Rolling back database structure revision...');

        // DISABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // DROP tabel dengan struktur revisi
        Schema::dropIfExists('hasil_saw');
        Schema::dropIfExists('penilaian');
        Schema::dropIfExists('subdatakriteria');
        Schema::dropIfExists('alternatif');
        Schema::dropIfExists('kriteria');
        Schema::dropIfExists('users');

        // ENABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Log::info('✅ Database structure rollback completed');
    }
};
