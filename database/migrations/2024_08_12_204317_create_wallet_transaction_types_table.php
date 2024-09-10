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
        Schema::create('wallet_transaction_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });


        DB::table('wallet_transaction_types')->insert([
            [
                'name' => 'ربح طلب',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'عملية سحب',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'مبلغ تعويضي',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'تكلفة منتج',
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
        Schema::dropIfExists('wallet_transaction_types');
    }
};
