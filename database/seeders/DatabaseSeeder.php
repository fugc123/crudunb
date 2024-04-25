<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'nombre' => 'harold',
            'apellido' => 'rengifo',
            'numero' => '123456789',
            'email' => 'correo1@example.com',
            'password' => Hash::make('password1'),
            'activo' => true,
    ]);
    }
}
