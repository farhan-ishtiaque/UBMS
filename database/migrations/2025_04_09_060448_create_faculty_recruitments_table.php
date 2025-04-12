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
            $table->unsignedBigInteger('job_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('designation');
            $table->string('email')->unique();
            $table->string('qualification');
            $table->string('teaching_experience');
            $table->enum('recruitment_status', ['Declined', 'Waiting', 'Approved']);
            $table->timestamps();
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
