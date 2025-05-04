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
        Schema::create('company_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Jobseeker who submitted review
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade'); // Employer being reviewed
            $table->unsignedTinyInteger('rating')->comment('1-5 star rating');
            $table->text('content')->nullable();
            $table->string('job_title')->nullable();
            $table->string('employment_period')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('moderated_at')->nullable();
            $table->foreignId('moderated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('anonymous')->default(false);
            $table->timestamps();
            
            // Ensure a user can only review an employer once
            $table->unique(['user_id', 'admin_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_reviews');
    }
};
