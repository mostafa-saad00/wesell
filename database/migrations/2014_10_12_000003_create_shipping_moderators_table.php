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
        Schema::create('shipping_moderators', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admin_id')->constrained(); 

            $table->timestamps();
        });

        DB::table('shipping_moderators')->insert([
            ['admin_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['admin_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['admin_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_moderators');
    }
};
