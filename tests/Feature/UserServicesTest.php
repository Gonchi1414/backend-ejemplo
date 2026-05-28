<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServicesTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_register_success(): void
    {
        $response = $this->postJson('/api/register', [
            'nombres' => 'Test',
            'apellidos' => 'User',
            'fecha_nacimiento' => '1990-01-01',
            'email' => 'test-guia@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'rol' => 'user',
        ]);
        $response->assertStatus(201);
        $response->assertJsonPath('status', 'User created successfully');
        $response->assertJsonStructure([
            'status',
            'user' => [
                'id',
                'nombres',
                'apellidos',
                'email',
                'rol',
                'estado',
                'fecha_nacimiento',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
