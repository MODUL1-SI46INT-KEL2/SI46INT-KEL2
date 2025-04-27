<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // User's name
            $table->string('email')->unique(); // User's email, must be unique
            $table->string('password'); // User's password
            $table->enum('role', ['admin', 'jobseeker'])->default('jobseeker'); // User role (Admin or Jobseeker)
            $table->unsignedBigInteger('company_profile_id')->nullable(); // Foreign key to company profile table
            $table->timestamps(); // Created at & Updated at timestamps

            // Define foreign key constraint
            $table->foreign('company_profile_id')->references('id')->on('company_profiles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
