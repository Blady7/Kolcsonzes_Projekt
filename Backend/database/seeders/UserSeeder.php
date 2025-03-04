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
        // User::create([
        //     'roleId' => 1, // feltételezve, hogy a roleId 1, ha van szerepkör modell
        //     'groupId' => 1, // feltételezve, hogy a groupId 1
        //     'name' => 'John Doe',
        //     'email' => 'johndoe@example.com',
        //     'password' => Hash::make('password123'), // Titkosított jelszó
        // ]);

        // User::create([
        //     'roleId' => 2,
        //     'groupId' => 2,
        //     'name' => 'Jane Smith',
        //     'email' => 'janesmith@example.com',
        //     'password' => Hash::make('password456'),
        // ]);

        $filePath = database_path('csv\users.csv');


        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $line = fgets($handle);
            while (($line = fgets($handle)) !== FALSE) {
                $row = explode(" ", trim($line));  // Elválasztás szóközzel
                $data[] = [
                    'id' => $row[0],
                    'name' => $row[1],
                    'roleId' => $row[2],
                    'groupId' => $row[3],
                    'email' => $row[4],
                    'password' => Hash::make($row[5]),
                    
                ];
            }
            fclose($handle);
        }

        if (User::count() === 0) {
            User::factory()->createMany($data);
        }

        // További felhasználók hozzáadása itt
    }
}
