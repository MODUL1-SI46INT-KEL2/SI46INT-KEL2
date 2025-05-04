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
        Schema::create('jobseeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('resume_path')->nullable();
            $table->string('portfolio_path')->nullable();
            $table->text('portfolio_description')->nullable();
            $table->text('skills')->nullable();
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->string('job_title')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('available_for_hire')->default(true);
            $table->timestamps();
        });
        
        // Move existing data from users table to jobseeker_profiles
        if (Schema::hasColumns('users', ['resume_path', 'portfolio_path', 'portfolio_description', 'skills', 'experience', 'education'])) {
            DB::statement('
                INSERT INTO jobseeker_profiles (
                    user_id, resume_path, portfolio_path, portfolio_description, 
                    skills, experience, education, created_at, updated_at
                )
                SELECT 
                    id, resume_path, portfolio_path, portfolio_description, 
                    skills, experience, education, NOW(), NOW()
                FROM users
                WHERE role = "jobseeker" AND (
                    resume_path IS NOT NULL OR 
                    portfolio_path IS NOT NULL OR 
                    portfolio_description IS NOT NULL OR 
                    skills IS NOT NULL OR 
                    experience IS NOT NULL OR 
                    education IS NOT NULL
                )
            ');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobseeker_profiles');
    }
};
