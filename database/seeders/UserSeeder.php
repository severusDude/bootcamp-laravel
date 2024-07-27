<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //users
        $users = [
            [
                // admin
                'name' => "admin",
                'email' => "admin@example.com",
                'password' => "admin",
                'role' => 'admin'
            ],
            [
                // editor
                'name' => "editor",
                'email' => "editor@example.com",
                'password' => "editor",
                'role' => 'editor'
            ],
            [
                // standard
                'name' => "standard",
                'email' => "standard@example.com",
                'password' => "standard",
                'role' => 'standard'

            ]
        ];

        foreach ($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password'])
            ]);

            $created_user->assignRole($user['role']);
        }
    }
}
