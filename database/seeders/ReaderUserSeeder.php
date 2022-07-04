<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class readerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $readerRole = Role::create(['name' => 'Reader']);
        $permission = Permission::create(['name' => 'manage permissions']);
        $permission->assignRole($readerRole);

        $readerUser = User::factory()->create([
            'email' => 'reader@admin.com',
            'password' => bcrypt('SecurePassword')
        ]);
        $readerUser->assignRole('Reader');
    }
}
