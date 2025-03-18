<?php

namespace Tests\Feature;

use App\Models\Readingdiarie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadingdiariesTest extends TestCase
{
    use RefreshDatabase; // Az adatbázis tisztítása minden teszt előtt és után

    public function test_the_get_readingdiaries_table_all_record_example(): void
    {
        // Adat hozzáadása a táblához
        $row = Readingdiarie::create([
            'userId' => '3',
            'studentOpinion' => 'asd',
            'bookId' => '13',
            'grade' => '3',
        ]);

        // API kérés a napi olvasmányok lekérésére
        $response = $this->get('/api/readingdiarie');

        // Ellenőrizzük, hogy a válasz státusza 200 (sikeres kérés)
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a válasz tartalmazza a 'studentOpinion' és 'grade' adatokat
        $response->assertSee('asd'); // Ellenőrzi, hogy a válasz tartalmazza a 'studentOpinion' értéket
        $response->assertSee('3'); // Ellenőrzi, hogy a válasz tartalmazza a 'grade' értéket

        // Ellenőrizzük, hogy az adatbázisban szerepel a rekord a megfelelő mezőkkel
        $this->assertDatabaseHas('readingdiarie', [
            'userId' => '3',
            'studentOpinion' => 'asd',
            'bookId' => '13',
            'grade' => '3',
        ]);
    }
}
