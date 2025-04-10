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
            $table->unsignedBigInteger('university_id');
            $table->string('admin_name');
            $table->string('designation')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->date('joining_date');
            $table->date('leaving_date')->nullable();
            $table->string('email_address');
            $table->string('phone_number');
            $table->timestamps();
        
            $table->foreign('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
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
