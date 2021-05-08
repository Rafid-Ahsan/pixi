<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);

        DB::table('users')->insert([
            'name' => 'mod',
            'email' => 'mod@mod.com',
            'password' => Hash::make('mod')
        ]);

        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@user1.com',
            'password' => Hash::make('user1')
        ]);

        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@user2.com',
            'password' => Hash::make('user2')
        ]);
    }
}
