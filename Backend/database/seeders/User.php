<?php

namespace Database\UserSeeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hozzunk létre néhány felhasználót a User modell segítségével
        User::create([
            'roleId' => 1, // feltételezve, hogy a roleId 1, ha van szerepkör modell
            'groupId' => 1, // feltételezve, hogy a groupId 1
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'), // Titkosított jelszó
        ]);

        User::create([
            'roleId' => 2,
            'groupId' => 2,
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'password' => Hash::make('password456'),
        ]);

        // További felhasználók hozzáadása itt
    }
}
