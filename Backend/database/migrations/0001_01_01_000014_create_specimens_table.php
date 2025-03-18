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
        Schema::create('specimens', function (Blueprint $table) {
            $table->Integer("id") -> autoIncrement();
            $table->Integer('bookId');
            $table->foreign('bookId')->references('id')->on('books')->onDelete('cascade');
            $table->Integer("price");
            $table->date('acquisitionDate')->nullable();
            $table->date('acquisitionDate')->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specimens');
    }
};
