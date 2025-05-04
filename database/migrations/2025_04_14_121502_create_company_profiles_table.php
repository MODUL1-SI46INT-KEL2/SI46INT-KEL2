<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('logo_path')->nullable();   // Column for storing logo path
            $table->string('banner_path')->nullable(); // Column for storing banner path
            $table->string('tagline')->nullable();     // Column for storing tagline
            $table->timestamps();                      // Created at & Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_profiles');
    }
}

