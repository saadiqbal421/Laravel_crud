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
        Schema::table('insert_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users'); // This sets up the foreign key relationship
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insert_users', function (Blueprint $table) {
            //
        });
    }
};
