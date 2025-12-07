<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            
            // Relasi
            $table->foreignId('schedule_id')->constrained()->cascadeOnDelete();
            $table->foreignId('santri_id')->constrained()->cascadeOnDelete();
            // Opsional: Jika ingin mencatat siapa yang menginput (Admin/Guru)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); 

            $table->date('date'); // Tanggal absen dilakukan
            $table->enum('status', ['Hadir', 'Ijin', 'Sakit', 'Alpha']);
            $table->string('note')->nullable(); // Catatan, misal alasan ijin

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
