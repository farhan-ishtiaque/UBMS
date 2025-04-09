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
        Schema::create('uni_fundings', function (Blueprint $table) {
            $table->id('funding_id');
            $table->unsignedBigInteger('university_id');
            $table->string('funding_source');
            $table->enum('funding_type', ['Government Funded', 'Non-Government Funded']);
            $table->float('allocation_amount');
            $table->date('allocation_date');
            $table->date('disbursement_date');
            $table->timestamps();
        
            $table->foreign('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uni_fundings');
    }
};
