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
        // category permissions
        $category_create = Permission::create(['name' => 'create category']);
        $category_update = Permission::create(['name' => 'update category']);
        $category_delete = Permission::create(['name' => 'delete category']);

        // news permissions
        $news_create = Permission::create(['name' => 'create news']);
        $news_update = Permission::create(['name' => 'update news']);
        $news_delete = Permission::create(['name' => 'delete news']);
        $news_restore = Permission::create(['name' => 'restore news']);

        // comment permissions
        $comment_create = Permission::create(['name' => 'create comment']);
        $comment_update = Permission::create(['name' => 'update comment']);
        $comment_delete = Permission::create(['name' => 'delete comment']);

        // role permissions assignment
        $permissions_admin = [$category_create, $category_update, $category_delete, $news_delete, $news_restore];
        $permissions_editor = [$news_create, $news_update, $news_delete];
        $permissions_standard = [$comment_create, $comment_update, $comment_delete];

        $role_admin->syncPermissions($permissions_admin);
        $role_editor->syncPermissions($permissions_editor);
        $role_standard->syncPermissions($permissions_standard);
    }
}
