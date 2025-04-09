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
        Schema::create('faculty_recruitments', function (Blueprint $table) {
            $table->id('recruitment_id');
            $table->unsignedBigInteger('faculty_id');
            $table->unsignedBigInteger('job_id');
            $table->date('application_date');
            $table->date('interview_date')->nullable();
            $table->date('hire_date')->nullable();
            $table->enum('recruitment_status', ['Declined', 'Waiting', 'Approved']);
            $table->timestamps();
        
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade');
            $table->foreign('job_id')->references('job_id')->on('job_postings')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_recruitments');
    }
};
