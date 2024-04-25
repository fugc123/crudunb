<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_users()
    {
        $userLogueado = User::factory()->create();
        Sanctum::actingAs($userLogueado);
        $user = User::factory()->create();
        $response = $this->get('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'users');
    }

    public function test_can_create_user()
    {
        $userLogueado = User::factory()->create();
        Sanctum::actingAs($userLogueado);
        $data = [
            'nombre' => 'John',
            'apellido' => 'Doe',
            'numero' => '123456789',
            'email' => 'john@example.com',
            'password' => 'password',
        ];

        $response = $this->post('/api/users', $data);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Usuario creado correctamente']);
    }

    public function test_can_update_user()
    {
        $userLogueado = User::factory()->create();
        Sanctum::actingAs($userLogueado);
        $user = User::factory()->create();

        $data = [
            'nombre' => 'Updated Name',
            'apellido' => 'Updated Lastname',
            'numero' => '987654321',
            'email' => 'updated@example.com',
            'password' => 'updatedpassword',
        ];

        $response = $this->put("/api/users/{$user->id}", $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Usuario actualizado correctamente']);
    }

    public function test_can_delete_user()
    {
        $userLogueado = User::factory()->create();
        Sanctum::actingAs($userLogueado);
        $user = User::factory()->create();

        $response = $this->delete("/api/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Usuario eliminado correctamente']);
    }
}
