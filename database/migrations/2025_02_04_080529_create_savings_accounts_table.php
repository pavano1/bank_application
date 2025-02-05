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
        Schema::create('savings_accounts', function (Blueprint $table) {
             $table->id();
            $table->string('account_number', 16)->unique(); // 16-digit account number
            $table->string('first_name', 100)->nullable(); // Optional first name
            $table->string('last_name', 100)->nullable(); // Optional last name
            $table->date('dob'); // Date of birth
            $table->string('address', 255)->nullable(); // Optional address
            $table->decimal('balance', 15, 2)->default(10000); // Default balance 10,000 INR
            $table->string('currency', 3)->default('INR'); // Default currency INR
            $table->foreignId('user_id')->constrained()->unique()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings_accounts');
    }
};
