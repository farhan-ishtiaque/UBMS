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
        Schema::create('student_scholarship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('scholarship_id');
            $table->date('application_date');
            $table->date('disbursement_date')->nullable();
            $table->timestamps();
        
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('scholarship_id')->references('scholarship_id')->on('scholarships')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_scholarship');
    }
};
