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
        Schema::create('university_admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->unsignedBigInteger('uni_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('designation')->nullable();
            $table->string('email_address');
            $table->string('phone_number');
            $table->string('password');
            $table->timestamps();
        
            $table->foreign('uni_id')->references('uni_id')->on('universities')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_admins');
    }
};
