<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_copies_get(): void
    {
        $response = $this->get('/api/copies');

        $response->assertStatus(200);
    }

    public function test_books_get(): void
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200);
    }
    public function test_books_post(): void
    {
        $response = $this->post('/api/books', ['author' => 'Wass Albert', "title" => "Tizenegy almafa"]);

        $response->assertStatus(200);
    }

    public function testUserIdAuth(): void
    {
        $this->withoutExceptionHandling();
        // create rögzíti az adatbázisban a felh-t
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/users/' . $user->id, ['name' => 'Wass Albert', 'email' => 'akos@gmail.com', 'password' => 'blabla', 'permission' => 0]);
        $response->assertStatus(200);
    }
}
