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
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('city_id')->constrained('cities');
            $table->decimal('package_1_rate');
            $table->decimal('package_2_rate');
            $table->decimal('package_3_rate');
            $table->decimal('package_4_rate');

            $table->timestamps();
        });


        DB::table('shipping_rates')->insert([
            [
                'city_id' => 1,
                'package_1_rate' => 45,
                'package_2_rate' => 40,
                'package_3_rate' => 35,
                'package_4_rate' => 30,

                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'city_id' => 2,
                'package_1_rate' => 45,
                'package_2_rate' => 40,
                'package_3_rate' => 35,
                'package_4_rate' => 30,

                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'city_id' => 3,
                'package_1_rate' => 55,
                'package_2_rate' => 50,
                'package_3_rate' => 45,
                'package_4_rate' => 40,

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
        Schema::dropIfExists('shipping_rates');
    }
};
