<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * REVISI LENGKAP SESUAI FEEDBACK DOSEN PEMBIMBING
     * 
     * Strategi: Drop dan Recreate tabel untuk menghindari constraint error
     */
    public function up(): void
    {
        // BACKUP data yang ada terlebih dahulu
        $this->backupExistingData();

        // DISABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // DROP semua tabel yang akan direvisi (urutan penting!)
        Schema::dropIfExists('hasil_saw');
        Schema::dropIfExists('penilaian');
        Schema::dropIfExists('subkriteria'); // Nama lama
        Schema::dropIfExists('subdatakriteria'); // Nama baru jika sudah ada
        Schema::dropIfExists('alternatif');
        Schema::dropIfExists('kriteria');
        Schema::dropIfExists('users');

        // RECREATE tabel dengan struktur baru sesuai revisi dosen

        // 1. TABEL USERS (sesuai revisi)
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // Revisi: id → user_id
            $table->string('nama'); // Revisi: name → nama
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'guru'])->default('guru');
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. TABEL KRITERIA (sesuai revisi)
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id('kriteria_id'); // Revisi: id → kriteria_id
            $table->string('kode')->unique();
            $table->string('nama');
            $table->decimal('bobot', 5, 3);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 3. TABEL SUBDATAKRITERIA (sesuai revisi: subkriteria → subdatakriteria)
        Schema::create('subdatakriteria', function (Blueprint $table) {
            $table->id('subdatakriteria_id'); // Revisi: id → subdatakriteria_id
            $table->foreignId('kriteria_id')->constrained('kriteria', 'kriteria_id')->onDelete('cascade');
            $table->string('nilai');
            $table->integer('skor');
            $table->timestamps();
        });

        // 4. TABEL ALTERNATIF (sesuai revisi)
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id('alternatif_id'); // Revisi: id → alternatif_id
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat')->nullable();
            $table->string('nama_orangtua')->nullable();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade'); // Revisi: tambah user_id
            $table->timestamps();
        });

        // 5. TABEL PENILAIAN (sesuai revisi)
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id_penilaian'); // Revisi: id → id_penilaian
            $table->foreignId('alternatif_id')->constrained('alternatif', 'alternatif_id')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria', 'kriteria_id')->onDelete('cascade');
            $table->integer('nilai');
            $table->timestamps();
        });

        // 6. TABEL HASIL_SAW (sesuai revisi)
        Schema::create('hasil_saw', function (Blueprint $table) {
            $table->id('hasil_saw_id'); // Revisi: id → hasil_saw_id
            $table->foreignId('alternatif_id')->constrained('alternatif', 'alternatif_id')->onDelete('cascade');
            $table->decimal('skor_akhir', 8, 6);
            $table->integer('ranking');
            $table->enum('kategori', ['Sangat Baik', 'Baik', 'Cukup', 'Kurang']); // Revisi: perbaiki enum
            $table->timestamps();
        });

        // ENABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // RESTORE data yang sudah di-backup
        $this->restoreBackedUpData();
    }

    /**
     * Backup data existing sebelum drop table
     */
    private function backupExistingData()
    {
        try {
            // Backup ke temporary tables
            DB::statement('CREATE TEMPORARY TABLE temp_users AS SELECT * FROM users');
            DB::statement('CREATE TEMPORARY TABLE temp_kriteria AS SELECT * FROM kriteria');

            // Cek apakah tabel subkriteria atau subdatakriteria yang ada
            if (Schema::hasTable('subkriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_subkriteria AS SELECT * FROM subkriteria');
            } elseif (Schema::hasTable('subdatakriteria')) {
                DB::statement('CREATE TEMPORARY TABLE temp_subkriteria AS SELECT * FROM subdatakriteria');
            }

            DB::statement('CREATE TEMPORARY TABLE temp_alternatif AS SELECT * FROM alternatif');

            if (Schema::hasTable('penilaian')) {
                DB::statement('CREATE TEMPORARY TABLE temp_penilaian AS SELECT * FROM penilaian');
            }

            if (Schema::hasTable('hasil_saw')) {
                DB::statement('CREATE TEMPORARY TABLE temp_hasil_saw AS SELECT * FROM hasil_saw');
            }
        } catch (\Exception $e) {
            // Jika backup gagal, lanjutkan saja (fresh install)
        }
    }

    /**
     * Restore data yang sudah di-backup
     */
    private function restoreBackedUpData()
    {
        try {
            // Restore users dengan mapping kolom
            DB::statement("
                INSERT INTO users (user_id, nama, email, email_verified_at, password, role, remember_token, created_at, updated_at)
                SELECT id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at 
                FROM temp_users
            ");

            // Restore kriteria dengan mapping kolom
            DB::statement("
                INSERT INTO kriteria (kriteria_id, kode, nama, bobot, keterangan, created_at, updated_at)
                SELECT id, kode, nama, bobot, keterangan, created_at, updated_at 
                FROM temp_kriteria
            ");

            // Restore subkriteria dengan mapping kolom
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_subkriteria'")) {
                DB::statement("
                    INSERT INTO subdatakriteria (subdatakriteria_id, kriteria_id, nilai, skor, created_at, updated_at)
                    SELECT id, kriteria_id, nilai, skor, created_at, updated_at 
                    FROM temp_subkriteria
                ");
            }

            // Restore alternatif dengan mapping kolom + default user_id
            DB::statement("
                INSERT INTO alternatif (alternatif_id, kode, nama, jenis_kelamin, tanggal_lahir, alamat, nama_orangtua, user_id, created_at, updated_at)
                SELECT id, kode, nama, jenis_kelamin, tanggal_lahir, alamat, nama_orangtua, 1, created_at, updated_at 
                FROM temp_alternatif
            ");

            // Restore penilaian dengan mapping kolom
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_penilaian'")) {
                DB::statement("
                    INSERT INTO penilaian (id_penilaian, alternatif_id, kriteria_id, nilai, created_at, updated_at)
                    SELECT id, alternatif_id, kriteria_id, nilai, created_at, updated_at 
                    FROM temp_penilaian
                ");
            }

            // Restore hasil_saw dengan mapping kolom
            if (DB::select("SHOW TEMPORARY TABLES LIKE 'temp_hasil_saw'")) {
                DB::statement("
                    INSERT INTO hasil_saw (hasil_saw_id, alternatif_id, skor_akhir, ranking, kategori, created_at, updated_at)
                    SELECT id, alternatif_id, skor_akhir, ranking, kategori, created_at, updated_at 
                    FROM temp_hasil_saw
                ");
            }
        } catch (\Exception $e) {
            // Jika restore gagal, biarkan kosong (akan di-seed ulang)
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DISABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // DROP tabel dengan struktur revisi
        Schema::dropIfExists('hasil_saw');
        Schema::dropIfExists('penilaian');
        Schema::dropIfExists('subdatakriteria');
        Schema::dropIfExists('alternatif');
        Schema::dropIfExists('kriteria');
        Schema::dropIfExists('users');

        // RECREATE tabel dengan struktur lama (jika diperlukan)
        // Atau bisa kosong jika ingin rollback ke migration sebelumnya

        // ENABLE foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
