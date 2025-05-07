<?php

namespace Database\Seeders;

use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::statement('DELETE FROM Rentals');
        DB::statement('DELETE FROM Specimens');
        DB::statement('DELETE FROM Books');
        DB::statement('DELETE FROM Users');
        DB::statement('DELETE FROM Groups');
        DB::statement('DELETE FROM Roles');


        $this->call([
            RoleSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            BookSeeder::class,
            SpecimenSeeder::class,
            RentalSeeder::class,
        ]);

        // Tanárok hozzárendelése a csoportokhoz
        DB::table('groups')
            ->where('group', '9')
            ->update(['teacherId' => 269]);

        DB::table('groups')
            ->where('group', '10')
            ->update(['teacherId' => 270]);

        DB::table('groups')
            ->where('group', '11')
            ->update(['teacherId' => 271]);

        DB::table('groups')
            ->where('group', '12')
            ->update(['teacherId' => 272]);

        DB::table('groups')
            ->where('group', 'admin')
            ->update(['teacherId' => 273]);
    }
}
