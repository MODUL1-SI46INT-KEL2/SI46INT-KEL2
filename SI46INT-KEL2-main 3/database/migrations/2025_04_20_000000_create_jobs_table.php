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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('id_job'); // INT PK
            $table->unsignedBigInteger('id_admin'); // INT FK
            $table->string('title', 225); // Job title
            $table->string('company', 225); // Company name
            $table->string('location', 225); // Job location
            $table->string('position_type', 225); // Position type (Full-time, Part-time, etc.)
            $table->string('job_type', 225); // Job type (Remote, On-site, etc.)
            $table->decimal('salary', 10, 2); // Salary amount
            $table->text('description'); // Job description
            $table->string('category', 225)->default('General'); // Job category
            $table->string('status', 50)->default('active'); // Job status
            $table->timestamp('posting_date')->nullable(); // When the job was posted
            $table->timestamps();
            
            // Foreign key relationship
            $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
