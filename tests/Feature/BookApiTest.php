<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;  // Import the User model
use Laravel\Sanctum\Sanctum;  // Import Sanctum if using Sanctum for authentication

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_book()
    {
        // Create a user and authenticate with Sanctum
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Now make the authenticated POST request
        $response = $this->postJson('/api/books', [
            'title' => 'Test Book',
            'author' => 'John Doe',
            'published_date' => '2024-01-01',
        ]);

        // Assert the response status and structure
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id', 'title', 'author', 'published_date', 'created_at', 'updated_at'
                 ]);
    }
}
