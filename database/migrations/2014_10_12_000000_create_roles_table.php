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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });


        DB::table('roles')->insert([
            ['name' => 'super_admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'moderator_team_leader', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'warehouse_team_leader', 'created_at' => now(), 'updated_at' => now()],
            
            ['name' => 'moderator', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'warehouse', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'order_manager', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
