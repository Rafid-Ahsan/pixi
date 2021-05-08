<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'Admin\'s team',
            'personal_team' => 1
        ]);

        DB::table('teams')->insert([
            'user_id' => 2,
            'name' => 'Moderator\'s team',
            'personal_team' => 1
        ]);

        DB::table('teams')->insert([
            'user_id' => 3,
            'name' => 'user1\'s team',
            'personal_team' => 1
        ]);

        DB::table('teams')->insert([
            'user_id' => 4,
            'name' => 'user2\'s team',
            'personal_team' => 1
        ]);
    }
}
