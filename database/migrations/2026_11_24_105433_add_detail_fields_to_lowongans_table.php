<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            if (!Schema::hasColumn('lowongans', 'alamat')) {
                $table->string('alamat')->nullable();
            }
            if (!Schema::hasColumn('lowongans', 'persyaratan')) {
                $table->text('persyaratan')->nullable();
            }
            if (!Schema::hasColumn('lowongans', 'rentang_gaji')) {
                $table->string('rentang_gaji')->nullable();
            }
            if (!Schema::hasColumn('lowongans', 'batas_pelamar')) {
                $table->unsignedInteger('batas_pelamar')->nullable();
            }
            if (!Schema::hasColumn('lowongans', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'persyaratan', 'rentang_gaji', 'batas_pelamar', 'foto']);
        });
    }
};