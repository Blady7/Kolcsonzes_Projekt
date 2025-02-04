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
        Schema::create('rentals', function (Blueprint $table) {
            $table->Integer("id")->autoIncrement();
            $table->Integer('specimenId');
            $table->foreign('specimenId')->references('id')->on('specimens');
            $table->Integer('studentId');
            $table->date('startindDate');
            $table->date('endingDate');
            $table->date('startingDate')->change();
            $table->date('endingDate')->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
