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
        Schema::create('departments', function (Blueprint $table) {
            $table->id('dept_id');
            $table->unsignedBigInteger('uni_id');
            $table->string('dept_name');
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('programs', ['Undergraduate', 'Postgraduate']);
            $table->timestamps();
        
            $table->foreign('uni_id')->references('uni_id')->on('universities')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
