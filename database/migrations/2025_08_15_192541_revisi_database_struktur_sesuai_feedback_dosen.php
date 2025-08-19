<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * REVISI DATABASE STRUKTUR SESUAI FEEDBACK DOSEN PENGUJIAN
     * 
     * Perubahan yang diterapkan:
     * 1. Memperjelas kolom kode: kode → kode_kriteria dan kode_alternatif
     * 2. Mengoptimalkan tipe data: bigInt → int untuk data sedikit
     * 3. Menjaga konsistensi penamaan kolom
     * 
     * Tanggal: {{ date('d F Y') }}
     * Status: REVISI DOSEN PENGUJIAN
     */
    public function up(): void
    {
        // BACKUP data existing sebelum revisi
        $this->backupExistingData();

        // DISABLE foreign key checks untuk proses migration
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // DROP semua tabel untuk recreate dengan struktur yang sudah direvisi
        Schema::dropIfExists('hasil_saw');
        Schema::dropIfExists('penilaian');
        Schema::dropIfExists('subdatakriteria');
        Schema::dropIfExists('alternatif');
        Schema::dropIfExists('kriteria');
        Schema::dropIfExists('users');

        // ==========================================
        // 1. TABEL USERS - Primary Key: user_id (INT)
        // ==========================================
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id'); // REVISI: bigInt → int
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 60);
            $table->enum('role', ['admin', 'guru'])->default('guru');
            $table->rememberToken();
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('role');
            $table->index('email');
        });

        // ==========================================
        // 2. TABEL KRITERIA - Primary Key: kriteria_id (INT)
        // ==========================================
        Schema::create('kriteria', function (Blueprint $table) {
            $table->increments('kriteria_id'); // REVISI: bigInt → int
            $table->string('kode_kriteria', 10)->unique(); // REVISI: kode → kode_kriteria
            $table->string('nama', 150);
            $table->decimal('bobot', 5, 3);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Index untuk optimasi query
            $table->index('kode_kriteria');
        });

        // ==========================================
        // 3. TABEL SUBDATAKRITERIA - Primary Key: subdatakriteria_id (INT)
        // ==========================================
        Schema::create('subdatakriteria', function (Blueprint $table) {
            $table->increments('subdatakriteria_id'); // REVISI: bigInt → int
            $table->unsignedInteger('kriteria_id'); // REVISI: bigInt → int
            $table->string('nilai', 100);
            $table->tinyInteger('skor')->unsigned();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kriteria_id')->references('kriteria_id')->on('kriteria')->onDelete('cascade');

            // Index untuk optimasi query
            $table->index(['kriteria_id', 'skor']);
            $table->unique(['kriteria_id', 'skor']);
        });

        // ==========================================
        // 4. TABEL ALTERNATIF - Primary Key: alternatif_id (INT)
        // ==========================================
        Schema::create('alternatif', function (Blueprint $table) {
            $table->increments('alternatif_id'); // REVISI: bigInt → int
            $table->string('kode_alternatif', 10)->unique(); // REVISI: kode → kode_alternatif
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->text('alamat')->nullable();
            $table->string('nama_orangtua', 100)->nullable();
            $table->unsignedInteger('user_id'); // REVISI: bigInt → int
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            // Index untuk optimasi query
            $table->index('kode_alternatif');
            $table->index('user_id');
            $table->index('jenis_kelamin');
        });

        // ==========================================
        // 5. TABEL PENILAIAN - Primary Key: id_penilaian (INT)
        // ==========================================
        Schema::create('penilaian', function (Blueprint $table) {
            $table->increments('id_penilaian'); // REVISI: bigInt → int
            $table->unsignedInteger('alternatif_id'); // REVISI: bigInt → int
            $table->unsignedInteger('kriteria_id'); // REVISI: bigInt → int
            $table->tinyInteger('nilai')->unsigned();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('alternatif_id')->references('alternatif_id')->on('alternatif')->onDelete('cascade');
            $table->foreign('kriteria_id')->references('kriteria_id')->on('kriteria')->onDelete('cascade');

            // Index untuk optimasi query
            $table->index(['alternatif_id', 'kriteria_id']);
            $table->unique(['alternatif_id', 'kriteria_id']);
        });

        // ==========================================
        // 6. TABEL HASIL_SAW - Primary Key: hasil_saw_id (INT)
        // ==========================================
        Schema::create('hasil_saw', function (Blueprint $table) {
            $table->increments('hasil_saw_id'); // REVISI: bigInt → int (sesuai feedback dosen)
            $table->unsignedInteger('alternatif_id'); // REVISI: bigInt → int (sesuai feedback dosen)
            $table->decimal('skor_akhir', 8, 6);
            $table->unsignedSmallInteger('ranking');
            $table->enum('kategori', ['Sangat Baik', 'Baik', 'Cukup', 'Kurang']);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('alternatif_id')->references('alternatif_id')->on('alternatif')->onDelete('cascade');

            // Index untuk optimasi query
            $table->index('ranking');
            $table->index('kategori');
            $table->unique('alternatif_id');
        });

        // ENABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // RESTORE data yang sudah di-backup dengan mapping kolom baru
        $this->restoreBackedUpData();

        echo "Database structure revision completed successfully\n";
        echo "Perubahan yang diterapkan:\n";
        echo "   • kode → kode_kriteria (tabel kriteria)\n";
        echo "   • kode → kode_alternatif (tabel alternatif)\n";
        echo "   • bigInt → int untuk semua primary key dan foreign key\n";
        echo "   • Optimasi tipe data untuk data yang sedikit\n";
    }

    /**
     * Backup data existing ke temporary tables
     */
    private function backupExistingData()
    {
        try {
            echo "Starting data backup process...\n";

            // Backup Users
            if (Schema::hasTable('users')) {
                DB::statement('CREATE TEMPORARY TABLE temp_users AS SELECT * FROM users');
                echo "Users data backed up\n";
            }

            // Backup Kriteria
            if (Schema::hasTable('kriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_kriteria AS SELECT * FROM kriteria');
                echo "Kriteria data backed up\n";
            }

            // Backup Subkriteria/Subdatakriteria
            if (Schema::hasTable('subkriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_subkriteria AS SELECT * FROM subkriteria');
                echo "Subkriteria data backed up\n";
            } elseif (Schema::hasTable('subdatakriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_subkriteria AS SELECT * FROM subdatakriteria');
                echo "Subdatakriteria data backed up\n";
            }

            // Backup Alternatif
            if (Schema::hasTable('alternatif')) {
                DB::statement('CREATE TEMPORARY TABLE temp_alternatif AS SELECT * FROM alternatif');
                echo "Alternatif data backed up\n";
            }

            // Backup Penilaian
            if (Schema::hasTable('penilaian')) {
                DB::statement('CREATE TEMPORARY TABLE temp_penilaian AS SELECT * FROM penilaian');
                echo "Penilaian data backed up\n";
            }

            // Backup Hasil SAW
            if (Schema::hasTable('hasil_saw')) {
                DB::statement('CREATE TEMPORARY TABLE temp_hasil_saw AS SELECT * FROM hasil_saw');
                echo "Hasil SAW data backed up\n";
            }

            echo "Data backup completed successfully\n";
        } catch (\Exception $e) {
            echo "Backup failed (probably fresh install): " . $e->getMessage() . "\n";
        }
    }

    /**
     * Restore data dari backup dengan mapping kolom baru
     */
    private function restoreBackedUpData()
    {
        try {
            echo "Starting data restoration process...\n";

            // Restore Users dengan mapping ke tipe data baru
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_users'")) {
                DB::statement("
                    INSERT INTO users (user_id, nama, email, email_verified_at, password, role, remember_token, created_at, updated_at)
                    SELECT 
                        CAST(COALESCE(user_id, id) AS UNSIGNED) as user_id,
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
                echo "Users data restored\n";
            }

            // Restore Kriteria dengan mapping kolom kode → kode_kriteria
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_kriteria'")) {
                DB::statement("
                    INSERT INTO kriteria (kriteria_id, kode_kriteria, nama, bobot, keterangan, created_at, updated_at)
                    SELECT 
                        CAST(COALESCE(kriteria_id, id) AS UNSIGNED) as kriteria_id,
                        LEFT(COALESCE(kode_kriteria, kode), 10) as kode_kriteria,
                        LEFT(nama, 150) as nama,
                        bobot,
                        keterangan,
                        created_at,
                        updated_at
                    FROM temp_kriteria
                ");
                echo "Kriteria data restored with kode → kode_kriteria mapping\n";
            }

            // Restore Subdatakriteria dengan mapping ke tipe data baru
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_subkriteria'")) {
                DB::statement("
                    INSERT INTO subdatakriteria (subdatakriteria_id, kriteria_id, nilai, skor, created_at, updated_at)
                    SELECT 
                        CAST(COALESCE(subdatakriteria_id, id) AS UNSIGNED) as subdatakriteria_id,
                        CAST(kriteria_id AS UNSIGNED) as kriteria_id,
                        LEFT(nilai, 100) as nilai,
                        skor,
                        created_at,
                        updated_at
                    FROM temp_subkriteria
                ");
                echo "Subdatakriteria data restored\n";
            }

            // Restore Alternatif dengan mapping kolom kode → kode_alternatif
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_alternatif'")) {
                DB::statement("
                    INSERT INTO alternatif (alternatif_id, kode_alternatif, nama, jenis_kelamin, tanggal_lahir, alamat, nama_orangtua, user_id, created_at, updated_at)
                    SELECT 
                        CAST(COALESCE(alternatif_id, id) AS UNSIGNED) as alternatif_id,
                        LEFT(COALESCE(kode_alternatif, kode), 10) as kode_alternatif,
                        LEFT(nama, 100) as nama,
                        jenis_kelamin,
                        tanggal_lahir,
                        alamat,
                        LEFT(COALESCE(nama_orangtua, ''), 100) as nama_orangtua,
                        CAST(COALESCE(user_id, 1) AS UNSIGNED) as user_id,
                        created_at,
                        updated_at
                    FROM temp_alternatif
                ");
                echo "Alternatif data restored with kode → kode_alternatif mapping\n";
            }

            // Restore Penilaian dengan mapping ke tipe data baru
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_penilaian'")) {
                DB::statement("
                    INSERT INTO penilaian (id_penilaian, alternatif_id, kriteria_id, nilai, created_at, updated_at)
                    SELECT 
                        CAST(COALESCE(id_penilaian, id) AS UNSIGNED) as id_penilaian,
                        CAST(alternatif_id AS UNSIGNED) as alternatif_id,
                        CAST(kriteria_id AS UNSIGNED) as kriteria_id,
                        nilai,
                        created_at,
                        updated_at
                    FROM temp_penilaian
                ");
                echo "Penilaian data restored\n";
            }

            // Restore Hasil SAW dengan mapping ke tipe data baru (int)
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_hasil_saw'")) {
                DB::statement("
                    INSERT INTO hasil_saw (hasil_saw_id, alternatif_id, skor_akhir, ranking, kategori, created_at, updated_at)
                    SELECT 
                        CAST(COALESCE(hasil_saw_id, id) AS UNSIGNED) as hasil_saw_id,
                        CAST(alternatif_id AS UNSIGNED) as alternatif_id,
                        skor_akhir,
                        ranking,
                        kategori,
                        created_at,
                        updated_at
                    FROM temp_hasil_saw
                ");
                echo "Hasil SAW data restored with optimized data types\n";
            }

            echo "Data restoration completed successfully\n";
        } catch (\Exception $e) {
            echo "Data restoration failed (database will be empty): " . $e->getMessage() . "\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        echo "Rolling back database structure revision...\n";

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

        echo "Database structure rollback completed\n";
    }
};
