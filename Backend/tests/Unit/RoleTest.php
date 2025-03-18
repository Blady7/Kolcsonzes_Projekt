<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{

    use DatabaseTransactions;

    public function test_the_get_sports_tabla_all_record_example(): void
    {
        $row=Role::create([
            'role' => 'xxx'
        ]);

        $response = $this->get('/api/roles');
        //A táblába bekerült a rekord
        $response -> assertSee('xxx');
        $response->assertStatus(200);

    
        $this->assertDatabaseHas('roles', ['id' => 1]); // Ellenőrizzük, hogy az adatbázisban is létezik az első felhasználó
    }
}
