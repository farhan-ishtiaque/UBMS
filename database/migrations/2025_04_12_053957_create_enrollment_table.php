<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->id('enrollment_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->enum('semester', ['Spring', 'Summer', 'Fall']);
            $table->string('year');
            $table->string('grade')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');

            $table->unique(['student_id', 'course_id', 'semester', 'year'], 'unique_enrollment');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollment');
    }
};
