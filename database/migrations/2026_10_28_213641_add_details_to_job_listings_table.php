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
        Schema::table('job_listings', function (Blueprint $table) {
            $table->text('address')->nullable();
            $table->unsignedInteger('quota')->default(1);
            $table->string('salary', 100)->nullable();
            $table->boolean('status')->default(true);
            $table->string('icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'quota',
                'salary',
                'status',
                'icon',
            ]);
        });
    }
};
