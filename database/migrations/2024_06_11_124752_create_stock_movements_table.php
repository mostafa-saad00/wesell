<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained();
            $table->integer('quantity_change');
            $table->string('type');
            $table->string('source')->nullable();

            $table->timestamps();
        });

        DB::table('stock_movements')->insert([
            [
                'product_id' => 1,
                'quantity_change' => 100,
                'type' => 'addition',
                'source' => 'manual adjustment',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'product_id' => 2,
                'quantity_change' => 100,
                'type' => 'addition',
                'source' => 'manual adjustment',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'product_id' => 3,
                'quantity_change' => 100,
                'type' => 'addition',
                'source' => 'manual adjustment',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'product_id' => 4,
                'quantity_change' => 100,
                'type' => 'addition',
                'source' => 'manual adjustment',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
