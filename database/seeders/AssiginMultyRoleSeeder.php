<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssiginMultyRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission1 = Permission::create(["name"=>"manage users"]);
        $permission2 = Permission::create(["name"=>"manage roles"]);
        $permission3 = Permission::create(["name"=>"manage permissions"]);
        $permission4 = Permission::create(["name"=>"manage tasks"]);

        $role = Role::findById(1);
        $role->syncPermissions([$permission1, $permission2, $permission3, $permission4]);

        /* $readerRole = Role::create(['name' => 'Reader']);
        $permission = Permission::create(['name' => 'manage permissions']);
        $permission->assignRole($readerRole);*/
    }
}
