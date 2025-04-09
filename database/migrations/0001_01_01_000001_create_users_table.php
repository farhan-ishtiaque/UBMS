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
        
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('PhoneNumber');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('uni_id')->nullable();

            // Role system (ENUM for simplicity)
            $table->enum('type', ['umsb_personnel', 'university_admin','moderators'])
                  ->default('umsb_personnel');
            
            // Nullable foreign key since not all users belong to universities
            
            $table->foreign('uni_id')->references('uni_id')->on('universities')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
