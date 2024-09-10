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
        Schema::create('merchant_wallet_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();

            $table->foreignId('wallet_transaction_type')->constrained('wallet_transaction_types');
            $table->string('type_name');

            $table->unsignedInteger('quantity');
            
            $table->decimal('product_cost', 10, 2);
            $table->decimal('total_earnings', 10, 2);    

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_wallet_transactions');
    }
};
