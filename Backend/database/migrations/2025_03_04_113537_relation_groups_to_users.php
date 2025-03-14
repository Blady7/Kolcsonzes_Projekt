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
            // Ellenőrizzük, hogy a roleId oszlop létezik-e
            if (Schema::hasColumn('groups', 'teacherId')) {
                $table->foreign('teacherId')->references('id')->on('users')->onDelete('set null');
            } else {
                // Ha nem létezik, akkor hibaüzenet vagy más kezelés
                echo "A teacherId oszlop nem létezik a groups táblában.\n";
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            // Ellenőrizzük, hogy az idegen kulcs létezik-e, mielőtt eltávolítanánk
            // if (Schema::hasColumn('groups', 'roleId') && Schema::hasTable('users')) {
            //     $table->dropForeign(['roleId']);
            // }
            $table->foreign('teacherId')->references('id')->on('users');
        });
    }
};