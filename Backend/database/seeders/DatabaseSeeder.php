<?php

namespace Database\Seeders;


use Database\UserSeeders\UserSeeder;
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

        DB::statement('DELETE FROM Readingdiaries');
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
            ReadingdiarieSeeder::class,
        ]);


    }
}
