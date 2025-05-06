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
            $row = fgetcsv($handle, 1000, ";");
            //print_r($row[4]);
           //die;
            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if (count($row) < 5) {
                    $endingDate = null;
                }
                else{
                    $endingDate = $row[4];
                }
                $data[] = [
                    'id' => $row[0],
                    'specimenId' => $row[1],
                    'userId' => $row[2],
                    'startingDate' => $row[3],
                    'endingDate' => $endingDate,
                    'opinion' => $row[5]
                ];
            }
            fclose($handle);
        }

        if (Rental::count() === 0) {
            Rental::factory()->createMany($data);
        }
    }
}
