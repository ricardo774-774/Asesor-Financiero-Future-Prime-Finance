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
        // Llamar a los seeders en el orden adecuado
        $this->call([
            RoleSeeder::class, 
            CategoriasgSeeder::class,
            UsuariosMuestraSeeder::class, // Llamar a UsuariosMuestraSeeder antes de asignar roles
            GastoSeeder::class, // Llamar a GastoSeeder después de que los usuarios han sido creados
            SaldoSeeder::class,
            AhorrosDiariosSeeder::class,
            GeneradorCategoriasSeeder::class,
            GeneradorSugerenciasSeeder::class,
            HistoricosSeeder::class, // Llamar a HistoricosSeeder después de que los usuarios han sido creados
            //seeders que no estan pero no son necesarios:
            //
        ]); 

        // Asignar roles a los usuarios después de que han sido creados por el UsuariosMuestraSeeder
        User::where('id', 11)->first()->assignRole('user');
        User::where('id', 22)->first()->assignRole('user');
        User::where('id', 33)->first()->assignRole('user');

        // Crear otros usuarios adicionales
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
    }
}
