<?php

namespace Database\Seeders;

use App\Models\Rental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('csv\rentals.csv');

        // Adatok beolvasása a TXT fájlból
        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $line = fgets($handle);
            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $data[] = [
                    'id' => $row[0],
                    'specimenId' => $row[1],
                    'userId' => $row[2],
                    'startindDate' => $row[3],
                    'endingDate' => $row[4],
                ];
            }
            fclose($handle);
        }

        if (Rental::count() === 0) {
            Rental::factory()->createMany($data);
        }
    }
}
