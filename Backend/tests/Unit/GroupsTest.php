<?php

namespace Tests\Feature;

use App\Models\Group;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GroupsTest extends TestCase
{
    use DatabaseTransactions; // Az adatbázis tranzakciók használata

    public function test_the_get_groups_table_all_record_example(): void
    {
        // Adat hozzáadása a táblához
        $group = Group::create([
            'group' => '1',
            'teacherId' => '1'
        ]);

        // API kérés a csoportok lekérésére
        $response = $this->get('/api/groups');

        // Ellenőrizzük, hogy a válasz státusza 200 (sikeres kérés)
        $response->assertStatus(200);

        // Ellenőrizzük, hogy a válasz tartalmazza a 'group' és 'teacherId' értékeket
        $response->assertSee('1'); // Ellenőrzi, hogy a válasz tartalmazza a 'group' értéket
        $response->assertSee('1'); // Ellenőrzi, hogy a válasz tartalmazza a 'teacherId' értéket

        // Ellenőrizzük, hogy az adatbázisban szerepel a 'group' és 'teacherId' érték
        $this->assertDatabaseHas('groups', [
            'group' => '1',
            'teacherId' => '1',
        ]);
    }
}
