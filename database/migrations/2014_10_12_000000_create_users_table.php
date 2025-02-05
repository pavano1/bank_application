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
            $table->id();
             $table->string('email', 50)->nullable()->unique();

            // Password and Confirm Password with size 155
            $table->string('password', 155)->nullable();
            $table->string('confirm_password', 155)->nullable();

            // Adding is_admin field as a boolean with a default value of false
            $table->boolean('is_admin')->default(false);

            // Optional fields
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
