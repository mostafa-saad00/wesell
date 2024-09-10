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
        Schema::create('carrier_rates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('carrier_id')->constrained('shipping_carriers');
            $table->foreignId('city_id')->constrained('cities');
            $table->decimal('base_rate', 10, 2);
            $table->decimal('rate_per_kg', 10, 2)->nullable();
            $table->decimal('rate_per_volume', 10, 2)->nullable();
            $table->string('delivery_time')->nullable();
            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });


        DB::table('carrier_rates')->insert([
            [
                'carrier_id' => 1,
                'city_id' => 1,
                'base_rate' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'carrier_id' => 1,
                'city_id' => 2,
                'base_rate' => 35,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'carrier_id' => 1,
                'city_id' => 3,
                'base_rate' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],
            

            [
                'carrier_id' => 2,
                'city_id' => 1,
                'base_rate' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'carrier_id' => 2,
                'city_id' => 2,
                'base_rate' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'carrier_id' => 2,
                'city_id' => 3,
                'base_rate' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],


            [
                'carrier_id' => 3,
                'city_id' => 1,
                'base_rate' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'carrier_id' => 3,
                'city_id' => 2,
                'base_rate' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'carrier_id' => 3,
                'city_id' => 3,
                'base_rate' => 33,
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
        Schema::dropIfExists('carrier_rates');
    }
};
