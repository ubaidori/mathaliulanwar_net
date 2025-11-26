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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip')->nullable(); // Nomor Induk (Opsional)
            $table->string('position'); // Jabatan (Misal: Kepala Sekolah, Guru Fiqih)
            $table->string('photo')->nullable();
            $table->integer('sort_order')->default(0); // Untuk mengatur urutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
