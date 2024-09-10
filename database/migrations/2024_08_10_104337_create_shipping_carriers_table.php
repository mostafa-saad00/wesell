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
        Schema::create('shipping_carriers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });


        DB::table('shipping_carriers')->insert([
            [
                'name' => 'Turbo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bosta',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mylerz',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_carriers');
    }
};
