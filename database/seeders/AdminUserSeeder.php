<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Administrator']);
        $permission1 = Permission::create(["name"=>"manage users"]);
        $permission2 = Permission::create(["name"=>"manage roles"]);
        $permission3 = Permission::create(["name"=>"manage permissions"]);
        $permission4 = Permission::create(["name"=>"manage tasks"]);
        $permission5 = Permission::create(["name"=>"manage patients"]);

        $adminRole->syncPermissions([$permission1, $permission2, $permission3, $permission4 ,$permission5]);

        $adminUser = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('SecurePassword')
        ]);

        $adminUser->assignRole('Administrator');
    }
}
