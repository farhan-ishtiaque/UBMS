<?php

use App\Models\Students;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) { 
            $table->id('scholarship_id'); // Primary key

            $table->unsignedBigInteger('student_id'); // Foreign key referencing universities
            $table->string('amount'); // amount of aid
            $table->enum('status', ['Recepient','Revoked']);
            $table->enum('scholarship_type', ['University Provided Aid', 'UBMS Merit']); // Type of aid
            $table->timestamps(); // Created at and updated at
            
            // Foreign key constraint
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');

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
