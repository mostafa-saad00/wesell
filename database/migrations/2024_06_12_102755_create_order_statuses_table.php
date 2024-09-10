<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique(); // e.g., 'Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'
            $table->string('description')->nullable();
            $table->integer('stock_effect');

            $table->boolean('is_deleted')->default(0);
            
            $table->timestamps();
        });
        		
        DB::table('order_statuses')->insert([
            [
                'name' => 'processing',
                'stock_effect' => -1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'confirmed',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'cancelled',
                'stock_effect' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'duplicated',
                'stock_effect' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'waiting_for_shipping',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'shipped',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'waiting_for_pickup',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'picked_up',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'name' => 'delivered',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'name' => 'rejected_by_customer',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'name' => 'waiting_for_returned',
                'stock_effect' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'name' => 'returned_to_warehouse',
                'stock_effect' => 1,
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
        Schema::dropIfExists('order_statuses');
    }
};
