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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_listing_id')
                ->constrained('job_listings')
                ->cascadeOnDelete();

            $table->foreignId('applicant_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('status')->default('Diproses');
            $table->date('interview_date')->nullable();
            $table->time('interview_time')->nullable();
            $table->string('interview_location')->nullable();
            $table->text('rejection_note')->nullable();

            $table->timestamps();
            $table->unique(['job_listing_id', 'applicant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
