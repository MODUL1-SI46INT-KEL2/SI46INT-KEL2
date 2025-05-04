<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameAndWebsiteToCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('website')->nullable()->after('name');
            $table->unsignedBigInteger('user_id')->nullable()->after('tagline');
            
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['name', 'website', 'user_id']);
        });
    }
}
