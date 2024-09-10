<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_country_code')->default('0020');
            $table->string('phone');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('store_name');
            $table->string('store_domain')->nullable();

            $table->string('shipping_rates_package')->default('package_1_rate');

            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_blocked')->default(0);
            
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
        [
            'name' => 'System User',
            'email' => 'system_user@ecom-saas.com',
            'phone' => '01234567890',
            'password' => Hash::make('1234567890'),
            'store_name' => 'System User',

            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Mostafa Saad',
            'email' => 'user1@ecom-saas.com',
            'phone' => '01158490400',
            'password' => Hash::make('1234567890'),
            'store_name' => 'Mo5talef Store',   

            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Mostafa Mohamed',
            'email' => 'user2@ecom-saas.com',
            'phone' => '01008497686',
            'password' => Hash::make('1234567890'),
            'store_name' => 'Hash Store',

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
        Schema::dropIfExists('users');
    }
};
