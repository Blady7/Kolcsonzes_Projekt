<?php

namespace Tests\Feature;

use App\Models\Specimen;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class SpecimensTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test: Lekérdezi a 'specimens' tábla összes rekordját.
     *
     * Ez a teszt ellenőrzi, hogy a /api/specimens végpont helyesen működik-e,
     * és visszaadja-e a táblában található összes rekordot.
     */
    public function test_the_get_sports_tabla_all_record_example(): void
    {
        // Arrange: Adatok hozzáadása a 'specimens' táblához
        $specimen = Specimen::create([
            'bookId' => 10,
            'price' => 1459,
            'acquisitionDate' => '2008-11-21',
        ]);

        // Act: API hívás a '/api/specimens' végpontra
        $response = $this->get('/api/specimens');

        // Assert: Ellenőrzések
        $response->assertStatus(200);
        
        $response->assertJson(function (AssertableJson $json) use ($specimen) {
            $json->where('0.bookId', $specimen->bookId)
                 ->where('0.price', $specimen->price)
                 ->where('0.acquisitionDate', $specimen->acquisitionDate);
        });

        $this->assertDatabaseHas('specimens', ['bookId' => 10]);
    }
}
