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
        Schema::table('users', function (Blueprint $table) {
            $table->string('resume_path')->nullable()->after('phone');
            $table->text('skills')->nullable()->after('resume_path');
            $table->text('experience')->nullable()->after('skills');
            $table->text('education')->nullable()->after('experience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['resume_path', 'skills', 'experience', 'education']);
        });
    }
};
