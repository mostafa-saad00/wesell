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
        Schema::create('system_accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('system_admin')->constrained('admins');
            $table->foreignId('system_user')->constrained('users');

            $table->timestamps();
        });

        DB::table('system_accounts')->insert([
            [
                'system_admin' => 1,
                'system_user' => 1,
                
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
        Schema::dropIfExists('system_accounts');
    }
};
