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
            // Remove columns that are now in jobseeker_profiles table
            $table->dropColumn([
                'resume_path',
                'portfolio_path',
                'portfolio_description',
                'skills',
                'experience',
                'education'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add back the columns if the migration is rolled back
            $table->string('resume_path')->nullable()->after('phone');
            $table->string('portfolio_path')->nullable()->after('resume_path');
            $table->text('portfolio_description')->nullable()->after('portfolio_path');
            $table->text('skills')->nullable()->after('portfolio_description');
            $table->text('experience')->nullable()->after('skills');
            $table->text('education')->nullable()->after('experience');
        });
    }
};
