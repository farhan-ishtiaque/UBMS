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
        Schema::create('faculty_developments', function (Blueprint $table) {
            $table->id('development_id');
            $table->unsignedBigInteger('faculty_id');
            $table->string('program_name');
            $table->string('program_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->timestamps();
        
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_developments');
    }
};
