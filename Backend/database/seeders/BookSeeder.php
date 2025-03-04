<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('csv/mu.csv');
        // Adatok beolvasása a TXT fájlból
        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($line = fgets($handle)) !== FALSE) {
                $row = explode(" ", trim($line));  // Elválasztás szóközzel
                $data[] = [
                    'id' => $row[0],
                    'poet' => $row[1],
                    'title' => $row[2],
                    'groupId' => $row[3],
                ];
            }
            fclose($handle);
        }

        if (Book::count() === 0) {
            Book::factory()->createMany($data);
        }
    }
}
