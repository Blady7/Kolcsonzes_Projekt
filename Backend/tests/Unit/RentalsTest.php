<?php

namespace Tests\Feature;

use App\Models\Rental;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RentalsTest extends TestCase
{
    use RefreshDatabase; // Az adatbázis tisztítása minden teszt előtt és után

    public function test_the_get_rentals_table_all_record_example(): void
    {
        // Adat hozzáadása a táblához
        $row = Rental::create([
            'specimenId' => '44',
            'userId' => '4',
            'startingDate' => 'null',
            'endingDate' => 'null',
        ]);

        // API kérés a bérletek lekérésére
        $response = $this->get('/api/rentals');

        // Ellenőrizzük, hogy a válasz státusza 200 (sikeres kérés)
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a válasz tartalmazza a 'specimenId', 'userId', 'startingDate', 'endingDate' adatokat
        $response->assertSee('44'); // Ellenőrzi, hogy a válasz tartalmazza a 'specimenId' értéket
        $response->assertSee('4');  // Ellenőrzi, hogy a válasz tartalmazza a 'userId' értéket
        $response->assertSee('null'); // Ellenőrzi, hogy a válasz tartalmazza a 'startingDate' és 'endingDate' értékeket

        // Ellenőrizzük, hogy az adatbázisban szerepel a rekord a megfelelő mezőkkel
        $this->assertDatabaseHas('rentals', [
            'specimenId' => '44',
            'userId' => '4',
            'startingDate' => 'null',
            'endingDate' => 'null',
        ]);
    }
}
