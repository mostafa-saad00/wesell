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
        Schema::create('order_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained();

            $table->foreignId('order_status_id')->constrained('order_statuses');
            $table->string('order_status_name');
            
            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->string('shipping_phone_2')->nullable();
            $table->text('shipping_address');
            $table->string('shipping_city');
            
            $table->unsignedInteger('shipping_price')->default(0);
            $table->unsignedInteger('sub_total');
            $table->unsignedInteger('total');
            
            $table->text('notes')->nullable();
            $table->string('shipping_code')->nullable();
            
            $table->unsignedInteger('version');

            $table->foreignId('updated_by')->constrained('admins'); 

            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_histories');
    }
};
