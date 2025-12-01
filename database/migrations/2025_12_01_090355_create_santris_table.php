<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            
            // --- DATA PRIBADI ---
            $table->integer('nis')->unique()->nullable(); // Nomor Induk Santri (Lokal)
            $table->integer('nisn')->unique()->nullable(); // Nasional
            $table->string('name');
            $table->enum('gender', ["L", "P"]);
            $table->string('address')->nullable();
            $table->date('dob')->nullable(); // Saya ubah ke DATE agar bisa hitung umur
            $table->integer('th_child')->nullable(); // Anak ke-berapa
            $table->integer('siblings_count')->nullable(); // Jumlah saudara
            $table->string('education')->nullable(); // Pendidikan sebelumnya (SD/MI)
            
            // --- DATA AKADEMIK & PONDOK ---
            $table->date('registration_date')->default(now()); // Tanggal Masuk
            // Pastikan tipe data unsignedBigInteger sama dengan id di tabel relasinya
            $table->unsignedBigInteger('dorm_id')->nullable(); 
            $table->unsignedBigInteger('islamic_class_id')->nullable();
            
            // --- DATA KELUARAR (Mutasi/Boyong) ---
            $table->date('drop_date')->nullable();
            $table->string('drop_reason')->nullable();

            // --- DATA AYAH ---
            $table->string('father_name')->nullable();
            $table->date('father_dob')->nullable(); // Ubah ke Date
            $table->string('father_address')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_education')->nullable();
            $table->string('father_job')->nullable();
            $table->enum('father_alive', ["Hidup", "Meninggal"])->nullable();

            // --- DATA IBU ---
            $table->string('mother_name')->nullable();
            $table->date('mother_dob')->nullable(); // Ubah ke Date
            $table->string('mother_address')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('mother_job')->nullable();
            $table->enum('mother_alive', ["Hidup", "Meninggal"])->nullable();

            // --- DATA WALI (Opsional) ---
            $table->string('guardian_name')->nullable();
            $table->date('guardian_dob')->nullable(); // Ubah ke Date
            $table->string('guardian_address')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_education')->nullable();
            $table->string('guardian_job')->nullable();
            $table->string('guardian_relationship')->nullable(); // Hubungan (Paman, Kakek, dll)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};