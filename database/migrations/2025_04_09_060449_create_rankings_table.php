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
        Schema::create('rankings', function (Blueprint $table) {
            $table->id('ranking_id');
            $table->unsignedBigInteger('university_id');
            $table->string('ranking_criteria');
            $table->float('rank_value');
            $table->integer('ranking_year');
            $table->float('ranking_score');
            $table->date('published_date');
            $table->timestamps();
        
            $table->foreign('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rankings');
    }
};
