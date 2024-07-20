<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add roles
        $role_admin = Role::create(['name' => 'admin']);
        $role_editor = Role::create(['name' => 'editor']);
        $role_standard = Role::create(['name' => 'standard']);

        // create permissions
        // news permissions
        $news_create = Permission::create(['name' => 'create_news']);
        $news_read = Permission::create(['name' => 'read_news']);
        $news_update = Permission::create(['name' => 'update_news']);
        $news_delete = Permission::create(['name' => 'delete_news']);

        // role permissions assignment
        $permissions_admin = [$news_create, $news_read, $news_update, $news_delete];
        $permissions_editor = [$news_create, $news_read, $news_update, $news_delete];
        $permissions_standard = [$news_read];

        $role_admin->syncPermissions($permissions_admin);
        $role_editor->syncPermissions($permissions_editor);
        $role_standard->syncPermissions($permissions_standard);
    }
}
