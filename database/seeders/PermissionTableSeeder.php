<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //Permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'unpublish posts']);

        //create roles and assign existing permissions
        $writerRole = Role::create(['name' => 'writer']);
        $writerRole->givePermissionTo('view posts');
        $writerRole->givePermissionTo('create posts');
        $writerRole->givePermissionTo('edit posts');
        $writerRole->givePermissionTo('delete posts');

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view posts');
        $adminRole->givePermissionTo('create posts');
        $adminRole->givePermissionTo('edit posts');
        $adminRole->givePermissionTo('delete posts');
        $adminRole->givePermissionTo('publish posts');
        $adminRole->givePermissionTo('unpublish posts');

        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'name' => 'Example user',
            'email' => 'writer@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($writerRole);

        $user = User::factory()->create([
            'name' => 'Example admin user',
            'email' => 'admin@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'Example superadmin user',
            'email' => 'superadmin@qadrlabs.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superadminRole);
    }
}

