<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_insights', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul artikel
            $table->text('content'); // Konten artikel / insight
            $table->string('image')->nullable(); // Gambar (opsional)
            $table->json('comparison_data')->nullable(); // Data grafik JSON (opsional)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_insights');
    }
};
