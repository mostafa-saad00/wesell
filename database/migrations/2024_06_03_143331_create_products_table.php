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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')->constrained('users');

            $table->string('title');
            $table->text('description');
            $table->string('sku');
            $table->string('main_image')->default('product-placeholder.png');

            $table->unsignedInteger('cost');
            $table->unsignedInteger('break_even_price');
            $table->unsignedInteger('lowest_selling_price');
            
            $table->unsignedInteger('current_stock')->default(0);
            $table->unsignedInteger('warehouse_stock')->default(0);

            $table->boolean('is_published')->default(0);
            $table->boolean('is_private')->default(0);
            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'owner_id' => 1,
                'title' => 'My first product',
                'description' => 'My first product description',
                'sku' => 'EG17195960755242',
                'cost' => 50,
                'break_even_price' => 150,
                'lowest_selling_price' => 200,
                'current_stock' => 100,
                'warehouse_stock' => 100,
                'is_published' => 1,
                'is_private' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'owner_id' => 1,
                'title' => 'My second product',
                'description' => 'My second product description',
                'sku' => 'EG17195961136221',
                'cost' => 100,
                'break_even_price' => 200,
                'lowest_selling_price' => 250,
                'current_stock' => 100,
                'warehouse_stock' => 100,
                'is_published' => 1,
                'is_private' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'owner_id' => 1,
                'title' => 'My third product',
                'description' => 'My third product description',
                'sku' => 'EG17195961389526',
                'cost' => 30,
                'break_even_price' => 140,
                'lowest_selling_price' => 190,
                'current_stock' => 100,
                'warehouse_stock' => 100,
                'is_published' => 1,
                'is_private' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'owner_id' => 1,
                'title' => 'My fourth product',
                'description' => 'My fourth product description',
                'sku' => 'EG17195961631067',
                'cost' => 150,
                'break_even_price' => 300,
                'lowest_selling_price' => 350,
                'current_stock' => 100,
                'warehouse_stock' => 100,
                'is_published' => 1,
                'is_private' => 0,
                'is_deleted' => 0,
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
        Schema::dropIfExists('products');
    }
};
