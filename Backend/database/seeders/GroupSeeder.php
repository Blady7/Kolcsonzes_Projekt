<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('csv\groups.csv');

        // Adatok beolvasása a TXT fájlból
        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $line = fgets($handle);
            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $teacherId = null;
                $data[] = [
                    'id' => $row[0],
                    'group' => $row[1],
                    'teacherId' => $teacherId
                ];
            }
            fclose($handle);
        }

        if (Group::count() === 0) {
            Group::factory()->createMany($data);
        }
    }
}
