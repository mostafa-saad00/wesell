<?php

use App\Models\Admin;
use App\Models\Role;
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
        Schema::create('order_assign_systems', function (Blueprint $table) {
            $table->id();

            $table->string('role');
            $table->unsignedInteger('last_assigned_admin_id')->nullable();

            $table->timestamps();
        });

        $moderation_role_id = Role::where('name', 'moderator')->first()->id;
        $first_moderator = Admin::where('role_id', $moderation_role_id)->orderBy('id', 'asc')->first();

        DB::table('order_assign_systems')->insert([
            [
                'role' => 'confirmation',
                'last_assigned_admin_id' => $first_moderator->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role' => 'shipping',
                'last_assigned_admin_id' => $first_moderator->id,
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
        Schema::dropIfExists('order_assign_systems');
    }
};
