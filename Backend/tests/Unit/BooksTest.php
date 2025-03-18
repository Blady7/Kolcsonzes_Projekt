<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase; // Az adatbázis tisztítása minden teszt előtt és után

    public function test_the_get_books_table_all_record_example(): void
    {
        // Adat hozzáadása a táblához
        $book = Book::create([
            'poet' => 'xxx',
            'title' => 'cím',
            'groupId' => 'xxx',
        ]);

        // API kérés a könyvek lekérésére
        $response = $this->get('/api/books');

        // Ellenőrizzük, hogy a válasz státusza 200 (sikeres kérés)
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a válaszban szerepel a 'poet' és a 'title' adat
        $response->assertSee('xxx'); // Ellenőrzi, hogy a válasz tartalmazza a 'poet' értéket
        $response->assertSee('cím'); // Ellenőrzi, hogy a válasz tartalmazza a 'title' értéket

        // Ellenőrizzük, hogy a könyv adatbázisban is szerepel
        $this->assertDatabaseHas('books', [
            'poet' => 'xxx',
            'title' => 'cím',
        ]);
    }
}
