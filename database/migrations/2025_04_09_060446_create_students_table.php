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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id'); // Primary key
            $table->unsignedBigInteger('dept_id'); // Foreign key for departments
            $table->unsignedBigInteger('uni_id'); // Foreign key for universities
            $table->string('first_name');
            $table->string('middle_name')->nullable(); // Optional field
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other']); // Gender field
            $table->date('date_of_birth');
            $table->decimal('cgpa', 3, 2)->nullable(); // CGPA field, nullable
            $table->enum('graduation_status', ['graduated', 'not_graduated'])->default('not_graduated'); // Graduation status
            $table->date('graduation_date')->nullable(); // Graduation date, optional
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('dept_id')->references('dept_id')->on('departments')->onDelete('cascade');
            $table->foreign('uni_id')->references('uni_id')->on('universities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};