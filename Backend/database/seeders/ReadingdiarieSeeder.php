<?php

namespace Database\Seeders;

use App\Models\readingdiarie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReadingdiarieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('csv\readingDiaries.csv');

        // Adatok beolvasása a TXT fájlból
        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $line = fgets($handle);
            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $data[] = [
                    'id' => $row[0],
                    'userId' => $row[1],
                    'studentOpinion' => $row[2],
                    'bookId' => $row[3],
                    'grade' => $row[4],
                ];
            }
            fclose($handle);
        }

        if (readingdiarie::count() === 0) {
            readingdiarie::factory()->createMany($data);
        }
    }
}
