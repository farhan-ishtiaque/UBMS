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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id('job_id'); // Primary key
            $table->unsignedBigInteger('uni_id'); // Foreign key for universities
            $table->unsignedBigInteger('dept_id'); // Foreign key for departments
            $table->string('job_title');
            $table->string('job_type');
            $table->text('requirements');
            $table->date('application_start_date');
            $table->date('application_deadline');
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('uni_id')->references('uni_id')->on('universities')->onDelete('cascade');
            $table->foreign('dept_id')->references('dept_id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};