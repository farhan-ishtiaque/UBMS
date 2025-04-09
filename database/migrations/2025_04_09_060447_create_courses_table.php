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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->unsignedBigInteger('dept_id');
            $table->string('course_name');
            $table->string('semester');
            $table->string('year');
            $table->integer('credits');
            $table->timestamps();
        
            $table->foreign('dept_id')->references('dept_id')->on('departments')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
