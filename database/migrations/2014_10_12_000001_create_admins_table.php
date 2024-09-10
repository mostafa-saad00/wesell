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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->foreignId('role_id')->constrained();

            $table->boolean('is_deleted')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('admins')->insert([
            [
                'name' => 'System_Admin',
                'email' => 'system_admin@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mostafa Saad',
                'email' => 'super_admin@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mostafa Admin',
                'email' => 'admin@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'moderator_team_leader1',
                'email' => 'moderator_team_leader1@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'moderator_team_leader2',
                'email' => 'moderator_team_leader2@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'name' => 'warehouse_team_leader1',
                'email' => 'warehouse_team_leader1@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'warehouse_team_leader2',
                'email' => 'warehouse_team_leader2@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'confirmation_moderator1',
                'email' => 'confirmation_moderator1@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'confirmation_moderator2',
                'email' => 'confirmation_moderator2@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'confirmation_moderator3',
                'email' => 'confirmation_moderator3@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],



            [
                'name' => 'shipping_moderator1',
                'email' => 'shipping_moderator1@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'shipping_moderator2',
                'email' => 'shipping_moderator2@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'shipping_moderator3',
                'email' => 'shipping_moderator3@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'warehouse1',
                'email' => 'warehouse1@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'warehouse2',
                'email' => 'warehouse2@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'warehouse3',
                'email' => 'warehouse3@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
        
            [
                'name' => 'order_manager',
                'email' => 'order_manager@ecom-saas.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 7,
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
        Schema::dropIfExists('admins');
    }
};
