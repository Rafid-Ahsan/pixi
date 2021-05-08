<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $mod = Role::create(['name' => 'moderator']);

        $permission = Permission::create(['name' => 'see admin panel']);

        $admin->givePermissionTo($permission);
        $mod->givePermissionTo($permission);

        $admin = User::first();
        $admin->givePermissionTo('see admin panel');
        $admin->assignRole('admin');

        $mod = User::where('id', 2)->first();
        $mod->givePermissionTo('see admin panel');
        $mod->assignRole('moderator');
    }
}
