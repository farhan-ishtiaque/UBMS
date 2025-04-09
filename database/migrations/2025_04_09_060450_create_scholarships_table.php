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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id('scholarship_id'); // Primary key
            $table->unsignedBigInteger('university_id'); // Foreign key referencing universities
            $table->string('semester'); // Semester name
            $table->year('year'); // Year of scholarship
            $table->float('percentage'); // Percentage of aid
            $table->string('status'); // Status (e.g., Approved, Pending, Rejected)
            $table->enum('scholarship_type', ['University Provided Aid', 'Non-University Provided Aid']); // Type of aid
            $table->timestamps(); // Created at and updated at
            
            // Foreign key constraint
            $table->foreign('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
