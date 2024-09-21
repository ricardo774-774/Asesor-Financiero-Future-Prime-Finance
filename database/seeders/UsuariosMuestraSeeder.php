<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Asegúrate de importar la clase para usar Str::random()
use Carbon\Carbon; // Asegúrate de importar la clase para usar las fechas

class UsuariosMuestraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $now = Carbon::now(); // Para usar la misma fecha de creación y actualización

        DB::table('users')->insertOrIgnore([
            [
                'id' => 11,
                'name' => 'Alex Casillas',
                'email' => 'alexcasillas@gmail.com',
                'password' => Hash::make('Modular2'),
                'email_verified_at' => $now, // Verificar el email con la fecha actual
                'remember_token' => Str::random(10), // Generar un token aleatorio
                'created_at' => $now, // Fecha de creación
                'updated_at' => $now, // Fecha de actualización
            ],
            [
                'id' => 22,
                'name' => 'Max Cruz',
                'email' => 'maxcruz@gmail.com',
                'password' => Hash::make('Modular2'),
                'email_verified_at' => $now, // Verificar el email con la fecha actual
                'remember_token' => Str::random(10), // Generar un token aleatorio
                'created_at' => $now, // Fecha de creación
                'updated_at' => $now, // Fecha de actualización
            ],
            [
                'id' => 33,
                'name' => 'Abraham Ramirez',
                'email' => 'abrahamramirez@gmail.com',
                'password' => Hash::make('Modular2'),
                'email_verified_at' => $now, // Verificar el email con la fecha actual
                'remember_token' => Str::random(10), // Generar un token aleatorio
                'created_at' => $now, // Fecha de creación
                'updated_at' => $now, // Fecha de actualización
            ],
        ]);
    }
}
