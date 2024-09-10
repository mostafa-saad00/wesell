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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone')->unique();
            $table->text('address');

            $table->boolean('is_blocked')->default(0);
            $table->boolean('is_deleted')->default(0);

            $table->timestamps();
        });

        DB::table('customers')->insert([
            ['name' => 'customer1', 'phone' => '01231231231', 'address' => 'Nasr city', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'customer2', 'phone' => '01231231555', 'address' => 'AL Shorouk', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
