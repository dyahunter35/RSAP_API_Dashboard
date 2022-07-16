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

        $permission[] = Permission::findById(1);
        $permission[] = Permission::findById(2);
        $permission[] = Permission::findById(3);
        $permission[] = Permission::findById(4);
        $permission[] = Permission::findById(5);

        $role = Role::findById(1);
        $role->syncPermissions($permission);

        /* $readerRole = Role::create(['name' => 'Reader']);
        $permission = Permission::create(['name' => 'manage permissions']);
        $permission->assignRole($readerRole);*/
    }
}
