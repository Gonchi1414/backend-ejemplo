<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Crear un usuario root, admin y user para pruebas
        User::create([
            'nombres' => 'Super',
            'apellidos' => 'Root',
            'email' => 'super.admin@example.com',
            'password' => 'password',
            'rol' => 'root',
            'estado' => 'activo',
            'fecha_nacimiento' => '1990-01-01',
        ]);
        User::create([
            'nombres' => 'Admin',
            'apellidos' => 'User',
            'email' => 'admin@example.com',
            'password' => 'password',
            'rol' => 'admin',
            'estado' => 'activo',
            'fecha_nacimiento' => '1990-01-01',
        ]);
        User::create([
            'nombres' => 'John Doe',
            'apellidos' => 'Smith',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'rol' => 'user',
            'estado' => 'activo',   
            'fecha_nacimiento' => '1990-01-01',
        ]);
    }
}
