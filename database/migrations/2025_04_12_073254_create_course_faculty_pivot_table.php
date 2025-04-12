<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('course_faculty', function (Blueprint $table) {
            $table->unsignedBigInteger('faculty_id');
            $table->unsignedBigInteger('course_id');
            $table->string('semester');
            $table->boolean('is_primary_instructor')->default(false);
            $table->timestamps();

            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            
            $table->primary(['faculty_id', 'course_id', 'semester']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_faculty');
    }
};