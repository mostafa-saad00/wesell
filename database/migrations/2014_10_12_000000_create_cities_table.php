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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('country');
            $table->boolean('is_allowed')->default(1);
            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });


        DB::table('cities')->insert([
            [
                'name' => 'القاهرة',
                'country' => 'Egypt',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'الجيزة',
                'country' => 'Egypt',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'الاسكندرية',
                'country' => 'Egypt',
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
        Schema::dropIfExists('cities');
    }
};
