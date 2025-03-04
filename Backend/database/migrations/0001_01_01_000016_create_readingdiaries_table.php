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
        Schema::create('readingdiaries', function (Blueprint $table) {
            $table->id();
            $table->Integer('userId');
            //$table->foreign('userId')->references('id')->on('users');
            $table->string('studentOpinion',250);
            $table->Integer('bookId');
            $table->foreign('bookId')->references('id')->on('books');
            $table->Integer("grade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readingdiaries');
    }
};
