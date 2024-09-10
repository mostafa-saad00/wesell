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
        Schema::create('moderator_teams', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('team_leader_id');
            $table->unsignedInteger('moderator_id');
            $table->string('task_name');

            $table->timestamps();
        });


        DB::table('moderator_teams')->insert([
            [
                'team_leader_id' => 4,
                'moderator_id' => 8,
                'task_name' => 'confirmation',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'team_leader_id' => 4,
                'moderator_id' => 9,
                'task_name' => 'confirmation',
                'created_at' => now(), 
                'updated_at' => now()
            ],

            [
                'team_leader_id' => 4,
                'moderator_id' => 11,
                'task_name' => 'shipping',
                'created_at' => now(), 
                'updated_at' => now()
            ],

            [
                'team_leader_id' => 4,
                'moderator_id' => 12,
                'task_name' => 'shipping',
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
        Schema::dropIfExists('moderator_teams');
    }
};
