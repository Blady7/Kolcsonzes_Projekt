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
        Schema::table('groups', function (Blueprint $table) {
            $table->foreign('teacherId')->references('id')->on('users'); //Idegen kulcs

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            //
        });
    }
};
