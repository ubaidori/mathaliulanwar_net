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
        Schema::create('islamic_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');      // Contoh: Awwaliyah, Wustho
            $table->string('class');     // Contoh: 1, 2, 3
            $table->string('sub_class'); // Contoh: A, B, C
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('islamic_classes');
    }
};
