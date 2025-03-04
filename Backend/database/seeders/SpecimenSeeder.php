<?php

namespace Database\Seeders;

use App\Models\Specimen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('csv\peldany.csv');

        // Adatok beolvasása a TXT fájlból
        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($line = fgets($handle)) !== FALSE) {
                $row = explode(" ", trim($line));  // Elválasztás szóközzel
                $data[] = [
                    'id' => $row[0],
                    'bookId' => $row[1],
                    'price' => $row[2],
                    'acquisitionDate' => $row[3],
                ];
            }
            fclose($handle);
        }

        if (Specimen::count() === 0) {
            Specimen::factory()->createMany($data);
        }
    }
}
