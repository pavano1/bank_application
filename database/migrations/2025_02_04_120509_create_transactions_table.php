<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Primary key for the transactions table
            
            // Foreign key to debited account (nullable)
            $table->foreignId('debited_savings_account_id')
                ->nullable() // Allows NULL
                ->constrained('savings_accounts') // Refers to the 'id' in the savings_accounts table
                ->onDelete('cascade'); // Delete transactions if the savings account is deleted
            
            // Foreign key to credited account (nullable)
            $table->foreignId('credited_savings_account_id')
                ->nullable() // Allows NULL
                ->constrained('savings_accounts') // Refers to the 'id' in the savings_accounts table
                ->onDelete('cascade'); // Delete transactions if the savings account is deleted
            
            // Foreign key to another savings account (nullable)
            $table->foreignId('savings_account_id')
                ->nullable() // Allows NULL
                ->constrained('savings_accounts') // Refers to the 'id' in the savings_accounts table
                ->onDelete('set null'); // Set the foreign key to NULL if the referenced savings account is deleted

            $table->decimal('amount', 15, 2);  // The transaction amount
            $table->string('currency', 3);  // The currency for the transaction (e.g., USD, INR)
            $table->timestamps();  // Timestamps for created and updated time
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}