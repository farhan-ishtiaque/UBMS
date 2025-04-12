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
      // In your migration file
Schema::create('faculty_developments', function (Blueprint $table) {
    $table->id('development_id');
    $table->unsignedBigInteger('dept_id'); // Foreign key to departments
    $table->string('program_name');
    $table->string('program_type');
    $table->date('start_date');
    $table->date('end_date');
    $table->timestamps();
    
    $table->foreign('dept_id')->references('dept_id')->on('departments')->onDelete('cascade');
});
    }
// Remove the pivot table creation if it exists

    

};
