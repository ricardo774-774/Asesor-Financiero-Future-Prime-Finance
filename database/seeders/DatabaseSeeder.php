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
        $this->call([
            RoleSeeder::class, 
            CategoriasgSeeder::class,
            UsuariosMuestraSeeder::class,
            SaldoSeeder::class,
            GastoSeeder::class,
            AhorrosDiariosSeeder::class,
            GeneradorSugerenciasSeeder::class,
            GeneradorCategoriasSeeder::class,
            HistoricosSeeder::class,
        ]); 
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'adminL',
            'email' => 'lalofrancia1@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'adminR',
            'email' => 'roberloplo23@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'userG',
            'email' => 'usuarioG@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('user');

        // Insertar los nuevos usuarios
        User::factory()->create([
            'id' => 11,
            'name' => 'Alex Casillas',
            'email' => 'alexcasillas@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('user'); 

        User::factory()->create([
            'id' => 22,
            'name' => 'Max Cruz',
            'email' => 'maxcruz@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('user');

        User::factory()->create([
            'id' => 33,
            'name' => 'Abraham Ramirez',
            'email' => 'abrahamramirez@gmail.com',
            'password' => Hash::make('Modular2')
        ])->assignRole('user');
    }
}
