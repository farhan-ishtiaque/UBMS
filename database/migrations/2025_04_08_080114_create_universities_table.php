<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id('uni_id'); // uni_id
            $table->string('uni_name'); // Name of the university
            $table->enum('uni_type', ['Public', 'Private']); // University Type
            $table->year('established_year'); // Year established
            $table->string('postal_code'); // Portal code
            $table->enum('accreditation_status', ['Accredited', 'Not Accredited']); // Accreditation status
            $table->string('district'); // District
            $table->string('area'); // Area
            $table->string('website_url')->nullable(); // Website URL
            $table->string('email_address')->nullable(); // Email address
            $table->string('phone_number')->nullable(); // Phone number
            $table->timestamps(); // Created at and updated at

            // Optional: Add indexes for better performance
            $table->index('uni_name');
            $table->index('district');
            $table->index('area');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
