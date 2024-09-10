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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained();

            $table->foreignId('order_status_id')->constrained('order_statuses');
            $table->string('order_status_name');
            
            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->string('shipping_phone_2')->nullable();
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_city_id');
            
            $table->unsignedInteger('shipping_price')->default(0);
            $table->unsignedInteger('sub_total');
            $table->unsignedInteger('total');
            
            $table->text('notes')->nullable();
            
            $table->string('shipping_code')->nullable();
            $table->unsignedInteger('shipping_carrier_id')->nullable();

            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
