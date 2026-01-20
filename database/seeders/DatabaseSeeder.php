<?php

namespace Database\Seeders;

use App\Models\PostMGR;
use App\Models\UserMGR;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 5 usuarios con sus publicaciones
        UserMGR::factory(5)
            ->has(PostMGR::factory(3), 'posts') // Especificar nombre de relación
            ->create();

        // Crear un usuario administrador específico para pruebas
        UserMGR::factory()
            ->admin()
            ->active()
            ->has(PostMGR::factory(5)->published(), 'posts') // Especificar nombre de relación
            ->create([
                'name' => 'Administrador Principal',
                'username' => 'admin',
                'email' => 'admin@example.com',
            ]);

        // Crear un usuario normal específico para pruebas
        UserMGR::factory()
            ->active()
            ->has(PostMGR::factory(3), 'posts') // Especificar nombre de relación
            ->create([
                'name' => 'Usuario de Prueba',
                'username' => 'testuser',
                'email' => 'user@example.com',
            ]);
    }
}
