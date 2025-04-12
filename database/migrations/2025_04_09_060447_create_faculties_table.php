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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id('faculty_id'); // Primary key
            $table->unsignedBigInteger('dept_id'); // Foreign key for departments
            $table->unsignedBigInteger('uni_id'); // Foreign key for universities
            $table->string('first_name');
            $table->string('middle_name')->nullable(); // Optional field
            $table->string('last_name');
            $table->string('designation');
            $table->string('email')->unique();
            $table->string('qualification');
            $table->integer('teaching_experience')->nullable(); // Optional field
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
        Schema::dropIfExists('faculties');
    }
};